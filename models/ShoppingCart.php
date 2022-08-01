<?php
namespace app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\base\BaseObject;
use  yii\web\Session;
class ShoppingCart extends BaseObject 
{
	 public function init()
	{
		$session = Yii::$app->session;
		$session->open();
	}
    
	private $ProductName;
	private $ProductDescription;
  	private $ProductPrice;
  	private $ProductAddons;
	private $ProductHDDExtension;

	public function getProductName()
	{
		return $session->get('ProductName');

	}
	
	public function setProductName($value)
	{
		
		$session->set('ProductName',$value);

	}	
		
	public function getProductDescription()
	{
	    return $session->get('ProductDescription');
	}
	
	public function setProductDescription($value)
	{
	    $session->set('ProductDescription',$value);
	}	
		
	public function getProductPrice()
	{
	    return $session->get('ProductPrice');
	}
	
	public function setProductPrice($value)
	{
	    $session->set('ProductPrice',$value);
	}
			
	public function getProductAddons()
	{
	    return $session->get('ProductAddons');
	}
	
	public function setProductAddons($value)
	{
	    $session->set('ProductAddons',$value);
	}
	
		public function getProductHDDExtension()
	{
		return $session->get('ProductHDDExtension');

	}
	
	public function setProductHDDExtension($value)
	{
		
		$session->set('ProductHDDExtension',$value);

	}	
	
	
	
	public function beforeSave($insert)
	{
		return parent::beforeSave($insert);
	}
}