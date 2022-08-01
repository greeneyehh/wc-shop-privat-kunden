<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\DomainCheck;
/**
 * ContactForm is the model behind the contact form.
 */
class OsForm extends Model
{
    public $OSSystem;
	public $arryid;
	public $productid;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
           [['OSSystem','arryid','productid'], 'string'],
/*             ['DomainExtension', 'required'],
            ['DomainExtension', 'validateDomainExtension'],
            ['DomainExtension','match','pattern'=>'/^(?:[a-zA-Z0-9]+)?(?:\.[a-zA-Z0-9]+)?(?:\.[a-zA-Z0-9]+)?$/', 'message' => 'Ihre Wunschdomain enthält Fehler.'],
            [['DomainExtension'], 'required', 'message' => 'Bitte geben Sie hier Ihre Wunschdomain ein.'],
*/
        ];
    }
	
	    public function attributeLabels()
    {
        return [
            'OSSystem' => 'OSSystem',
        
        ];
    }



}
