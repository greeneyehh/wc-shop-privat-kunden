<?php

use yii\db\Migration;

class m200115_145632_012_create_table_product_addons extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%product_addons}}', [
            'id' => $this->primaryKey(),
            'value' => $this->string(250)->notNull(),
            'name' => $this->string(250)->notNull(),
            'preis' => $this->string()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%product_addons}}');
    }
}
