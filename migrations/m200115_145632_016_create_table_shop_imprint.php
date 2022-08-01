<?php

use yii\db\Migration;

class m200115_145632_016_create_table_shop_imprint extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%shop_imprint}}', [
            'id' => $this->primaryKey(10),
            'slug' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'datetime' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%shop_imprint}}');
    }
}
