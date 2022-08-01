<?php

namespace app\models\cms;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
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
            [['firstname','lastname','message','email','tel','subject','yourcallback','youraccept'],'string'],
            [['firstname'], 'required', 'message'=>'Bitte geben Sie Ihren Vornamen ein.'],
            [['lastname'], 'required', 'message'=>'Bitte geben Sie Ihren Nachnamen ein.'],
            [['message'], 'required', 'message'=>'Bitte schreiben Sie uns Ihr Anliegen.'],
            [['email'], 'required', 'message'=>'Bitte geben Sie eine gültige E-Mail-Adresse ein.'],
            ['email', 'email'],
		    ['reCaptcha', \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' => '6Lfv7qcZAAAAAEbusOGo_CWw1HBGNTCKNcvmFxfC'],
            [[ 'youraccept'], 'compare', 'compareValue' => 1, 'message'=>'Bitte bestätigen Sie unsere Datenschutzbestimmungen.'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'reCaptcha' => '',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                ->setReplyTo([$this->email => $this->firstname.' '. $this->lastname])
                ->setSubject($this->subject)
                ->setTextBody($this->message)
                ->send();

            return true;
        }
        return false;
    }
}
