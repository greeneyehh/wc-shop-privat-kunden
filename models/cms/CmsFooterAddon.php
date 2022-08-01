<?php

namespace app\models\cms;

use Yii;

/**
 * This is the model class for table "cms_footer_addon".
 *
 * @property int $id
 * @property string $url
 * @property string $description
 */
class CmsFooterAddon extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_footer_addon';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url', 'description'], 'required'],
            [['description'], 'string'],
            [['url'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'description' => 'Description',
        ];
    }
}
