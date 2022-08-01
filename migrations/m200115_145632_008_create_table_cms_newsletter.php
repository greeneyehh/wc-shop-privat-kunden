<?php

use yii\db\Migration;

class m200115_145632_008_create_table_cms_newsletter extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%cms_newsletter}}', [
            'id' => $this->primaryKey(10),
            'email' => $this->string()->notNull(),
            'description' => $this->string(),
            'remote_addr' => $this->string(),
            'datum' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->createIndex('email', '{{%cms_newsletter}}', 'email', true);
    }

    public function down()
    {
        $this->dropTable('{{%cms_newsletter}}');
    }
}
