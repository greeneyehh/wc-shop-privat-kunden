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
        public static function findVmOnNode ($name) {
            $ClusterVMlist = self::Clusterlist();
            $key = array_search($name, array_column($ClusterVMlist, 'name'));
            return $ClusterVMlist[$key]['node'];
        }


    public static function listNodes () {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];

        Request::Login($configure); // Login ..
        echo '<pre>';
        print_r(Nodes::listNodes());
        echo '</pre>';
    }

    public static function Pools () {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];

        Request::Login($configure); // Login ..
        print_r( Pools::Pools());

    }

    public static function Firewall () {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];

        Request::Login($configure); // Login ..
        print_r(Cluster::Firewall());
    }

    public static function CreateVM ($vmid,$cores,$name,$agent,$storage) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        Request::Login($configure); // Login ..
        $nextId = Cluster::nextVmid(); // get next vmid
        $create = [
            'vmid'        => $vmid.$nextId->data,
            'cores'       => $cores,
            'name'        => $name,
            'agent'       => $agent,
            'scsi0'       => 'local:32,format=qcow2',
            'storage'     => $storage
        ];
        $firstNode = Nodes::listNodes()->data[0]->node;
        print_r( Nodes::createQemu($firstNode, $create) );

    }


    public static function CloneVM($newid,$create) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        Request::Login($configure); // Login ..
        $nextId = Cluster::nextVmid(); // get next vmid
        $firstNode = Nodes::listNodes()->data[0]->node;
        print_r(Nodes::deleteQemu('pve01-windcloud', $newid));
        return Request::Request('/nodes/pve01-windcloud/qemu/116/clone', $create, 'POST');

    }
  /*  public static function CloneVM ($vmid,$cores,$name,$agent,$storage) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        Request::Login($configure); // Login ..
        $nextId = Cluster::nextVmid(); // get next vmid
        $create = [
            'vmid'        => $vmid.$nextId->data,
            'cores'       => $cores,
            'name'        => $name,
            'agent'       => $agent,
            'scsi0'       => 'local:32,format=qcow2',
            'storage'     => $storage
        ];
        $firstNode = Nodes::listNodes()->data[0]->node;
        print_r( Nodes::createQemu($firstNode, $create) );

    }*/

    public static function qemuVncwebsocket () {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];

        Request::Login($configure);

        $node = 'pve01-windcloud';
        $vmid = 116;
        $f = Nodes::createQemuVncproxy($node, $vmid, $data = array());
        $array = json_decode(json_encode($f), True);




        $vncwebsocket=  Nodes::qemuVncwebsocket($node, $vmid, $array["data"]["port"], $array["data"]["ticket"]);
        $vncwebsocket = json_decode(json_encode($vncwebsocket), True);
        //print_r($vncwebsocket);


        //echo '<iframe src="https://mykvmurl:8006/?console=kvm&novnc=1&vmid=201&node=$node"; <https://mykvmurl:8006/?console=kvm&novnc=1&vmid=201&node=mynode> frameborder="0" scrolling="no" width="1024px" height="768px"></iframe>';

        $configurenew = [
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
       $test = Access::createTicket($configurenew);
        //setcookie('PVEAuthCookie', $test);
        //print_r($test);



        $node = 'pve01-windcloud';
        $vmid = 116;
        $f = Nodes::createQemuVncproxy($node, $vmid, $data = array());
        $array = json_decode(json_encode($f), True);
       Nodes::qemuVncwebsocket($node, $vmid, $array["data"]["port"], $array["data"]["ticket"]);

        $array["data"]['ticket'] = urlencode( $array["data"]['ticket']);
        setrawcookie("PVEAuthCookie",$test, 0, "/");
       $vnc = 'https://'. Yii::$app->params['PROXMOXVE_HOSTNAME'] .':8006/?console=shell&novnc=1&node='.$node.'&resize=scale&vmid='.$vmid.'&path=api2/json/nodes/'.$node.'/qemu/'.$vmid.'/vncwebsocket&port=' . $array["data"]["port"] . '&vncticket=' .$array["data"]["ticket"];
        //echo $vnc;
        echo '<iframe src="'.$vnc.'" width="1024px" height="768px" allowfullscreen="true"></iframe>';
        }

    public static function qemuVnc($node, $vmid) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];

        Request::Login($configure);
        $proxy = Nodes::createQemuVncproxy($node, $vmid);
        $array = json_decode(json_encode($proxy), true);
        $v = Nodes::qemuVncwebsocket($node, $vmid, $array['data']['port'], $array['data']['ticket']);
        $vnc = 'https://development.windcloud.de:8006/?console=kvm&novnc=1&node=' . $node . '&resize=scale&vmid=' . $vmid . '&path=api2/json/nodes/' . $node . '/qemu/' . $vmid . '/vncwebsocket?port=' .$array['data']['port'] . '&vncticket=' . $array["data"]["ticket"];
        return $vnc;
    }

    public static function qemunetworkgetinterfaces($node, $vmid ) {

        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        Request::Login($configure);
        $data['command'] = 'wget -O - -q icanhazip.com';
       //return Request::Request('/nodes/'.$node.'/qemu/'.$vmid.'/agent/get-osinfo', null, 'GET');
        return Request::Request('/nodes/'.$node.'/qemu/'.$vmid.'/agent/exec', $data, 'POST');
    }


    public static function qemuGetOsInfo($node, $vmid ) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        Request::Login($configure);
        return Request::Request('/nodes/'.$node.'/qemu/'.$vmid.'/agent/get-osinfo', null, 'GET');
    }

    public static function qemuGetOsVcpus($node, $vmid ) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        Request::Login($configure);
        return Request::Request('/nodes/'.$node.'/qemu/'.$vmid.'/agent/get-vcpus', null, 'GET');
    }

    public static function qemuStatus ($node, $vmid) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];

        Request::Login($configure);
        return Nodes::qemuStatus($node, $vmid);
    }

    public static function qemuCurrent ($node, $vmid) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];

        Request::Login($configure);
        return Nodes::qemuCurrent($node, $vmid);
    }

    public static function QemuVmid ($node, $vmid) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];

        Request::Login($configure);
        return Nodes::QemuVmid($node, $vmid);
        //print_r( Nodes::qemuVncwebsocket('pve01-windcloud', 116, null, null));

    }

    public static function qemuReboot($node, $vmid) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];
        Request::Login($configure);
        return Request::Request('/nodes/'.$node.'/qemu/'.$vmid.'/status/reboot', null, 'POST');
      //  return Nodes::qemuReset($node, $vmid, null);
    }

    public static function qemuShutdown ($node, $vmid) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];

        Request::Login($configure);

        return Nodes::qemuShutdown($node, $vmid, null);
    }

    public static function qemuStart ($node, $vmid) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];

        Request::Login($configure);
        return Nodes::qemuStart($node, $vmid, null);

    }

    public static function qemuStop ($node, $vmid) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];

        Request::Login($configure);

        return Nodes::qemuStop($node, $vmid, null);

    }

    public static function qemuSuspend ($node, $vmid) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];

        Request::Login($configure);

        return Nodes::qemuSuspend($node, $vmid, null);

    }

    public static function qemuResume ($node, $vmid) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];

        Request::Login($configure);

        return Nodes::qemuResume($node, $vmid, null);

    }

    public static function Network ($node, $vmid) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];

        Request::Login($configure);
        print_r( Request::Request('/nodes/'.$node.'/qemu/'.$vmid.'/config', null, 'GET') );
        print_r( Request::Request('/nodes/'.$node.'/qemu/'.$vmid.'/agent/get-users', null, 'GET') );

    }

    public static function qemuSnapshot ($node, $vmid) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];

        Request::Login($configure);
        $dateSnap = time();
       // print_r( Request::Request('/nodes/'.$node.'/qemu/'.$vmid.'/snapshot', ['snapname'=> 'Snap_'.$vmid.'_'.$dateSnap ] , 'POST') );

        return Nodes::qemuSnapshot($node, $vmid);

    }

    public static function createQemuSnapshot ($node, $vmid) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];

        Request::Login($configure);
        $dateSnap = time();
        //$dateSnap = date('Y-m-d H:i:s');
       // print_r( Request::Request('/nodes/'.$node.'/qemu/'.$vmid.'/snapshot', ['snapname'=> 'Snap_'.$vmid.'_'.$dateSnap ] , 'POST') );

        return get_object_vars(Nodes::createQemuSnapshot($node, $vmid, ['snapname'=> 'Snap_'.$vmid.'_'.$dateSnap ],true) );

    }

    public static function QemuSnapshotRollback ($node,$vmid,$name) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];

        Request::Login($configure);
        $dateSnap = time();
        //$dateSnap = date('Y-m-d H:i:s');
        // print_r( Request::Request('/nodes/'.$node.'/qemu/'.$vmid.'/snapshot', ['snapname'=> 'Snap_'.$vmid.'_'.$dateSnap ] , 'POST') );

        return get_object_vars(Nodes::QemuSnapshotRollback($node,$vmid,$name) );

    }

    public static function deleteQemuSnapshot ($node,$vmid,$name) {
        $configure = [
            'hostname' => Yii::$app->params['PROXMOXVE_HOSTNAME'],
            'username' => Yii::$app->params['PROXMOXVE_USERNAME'],
            'password' => Yii::$app->params['PROXMOXVE_PASSWORD'],
        ];

        Request::Login($configure);
        $dateSnap = time();
        //$dateSnap = date('Y-m-d H:i:s');
        // print_r( Request::Request('/nodes/'.$node.'/qemu/'.$vmid.'/snapshot', ['snapname'=> 'Snap_'.$vmid.'_'.$dateSnap ] , 'POST') );

        return get_object_vars(Nodes::deleteQemuSnapshot($node,$vmid,$name) );

    }




    private function objectToArray($object) {
        if (is_object($object)) {
            $object = get_object_vars($object);
        }
        if (is_array($object)) {
            return array_map(array($this, 'objectToArray'), $object);
        } else {
            return $object;
        }
    }
}