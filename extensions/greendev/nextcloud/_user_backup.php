<?php

namespace app\extensions\greendev\nextcloud;
use app\models\logserver\nextcloudlog;
use Yii;
class user
{
    public static function AddUser($user,$group,$email,$password,$quota) {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://'.\Yii::$app->params['NEXTCLOUD_API_USERNAME'] .':'.\Yii::$app->params['NEXTCLOUD_API_PASSWORD'] .'@'.\Yii::$app->params['NEXTCLOUD_API_HOSTNAME'] .'/ocs/v1.php/cloud/users');
        curl_setopt($ch, CURLOPT_POST, 1);
        $post_data = html_entity_decode ('userid='. $user .'&quota='. $quota .'&password='. $password.'&email='. $email);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data );

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $headers = array();
        $headers[] = 'Ocs-Apirequest: true';
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        $info = curl_getinfo($ch);
        curl_close($ch);
        $nextcloudlog = new nextcloudlog();
        $nextcloudlog->sessionid = Yii::$app->session->getId();
        $nextcloudlog->type ="getAdduser";
        $nextcloudlog->content =$info['url'];
        $nextcloudlog->postfiels =$post_data;
        $nextcloudlog->result =$result;
        $nextcloudlog->save();
        user::Creategroup($user,$group);


        return  $result;


    }
    public static function Creategroup($user,$group) {


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://'.\Yii::$app->params['NEXTCLOUD_API_USERNAME'] .':'.\Yii::$app->params['NEXTCLOUD_API_PASSWORD'] .'@'.\Yii::$app->params['NEXTCLOUD_API_HOSTNAME'] .'/ocs/v1.php/cloud/groups');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        $POSTFIELDS ="groupid=". $group;
        curl_setopt($ch, CURLOPT_POSTFIELDS, $POSTFIELDS);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $headers = array();
        $headers[] = 'Ocs-Apirequest: true';
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        $info = curl_getinfo($ch);
        curl_close($ch);
        $nextcloudlog = new nextcloudlog();
        $nextcloudlog->sessionid = Yii::$app->session->getId();

        $nextcloudlog->type ="getCreategroup";
        $nextcloudlog->content =$info['url'];
        $nextcloudlog->postfiels =$POSTFIELDS;
        $nextcloudlog->result =$result;
        $nextcloudlog->save();
        user::UpdateUsergroup($user,$group);
        return  $result;


    }

    public static function UpdateUsergroup($user,$group) {


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://'.\Yii::$app->params['NEXTCLOUD_API_USERNAME'] .':'.\Yii::$app->params['NEXTCLOUD_API_PASSWORD'] .'@'.\Yii::$app->params['NEXTCLOUD_API_HOSTNAME'] .'/ocs/v1.php/cloud/users/'.$user.'/groups');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        $POSTFIELDS="groupid=". $group;
        curl_setopt($ch, CURLOPT_POSTFIELDS, $POSTFIELDS);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $headers = array();
        $headers[] = 'Ocs-Apirequest: true';
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        $info = curl_getinfo($ch);
        curl_close($ch);
        $nextcloudlog = new nextcloudlog();
        $nextcloudlog->sessionid = Yii::$app->session->getId();
        $nextcloudlog->type ="getUpdateUsergroup";
        $nextcloudlog->content =$info['url'];
        $nextcloudlog->postfiels =$POSTFIELDS;
        $nextcloudlog->result =$result;
        $nextcloudlog->save();
        return  $result;
    }

    public static function UpdateUserquota($user,$quota) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://'.\Yii::$app->params['NEXTCLOUD_API_USERNAME'] .':'.\Yii::$app->params['NEXTCLOUD_API_PASSWORD'] .'@'.\Yii::$app->params['NEXTCLOUD_API_HOSTNAME'] .'/ocs/v1.php/cloud/users/'.$user);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, "key=\"quota\"&value=\"25GB\"");

        $headers = array();
        $headers[] = 'Ocs-Apirequest: true';
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return  $result;
    }

    public static function UpdateUserPassword($senddata) {

    }

    public static function UserDisable($user) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://'.\Yii::$app->params['NEXTCLOUD_API_USERNAME'] .':'.\Yii::$app->params['NEXTCLOUD_API_PASSWORD'] .'@'.\Yii::$app->params['NEXTCLOUD_API_HOSTNAME'] .'/ocs/v1.php/cloud/users/'.$user.'/disable');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');

        $headers = array();
        $headers[] = 'Ocs-Apirequest: true';
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
    }

}

/*
 * curl -X POST https://admin:lampe1985@next-dev.windcloud.de/ocs/v1.php/cloud/users -d userid="Frank" -d password="frankspassword" -H "OCS-APIRequest: true"




$ curl -X PUT http://admin:secret@example.com/ocs/v1.php/cloud/users/Frank/disable


curl -X POST https://admin:lampe1985@next-dev.windcloud.de/ocs/v1.php/cloud/users -d userid="Frank" -d password="frankspassword" -H "OCS-APIRequest: true"
curl -X PUT https://admin:lampe1985@next-dev.windcloud.de/ocs/v1.php/cloud/users/Frank -d key="quota" -d value="25GB" -H "OCS-APIRequest: true"
curl -X PUT https://admin:lampe1985@next-dev.windcloud.de/ocs/v1.php/cloud/users/Frank -d key="quota" -d value="25GB" -H "OCS-APIRequest: true"

https://admin:lampe1985@next-dev.windcloud.de/ocs/v2.php/apps/serverinfo/api/v1/info?format=json
curl -X PUT https://admin:lampe1985@next-dev.windcloud.de/ocs/v1.php/cloud/users/Frank -d key="password" -d value="frankspassword" -H "OCS-APIRequest: true"
 */