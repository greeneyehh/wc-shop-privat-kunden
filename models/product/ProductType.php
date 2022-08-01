<?php


namespace app\models\product;



use Yii;

/**
 * This is the model class for table "shop_SlugCategory".
 *
 * @property int $id
 * @property int $productid
 * @property string $name
 * @property int $type
 */
class ProductType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['productid', 'name','type'], 'required'],
            [['productid','type'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'productid' => 'productid',
            'name' => 'name',
            'type' => 'type',
        ];
    }

    public static function findByLabel($slug)
    {
        return static::findOne(['label' => $slug]);
    }

}

