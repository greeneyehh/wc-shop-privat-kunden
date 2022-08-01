<?php

namespace app\models\config;

use Yii;

class vrpaybrandsconfig extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_vr_pay_brands_config';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','entityId','image', 'status'], 'string'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'name',
            'entityId' => 'entityId',
            'image' => 'image',
            'status' => 'status',
        ];
    }
}
