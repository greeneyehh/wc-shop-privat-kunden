<?php

namespace app\commands;

use extensions\greendev\proxmox\proxmox;
use Yii;
use Proxmox\Request;
use Proxmox\Access;
use Proxmox\Cluster;
use Proxmox\Nodes;
use Proxmox\Pools;
use Proxmox\Storage;

class ProxmoxVpsJob extends \yii\base\BaseObject implements \yii\queue\JobInterface
{
    public $user;
    public $accountid;
    public $group;
    public $email;
    public $password;
    public $quota;
    public $productname;
    public $domain;
    public function execute($queue)
    {
        $nextcloud = user::AddUser($this->user,$this->group,$this->email,$this->password, $this->quota);
        if(preg_match("/(ok|100|OK)/",$nextcloud)){
            $Account = \app\models\Account::findIdentity($this->accountid);
                $message = Yii::$app->mailer->compose('layouts/productsunlock', ['account' => $this->user,'productname'=>$this->productname,'initialpasswort'=> $this->password,'domain'=>$this->domain,'CustomerData'=>$Account,'mail'=>$this->email])
                        ->setFrom('noreply@windcloud.de')
                        ->setTo(strtolower($this->email))
                        ->setSubject('Ihr Produkt ist jetzt Aktiv! Windcloud 4.0 GmbH')
                        ->send();
            }else{
                $Account = \app\models\Account::findIdentity($this->accountid);
                $message = \Yii::$app->mailer->compose('layouts/notactivated', ['CustomerData'=>$Account,'mail'=>$this->email])
                        ->setFrom('noreply@windcloud.de')
                        ->setTo(strtolower($this->email))
                        ->setSubject('Ihr Produkt konnte nicht Aktiviert werden! Windcloud 4.0 GmbH')
                        ->send();

            }
        }



}