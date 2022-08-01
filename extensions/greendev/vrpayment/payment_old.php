<?php

namespace app\extensions\greendev\vrpayment;
use app\extensions\greendev\weclapp\salesInvoice;
use phpDocumentor\Reflection\Types\This;
use Yii;
use app\models\logserver\vrpaymentlog;
use app\models\config\vrpayconfig;
use app\models\Account;

class payment
{


    public static function getRegistration($brand)
    {
        $vrpayconfig = vrpayconfig::find()->asArray()->all();
        $keyToken = array_search('Token', array_column($vrpayconfig, 'name'));
        $keyUrl = array_search('Url', array_column($vrpayconfig, 'name'));
        $session = Yii::$app->session;
        $tempArray = $session->get('ShoppingCart');
        $price=0;
        foreach ($tempArray as &$value) {
            $price +=$value['price']*Yii::$app->params['STEUERSATZGANZ'];
        }
        $accountid =$session->get('accountid');
        $account = Account::find()->where(['accountid' => $accountid])->one();
        $url = $vrpayconfig[$keyUrl]['variable']."/v1/checkouts";
        $data = "entityId=".$brand;//\Yii::$app->params[$pay];
        $data .="&amount=".number_format($price, 2, '.', '');
        $data .="&currency=EUR";
        //$data .="&paymentType=DB";
        $data .="&createRegistration=true";
        $data .="&customer.merchantCustomerId=".$accountid;
        $data .="&customer.givenName=".$account['personal_firstname'];
        $data .="&customer.surname=".$account['personal_lastname'];
        $data .="&customer.phone=".$account['personal_phone'];
        $data .="&customer.email=".$account['personal_email'];
        $data .="&customer.companyName=".$account['billing_company'];
        $data .="&customer.ip=".Yii::$app->getRequest()->getUserIP();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization:Bearer '.$vrpayconfig[$keyToken]['variable']));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);

        $vrpaymentlog = new vrpaymentlog();
        $vrpaymentlog->sessionid = Yii::$app->session->getId();
        $vrpaymentlog->accountid = $accountid;
        $vrpaymentlog->type ="getRegistration";
        $vrpaymentlog->content =$url.'/'.$data;
        $vrpaymentlog->result =$responseData;
        $responseDatalog = json_decode($responseData, true);
        $vrpaymentlog->description= $responseDatalog['result']['description'];
        $checkoutId =$responseDatalog['id'];
        $vrpaymentlog->save();

       // return payment::getCheckoutsRegistration($checkoutId,$brand);
        return $responseData;

    }

    public static function getCheckoutsRegistration($checkoutId,$brand)
    {
        $vrpayconfig = vrpayconfig::find()->asArray()->all();
        $keyToken = array_search('Token', array_column($vrpayconfig, 'name'));
        $keyUrl = array_search('Url', array_column($vrpayconfig, 'name'));
        $session = Yii::$app->session;
        $tempArray = $session->get('ShoppingCart');
        $price=0;
        foreach ($tempArray as &$value) {
            $price +=$value['price']*Yii::$app->params['STEUERSATZGANZ'];
        }
        $accountid =$session->get('accountid');
        $account = Account::find()->where(['accountid' => $accountid])->one();
        $url = $vrpayconfig[$keyUrl]['variable']."/v1/checkouts/".$checkoutId."/registration";
       // $data .= "entityId=".$brand;//\Yii::$app->params[$pay];
        $data ="&amount=".number_format($price, 2, '.', '');
        $data .="&currency=EUR";
        $data .="&paymentType=DB";
        $data .="&recurringType=INITIAL";
        $data .="&customer.merchantCustomerId=".$accountid;
        $data .="&customer.givenName=".$account['personal_firstname'];
        $data .="&customer.surname=".$account['personal_lastname'];
        $data .="&customer.phone=".$account['personal_phone'];
        $data .="&customer.email=".$account['personal_email'];
        $data .="&customer.companyName=".$account['billing_company'];
        $data .="&customer.ip=".Yii::$app->getRequest()->getUserIP();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization:Bearer '.$vrpayconfig[$keyToken]['variable']));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);

        $vrpaymentlog = new vrpaymentlog();
        $vrpaymentlog->sessionid = Yii::$app->session->getId();
        $vrpaymentlog->accountid = $accountid;
        $vrpaymentlog->type ="getCheckouts";
        $vrpaymentlog->content =$url.'/'.$data;;
        $vrpaymentlog->result =$responseData;
        $responseDatalog = json_decode($responseData, true);
        $vrpaymentlog->description= $responseDatalog['result']['description'];
        $vrpaymentlog->save();
        return $responseData;
    }

