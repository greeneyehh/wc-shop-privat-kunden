<?php


namespace app\extensions\greendev\SalesInvoiceTask;
use Yii;
use app\models\seo\Seomanager;
use yii\helpers\Html;
use yii\helpers\Url;

class SalesInvoiceTask
{
    public static function setSalesInvoiceTask($mandat,$items)
    {
        $SalesInvoiceTask = new \app\models\SalesInvoiceTasker\SalesInvoiceTask();
        $SalesInvoiceTask->accountid = $mandat;
        $SalesInvoiceTask->items = json_encode($items);
        $SalesInvoiceTask->status =0;
        $SalesInvoiceTask->error =0;
        $SalesInvoiceTask->save();
        return true;
    }

}

//app\extensions\greendev\SalesInvoiceTask\setSalesInvoiceTask($mandat,$items)