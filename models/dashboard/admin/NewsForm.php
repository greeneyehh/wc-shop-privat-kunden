<?php
namespace app\models\dashboard\admin;

use Yii;
use yii\base\Model;

class NewsForm extends  \yii\db\ActiveRecord
{



    public static function tableName() {
        return 'cms_news';
    }

    public function rules()
    {
        return [
            [['titel', 'description', 'slug', 'datetime'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'titel' => 'titel',
            'slug' => 'slug',
            'description' => 'description',
            'datetime' => 'datetime',
        ];
    }


}