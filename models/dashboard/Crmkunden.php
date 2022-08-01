<?php

namespace app\models\dashboard;

use Yii;

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
 * @property string $personal_birthday_day
 * @property string $personal_birthday_month
 * @property string $personal_birthday_year
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
 * @property string $personal_dpacheckbox
 * @property string $authKey
 * @property string $accessToken
 * @property string $remote_addr
 * @property int $right
 */
class Crmkunden extends \yii\db\ActiveRecord
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
            [['personal_customer_type', 'personal_salutation', 'personal_firstname', 'personal_lastname', 'personal_email', 'personal_password', 'personal_passwordConfirmation', 'personal_phone', 'personal_birthday_day', 'personal_birthday_month', 'personal_birthday_year', 'billing_company', 'billing_department', 'billing_vatId', 'billing_street', 'billing_additionalAddressLine1', 'billing_zipcode', 'billing_city', 'billing_country', 'billing_shippingAddress', 'shipping_salutation', 'shipping_company', 'shipping_department', 'shipping_firstname', 'shipping_lastname', 'shipping_street', 'shipping_additionalAddressLine1', 'shipping_zipcode', 'shipping_city', 'shipping_country', 'remote_addr'], 'required'],
            [['right'], 'integer'],
            [['personal_customer_type', 'personal_salutation', 'personal_firstname', 'personal_lastname', 'personal_email', 'personal_password', 'personal_passwordConfirmation', 'personal_phone', 'personal_birthday_day', 'personal_birthday_month', 'personal_birthday_year', 'billing_company', 'billing_department', 'billing_vatId', 'billing_street', 'billing_additionalAddressLine1', 'billing_zipcode', 'billing_city', 'billing_country', 'billing_shippingAddress', 'shipping_salutation', 'shipping_company', 'shipping_department', 'shipping_firstname', 'shipping_lastname', 'shipping_street', 'shipping_additionalAddressLine1', 'shipping_zipcode', 'shipping_city', 'shipping_country', 'authKey', 'remote_addr'], 'string', 'max' => 255],
            [['personal_dpacheckbox'], 'string', 'max' => 10],
            [['accessToken'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'accountid' => 'Accountid',
            'personal_customer_type' => 'Personal Customer Type',
            'personal_salutation' => 'Personal Salutation',
            'personal_firstname' => 'Personal Firstname',
            'personal_lastname' => 'Personal Lastname',
            'personal_email' => 'Personal Email',
            'personal_password' => 'Personal Password',
            'personal_passwordConfirmation' => 'Personal Password Confirmation',
            'personal_phone' => 'Personal Phone',
            'personal_birthday_day' => 'Personal Birthday Day',
            'personal_birthday_month' => 'Personal Birthday Month',
            'personal_birthday_year' => 'Personal Birthday Year',
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
            'personal_dpacheckbox' => 'Personal Dpacheckbox',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'remote_addr' => 'Remote Addr',
            'right' => 'Right',
        ];
    }
}