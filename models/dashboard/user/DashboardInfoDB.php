<?php
namespace app\models\dashboard\user;
use Yii;

class DashboardInfoDB extends \yii\db\ActiveRecord
{

    public static function tableName()
{
    return 'dashboard_info';
}

    public function rules()
{
    return [
        [['titel', 'description', 'datum','type'], 'required'],
        [['description'], 'string'],
        [['datum'], 'safe'],
        [['titel','type'], 'string', 'max' => 255],
    ];
}

    public function attributeLabels()
{
    return [
        'id' => 'ID',
        'titel' => 'Titel',
        'description' => 'Description',
        'type' => 'type',
        'datum' => 'Datum',
    ];
}
}