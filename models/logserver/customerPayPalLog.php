<?php
namespace app\models\logserver;
use Yii;

class customerPayPalLog extends \yii\db\ActiveRecord
{

    public static function tableName() {
        return 'customer_PayPal';
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
            'cart' => 'cart',
            'status' => 'status',
        ];
    }
}