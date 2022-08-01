<?php

namespace app\models\dashboard\user;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;
use yii\base\Security;
use yii\validators\UniqueValidator;

class StamdatenBankForm extends Model
{
    public $accountHolder;
    public $accountNumber;
    public $bankCode;
    public $creditInstitute;

    public function rules()
    {
        return [
            [[ 'accountHolder'], 'string','message' => 'Bitte geben Sie eine Nachricht ein.'],
            [[ 'accountNumber'], 'string','message' => 'Bitte geben Sie eine Nachricht ein.'],
            [[ 'bankCode'], 'string','message' => 'Bitte geben Sie eine Nachricht ein.'],
            [[ 'creditInstitute'], 'string','message' => 'Bitte geben Sie eine Nachricht ein.'],
        ];
    }
    public function attributeLabels()
    {
        return [

        ];
    }


}
