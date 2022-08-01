<?php

namespace app\models\logserver;

use Yii;

class nextcloudlog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_log_nextcloud';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sessionid','type','postfiels', 'content', 'result'], 'string'],

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
