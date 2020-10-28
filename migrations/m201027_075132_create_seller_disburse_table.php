<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%seller_disburse}}`.
 */
class m201027_075132_create_seller_disburse_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('seller_disburse', [
            'id' => $this->primaryKey(),
            'id_disburse' => $this->bigInteger(),
            'bank_code' => $this->string(),
            'account_number' => $this->string(),
            'status' => $this->string(),
            'amount' => $this->bigInteger(),
            'fee' => $this->integer(),
            'beneficiary_name' => $this->string(),
            'remark' => $this->string(),
            'receipt' => $this->string(),
            'timestamp' => $this->dateTime(),
            'time_served' => $this->dateTime(),
        ]);

        $this->batchInsert('seller_disburse',[
            'bank_code', 'account_number', 'amount', 'remark'
        ], [
            ['bni', '1234567890', 10000, 'sample remark'],
            ['bni', '1234567890', 10000, 'sample remark'],
            ['bni', '1234567890', 10000, 'sample remark'],
            ['bni', '1234567890', 10000, 'sample remark'],
            ['bni', '1234567890', 10000, 'sample remark']
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('seller_disburse');
    }
}
