<?php

namespace app\models\dashboard;
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class ForgotPasswordForm extends Model
{
    public $personal_email;

    public function rules()
    {
        return [
            [[ 'personal_email'], 'required','message' => 'Bitte geben Sie eine E-Mail-Adresse ein'],
            [['personal_email'], 'email','message' => 'Bitte geben Sie eine E-Mail-Adresse ein'],
        ];
    }

}
