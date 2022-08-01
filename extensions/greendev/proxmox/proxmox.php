<?php

namespace app\extensions\greendev\proxmox;
use Yii;
use Proxmox\Request;
use Proxmox\Access;
use Proxmox\Cluster;
use Proxmox\Nodes;
use Proxmox\Pools;
use Proxmox\Storage;
use app\extensions\greendev\proxmox\PVE2_API;



class proxmox
{
    public static function NextVMID() {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        Request::Login($configure);
        $Clusterlist= Request::Request("/cluster/nextid");
        return json_decode(json_encode($Clusterlist->data), true);
    }

    public static function Clusterlist() {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        Request::Login($configure);
        $optional['type'] = "vm";
        $Clusterlist = Request::Request("/cluster/resources", $optional);
        return json_decode(json_encode($Clusterlist->data), true);
    }
    public static function ClusterNodelist() {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        Request::Login($configure);
        $optional['type'] = "node";
        $Clusterlist = Request::Request("/cluster/resources", $optional);
        return json_decode(json_encode($Clusterlist->data), true);
    }

    public static function findVmOnNode ($name) {
        $ClusterVMlist = self::Clusterlist();
        $key = array_search($name, array_column($ClusterVMlist, 'name'));
        $result = ['node' => $ClusterVMlist[$key]['node'], 'vmid' => $ClusterVMlist[$key]['vmid']];
        return $result;
    }

    public static function findVmOnNodeById ($id) {
        $ClusterVMlist = self::Clusterlist();
        $key = array_search($id, array_column($ClusterVMlist, 'vmid'));
        $result = ['node' => $ClusterVMlist[$key]['node'], 'vmid' => $ClusterVMlist[$key]['vmid'],'name'=>$ClusterVMlist[$key]['name']];
        return $result;
    }


    public static function NodeStatus () {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        Request::Login($configure);
        $ClusterVMlist = self::ClusterNodelist();
        $arr = array();
        foreach ($ClusterVMlist as $node){
            $result = Request::Request('/nodes/'.$node['node'].'/status', null, 'GET');
            $last =(array) json_decode(json_encode($result->data, true));
            $prozent = round(($last['memory']->used/$last['memory']->total*100), 1);
            array_push($arr, ['used'=>$prozent,'node'=>$node['node']]);
        }
        $keys = array_column($arr, 'used');

         array_multisort($keys, SORT_ASC, $arr);
        return $arr[0]['node'];

    }

