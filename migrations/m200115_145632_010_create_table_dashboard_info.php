<?php

use yii\db\Migration;

class m200115_145632_010_create_table_dashboard_info extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%dashboard_info}}', [
            'id' => $this->primaryKey(),
            'titel' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'type' => $this->string()->notNull(),
            'datum' => $this->date()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%dashboard_info}}');
    }
}
