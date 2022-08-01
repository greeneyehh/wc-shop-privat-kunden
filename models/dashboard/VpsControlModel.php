<?php

namespace app\models\dashboard;

use Yii;
use yii\base\Model;
/**
 * ContactForm is the model behind the contact form.
 */
class VpsControlModel extends Model
{
    public $value;
    public $snapshotname;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['snapshotname'], 'string'],
            [['value'], 'required', 'message' => 'Bitte geben eine Kategorie an'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'value' => 'value',
            'snapshotname' => 'snapshotname',

        ];
    }




}