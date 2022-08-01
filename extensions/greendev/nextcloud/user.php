<?php

namespace app\extensions\greendev\nextcloud;
use app\models\logserver\nextcloudlog;
use GuzzleHttp\Client;
use Yii;
class user
{
    public static function AddUser($user,$group,$email,$password,$quota) {
        $data = html_entity_decode ('userid='. $user .'&quota='. $quota .'&password='. $password.'&email='. $email);
        $headers = [
            'OCS-APIRequest'=>'true',
            'Content-Type'=>'application/x-www-form-urlencoded'
        ];
        $client = new Client();
        $response = $client->post('https://'.\Yii::$app->params['NEXTCLOUD_API_USERNAME'] .':'.\Yii::$app->params['NEXTCLOUD_API_PASSWORD'] .'@'.\Yii::$app->params['NEXTCLOUD_API_HOSTNAME'] .'/ocs/v1.php/cloud/users', [
            'body' => $data,
            'headers' =>$headers
        ]);
        $dataxml =simplexml_load_string($response->getBody()->getContents());
        if($dataxml->meta->statuscode == 100){
                $nextcloudlog = new nextcloudlog();
                $nextcloudlog->sessionid = Yii::$app->session->getId();
                $nextcloudlog->type ="getAdduser";
                $nextcloudlog->content ='https://'.\Yii::$app->params['NEXTCLOUD_API_USERNAME'] .':'.\Yii::$app->params['NEXTCLOUD_API_PASSWORD'] .'@'.\Yii::$app->params['NEXTCLOUD_API_HOSTNAME'] .'/ocs/v1.php/cloud/users';
                $nextcloudlog->postfiels =$data;
                $nextcloudlog->result =user::ResultStatuscode($dataxml->meta->statuscode,$user,$group,$email,$password,$quota);
                $nextcloudlog->save();
                user::Creategroup($user,$group);
                return $dataxml;
            }else{
                $nextcloudlog = new nextcloudlog();
                $nextcloudlog->sessionid = Yii::$app->session->getId();
                $nextcloudlog->type ="getAdduser";
                $nextcloudlog->content ='https://'.\Yii::$app->params['NEXTCLOUD_API_USERNAME'] .':'.\Yii::$app->params['NEXTCLOUD_API_PASSWORD'] .'@'.\Yii::$app->params['NEXTCLOUD_API_HOSTNAME'] .'/ocs/v1.php/cloud/users';
                $nextcloudlog->postfiels =$data;
                $nextcloudlog->result =user::ResultStatuscode($dataxml->meta->statuscode,$user,$group,$email,$password,$quota);
                $nextcloudlog->save();

            $json = json_encode($dataxml);

            \app\components\RocketChatComponent::RocketChatTask($user,"Nextcloud getAdduser",$json);
                return $dataxml;

            }

    }

    public static function Creategroup($user,$group) {

        $data = html_entity_decode ("groupid=". $group);
        $headers = [
            'OCS-APIRequest'=>'true',
            'Content-Type'=>'application/x-www-form-urlencoded'
        ];
        $client = new Client();
        $response = $client->post('https://'.\Yii::$app->params['NEXTCLOUD_API_USERNAME'] .':'.\Yii::$app->params['NEXTCLOUD_API_PASSWORD'] .'@'.\Yii::$app->params['NEXTCLOUD_API_HOSTNAME'] .'/ocs/v1.php/cloud/groups', [
            'body' => $data,
            'headers' =>$headers
        ]);
        $dataxml =simplexml_load_string($response->getBody()->getContents());
        if($dataxml->meta->statuscode == 100){
            $nextcloudlog = new nextcloudlog();
            $nextcloudlog->sessionid = Yii::$app->session->getId();
            $nextcloudlog->type ="getCreategroup";
            $nextcloudlog->content ='https://'.\Yii::$app->params['NEXTCLOUD_API_USERNAME'] .':'.\Yii::$app->params['NEXTCLOUD_API_PASSWORD'] .'@'.\Yii::$app->params['NEXTCLOUD_API_HOSTNAME'] .'/ocs/v1.php/cloud/groups';
            $nextcloudlog->postfiels =$data;
            $nextcloudlog->result =user::ResultStatuscode($dataxml->meta->statuscode,$user,$group);
            $nextcloudlog->save();
            user::UpdateUsergroup($user,$group);
            return $dataxml;
        }else{
            $nextcloudlog = new nextcloudlog();
            $nextcloudlog->sessionid = Yii::$app->session->getId();
            $nextcloudlog->type ="getCreategroup";
            $nextcloudlog->content ='https://'.\Yii::$app->params['NEXTCLOUD_API_USERNAME'] .':'.\Yii::$app->params['NEXTCLOUD_API_PASSWORD'] .'@'.\Yii::$app->params['NEXTCLOUD_API_HOSTNAME'] .'/ocs/v1.php/cloud/groups';
            $nextcloudlog->postfiels =$data;
            $nextcloudlog->result =user::ResultStatuscode($dataxml->meta->statuscode,$user,$group);
            $nextcloudlog->save();
            $json = json_encode($dataxml);
            \app\components\RocketChatComponent::RocketChatTask($user,"Nextcloud getAdduser",$json);
            return $dataxml;
        }
    }

