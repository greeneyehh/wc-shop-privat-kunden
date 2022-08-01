<?php


namespace app\extensions\greendev\weclapp;

use GuzzleHttp\Client;
use Yii;
use app\models\logserver\weclapplog;
use app\models\relation\ticketCategoryUser;
use app\extensions\greendev\weclapp\customer;
class helpdesk
{

    public static function createTicket($senddata) {
        $weclapplog = new weclapplog();
        $priority =json_decode(json_encode(self::getTicketPriority()), true);
        $key = array_search(\Yii::$app->params['WECLAPP_API_TICKETPRIORITY'], array_column($priority['result'], 'name'));
        $customer = new customer();
        //$customerId =$customer::getByIdCustomer(Yii::$app->user->identity['accountid']);
         $customerId =json_decode($customer::getByIdCustomer(Yii::$app->user->identity['accountid']), true);
	$UserId = ticketCategoryUser::find()->where(['ticketCategoryId' => $senddata['area']])->one();
        if (! empty($UserId)) {
            $assignedUserId=   $UserId->assignedUserId;
        }else{
            $assignedUserId=  "2011";
        }
        $data = array(
            "customerNumber"=> Yii::$app->user->identity['accountid'],
            "customerId"=> $customerId['result'][0]['id'],
            "description"=> $senddata['message'],
            "subject"=> $senddata['subject'],
            "ticketCategoryId"=> $senddata['area'],
            "status"=>"ASSIGNED",
            "ticketStatus"=>"Wartend",

            "ticketStatusId"=> "228921",
            "ticketStatusName"=> "Zugewiesen",
            "ticketChannelId" =>"311952",
            "ticketChannelName" =>"Shop-Dashboard",
            "assignedUserId"=> $assignedUserId,
            "email"=>Yii::$app->user->identity['personal_email'],
            "ticketPriorityId"=>$priority['result'][$key]['id'],
        );
        $data_string = json_encode($data);
        $client = new Client();
        $response = $client->request('POST', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/ticket', [
            'body' => $data_string,
            'headers' => ['Content-Type' => 'application/json',
            'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY'],
            'Content-Length: ' . strlen($data_string)]
        ]);


        $weclapplog->sessionid = Yii::$app->session->getId();
        $weclapplog->type ="Create Ticket";
        $weclapplog->content =$data_string;
        $weclapplog->result =$response;
        if($weclapplog->validate()){
            $weclapplog->save();
        } else {
          $errors = $weclapplog->errors;
        }
        return  $response;
    }

    public static function shopCreateTicket($senddata) {

        $data = array(
            "customerNumber"=> Yii::$app->user->identity['accountid'],
            "description"=> $senddata['message'],
            "subject"=> $senddata['subject'],
            "ticketCategoryId"=> $senddata['area'],
            "status"=>"ASSIGNED",
            "ticketStatus"=>"Wartend",
            "ticketStatusId"=> "228921",
            "ticketStatusName"=> "Zugewiesen",
            "ticketChannelId" =>"311952",
            "ticketChannelName" =>"Shop-Dashboard",
            "assignedUserId"=> $senddata['assignedUserId'],
            "email"=>$senddata['personal_email'],
            "ticketPriorityId"=>$senddata['priority'],
        );
        $data_string = json_encode($data);
        $client = new Client();
        $response = $client->request('POST', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/ticket', [
            'body' => $data_string,
            'headers' => ['Content-Type' => 'application/json',
            'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY'],
            'Content-Length: ' . strlen($data_string)]
        ]);

        return  $response;
    }

    public static function getTicketCount($customerNumber) {
        $client = new Client();
        $response = $client->request('GET', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/ticket/count?customerNumber-eq='.$customerNumber.'&sort=-ticketNumber', [
            'headers' => ['Content-Type' => 'application/json',
                'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY']]
        ]);
        return $response->getBody()->getContents();
    }

    public static function getTicket($customerNumber) {
        $client = new Client();
        $response = $client->request('GET', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/ticket?customerNumber-eq='.$customerNumber.'&sort=-ticketNumber', [
            'headers' => ['Content-Type' => 'application/json',
                'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY']]
        ]);
        return $response->getBody()->getContents();
    }

    public static function getTicketByStatus($customerNumber,$status) {
        $client = new Client();
        $response = $client->request('GET', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/ticket?customerNumber-eq='.$customerNumber.'&ticketStatusName-eq='.$status.'&sort=-ticketNumber', [
            'headers' => ['Content-Type' => 'application/json',
                'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY']]
        ]);
        return $response->getBody()->getContents();
    }

    public static function getTicketByStatusPage($customerNumber,$page,$pageSize) {
        $client = new Client();
        $response = $client->request('GET', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/ticket?customerNumber-eq='.$customerNumber.'&sort=-ticketNumber&page='.$page.'&pageSize='.$pageSize, [
            'headers' => ['Content-Type' => 'application/json',
                'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY']]
        ]);
        return $response->getBody()->getContents();
    }

    public static function getTicketCategory() {
        $client = new Client();
        $response = $client->request('GET', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/ticketCategory', [
            'headers' => ['Content-Type' => 'application/json',
                'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY']]
        ]);
        return $response->getBody()->getContents();
    }

    public static function getUser() {
        $client = new Client();
        $response = $client->request('GET', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/user', [
            'headers' => ['Content-Type' => 'application/json',
                'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY']]
        ]);
        return $response->getBody()->getContents();
    }

    public static function getTicketPriority () {
        $client = new Client();
        $response = $client->request('GET', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/ticketPriority', [
            'headers' => ['Content-Type' => 'application/json',
                'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY']]
        ]);
        return json_decode($response->getBody()->getContents());
    }

    public static function getTicketticketStatus () {
        $client = new Client();
        $response = $client->request('GET', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/ticketStatus', [
            'headers' => ['Content-Type' => 'application/json',
                'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY']]
        ]);
        return json_decode($response->getBody()->getContents());
    }


}
