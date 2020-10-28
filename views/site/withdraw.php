<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

$this->title = 'Withdraw';
$this->params['breadcrumbs'][] = $this->title;

$dataProvider = new ActiveDataProvider([
    'query' => $dataSellerDisburse,
    'pagination' => [
        'pageSize' => 20,
    ],
]);
?>
<div class="site-withdraw">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('withdrawFormSubmitted')): ?>

    <div class="alert alert-success">
    Withdraw submitted.
    </div>

    <?php endif; ?>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(['id' => 'withdraw-form']); ?>

                <?= $form->field($withdrawForm, 'amount')->textInput(['autofocus' => true]) ?>

                <?= $form->field($withdrawForm, 'remark') ?>

                <div class="form-group">
                    <?= Html::submitButton('Withdraw', ['class' => 'btn btn-primary', 'name' => 'withdraw-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

    <h2><?= Html::encode($this->title) ?> History</h2>

    <div class="row">
        <div class="col-lg-12">

            <?php 
            echo GridView::widget([
                'dataProvider' => $dataProvider,
            ]);
            ?>

        </div>
    </div>
</div>