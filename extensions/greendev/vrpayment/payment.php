<?php

namespace app\extensions\greendev\vrpayment;
use app\extensions\greendev\weclapp\salesInvoice;
use GuzzleHttp\Client;
use phpDocumentor\Reflection\Types\This;
use Yii;
use app\models\logserver\vrpaymentlog;
use app\models\config\vrpayconfig;
use app\models\config\vrpaybrandsconfig;
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
        foreach ($tempArray as $value) {
            $price +=$value['price']*Yii::$app->params['STEUERSATZGANZ'];
            if(isset($value['option'])){
                foreach ($value['option'] as $option){
                    $price += $option['price']*Yii::$app->params['STEUERSATZGANZ'];
                }
            }
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

        $client = new Client();
        $response = $client->request('POST', $url, [
            'body' => $data,
            'headers' => [
                'Authorization' => 'Bearer '.$vrpayconfig[$keyToken]['variable'],
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        ]);
        $responseData = $response->getBody()->getContents();

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

    public static function getRegistrationPayPal($brand)
    {
        $vrpayconfig = vrpayconfig::find()->asArray()->all();
        $keyToken = array_search('Token', array_column($vrpayconfig, 'name'));
        $keyUrl = array_search('Url', array_column($vrpayconfig, 'name'));
        $session = Yii::$app->session;
        $tempArray = $session->get('ShoppingCart');
        $price=0;
        foreach ($tempArray as $value) {
            $price +=$value['price']*Yii::$app->params['STEUERSATZGANZ'];
            if(isset($value['option'])){
                foreach ($value['option'] as $option){
                    $price += $option['price']*Yii::$app->params['STEUERSATZGANZ'];
                }
            }
        }
        $accountid =$session->get('accountid');
        $account = Account::find()->where(['accountid' => $accountid])->one();
        $url = $vrpayconfig[$keyUrl]['variable']."/v1/checkouts";
        $data = "entityId=".$brand;
        $data .="&createRegistration=true";
        $data .="&customer.merchantCustomerId=".$accountid;
        $data .="&customer.givenName=".$account['personal_firstname'];
        $data .="&customer.surname=".$account['personal_lastname'];
        $data .="&customer.phone=".$account['personal_phone'];
        $data .="&customer.email=".$account['personal_email'];
        $data .="&customer.companyName=".$account['billing_company'];
        $data .="&customer.ip=".Yii::$app->getRequest()->getUserIP();
        $client = new Client();
        $response = $client->request('POST', $url, [
            'body' => $data,
            'headers' => [
                'Authorization' => 'Bearer '.$vrpayconfig[$keyToken]['variable'],
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        ]);

        $responseData = $response->getBody()->getContents();

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

    /*****************************SEPA-Lastschriftmandat**********************/

    public static function getRegistrationSepaMandate($sepamandat)
    {


        $search  = array('&');
        $replace = array('und');

        $session = Yii::$app->session;
        $vrpaybrandsconfig = vrpaybrandsconfig::find()->where(['name' => 'DIRECTDEBIT_SEPA'])->one();
        $vrpayconfig = vrpayconfig::find()->asArray()->all();
        $keyToken = array_search('Token', array_column($vrpayconfig, 'name'));
        $keyUrl = array_search('Url', array_column($vrpayconfig, 'name'));
        $vrpayconfig = vrpayconfig::find()->asArray()->all();
        $accountid =$session->get('accountid');
        $account = Account::find()->where(['accountid' => $accountid])->one();
        $url = $vrpayconfig[$keyUrl]['variable']."/v1/registrations";
        $data = "entityId=".$vrpaybrandsconfig['entityId'];
        $data .="&paymentBrand=DIRECTDEBIT_SEPA";
        $data .="&bankAccount.country=DE";
        $data .="&bankAccount.holder=".str_replace($search, $replace,$sepamandat['holder']);
        $data .="&bankAccount.iban=".$sepamandat['IBAN'];
        $data .="&bankAccount.mandate.id=SEPA_$accountid";
        $dateOfSignature = date("Y-m-d");
        $data .="&bankAccount.mandate.dateOfSignature=$dateOfSignature";
        $data .="&customer.merchantCustomerId=".$accountid;
        $data .="&customer.givenName=".$account['personal_firstname'];
        $data .="&customer.surname=".$account['personal_lastname'];
        $data .="&customer.phone=".$account['personal_phone'];
        $data .="&customer.email=".$account['personal_email'];
        $data .="&customer.companyName=".str_replace($search, $replace,$account['billing_company']);
        $data .="&customer.ip=".Yii::$app->getRequest()->getUserIP();
        $client = new Client();
        $response = $client->request('POST', $url, [
            'body' => $data,
            'headers' => [
                'Authorization' => 'Bearer '.$vrpayconfig[$keyToken]['variable'],
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        ]);
        $responseData = $response->getBody()->getContents();
        $responseDatalog = json_decode($responseData, true);
        $vrpaymentlog = new vrpaymentlog();
        $vrpaymentlog->sessionid = Yii::$app->session->getId();
        $vrpaymentlog->accountid = $accountid;
        $vrpaymentlog->type ="getRegistrationSepaMandate";
        $vrpaymentlog->content =$url.'/'.$data;
        $vrpaymentlog->result =$responseData;
        $vrpaymentlog->description= $responseDatalog['result']['description'];
        if($vrpaymentlog->validate()) {
            $vrpaymentlog->save();
        }
        $ResultCodes= $responseDatalog['result']['code'];
        if(preg_match("/^(000\.000\.|000\.100\.1|000\.[36])/",$ResultCodes)) {
            $ResultID= $responseDatalog['id'];
            return payment::getFirstPaySepaMandate($ResultID,$vrpaybrandsconfig['entityId']);
        }
        elseif(preg_match("/^(100\.100|100.2[01])/",$ResultCodes)) {
            return 'Error';
        } else {
            return 'Error';
        }
    }

    public static function getFirstPaySepaMandate($ResultID)
    {
        $search  = array('&');
        $replace = array('und');
        $vrpaybrandsconfig = vrpaybrandsconfig::find()->where(['name' => 'DIRECTDEBIT_SEPA'])->one();
        $vrpayconfig = vrpayconfig::find()->asArray()->all();
        $keyToken = array_search('Token', array_column($vrpayconfig, 'name'));
        $keyUrl = array_search('Url', array_column($vrpayconfig, 'name'));
        $session = Yii::$app->session;
        $tempArray = $session->get('ShoppingCart');
        $price=0;
        foreach ($tempArray as $value) {
            $price +=$value['price']*Yii::$app->params['STEUERSATZGANZ'];
            if(isset($value['option'])){
                foreach ($value['option'] as $option){
                    $price += $option['price']*Yii::$app->params['STEUERSATZGANZ'];
                }
            }
        }
        $accountid =$session->get('accountid');
        $account = Account::find()->where(['accountid' => $accountid])->one();
        $url = $vrpayconfig[$keyUrl]['variable']."/v1/registrations/".$ResultID."/payments";
        $data = "entityId=".$vrpaybrandsconfig['entityId'];
        $data .="&amount=".number_format($price, 2, '.', '');
        $data .="&currency=EUR";
        $data .="&paymentType=DB";
        $data .="&recurringType=REPEATED";
        $data .="&customer.merchantCustomerId=".$accountid;
        $data .="&customer.givenName=".$account['personal_firstname'];
        $data .="&customer.surname=".$account['personal_lastname'];
        $data .="&customer.phone=".$account['personal_phone'];
        $data .="&customer.email=".$account['personal_email'];
        $data .="&customer.companyName=".str_replace($search, $replace,$account['billing_company']);
        $data .="&customer.ip=".Yii::$app->getRequest()->getUserIP();
        $client = new Client();
        $response = $client->request('POST', $url, [
            'body' => $data,
            'headers' => [
                'Authorization' => 'Bearer '.$vrpayconfig[$keyToken]['variable'],
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]

        ]);
        $responseData = $response->getBody()->getContents();
        $vrpaymentlog = new vrpaymentlog();
        $vrpaymentlog->sessionid = Yii::$app->session->getId();
        $vrpaymentlog->accountid = $accountid;
        $vrpaymentlog->type ="getFirstPaySepaMandate";
        $vrpaymentlog->content =$data;
        $vrpaymentlog->result =$responseData;
        $responseDatalog = json_decode($responseData, true);
        $vrpaymentlog->description= $responseDatalog['result']['description'];
        if($vrpaymentlog->validate()) {
            $vrpaymentlog->save();
        }
        $array = array(
            "response" => $responseData,
            "registrationsId" => $ResultID,
            "cart" => $tempArray,
            "accountid" => $accountid,
            "resultcode"=>$responseDatalog['result']['code'],
        );

        return $array;
    }

    public static function getRegistrationDashboardSepaMandate($sepamandat,$mandatdata)
    {
        $vrpaybrandsconfig = vrpaybrandsconfig::find()->where(['name' => 'DIRECTDEBIT_SEPA'])->one();
        $vrpayconfig = vrpayconfig::find()->asArray()->all();
        $keyToken = array_search('Token', array_column($vrpayconfig, 'name'));
        $keyUrl = array_search('Url', array_column($vrpayconfig, 'name'));
        $vrpayconfig = vrpayconfig::find()->asArray()->all();
        $account = Account::find()->where(['accountid' => $mandatdata['accountid']])->one();
        $url = $vrpayconfig[$keyUrl]['variable']."/v1/registrations";
        $data = "entityId=".$vrpaybrandsconfig['entityId'];
        $data .="&paymentBrand=DIRECTDEBIT_SEPA";
        $data .="&bankAccount.country=DE";
        $data .="&bankAccount.holder=".$sepamandat['holder'];
        $data .="&bankAccount.iban=".$sepamandat['IBAN'];
        $data .="&bankAccount.mandate.id=SEPA_".$mandatdata['accountid'];
        $dateOfSignature = date("Y-m-d");
        $data .="&bankAccount.mandate.dateOfSignature=$dateOfSignature";
        $data .="&customer.merchantCustomerId=".$mandatdata['accountid'];
        $data .="&customer.givenName=".$account['personal_firstname'];
        $data .="&customer.surname=".$account['personal_lastname'];
        $data .="&customer.phone=".$account['personal_phone'];
        $data .="&customer.email=".$account['personal_email'];
        $data .="&customer.companyName=".$account['billing_company'];
        $data .="&customer.ip=".Yii::$app->getRequest()->getUserIP();
        $client = new Client();
        $response = $client->request('POST', $url, [
            'body' => $data,
            'headers' => [
                'Authorization' => 'Bearer '.$vrpayconfig[$keyToken]['variable'],
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        ]);
        $responseData = $response->getBody()->getContents();
        $vrpaymentlog = new vrpaymentlog();
        $vrpaymentlog->sessionid = Yii::$app->session->getId();
        $vrpaymentlog->accountid = $mandatdata['accountid'];
        $vrpaymentlog->type ="getRegistrationDashboardSepaMandate";
        $vrpaymentlog->content =$url.'/'.$data;
        $vrpaymentlog->result =$responseData;
        $responseDatalog = json_decode($responseData, true);
        $vrpaymentlog->description= $responseDatalog['result']['description'];
        $checkoutId =$responseDatalog['id'];
        if($vrpaymentlog->validate()) {
            $vrpaymentlog->save();
        }
        $ResultCodes= $responseDatalog['result']['code'];
        $ResultID= $responseDatalog['id'];
        if(preg_match("/^(000\.000\.|000\.100\.1|000\.[36])/",$ResultCodes)) {
            return payment::getFirstPayDashboardSepaMandate($ResultID,$mandatdata['invoicenumber'],$mandatdata['invoiceid']);
        }

    }

    public static function getFirstPayDashboardSepaMandate($ResultID,$invoicenumber,$invoiceid)
    {
        $vrpaybrandsconfig = vrpaybrandsconfig::find()->where(['name' => 'DIRECTDEBIT_SEPA'])->one();
        $vrpayconfig = vrpayconfig::find()->asArray()->all();
        $keyToken = array_search('Token', array_column($vrpayconfig, 'name'));
        $keyUrl = array_search('Url', array_column($vrpayconfig, 'name'));
        $session = Yii::$app->session;
        $info = salesInvoice::getInvoicePDFName($invoiceid);
        $priceinvoice = json_decode($info,true);
        $accountid =$session->get('accountid');
        $account = Account::find()->where(['accountid' => $accountid])->one();
        $url = $vrpayconfig[$keyUrl]['variable']."/v1/registrations/".$ResultID."/payments";
        $data = "entityId=".$vrpaybrandsconfig['entityId'];
        $data .="&amount=".number_format($priceinvoice['grossAmount'], 2, '.', '');
        $data .="&currency=EUR";
        $data .="&paymentType=DB";
        $data .="&recurringType=REPEATED";
        $data .="&customer.merchantCustomerId=".$accountid;
        $data .="&customer.givenName=".$account['personal_firstname'];
        $data .="&customer.surname=".$account['personal_lastname'];
        $data .="&customer.phone=".$account['personal_phone'];
        $data .="&customer.email=".$account['personal_email'];
        $data .="&customer.companyName=".$account['billing_company'];
        $data .="&customer.ip=".Yii::$app->getRequest()->getUserIP();
        $client = new Client();
        $response = $client->request('POST', $url, [
            'body' => $data,
            'headers' => [
                'Authorization' => 'Bearer '.$vrpayconfig[$keyToken]['variable'],
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        ]);

        $responseData = $response->getBody()->getContents();

        $vrpaymentlog = new vrpaymentlog();
        $vrpaymentlog->sessionid = Yii::$app->session->getId();
        $vrpaymentlog->accountid = $accountid;
        $vrpaymentlog->type ="getFirstPayDashboardSepaMandate";
        $vrpaymentlog->content =$data;
        $vrpaymentlog->result =$responseData;
        $responseDatalog = json_decode($responseData, true);
        $vrpaymentlog->description= $responseDatalog['result']['description'];
        if($vrpaymentlog->validate()) {
            $vrpaymentlog->save();
        }
        $array = array(
            "response" => $responseData,
            "registrationsId" => $ResultID,
            "cart" => $info,
            "accountid" => $accountid,
            "resultcode"=>$responseDatalog['result']['code'],
        );

        return $array;
    }

    /*****************************Credit cards**********************/

    public static function getCheckoutCreditcardsRegistration($brand)
    {
        $search  = array('&');
        $replace = array('und');
        $vrpaybrandsconfig = vrpaybrandsconfig::find()->where(['name' => $brand])->one();
        $vrpayconfig = vrpayconfig::find()->asArray()->all();
        $keyToken = array_search('Token', array_column($vrpayconfig, 'name'));
        $keyUrl = array_search('Url', array_column($vrpayconfig, 'name'));
        $session = Yii::$app->session;
        $tempArray = $session->get('ShoppingCart');
        $price=0;
        foreach ($tempArray as $value) {
            $price +=$value['price']*Yii::$app->params['STEUERSATZGANZ'];
            if(isset($value['option'])){
                foreach ($value['option'] as $option){
                    $price += $option['price']*Yii::$app->params['STEUERSATZGANZ'];
                }
            }
        }
        $accountid =$session->get('accountid');
        $account = Account::find()->where(['accountid' => $accountid])->one();
        $url = $vrpayconfig[$keyUrl]['variable']."/v1/checkouts";
        $data = "entityId=".$vrpaybrandsconfig['entityId'];
        $data .="&amount=".number_format($price, 2, '.', '');
        $data .="&currency=EUR";
        $data .="&paymentType=DB";
        $data .="&createRegistration=true";
        $data .="&customer.merchantCustomerId=".$accountid;
        $data .="&customer.givenName=".$account['personal_firstname'];
        $data .="&customer.surname=".$account['personal_lastname'];
        $data .="&customer.phone=".$account['personal_phone'];
        $data .="&customer.email=".$account['personal_email'];
        $data .="&customer.companyName=".str_replace($search, $replace,$account['billing_company']);
        $data .="&customer.ip=".Yii::$app->getRequest()->getUserIP();
        $client = new Client();
        $response = $client->request('POST', $url, [
            'body' => $data,
            'headers' => [
                'Authorization' => 'Bearer '.$vrpayconfig[$keyToken]['variable'],
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        ]);
        $responseData = $response->getBody()->getContents();
        $vrpaymentlog = new vrpaymentlog();
        $vrpaymentlog->sessionid = Yii::$app->session->getId();
        $vrpaymentlog->accountid = $accountid;
        $vrpaymentlog->type ="getCheckoutCreditcardsRegistration";
        $vrpaymentlog->content =$url.'/'.$data;
        $vrpaymentlog->result =$responseData;
        $responseDatalog = json_decode($responseData, true);
        $vrpaymentlog->description= $responseDatalog['result']['description'];
        //$checkoutId =$responseDatalog['id'];
        if($vrpaymentlog->validate()) {
            $vrpaymentlog->save();
        }

        // return payment::getCheckoutsRegistration($checkoutId,$brand);
        return $responseData;

    }


    public static function  getCreditcardsPayment($brand,$id){
        $vrpayconfig = vrpayconfig::find()->asArray()->all();
        $keyToken = array_search('Token', array_column($vrpayconfig, 'name'));
        $keyUrl = array_search('Url', array_column($vrpayconfig, 'name'));
        $vrpaybrandsconfig = vrpaybrandsconfig::find()->where(['name' => $brand])->one();
        $url = $vrpayconfig[$keyUrl]['variable']."/v1/checkouts/".$id."/registration";
        $url .= "?entityId=".$vrpaybrandsconfig['entityId'];

        $client = new Client();
        $response = $client->request('GET', $url, [
            'headers' => [
                'Authorization' => 'Bearer '.$vrpayconfig[$keyToken]['variable']
            ]
        ]);
        $responseData = $response->getBody()->getContents();

        $session = Yii::$app->session;
        $accountid =$session->get('accountid');
        $vrpaymentlog = new vrpaymentlog();
        $vrpaymentlog->sessionid = Yii::$app->session->getId();
        $vrpaymentlog->accountid = $accountid;
        $vrpaymentlog->type ="getCreditcardsPayment";
        $vrpaymentlog->content =$url;
        $vrpaymentlog->result =$responseData;
        if($vrpaymentlog->validate()) {
            $vrpaymentlog->save();
        }
        return $responseData;

    }

    public static function getCheckoutCreditcardsDashboardRegistration($brand,$invoicenumber,$invoiceid)
    {
        $vrpaybrandsconfig = vrpaybrandsconfig::find()->where(['name' => $brand])->one();
        $vrpayconfig = vrpayconfig::find()->asArray()->all();
        $keyToken = array_search('Token', array_column($vrpayconfig, 'name'));
        $keyUrl = array_search('Url', array_column($vrpayconfig, 'name'));
        $session = Yii::$app->session;
        $info = salesInvoice::getInvoicePDFName($invoiceid);
        $priceinvoice = json_decode($info,true);
        $accountid =$session->get('accountid');
        $account = Account::find()->where(['accountid' => $accountid])->one();
        $url = $vrpayconfig[$keyUrl]['variable']."/v1/checkouts";
        $data = "entityId=".$vrpaybrandsconfig['entityId'];
        $data .="&amount=".number_format($priceinvoice['grossAmount'], 2, '.', '');
        $data .="&currency=EUR";
        $data .="&paymentType=DB";
        $data .="&createRegistration=true";
        $data .="&customer.merchantCustomerId=".$accountid;
        $data .="&customer.givenName=".$account['personal_firstname'];
        $data .="&customer.surname=".$account['personal_lastname'];
        $data .="&customer.phone=".$account['personal_phone'];
        $data .="&customer.email=".$account['personal_email'];
        $data .="&customer.companyName=".$account['billing_company'];
        $data .="&customer.ip=".Yii::$app->getRequest()->getUserIP();
        $client = new Client();
        $response = $client->request('GET', $url, [
            'headers' => [
                'Authorization' => 'Bearer '.$vrpayconfig[$keyToken]['variable']
            ]
        ]);
        $responseData = $response->getBody()->getContents();
        $vrpaymentlog = new vrpaymentlog();
        $vrpaymentlog->sessionid = Yii::$app->session->getId();
        $vrpaymentlog->accountid = $accountid;
        $vrpaymentlog->type ="getCheckoutCreditcardsDashboardRegistration";
        $vrpaymentlog->content =$url.'/'.$data;
        $vrpaymentlog->result =$responseData;
        $responseDatalog = json_decode($responseData, true);
        $vrpaymentlog->description= $responseDatalog['result']['description'];
        //$checkoutId =$responseDatalog['id'];
        if($vrpaymentlog->validate()) {
            $vrpaymentlog->save();
        }

        // return payment::getCheckoutsRegistration($checkoutId,$brand);
        return $responseData;

    }

    public static function  getCreditcardsDashboardPayment($brand,$id){
        $vrpayconfig = vrpayconfig::find()->asArray()->all();
        $keyToken = array_search('Token', array_column($vrpayconfig, 'name'));
        $keyUrl = array_search('Url', array_column($vrpayconfig, 'name'));
        $vrpaybrandsconfig = vrpaybrandsconfig::find()->where(['name' => $brand])->one();
        $url = $vrpayconfig[$keyUrl]['variable'].$id;
        $url .= "?entityId=".$vrpaybrandsconfig['entityId'];
        $client = new Client();
        $response = $client->request('GET', $url, [
            'headers' => [
                'Authorization' => 'Bearer '.$vrpayconfig[$keyToken]['variable'],
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        ]);
        $responseData = $response->getBody()->getContents();
        $session = Yii::$app->session;
        $accountid =$session->get('accountid');
        $vrpaymentlog = new vrpaymentlog();
        $vrpaymentlog->sessionid = Yii::$app->session->getId();
        $vrpaymentlog->accountid = $accountid;
        $vrpaymentlog->type ="getCreditcardsPayment";
        $vrpaymentlog->content =$url;
        $vrpaymentlog->result =$responseData;
        if($vrpaymentlog->validate()) {
            $vrpaymentlog->save();
        }
        return $responseData;

    }

    /*****************************Credit cards**********************/

    /*****************************SOFORTUEBERWEISUNG**********************/

    public static function  getCheckoutSofortRegistration(){
        $vrpaybrandsconfig = vrpaybrandsconfig::find()->where(['name' => 'SOFORTUEBERWEISUNG'])->one();
        $vrpayconfig = vrpayconfig::find()->asArray()->all();
        $keyToken = array_search('Token', array_column($vrpayconfig, 'name'));
        $keyUrl = array_search('Url', array_column($vrpayconfig, 'name'));
        $ReturnUrl = array_search('ReturnUrl', array_column($vrpayconfig, 'name'));
        $session = Yii::$app->session;
        $tempArray = $session->get('ShoppingCart');
        $price=0;
        foreach ($tempArray as $value) {
            $price +=$value['price']*Yii::$app->params['STEUERSATZGANZ'];
            if(isset($value['option'])){
                foreach ($value['option'] as $option){
                    $price += $option['price']*Yii::$app->params['STEUERSATZGANZ'];
                }
            }
        }
        $accountid =$session->get('accountid');
        $account = Account::find()->where(['accountid' => $accountid])->one();
        $url = $vrpayconfig[$keyUrl]['variable']."/v1/payments";
        $data = "entityId=".$vrpaybrandsconfig['entityId'];
        $data .="&amount=".number_format($price, 2, '.', '');
        $data .="&currency=EUR";
        $data .="&shopperResultUrl=".$vrpayconfig[$ReturnUrl]['variable'].'?brand=SOFORTUEBERWEISUNG';
        $data .="&paymentBrand=SOFORTUEBERWEISUNG";
        $data .="&bankAccount.country=DE";
        $data .="&paymentType=DB";
        $data .="&recurringType=INITIAL";
        //  $data .="&testMode=EXTERNAL";
        $data .="&customer.merchantCustomerId=".$accountid;
        $data .="&customer.givenName=".$account['personal_firstname'];
        $data .="&customer.surname=".$account['personal_lastname'];
        $data .="&customer.phone=".$account['personal_phone'];
        $data .="&customer.email=".$account['personal_email'];
        $data .="&customer.companyName=".$account['billing_company'];
        $data .="&customer.ip=".Yii::$app->getRequest()->getUserIP();
        $client = new Client();
        $response = $client->request('POST', $url, [
            'body' => $data,
            'headers' => [
                'Authorization' => 'Bearer '.$vrpayconfig[$keyToken]['variable'],
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        ]);
        $responseData = $response->getBody()->getContents();

        $vrpaymentlog = new vrpaymentlog();
        $vrpaymentlog->sessionid = Yii::$app->session->getId();
        $vrpaymentlog->accountid = $accountid;
        $vrpaymentlog->type ="getCheckoutSofortRegistration";
        $vrpaymentlog->content =$data;
        $vrpaymentlog->result =$responseData;
        $responseDatalog = json_decode($responseData, true);
        $vrpaymentlog->description= $responseDatalog['result']['description'];
        if($vrpaymentlog->validate()) {
            $vrpaymentlog->save();
        }
        return $responseData;
    }

    public static function getRegistrationSofortSepaMandate($sepamandat)
    {
        $session = Yii::$app->session;
        $vrpaybrandsconfig = vrpaybrandsconfig::find()->where(['name' => 'DIRECTDEBIT_SEPA'])->one();
        $vrpayconfig = vrpayconfig::find()->asArray()->all();
        $keyToken = array_search('Token', array_column($vrpayconfig, 'name'));
        $keyUrl = array_search('Url', array_column($vrpayconfig, 'name'));
        $vrpayconfig = vrpayconfig::find()->asArray()->all();
        $accountid =$session->get('accountid');
        $account = Account::find()->where(['accountid' => $accountid])->one();
        $url = $vrpayconfig[$keyUrl]['variable']."/v1/registrations";
        $data = "entityId=".$vrpaybrandsconfig['entityId'];
        $data .="&paymentBrand=DIRECTDEBIT_SEPA";
        $data .="&bankAccount.country=DE";
        $data .="&bankAccount.holder=".$sepamandat['holder'];
        $data .="&bankAccount.iban=".$sepamandat['iban'];
        $data .="&bankAccount.mandate.id=SEPA_$accountid";
        $dateOfSignature = date("Y-m-d");
        $data .="&bankAccount.mandate.dateOfSignature=$dateOfSignature";
        $data .="&customer.merchantCustomerId=".$accountid;
        $data .="&customer.givenName=".$account['personal_firstname'];
        $data .="&customer.surname=".$account['personal_lastname'];
        $data .="&customer.phone=".$account['personal_phone'];
        $data .="&customer.email=".$account['personal_email'];
        $data .="&customer.companyName=".$account['billing_company'];
        $data .="&customer.ip=".Yii::$app->getRequest()->getUserIP();
        $client = new Client();
        $response = $client->request('POST', $url, [
            'body' => $data,
            'headers' => [
                'Authorization' => 'Bearer '.$vrpayconfig[$keyToken]['variable'],
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        ]);
        $responseData = $response->getBody()->getContents();
        $vrpaymentlog = new vrpaymentlog();
        $vrpaymentlog->sessionid = Yii::$app->session->getId();
        $vrpaymentlog->accountid = $accountid;
        $vrpaymentlog->type ="getRegistrationSepaMandate";
        $vrpaymentlog->content =$url.'/'.$data;
        $vrpaymentlog->result =$responseData;
        $responseDatalog = json_decode($responseData, true);
        $vrpaymentlog->description= $responseDatalog['result']['description'];
        $checkoutId =$responseDatalog['id'];
        if($vrpaymentlog->validate()) {
            $vrpaymentlog->save();
        }
        $ResultCodes= $responseDatalog['result']['code'];
        $ResultID= $responseDatalog['id'];
        if(preg_match("/^(000\.000\.|000\.100\.1|000\.[36])/",$ResultCodes)) {
            return payment::getFirstPaySepaMandate($ResultID,$vrpaybrandsconfig['entityId']);
        }

    }

    public static function  getSofortPayment($brand,$id){
        $vrpayconfig = vrpayconfig::find()->asArray()->all();
        $keyToken = array_search('Token', array_column($vrpayconfig, 'name'));
        $keyUrl = array_search('Url', array_column($vrpayconfig, 'name'));
        $vrpaybrandsconfig = vrpaybrandsconfig::find()->where(['name' => $brand])->one();
        $url = $vrpayconfig[$keyUrl]['variable']."/v1/payments/".$id;
        $url .= "?entityId=".$vrpaybrandsconfig['entityId'];
        $client = new Client();
        $response = $client->request('GET', $url, [
            'headers' => [
                'Authorization' => 'Bearer '.$vrpayconfig[$keyToken]['variable'],
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        ]);
        $responseData = $response->getBody()->getContents();
        $session = Yii::$app->session;
        $accountid =$session->get('accountid');
        $vrpaymentlog = new vrpaymentlog();
        $vrpaymentlog->sessionid = Yii::$app->session->getId();
        $vrpaymentlog->accountid = $accountid;
        $vrpaymentlog->type ="getSofortPayment";
        $vrpaymentlog->content =$url;
        $vrpaymentlog->result =$responseData;
        if($vrpaymentlog->validate()) {
            $vrpaymentlog->save();
        }

        $responseDatalog = json_decode($responseData, true);
        $ResultCodes= $responseDatalog['result']['code'];

        if(preg_match("/^(000\.000\.|000\.100\.1|000\.[36])/",$ResultCodes)) {
            $stpadaten = json_decode($responseData, true);
            return payment::getRegistrationSofortSepaMandate($stpadaten['bankAccount']);
        }

        return $responseData;

    }

    public static function  getCheckoutSofortDashboardRegistration($invoicenumber,$invoiceid){
        $vrpaybrandsconfig = vrpaybrandsconfig::find()->where(['name' => 'SOFORTUEBERWEISUNG'])->one();
        $vrpayconfig = vrpayconfig::find()->asArray()->all();
        $keyToken = array_search('Token', array_column($vrpayconfig, 'name'));
        $keyUrl = array_search('Url', array_column($vrpayconfig, 'name'));
        $ReturnUrl = array_search('DashboardReturnUrl', array_column($vrpayconfig, 'name'));
        $session = Yii::$app->session;
        $info = salesInvoice::getInvoicePDFName($invoiceid);
        $priceinvoice = json_decode($info,true);
        $accountid =$session->get('accountid');
        $array = [
            'accountid' => $accountid,
            'brand'  => 'SOFORTUEBERWEISUNG',
            'invoicenumber'  => $invoicenumber,
            'invoiceid'  => $invoiceid,
        ];
        $account = Account::find()->where(['accountid' => $accountid])->one();
        $url = $vrpayconfig[$keyUrl]['variable']."/v1/payments";
        $data = "entityId=".$vrpaybrandsconfig['entityId'];
        $data .="&amount=".number_format($priceinvoice['grossAmount'], 2, '.', '');
        $data .="&currency=EUR";
        $data .="&shopperResultUrl=".$vrpayconfig[$ReturnUrl]['variable'].'?data='.self::base64url_encode(json_encode($array));
        $data .="&paymentBrand=SOFORTUEBERWEISUNG";
        $data .="&bankAccount.country=DE";
        $data .="&paymentType=DB";
        $data .="&recurringType=INITIAL";
        //  $data .="&testMode=EXTERNAL";
        $data .="&customer.merchantCustomerId=".$accountid;
        $data .="&customer.givenName=".$account['personal_firstname'];
        $data .="&customer.surname=".$account['personal_lastname'];
        $data .="&customer.phone=".$account['personal_phone'];
        $data .="&customer.email=".$account['personal_email'];
        $data .="&customer.companyName=".$account['billing_company'];
        $data .="&customer.ip=".Yii::$app->getRequest()->getUserIP();
        $client = new Client();
        $response = $client->request('POST', $url, [
            'body' => $data,
            'headers' => [
                'Authorization' => 'Bearer '.$vrpayconfig[$keyToken]['variable'],
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        ]);
        $responseData = $response->getBody()->getContents();

        $vrpaymentlog = new vrpaymentlog();
        $vrpaymentlog->sessionid = Yii::$app->session->getId();
        $vrpaymentlog->accountid = $accountid;
        $vrpaymentlog->type ="getCheckoutSofortRegistration";
        $vrpaymentlog->content =$data;
        $vrpaymentlog->result =$responseData;
        $responseDatalog = json_decode($responseData, true);
        $vrpaymentlog->description= $responseDatalog['result']['description'];
        if($vrpaymentlog->validate()) {
            $vrpaymentlog->save();
        }
        return $responseData;
    }

    public static function  getSofortDashboardPayment($brand,$id){
        $vrpayconfig = vrpayconfig::find()->asArray()->all();
        $keyToken = array_search('Token', array_column($vrpayconfig, 'name'));
        $keyUrl = array_search('Url', array_column($vrpayconfig, 'name'));
        $vrpaybrandsconfig = vrpaybrandsconfig::find()->where(['name' => $brand])->one();
        $url = $vrpayconfig[$keyUrl]['variable'].$id;
        $url .= "?entityId=".$vrpaybrandsconfig['entityId'];
        $client = new Client();
        $response = $client->request('GET', $url, [
            'headers' => [
                'Authorization' => 'Bearer '.$vrpayconfig[$keyToken]['variable'],
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        ]);
        $responseData = $response->getBody()->getContents();
        $session = Yii::$app->session;
        $accountid =$session->get('accountid');
        $vrpaymentlog = new vrpaymentlog();
        $vrpaymentlog->sessionid = Yii::$app->session->getId();
        $vrpaymentlog->accountid = $accountid;
        $vrpaymentlog->type ="getSofortDashboardPayment";
        $vrpaymentlog->content =$url;
        $vrpaymentlog->result =$responseData;
        if($vrpaymentlog->validate()) {
            $vrpaymentlog->save();
        }

        $responseDatalog = json_decode($responseData, true);
        $ResultCodes= $responseDatalog['result']['code'];

        return $responseData;

    }



    /*****************************SOFORTUEBERWEISUNG**********************/

    /*****************************PayPal**********************/

    public static function  getCheckoutPayPalRegistration(){
        $vrpaybrandsconfig = vrpaybrandsconfig::find()->where(['name' => 'PAYPAL'])->one();
        $vrpayconfig = vrpayconfig::find()->asArray()->all();
        $keyToken = array_search('Token', array_column($vrpayconfig, 'name'));
        $keyUrl = array_search('Url', array_column($vrpayconfig, 'name'));
        $ReturnUrl = array_search('ReturnUrl', array_column($vrpayconfig, 'name'));
        $session = Yii::$app->session;
        $tempArray = $session->get('ShoppingCart');
        $price=0;
        foreach ($tempArray as $value) {
            $price +=$value['price']*Yii::$app->params['STEUERSATZGANZ'];
            if(isset($value['option'])){
                foreach ($value['option'] as $option){
                    $price += $option['price']*Yii::$app->params['STEUERSATZGANZ'];
                }
            }
        }
        $accountid =$session->get('accountid');
        $account = Account::find()->where(['accountid' => $accountid])->one();
        $url = $vrpayconfig[$keyUrl]['variable']."/v1/payments";
        $data = "entityId=".$vrpaybrandsconfig['entityId'];
        $data .="&amount=".number_format($price, 2, '.', '');
        $data .="&currency=EUR";
        $data .="&shopperResultUrl=".$vrpayconfig[$ReturnUrl]['variable'].'?brand=PAYPAL';
        $data .="&paymentBrand=PAYPAL";
        $data .="&paymentType=DB";
        // "&createRegistration=true";
        $data .="&testMode=EXTERNAL";
        //$data .="&recurringType=REPEATED";
        //$data .="&createRegistration=true";
        $data .="&customer.merchantCustomerId=".$accountid;
        $data .="&customer.givenName=".$account['personal_firstname'];
        $data .="&customer.surname=".$account['personal_lastname'];
        $data .="&customer.phone=".$account['personal_phone'];
        $data .="&customer.email=".$account['personal_email'];
        $data .="&customer.companyName=".$account['billing_company'];
        $data .="&customer.ip=".Yii::$app->getRequest()->getUserIP();
        $client = new Client();
        $response = $client->request('POST', $url, [
            'body' => $data,
            'headers' => [
                'Authorization' => 'Bearer '.$vrpayconfig[$keyToken]['variable'],
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        ]);
        $responseData = $response->getBody()->getContents();

        $vrpaymentlog = new vrpaymentlog();
        $vrpaymentlog->sessionid = Yii::$app->session->getId();
        $vrpaymentlog->accountid = $accountid;
        $vrpaymentlog->type ="getCheckoutPayPalRegistration";
        $vrpaymentlog->content =$data;
        $vrpaymentlog->result =$responseData;
        $responseDatalog = json_decode($responseData, true);
        $vrpaymentlog->description= $responseDatalog['result']['description'];
        if($vrpaymentlog->validate()) {
            $vrpaymentlog->save();
        }
        return $responseData;
    }

    public static function  getPayPalPayment($brand,$id){
        $vrpayconfig = vrpayconfig::find()->asArray()->all();
        $keyToken = array_search('Token', array_column($vrpayconfig, 'name'));
        $keyUrl = array_search('Url', array_column($vrpayconfig, 'name'));
        $vrpaybrandsconfig = vrpaybrandsconfig::find()->where(['name' => $brand])->one();
        $url = $vrpayconfig[$keyUrl]['variable']."/v1/payments/".$id;
        $url .= "?entityId=".$vrpaybrandsconfig['entityId'];
        $client = new Client();
        $response = $client->request('GET', $url, [
            'headers' => [
                'Authorization' => 'Bearer '.$vrpayconfig[$keyToken]['variable'],
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        ]);
        $responseData = $response->getBody()->getContents();
        $session = Yii::$app->session;
        $accountid =$session->get('accountid');
        $vrpaymentlog = new vrpaymentlog();
        $vrpaymentlog->sessionid = Yii::$app->session->getId();
        $vrpaymentlog->accountid = $accountid;
        $vrpaymentlog->type ="getCreditcardsPayment";
        $vrpaymentlog->content =$url;
        $vrpaymentlog->result =$responseData;
        if($vrpaymentlog->validate()) {
            $vrpaymentlog->save();
        }
        return $responseData;

    }

    public static function  getCheckoutPayPalDashboardRegistration($invoicenumber,$invoiceid){
        $vrpaybrandsconfig = vrpaybrandsconfig::find()->where(['name' => 'PAYPAL'])->one();
        $vrpayconfig = vrpayconfig::find()->asArray()->all();
        $keyToken = array_search('Token', array_column($vrpayconfig, 'name'));
        $keyUrl = array_search('Url', array_column($vrpayconfig, 'name'));
        $ReturnUrl = array_search('DashboardReturnUrl', array_column($vrpayconfig, 'name'));
        $session = Yii::$app->session;
        $accountid =$session->get('accountid');
        $info = salesInvoice::getInvoicePDFName($invoiceid);
        $priceinvoice = json_decode($info,true);
        $account = Account::find()->where(['accountid' => $accountid])->one();
        $url = $vrpayconfig[$keyUrl]['variable']."/v1/payments";
        $data = "entityId=".$vrpaybrandsconfig['entityId'];
        $data .="&amount=".number_format($priceinvoice['grossAmount'], 2, '.', '');
        $data .="&currency=EUR";
        $array = [
            'accountid' => $accountid,
            'brand'  => 'PAYPAL',
            'invoicenumber'  => $invoicenumber,
            'invoiceid'  => $invoiceid,
        ];
        $data .="&shopperResultUrl=".$vrpayconfig[$ReturnUrl]['variable'].'?data='.self::base64url_encode(json_encode($array));
        //?brand=PAYPAL&invoicenumber='.$invoicenumber.'&accountid='.$accountid.'invoiceid='.$invoiceid;
        $data .="&paymentBrand=PAYPAL";
        $data .="&paymentType=DB";
        $data .="&testMode=EXTERNAL";
        $data .="&customer.merchantCustomerId=".$accountid;
        $data .="&customer.givenName=".$account['personal_firstname'];
        $data .="&customer.surname=".$account['personal_lastname'];
        $data .="&customer.phone=".$account['personal_phone'];
        $data .="&customer.email=".$account['personal_email'];
        $data .="&customer.companyName=".$account['billing_company'];
        $data .="&customer.ip=".Yii::$app->getRequest()->getUserIP();
        $client = new Client();
        $response = $client->request('POST', $url, [
            'body' => $data,
            'headers' => [
                'Authorization' => 'Bearer '.$vrpayconfig[$keyToken]['variable'],
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        ]);
        $responseData = $response->getBody()->getContents();

        $vrpaymentlog = new vrpaymentlog();
        $vrpaymentlog->sessionid = Yii::$app->session->getId();
        $vrpaymentlog->accountid = $accountid;
        $vrpaymentlog->type ="getCheckoutPayPalDashboardRegistration";
        $vrpaymentlog->content =$data;
        $vrpaymentlog->result =$responseData;
        $responseDatalog = json_decode($responseData, true);
        $vrpaymentlog->description= $responseDatalog['result']['description'];
        if($vrpaymentlog->validate()) {
            $vrpaymentlog->save();
        }
        return $responseData;
    }

    public static function  getPayPalDashboardPayment($brand,$id){
        $vrpayconfig = vrpayconfig::find()->asArray()->all();
        $keyToken = array_search('Token', array_column($vrpayconfig, 'name'));
        $keyUrl = array_search('Url', array_column($vrpayconfig, 'name'));
        $vrpaybrandsconfig = vrpaybrandsconfig::find()->where(['name' => $brand])->one();
        $url = $vrpayconfig[$keyUrl]['variable'].$id;
        $url .= "?entityId=".$vrpaybrandsconfig['entityId'];
        $client = new Client();
        $response = $client->request('GET', $url, [
            'headers' => [
                'Authorization' => 'Bearer '.$vrpayconfig[$keyToken]['variable'],
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        ]);
        $responseData = $response->getBody()->getContents();
        $session = Yii::$app->session;
        $accountid =$session->get('accountid');
        $vrpaymentlog = new vrpaymentlog();
        $vrpaymentlog->sessionid = Yii::$app->session->getId();
        $vrpaymentlog->accountid = $accountid;
        $vrpaymentlog->type ="getPayPalDashboardPayment";
        $vrpaymentlog->content =$url;
        $vrpaymentlog->result =$responseData;
        if($vrpaymentlog->validate()) {
            $vrpaymentlog->save();
        }
        return $responseData;

    }


    /*****************************PayPal**********************/

    /*****************************PaymentStatus**********************/
    public static function  getPaymentStatus($brand,$id){
        $vrpayconfig = vrpayconfig::find()->asArray()->all();
        $keyToken = array_search('Token', array_column($vrpayconfig, 'name'));
        $keyUrl = array_search('Url', array_column($vrpayconfig, 'name'));
        $url = $vrpayconfig[$keyUrl]['variable']."/v1/query/".$id;
        $url .= "?entityId=".$brand;
        $client = new Client();
        $response = $client->request('GET', $url, [
            'headers' => [
                'Authorization' => 'Bearer '.$vrpayconfig[$keyToken]['variable'],
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        ]);
        $responseData = $response->getBody()->getContents();
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


        if($vrpaymentlog->validate()) {
            $vrpaymentlog->save();
        }
        return $responseData;
    }
    /*****************************PaymentStatus**********************/





    function base64url_encode( $data ){
        return rtrim(strtr(base64_encode( $data ), '+/', '-_'), '=');
    }

    function base64url_decode( $data ){
        return base64_decode( strtr( $data, '-_', '+/') . str_repeat('=', 3 - ( 3 + strlen( $data )) % 4 ));
    }



    /*
     *
     * paypal für test

    createRegistration

    Sepa server2server
    paypal server2server
    Sofort server2server



    Sending a repeated payment
     */

}