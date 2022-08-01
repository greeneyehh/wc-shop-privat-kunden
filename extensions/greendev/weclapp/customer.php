<?php


namespace app\extensions\greendev\weclapp;
use GuzzleHttp\Client;
use Yii;
use app\models\logserver\weclapplog;

class customer
{

    public static function getImportCustomer($page) {
        $client = new Client();
        $response = $client->request('GET', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/customer?pageSize=50&page='.$page, [
            'headers' => ['Content-Type' => 'application/json',
                'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY']]
        ]);
        return json_decode($response->getBody()->getContents(),true);
    }

    public static function getAllCustomer() {
        $client = new Client();
        $response = $client->request('GET', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/customer?pageSize=100000', [
            'headers' => ['Content-Type' => 'application/json',
                'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY']]
        ]);
        return json_decode($response->getBody()->getContents(),true);
    }

    public static function getCustomer() {
        $client = new Client();
        $response = $client->request('GET', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/article', [
            'headers' => ['Content-Type' => 'application/json',
                'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY']]
        ]);
        return json_decode($response->getBody()->getContents());
    }

    public static function setCustomer($senddata) {
        $weclapplog = new weclapplog();
        if($senddata['billing_shippingAddress']){
            $addresses[]= array(
            'version'=> '0',
            "salutation"=> $senddata['personal_salutation'],
            "firstName"=> $senddata['personal_firstname'],
            "lastName"=> $senddata['personal_lastname'],
            'city' => $senddata['billing_city'],
            'countryCode' => $senddata['billing_country'],
            'street1' => $senddata['billing_street'],
            'zipcode' => $senddata['billing_zipcode'],
            'invoiceAddress' =>false,
            'primeAddress' =>true
        );
            $addresses[]= array(
                'version'=> '1',
                "salutation"=> $senddata['shipping_salutation'],
                "firstName"=> $senddata['shipping_firstname'],
                "lastName"=> $senddata['shipping_lastname'],
                'city' => $senddata['shipping_city'],
                'countryCode' => $senddata['shipping_country'],
                'street1' => $senddata['shipping_street'],
                'zipcode' => $senddata['shipping_zipcode'],
                'invoiceAddress' =>true,
            );
        }else{
            $addresses[]= array(
                'version'=> '0',
                "salutation"=> $senddata['personal_salutation'],
                "firstName"=> $senddata['personal_firstname'],
                "lastName"=> $senddata['personal_lastname'],
                'city' => $senddata['billing_city'],
                'countryCode' => $senddata['billing_country'],
                'street1' => $senddata['billing_street'],
                'zipcode' => $senddata['billing_zipcode'],
                'primeAddress' =>true,
                "invoiceAddress"=> true
            );
        }
        $contacts[]= array(
            "salutation"=> $senddata['personal_salutation'],
            "firstName"=> $senddata['personal_firstname'],
            "lastName"=> $senddata['personal_lastname'],
            'email' => $senddata['personal_email'],
            'phone' => $senddata['personal_phone'],
        );
        $data = array(
            "customerNumber" => $senddata['accountid'],
            'phone' => $senddata['personal_phone'],
            'email' => $senddata['personal_email'],
            'salutation' => $senddata['personal_salutation'],
            'partyType' => $senddata['personal_customer_type'],
            'customerRating' => 'B',
            'company' => $senddata['billing_company'],
            'lastName' => $senddata['personal_lastname'],
            'firstName' => $senddata['personal_firstname'],
            'addresses' => $addresses,
            'customerCategoryName'=> 'Nextcloud',
            'vatRegistrationNumber'=> $senddata['billing_vatId'],
            'contacts'=>$contacts,
            'description'=> 'shop kunde',
            );
        $data_string = json_encode($data);
        $client = new Client();
        $response = $client->request('POST', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/customer', [
            'body' => $data_string,
            'headers' => ['Content-Type' => 'application/json',
                'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY'],
                'Content-Length: ' . strlen($data_string)]
        ]);
        $weclapplog->sessionid = Yii::$app->session->getId();
        $weclapplog->type ="Create Customer";
        $weclapplog->content =$data_string;
        $weclapplog->result =$response->getBody()->getContents();
        if($weclapplog->validate()){
            $weclapplog->save();
        } else {
            $errors = $weclapplog->errors;
        }

        return  $data_string;
    }

    public static function setUpdateCustomer($senddataid,$senddata) {
        $weclapplog = new weclapplog();
        $data_string = json_encode($senddata['result'][0]);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/customer/id/'.$senddataid);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $headers = array(
            'AuthenticationToken: ' . \Yii::$app->params['WECLAPP_API_KEY'],
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        $weclapplog->sessionid = Yii::$app->session->getId();
        $weclapplog->type ="UpdateCustomer";
        $weclapplog->content =$data_string;
        $weclapplog->result =$result;
        if($weclapplog->validate()){
            $weclapplog->save();
        } else {
            $errors = $weclapplog->errors;
        }

        return  $result;
    }

    public static function getByIdCustomer($id) {
        $client = new Client();
        $response = $client->request('GET', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/customer?customerNumber-eq='.$id, [
            'headers' => ['Content-Type' => 'application/json',
                'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY']]
        ]);
        return $response->getBody()->getContents();
    }

    public static function getByIdCustomerDelete($id) {

        $client = new Client();
        $response = $client->request('GET', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/customer?customerNumber-eq='.$id, [
            'headers' => ['Content-Type' => 'application/json',
                'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY']]
        ]);
        return $response->getBody()->getContents();

    }

    public static function getByMailCustomer($mail) {
        $client = new Client();
        $response = $client->request('GET', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/customer?email-eq='.$mail, [
            'headers' => ['Content-Type' => 'application/json',
                'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY']]
        ]);
        return $response->getBody()->getContents();
    }

}