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
class kontaktForm extends Model
{
    public $id;
    public $area;
    public $subject;
    public $message;



    public function rules()
    {
        return [
            [[ 'area'], 'required','message' => 'Bitte geben Sie ein sicheres Passwort ein.'],
            [[ 'subject'], 'required','message' => 'Bitte geben Sie ein Betreff ein.'],
            [[ 'message'], 'required','message' => 'Bitte geben Sie eine Nachricht ein.'],

        ];
    }
    public function attributeLabels()
    {
        return [
            'area' =>  Yii::t('app', 'Aktuelles Passwort'),
            'subject' =>  Yii::t('app', 'Bitte geben Sie ein Betreff ein.'),
            'message' =>  Yii::t('app', 'Bitte geben Sie eine Nachricht ein.'),
        ];
    }


}
