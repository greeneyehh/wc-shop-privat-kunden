<?php

use yii\db\Migration;

class m200115_145632_005_create_table_cms_footer_addon extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%cms_footer_addon}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(250)->notNull(),
            'description' => $this->text()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%cms_footer_addon}}');
    }
}
