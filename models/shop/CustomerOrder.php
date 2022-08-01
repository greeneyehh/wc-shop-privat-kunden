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
class CustomerOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['accountid', 'productid','paycycle'], 'required'],
            [['accountid', 'productid', 'paycycle','cancellation','active'], 'integer'],
            [['datetime'], 'safe'],
            [['domain','vmos','lastpayid','lastpaybrand','payidlog','cancellationdate','lastpaydate','username','initialpasswort','activate_hash','node','vmid'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'accountid' => 'Accountid',
            'productid' => 'Productid',
            'domain' => 'Domain',
            'addons' => 'Addons',
            'node' => 'node',
            'vmos' => 'vmos',
            'vmid' => 'vmid',
            'paycycle' => 'Paycycle',
            'datetime' => 'Datetime',
            'lastpaydate' => 'lastpaydate',
            'lastpayid' => 'lastpayid',
            'lastpaybrand' => 'lastpaybrand',
            'cancellation' => 'cancellation',
            'cancellationdate' => 'cancellationdate',
            'active' => 'active',
            'username' => 'username',
            'initialpasswort' => 'initialpasswort',
            'activate_hash' => 'activate_hash',
            'payidlog' => 'payidlog',
        ];
    }
}