<?php
namespace app\models\seo;

use Yii;
use yii\base\Model;

class SeomanagerForm extends Model
{
    public $route;

    public function rules()
    {
        return [
            [[ 'route'], 'required','message' => 'Bitte geben Sie eine E-Mail-Adresse ein'],
        ];
    }

}
