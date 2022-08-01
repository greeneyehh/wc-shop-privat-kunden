<?php

namespace app\models\form;

use Yii;
use yii\base\Model;

class ColocationForm extends Model
{

    public $name;
    public $email;
    public $company;
    public $phone;
    public $message;
    public $racks;
    public $bandwidth;
    public $dsgvo;
    public $migration;
    public $side;

    public function rules()
    {
        return [
            [['name'], 'required','message'=>'Bitte geben Sie einen Vornamen und Namen an.'],
            [['email'], 'required','message'=>'Bitte geben Sie eine E-Mail-Adresse an.'],
            [['company'], 'required','message'=>'Bitte geben Sie einen Firmennamen an.'],
            [['racks'], 'required','message'=>'Bitte geben Sie eine Anzahl der Racks an.'],
            [['bandwidth'], 'required','message'=>'Bitte geben Sie eine Bandbreite an.'],
            [['phone','message'], 'string'],
            [['migration'], 'integer'],
            [['side'], 'string'],
            [['email'], 'email'],
            [['dsgvo'], 'boolean','strict' => true],


        ];
    }
    public function attributeLabels()
    {
        return [
            'name' => 'Vorname, Name',
            'email' => 'E-Mail',
            'company' => 'Firma',
            'phone' => 'Telefon',
            'message' => 'Nachricht',
            'racks' => 'Anzahl Racks',
            'bandwidth' => 'Bandbreite',
            'migration' => 'Migration',
            'dsgvo' => 'DSGVO',
            'side' => 'side',
        ];
    }
}