<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\shop\CustomerOrder;
use yii\console\Controller;
use yii\console\ExitCode;
use app\models\VPSTask\VPSTask;
use app\models\VPSTask\VPSIPS;
/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class VPSCreateTaskController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex()
    {
        $VPSTask = VPSTask::find()->where(['status' => 0])->all();
        try {
            foreach ($VPSTask as $value) {
                print_r("#### daten bekomme ich sud der db ####");
                print_r($value);
                print_r("#### daten bekomme ich sud der db END####");

                $newname = $value['accountid'].'-'.$value['CustomerOrderId'];
                $order =json_decode($value['OrderJson'],true);
                $vmsize= json_decode(\app\extensions\greendev\weclapp\article::getByIdArticle($order['id']),true);
                $vmosid=null;
                if($order['option'] != NULL){
                    foreach ($order['option'] as $key => $option) {
                        if(isset($option['os']) && $option['os']==true)
                        {
                            $vmosid =$option['id'];
                        }
                    }
                }
                if(preg_match("/Cloudron/",$vmsize['articleNumber'])){
                    $vmsize['articleNumber'] = str_replace(".Cloudron", "", $vmsize['articleNumber']);
                    $clonevm=$vmsize['articleNumber'].'-Linux.Distributionen.U20.04.LTS';
                }else{
                    $vmos=json_decode(\app\extensions\greendev\weclapp\article::getByIdArticle($vmosid),true);
                    $clonevm=$vmsize['articleNumber'].'-'.$vmos['articleNumber'];
                }
                print_r("#### NextVMID ####");
                $nextid =\app\extensions\greendev\proxmox\proxmox::NextVMID();
                $ip = VPSIPS::find()->where(['status' => 0,'vmid'=>NULL,'accountid'=>NULL])->one();
                $clone = \app\extensions\greendev\proxmox\proxmox::CloneVM($clonevm,$nextid,$newname);
                $ip->vmid = $nextid;
                $ip->accountid =$value['accountid'];
                $ip->status = 1;
                $ip->save();
                list($UPID, $node, $uid, $gid, $gecos, $type, $shell, $shell) = explode(":", $clone->data);
                if($order['option'] != NULL){
                    foreach ($order['option'] as $key => $option) {
                        if(isset($option['backup']) && $option['backup']==true)
                        {
                            \app\extensions\greendev\proxmox\proxmox::qemuBackup($nextid);
                        }
                    }
                }
                $VPSTaskstatus = VPSTask::find()->where(['id' => $value['id']])->one();
                $VPSTaskstatus->status = 1;
                $VPSTaskstatus->save();
                $CustomerOrder= CustomerOrder::find()->where(['accountid' => $value['accountid'],'id' => $value['CustomerOrderId']])->one();
                $CustomerOrder->vmid =$nextid;
                $CustomerOrder->active =1;
                $CustomerOrder->save();

                $customervps = new \app\models\customeroder\customervps();
                $customervps->customeroderid =$value['CustomerOrderId'];
                $customervps->vmid =$nextid;
                $customervps->accountid =$value['accountid'];
                $customervps->productid =$order['id'];
                $customervps->active =1;
                $customervps->save();


		$account = \app\models\Account::find()->where(['accountid' => $value['accountid']])->one();
                $datamail = ['mail'=>$account->personal_email,'ip'=> $ip->ip ,'vpsid' => $CustomerOrder->id];
                $datamail2 = ['mail'=>\Yii::$app->params['produktcontactEmail'],'accountid'=>$value['accountid'],'os'=>$clonevm,'ip'=> $ip->ip ,'vpsid' => $customervps->vmid];
                \app\extensions\greendev\mailtask\MailTask::setMailTaskVPS(strtolower($account->personal_email),'productvps','Bestellung Windcloud 4.0 GmbH',$datamail);
 		\app\extensions\greendev\mailtask\MailTask::setMailTaskVPS(strtolower(\Yii::$app->params['produktcontactEmail']),'infovps',$value['accountid'] . ' hat Bestellt',$datamail2);


                $i = 0;
                while (++$i) {
                    $status =\app\extensions\greendev\proxmox\proxmox::CloneVMStatus($node,$clone->data);
                    if($status->data->status == 'stopped'){
                        \app\extensions\greendev\proxmox\proxmox::qemuStart($clonevm,$nextid);
                        \app\extensions\greendev\proxmox\proxmox::qemuha($nextid);
                       break;
                   }

                }
            }

        } catch (\Exception $ex) {
            echo $ex->getMessage();
            return false;
        }
    }
}
