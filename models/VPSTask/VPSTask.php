<?php

namespace app\models\VPSTask;

use Yii;


class VPSTask extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'VPSTask';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['accountid','CustomerOrderId','OrderJson','passwort','status'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'accountid' => 'accountid',
            'CustomerOrderId' => 'CustomerOrderId',
            'OrderJson' => 'OrderJson',
            'initialpasswort' => 'initialpasswort',
            'status' => 'status',
        ];
    }
}