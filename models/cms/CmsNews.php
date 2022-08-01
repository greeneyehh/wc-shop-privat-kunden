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
class CmsNews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titel', 'description', 'slug'], 'required'],
            [['titel', 'description'], 'string'],
            [['datetime'], 'safe'],
            [['slug'], 'string', 'max' => 250],
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
