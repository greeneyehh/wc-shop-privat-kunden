<?php

namespace app\models\cms;


use Yii;
use yii\base\Model;
use app\models\cms\CmsNewsletter;
/**
 * ContactForm is the model behind the contact form.
 */
class NewsletterForm extends Model
{
    public $email;
    public $remote_addr;
    public function rules()
    {
        return [
            [['email'], 'required', 'message' => 'Bitte geben Sie eine E-Mail-Adresse an'],
            ['email', 'validateEmail'],
            ['email', 'email'],
            [['remote_addr'], 'string', 'max' => 250],

        ];
    }
    public function validateEmail($attribute)
    {
        $modelEvent = new CmsNewsletter();
        $model = $modelEvent->findByMail($this->$attribute);
        if (isset($model) > 0) {
            $this->addError($attribute, 'diese e-mail-adresse wird bereits verwendet');

        }

    }
    public function attributeLabels()
    {
        return [
            'email' => 'email',
            'remote_addr'=> 'ip',
        ];
    }



}
