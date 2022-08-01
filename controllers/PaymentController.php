<?php

namespace app\controllers;
use app\extensions\greendev\nextcloud\user;
use app\extensions\greendev\weclapp\article;
use app\extensions\greendev\weclapp\salesInvoice;
use app\models\shop\CustomerOrder;
use app\models\shop\Invoice;
use himiklab\sitemap\behaviors\SitemapBehavior;
use Yii;
use yii\filters\VerbFilter;


class PaymentController extends \yii\web\Controller
{

    public function beforeAction($action)
    {
        if (in_array($action->id, ['sofortueberweisung']) || in_array($action->id, ['sofortueberweisung-notification'])) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

	/*public function actionSepamandat(){
        $session = Yii::$app->session;
        $sepamandat = new \app\models\form\SepaForm();
        if($sepamandat->load(Yii::$app->request->post())) {
            if($sepamandat->validate()){
                $mandat =\app\extensions\greendev\vrpayment\payment::getRegistrationSepaMandate($sepamandat);
                if(isset($mandat['resultcode'])){
                    if(preg_match("/^(000\.000\.|000\.100\.1|000\.[36])/",$mandat['resultcode'])){
                        $items = array();
                        $customerorderId = array();
                        $Account = \app\models\Account::findIdentity($mandat['accountid']);
                          foreach ($mandat['cart'] as $value) {
                              $CustomerOrder = new CustomerOrder();
                              $CustomerOrder->productid = $value['id'];
                              $CustomerOrder->accountid = $mandat['accountid'];
                              $article = new article();
                              $articlepaycycle= $article->getByIdArticle($value['id']);
                              $articlepaycycle = json_decode($articlepaycycle,true);
                              if(preg_match("/Start/",$articlepaycycle['name'])) {
                                  $CustomerOrder->domain = 'https://'.\Yii::$app->params['NEXTCLOUD_API_HOSTNAME'];
                              }else{
                                  if($value['domainextension'] == '' OR $value['domainextension'] == null){
                                      $CustomerOrder->domain = 'https://'.strtolower ($Account->personal_lastname).'-'.strtolower ($Account->personal_firstname).'-'.$value['id'].'.windcloud.de';
                                  }else{
                                      $CustomerOrder->domain = 'https://'.$value['domainextension'];
                                  }
                              }
                              $itemsdata = array();
                              $itemsdata['id'] = $value['id'];
                              $itemsdata['domain'] = $CustomerOrder->domain;
                              if(isset($value['option'])){
                              $itemsdata['option'] = $value['option'];
                              }
                              $paycycle='';
                              if (strpos($articlepaycycle['shortDescription2'], 'Jährlich') !== false) {
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
                              $responseData= json_decode($mandat['response'], true);
                              $CustomerOrder->paycycle = $paycycle;
                              $date = date("d.m.Y");

                              if(isset($value['option'])){
                                  $CustomerOrder->addons= json_encode($value['option']);
                              }



                              $CustomerOrder->lastpaydate = $date;
                              $CustomerOrder->lastpayid= $responseData['ndc'];
                              $CustomerOrder->lastpaybrand = 'SEPA';
                              $CustomerOrder->payidlog = $responseData['id'];
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
                                      $nextcloud = user::AddUser($username,$CustomerOrder->id . '' .$CustomerOrder->accountid,$Account->personal_email,$CustomerOrder->initialpasswort, $articlepaycycle['recordItemGroupName']."GB");
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


                              array_push( $customerorderId, $CustomerOrder->id);

                          }
                          $invoice = new salesInvoice();
                          $Invoicelog = new Invoice();
                          $invoicearray = $invoice->createInvoice($mandat['accountid'],$items);
                            \app\extensions\greendev\SalesInvoiceTask\SalesInvoiceTask::setSalesInvoiceTask($mandat['accountid'],$items);


                          $invoicearray1 = json_decode($invoicearray,true);
                          $RecurringPayment = new \app\models\Payment\RecurringPayment();
                          $RecurringPayment->recurringId =$mandat['registrationsId'];
                          $RecurringPayment->recurringentityId =$mandat['registrationsId'];
                          $RecurringPayment->accountid =$mandat['accountid'];
                          $RecurringPayment->cart =json_encode($mandat['cart']);
                          $RecurringPayment->customerorderId =json_encode($customerorderId);
                          $RecurringPayment->recurringType ='DIRECTDEBIT_SEPA';
                          if($RecurringPayment->validate()){
                              $RecurringPayment->save();
                              $session->set('ShoppingCart',null);
                          }
                          return  $this->redirect('/checkout/successful');
                    }elseif (preg_match("/^(000\.400\.[1][0-9][1-9]|000\.400\.2)/",$mandat['resultcode']) || preg_match("/^(800\.[17]00|800\.800\.[123])/",$mandat['resultcode'])|| preg_match("/^(800\.[56]|999\.|600\.1|800\.800\.[84])/",$mandat['resultcode'])){
                          return  $this->redirect('/checkout/notsuccessful');
                    }
            } else
                {
                    return  $this->redirect('/checkout/notsuccessful');
                }

            }else{
                return  $this->redirect('/checkout/notsuccessful');
            }

        }

    }
*/
	public function actionSepamandat(){
        $session = Yii::$app->session;
        $sepamandat = new \app\models\form\SepaForm();
        if($sepamandat->load(Yii::$app->request->post())) {
            if($sepamandat->validate()){
                $mandat =\app\extensions\greendev\vrpayment\payment::getRegistrationSepaMandate($sepamandat);
            if(isset($mandat['resultcode'])){
                    if(preg_match("/^(000\.000\.|000\.100\.1|000\.[36])/",$mandat['resultcode'])){
                        $items = array();
                        $customerorderId = array();
                        $Account = \app\models\Account::findIdentity($mandat['accountid']);
                        foreach ($mandat['cart'] as $value) {
                            if($value['slug']   == 'vps'){
                                $CustomerOrder = new CustomerOrder();
                                $CustomerOrder->productid = $value['id'];
                                $CustomerOrder->accountid = $mandat['accountid'];
                                $CustomerOrder->paycycle =1;
                                $responseData= json_decode($mandat['response'], true);
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
                                $CustomerOrder->lastpayid= $responseData['ndc'];
                                $CustomerOrder->lastpaybrand = 'SEPA';
                                $CustomerOrder->payidlog = $responseData['id'];
                                if($CustomerOrder->validate()){
                                    $CustomerOrder->save();
                                    \app\extensions\greendev\vps\VPSTask::createVPSTask($Account->accountid,$CustomerOrder->id,$CustomerOrder->initialpasswort,$value);
                                }

                            }
                            elseif ($value['slug']  == 'managed-nextcloud'){
                                $CustomerOrder = new CustomerOrder();
                                $CustomerOrder->productid = $value['id'];
                                $CustomerOrder->accountid = $mandat['accountid'];
                                $article = new article();
                                $articlepaycycle= $article->getByIdArticle($value['id']);
                                $articlepaycycle = json_decode($articlepaycycle,true);
                                if(preg_match("/Start/",$articlepaycycle['name'])) {
                                    $CustomerOrder->domain = 'https://'.\Yii::$app->params['NEXTCLOUD_API_HOSTNAME'];
                                }else{
                                    if($value['domainextension'] == '' OR $value['domainextension'] == null){
                                        $CustomerOrder->domain = 'https://'.strtolower ($Account->personal_lastname).'-'.strtolower ($Account->personal_firstname).'-'.$value['id'].'.windcloud.de';
                                    }else{
                                        $CustomerOrder->domain = 'https://'.$value['domainextension'];
                                    }
                                }
                                $itemsdata = array();
                                $itemsdata['id'] = $value['id'];
                                $itemsdata['domain'] = $CustomerOrder->domain;
                                if(isset($value['option'])){
                                    $itemsdata['option'] = $value['option'];
                                }
                                $paycycle='';
                                if (strpos($articlepaycycle['shortDescription2'], 'Jährlich') !== false) {
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
                                $responseData= json_decode($mandat['response'], true);
                                $CustomerOrder->paycycle = $paycycle;
                                $date = date("d.m.Y");
                                if(isset($value['option'])){
                                    $CustomerOrder->addons= json_encode($value['option']);
                                }
                                $CustomerOrder->lastpaydate = $date;
                                $CustomerOrder->lastpayid= $responseData['ndc'];
                                $CustomerOrder->lastpaybrand = 'SEPA';
                                $CustomerOrder->payidlog = $responseData['id'];
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
                                        $nextcloud = user::AddUser($username,$CustomerOrder->id . '' .$CustomerOrder->accountid,$Account->personal_email,$CustomerOrder->initialpasswort, $articlepaycycle['recordItemGroupName']."GB");
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
                                array_push( $customerorderId, $CustomerOrder->id);
                            }
                          }
                          \app\extensions\greendev\SalesInvoiceTask\SalesInvoiceTask::setSalesInvoiceTask($mandat['accountid'],$items);
                          $RecurringPayment = new \app\models\Payment\RecurringPayment();
                          $RecurringPayment->recurringId =$mandat['registrationsId'];
                          $RecurringPayment->recurringentityId =$mandat['registrationsId'];
                          $RecurringPayment->accountid =$mandat['accountid'];
                          $RecurringPayment->cart =json_encode($mandat['cart']);
                          $RecurringPayment->customerorderId =json_encode($customerorderId);
                          $RecurringPayment->recurringType ='DIRECTDEBIT_SEPA';
                          if($RecurringPayment->validate()){
                              $RecurringPayment->save();
                              $session->set('ShoppingCart',null);
                          }
                          return  $this->redirect('/checkout/successful');




                    }elseif (preg_match("/^(000\.400\.[1][0-9][1-9]|000\.400\.2)/",$mandat['resultcode']) || preg_match("/^(800\.[17]00|800\.800\.[123])/",$mandat['resultcode'])|| preg_match("/^(800\.[56]|999\.|600\.1|800\.800\.[84])/",$mandat['resultcode'])){
                          return  $this->redirect('/checkout/notsuccessful');
                    }
            } else
                {
                    return  $this->redirect('/checkout/notsuccessful');
                }

            }else{
                return  $this->redirect('/checkout/notsuccessful');
            }

        }

    }

	public function actionSofort(){
        $session = Yii::$app->session;
        $sepamandat = new \app\models\form\SepaForm();
        if($sepamandat->load(Yii::$app->request->post())) {
            if($sepamandat->validate()){
                $mandat =\app\extensions\greendev\vrpayment\payment::getRegistrationSepaMandate($sepamandat);
                if(isset($mandat['resultcode'])){
                  if(preg_match("/^(000\.000\.|000\.100\.1|000\.[36])/",$mandat['resultcode'])){
                    $items = array();
                    $customerorderId = array();
                    $Account = \app\models\Account::findIdentity($mandat['accountid']);
                      foreach ($mandat['cart'] as $value) {
                          if($value['slug'] == 'vps'){
                              $CustomerOrder = new CustomerOrder();
                              $CustomerOrder->productid = $value['id'];
                              $CustomerOrder->accountid = $mandat['accountid'];
                              $CustomerOrder->paycycle =1;
                              $responseData= json_decode($mandat['response'], true);
                              $date = date("d.m.Y");
                              $itemsdata = array();
                              $itemsdata['id'] = $value['id'];
                              $itemsdata['domain'] = null;
                              $itemsdata['option'] = $value['option'];
                              $itemsdata['paycycle'] = 1;
                              array_push($items, $itemsdata);
                              if(isset($value['option'])){
                                  $CustomerOrder->addons= json_encode($value['option']);
                              }
                              $CustomerOrder->initialpasswort = bin2hex(openssl_random_pseudo_bytes(6));
                              $CustomerOrder->lastpaydate = $date;
                              $CustomerOrder->lastpayid= $responseData['ndc'];
                              $CustomerOrder->lastpaybrand = 'Sofort';
                              $CustomerOrder->payidlog = $responseData['id'];
                              if($CustomerOrder->validate()){
                                  $CustomerOrder->save();

                                  \app\extensions\greendev\vps\VPSTask::createVPSTask($Account->accountid,$CustomerOrder->id,$CustomerOrder->initialpasswort,$value);


                              }

                          }
                          elseif ($value['slug']  == 'managed-nextcloud'){

                          $CustomerOrder = new CustomerOrder();
                          $CustomerOrder->productid = $value['id'];
                          $CustomerOrder->accountid = $mandat['accountid'];
                          $article = new article();
                          $articlepaycycle = $article->getByIdArticle($value['id']);
                          $articlepaycycle = json_decode($articlepaycycle, true);
                          if (preg_match("/Start/", $articlepaycycle['name'])) {
                              $CustomerOrder->domain = 'https://' . \Yii::$app->params['NEXTCLOUD_API_HOSTNAME'];
                          } else {
                              if ($value['domainextension'] == '' or $value['domainextension'] == null) {
                                  $CustomerOrder->domain = 'https://' . strtolower($Account->personal_lastname) . '-' . strtolower($Account->personal_firstname) . '-' . $value['id'] . '.windcloud.de';
                              } else {
                                  $CustomerOrder->domain = 'https://' . $value['domainextension'];
                              }
                          }
                          $itemsdata = array();
                          $itemsdata['id'] = $value['id'];
                          $itemsdata['domain'] = $CustomerOrder->domain;
                          if (isset($value['option'])) {
                              $itemsdata['option'] = $value['option'];
                          }
                          $paycycle = '';
                          if (strpos($articlepaycycle['shortDescription2'], 'Jährlich') !== false) {
                              $paycycle = '12';
                          }
                          if (strpos($articlepaycycle['shortDescription2'], 'Jahr') !== false) {

                              $paycycle = '12';
                          }
                          if (strpos($articlepaycycle['shortDescription2'], 'Monatlich') !== false) {

                              $paycycle = '1';
                          }
                          $itemsdata['paycycle'] = $paycycle;
                          array_push($items, $itemsdata);
                          $responseData = json_decode($mandat['response'], true);
                          $CustomerOrder->paycycle = $paycycle;
                          $date = date("d.m.Y");
                          $CustomerOrder->lastpaydate = $date;
                          $CustomerOrder->lastpayid = $responseData['ndc'];
                          $CustomerOrder->lastpaybrand = 'SEPA';
                          $CustomerOrder->payidlog = $responseData['id'];
                          $productname = $articlepaycycle['name'];
                          if (preg_match("/Start/", $productname)) {
                              $CustomerOrder->active = 1;
                          }
                          if (preg_match("/Start/", $productname)) {
                              $CustomerOrder->username = $Account->personal_email;
                          } else {
                              $CustomerOrder->username = 'admin';
                          }
                          $CustomerOrder->initialpasswort = bin2hex(openssl_random_pseudo_bytes(6));
                          $CustomerOrder->activate_hash = bin2hex(openssl_random_pseudo_bytes(80));
                          if ($CustomerOrder->validate()) {
                              $CustomerOrder->save();
                              if (preg_match("/Start/", $productname)) {
                                  $username = $Account->personal_email;
                                  \app\extensions\greendev\mailtask\MailTask::setMailTask($username, $CustomerOrder, 'Start');
                              } else {
                                  $username = 'Admin';
                                  \app\extensions\greendev\mailtask\MailTask::setMailTask($username, $CustomerOrder, 'none');
                              }
                              if (preg_match("/Start/", $productname)) {
                                  $nextcloud = user::AddUser($username, $CustomerOrder->id . '' . $CustomerOrder->accountid, $Account->personal_email, $CustomerOrder->initialpasswort, $articlepaycycle['recordItemGroupName'] . "GB");

                                  if (preg_match("/(ok|100|OK)/", $nextcloud)) {
                                      Yii::$app->mailer->compose('layouts/productsunlock', ['account' => $username, 'productname' => $productname, 'initialpasswort' => $CustomerOrder->initialpasswort, 'domain' => $CustomerOrder->domain, 'CustomerData' => $Account, 'mail' => $Account->personal_email])
                                          ->setFrom('noreply@windcloud.de')
                                          ->setTo(strtolower($Account->personal_email))
                                          ->setSubject('Ihr Produkt ist jetzt Aktiv! Windcloud 4.0 GmbH')
                                          ->send();
                                  }

                              }

                          }
                          array_push($customerorderId, $CustomerOrder->id);
                      }
                      }
                      \app\extensions\greendev\SalesInvoiceTask\SalesInvoiceTask::setSalesInvoiceTask($mandat['accountid'],$items);
                      $RecurringPayment = new \app\models\Payment\RecurringPayment();
                      $RecurringPayment->recurringId =$mandat['registrationsId'];
                      $RecurringPayment->recurringentityId =$mandat['registrationsId'];
                      $RecurringPayment->accountid =$mandat['accountid'];
                      $RecurringPayment->cart =json_encode($mandat['cart']);
                      $RecurringPayment->customerorderId =json_encode($customerorderId);
                      $RecurringPayment->recurringType ='DIRECTDEBIT_SEPA';
                      if($RecurringPayment->validate()){
                          $RecurringPayment->save();
                          $session->set('ShoppingCart',null);
                      }
                      $session->set('ShoppingCart',null);
                      return  $this->redirect('/checkout/successful');

                }elseif (preg_match("/^(000\.400\.[1][0-9][1-9]|000\.400\.2)/",$mandat['resultcode']) || preg_match("/^(800\.[17]00|800\.800\.[123])/",$mandat['resultcode'])|| preg_match("/^(800\.[56]|999\.|600\.1|800\.800\.[84])/",$mandat['resultcode'])){
                      return  $this->redirect('/checkout/notsuccessful');
                }
                }else{
                    return  $this->redirect('/checkout/notsuccessful');
                }
            }else{
                return  $this->redirect('/checkout/notsuccessful');
            }

        }

    }

	public function actionSuccessfulpayment()
    {
        return $this->render('successfulpayment');
    }

    public function actionPaypal($token,$PayerID)
    {

        $session = Yii::$app->session;
        $AccessToken=\app\extensions\greendev\PaypalApi\PayPal::getAccessToken();
        $model = \app\extensions\greendev\PaypalApi\PayPal::getCheckoutCapture($AccessToken,$token,$PayerID);
        if($model== 'COMPLETED'){
            $accountid =$session->get('accountid');
            $items = array();
            $customerorderId = array();
            $Account = \app\models\Account::findIdentity($accountid);


            $customerPayPalLog = \app\models\logserver\customerPayPalLog::find()->where(['accountid' => $accountid,'token'=> $token])->one();


            $cart = json_decode($customerPayPalLog->cart,true);

            foreach ($cart as $value) {
                if($value['slug']   == 'vps'){
                    $CustomerOrder = new CustomerOrder();
                    $CustomerOrder->productid = $value['id'];
                    $CustomerOrder->accountid  =$accountid;
                    $CustomerOrder->paycycle =1;

                    $itemsdata = array();
                    $itemsdata['id'] = $value['id'];
                    $itemsdata['domain'] = " ";
                    $date = date("d.m.Y");
                    if(isset($value['option'])){
                        $CustomerOrder->addons= json_encode($value['option']);
                        $itemsdata['option'] = $value['option'];
                    }

                    $itemsdata['paycycle'] = '1';
                    array_push($items, $itemsdata);
                    $CustomerOrder->initialpasswort = bin2hex(openssl_random_pseudo_bytes(6));
                    $CustomerOrder->lastpaydate = $date;
                    $CustomerOrder->lastpayid = '0';
                    $CustomerOrder->lastpaybrand = 'paypal';
                    $CustomerOrder->payidlog = '0';

                    if($CustomerOrder->validate()){
                        $CustomerOrder->save();
                       \app\extensions\greendev\vps\VPSTask::createVPSTask($Account->accountid,$CustomerOrder->id,$CustomerOrder->initialpasswort,$value);
                    }

                }
                elseif ($value['slug']  == 'managed-nextcloud'){
                $CustomerOrder = new CustomerOrder();
                $CustomerOrder->productid = $value['id'];
                $CustomerOrder->accountid = $accountid;
                $article = new article();
                $articlepaycycle = $article->getByIdArticle($value['id']);
                $articlepaycycle = json_decode($articlepaycycle, true);
                if (preg_match("/Start/", $articlepaycycle['name'])) {
                    $CustomerOrder->domain = 'https://' . \Yii::$app->params['NEXTCLOUD_API_HOSTNAME'];
                } else {
                    if ($value['domainextension'] == '' or $value['domainextension'] == null) {
                        $CustomerOrder->domain = 'https://' . strtolower($Account->personal_lastname) . '-' . strtolower($Account->personal_firstname) . '-' . $value['id'] . '.windcloud.de';
                    } else {
                        $CustomerOrder->domain = 'https://' . $value['domainextension'];
                    }
                }
                $itemsdata = array();
                $itemsdata['id'] = $value['id'];
                $itemsdata['domain'] = $CustomerOrder->domain;
                if (isset($value['option'])) {
                    $itemsdata['option'] = $value['option'];
                }
                $paycycle = '';
                if (strpos($articlepaycycle['shortDescription2'], 'Jährlich') !== false) {
                    $paycycle = '12';
                }
                if (strpos($articlepaycycle['shortDescription2'], 'Jahr') !== false) {

                    $paycycle = '12';
                }
                if (strpos($articlepaycycle['shortDescription2'], 'Monatlich') !== false) {

                    $paycycle = '1';
                }
                $itemsdata['paycycle'] = $paycycle;
                array_push($items, $itemsdata);
                $CustomerOrder->paycycle = $paycycle;
                $date = date("d.m.Y");
                if (isset($value['option'])) {
                    $CustomerOrder->addons = json_encode($value['option']);
                }
                $CustomerOrder->lastpaydate = $date;
                $CustomerOrder->lastpayid = '0';
                $CustomerOrder->lastpaybrand = 'paypal';
                $CustomerOrder->payidlog = '0';
                $productname = $articlepaycycle['name'];
                if (preg_match("/Start/", $productname)) {
                    $CustomerOrder->active = 1;
                }
                if (preg_match("/Start/", $productname)) {
                    $CustomerOrder->username = $Account->personal_email;
                } else {
                    $CustomerOrder->username = 'admin';
                }
                $CustomerOrder->initialpasswort = bin2hex(openssl_random_pseudo_bytes(6));
                $CustomerOrder->activate_hash = bin2hex(openssl_random_pseudo_bytes(80));


                if ($CustomerOrder->validate()) {
                    $CustomerOrder->save();
                    if (preg_match("/Start/", $productname)) {
                        $username = $Account->personal_email;
                        \app\extensions\greendev\mailtask\MailTask::setMailTask($username, $CustomerOrder, 'Start');
                    } else {
                        $username = 'Admin';
                        \app\extensions\greendev\mailtask\MailTask::setMailTask($username, $CustomerOrder, 'none');
                    }
                    if (preg_match("/Start/", $productname)) {
                        $nextcloud = user::AddUser($username, $CustomerOrder->id . '' . $CustomerOrder->accountid, $Account->personal_email, $CustomerOrder->initialpasswort, $articlepaycycle['recordItemGroupName'] . "GB");
                        if (preg_match("/(ok|100|OK)/", $nextcloud)) {
                            Yii::$app->mailer->compose('layouts/productsunlock', ['account' => $username, 'productname' => $productname, 'initialpasswort' => $CustomerOrder->initialpasswort, 'domain' => $CustomerOrder->domain, 'CustomerData' => $Account, 'mail' => $Account->personal_email])
                                ->setFrom('noreply@windcloud.de')
                                ->setTo(strtolower($Account->personal_email))
                                ->setSubject('Ihr Produkt ist jetzt Aktiv! Windcloud 4.0 GmbH')
                                ->send();
                        }
                    }

                } else {
                    $errores = $CustomerOrder->getErrors();
                    print_r($errores);
                    print_r($CustomerOrder);
                }
                array_push($customerorderId, $CustomerOrder->id);
            }
            }

            \app\extensions\greendev\SalesInvoiceTask\SalesInvoiceTask::setSalesInvoiceTask($accountid,$items);
            $session->set('ShoppingCart',null);
            return $this->redirect(['checkout/successful']);
        }else{
            return $this->redirect(['checkout/notsuccessful']);
        }
    }


    public function actionSofortueberweisung($trx){
        $model = \app\extensions\greendev\SofortueberweisungApi\sofort::getTransactionData($trx);
        if($model){
            return $this->redirect(['checkout/successful']);
        }else{
            return $this->redirect(['checkout/notsuccessful']);
        }

    }

    public function actionSofortueberweisungNotification(){
        $json =file_get_contents('php://input');
        $model = \app\extensions\greendev\SofortueberweisungApi\sofort::getNotification($json);
        return $model;
    }
}
