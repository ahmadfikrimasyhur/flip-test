<?php
namespace app\models;

use Yii;
use yii\base\Model;

class WithdrawForm extends Model
{
    public $amount;
    public $remark;

    public function rules()
    {
        return [
            [['amount', 'remark'], 'required'],
            [['amount'], 'integer', 'min' => 10000],
        ];
    }

    public function submit()
    {
        if ($this->validate()) {
            $sellerDisburse = new SellerDisburse;
            $sellerDisburse->bank_code = Yii::$app->user->identity->bank_code;
            $sellerDisburse->account_number = Yii::$app->user->identity->account_number;
            $sellerDisburse->amount = $this->amount;
            $sellerDisburse->remark = $this->remark;
            
            if($sellerDisburse->save()) {
                return true;
            }
        }

        return false;
    }
}
