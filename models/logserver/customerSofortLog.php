<?php
namespace app\models\logserver;
use Yii;

class customerSofortLog extends \yii\db\ActiveRecord
{

    public static function tableName() {
        return 'customer_Sofort';
    }

    public function rules()
    {
        return [
            [['token', 'accountid'], 'required'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'token' => 'token',
            'accountid' => 'AccountId',
            'payerID' => 'payerID',
            'checkoutResponse' => 'checkoutResponse',
            'checkoutCaptureResponse' => 'checkoutCaptureResponse',
            'notificationResponse' => 'notificationResponse',
            'cart' => 'cart',
            'status' => 'status',
        ];
    }
}