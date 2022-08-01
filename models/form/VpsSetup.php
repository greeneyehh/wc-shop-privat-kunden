<?php

namespace app\models\form;

use Yii;
use yii\base\Model;

class VpsSetup extends Model
{

    public $passwort;
    public $passwortConfirmation;
    public $sshkey;


    public function rules()
    {
        return [
            [['passwort'], 'required','message'=>'Bitte geben Sie Ein Passwort Für ihren Virtuellen Server an.'],
            [[ 'passwortConfirmation'], 'required','message' => 'Bitte wiederholen Sie Ihr Passwort.'],
            [['sshkey'], 'string','message'=>'Bitte geben Sie Ein Public-Key-Authentifizierung Für ihren Virtuellen Server an.'],
            ['passwort','match','pattern'=>'/((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20})/', 'message' => 'Das Passwort muss mindestens 8 und maximal 20 Zeichen lang sein, Groß- und Kleinbuchstaben sowie mindestens eine Ziffer enthalten.'],
            ['passwortConfirmation', 'compare', 'compareAttribute'=>'passwort', 'message'=>"Passwort ist nicht gleich", 'on' => 'update' ],
            [ 'passwortConfirmation', 'compare', 'compareAttribute'=>'passwort','message' => 'Die eingegebenen Passwörter stimmen nicht überein.'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'Passwort' => 'Passwort',
            'sshkey' => 'sshkey',
        ];
    }
}
