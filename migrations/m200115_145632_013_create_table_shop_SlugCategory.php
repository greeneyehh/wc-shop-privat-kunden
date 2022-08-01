<?php

use yii\db\Migration;

class m200115_145632_013_create_table_shop_SlugCategory extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%shop_SlugCategory}}', [
            'id' => $this->primaryKey(),
            'label' => $this->string()->notNull(),
            'categoryid' => $this->integer()->notNull(),
            'views' => $this->string()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%shop_SlugCategory}}');
    }
}
