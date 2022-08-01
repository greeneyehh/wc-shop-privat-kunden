<?php

namespace app\models\cms;
use Yii;

/**
 * This is the model class for table "shop_terms_of_service".
 *
 * @property int $id
 * @property string $slug
 * @property string $description
 * @property string $datetime
 */
class ShopCustomerInformation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_customer_information';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'slug', 'description'], 'required'],
            [['id'], 'integer'],
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