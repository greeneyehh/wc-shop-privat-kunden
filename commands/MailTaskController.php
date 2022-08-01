<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use app\models\mailtasker\MailTask;

class MailTaskController extends Controller
{

    public function actionIndex()
    {
        $MailTask = MailTask::find()->where(['Sendstatus' => 0])->all();
        try {
            foreach ($MailTask as $value) {
                $Maildata =json_decode($value['DataMail'],true);
                \Yii::$app->mailer->compose('@app/mail/layouts/' . $value['Layout'] ,  $Maildata )
                    ->setFrom(strtolower($value['FromMail']))
                    ->setTo(strtolower($value['ToMail']))
                    ->setSubject($value['Subject'])
                    ->send();
                $MailTaskstatus = MailTask::find()->where(['id' => $value['id']])->one();
                $MailTaskstatus->Sendstatus = 1;
                $MailTaskstatus->save();
               // return ExitCode::OK;

            }
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            return false;
        }
    }
}
