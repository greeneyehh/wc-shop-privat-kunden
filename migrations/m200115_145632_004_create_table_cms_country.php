<?php

use yii\db\Migration;

class m200115_145632_004_create_table_cms_country extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%cms_country}}', [
            'code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'id' => $this->primaryKey(10),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%cms_country}}');
    }
}
