<?php
namespace app\models\customeroder;

use Yii;
use app\models\Product;
use yii\db\ActiveRecord;

class customervps extends \yii\db\ActiveRecord
{

    public static function tableName() {
        return 'customervps';
    }
    /**
     * @return array the validation rules.
     */

    public function rules()
    {
        return [
            [['customeroderid', 'vmid', 'accountid', 'productid','active'], 'required'],
            [['initialsetup'], 'integer']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customeroderid' => 'customeroderid',
            'vmid' => 'vmid',
            'accountid' => 'accountid',
            'productid' => 'productid',
            'active' => 'active',
            'initialsetup' => 'initialsetup',
        ];
    }



}