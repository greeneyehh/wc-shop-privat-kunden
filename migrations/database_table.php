<?php
use yii\db\Schema;
    class m101129_185401_create_news_table extends \yii\db\Migration
    {
        public function safeUp()
        {
            $this->createTable('domain', [
                'id' => 'pk',
                'domainname' => Schema::TYPE_STRING . ' NOT NULL',
            ]);
            
            $this->createTable('Nextcloud_Order', [
                'id' => 'pk',
                'title' => Schema::TYPE_STRING . ' NOT NULL',
                'content' => Schema::TYPE_TEXT,
            ]);
            
            $this->createTable('product_addons', [
                'id' => 'pk',
                'value' => Schema::TYPE_STRING . ' NOT NULL',
                'name' => Schema::TYPE_STRING . ' NOT NULL',
            ]);
    
            $this->createTable('shop_product', [
                'id' => 'pk',
                'login' => Schema::TYPE_STRING . ' NOT NULL',
                'password' => Schema::TYPE_STRING . ' NOT NULL',
            ]);
        }
    
        public function safeDown()
        {
            $this->dropTable('domain');
            $this->dropTable('Nextcloud_Order');
            $this->dropTable('product_addons');
            $this->dropTable('shop_product');
        }
    
    }
?>