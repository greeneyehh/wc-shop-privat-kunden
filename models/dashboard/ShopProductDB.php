<?php
namespace app\models\dashboard;
use Yii;
use yii\base\Model;

class ShopProductDB extends Model 
{

	public $name;
   	public $description;
  	public $price;
	public $tax;
  	public $addons;
	
    public function rules()
    {
        return [
			[['price','tax'], 'integer'],
			[['name','description','addons'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'name',
            'description' => 'description',
            'price' => 'price',
            'tax' => 'tax',
            'addons' => 'addons',            
        ];
    }

	
}