    public static function UpdateUsergroup($user,$group) {
        $data = html_entity_decode ("groupid=". $group);
        $headers = [
            'OCS-APIRequest'=>'true',
            'Content-Type'=>'application/x-www-form-urlencoded'
        ];
        $client = new Client();
        $response = $client->post('https://'.\Yii::$app->params['NEXTCLOUD_API_USERNAME'] .':'.\Yii::$app->params['NEXTCLOUD_API_PASSWORD'] .'@'.\Yii::$app->params['NEXTCLOUD_API_HOSTNAME'] .'/ocs/v1.php/cloud/users/'.$user.'/groups', [
            'body' => $data,
            'headers' =>$headers
        ]);
        $dataxml =simplexml_load_string($response->getBody()->getContents());
        if($dataxml->meta->statuscode == 100){
            $nextcloudlog = new nextcloudlog();
            $nextcloudlog->sessionid = Yii::$app->session->getId();
            $nextcloudlog->type ="getUpdateUsergroup";
            $nextcloudlog->content ='https://'.\Yii::$app->params['NEXTCLOUD_API_USERNAME'] .':'.\Yii::$app->params['NEXTCLOUD_API_PASSWORD'] .'@'.\Yii::$app->params['NEXTCLOUD_API_HOSTNAME'] .'/ocs/v1.php/cloud/users/'.$user.'/groups';
            $nextcloudlog->postfiels =$data;
            $nextcloudlog->result =user::ResultStatuscode($dataxml->meta->statuscode,$user,$group);
            $nextcloudlog->save();
//            user::UpdateUsergroup($user,$group);
            return $dataxml;
        }else{
            $nextcloudlog = new nextcloudlog();
            $nextcloudlog->sessionid = Yii::$app->session->getId();
            $nextcloudlog->type ="getUpdateUsergroup";
            $nextcloudlog->content ='https://'.\Yii::$app->params['NEXTCLOUD_API_USERNAME'] .':'.\Yii::$app->params['NEXTCLOUD_API_PASSWORD'] .'@'.\Yii::$app->params['NEXTCLOUD_API_HOSTNAME'] .'/ocs/v1.php/cloud/users/'.$user.'/groups';
            $nextcloudlog->postfiels =$data;
            $nextcloudlog->result =user::ResultStatuscode($dataxml->meta->statuscode,$user,$group);
            $nextcloudlog->save();
            $json = json_encode($dataxml);
            \app\components\RocketChatComponent::RocketChatTask($user,"Nextcloud getAdduser",$json);
            return $dataxml;
        }

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

    public static function UserExist($user) {
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


    public static function ResultStatuscode($statuscode,$user,$group,$email =null,$password =null,$quota =null) {
        switch ($statuscode) {
            case 100:
                $resultdata= "successful";
                break;
            case 101:
                $resultdata= "invalid input data";
                break;
            case 102:
                $resultdata= "username already exists";
                break;
            case 103:
                $resultdata= "unknown error occurred whilst adding the user";
                break;
            case 104:
                $resultdata= "group does not exist";
                break;
            case 105:
                $resultdata= "insufficient privileges for group";
                break;
            case 106:
                $resultdata= "no group specified (required for subadmins)";
                break;
            case 107:
                $resultdata= "all errors that contain a hint - for example “Password is among the 1,000,000 most common ones. Please make it unique.” (this code was added in 12.0.6 & 13.0.1)";
                break;
            case 108:
                $resultdata= "password and email empty. Must set password or an email";
                break;
            case 109:
                $resultdata= "invitation email cannot be send";
                break;
        }
        return $resultdata;
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
