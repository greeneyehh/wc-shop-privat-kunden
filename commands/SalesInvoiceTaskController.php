<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use app\models\SalesInvoiceTasker\SalesInvoiceTask;

class SalesInvoiceTaskController extends Controller
{

    public function actionIndex()
    {
        $SalesInvoiceTask = SalesInvoiceTask::find()->where(['status' => 0,'error'=>0])->all();
        try {
            foreach ($SalesInvoiceTask as $value) {
                $createInvoiceTask= \app\extensions\greendev\weclapp\salesInvoice::createInvoiceTask($value['accountid'],json_decode($value['items'],true));
                $result =$createInvoiceTask;

                if(isset($result->error)){
                    $MailTaskstatus = SalesInvoiceTask::find()->where(['id' => $value['id']])->one();
                    $MailTaskstatus->error = 1;
                    $MailTaskstatus->save();

                }else{
                    $MailTaskstatus = SalesInvoiceTask::find()->where(['id' => $value['id']])->one();
                    $MailTaskstatus->status = 1;
                    $MailTaskstatus->save();
                }

            }
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            return false;
        }
    }
}
