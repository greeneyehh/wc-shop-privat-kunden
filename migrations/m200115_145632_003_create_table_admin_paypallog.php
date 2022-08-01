<?php

use yii\db\Migration;

class m200115_145632_003_create_table_admin_paypallog extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%admin_paypallog}}', [
            'id' => $this->primaryKey(),
            'payid' => $this->string()->notNull(),
            'intent' => $this->string()->notNull(),
            'paystate' => $this->string()->notNull(),
            'cart' => $this->string()->notNull(),
            'payer' => $this->string()->notNull(),
            'transactions' => $this->string()->notNull(),
            'redirect_urls' => $this->string()->notNull(),
            'create_time' => $this->string()->notNull(),
            'update_time' => $this->string()->notNull(),
            'links' => $this->string()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%admin_paypallog}}');
    }
}
