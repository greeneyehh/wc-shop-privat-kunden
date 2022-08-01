<?php

namespace app\models\dashboard\user;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class KontodeleteForm extends Model
{
    public $accountid;
    public $delcheck;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['accountid'], 'required'],
            [[ 'delcheck'], 'compare', 'compareValue' => 1, 'message'=>'You have to check this checkbox'],
        ];
    }

}
