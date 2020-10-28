<?php
namespace app\controllers;

use Yii;
use app\models\LoginForm;
use app\models\SellerDisburse;
use app\models\WithdrawForm;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use yii\httpclient\Client;
use yii\web\Controller;
use yii\web\Response;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'withdraw', 'disburse'],
                'rules' => [
                    [
                        'actions' => ['disburse'],
                        'allow' => Yii::$app->user->identity->role === 'admin',
                        'roles' => ['@'],
                    ], [
                        'actions' => ['withdraw'],
                        'allow' => Yii::$app->user->identity->role === 'seller',
                        'roles' => ['@'],
                    ], [
                        'actions' => ['logout', 'withdraw', 'disburse'],
                        'allow' => true,
                        'roles' => ['@'],
                    ], 
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionWithdraw()
    {
        $withdrawForm = new WithdrawForm();
        
        if ($withdrawForm->load(Yii::$app->request->post()) && $withdrawForm->submit()) {
            Yii::$app->session->setFlash('withdrawFormSubmitted');

            return $this->refresh();
        }

        $dataSellerDisburse = SellerDisburse::find();

        return $this->render('withdraw', [
            'withdrawForm' => $withdrawForm,
            'dataSellerDisburse' => $dataSellerDisburse,
        ]);
    }

    public function actionDisburse()
    {
        $dataSellerDisburseReq = SellerDisburse::find()
            ->where(['status' => NULL]);
        $dataProviderReq = new ActiveDataProvider([
            'query' => $dataSellerDisburseReq,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        
        $dataSellerDisbursePending = SellerDisburse::find()
            ->where(['status' => 'PENDING']);
        $dataProviderPending = new ActiveDataProvider([
            'query' => $dataSellerDisbursePending,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $dataSellerDisburseSuccess = SellerDisburse::find()
            ->where(['status' => 'SUCCESS']);
        $dataProviderSuccess = new ActiveDataProvider([
            'query' => $dataSellerDisburseSuccess,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('disburse', [
            'dataProviderReq' => $dataProviderReq,
            'dataProviderPending' => $dataProviderPending,
            'dataProviderSuccess' => $dataProviderSuccess,
        ]);
    }

    public function actionDisburseSubmit()
    {
        $client = new Client(['baseUrl' => Yii::$app->params['flipAPI']['baseURL']]);
        $username = Yii::$app->params['flipAPI']['username'];
        $password = '';
        $updateOkSQL = [];
        $updateFailSQL = [];
        $dataSellerDisburseReq = SellerDisburse::find()
            ->where(['status' => NULL])
            ->orWhere(['status' => 'FAILED'])
            ->all();

        foreach($dataSellerDisburseReq as $row) {
            $response = $client->createRequest()
                ->setUrl('disburse')
                ->setMethod('POST')
                ->setHeaders(['content-type' => 'application/json'])
                ->addHeaders(['Authorization' => 'Basic '.base64_encode("$username:$password")])
                ->setData([
                    'bank_code' => $row->bank_code,
                    'account_number' => $row->account_number,
                    'amount' => $row->amount,
                    'remark' => $row->remark,
                ])
                ->send();

            if($response->isOk) {
                $updateOkSQL[] = "UPDATE seller_disburse
                                  SET id_disburse=".$response->data['id'].",
                                      status='".$response->data['status']."',
                                      fee=".$response->data['fee'].",
                                      beneficiary_name='".$response->data['beneficiary_name']."',
                                      receipt='".$response->data['receipt']."',
                                      timestamp='".$response->data['timestamp']."',
                                      time_served='".$response->data['time_served']."'
                                  WHERE id=".$row->id;
            }
            else {
                $updateFailSQL[] = "UPDATE seller_disburse SET status='FAILED' WHERE id=".$row->id;
            }
        }

        if(count($updateOkSQL)) {
            Yii::$app->db
                ->createCommand(implode(';', $updateOkSQL))
                ->execute();
        }

        if(count($updateFailSQL)) {
            Yii::$app->db
                ->createCommand(implode(';', $updateFailSQL))
                ->execute();
        }
        
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDisburseUpdate()
    {
        $client = new Client(['baseUrl' => Yii::$app->params['flipAPI']['baseURL']]);
        $username = Yii::$app->params['flipAPI']['username'];
        $password = '';
        $updateOkSQL = [];
        $dataSellerDisbursePending = SellerDisburse::find()
            ->where(['status' => 'PENDING'])
            ->all();
        
        foreach($dataSellerDisbursePending as $row) {
            $response = $client->createRequest()
                ->setUrl('disburse/'.$row->id_disburse)
                ->setHeaders(['content-type' => 'application/json'])
                ->addHeaders(['Authorization' => 'Basic '.base64_encode("$username:$password")])
                ->send();
                
            if($response->isOk) {
                $updateOkSQL[] = "UPDATE seller_disburse
                                  SET status='".$response->data['status']."',
                                      receipt='".$response->data['receipt']."',
                                      time_served='".$response->data['time_served']."'
                                  WHERE id=".$row->id;
            }
        }

        if(count($updateOkSQL)) {
            Yii::$app->db
                ->createCommand(implode(';', $updateOkSQL))
                ->execute();
        }
    
        return $this->redirect(Yii::$app->request->referrer);
    }
}
