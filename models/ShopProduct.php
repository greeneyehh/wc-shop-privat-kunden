<?php
namespace app\models;

use Yii;
use app\models\Product;
use yii\db\ActiveRecord;

class ShopProduct extends \yii\db\ActiveRecord 
{

	public static function tableName() {
		 return 'shop_product'; 
	}
    /**
     * @return array the validation rules.
     */
    
    public function rules()
    {
        return [
              [['price','name','description','addons'], 'required'],
        ];
    }

    public function attributeLabels()
    {
 		return [
            'id' => 'ID',
            'name' => 'name',
            'description' => 'description',
            'price' => 'price',
            'addons' => 'addons',
        ];
    }
	  public static function primaryKey()
  {
    return array('id');
  }
public static function findById($id) {
    $product = self::find()
            ->where([
                "id" => $id
            ])
            ->one();
    return $product;
}
	
}