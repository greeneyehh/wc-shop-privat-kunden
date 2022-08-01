<?php

namespace app\models\SalesInvoiceTasker;

use Yii;


class SalesInvoiceTask extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'SalesInvoiceTask';
    }


    public function rules()
    {
        return [
            [['accountid','items','status','error'], 'required'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'accountid' => 'accountid',
            'items' => 'items',
            'status' => 'status',
            'error' => 'error',
        ];
    }
}