    public static function CloneVM($clonevm,$newid,$newname) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        Request::Login($configure);
        $clone = self::findVmOnNode($clonevm);
        $freenode = self::NodeStatus();
        $create = [
            'newid'        => $newid,
            'name' => $newname,
            'vmid' => $clone['vmid'],
            'full'        => true,
            'target'        => $freenode,
            'format'        => 'qcow2'
        ];
        return Request::Request('/nodes/'.$clone['node'].'/qemu/'.$clone['vmid'].'/clone', $create, 'POST');
    }

    public static function CloneVMStatus($node,$upid) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        Request::Login($configure);

        return Request::Request('/nodes/'.$node.'/tasks/'.$upid.'/status', null, 'GET');
    }

    public static function qemuStart ($vmneme,$id) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        $clone = self::findVmOnNodeById($id);
        Request::Login($configure);
        if($clone['name']== $vmneme && $clone['vmid']== $id){
            return Request::Request("/nodes/".$clone['node']."/qemu/".$clone['vmid']."/status/start", null, 'POST');
        }else{
            return false;
        }
    }

    public static function qemuStop ($vmneme,$id) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        $clone = self::findVmOnNodeById($id);
        Request::Login($configure);
        if($clone['name']== $vmneme && $clone['vmid']== $id){
            return Request::Request("/nodes/".$clone['node']."/qemu/".$clone['vmid']."/status/stop", null, 'POST');
        }else{
            return false;
        }
    }

    public static function qemuReboot($vmneme,$id) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        $clone = self::findVmOnNodeById($id);
        Request::Login($configure);
        if($clone['name']== $vmneme && $clone['vmid']== $id){
            return Request::Request('/nodes/'.$clone['node'].'/qemu/'.$clone['vmid'].'/status/reboot', null, 'POST');
        }else{
            return false;
        }


    }

    public static function qemuShutdown ($vmneme,$id) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        $clone = self::findVmOnNodeById($id);
        Request::Login($configure);
        if($clone['name']== $vmneme && $clone['vmid']== $id){
            return Request::Request("/nodes/".$clone['node']."/qemu/".$clone['vmid']."/status/shutdown", null, 'POST');
        }else{
            return false;
        }

    }

    public static function qemuSuspend ($vmneme,$id) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        $clone = self::findVmOnNodeById($id);
        Request::Login($configure);
        if($clone['name']== $vmneme && $clone['vmid']== $id){
            return Request::Request("/nodes/".$clone['node']."/qemu/".$clone['vmid']."/status/suspend", null, 'POST');
        }else{
            return false;
        }
    }

    public static function qemuResume ($vmneme,$id) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        $clone = self::findVmOnNodeById($id);
        Request::Login($configure);
        if($clone['name']== $vmneme && $clone['vmid']== $id){
            return Request::Request("/nodes/".$clone['node']."/qemu/".$clone['vmid']."/status/resume", null, 'POST');
        }else{
            return false;
        }
    }
    public static function qemuSnapshot ($vmneme,$id) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];

        $clone = self::findVmOnNodeById($id);
        Request::Login($configure);
        if($clone['name']== $vmneme && $clone['vmid']== $id){
            return Request::Request("/nodes/".$clone['node']."/qemu/".$clone['vmid']."/snapshot");
        }else{
            return false;
        }
    }

    public static function createQemuSnapshot ($vmneme,$id) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        $clone = self::findVmOnNodeById($id);
        Request::Login($configure);
        if($clone['name']== $vmneme && $clone['vmid']== $id){
            $dateSnap = time();
            return get_object_vars(Request::Request("/nodes/".$clone['node']."/qemu/".$clone['vmid']."/snapshot",  ['snapname'=> 'Snap_'.$clone['vmid'].'_'.$dateSnap ], 'POST'));
        }else{
            return false;
        }

    }

    public static function deleteQemuSnapshot ($vmneme,$id,$name) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        Request::Login($configure);
        $clone = self::findVmOnNodeById($id);
        Request::Login($configure);
        if($clone['name']== $vmneme && $clone['vmid']== $id){
            $dateSnap = time();
            return get_object_vars(Request::Request("/nodes/".$clone['node']."/qemu/".$clone['vmid']."/snapshot/$name",  null, 'DELETE'));

        }else{
            return false;
        }
    }

    public static function QemuSnapshotRollback ($vmneme,$id,$name) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        Request::Login($configure);
        $clone = self::findVmOnNodeById($id);
        Request::Login($configure);
        if($clone['name']== $vmneme && $clone['vmid']== $id){
            $dateSnap = time();
            return Request::Request("/nodes/".$clone['node']."/qemu/".$clone['vmid']."/snapshot/$name/rollback", null, 'POST');
        }else{
            return false;
        }




    }

    public static function qemuNetwork ($vmneme) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        $clone = self::findVmOnNode($vmneme);
        Request::Login($configure);

        return Request::Request("/nodes/".$clone['node']."/qemu/".$clone['vmid']."/agent/network-get-interfaces", null, 'GET');
    }
    public static function qemuAgentExec($vmneme,$id,$exec) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        $clone = self::findVmOnNodeById($id);
        Request::Login($configure);
        if($clone['name']== $vmneme && $clone['vmid']== $id){
            $dateSnap = time();
            $data = [
                'command'        => $exec,
            ];
            return Request::Request("/nodes/".$clone['node']."/qemu/".$clone['vmid']."/agent/exec", $data, 'POST');
        }else{
            return false;
        }
    }
    public static function qemuAgentFileWrite ($vmneme,$id,$content,$file) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        $clone = self::findVmOnNodeById($id);
        Request::Login($configure);
        if($clone['name']== $vmneme && $clone['vmid']== $id){
            $dateSnap = time();
            $data = [
                'content'        => $content,
                'file'        => $file,

            ];
            return Request::Request("/nodes/".$clone['node']."/qemu/".$clone['vmid']."/agent/file-write", $data, 'POST');
        }else{
            return false;
        }
    }
    public static function qemuAgentStatus($vmneme,$id,$pid ) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        $clone = self::findVmOnNodeById($id);
        Request::Login($configure);
        if($clone['name']== $vmneme && $clone['vmid']== $id){
        $optional['pid'] = $pid;
        $result =Request::Request("/nodes/".$clone['node']."/qemu/".$clone['vmid']."/agent/exec-status", $optional);
        return json_decode(json_encode($result->data), true);
        }else{
            return false;
        }
    }
    public static function qemuCurrent ($vmneme) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];

        Request::Login($configure);
        $clone = self::findVmOnNode($vmneme);
        return Request::Request("/nodes/".$clone['node']."/qemu/".$clone['vmid']."/status/current");
    }
    public static function setuserpassword ($vmneme,$id, $username,$password) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        Request::Login($configure);
        $clone = self::findVmOnNodeById($id);
        if($clone['name']== $vmneme && $clone['vmid']== $id){
        $optional['username'] = $username;
        $optional['password'] = $password;
        $result =Request::Request("/nodes/".$clone['node']."/qemu/".$clone['vmid']."/agent/set-user-password", $optional, 'POST');
            return $result;
        }else{
            return false;
        }
    }
    public static function qemunetworkgetinterfaces($vmneme,$id) {

        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        Request::Login($configure);
        $clone = self::findVmOnNodeById($id);
        if($clone['name']== $vmneme && $clone['vmid']== $id){
        $data['command'] = 'wget -O - -q icanhazip.com';
        $pid= Request::Request('/nodes/'.$clone['node'].'/qemu/'.$clone['vmid'].'/agent/exec', $data, 'POST');
        return self::qemuAgentStatus($vmneme,$id,$pid->data->pid);
        }else{
            return false;
        }
    }
    public static function VNCProxy($vmneme) {

        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        Request::Login($configure);
        $clone = self::findVmOnNode($vmneme);
        return Request::Request('/nodes/'.$clone['node'].'/qemu/'.$clone['vmid'].'/vncproxy', null, 'POST');
    }

    public static function VNCWebsocket($vmneme) {

        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        Request::Login($configure);
        $clone = self::findVmOnNode($vmneme);
        $proxy = Request::Request('/nodes/'.$clone['node'].'/qemu/'.$clone['vmid'].'/vncproxy', null, 'POST');
        $optional['port'] = $proxy->data->port;
        $optional['vncticket'] = $proxy->data->ticket;
         Request::Request('/nodes/'.$clone['node'].'/qemu/'.$clone['vmid'].'/vncwebsocket', $optional);
        return $proxy;
    }


    public static function VNCProxy2($node,$vmid) {

        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        Request::Login($configure);
        $optional['websocket'] = 1;
        return Request::Request('/nodes/'.$node.'/qemu/'.$vmid.'/vncproxy', $optional, 'POST');
    }

    public static function VNCWebsocket2($node,$vmid,$optional) {

        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        Request::Login($configure);

        return Request::Request('/nodes/'.$node.'/qemu/'.$vmid.'/vncwebsocket', $optional);

    }




    public static function qemuGetOsInfo($vmneme) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        Request::Login($configure);
        $clone = self::findVmOnNode($vmneme);
        return Request::Request('/nodes/'.$clone['node'].'/qemu/'.$clone['vmid'].'/agent/get-osinfo', null, 'GET');
    }

    public static function qemuBackup($addvmid) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        Request::Login($configure);
        $backuplist= Request::Request("/cluster/backup");
        $backuplist->data['0'];
        $optional['vmid'] = $backuplist->data['0']->vmid.','.$addvmid;
        $optional['starttime'] = $backuplist->data['0']->starttime;
        return Request::Request("/cluster/backup/".$backuplist->data['0']->id, $optional, 'PUT');
    }
    public static function qemuha($addvmid) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        Request::Login($configure);

        $data['sid'] = 'vm:'.$addvmid;
        $data['max_relocate'] = '2';
        $data['max_restart'] = '2';
        return Request::Request("/cluster/ha/resources", $data, 'POST');
    }


}