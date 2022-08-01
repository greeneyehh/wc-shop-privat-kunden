<?php

use yii\db\Migration;

class m200115_145632_001_create_table_Dashboard_Kontakt_AutoComplete extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%Dashboard_Kontakt_AutoComplete}}', [
            'id' => $this->primaryKey(),
            'text' => $this->string()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%Dashboard_Kontakt_AutoComplete}}');
    }
}
