<?php
namespace app\models;

use Yii;
use app\models\Product;
use yii\db\ActiveRecord;

class DomainCheck extends \yii\db\ActiveRecord 
{

	public static function tableName() {
		 return 'shop_domain'; 
	}
    /**
     * @return array the validation rules.
     */
    
    public function rules()
    {
        return [
              [['domainname'], 'required'],
        ];
    }

    public function attributeLabels()
    {
 		return [
            'domainname' => 'domainname',
        ];
    }
	  public static function primaryKey()
  {
    return array('id');
  }
public static function findByDomain($domainname) {
    $product = self::find()
            ->where([
                "domainname" => $domainname
            ])
            ->one();

    return $product;
}
	
}