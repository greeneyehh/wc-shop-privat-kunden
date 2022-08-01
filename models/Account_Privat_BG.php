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
 * @property string $personal_dataprotection
 * @property string $personal_dpacheckbox
 * @property string $authKey
 * @property string $accessToken
 * @property string $deleteToken
 * @property string $forgotpasswordtime
 * @property string $deletetime
 * @property string $remote_addr
 * @property int $right
 */
class Account extends ActiveRecord implements IdentityInterface
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
            [['right'], 'integer'],
            [['personal_phone'], 'integer'],
            [[ 'personal_customer_type'], 'required','message' => 'Bitte geben Sie an, ob Sie als Firma oder Privatkunde bestellen möchten.'],
            [[ 'personal_salutation'], 'required','message' => 'Bitte geben Sie Ihre Anrede an.'],
            [[ 'personal_firstname'], 'required','message' => 'Bitte geben Sie Ihren Vornamen ein.'],
            [[ 'personal_lastname'], 'required','message' => 'Bitte geben Sie Ihren Nachnamen ein.'],
            [[ 'personal_phone'], 'required','message' => 'Bitte geben Sie eine gültige Telefonnummer ein.'],
            [[ 'personal_email'], 'required','message' => 'Bitte geben Sie eine gültige E-Mail-Adresse ein.'],
            [[ 'personal_password'], 'required','message' => 'Bitte geben Sie ein sicheres Passwort ein.'],
            [[ 'personal_passwordConfirmation'], 'required','message' => 'Bitte wiederholen Sie Ihr Passwort.'],
            [[ 'billing_street'], 'required','message' => 'Bitte geben Sie Ihre Straße und Hausnummer ein.'],
			[[ 'billing_zipcode'], 'required','message' => 'Bitte geben Sie Ihre Postleitzahl ein.'],
			[[ 'billing_city'], 'required','message' => 'Bitte geben Sie Ihre Stadt ein.'],
			[[ 'billing_country'], 'required','message' => 'Bitte geben Sie Ihr Land an.'],
			[['billing_company'], 'required','message' => 'Bitte geben Sie Ihre Firma ein.',
            'when' => function($model) { return $model->personal_customer_type == 'ORGANIZATION';},
              'whenClient' => "function (attribute, value) {
              	return $('#account-personal_customer_type').val() == 'ORGANIZATION';
            }"],
			[['billing_vatId'], 'required','message' => 'Bitte geben Sie Ihre Umsatzsteuer-ID ein.',
            'when' => function($model) { return $model->personal_customer_type == 'ORGANIZATION';},
              'whenClient' => "function (attribute, value) {
              	return $('#account-personal_customer_type').val() == 'ORGANIZATION';
            }"],
			[['shipping_salutation'], 'required','message' => 'Bitte geben Sie Ihre Anrede an.',
            'when' => function($model) { return $model->billing_shippingAddress == 'true' ;},
              'whenClient' => "function (attribute, value) {
              	return $('#account-billing_shippingaddress').is(':checked') == true;
            }"],
			[['shipping_firstname'], 'required','message' => 'Bitte geben Sie Ihren Vornamen ein.',
            'when' => function($model) { return $model->billing_shippingAddress == 'true' ;},
              'whenClient' => "function (attribute, value) {
              	return $('#account-billing_shippingaddress').is(':checked') == true;
            }"],
			[['shipping_lastname'], 'required','message' => 'Bitte geben Sie Ihren Nachnamen ein.',
            'when' => function($model) { return $model->billing_shippingAddress == 'true' ;},
              'whenClient' => "function (attribute, value) {
              	return $('#account-billing_shippingaddress').is(':checked') == true;
            }"],
			[['shipping_street'], 'required','message' => 'Bitte geben Sie Ihre Straße und Hausnummer ein.',
            'when' => function($model) { return $model->billing_shippingAddress == 'true' ;},
              'whenClient' => "function (attribute, value) {
              	return $('#account-billing_shippingaddress').is(':checked') == true;
            }"],
			[['shipping_zipcode'], 'required','message' => 'Bitte geben Sie Ihre Postleitzahl ein.',
            'when' => function($model) { return $model->billing_shippingAddress == 'true' ;},
              'whenClient' => "function (attribute, value) {
              	return $('#account-billing_shippingaddress').is(':checked') == true;
            }"],
			[['shipping_city'], 'required','message' => 'Bitte geben Sie Ihre Stadt ein.',
            'when' => function($model) { return $model->billing_shippingAddress == 'true' ;},
              'whenClient' => "function (attribute, value) {
              	return $('#account-billing_shippingaddress').is(':checked') == true;
            }"],
			[['shipping_country'], 'required','message' => 'Bitte geben Sie Ihr Land an.',
            'when' => function($model) { return $model->billing_shippingAddress == 'true' ;},
              'whenClient' => "function (attribute, value) {
              	return $('#account-billing_shippingaddress').is(':checked') == true;
            }"],
          	[['personal_email'], 'email'],
          	[['personal_email'], 'validateUsername'],
            [['personal_dpacheckbox'], 'boolean','strict' => true],
            [['personal_dataprotection'], 'boolean','strict' => true],
			[['personal_customer_type', 'personal_salutation','personal_firstname', 'personal_lastname', 'personal_email', 'personal_password', 'personal_passwordConfirmation', 'personal_phone', 'billing_company', 'billing_department', 'billing_vatId', 'billing_street', 'billing_additionalAddressLine1', 'billing_zipcode', 'billing_city', 'billing_country', 'billing_shippingAddress', 'shipping_salutation', 'shipping_company', 'shipping_department', 'shipping_firstname', 'shipping_lastname', 'shipping_street', 'shipping_additionalAddressLine1', 'shipping_zipcode', 'shipping_city', 'shipping_country', 'authKey'], 'string', 'max' => 255],
            [['accessToken', 'deleteToken','authKey','remote_addr' ,'shipping_department','forgotpasswordtime','deletetime'], 'string', 'max' => 250],
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
            'personal_customer_type' => 'Bitte geben Sie an, ob Sie als Firma oder Privatkunde bestellen möchten.',
            'personal_salutation' => 'Bitte geben Sie Ihre Anrede an.',
            'personal_firstname' => 'Bitte geben Sie Ihren Vornamen ein.',
            'personal_lastname' => 'Bitte geben Sie Ihren Nachnamen ein.',
            'personal_email' => 'Bitte geben Sie eine gültige E-Mail-Adresse ein.',
            'personal_password' => 'Personal Password',
            'personal_passwordConfirmation' => 'Personal Password Confirmation',
            'personal_phone' => 'Bitte geben Sie eine gültige Telefonnummer ein.',
            'billing_company' => 'Billing Company',
            'billing_department' => 'Billing Department',
            'billing_vatId' => 'Billing Vat ID',
            'billing_street' => 'Billing Street',
            'billing_additionalAddressLine1' => 'Billing Additional Address Line1',
            'billing_zipcode' => 'Billing Zipcode',
            'billing_city' => 'Billing City',
            'billing_country' => 'Billing Country',
            'billing_shippingAddress' => 'Billing Shipping Address',
            'shipping_salutation' => 'Shipping Salutation',
            'shipping_company' => 'Shipping Company',
            'shipping_department' => 'Shipping Department',
            'shipping_firstname' => 'Shipping Firstname',
            'shipping_lastname' => 'Shipping Lastname',
            'shipping_street' => 'Shipping Street',
            'shipping_additionalAddressLine1' => 'Shipping Additional Address Line1',
            'shipping_zipcode' => 'Shipping Zipcode',
            'shipping_city' => 'Shipping City',
            'shipping_country' => 'Shipping Country',
            'personal_dataprotection' => 'Personal Dpacheckbox',
            'personal_dpacheckbox' => 'Personal Dpacheckbox',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'deleteToken' => 'Delete Token',
            'forgotpasswordtime' => 'forgotpasswordtime',
            'deletetime' => 'deletetime',
            'right' => 'Right',
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
