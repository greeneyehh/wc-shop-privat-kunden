<?php

namespace app\models\logserver;

use Yii;

class vrpaymentlog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_log_vrpayment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['accountid'], 'integer'],
            [['sessionid','type', 'content', 'result','description'], 'string'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'accountid' => 'accountid',
            'type' => 'type',
            'content' => 'content',
            'result' => 'result',
        ];
    }
}
