<?php
namespace app\models;

use Yii;
use app\models\Product;
use yii\db\ActiveRecord;

class DomainCheck extends \yii\db\ActiveRecord 
{

	public static function tableName() {
		 return 'customer_order';
	}

    public function rules()
    {
        return [
              [['domain'], 'required'],
        ];
    }

    public function attributeLabels()
    {
 		return [
            'domain' => 'domain',
        ];
    }
	  public static function primaryKey()
  {
    return array('id');
  }
public static function findByDomain($domainname) {
    $product = self::find()
            ->where([
                "domain" => 'https://'.trim($domainname).'.windcloud.de'
            ])
            ->one();

    return $product;
}
	
}