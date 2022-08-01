<?php
namespace app\models;

use Yii;
use app\models\Product;
use yii\db\ActiveRecord;

class Sepamandate extends \yii\db\ActiveRecord
{

    public static function tableName() {
        return 'product_addons';
    }
    /**
     * @return array the validation rules.
     */

    public function rules()
    {
        return [
            [['value', 'name'], 'required'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'value',
            'name' => 'name',
            'preis' => 'preis',
        ];
    }



}