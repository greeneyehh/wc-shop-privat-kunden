<?php
namespace app\models\dashboard\user;
use Yii;

class Stammdatenbilling_shippingAddressDB extends \yii\db\ActiveRecord
{

    public static function tableName()
{
    return 'account';
}

    public function rules()
{
    return [
        [['billing_shippingAddress'], 'string'],

    ];
}

    public function attributeLabels()
{
    return [
        'id' => 'ID',
        'billing_shippingAddress' => 'Titel',
    ];
}
}