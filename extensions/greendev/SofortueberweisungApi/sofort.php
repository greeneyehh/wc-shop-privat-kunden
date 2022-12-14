<?php
namespace app\extensions\greendev\SofortueberweisungApi;
use app\models\shop\CustomerOrder;
use phpDocumentor\Reflection\Types\This;
use Yii;

use yii\helpers\Url;
class sofort
{
    public static function getCheckout(array $purchaseUnits)
    {
        $price=0;
        foreach ($purchaseUnits as $value) {
            $price +=$value['price']*Yii::$app->params['STEUERSATZGANZ'];
            if(isset($value['option'])){
                foreach ($value['option'] as $option){
                    $price += $option['price']*Yii::$app->params['STEUERSATZGANZ'];
                }
            }
        }
        $session = Yii::$app->session;
        $accountid =$session->get('accountid');
        $ShoppingCart = $session->get('ShoppingCart');
        $Sofortueberweisung = new \Sofort\SofortLib\Sofortueberweisung(Yii::$app->params['Sofort_Token']);

        $Sofortueberweisung->setAmount($price);
        $Sofortueberweisung->setCurrencyCode('EUR');
        $Sofortueberweisung->setReason($accountid,'Verwendungszweck');
        $Sofortueberweisung->setSuccessUrl(Url::base(true).'/payment/sofortueberweisung/?trx=-TRANSACTION-', true);
        $Sofortueberweisung->setAbortUrl(Url::base(true).'/cart');
        $Sofortueberweisung->setNotificationUrl(Url::base(true).'/payment/sofortueberweisung-notification');
        $Sofortueberweisung->sendRequest();


        $session->set('TransactionId',$Sofortueberweisung->getTransactionId());
        try {

            $customerSofortLog = new \app\models\logserver\customerSofortLog();
            $customerSofortLog->token='0';
            $customerSofortLog->accountid=$accountid;
            $customerSofortLog->token=$Sofortueberweisung->getTransactionId();
            $customerSofortLog->checkoutResponse=str_replace(['\u0000*','\u0000'], '',json_encode((array)$Sofortueberweisung));
            $customerSofortLog->cart=json_encode($purchaseUnits);
            if($customerSofortLog->validate()) {
                $customerSofortLog->save();
            }else{
                return $customerSofortLog->errors;
            }
        }catch (Exception $exception){
            return $exception;
        }
        if($Sofortueberweisung->isError()) {
            echo $Sofortueberweisung->getError();
        } else {

            $transactionId = $Sofortueberweisung->getTransactionId();
            $paymentUrl = $Sofortueberweisung->getPaymentUrl();
            return $paymentUrl;
        }
    }

    public static function getDashboardCheckout($accountid,$price)
    {
        $session = Yii::$app->session;
        $Sofortueberweisung = new \Sofort\SofortLib\Sofortueberweisung(Yii::$app->params['Sofort_Token']);
        $Sofortueberweisung->setAmount($price);
        $Sofortueberweisung->setCurrencyCode('EUR');
        $Sofortueberweisung->setReason($accountid,'Verwendungszweck');
        $Sofortueberweisung->setSuccessUrl(Url::base(true).'/dashboard/payment-sofortueberweisung/?trx=-TRANSACTION-', true);
        $Sofortueberweisung->setAbortUrl(Url::base(true).'/cart');
        $Sofortueberweisung->setNotificationUrl(Url::base(true).'/dashboard/payment-sofortueberweisung-notification');
        $Sofortueberweisung->sendRequest();
        $session->set('TransactionId',$Sofortueberweisung->getTransactionId());
        try {

            $customerSofortLog = new \app\models\logserver\customerSofortLog();
            $customerSofortLog->token='0';
            $customerSofortLog->accountid=$accountid;
            $customerSofortLog->token=$Sofortueberweisung->getTransactionId();
            $customerSofortLog->checkoutResponse=str_replace(['\u0000*','\u0000'], '',json_encode((array)$Sofortueberweisung));
            $customerSofortLog->cart=$price;
            if($customerSofortLog->validate()) {
                $customerSofortLog->save();
            }else{
                return $customerSofortLog->errors;
            }
        }catch (Exception $exception){
            return $exception;
        }
        if($Sofortueberweisung->isError()) {
            echo $Sofortueberweisung->getError();
        } else {

            $transactionId = $Sofortueberweisung->getTransactionId();
            $paymentUrl = $Sofortueberweisung->getPaymentUrl();
            return $paymentUrl;
        }
    }


