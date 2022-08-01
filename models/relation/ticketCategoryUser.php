<?php
namespace app\models\relation;
use Yii;
use yii\base\Model;

class ticketCategoryUser extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'relation_ticketCategory_assignedUser';
    }

    public function rules()
    {
        return [
            [['ticketCategoryId','assignedUserId'], 'integer'],
            [['firstName','lastName','username'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ticketCategoryId' => 'ticketCategoryId',
            'firstName' => 'firstName',
            'lastName' => 'lastName',
            'username' => 'username',
            'assignedUserId' => 'assignedUserId'
        ];
    }

}