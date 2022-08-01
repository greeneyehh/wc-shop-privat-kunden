<?php

use yii\db\Migration;

class m200115_145632_009_create_table_customer_order extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%customer_order}}', [
            'id' => $this->primaryKey(),
            'accountid' => $this->integer()->notNull(),
            'productid' => $this->integer()->notNull(),
            'domain' => $this->string(),
            'addons' => $this->string(),
            'paycycle' => $this->integer()->notNull(),
            'datetime' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'lastpaydate' => $this->string(),
            'lastpayid' => $this->string()->notNull(),
            'lastpaybrand' => $this->string()->notNull(),
            'payidlog' => $this->text()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%customer_order}}');
    }
}
