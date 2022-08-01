<?php


namespace app\extensions\greendev\vps;
use Yii;
use app\models\seo\Seomanager;
use yii\helpers\Html;
use yii\helpers\Url;

class VPSTask
{
    public static function createVPSTask($accountid,$CustomerOrderid,$initialpasswort,$product)
    {

        $Task = new \app\models\VPSTask\VPSTask();
        $Task->accountid =$accountid;
        $Task->CustomerOrderId = $CustomerOrderid;
        $Task->passwort =$initialpasswort;
        $Task->OrderJson=json_encode($product);
        $Task->status =0;
        $Task->save();
        return true;
    }


}