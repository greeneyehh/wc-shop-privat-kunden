<?php

namespace app\models\Security;

use Yii;

/**
 * This is the model class for table "paypallog".
 *
 * @property int $id
 * @property string $payid
 * @property string $intent
 * @property string $paystate
 * @property string $cart
 * @property string $payer
 * @property string $transactions
 * @property string $redirect_urls
 * @property string $create_time
 * @property string $update_time
 * @property string $links
 */
class Paypallog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_paypallog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['payer', 'transactions', 'links'], 'string'],
            [['payid', 'intent', 'cart', 'redirect_urls', 'create_time', 'update_time'], 'string', 'max' => 255],
            [['paystate'], 'string', 'max' => 2555],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'payid' => 'Payid',
            'intent' => 'Intent',
            'paystate' => 'Paystate',
            'cart' => 'ShoppingCart',
            'payer' => 'Payer',
            'transactions' => 'Transactions',
            'redirect_urls' => 'Redirect Urls',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'links' => 'Links',
        ];
    }
}
