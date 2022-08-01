<?php

namespace app\models\form;

use Yii;
use yii\base\Model;

class CustomerOrderForm extends Model
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