<?php

namespace app\models\cms;

use Yii;


/**
 * This is the model class for table "cms_newsletter".
 *
 * @property int $id
 * @property string $email
 * @property string $description
 * @property string $datum
 */
class CmsNewsletter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_newsletter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['datum'], 'safe'],
            [['email', 'description'], 'string', 'max' => 255],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'description' => 'Description',
            'datum' => 'Datum',
        ];
    }
    public static function findByMail($email) {
        $product = self::find()
            ->where([
                "email" => $email
            ])
            ->one();

        return $product;
    }
}