<?php
namespace app\models\dashboard;

use Yii;
use yii\base\Model;

class ShopProductFormDB extends Model 
{

	public $ProductId;
	public $name;
   	public $description;
  	public $price;
  	public $addons;
	public $tax;
	
    public function rules()
    {
        return [
			[['ProductId','price','tax'], 'integer'],
			[['name', 'description', 'tax', 'price'], 'required'],
			[['name','description','addons'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'ProductId' => 'ID',
            'name' => 'name',
            'description' => 'description',
            'price' => 'price',
            'addons' => 'addons',    
            'tax'=>'tax',        
        ];
    }

	
}