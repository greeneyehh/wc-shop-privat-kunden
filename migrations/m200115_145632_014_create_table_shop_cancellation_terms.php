<?php

use yii\db\Migration;

class m200115_145632_014_create_table_shop_cancellation_terms extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%shop_cancellation_terms}}', [
            'id' => $this->integer(10)->notNull(),
            'slug' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'datetime' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->createIndex('id', '{{%shop_cancellation_terms}}', 'id');
    }

    public function down()
    {
        $this->dropTable('{{%shop_cancellation_terms}}');
    }
}
