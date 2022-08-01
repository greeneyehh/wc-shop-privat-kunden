<?php

namespace app\models\cms;

use Yii;

/**
 * This is the model class for table "cms_news".
 *
 * @property int $id
 * @property string $titel
 * @property string $description
 * @property string $slug
 * @property string $datetime
 */
class CmsPressespiegel extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'cms_pressespiegel';
    }
    public function rules()
    {
        return [
                [['medium', 'titel', 'link'], 'required'],
            [['titel'], 'string'],
            [['datetime'], 'safe'],
            [['link'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titel' => 'Titel',
            'description' => 'Description',
            'slug' => 'Slug',
            'datetime' => 'Datetime',
        ];
    }
}

