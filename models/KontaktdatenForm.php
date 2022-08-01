<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class KontaktdatenForm extends Model
{
	
	
	
	public $street;
	public $streetnumber;
	public $plz;
	public $ort;
	public $email;
	public $phonenumber;
	public $website;


    public function rules()
    {
        return [
            [['email'], 'required' ,'message'=>'Bitte Geben Sie eine E-mail adresse an'],
            [['street'], 'required' ,'message'=>'Bitte Geben Sie den strassen namen an'],
			[['streetnumber'], 'required' ,'message'=>'Bitte Geben Sie die Hausnummer an'],
			[[ 'plz'], 'required' ,'message'=>'Bitte Geben Sie die Postleitzahl an'],
			[[ 'ort'], 'required' ,'message'=>'Bitte Geben Sie den Ort an'],
			[[ 'phonenumber'], 'required' ,'message'=>'Bitte Geben sie eine Rufnummer an'],
			
            [['plz','phonenumber'], 'integer'],
            [['streetnumber','street'], 'string'],
            ['email', 'email', 'message' => 'Bitte geben sie eine E-mail Adressen'],

        ];
    }
    public function attributeLabels()
    {
        return [
             'email' =>  Yii::t('app', 'Bitte geben sie eine E-mail Adressen'),
        ];
    }
}
