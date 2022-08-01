<?php
namespace app\models;

use Yii;
use app\models\Product;
use yii\db\ActiveRecord;
use yii\base\Model;

class ShopProductForm extends Model 
{

	public $id;
	public $name;
   	public $description;
  	public $price;
  	public $addons;
	
    public static function tableName()
    {
        return 'product';
    }

    public function rules()
    {
        return [
        [['id','price'], 'integer'],
          [['name','description','addons'], 'string'],
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
	
	public function getId() {
    	return $this->id;
	}
	public static function findById($id) {
    	$user = self::find()
            ->where([
                "id" => $id
            ])
            ->one();
	    if (!count($user)) {
	        return null;
	    }
  	  return $user;
	}
	
}