<?php

namespace app\models\Security;

use Yii;

/**
 * This is the model class for table "updatelog".
 * 
 * 
 * 
 * 
 *
 * @property int $id
 * @property string $object_kind
 * @property string $event_name
 * @property string $event_before
 * @property string $event_after
 * @property string $event_ref
 * @property string $checkout_sha
 * @property int $user_id
 * @property string $user_name
 * @property string $user_email
 * @property string $user_avatar
 * @property int $project_id
 * @property string $project_name
 * @property string $project_description
 * @property string $project_namespace
 * @property int $project_visibility_level
 * @property string $project_path_with_namespace
 * @property string $project_default_branch
 * @property string $commits
 * @property int $total_commits_count
 * @property string $repository_name
 * @property string $pull_result
 */
 
class Updatelog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_updatelog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'project_id', 'project_visibility_level', 'total_commits_count'], 'integer'],
            [['commits','pull_result'], 'string'],
            [['object_kind', 'event_name', 'event_before', 'event_after', 'event_ref', 'checkout_sha', 'user_name', 'user_email', 'user_avatar', 'project_name', 'project_description', 'project_namespace', 'project_path_with_namespace', 'project_default_branch', 'repository_name'], 'string', 'max' => 255],
        ];
    }



    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'object_kind' => 'Object Kind',
            'event_name' => 'Event Name',
            'event_before' => 'Event Before',
            'event_after' => 'Event After',
            'event_ref' => 'Event Ref',
            'checkout_sha' => 'Checkout Sha',
            'user_id' => 'User ID',
            'user_name' => 'User Name',
            'user_email' => 'User Email',
            'user_avatar' => 'User Avatar',
            'project_id' => 'Project ID',
            'project_name' => 'Project Name',
            'project_description' => 'Project Description',
            'project_namespace' => 'Project Namespace',
            'project_visibility_level' => 'Project Visibility Level',
            'project_path_with_namespace' => 'Project Path With Namespace',
            'project_default_branch' => 'Project Default Branch',
            'commits' => 'Commits',
            'total_commits_count' => 'Total Commits Count',
            'repository_name' => 'Repository Name',
            'pull_result' =>'pull result',
        ];
    }
}