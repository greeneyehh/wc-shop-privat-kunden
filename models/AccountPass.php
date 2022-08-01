<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;
use yii\base\Security;
use yii\validators\UniqueValidator;
/**
 * This is the model class for table "account".
 *
 * @property int $accountid
 * @property string $personal_customer_type
 * @property string $personal_salutation
 * @property string $personal_firstname
 * @property string $personal_lastname
 * @property string $personal_email
 * @property string $personal_password
 * @property string $personal_passwordConfirmation
 * @property string $personal_phone
 * @property string $billing_company
 * @property string $billing_department
 * @property string $billing_vatId
 * @property string $billing_street
 * @property string $billing_additionalAddressLine1
 * @property string $billing_zipcode
 * @property string $billing_city
 * @property string $billing_country
 * @property string $billing_shippingAddress
 * @property string $shipping_salutation
 * @property string $shipping_company
 * @property string $shipping_department
 * @property string $shipping_firstname
 * @property string $shipping_lastname
 * @property string $shipping_street
 * @property string $shipping_additionalAddressLine1
 * @property string $shipping_zipcode
 * @property string $shipping_city
 * @property string $shipping_country
 * @property string $authKey
 * @property string $accessToken
 * @property string $deleteToken
 * @property string $forgotpasswordtime
 * @property string $deletetime
 * @property string $remote_addr
 * @property int $right
 */
class AccountPass extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'account';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
          	[['personal_email'], 'email'],
          	[['personal_email'], 'validateUsername'],
          	[['personal_email'], 'unique'],
			[['personal_email', 'personal_passwordConfirmation', 'forgotpasswordtime','authKey'], 'string', 'max' => 255],
            [['accessToken','authKey','remote_addr' ,'shipping_department','forgotpasswordtime','deletetime'], 'string', 'max' => 250],
            ['personal_password','match','pattern'=>'/((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20})/', 'message' => 'Das Passwort muss mindestens 8 und maximal 20 Zeichen lang sein, Groß- und Kleinbuchstaben sowie mindestens eine Ziffer enthalten.'],
            ['personal_passwordConfirmation', 'compare', 'compareAttribute'=>'personal_password', 'message'=>"Passwort ist nicht gleich", 'on' => 'update' ],
       		[ 'personal_passwordConfirmation', 'compare', 'compareAttribute'=>'personal_password','message' => 'Die eingegebenen Passwörter stimmen nicht überein.'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
        
            'accountid' => 'Accountid',
            'personal_email' => 'Bitte geben Sie eine gültige E-Mail-Adresse ein.',
            'personal_password' => 'Personal Password',
            'personal_passwordConfirmation' => 'Personal Password Confirmation',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'deleteToken' => 'Delete Token',
            'forgotpasswordtime' => 'forgotpasswordtime',
        ];
    }


    public static function findIdentity($id)
    {
  		return static::findOne($id);
    }


    public static function findIdentityByAccessToken($token, $type = null)
    {
		return static::findOne(['accessToken' => $token]);
    }

    public static function findByUsername($personal_email)
    {
		return static::findOne(['personal_email' => $personal_email]);
    }
	
    public static function findByPasswordResetToken($token)
    {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token
        ]);
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }
    public function validateUsername($personal_email)
    {
        if(static::find()->where(['personal_email'=>$personal_email])->exists())
        {
            $this->addError('personal_email','Username already exists.');
        }
    }


public function validateAuthKey($authKey)
    {
    	return $this->authKey === $authKey;
    }


    public function validatePassword($personal_password)
    {
    	//return $this->password === md5($password);
        return $this->personal_password ===  \Yii::$app->params['pwfrontsalt'] .md5($personal_password).\Yii::$app->params['pwbacksalt'] ;
    }

	 /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Security::generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Security::generateRandomKey(32);
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Security::generateRandomKey() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }



}