    public static function getTransactionData($TransactionId){
        $session = Yii::$app->session;
        $accountid =$session->get('accountid');
        $Account = \app\models\Account::findIdentity($accountid);
        $customerSofortLog = \app\models\logserver\customerSofortLog::find()->where(['accountid' => $accountid,'token'=> $TransactionId])->one();
        $SofortLibTransactionData = new \Sofort\SofortLib\TransactionData(Yii::$app->params['Sofort_Token']);

        //$SofortLib_Notification = new \Sofort\SofortLib\Notification();
       // $TestNotification = $SofortLib_Notification->getNotification(file_get_contents('php://input'));
        $SofortLibTransactionData->addTransaction($TransactionId);
        $SofortLibTransactionData->setApiVersion('2.0');
        $SofortLibTransactionData->sendRequest();
        $output = array();
        $methods = array(
            'getAmount' => '',
            'getAmountRefunded' => '',
            'getCount' => '',
            'getPaymentMethod' => '',
            'getConsumerProtection' => '',
            'getStatus' => '',
            'getStatusReason' => '',
            'getStatusModifiedTime' => '',
            'getLanguageCode' => '',
            'getCurrency' => '',
            'getTransaction' => '',
            'getReason' => array(0,0),
            'getUserVariable' => 0,
            'getTime' => '',
            'getProjectId' => '',
            'getRecipientHolder' => '',
            'getRecipientAccountNumber' => '',
            'getRecipientBankCode' => '',
            'getRecipientCountryCode' => '',
            'getRecipientBankName' => '',
            'getRecipientBic' => '',
            'getRecipientIban' => '',
            'getSenderHolder' => '',
            'getSenderAccountNumber' => '',
            'getSenderBankCode' => '',
            'getSenderCountryCode' => '',
            'getSenderBankName' => '',
            'getSenderBic' => '',
            'getSenderIban' => '',
        );


        foreach($methods as $method => $params) {
            if(count((array)$params) == 2) {
                $output[$method] = $SofortLibTransactionData->$method($params[0], $params[1]);
            } else if($params !== '') {
                $output[$method] =  $SofortLibTransactionData->$method($params);
            } else {
                $output[$method] = $SofortLibTransactionData->$method();
            }
        }

        if($SofortLibTransactionData->isError()) {
            echo $SofortLibTransactionData->getError();
            return false;
        } else {
            $items = array();
           $cart= json_decode($customerSofortLog->cart,true);
            foreach ($cart as $value) {
                if($value['slug']   == 'vps'){
                    $CustomerOrder = new CustomerOrder();
                    $CustomerOrder->productid = $value['id'];
                    $CustomerOrder->accountid = $accountid;
                    $CustomerOrder->paycycle =1;

                    $date = date("d.m.Y");
                    $itemsdata = array();
                    $itemsdata['id'] = $value['id'];
                    $itemsdata['domain'] = null;
                    $itemsdata['option'] = $value['option'];
                    $itemsdata['paycycle'] = 1;
                    if(isset($value['option'])){
                        $CustomerOrder->addons= json_encode($value['option']);
                        $itemsdata['option'] = $value['option'];
                    }
                    array_push($items, $itemsdata);
                    $CustomerOrder->initialpasswort = bin2hex(openssl_random_pseudo_bytes(6));
                    $CustomerOrder->lastpaydate = $date;
                    $CustomerOrder->lastpaybrand = 'sofort';
                    if($CustomerOrder->validate()){
                        $CustomerOrder->save();
                        \app\extensions\greendev\vps\VPSTask::createVPSTask($accountid,$CustomerOrder->id,$CustomerOrder->initialpasswort,$value);


                    }
                }
                elseif ($value['slug']  == 'managed-nextcloud'){
                    $CustomerOrder = new CustomerOrder();
                    $CustomerOrder->productid = $value['id'];
                    $CustomerOrder->accountid = $accountid;
                    $article = new \app\extensions\greendev\weclapp\article();
                    $articlepaycycle= $article->getByIdArticle($value['id']);
                    $articlepaycycle = json_decode($articlepaycycle,true);
                    if(preg_match("/Start/",$articlepaycycle['name'])) {
                        $CustomerOrder->domain = 'https://'.\Yii::$app->params['NEXTCLOUD_API_HOSTNAME'];
                    }else{

                            $CustomerOrder->domain = 'https://'.$value['domainextension'];

                    }
                    $itemsdata = array();
                    $itemsdata['id'] = $value['id'];
                    $itemsdata['domain'] = $CustomerOrder->domain;
                    if(isset($value['option'])){
                        $itemsdata['option'] = $value['option'];
                    }
                    $paycycle='';
                    if (strpos($articlepaycycle['shortDescription2'], 'J??hrlich') !== false) {
                        $paycycle= '12';
                    }
                    if (strpos($articlepaycycle['shortDescription2'], 'Jahr') !== false) {
                        $paycycle= '12';
                    }
                    if (strpos($articlepaycycle['shortDescription2'], 'Monatlich') !== false) {
                        $paycycle= '1';
                    }
                    $itemsdata['paycycle'] = $paycycle;
                    array_push( $items, $itemsdata);

                    $CustomerOrder->paycycle = $paycycle;
                    $date = date("d.m.Y");
                    if(isset($value['option'])){
                        $CustomerOrder->addons= json_encode($value['option']);
                    }
                    $CustomerOrder->lastpaydate = $date;
                    $CustomerOrder->lastpaybrand = 'SOFORT';
                    $productname= $articlepaycycle['name'];
                    if(preg_match("/Start/",$productname)) {
                        $CustomerOrder->active = 1;
                    }
                    if(preg_match("/Start/",$productname)) {
                        $CustomerOrder->username =$Account->personal_email;
                    }else{
                        $CustomerOrder->username = 'admin';
                    }
                    $CustomerOrder->initialpasswort = bin2hex(openssl_random_pseudo_bytes(6));
                    $CustomerOrder->activate_hash = bin2hex(openssl_random_pseudo_bytes(80));
                    if($CustomerOrder->validate()){
                        $CustomerOrder->save();
                        if(preg_match("/Start/",$productname)) {
                            $username = $Account->personal_email;
                            \app\extensions\greendev\mailtask\MailTask::setMailTask($username,$CustomerOrder,'Start');
                        }else{
                            $username = 'Admin';
                            \app\extensions\greendev\mailtask\MailTask::setMailTask($username,$CustomerOrder,'none');
                        }
                        if(preg_match("/Start/",$productname)) {
                            $nextcloud =\app\extensions\greendev\nextcloud\user::AddUser($username,$CustomerOrder->id . '' .$CustomerOrder->accountid,$Account->personal_email,$CustomerOrder->initialpasswort, $articlepaycycle['recordItemGroupName']."GB");
                            if(preg_match("/(ok|100|OK)/",$nextcloud)){
                                Yii::$app->mailer->compose('layouts/productsunlock', ['account' => $username,'productname'=>$productname,'initialpasswort'=> $CustomerOrder->initialpasswort,'domain'=>$CustomerOrder->domain,'CustomerData'=>$Account,'mail'=>$Account->personal_email])
                                    ->setFrom('noreply@windcloud.de')
                                    ->setTo(strtolower($Account->personal_email))
                                    ->setSubject('Ihr Produkt ist jetzt Aktiv! Windcloud 4.0 GmbH')
                                    ->send();
                            }
                        }
                    }
                    else{
                        $errores = $CustomerOrder->getErrors();
                        print_r($errores);
                        print_r($CustomerOrder);
                    }
                }
            }
                \app\extensions\greendev\SalesInvoiceTask\SalesInvoiceTask::setSalesInvoiceTask($accountid,$items);

                $customerSofortLog->checkoutCaptureResponse = str_replace(['\u0000*', '\u0000'], '', json_encode((array)$SofortLibTransactionData));
                $customerSofortLog->status = $SofortLibTransactionData->getStatus();
                try {
                    if ($customerSofortLog->validate()) {
                        $customerSofortLog->save();
                        return true;
                    }
                } catch (\Exception $exception) {
                    return false;
                }

        }
    }

