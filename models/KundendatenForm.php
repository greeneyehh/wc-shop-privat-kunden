<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class KundendatenForm extends Model
{
	public $firma;
	public $apname;
	public $aplastname;
	public $street;
	public $streetnumber;
	public $plz;
	public $ort;
	public $email;
	public $phonenumber;
	public $website;
	public $awapname;
	public $awaplastname;
	public $awstreet;
	public $awstreetnumber;
	public $awplz;
	public $awort;
	public $awemail;
	public $awphonenumber;
	public $invoice_address_deviating;
    public function rules()
    {
		
		
        return [
			[['firma'], 'required' ,'message'=>'Bitte Geben Sie einen Firmennamen an'],
			[['apname'], 'required' ,'message'=>'Namen des ansprechpartners an'],
			[['aplastname'], 'required' ,'message'=>'Nachnamen des ansprechpartners an'],
			[['email'], 'required' ,'message'=>'Bitte Geben Sie eine E-mail adresse an'],
            [['street'], 'required' ,'message'=>'Bitte Geben Sie den strassen namen an'],
			[['streetnumber'], 'required' ,'message'=>'Bitte Geben Sie die Hausnummer an'],
			[[ 'plz'], 'required' ,'message'=>'Bitte Geben Sie die Postleitzahl an'],
			[[ 'ort'], 'required' ,'message'=>'Bitte Geben Sie den Ort an'],
			[[ 'phonenumber'], 'required' ,'message'=>'Bitte Geben sie eine Rufnummer an'],
			[['plz','phonenumber'], 'integer'],
            [['invoice_address_deviating'], 'integer'],
            [['streetnumber','street'], 'string'],
            ['email', 'email', 'message' => 'Bitte geben sie eine E-mail Adressen'],
            
			
			
			
			[['awapname'], 'string' ,'message'=>'Namen des ansprechpartners an'],
			[['awaplastname'], 'string' ,'message'=>'Nachnamen des ansprechpartners an'],
			[['awemail'], 'string' ,'message'=>'Bitte Geben Sie eine E-mail adresse an'],
            [['awstreet'], 'string' ,'message'=>'Bitte Geben Sie den strassen namen an'],
			[['awstreetnumber'], 'string' ,'message'=>'Bitte Geben Sie die Hausnummer an'],
			[[ 'awplz'], 'integer' ,'message'=>'Bitte Geben Sie die Postleitzahl an'],
			[[ 'awort'], 'string' ,'message'=>'Bitte Geben Sie den Ort an'],
			[[ 'awphonenumber'], 'integer' ,'message'=>'Bitte Geben sie eine Rufnummer an'],
			['awemail', 'email', 'message' => 'Bitte geben sie eine E-mail Adressen'],
			

        ];
    }
    public function attributeLabels()
    {
        return [
             'email' =>  Yii::t('app', 'Bitte geben sie eine E-mail Adressen'),
        ];
    }
}
