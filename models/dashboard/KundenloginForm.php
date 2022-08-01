<?php

namespace app\models\dashboard;

use Yii;
use yii\base\Model;
use app\models\Account;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class KundenloginForm extends Model
{
    public $personal_email;
    public $personal_password;
    public $rememberMe = true;
	public $remote_addr;
    private $_user = false;
    public function rules()
    {
        return [
            // username and password are both required
            [[ 'personal_email'], 'required','message' => 'Bitte geben Sie eine E-Mail-Adresse ein'],
            [[ 'personal_password'], 'required','message' => 'Bitte geben Sie ein Passwort ein.'],

            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            [['remote_addr'], 'string', 'max' => 250],
            // password is validated by validatePassword()
            ['personal_password', 'validatePassword'],
        ];
    }
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->personal_password)) {
                $this->addError($attribute, 'Benutzername oder Passwort ist falsch.');
			}
        }
    }
    public function login()
    {
        if ($this->validate()) {
        	return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
		if($this->hasErrors()){
			
		}
        return false;
    }

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Account::findByUsername($this->personal_email);
			
        }

        return $this->_user;
    }
}
