<?php
namespace app\models\seo;

use Yii;

/**
 * This is the model class for table "seomanager".
 *
 * @property integer $id
 * @property string $route
 * @property string $post
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property string $canonical
 * @property string $data
 * @property string $remote_addr
 * @property integer $updated
 * @property integer $created
 */
class Seomanager extends \yii\db\ActiveRecord
{

    /**
     * $position the position for the data content
     * @var integer
     */
    public $position = 1;

    /**
     * $content the content for a route
     * @var string
     */
    public $content;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seomanager';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['route'], 'required'],
            [['updated', 'position'], 'integer'],
            [['created'], 'required'],
            [['route'], 'unique'],
            [['route','post', 'title', 'keywords','remote_addr', 'created', 'description', 'canonical'], 'string', 'max' => 255],
            [['data', 'content'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'route' => 'Route/Url',
            'post' => 'post/Url',
            'title' => 'Title',
            'keywords' => 'Keywords',
            'description' => 'Description',
            'canonical' => 'Canonical',
            'position' => 'Position',
            'data' => 'Data',
            'updated' => 'Updated',
            'created' => 'Created',
        ];
    }
}