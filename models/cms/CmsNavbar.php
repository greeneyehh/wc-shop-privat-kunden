<?php

namespace app\models\cms;

use Yii;

/**
 * This is the model class for table "cms_navbar".
 *
 * @property int $id
 * @property string $linkname
 * @property string $url
 * @property int $sort
 */
class CmsNavbar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_navbar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['linkname', 'url', 'sort'], 'required'],
            [['sort','click','enabled'], 'integer'],
            [['dropdown'], 'string'],
            [['linkname', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'linkname' => 'Linkname',
            'url' => 'Url',
            'click' => 'click',
            'enabled' => 'enabled',
            'sort' => 'Sort',
        ];
    }
}
