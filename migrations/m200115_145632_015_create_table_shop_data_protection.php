<?php

use yii\db\Migration;

class m200115_145632_015_create_table_shop_data_protection extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%shop_data_protection}}', [
            'id' => $this->primaryKey(10),
            'slug' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'datetime' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->createIndex('id', '{{%shop_data_protection}}', 'id');
        $this->createIndex('id_2', '{{%shop_data_protection}}', 'id');
    }

    public function down()
    {
        $this->dropTable('{{%shop_data_protection}}');
    }
}
