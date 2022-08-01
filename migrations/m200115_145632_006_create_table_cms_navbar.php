<?php

use yii\db\Migration;

class m200115_145632_006_create_table_cms_navbar extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%cms_navbar}}', [
            'id' => $this->primaryKey(),
            'linkname' => $this->string()->notNull(),
            'url' => $this->string()->notNull(),
            'sort' => $this->integer()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%cms_navbar}}');
    }
}
