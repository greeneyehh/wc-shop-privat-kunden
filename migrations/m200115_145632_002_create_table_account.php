<?php

use yii\db\Migration;

class m200115_145632_002_create_table_account extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%account}}', [
            'accountid' => $this->primaryKey(),
            'personal_customer_type' => $this->string()->notNull(),
            'personal_salutation' => $this->string()->notNull(),
            'personal_firstname' => $this->string()->notNull(),
            'personal_lastname' => $this->string()->notNull(),
            'personal_email' => $this->string()->notNull(),
            'personal_password' => $this->string()->notNull(),
            'personal_passwordConfirmation' => $this->string()->notNull(),
            'personal_phone' => $this->string()->notNull(),
            'personal_birthday_day' => $this->string()->notNull(),
            'personal_birthday_month' => $this->string()->notNull(),
            'personal_birthday_year' => $this->string()->notNull(),
            'billing_company' => $this->string()->notNull(),
            'billing_department' => $this->string()->notNull(),
            'billing_vatId' => $this->string()->notNull(),
            'billing_street' => $this->string()->notNull(),
            'billing_additionalAddressLine1' => $this->string()->notNull(),
            'billing_zipcode' => $this->string()->notNull(),
            'billing_city' => $this->string()->notNull(),
            'billing_country' => $this->string()->notNull(),
            'billing_shippingAddress' => $this->string()->notNull(),
            'shipping_salutation' => $this->string()->notNull(),
            'shipping_company' => $this->string()->notNull(),
            'shipping_department' => $this->string()->notNull(),
            'shipping_firstname' => $this->string()->notNull(),
            'shipping_lastname' => $this->string()->notNull(),
            'shipping_street' => $this->string()->notNull(),
            'shipping_additionalAddressLine1' => $this->string()->notNull(),
            'shipping_zipcode' => $this->string()->notNull(),
            'shipping_city' => $this->string()->notNull(),
            'shipping_country' => $this->string()->notNull(),
            'personal_dpacheckbox' => $this->string(10),
            'authKey' => $this->string(),
            'accessToken' => $this->string(250),
            'deleteToken' => $this->string(),
            'forgotpasswordtime' => $this->string(),
            'deletetime' => $this->string(),
            'remote_addr' => $this->string()->notNull(),
            'right' => $this->integer()->notNull()->defaultValue('0'),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%account}}');
    }
}
