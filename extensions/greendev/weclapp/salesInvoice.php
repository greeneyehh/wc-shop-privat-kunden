<?php


namespace app\extensions\greendev\weclapp;
use GuzzleHttp\Client;
use Yii;
use app\models\logserver\weclapplog;

class salesInvoice
{
    public static function createInvoice($senddata,$items) {
        $weclapplog = new weclapplog();
        $now = new \DateTime('now', new \DateTimeZone('UTC'));
        \app\extensions\greendev\SalesInvoiceTask\SalesInvoiceTask::setSalesInvoiceTask($senddata,$items);
        $unixTime = $now->getTimestamp();
        $salesInvoiceItems= array();
        $paycycle=null;
        foreach ($items as $key=>$value) {
            $push = array();
            $push['articleId'] = $value['id'];
            $push['version'] = '0';
           // $push['positionNumber'] = $key + 1;
            $description =article::getByIdArticle($value['id']);
            $description = json_decode($description,true);
            $description =str_replace('IhrName.windcloud.de',$value['domain'],$description['description']);
            $push['description'] = $description;
            $paycycle =$value['paycycle'];
            array_push($salesInvoiceItems,$push);
            $optionkey =$key;
               if(isset($value['option'])){
                    foreach ($value['option'] as $key2=>$option) {
                       $push = array();
                       $push['articleId'] = $option['id'];
                       $push['version'] = '0';
                       array_push($salesInvoiceItems,$push);
                   }
               }

        }
        $data = array(
        "customerNumber"=> $senddata,
        "salesInvoiceItems"=> $salesInvoiceItems,
        "sentToRecipient"=> true,
        "servicePeriodFrom"=> round($unixTime * 1000),
        "servicePeriodTo"=> round(strtotime("+$paycycle month", $unixTime) * 1000) ,
        "paymentMethodName"	=> "Online Zahlungsservice",
        "status"=> "BOOKED"
        );
        $data_string = json_encode($data);
        $client = new Client();
        $headers = [
            'Content-Type' => 'application/json',
            'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY'],
            'Content-Length: ' . strlen($data_string)
        ];
        try {
        $response = $client->post( \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/salesInvoice', [
            'body' => $data_string,
            'headers' =>$headers
        ]);
            $weclapplog->sessionid = Yii::$app->session->getId();
            $weclapplog->type ="<div class='alert alert-success alert-dismissible'>createInvoice</div>";
            $weclapplog->content ='<div class="alert alert-success alert-dismissible">'.$data_string.'</div>';
            $weclapplog->result ='<div class="alert alert-success alert-dismissible">'.$response->getBody()->getContents().'</div>';
            if($weclapplog->validate()){
                $weclapplog->save();
            }
            return $response->getBody()->getContents();
        } catch (\Exception $e) {
            $weclapplog->sessionid = Yii::$app->session->getId();
            $weclapplog->type ="<div class='alert alert-danger alert-dismissible'>createInvoice</div>";
            $weclapplog->content ="<div class='alert alert-danger alert-dismissible'>".$data_string.'</div>';
            $weclapplog->result ='<div class="alert alert-danger alert-dismissible">'.$e->getMessage().'</div>';
            if($weclapplog->validate()){
                $weclapplog->save();
            }
            //\app\components\RocketChatComponent::RocketChatTask($senddata,"createInvoice",$e->getMessage());
            return $e->getCode();
        }



    }

    public static function createInvoiceTask($senddata,$items) {
        $weclapplog = new weclapplog();
        $now = new \DateTime('now', new \DateTimeZone('UTC'));
        $unixTime = $now->getTimestamp();
        $salesInvoiceItems= array();
        $paycycle=null;
        foreach ($items as $key=>$value) {
            $push = array();
            $push['articleId'] = $value['id'];
            $push['version'] = '0';
            $description =article::getByIdArticle($value['id']);
            $description = json_decode($description,true);
            $description =str_replace('IhrName.windcloud.de',$value['domain'],$description['description']);
            $push['description'] = $description;
            $paycycle =$value['paycycle'];
            array_push($salesInvoiceItems,$push);
            $optionkey =$key;
               if(isset($value['option'])){
                    foreach ($value['option'] as $key2=>$option) {
                       $push = array();
                       $push['articleId'] = $option['id'];
                       $push['version'] = '0';
                       array_push($salesInvoiceItems,$push);
                   }
               }

        }
        $data = array(
        "customerNumber"=> $senddata,
        "salesInvoiceItems"=> $salesInvoiceItems,
        "sentToRecipient"=> true,
        "servicePeriodFrom"=> round($unixTime * 1000),
        "servicePeriodTo"=> round(strtotime("+$paycycle month", $unixTime) * 1000) ,
        "paymentMethodName"	=> "Online Zahlungsservice",
        "status"=> "BOOKED"
        );
        $data_string = json_encode($data);
        $client = new Client();
        $headers = [
            'Content-Type' => 'application/json',
            'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY'],
            'Content-Length: ' . strlen($data_string)
        ];
        try {
            $response = $client->post( \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/salesInvoice', [
                'body' => $data_string,
                'headers' =>$headers
            ]);
            $weclapplog->sessionid = Yii::$app->session->getId();
            $weclapplog->type ="<div class='alert alert-success alert-dismissible'>createInvoice</div>";
            $weclapplog->content ='<div class="alert alert-success alert-dismissible">'.$data_string.'</div>';
            $weclapplog->result ='<div class="alert alert-success alert-dismissible">'.$response->getBody()->getContents().'</div>';
            if($weclapplog->validate()){
                $weclapplog->save();
            }
            return json_decode($response->getBody()->getContents(),true);
        } catch (\Exception $e) {
            $weclapplog->sessionid = Yii::$app->session->getId();
            $weclapplog->type ="<div class='alert alert-danger alert-dismissible'>createInvoice</div>";
            $weclapplog->content ="<div class='alert alert-danger alert-dismissible'>".$data_string.'</div>';
            $weclapplog->result ='<div class="alert alert-danger alert-dismissible">'.$e->getMessage().'</div>';
            if($weclapplog->validate()){
                $weclapplog->save();
            }
            \app\components\RocketChatComponent::RocketChatTask($senddata,"createInvoice",$e->getMessage());
            return $e->getCode();
        }



    }

    public static function getInvoice($customerNumber,$status) {
        $client = new Client();
        $response = $client->request('GET', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/salesInvoice?customerNumber-eq='.$customerNumber.'&status-eq='.$status, [
            'headers' => ['Content-Type' => 'application/json',
                'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY']]
        ]);
        return $response->getBody()->getContents();
    }

    public static function getInvoicePaid($customerNumber,$status) {
        $client = new Client();
        $response = $client->request('GET', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/salesInvoice?customerNumber-eq='.$customerNumber.'&paid-eq='.$status, [
            'headers' => ['Content-Type' => 'application/json',
                'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY']]
        ]);
        return $response->getBody()->getContents();
    }

    public static function getAllInvoice($customerNumber) {
        $client = new Client();
        $response = $client->request('GET', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/salesInvoice?customerNumber-eq='.$customerNumber.'&sort=-lastModifiedDate', [
            'headers' => ['Content-Type' => 'application/json',
                'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY']]
        ]);
        return $response->getBody()->getContents();
    }

    public static function getInvoicePDFName($id) {
        $client = new Client();
        $response = $client->request('GET', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/salesInvoice/id/'.$id, [
            'headers' => ['Content-Type' => 'application/json',
                'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY']]
        ]);
        return $response->getBody()->getContents();
    }


    public static function getInvoicePDF($id) {
        $client = new Client();
        $response = $client->request('GET', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/salesInvoice/id/'.$id.'/downloadLatestSalesInvoicePdf', [
            'headers' => ['Content-Type' => 'application/json',
                'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY']]
        ]);
        $result = $response->getBody()->getContents();

        $data= self::getInvoicePDFName($id);
        $Nameinvoice = json_decode($data,true);

        if($Nameinvoice['customerNumber'] == Yii::$app->user->identity['accountid']){
            $file =  $Nameinvoice['invoiceNumber'].'.pdf';
            $fileName = $Nameinvoice['invoiceNumber'].'.pdf';
            file_put_contents($file, $result);
            header('Content-type: application/pdf');
            return readfile($file);
        }else{
            throw new \yii\web\HttpException(403, "Der Zugriff ist nicht erlaubt!");
        }
    }


}