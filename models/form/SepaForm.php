<?php

namespace app\models\form;

use Yii;
use yii\base\Model;

class SepaForm extends Model
{

    public $holder;
    public $IBAN;
   // public $recurring;


    public function rules()
    {
        return [
            [['holder'], 'required','message'=>'Bitte geben Sie den Kontoinhaber an.'],
            [['IBAN'], 'required','message'=>'Bitte geben Sie eine gültige IBAN an.'],
            //[['recurring'], 'required','message'=>'Bitte Geben Sie einen Firmen Namen an'],
            ['IBAN','match','pattern'=>'/^[DE]{2}([0-9a-zA-Z]{20})$/', 'message' => 'Ihre IBAN enthält Fehler.'],


            //[A-Z]{2}\d{2} ?\d{4} ?\d{4} ?\d{4} ?\d{4} ?[\d]{0,2}
        ];
    }
    public function attributeLabels()
    {
        return [
            'holder' => 'Vorname, Name',
            'surname' => 'E-Mail',
            'IBAN' => 'Firma',
         //   'recurring' => 'Telefon',
        ];
    }
}