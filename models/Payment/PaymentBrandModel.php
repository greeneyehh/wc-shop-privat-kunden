<?php

namespace app\models\Payment;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class PaymentBrandModel extends Model
{
    public $brand;
    public $account;
    public $cart;
    public function rules()
    {
        return [
            [['brand', 'account','cart'], 'required'],

        ];
    }

}