    public static function getDashboardTransactionData($TransactionId){
        $session = Yii::$app->session;
        $accountid =$session->get('accountid');
        $Account = \app\models\Account::findIdentity($accountid);
        $customerSofortLog = \app\models\logserver\customerSofortLog::find()->where(['accountid' => $accountid,'token'=> $TransactionId])->one();
        $SofortLibTransactionData = new \Sofort\SofortLib\TransactionData(Yii::$app->params['Sofort_Token']);
        $SofortLibTransactionData->addTransaction($TransactionId);
        $SofortLibTransactionData->setApiVersion('2.0');
        $SofortLibTransactionData->sendRequest();
        $output = array();
        $methods = array(
            'getAmount' => '',
            'getAmountRefunded' => '',
            'getCount' => '',
            'getPaymentMethod' => '',
            'getConsumerProtection' => '',
            'getStatus' => '',
            'getStatusReason' => '',
            'getStatusModifiedTime' => '',
            'getLanguageCode' => '',
            'getCurrency' => '',
            'getTransaction' => '',
            'getReason' => array(0,0),
            'getUserVariable' => 0,
            'getTime' => '',
            'getProjectId' => '',
            'getRecipientHolder' => '',
            'getRecipientAccountNumber' => '',
            'getRecipientBankCode' => '',
            'getRecipientCountryCode' => '',
            'getRecipientBankName' => '',
            'getRecipientBic' => '',
            'getRecipientIban' => '',
            'getSenderHolder' => '',
            'getSenderAccountNumber' => '',
            'getSenderBankCode' => '',
            'getSenderCountryCode' => '',
            'getSenderBankName' => '',
            'getSenderBic' => '',
            'getSenderIban' => '',
        );


        foreach($methods as $method => $params) {
            if(count((array)$params) == 2) {
                $output[$method] = $SofortLibTransactionData->$method($params[0], $params[1]);
            } else if($params !== '') {
                $output[$method] =  $SofortLibTransactionData->$method($params);
            } else {
                $output[$method] = $SofortLibTransactionData->$method();
            }
        }

        if($SofortLibTransactionData->isError()) {
            echo $SofortLibTransactionData->getError();
            return false;
        } else {

                        return true;


        }
    }

