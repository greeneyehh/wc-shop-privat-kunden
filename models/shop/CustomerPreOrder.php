<?php

namespace app\models\shop;

use Yii;

/**
 * This is the model class for table "customer_order".
 *
 * @property int $id
 * @property int $accountid
 * @property int $productid
 * @property string $domain
 * @property string $addons
 * @property string $node
 * @property string $vmid
 * @property string $vmos
 * @property int $paycycle
 * @property string $datetime
 * @property string $lastpaydate
 * @property string $lastpayid
 * @property string $lastpaybrand
 * @property string $cancellation
 * @property string $cancellationdate
 * @property string $active
 * @property string $username
 * @property string $initialpasswort
 * @property string $activate_hash
 * @property string $payidlog
 */
class CustomerPreOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer_preorder';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sessionid','accountid', 'productid'], 'required'],
            [['accountid', 'productid'], 'integer'],
            [['datetime'], 'safe'],
            [['addons','domain','paycycle'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sessionid' => 'sessionid',
            'accountid' => 'Accountid',
            'productid' => 'Productid',
            'domain' => 'Domain',
            'addons' => 'Addons',
            'paycycle' => 'paycycle',
            'datetime' => 'Datetime'
        ];
    }
}