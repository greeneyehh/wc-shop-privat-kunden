<?php

namespace app\models\shop;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class PaymentPostModel extends Model
{
    public $cart;
    public $account;
    public $brand;

    public function rules()
    {
        return [
            [['cart', 'account', 'brand'], 'required'],

        ];
    }

}
