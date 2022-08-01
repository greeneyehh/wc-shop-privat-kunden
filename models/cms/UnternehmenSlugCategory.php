<?php


namespace app\models\cms;



use Yii;

/**
 * This is the model class for table "shop_SlugCategory".
 *
 * @property int $id
 * @property string $label
 * @property int $categoryid
 * @property int $views
 */
class UnternehmenSlugCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unternehmen_SlugCategory';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['label', 'categoryid'], 'required'],
            [['categoryid'], 'integer'],
            [['label' ,'views'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'label' => 'Label',
            'categoryid' => 'Categoryid',
            'views' => 'views',
        ];
    }

    public static function findByLabel($slug)
    {
        return static::findOne(['label' => $slug]);
    }

}

