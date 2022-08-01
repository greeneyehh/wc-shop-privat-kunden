<?php

namespace app\models\dashboard\user;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;
use yii\base\Security;
use yii\validators\UniqueValidator;
/**
 * This is the model class for table "account".
 *
 * @property int $accountid
 * @property string $old_password
 * @property string $personal_password
 * @property string $personal_passwordConfirmation
 */
class ChangePasswordForm extends Model
{
    public $accountid;
    public $old_password;
    public $personal_password;
    public $personal_passwordConfirmation;


    public function rules()
    {
        return [
            [[ 'old_password'], 'required','message' => 'Bitte geben Sie ein sicheres Passwort ein.'],
            [[ 'personal_password'], 'required','message' => 'Bitte geben Sie ein sicheres Passwort ein.'],
            [[ 'personal_passwordConfirmation'], 'required','message' => 'Bitte wiederholen Sie Ihr Passwort.'],
            ['personal_passwordConfirmation', 'compare', 'compareAttribute'=>'personal_password', 'message'=>"Passwort ist nicht gleich", 'on' => 'update' ],
       		[ 'personal_passwordConfirmation', 'compare', 'compareAttribute'=>'personal_password','message' => 'Die eingegebenen Passwörter stimmen nicht überein.'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'old_password' =>  Yii::t('app', 'Aktuelles Passwort'),
            'personal_password' =>  Yii::t('app', 'Neues Passwort'),
            'personal_passwordConfirmation' =>  Yii::t('app', 'Neues Passwort bestätigen'),
        ];
    }


}
