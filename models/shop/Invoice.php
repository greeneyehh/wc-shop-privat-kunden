<?php

namespace app\models\shop;

use Yii;

/**
 * This is the model class for table "invoice".
 *
 * @property int $id
 * @property string $salesInvoiceid
 * @property string $customerNumber
 * @property string $invoiceNumber
 * @property string $salesInvoiceItems
 * @property string|null $datetime
 */
class Invoice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invoice';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['salesInvoiceid', 'customerNumber', 'invoiceNumber',  'salesInvoiceItems'], 'required'],
            [['salesInvoiceItems'], 'string'],
            [['datetime'], 'safe'],
            [['salesInvoiceid', 'customerNumber', 'invoiceNumber'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'salesInvoiceid' => 'Sales Invoiceid',
            'customerNumber' => 'Customer Number',
            'invoiceNumber' => 'Invoice Number',
            'salesInvoiceItems' => 'Sales Invoice Items',
            'datetime' => 'Datetime',
        ];
    }
}
