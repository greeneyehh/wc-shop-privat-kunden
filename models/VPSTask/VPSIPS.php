<?php

namespace app\models\VPSTask;

use Yii;


class VPSIPS extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ip_pool';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ip','vmid','accountid'], 'string'],
            [['status'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ip' => 'ip',
            'vmid' => 'vmid',
            'accountid' => 'accountid',
            'status' => 'status',
        ];
    }
}