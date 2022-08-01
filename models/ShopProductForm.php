<?php
namespace app\models;

use Yii;
use yii\base\Model;

class ShopProductForm extends Model 
{

	public $ProductId;
	//public $name;
   	//public $description;
  	//public $price;
  	//public $addons;
	
    public function rules()
    {
        return [
			[['ProductId','price'], 'integer'],
			[['name','description','addons','HDDExtension'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'ProductId' => 'ID',
          //  'name' => 'name',
          //  'description' => 'description',
          //  'price' => 'price',
          //  'addons' => 'addons',            
        ];
    }

	
}