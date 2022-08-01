<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class PaymentForm extends Model
{
	public $paidcycle;
	public $payment;

    public function rules()
    {
        return [
            [['paidcycle', 'payment'], 'required'],

        ];
    }

}
