<?php

use yii\db\Migration;

class m200115_145632_007_create_table_cms_news extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%cms_news}}', [
            'id' => $this->primaryKey(),
            'titel' => $this->text()->notNull(),
            'description' => $this->text()->notNull(),
            'slug' => $this->string(250)->notNull(),
            'datetime' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%cms_news}}');
    }
}