    public static function getNotification($TransactionId){

        $SofortLib_Notification = new \Sofort\SofortLib\Notification();
        $TestNotification = $SofortLib_Notification->getNotification($TransactionId);
        $SofortLibTransactionData = new \Sofort\SofortLib\TransactionData(Yii::$app->params['Sofort_Token']);
        $SofortLibTransactionData->addTransaction($TestNotification);
        $customerSofortLog = \app\models\logserver\customerSofortLog::find()->where(['token'=> $TestNotification])->one();
        $SofortLibTransactionData->sendRequest();

        $output = array();
        $methods = array(
            'getAmount' => '',
            'getAmountRefunded' => '',
            'getCount' => '',
            'getPaymentMethod' => '',
            'getConsumerProtection' => '',
            'getStatus' => '',
            'getStatusReason' => '',
            'getStatusModifiedTime' => '',
            'getLanguageCode' => '',
            'getCurrency' => '',
            'getTransaction' => '',
            'getReason' => array(0,0),
            'getUserVariable' => 0,
            'getTime' => '',
            'getProjectId' => '',
            'getRecipientHolder' => '',
            'getRecipientAccountNumber' => '',
            'getRecipientBankCode' => '',
            'getRecipientCountryCode' => '',
            'getRecipientBankName' => '',
            'getRecipientBic' => '',
            'getRecipientIban' => '',
            'getSenderHolder' => '',
            'getSenderAccountNumber' => '',
            'getSenderBankCode' => '',
            'getSenderCountryCode' => '',
            'getSenderBankName' => '',
            'getSenderBic' => '',
            'getSenderIban' => '',
        );

        foreach($methods as $method => $params) {
            if(count((array)$params) == 2) {
                $output[] = $method . ': ' . $SofortLibTransactionData->$method($params[0], $params[1]);
            } else if($params !== '') {
                $output[] = $method . ': ' . $SofortLibTransactionData->$method($params);
            } else {
                $output[] = $method . ': ' . $SofortLibTransactionData->$method();
            }
        }

        if($SofortLibTransactionData->isError()) {
            echo $SofortLibTransactionData->getError();
        } else {
            //echo implode('<br />', $SofortLibTransactionData);
        }

        $notificationResponse =str_replace(['\u0000*','\u0000'], '',json_encode((array)$SofortLibTransactionData));
        if(isset($notificationResponse)){
            $customerSofortLog->notificationResponse = $notificationResponse;
        }else{
            $customerSofortLog->notificationResponse = "SofortLibTransactionData";
        }

        $customerSofortLog->status = $SofortLibTransactionData->getStatus();
        $customerSofortLog->save();
    }

}
