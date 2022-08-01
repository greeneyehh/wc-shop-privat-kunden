<?php

namespace app\models\cms;

use Yii;

/**
 * This is the model class for table "shop_cancellation_terms".
 *
 * @property int $id
 * @property string $slug
 * @property string $description
 * @property string $datetime
 */
class ShopCancellationTerms extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_cancellation_terms';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['slug', 'description'], 'required'],
            [['description'], 'string'],
            [['datetime'], 'safe'],
            [['slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slug' => 'Slug',
            'description' => 'Description',
            'datetime' => 'Datetime',
        ];
    }
}