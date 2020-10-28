<?php
namespace app\models;

use yii\db\ActiveRecord;

class SellerDisburse extends ActiveRecord
{
    public static function tableName()
    {
        return '{{seller_disburse}}';
    }
}
