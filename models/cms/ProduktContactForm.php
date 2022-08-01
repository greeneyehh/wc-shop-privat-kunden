<?php

namespace app\models\cms;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ProduktContactForm extends Model
{
    public $firstname;
	public $lastname;
    public $email;
	public $tel;
    public $subject;
    public $message;
	public $yourcallback;
	public $youraccept;
	public $reCaptcha;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['firstname','lastname'], 'required'],
            [['lastname'], 'required', 'message'=>'Bitte geben Sie Ihren Nachnamen ein.'],
            [['email'], 'required', 'message'=>'Bitte geben Sie eine gültige E-Mail-Adresse ein.'],
            ['email', 'email'],
			[['produktcontactfirstname','lastname','message','email','tel','subject','yourcallback','youraccept'],'string'],
            ['reCaptcha', \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' => '6Lf8bcYUAAAAAFVB7PQ0EnkubBYfzlKmd7FHJ5kY'],
            [[ 'youraccept'], 'compare', 'compareValue' => 1, 'message'=>'Bitte bestätigen Sie unsere Datenschutzbestimmungen.'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'reCaptcha' => '',
            'email' => '',
        ];
    }

}
