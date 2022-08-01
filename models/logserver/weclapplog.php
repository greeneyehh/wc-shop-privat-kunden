<?php

namespace app\models\logserver;

use Yii;

class weclapplog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_log_weclapp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sessionid','type', 'content', 'result'], 'string'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'type',
            'content' => 'content',
            'result' => 'result',
        ];
    }
}
