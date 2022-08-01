<?php

use yii\db\Migration;

class m200115_145632_011_create_table_payment_result_codes extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%payment_result_codes}}', [
            'id' => $this->primaryKey(),
            'result_codes_code' => $this->string(11),
            'result_codes_description' => $this->string(205),
            'payment_result_status' => $this->integer(1)->notNull()->defaultValue('0'),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%payment_result_codes}}');
    }
}
