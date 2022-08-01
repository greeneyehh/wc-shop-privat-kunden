<?php


namespace app\models\Payment;
use Yii;


class RecurringPayment extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'recurringpayment';
    }

    public function rules()
    {
        return [
            [['accountid','recurringId', 'cart', 'recurringentityId', 'recurringType', 'customerorderId'], 'required'],
            [['cart', 'customerorderId', 'recurringType'], 'string'],
            [['recurringId','recurringentityId'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'recurringId' => 'Recurring ID',
            'cart' => 'Cart',
            'recurringentityId' => 'Recurringentity ID',
            'recurringType' => 'Recurring Type',
            'customerorderId' => 'Customerorder ID',
        ];
    }
}