    public static function getCheckouts($brand)
    {
        $vrpayconfig = vrpayconfig::find()->asArray()->all();
        $keyToken = array_search('Token', array_column($vrpayconfig, 'name'));
        $keyUrl = array_search('Url', array_column($vrpayconfig, 'name'));
        $session = Yii::$app->session;
        $tempArray = $session->get('ShoppingCart');
        $price=0;
        foreach ($tempArray as &$value) {
            $price +=$value['price']*Yii::$app->params['STEUERSATZGANZ'];
        }
        $accountid =$session->get('accountid');
        $account = Account::find()->where(['accountid' => $accountid])->one();
        $url = $vrpayconfig[$keyUrl]['variable']."/v1/checkouts";
        $data = "entityId=".$brand;//\Yii::$app->params[$pay];
        $data .="&amount=".number_format($price, 2, '.', '');
        $data .="&currency=EUR";
        $data .="&paymentType=DB";
        $data .="&notificationUrl=".\Yii::$app->params['BASE_URL']."/security/notification";
        $data .="&createRegistration=true";
        $data .="&customer.merchantCustomerId=".$accountid;
        $data .="&customer.givenName=".$account['personal_firstname'];
        $data .="&customer.surname=".$account['personal_lastname'];
        $data .="&customer.phone=".$account['personal_phone'];
        $data .="&customer.email=".$account['personal_email'];
        $data .="&customer.companyName=".$account['billing_company'];
        $data .="&customer.ip=".Yii::$app->getRequest()->getUserIP();
        //$data .="&createRegistration=true";
        //$data .="&testMode=EXTERNAL";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization:Bearer '.$vrpayconfig[$keyToken]['variable']));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);

        $vrpaymentlog = new vrpaymentlog();
        $vrpaymentlog->sessionid = Yii::$app->session->getId();
        $vrpaymentlog->accountid = $accountid;
        $vrpaymentlog->type ="getCheckouts";
        $vrpaymentlog->content =$data;
        $vrpaymentlog->result =$responseData;
        $responseDatalog = json_decode($responseData, true);
        $vrpaymentlog->description= $responseDatalog['result']['description'];
        $vrpaymentlog->save();
        return $responseData;
    }

    public static function getAjaxcheckouts($brand,$invoicenumber,$id)
    {
        $vrpayconfig = vrpayconfig::find()->asArray()->all();
        $keyToken = array_search('Token', array_column($vrpayconfig, 'name'));
        $keyUrl = array_search('Url', array_column($vrpayconfig, 'name'));
        $session = Yii::$app->session;
        $info = salesInvoice::getInvoicePDFName($id);
        $priceinvoice = json_decode($info,true);
        $accountid =$session->get('accountid');
        $pay ='VR-Pay-'.$brand;
        $account = Account::find()->where(['accountid' => $accountid])->one();
        $url = $vrpayconfig[$keyUrl]['variable']."/v1/checkouts";
        $data = "entityId=".Yii::$app->params[$pay];
        $data .="&amount=".number_format($priceinvoice['grossAmount'], 2, '.', '');
        $data .="&currency=EUR";
        $data .="&paymentType=DB";
        $data .="&customer.merchantCustomerId=".$accountid;
        $data .="&customer.givenName=".$account['personal_firstname'];
        $data .="&customer.surname=".$account['personal_lastname'];
        $data .="&customer.phone=".$account['personal_phone'];
        $data .="&customer.email=".$account['personal_email'];
        $data .="&customer.companyName=".$account['billing_company'];
        $data .="&customer.ip=".Yii::$app->getRequest()->getUserIP();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization:Bearer '.$vrpayconfig[$keyToken]['variable']));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        $vrpaymentlog = new vrpaymentlog();
        $vrpaymentlog->sessionid = Yii::$app->session->getId();
        $vrpaymentlog->accountid =Yii::$app->user->identity->accountid;
        $vrpaymentlog->type ="getAjaxcheckouts";
        $vrpaymentlog->content =$data;
        $vrpaymentlog->result =$responseData;

        $vrpaymentlog->save();

        return $responseData;
    }

