<?php

namespace app\models\dashboard\kontakt;

use Yii;

/**
 * This is the model class for table "Dashboard_Kontakt_AutoComplete".
 *
 * @property int $id
 * @property string $text
 */
class KontaktAutoComplete extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Dashboard_Kontakt_AutoComplete';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'], 'required'],
            [['text'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
        ];
    }
}