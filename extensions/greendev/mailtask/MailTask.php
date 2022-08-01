<?php


namespace app\extensions\greendev\mailtask;
use Yii;
use app\models\seo\Seomanager;
use yii\helpers\Html;
use yii\helpers\Url;

class MailTask
{
    public static function setMailTask($username,$CustomerOrder,$productname)
    {

        $MailTask = new \app\models\mailtasker\MailTask();
        $MailTask->FromMail ='noreply@windcloud.de';
        if(preg_match("/Start/",$productname)){
            $MailTask->ToMail =strtolower(\Yii::$app->params['produktcontactstartEmail']);
        }else{
            $MailTask->ToMail =strtolower(\Yii::$app->params['produktcontactEmail']);
        }
        $MailTask->Layout ='accinfoconsole';
        $MailTask->Subject ='Bestellung Windcloud 4.0 GmbH';
        $MailTask->DataMail =json_encode(['username'=> $username ,
            'oderid' => $CustomerOrder->id,
            'productid' => $CustomerOrder->productid,
            'productname' => $productname,
            'domain' => $CustomerOrder->domain,
            'accountid' => $CustomerOrder->accountid,
            'option' => json_decode($CustomerOrder->addons,true),
            'initialpasswort' => $CustomerOrder->initialpasswort,
            'activate_hash' =>$CustomerOrder->activate_hash
        ]);
        $MailTask->Sendstatus =0;
        $MailTask->save();


            return true;

    }
    public static function setMailTaskCustomer($mail,$layout,$subject,$datamail,$frommail=null)
    {

        $MailTask = new \app\models\mailtasker\MailTask();
        if($frommail==null){
            $MailTask->FromMail ='noreply@windcloud.de';
        }else{
            $MailTask->FromMail = $frommail;
        }

        $MailTask->ToMail =$mail;
        $MailTask->Layout =$layout;
        $MailTask->Subject =$subject;
        $MailTask->DataMail =json_encode($datamail);
        $MailTask->Sendstatus =0;
        $MailTask->save();


        return true;

    }
    public static function setMailTaskVPS($mail,$layout,$subject,$datamail,$frommail=null)
    {

        $MailTask = new \app\models\mailtasker\MailTask();
        if($frommail==null){
            $MailTask->FromMail ='noreply@windcloud.de';
        }else{
            $MailTask->FromMail = $frommail;
        }

        $MailTask->ToMail =$mail;
        $MailTask->Layout =$layout;
        $MailTask->Subject =$subject;
        $MailTask->DataMail =json_encode($datamail);
        $MailTask->Sendstatus =0;
        $MailTask->save();


        return true;

    }
}