    public static function  getAjaxPayment($brand,$id){
        $vrpayconfig = vrpayconfig::find()->asArray()->all();
        $keyToken = array_search('Token', array_column($vrpayconfig, 'name'));
        $keyUrl = array_search('Url', array_column($vrpayconfig, 'name'));
        $url = $vrpayconfig[$keyUrl]['variable']."/v1/checkouts/".$id."/registration";
        $url .= "?entityId=".$brand;//Yii::$app->params[$pay];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization:Bearer '.$vrpayconfig[$keyToken]['variable']));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);

        echo '<pre>';
        print_r($responseData);
        die();
        $responseData = json_decode($responseData, true);
        $ResultCodes= $responseData['result']['code'];
        if(preg_match("/^(000\.000\.|000\.100\.1|000\.[36])/",$ResultCodes)|| preg_match("/^(000\.400\.0[^3]|000\.400\.100)/",$ResultCodes)) {




        $session = Yii::$app->session;
        $accountid =$session->get('accountid');
        $vrpaymentlog = new vrpaymentlog();
        $vrpaymentlog->sessionid = Yii::$app->session->getId();
        $vrpaymentlog->accountid = $accountid;
        $vrpaymentlog->type ="getAjaxPayment";
        $vrpaymentlog->content =$url;
        $vrpaymentlog->result =$responseData;
        $vrpaymentlog->description= $responseData['result']['description'];
        $vrpaymentlog->save();
        self::getPaymentStatus($brand, $responseData['id']);
        }
        return $responseData;

    }

    public static function  getPayment($brand,$id){
        $vrpayconfig = vrpayconfig::find()->asArray()->all();
        $keyToken = array_search('Token', array_column($vrpayconfig, 'name'));
        $keyUrl = array_search('Url', array_column($vrpayconfig, 'name'));
        $pay ='VR-Pay-'.$brand;
        $url = $vrpayconfig[$keyUrl]['variable']."/v1/checkouts/".$id."/registration";
        $url .= "?entityId=".Yii::$app->params[$pay];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization:Bearer '.$vrpayconfig[$keyToken]['variable']));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        $session = Yii::$app->session;
        $accountid =$session->get('accountid');
        $vrpaymentlog = new vrpaymentlog();
        $vrpaymentlog->sessionid = Yii::$app->session->getId();
        $vrpaymentlog->accountid = $accountid;
        $vrpaymentlog->type ="getPayment";
        $vrpaymentlog->content =$url;
        $vrpaymentlog->result =$responseData;
        $vrpaymentlog->save();
        return $responseData;

    }

    public static function  getAjaxPaymentStatus($brand,$id){
        $vrpayconfig = vrpayconfig::find()->asArray()->all();
        $keyToken = array_search('Token', array_column($vrpayconfig, 'name'));
        $keyUrl = array_search('Url', array_column($vrpayconfig, 'name'));
        $url = $vrpayconfig[$keyUrl]['variable']."/v1/query/".$id;
        $url .= "?entityId=".$brand;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization:Bearer '.$vrpayconfig[$keyToken]['variable']));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        $session = Yii::$app->session;
        $vrpaymentlog = new vrpaymentlog();
        $vrpaymentlog->sessionid = Yii::$app->session->getId();
        $accountid =$session->get('accountid');
        $vrpaymentlog->accountid =$accountid;
        $vrpaymentlog->type ="getPaymentStatus";
        $vrpaymentlog->content =$url;
        $vrpaymentlog->result =$responseData;
        $responseData = json_decode($responseData, true);
        // $ResultCodes= $responseData['result']['code'];
        $vrpaymentlog->description= $responseData['result']['description'];
        $vrpaymentlog->save();
        return $responseData;
    }

    public static function  getPaymentStatus($brand,$id){
        $vrpayconfig = vrpayconfig::find()->asArray()->all();
        $keyToken = array_search('Token', array_column($vrpayconfig, 'name'));
        $keyUrl = array_search('Url', array_column($vrpayconfig, 'name'));

        $url = $vrpayconfig[$keyUrl]['variable']."/v1/query/".$id;
        $url .= "?entityId=".$brand;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization:Bearer '.$vrpayconfig[$keyToken]['variable']));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        $session = Yii::$app->session;
        $vrpaymentlog = new vrpaymentlog();
        $vrpaymentlog->sessionid = Yii::$app->session->getId();
        $accountid =$session->get('accountid');
        $vrpaymentlog->accountid =$accountid;
        $vrpaymentlog->type ="getPaymentStatus";
        $vrpaymentlog->content =$url;
        $vrpaymentlog->result =$responseData;
        $responseData = json_decode($responseData, true);
        $vrpaymentlog->description= $responseData['result']['description'];


        $vrpaymentlog->save();
        return $responseData;
    }




}