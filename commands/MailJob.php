<?php
namespace app\commands;

class MailJob extends  \yii\base\BaseObject implements \yii\queue\JobInterface
{
    public $Layout;
    public $FromMail;
    public $ToMail;
    public $Subject;
    public $DataMail;

    public function execute($queue)
    {
        try {
        $Maildata =json_decode($this->DataMail,true);
        $message = \Yii::$app->mailer->compose('@app/mail/layouts/' . $this->Layout ,  $Maildata )
            ->setFrom(strtolower($this->FromMail))
            ->setTo(strtolower($this->ToMail))
            ->setSubject($this->Subject)
            ->send();
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            \Yii::error("email sending failed due to error: " . $ex->getMessage());
        }
    }
}
