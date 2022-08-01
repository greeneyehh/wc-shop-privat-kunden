<?php


namespace app\models\Payment;
use Yii;

/**
 * This is the model class for table "payment_result_codes".
 *
 * @property int $id
 * @property string $result_codes_code
 * @property string $result_codes_description
 * @property int $payment_result_status
 */
class PaymentResultCodes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment_result_codes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['payment_result_status'], 'integer'],
            [['result_codes_code'], 'string', 'max' => 11],
            [['result_codes_description'], 'string', 'max' => 205],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'result_codes_code' => 'Result Codes Code',
            'result_codes_description' => 'Result Codes Description',
            'payment_result_status' => 'Payment Result Status',
        ];
    }
}