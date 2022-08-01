<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\DomainCheck;
/**
 * ContactForm is the model behind the contact form.
 */
class DomainForm extends Model
{
    public $DomainExtension;
	public $HDDExtension;
	public $arryid;
	public $productid;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['DomainExtension','HDDExtension','arryid','productid'], 'string'],
            ['DomainExtension', 'required'],
            ['DomainExtension', 'validateDomainExtension'],
            ['DomainExtension','match','pattern'=>'/^(?:[a-zA-Z0-9-]+)?(?:\.[a-zA-Z0-9-]+)?(?:\.[a-zA-Z0-9-]+)?$/', 'message' => 'Ihre Wunschdomain enthält Fehler.'],
            [['DomainExtension'], 'required', 'message' => 'Bitte geben Sie hier Ihre Wunschdomain ein.'],

        ];
    }
	
	    public function attributeLabels()
    {
        return [
            'DomainExtension' => 'Domain',
        
        ];
    }
		
	public function validateDomainExtension($attribute)
	{
		$modelEvent = new DomainCheck();
		$session = Yii::$app->session;
		$tempArray = $session->get('ShoppingCart');
		$model = $modelEvent->findByDomain(trim($this->$attribute));
       // $model = DomainCheck::find()->where('domainname = "' . $this->$attribute . '" AND status != "1"')->all();
       if (isset($model) > 0 ) {
               $this->addError($attribute, 'Die von Ihnen gewählte Subdomain ist bereits vergeben');
                return false;
       //}elseif($this->DomainExtensionaArray($tempArray,'domainextension','https://'.$this->$attribute) ==true){
       }elseif(array_search($this->$attribute. ".windcloud.de", array_column($tempArray, 'domainextension'))){
                $this->addError($attribute, 'Die von Ihnen gewählte Subdomain ist bereits in Warenkorb');
                return false;
        }else{
               return true;
        }
	}




	public function DomainExtensionaArray($products, $field, $value)
	{
	   foreach($products as $key => $product)
	   {
	      if ( $product[$field] === $value ){
              return true;
          }else{
              return false;
          }

	   }

	}


}
