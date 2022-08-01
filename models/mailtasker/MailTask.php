<?php

namespace app\models\mailtasker;

use Yii;

/**
 * This is the model class for table "SalesInvoiceTasker".
 *
 * @property int $id
 * @property int $Layout
 * @property int $FromMail
 * @property string $ToMail
 * @property string $Subject
 * @property int $DataMail
 * @property string $Sendstatus
 * @property string $datetime
 */
class MailTask extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'MailTask';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Layout', 'FromMail','ToMail','Subject','DataMail','Sendstatus'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Layout' => 'Layout',
            'FromMail' => 'FromMail',
            'ToMail' => 'ToMail',
            'Subject' => 'Subject',
            'DataMail' => 'DataMail',
            'sendstatus' => 'sendstatus',
        ];
    }
}