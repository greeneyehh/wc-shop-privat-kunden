<?php

namespace app\models\dashboard;

use Yii;
use yii\base\Model;
use app\models\DomainCheck;
/**
 * ContactForm is the model behind the contact form.
 */
class RechnungKategorieForm extends Model
{
    public $RechnungKategorie;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['RechnungKategorie'], 'string'],
              [['RechnungKategorie'], 'required', 'message' => 'Bitte geben eine Kategorie an'],

        ];
    }
	
	    public function attributeLabels()
    {
        return [
            'RechnungKategorie' => 'ID',
        
        ];
    }
		



}
