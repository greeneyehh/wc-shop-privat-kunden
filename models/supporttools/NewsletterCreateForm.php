<?php

namespace app\models\supporttools;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class NewsletterCreateForm extends Model
{
	
	
	
	public $to;
	public $subject;
	public $content;



    public function rules()
    {
        return [
            [['to'], 'email' ,'message'=>'Bitte Geben Sie eine E-mail adresse an'],
            [['subject'], 'email' ,'message'=>'Bitte Geben Sie den strassen namen an'],
            [['content'], 'string'],


        ];
    }
    public function attributeLabels()
    {
        return [
             'email' =>  Yii::t('app', 'Bitte geben sie eine E-mail Adressen'),
        ];
    }
}
