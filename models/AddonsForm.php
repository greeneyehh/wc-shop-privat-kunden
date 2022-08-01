<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class AddonsForm extends Model
{
    public $HDDExtension;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['HDDExtension'], 'string'],

        ];
    }

}
