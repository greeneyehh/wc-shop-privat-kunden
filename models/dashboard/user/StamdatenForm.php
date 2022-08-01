<?php

namespace app\models\dashboard\user;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;
use yii\base\Security;
use yii\validators\UniqueValidator;

class StamdatenForm extends Model
{
    public $billing_id;
    public $billing_version;
    public $billing_city;
    public $billing_countryCode;
    public $billing_deliveryAddress;
    public $billing_firstName;
    public $billing_invoiceAddress;
    public $billing_lastName;
    public $billing_primeAddress;
    public $billing_salutation;
    public $billing_street1;
    public $billing_zipcode;
    public $shipping_id;
    public $shipping_version;
    public $shipping_city;
    public $shipping_countryCode;
    public $shipping_deliveryAddress;
    public $shipping_firstName;
    public $shipping_invoiceAddress;
    public $shipping_lastName;
    public $shipping_primeAddress;
    public $shipping_salutation;
    public $shipping_street1;
    public $shipping_zipcode;
    public $billing_shippingAddress;

    public function rules()
    {
        return [
            [[ 'billing_id'], 'string','message' => 'Bitte geben Sie eine Nachricht ein.'],
            [[ 'billing_version'], 'string','message' => 'Bitte geben Sie eine Nachricht ein.'],
            [[ 'billing_city'], 'string','message' => 'Bitte geben Sie eine Nachricht ein.'],
            [[ 'billing_countryCode'], 'string','message' => 'Bitte geben Sie eine Nachricht ein.'],
            [[ 'billing_deliveryAddress'], 'string','message' => 'Bitte geben Sie eine Nachricht ein.'],
            [[ 'billing_firstName'], 'string','message' => 'Bitte geben Sie eine Nachricht ein.'],
            [[ 'billing_invoiceAddress'], 'string','message' => 'Bitte geben Sie eine Nachricht ein.'],
            [[ 'billing_lastName'], 'string','message' => 'Bitte geben Sie eine Nachricht ein.'],
            [[ 'billing_primeAddress'], 'string','message' => 'Bitte geben Sie eine Nachricht ein.'],
            [[ 'billing_salutation'], 'string','message' => 'Bitte geben Sie eine Nachricht ein.'],
            [[ 'billing_street1'], 'string','message' => 'Bitte geben Sie eine Nachricht ein.'],
            [[ 'billing_zipcode'], 'string','message' => 'Bitte geben Sie eine Nachricht ein.'],

            [[ 'shipping_id'], 'string','message' => 'Bitte geben Sie eine Nachricht ein.'],
            [[ 'shipping_version'], 'string','message' => 'Bitte geben Sie eine Nachricht ein.'],
            [[ 'shipping_city'], 'string','message' => 'Bitte geben Sie eine Nachricht ein.'],
            [[ 'shipping_countryCode'], 'string','message' => 'Bitte geben Sie eine Nachricht ein.'],
            [[ 'shipping_deliveryAddress'], 'string','message' => 'Bitte geben Sie eine Nachricht ein.'],
            [[ 'shipping_firstName'], 'string','message' => 'Bitte geben Sie eine Nachricht ein.'],
            [[ 'shipping_invoiceAddress'], 'string','message' => 'Bitte geben Sie eine Nachricht ein.'],
            [[ 'shipping_lastName'], 'string','message' => 'Bitte geben Sie eine Nachricht ein.'],
            [[ 'shipping_primeAddress'], 'string','message' => 'Bitte geben Sie eine Nachricht ein.'],
            [[ 'shipping_salutation'], 'string','message' => 'Bitte geben Sie eine Nachricht ein.'],
            [[ 'shipping_street1'], 'string','message' => 'Bitte geben Sie eine Nachricht ein.'],
            [[ 'shipping_zipcode'], 'string','message' => 'Bitte geben Sie eine Nachricht ein.'],
            [[ 'billing_shippingAddress'], 'string','message' => 'Bitte geben Sie eine Nachricht ein.'],
        ];
    }
    public function attributeLabels()
    {
        return [

        ];
    }


}
