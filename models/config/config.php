<?php

namespace app\models\config;

use Yii;

class config extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_config';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','variable'], 'string'],

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
            'variable' => 'variable',
        ];
    }
}
