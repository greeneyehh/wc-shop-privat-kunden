<?php

namespace app\models\shop;

use Yii;

class ShoppingCart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ShoppingCart';
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
            'extensionallowed' => 'extensionallowed',
            'price' => 'price',
            'weclapp' => 'weclapp',
            'domainextension' => 'domainextension',
            'name' => 'name',
            'type' => 'type',
            'addon' => 'addon'
        ];
    }
}