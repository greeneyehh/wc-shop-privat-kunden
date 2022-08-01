<?php


namespace app\controllers;

use app\extensions\greendev\nextcloud\user;
use app\extensions\greendev\vrpayment\payment;
use app\extensions\greendev\weclapp\article;
use app\extensions\greendev\weclapp\helpdesk;
use app\extensions\greendev\weclapp\salesInvoice;
use app\extensions\greendev\weclapp\articleCategory;
use app\extensions\greendev\weclapp\customer;
use app\models\Account;
use app\models\AccountPass;
use app\models\cms\CmsNews;
use app\models\config\vrpaybrandsconfig;
use app\models\dashboard\ForgotPasswordForm;
use app\models\mailtasker\MailTask;
use app\models\shop\Invoice;
use app\models\seo\Seomanager;
use app\models\shop\CustomerOrder;
use app\models\product\ProductType;
use app\models\dashboard\user\DashboardInfoDB;
use app\models\shop\PaymentPostModel;
use app\models\shop\ShopSlugCategory;
use Yii;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use app\extensions\greendev\weclapp\variantArticle;
use app\models\ShopProduct;
use yii\data\Pagination;
use app\extensions\greendev\proxmox\proxmox;

class AjaxController extends Controller
{
    public function actionVariant($id) {
        if (Yii::$app->request->isAjax) {
            Yii::$app->assetManager->bundles = [
                'yii\bootstrap\BootstrapPluginAsset' => false,
                'yii\bootstrap\BootstrapAsset' => false,
                'yii\web\JqueryAsset' => false
            ];
            $ShopProduct = new variantArticle();
            $array = $ShopProduct->getByVariantId($id);
            $data = json_decode($array,true);
            return $this->renderAjax('produkte', ['model' => $data]);
        }
    }

    public function actionVpsVariant($id) {
        if (Yii::$app->request->isAjax) {
            Yii::$app->assetManager->bundles = [
                'yii\bootstrap\BootstrapPluginAsset' => false,
                'yii\bootstrap\BootstrapAsset' => false,
                'yii\web\JqueryAsset' => false
            ];
            $ShopProduct = new variantArticle();
            $array = $ShopProduct->getByVariantId($id);
            $data = json_decode($array,true);
            return $this->renderAjax('produkte-vps', ['model' => $data]);
        }
    }
    public function actionAddonvariant($id,$position) {
        if (Yii::$app->request->isAjax) {
            Yii::$app->assetManager->bundles = [
                'yii\bootstrap\BootstrapPluginAsset' => false,
                'yii\bootstrap\BootstrapAsset' => false,
                'yii\web\JqueryAsset' => false
            ];
            print_r($id);
            echo '<br>';
            print_r($position);

            $ShopProduct = new variantArticle();
            //$array = $ShopProduct->getByVariantId($id);
            //$data = json_decode($array,true);
            //return $this->renderAjax('produkte', ['model' => $data]);
        }
    }

    public function actionGetcontract($id) {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->user->isGuest) {
                return  $this->redirect('/dashboard/login');
            }
            $CustomerOrder = new CustomerOrder();
            $product = $CustomerOrder::find()->where(['accountid' => Yii::$app->user->identity->accountid,'id' => $id])->one();

            $ProductType = new ProductType();
            $producttype = $ProductType::find()->where(['productid' => $product->productid])->one();


            if($producttype->type == 1){
                $ch = curl_init('https://'.$product['domain']);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                $result = curl_exec($ch);
                curl_close($ch);
                $array = json_decode($result,true);

                $article = new article();
                $productname= $article->getByIdArticle($product->productid);
                $productname = json_decode($productname,true);

                return $this->renderAjax('contract',['product' => $product,'productname' => $productname]);
            }
            if($producttype->type==3){
                $userarray = \app\extensions\greendev\proxmox\proxmox::qemuCurrent(Yii::$app->user->identity->accountid.'-'.$id);

                $ip=proxmox::qemuNetwork(Yii::$app->user->identity->accountid.'-'.$id);
                $ip = json_decode(json_encode($ip), true);

                $os=proxmox::qemuGetOsInfo(Yii::$app->user->identity->accountid.'-'.$id);
                $os = json_decode(json_encode($os), true);

                $article = new article();
                $productname= $article->getByIdArticle($product->productid);
                $productname = json_decode($productname,true);

                return $this->renderAjax('contract-vps',['product' => $product,'productname' => $productname,'status'=>$userarray->data,'ip'=>$ip,'os'=>$os]);


            }


        }
    }

    public function actionGetopenticket () {

        if (Yii::$app->request->isAjax) {
            if (Yii::$app->user->isGuest) {
                return  $this->redirect('/dashboard/login');
            }
            $helpdesk = new helpdesk();
            $ticket = $helpdesk->getTicket(Yii::$app->user->identity['accountid']);
            $ticket = json_decode($ticket,true);
            $ar = [];
            $i = 0;
            foreach ($ticket['result'] as $tickets){
                $arr = array();
                array_push($arr, $tickets['ticketNumber']);
                array_push($arr, $tickets['subject']);
                array_push($arr, $tickets['ticketStatusName']);
                array_push($arr, date("d.m.y H:i:s", $tickets['createdDate']/1000));
                array_push($arr, date("d.m.y H:i:s", $tickets['lastModifiedDate']/1000));
                array_push($ar, $arr);
            }
            $response = [
                'data' => $ar , // Required by DataTables
                'form_errors' => [ ] // Not required by DataTables
            ];
            return json_encode($response);
            // $helpdesk = new helpdesk();
            // $ticket = $helpdesk->getTicket(Yii::$app->user->identity['accountid']);
            // $tickets = json_decode($ticket,true);
            // print_r($tickets['result']) ;
        }
    }

    public function actionGetuserforadmin () {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->user->isGuest) {
                return  $this->redirect('/dashboard/login');
            }
            if(Yii::$app->user->identity->right >= 4)
            {
                $customer = new customer();
                $customer = $customer->getAllCustomer();


                $ar = [];
                $i = 0;
                foreach ($customer['result'] as $customers){
                    if(isset($customers['customerCategoryName']) && $customers['customerCategoryName'] != 'Standard'  ){
                        $arr = array();
                        $paid= null;
                        array_push($arr, $customers['customerNumber']);

                        if (isset($customers['firstName'])) {
                            array_push($arr, $customers['firstName']);
                        } else{
                            if (isset($customers['company'])){
                                array_push($arr, $customers['company']);
                            }else{
                                array_push($arr, 'keine daten');
                            }
                        }

                        if (isset($customers['lastName'])) {
                            array_push($arr, $customers['lastName']);
                        }else{
                            if (isset($customers['company'])){
                                array_push($arr, $customers['company']);
                            }else{
                                array_push($arr, 'keine daten');
                            }
                        }
                        if (isset($customers['email'])) {
                            array_push($arr, $customers['email']);
                        }else{
                            if (isset($customers['phone'])){
                                array_push($arr, $customers['phone']);
                            }else{
                                array_push($arr, 'keine daten');
                            }
                        }

                        if (isset($customers['customerCategoryName'])) {
                            array_push($arr, $customers['customerCategoryName']);
                        }else{
                            array_push($arr, 'keine daten');
                        }
                        array_push($ar, $arr);
                    }
                }
                $response = [
                    'data' => $ar , // Required by DataTables
                    'form_errors' => [ ] // Not required by DataTables
                ];
                return json_encode($response);
            }else{
                return  $this->redirect('/dashboard');
            }
        }
    }

    public function actionGetinvoice () {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->user->isGuest) {
                return  $this->redirect('/dashboard/login');
            }
            $invoice = new salesInvoice();
            $invoice =$invoice->getAllInvoice(Yii::$app->user->identity->accountid);
            $invoice = json_decode($invoice,true);
            $ar = [];
            $i = 0;
            foreach ($invoice['result'] as $invoices){
                $arr = array();
                $paid= null;
                if($invoices['paid'] == true){
                    $paid = "<i style='color: #1c7430'>Bezahlt <i class='fas fa-check'></i></i>";
                }else{

                    $PaymentResult =  Invoice::find()->where(['invoiceNumber' => $invoices['invoiceNumber']])->one();
                    /*if(empty($PaymentResult)){
                        $paid = "<i style='color: #721c24'>Offen <i class='far fa-hand-paper'></i></i> | <button class='btn btn-success' type='button' data-toggle='modal' data-target='#theModal' data-remote='/ajax/payselect?invoiceid=".$invoices['id']."&invoicenumber=".$invoices['invoiceNumber']."'>Bezahlen</button>";
                    }else{
                        $paid = "<i style='color: #721c24'>Offen <i class='far fa-hand-paper'></i></i> | <button class='btn btn-secondary disabled' type='button' data-toggle='modal' data-target='#theModal'>Bezahlen</button>";
                    }*/

                    if(empty($PaymentResult)){
                       // $paid = "<i style='color: #721c24'>Offen <i class='far fa-hand-paper'></i></i> | <button class='btn btn-success' type='button' data-toggle='modal' data-target='#theModal' data-remote='/ajax/payselect?invoiceid=".$invoices['id']."&invoicenumber=".$invoices['invoiceNumber']."'>Bezahlen</button>";
                        $paid ="<i style='color: #721c24'>Offen <i class='far fa-hand-paper'></i></i> | <a href='invoice-pay?invoiceid=".$invoices['id']."&invoicenumber=".$invoices['invoiceNumber']."'><button class='btn btn-success' type='button' onclick='' >Bezahlen</button></a>";
                    }else{
                        $paid = "<i style='color: #721c24'>Offen <i class='far fa-hand-paper'></i></i> | <a href='invoice-pay?invoiceid=".$invoices['id']."&invoicenumber=".$invoices['invoiceNumber']."'><button class='btn btn-success' type='button' onclick='' >Bezahlen</button></a>";
                    }
                }
                switch ($invoices['status']) {
                    case "DOCUMENT_CREATED":
                        $invoices['status'] = "<i class='fas fa-search'></i> | <a  target='_blank' href='/dashboard/pdf-invoice?id=".$invoices['id']."' ><i class='far fa-file-pdf'></i></a> | ".$paid;
                        break;
                    case "BOOKED":
                        $invoices['status'] = "<i class='fas fa-search'></i> | <a  target='_blank' href='/dashboard/pdf-invoice?id=".$invoices['id']."' ><i class='far fa-file-pdf'></i></a> | ".$paid;
                        break;
                    case "NEW":
                        $invoices['status'] = "<i class=\"fas fa-search\"></i> Fehler";
                        break;
                    case "VOID":
                        $invoices['status'] = "<i style='color: #c69500'>Storniert <i class='far fa-hand-paper'></i></i>";
                        break;
                }
                array_push($arr, $invoices['status']);
                array_push($arr, $invoices['invoiceNumber']);
                array_push($arr, date("d.m.Y", $invoices['createdDate']/1000));
                array_push($arr, number_format($invoices['grossAmountInCompanyCurrency'], 2, '.', '') .' Euro');
                array_push($ar, $arr);
            }
            $response = [
                'data' => $ar , // Required by DataTables
                'form_errors' => [ ] // Not required by DataTables
            ];
            return json_encode($response);

        }
    }

    public function actionGetproduct () {

        if (Yii::$app->request->isAjax) {
            if (Yii::$app->user->isGuest) {
                return  $this->redirect('/dashboard/login');
            }else{
                $CustomerOrder = new CustomerOrder();
                $product = $CustomerOrder::find()->where(['accountid' => Yii::$app->user->identity->accountid])->orderBy(['id'=>SORT_DESC])->all();
                $ar = [];
                foreach ($product as $products){
                    $arr = array();
                    $Allarticle = new article();
                    $article =$Allarticle->getByIdArticle($products['productid']);
                    $article = json_decode($article,true);
                    $articleid = $article['id'];

                    if(isset($article['articleCategoryId'])){

                        $Categoryid = $article['articleCategoryId'];
                    }else{
                        $ShopSlugCategory = new \app\models\shop\ShopSlugCategory();
                        $Catid = $ShopSlugCategory::find()->where(['label' => "vps"])->one();
                        $Categoryid =$Catid->categoryid;
                    }


                    $AllCategory = new articleCategory();
                    $Category =$AllCategory->getCategoryById($Categoryid);
                    $term='';
                    $paycycle='';
                    if (strpos($article['shortDescription2'], 'Jährlich') !== false) {
                        $term= '1 Jahr';
                        $paycycle= '+12 month';
                    }
                    if (strpos($article['shortDescription2'], 'Jahr') !== false) {
                        $term= '1 Jahr';
                        $paycycle= '+12 month';
                    }
                    if (strpos($article['shortDescription2'], 'Monatlich') !== false) {
                        $term= '1 Monat';
                        $paycycle= '+1 month';
                    }
                    $addons="";
                    $price=$article['articlePrices'][0]['price'];
                    if(isset($products['addons'])){
                        $productaddons= json_decode($products['addons'],true);
                        foreach ($productaddons as $addon){
                            $addons .='<p>'. $addon['name'] .'</p>';
                            $price = $price + $addon['price'];
                        }
                    }
                    array_push($arr, $products['id']);
                    if($Category['description'] =="Virtuelle Private Server"){
                        array_push($arr, Yii::$app->user->identity->accountid.'-'.$products['id']);
                    }elseif ($Category['description'] =="Cloud Storage"){
                        array_push($arr, '<div class="'. $Category['description'] .'">'.$products['productid'].' | '.$products['id'].'</div>');
                    }else{
                        array_push($arr, '<div class="'. $Category['description'] .'">'.$products['productid'].' | '.$products['id'].'</div>');
                    }

                    array_push($arr, '<div class="'. $Category['description'] .'">'.$article['name'].'</div>');
                    array_push($arr, '<div class="'. $Category['description'] .'">'.$addons.'</div>');
                    array_push($arr, $Category['description']);
                    array_push($arr, '<div class="'. $Category['description'] .'">'.number_format($price + $price *Yii::$app->params['STEUERSATZ'] , 2, '.', '') .' €'.'</div>');
                    array_push($arr, '<div class="'. $Category['description'] .'">'.$term.'</div>');
                    $date= strtotime($products['datetime']);
                    array_push($arr, '<div class="'. $Category['description'] .'">'.date( 'd.m.Y', $date).'</div>');

                    $date = strtotime(date("d.m.Y", strtotime($products['lastpaydate'])) . $paycycle);
                    $date = date("d.m.Y",$date);

                    array_push($arr, '<div class="'. $Category['description'] .'">'.$date.'</div>');
                    array_push($ar, $arr);
                }
                $response = [
                    'data' => $ar , // Required by DataTables
                    'form_errors' => [ ] // Not required by DataTables
                ];
                return json_encode($response);

            }
        }
    }

    public function actionHomeinfos () {

        if (Yii::$app->request->isAjax) {
            if (Yii::$app->user->isGuest) {
                return  $this->redirect('/dashboard/login');
            }
            $info =  DashboardInfoDB::find()->orderBy('datum DESC')->limit('1')->all();
            return $this->renderAjax('infos',['info' => $info]);
        }
    }

    public function actionLastbill () {

        if (Yii::$app->request->isAjax) {
            if (Yii::$app->user->isGuest) {
                return  $this->redirect('/dashboard/login');
            }
            $invoice = new salesInvoice();
            $invoice =$invoice->getInvoice(Yii::$app->user->identity->accountid ,"DOCUMENT_CREATED");
            $invoice = json_decode($invoice,true);


            return $this->renderAjax('lastbill',['invoice' => $invoice]);
        }
    }

    public function actionOpenbill () {

        if (Yii::$app->request->isAjax) {
            if (Yii::$app->user->isGuest) {
                return  $this->redirect('/dashboard/login');
            }
            $invoice = new salesInvoice();
            $invoice = $invoice->getInvoicePaid(Yii::$app->user->identity->accountid ,"false");
            $invoice = json_decode($invoice,true);
            return $this->renderAjax('openbill',['invoice' => $invoice]);
        }
    }

    public function actionOpentickets () {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->user->isGuest) {
                return  $this->redirect('/dashboard/login');
            }
            $helpdesk = new helpdesk();
            $ticket = $helpdesk->getTicketByStatus(Yii::$app->user->identity['accountid'],'In Bearbeitung');
            $tickets = json_decode($ticket,true);
            $TicketUser = $helpdesk->getUser();
            $TicketgetUser = json_decode($TicketUser,true);
            $TicketCategory = $helpdesk->getTicketCategory();
            $TicketCategorys = json_decode($TicketCategory,true);
            $CategoryData=[];
            foreach ($TicketCategorys['result'] as $Categorys){
                $CategoryData[$Categorys['id']] = $Categorys['name'];
            }
            $UserData=[];
            foreach ($TicketgetUser['result'] as $User){
                $UserData[$User['id']] = $User['firstName'] .' '.$User['lastName'];
            }
            return $this->renderAjax('opentickets',['tickets' => $tickets,'UserData' =>$UserData ,'CategoryData' =>$CategoryData ]);
        }


    }

    public function actionForgotPassword () {
        if (Yii::$app->request->isAjax) {
            Yii::$app->session->setFlash('info', 'This is the message');
            $model = new ForgotPasswordForm();
            if ($model->load(Yii::$app->request->post())) {
                $Account = AccountPass::findByUsername(strtolower($model->personal_email));
                $customer = new customer();
                $arr = $customer->getByMailCustomer(strtolower($model->personal_email));
                $array = json_decode($arr,true);
                $mailname ="";

                if(isset($Account)){
                    $Account->accessToken = Yii::$app->getSecurity()->generateRandomString(120);
                    $now = date("d.m.Y H:i:s");
                    $timestamp = date("d.m.Y H:i:s", strtotime("+24 hours $now"));


                    $Account->forgotpasswordtime = $timestamp;
                    if($Account->validate()) {
                        Yii::$app->mailer->compose('layouts/forgotpassword', ['mailcode' => $Account->accessToken,'mail'=> strtolower($model->personal_email),'name'=>$mailname])
                            ->setFrom('noreply@windcloud.de')
                            ->setTo(strtolower($model->personal_email))
                            ->setSubject('Passwort Zurücksetzen Windcloud 4.0 GmbH')
                            ->send();
                        $text = "Sie erhalten eine E-Mail zur Änderung Ihres Passworts. Bitte folgen Sie den Anweisungen in der E-Mail.";

                        $Account->save();
                        $array = array(
                            'status' => 'success',
                            'text'   => $text,
                        );
                    }else{
                        $array = array(
                            'status' => 'success',
                            'text'   => $Account->errors,
                        );
                    }

                    return json_encode($array);
                }
                else{
                    $text = "Die von Ihnen angegebene E-Mail konnte keinem Benutze zugewiesen werden. Stellen Sie sicher, dass die E-Mail korrekt ist.";

                    $array = array(
                        'status' => 'error',
                        'text'   => $text,
                    );
                    return json_encode($array);

                }
            }
        }
    }

    public function actionPayselect($invoiceid,$invoicenumber) {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->user->isGuest) {
                return  $this->redirect('/dashboard/login');
            }
            Yii::$app->assetManager->bundles = [

                'yii\bootstrap\BootstrapPluginAsset' => false,

                'yii\bootstrap\BootstrapAsset' => false,

                'yii\web\JqueryAsset' => false
            ];
            $PaymentPostModel = new PaymentPostModel();
            $vrpaybrands = vrpaybrandsconfig::find()->where(['status' => 1])->all();
            $paybrands = array();
            foreach ($vrpaybrands as $row) {
                $paybrands[$row['name']] = '<img src="/image/payment-icons/'.$row['image'].'" size="20px" style="width: 120px;">';
            }

            if ($PaymentPostModel->load(Yii::$app->request->post())) {


                switch ($PaymentPostModel->brand){
                    case 'DIRECTDEBIT_SEPA':
                        $model = new \app\models\form\SepaForm();
                        $array = [
                            'accountid' => Yii::$app->user->identity->getId(),
                            'brand'  => 'SOFORTUEBERWEISUNG',
                            'invoicenumber'  => $invoicenumber,
                            'invoiceid'  => $invoiceid,
                        ];
                        $data=\app\extensions\greendev\vrpayment\payment::base64url_encode(json_encode($array));
                        return $this->renderAjax('brands/DIRECTDEBIT_SEPA',['model'=>$model,'data'=>$data]);
                    case 'PAYPAL':
                        $model = \app\extensions\greendev\vrpayment\payment::getCheckoutPayPalDashboardRegistration($invoicenumber,$invoiceid);
                        $model = json_decode($model, true);
                        if(isset($model['redirect']['url'])){
                            $parameters = $model['redirect']['parameters'];
                            $data=[];
                            foreach($parameters as $key=>$value)
                            {
                                $data[$value['name']] = $value['value'];
                            }
                            $url=$model['redirect']['url'].'?'.http_build_query($data);
                            return $this->redirect($url);
                        }else{
                            return $this->renderAjax('noresult');
                        }

                    case 'SOFORTUEBERWEISUNG':
                        $model = \app\extensions\greendev\vrpayment\payment::getCheckoutSofortDashboardRegistration($invoicenumber,$invoiceid);
                        $model = json_decode($model, true);
                        if(isset($model['redirect']['url'])){
                            $parameters = $model['redirect']['parameters'];
                            $data=[];
                            foreach($parameters as $key=>$value)
                            {
                                $data[$value['name']] = $value['value'];
                            }
                            $url=$model['redirect']['url'].'?'.http_build_query($data);
                            return $this->redirect($url);
                        }else{
                            return $this->renderAjax('noresult');
                        }

                    case 'VISA':
                        $model = \app\extensions\greendev\vrpayment\payment::getCheckoutCreditcardsDashboardRegistration('VISA',$invoicenumber,$invoiceid);
                        $vrpayconfig = \app\models\config\vrpayconfig::find()->asArray()->all();
                        $keyReturnUrl = array_search('DashboardReturnUrl', array_column($vrpayconfig, 'name'));
                        $keyUrl = array_search('Url', array_column($vrpayconfig, 'name'));
                        $model = json_decode($model, true);
                        $array = [
                            'accountid' => Yii::$app->user->identity->getId(),
                            'brand'  => 'VISA',
                            'invoicenumber'  => $invoicenumber,
                            'invoiceid'  => $invoiceid,
                        ];
                        $data=\app\extensions\greendev\vrpayment\payment::base64url_encode(json_encode($array));



                        return $this->renderAjax('brands/VISA',['model'=>$model,'data'=>$data,'Url'=>$vrpayconfig[$keyUrl]['variable'],'ReturnUrl'=>$vrpayconfig[$keyReturnUrl]['variable']]);

                    case 'MASTER':
                        $model = \app\extensions\greendev\vrpayment\payment::getCheckoutCreditcardsDashboardRegistration('MASTER',$invoicenumber,$invoiceid);
                        $vrpayconfig = \app\models\config\vrpayconfig::find()->asArray()->all();
                        $keyReturnUrl = array_search('DashboardReturnUrl', array_column($vrpayconfig, 'name'));
                        $keyUrl = array_search('Url', array_column($vrpayconfig, 'name'));
                        $model = json_decode($model, true);
                        $array = [
                            'accountid' => Yii::$app->user->identity->getId(),
                            'brand'  => 'MASTER',
                            'invoicenumber'  => $invoicenumber,
                            'invoiceid'  => $invoiceid,
                        ];
                        $data=\app\extensions\greendev\vrpayment\payment::base64url_encode(json_encode($array));
                        return $this->renderAjax('brands/MASTER',['model'=>$model,'data'=>$data,'Url'=>$vrpayconfig[$keyUrl]['variable'],'ReturnUrl'=>$vrpayconfig[$keyReturnUrl]['variable']]);

                }
            }


            return $this->renderAjax('payselect',['invoiceid' => $invoiceid,'invoicenumber'=>$invoicenumber,'PaymentPostModel' => $PaymentPostModel,'vrpaybrands' => $paybrands]);

        }
    }

    public function actionPayment($id,$invoicenumber,$brand)
    {
        $responseData = payment::getAjaxcheckouts($brand,$invoicenumber,$id);
        $responseData = json_decode($responseData, true);
        return $this->renderAjax('payment',['responseData' => $responseData,'invoicenumber'=>$invoicenumber,'brand'=>$brand]);
    }

    public function actionGetseodata () {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->user->isGuest) {
                return  $this->redirect('/dashboard/login');
            }
            if(Yii::$app->user->identity->right >= 4)
            {
                $modeldb = Seomanager::find()->all();
                $ar = [];
                $i = 0;
                foreach ($modeldb as $customers){
                    $arr = array();

                    array_push($arr, $customers->id);
                    array_push($arr, $customers->route);
                    array_push($arr, $customers->title);
                    array_push($arr, $customers->keywords);
                    array_push($arr, $customers->description);
                    array_push($arr, $customers->canonical);


                    array_push($ar, $arr);

                }
                $response = [
                    'data' => $ar , // Required by DataTables
                    'form_errors' => [ ] // Not required by DataTables
                ];
                return json_encode($response);

            }
        }
    }

    public function actionGetseodataupdate ($id) {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->user->isGuest) {
                return  $this->redirect('/dashboard/login');
            }
            if(Yii::$app->user->identity->right >= 4)
            {
                $seodata = Seomanager::find()->where(['id' => $id])->one();
                return $this->renderAjax('seoupdate', ['seodata' => $seodata]);

            }
        }
    }

    public function actionGetnewsdata () {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->user->isGuest) {
                return  $this->redirect('/dashboard/login');
            }
            if(Yii::$app->user->identity->right >= 4)
            {
                $modeldb = CmsNews::find()->all();
                $ar = [];
                $i = 0;
                foreach ($modeldb as $News){
                    $arr = array();

                    array_push($arr, $News->id);
                    array_push($arr, $News->titel);
                    array_push($arr, substr($News->description, 0, 500));
                    array_push($arr, $News->slug);
                    array_push($arr, $News->datetime);
                    array_push($arr, "<div><a class='btn btn-warning' href='/dashboard/newsmanager-edit?id=$News->id'>Bearbeiten</a><p></p><a class='btn btn-danger' href='/dashboard/newsmanager-delete?id=$News->id'>Löschen</a></div>");

                    array_push($ar, $arr);

                }
                $response = [
                    'data' => $ar , // Required by DataTables
                    'form_errors' => [ ] // Not required by DataTables
                ];
                return json_encode($response);

            }
        }
    }

    public function actionAddproducts($id) {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->user->isGuest) {
                return  $this->redirect('/dashboard/login');
            }
            if(Yii::$app->user->identity->right >= 4)
            {
                $customer = new customer();
                $customer = $customer->getByIdCustomer($id);
                $ShopProduct = new article();
                $articleidProduct =$ShopProduct->getArticle();
                $article = array();
                foreach ($articleidProduct['result'] as $row) {
                    $article[$row['id']] = $row['name'].' | '.$row['articleNumber'];
                }
                $paycycle= ['1' => '1 Monat', '12' => '12 Monate'];
                $CustomerOrder = new CustomerOrder();
                /*if (Yii::$app->request->isAjax) {
                    if ($CustomerOrder->load(Yii::$app->request->post())) {
                        echo '<pre>-----';
                        print_r($CustomerOrder);
                        die();
                    }
                }*/


                return $this->renderAjax('addproducts',['id'=>$id,'CustomerOrder'=>$CustomerOrder,'ShopCategoryProduct'=>$article,'paycycle'=>$paycycle]);
            }
        }
    }
    public function actionAddvpsproducts($id) {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->user->isGuest) {
                return  $this->redirect('/dashboard/login');
            }
            if(Yii::$app->user->identity->right >= 4)
            {
                $SlugCategory = ShopSlugCategory::findByLabel("vps");
                $SlugId=$SlugCategory->categoryid;
                $customer = new customer();
                $customer = $customer->getByIdCustomer($id);
                $customer = json_decode($customer,true);
                $ShopProduct = new article();
                $articleidProduct =$ShopProduct->getByCategoryId($SlugId);
                $arrayProduct = json_decode($articleidProduct,true);
                $CustomerOrder = new CustomerOrder();
                return $this->renderAjax('addvpsproducts',['id'=>$id,'customer'=>$customer,'CustomerOrder'=>$CustomerOrder,'ShopCategoryProduct'=>$arrayProduct]);
            }
        }
    }

    public function actionCancellation($id) {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->user->isGuest) {
                return  $this->redirect('/dashboard/login');
            }
            $CustomerOrder = CustomerOrder::find()->where(['id' => $id])->one();
            $helpdesk = new helpdesk();
            $CustomerOrder->cancellation = 1;
            $paycycle= '+14 day';
            $date = strtotime(date("d.m.Y", strtotime($CustomerOrder['lastpaydate'])) . $paycycle);
            $date = date("d.m.Y",$date);
            $CustomerOrder->cancellationdate =$date;
            if($CustomerOrder->validate()){
                $CustomerOrder->save();
                $article = new article();
                $articlepaycycle= $article->getByIdArticle($CustomerOrder->productid);
                $articlepaycycle = json_decode($articlepaycycle,true);
                $productname= $articlepaycycle['name'];
                if(preg_match("/Start/",$productname)){
                    $username = $CustomerOrder->id . '' .$CustomerOrder->accountid;
                }else{
                    $username = 'admin';
                }
                $kontaktForm =[];
                if(preg_match("/Start/",$productname)){
                    $kontaktForm['message'] = Yii::$app->params['WECLAPP_API_CANCELLATION_MESSAGE_1'] . ' '. $productname . ' '. Yii::$app->params['WECLAPP_API_CANCELLATION_MESSAGE_2'] . ' '. $date . ' '. Yii::$app->params['WECLAPP_API_CANCELLATION_MESSAGE_3']. ' ' .Yii::$app->params['WECLAPP_API_CANCELLATION_MESSAGE_4'] .' '. $username;
                }else{
                    $kontaktForm['message'] = Yii::$app->params['WECLAPP_API_CANCELLATION_MESSAGE_1'] . ' '. $productname . ' '. Yii::$app->params['WECLAPP_API_CANCELLATION_MESSAGE_2'] . ' '. $date . ' '. Yii::$app->params['WECLAPP_API_CANCELLATION_MESSAGE_3']. ' ' .Yii::$app->params['WECLAPP_API_CANCELLATION_MESSAGE_5'] .' '. $CustomerOrder['domain'];
                }
                $kontaktForm['subject'] =  Yii::$app->params['WECLAPP_API_CANCELLATION_SUBJECT'];
                $kontaktForm['area'] = Yii::$app->params['WECLAPP_API_BUCHHALTUNG_ID'];


                $helpdesk->createTicket($kontaktForm);

                return $this->renderAjax('cancellation', ['CustomerOrder' => $CustomerOrder]);
            }else{
                var_dump($CustomerOrder->errors);
            }

        }
    }

    public function actionVmShutdown($id) {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->user->isGuest) {
                return  $this->redirect('/dashboard/login');
            }
            $CustomerOrder = CustomerOrder::find()->where(['id' => $id,'accountid'=>Yii::$app->user->identity['accountid']])->one();

            proxmox::qemuShutdown(Yii::$app->user->identity['accountid'].'-'.$id,$CustomerOrder->vmid);
            $userarray = proxmox::qemuCurrent(Yii::$app->user->identity['accountid'].'-'.$id);

            $article = new article();
            $productname= $article->getByIdArticle($CustomerOrder->productid);
            $productname = json_decode($productname,true);
            return $this->renderAjax('contract-vps', ['message' => 'der server wird Herunterfahren','product' => $CustomerOrder,'productname' => $productname,'status'=>$userarray->data]);
        }
    }

    public function actionVmStart($id) {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->user->isGuest) {
                return  $this->redirect('/dashboard/login');
            }
            $CustomerOrder = CustomerOrder::find()->where(['id' => $id,'accountid'=>Yii::$app->user->identity['accountid']])->one();
            proxmox::qemuStart(Yii::$app->user->identity['accountid'].'-'.$id,$CustomerOrder->vmid);
            $userarray = proxmox::qemuCurrent(Yii::$app->user->identity['accountid'].'-'.$id);

            $article = new article();
            $productname= $article->getByIdArticle($CustomerOrder->productid);
            $productname = json_decode($productname,true);
            return $this->renderAjax('contract-vps', ['message' => 'der server wird gestartet','product' => $CustomerOrder,'productname' => $productname,'status'=>$userarray->data]);

        }

    }

    public function actionVmStop($id) {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->user->isGuest) {
                return  $this->redirect('/dashboard/login');
            }
            $CustomerOrder = CustomerOrder::find()->where(['id' => $id,'accountid'=>Yii::$app->user->identity['accountid']])->one();

            proxmox::qemuStop(Yii::$app->user->identity['accountid'].'-'.$id,$CustomerOrder->vmid);
            $userarray = proxmox::qemuCurrent(Yii::$app->user->identity['accountid'].'-'.$id);

            $article = new article();
            $productname= $article->getByIdArticle($CustomerOrder->productid);
            $productname = json_decode($productname,true);
            return $this->renderAjax('contract-vps', ['message' => 'der server wird gestartet','product' => $CustomerOrder,'productname' => $productname,'status'=>$userarray->data]);

        }

    }

    public function actionVmReboot($id) {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->user->isGuest) {
                return  $this->redirect('/dashboard/login');
            }
            $CustomerOrder = CustomerOrder::find()->where(['id' => $id,'accountid'=>Yii::$app->user->identity['accountid']])->one();

            proxmox::qemuReboot(Yii::$app->user->identity['accountid'].'-'.$id,$CustomerOrder->vmid);
            //proxmox::qemuStart($CustomerOrder->node,$CustomerOrder->vmid);

            $userarray = proxmox::qemuCurrent(Yii::$app->user->identity['accountid'].'-'.$id);

            $article = new article();
            $productname= $article->getByIdArticle($CustomerOrder->productid);
            $productname = json_decode($productname,true);
            return $this->renderAjax('contract-vps', ['message' => 'der server wird gestartet','product' => $CustomerOrder,'productname' => $productname,'status'=>$userarray->data]);

        }

    }

    public function actionVmSuspend($id) {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->user->isGuest) {
                return  $this->redirect('/dashboard/login');
            }
            $CustomerOrder = CustomerOrder::find()->where(['id' => $id,'accountid'=>Yii::$app->user->identity['accountid']])->one();

            proxmox::qemuSuspend(Yii::$app->user->identity['accountid'].'-'.$id,$CustomerOrder->vmid);
            $userarray = proxmox::qemuCurrent($CustomerOrder->node,$CustomerOrder->vmid);

            $article = new article();
            $productname= $article->getByIdArticle($CustomerOrder->productid);
            $productname = json_decode($productname,true);
            return $this->renderAjax('contract-vps', ['message' => 'der server wird Pausiert','product' => $CustomerOrder,'productname' => $productname,'status'=>$userarray->data]);

        }

    }

    public function actionVmResume($id) {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->user->isGuest) {
                return  $this->redirect('/dashboard/login');
            }
            $CustomerOrder = CustomerOrder::find()->where(['id' => $id,'accountid'=>Yii::$app->user->identity['accountid']])->one();

            proxmox::qemuResume(Yii::$app->user->identity['accountid'].'-'.$id,$CustomerOrder->vmid);
            $userarray = proxmox::qemuCurrent($CustomerOrder->node,$CustomerOrder->vmid);

            $article = new article();
            $productname= $article->getByIdArticle($CustomerOrder->productid);
            $productname = json_decode($productname,true);
            return $this->renderAjax('contract-vps', ['message' => 'der server wird Pausiert','product' => $CustomerOrder,'productname' => $productname,'status'=>$userarray->data]);

        }

    }

    public function actionVmSnapshot($id) {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->user->isGuest) {
                return  $this->redirect('/dashboard/login');
            }
            $CustomerOrder = CustomerOrder::find()->where(['id' => $id,'accountid'=>Yii::$app->user->identity['accountid']])->one();



            proxmox::createQemuSnapshot(Yii::$app->user->identity['accountid'].'-'.$id,$CustomerOrder->vmid);

            $userarray = proxmox::qemuCurrent($CustomerOrder->node,$CustomerOrder->vmid);

            $article = new article();
            $productname= $article->getByIdArticle($CustomerOrder->productid);
            $productname = json_decode($productname,true);
            return $this->renderAjax('contract-vps', ['message' => 'Es wird ein Snapshot des servers erstellt','product' => $CustomerOrder,'productname' => $productname,'status'=>$userarray->data]);

        }

    }

    public function actionVmRollbacksnapshotlist($id) {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->user->isGuest) {
                return  $this->redirect('/dashboard/login');
            }
            $CustomerOrder = CustomerOrder::find()->where(['id' => $id,'accountid'=>Yii::$app->user->identity['accountid']])->one();

            $list = proxmox::qemuSnapshot(Yii::$app->user->identity['accountid'].'-'.$id,$CustomerOrder->vmid);
            $arrayFoo = (array) $list->data;
            $article = new article();
            $productname= $article->getByIdArticle($CustomerOrder->productid);
            $productname = json_decode($productname,true);
            return $this->renderAjax('snapshot-vps', ['product' => $CustomerOrder,'productname' => $productname,'list'=>$arrayFoo]);

        }

    }

    public function actionVmSnapshotRollback($id,$vmid,$name) {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->user->isGuest) {
                return  $this->redirect('/dashboard/login');
            }
            $CustomerOrder = CustomerOrder::find()->where(['id' => $id,'accountid'=>Yii::$app->user->identity['accountid']])->one();
            $list = proxmox::qemuSnapshot(Yii::$app->user->identity['accountid'].'-'.$id,$CustomerOrder->vmid);
            $arrayFoo = (array) $list->data;
            $article = new article();
            $userarray = proxmox::qemuCurrent($CustomerOrder->node,$CustomerOrder->vmid);
            $productname= $article->getByIdArticle($CustomerOrder->productid);
            $productname = json_decode($productname,true);

            proxmox::QemuSnapshotRollback(Yii::$app->user->identity['accountid'].'-'.$id,$CustomerOrder->vmid,$name);
            return $this->renderAjax('contract-vps', ['message' => 'Snapshot Rollback wird ausgeführt','product' => $CustomerOrder,'productname' => $productname,'status'=>$userarray->data]);

        }

    }

    public function actionVmDeleteSnapshot($id,$node,$vmid,$name) {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->user->isGuest) {
                return  $this->redirect('/dashboard/login');
            }
            $CustomerOrder = CustomerOrder::find()->where(['id' => $id,'accountid'=>Yii::$app->user->identity['accountid']])->one();

            $list = proxmox::qemuSnapshot(Yii::$app->user->identity['accountid'].'-'.$id,$CustomerOrder->vmid);
            $arrayFoo = (array) $list->data;
            $article = new article();
            $userarray = proxmox::qemuCurrent($CustomerOrder->node,$CustomerOrder->vmid);
            $productname= $article->getByIdArticle($CustomerOrder->productid);
            $productname = json_decode($productname,true);

            proxmox::deleteQemuSnapshot(Yii::$app->user->identity['accountid'].'-'.$id,$CustomerOrder->vmid,$name);
            return $this->renderAjax('contract-vps', ['message' => 'Snapshot wird gelöscht','product' => $CustomerOrder,'productname' => $productname,'status'=>$userarray->data]);

        }

    }

    public function actionAjaxPayment_old($resourcePath,$brand,$id)
    {
        $session = Yii::$app->session;
        $accountid =$session->get('accountid');
        if($brand =='SOFORTUEBERWEISUNG'){
            $responseData = payment::getSofortPayment($brand,$id);

        }elseif ($brand =='MASTER' || $brand =='VISA'){
            $responseData = payment::getCreditcardsPayment($brand,$id);
        }elseif ($brand =='PAYPAL'){
            $responseData = payment::getPayPalPayment($brand,$id);
        }

        $responseData= json_decode($responseData, true);
        $ResultCodes= $responseData['result']['code'];
        if(preg_match("/^(000\.000\.|000\.100\.1|000\.[36])/",$ResultCodes)|| preg_match("/^(000\.400\.0[^3]|000\.400\.100)/",$ResultCodes)){
            $tempArray = $session->get('ShoppingCart');
            $accountid =$session->get('accountid');
            $items = array();
            $customerorderId = array();
            $Account = Account::findIdentity($accountid);
            foreach ($tempArray as $value) {
                $MailTask = new MailTask();
                $CustomerOrder = new CustomerOrder();
                $CustomerOrder->productid = $value['id'];
                $CustomerOrder->accountid = $accountid;
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

                if(isset($value['option'])){
                    $CustomerOrder->addons= json_encode($value['option']);
                }

                $CustomerOrder->paycycle = $paycycle;
                $date = date("d.m.Y");
                $CustomerOrder->lastpaydate = $date;
                $CustomerOrder->lastpayid= $responseData['ndc'];
                $CustomerOrder->lastpaybrand = $responseData['paymentBrand'];
                $CustomerOrder->payidlog = $responseData['id'];
                $productname= $articlepaycycle['name'];
                if(preg_match("/Start/",$productname)) {
                    $CustomerOrder->active = 1;
                    $CustomerOrder->username =$Account->personal_email;
                }else{
                    $CustomerOrder->username = 'admin';

                }
                $CustomerOrder->initialpasswort = bin2hex(openssl_random_pseudo_bytes(6));
                $CustomerOrder->activate_hash = bin2hex(openssl_random_pseudo_bytes(80));
                $session->set('pay', true);

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
                array_push( $customerorderId, $CustomerOrder->id);
            }
            $invoice = new salesInvoice();
            $Invoicelog = new Invoice();
            $invoicearray = $invoice->createInvoice($accountid,$items);
            $invoicearray1 = json_decode($invoicearray,true);
                if(isset($invoicearray1['salesInvoiceItems'])) {
                    $Invoicelog->salesInvoiceid = $invoicearray1['id'];
                }
                if(isset($invoicearray1['salesInvoiceItems'])) {
                    $Invoicelog->customerNumber = $invoicearray1['customerNumber'];
                }
                if(isset($invoicearray1['salesInvoiceItems'])) {
                    $Invoicelog->invoiceNumber = $invoicearray1['invoiceNumber'];
                }
                if(isset($invoicearray1['salesInvoiceItems'])){
                    $Invoicelog->salesInvoiceItems =  json_encode($invoicearray1['salesInvoiceItems']);
                }

                if($Invoicelog->validate()){
                    if ($Invoicelog->save()) {
                        $session->set('ShoppingCart',null);
                    }
                }

            if ($brand =='MASTER' || $brand =='VISA'){
                $RecurringPayment = new \app\models\Payment\RecurringPayment();
                $RecurringPayment->recurringId =$responseData['registrationId'];
                $RecurringPayment->recurringentityId =$responseData['registrationId'];
                $RecurringPayment->accountid =$accountid;
                $RecurringPayment->cart =json_encode($tempArray);
                $RecurringPayment->customerorderId =json_encode($customerorderId);
                $RecurringPayment->recurringType =$brand;
                if($RecurringPayment->validate()){
                    $RecurringPayment->save();
                    $session->set('ShoppingCart',null);
                }

            }
            return  $this->redirect('/checkout/successful');
        }elseif (
            preg_match("/^(000\.400\.[1][0-9][1-9]|000\.400\.2)/",$ResultCodes)||
            preg_match("/^(800\.[17]00|800\.800\.[123])/",$ResultCodes) ||
            preg_match("/^(900\.[1234]00|000\.400\.030)/",$ResultCodes) ||
            preg_match("/^(800\.[56]|999\.|600\.1|800\.800\.[84])/",$ResultCodes)
        )
        {
            return  $this->redirect('/checkout/notsuccessful');
        }elseif (preg_match("/^(000\.100\.2)/",$ResultCodes) || preg_match("/^(000\.100\.2)/",$ResultCodes)) {
            return  $this->redirect('/checkout/notsuccessful');
        }
        elseif (preg_match("/^(100\.39[765])/",$ResultCodes)) {
            return  $this->redirect('/checkout/notsuccessful');
        }

    }

    public function actionAjaxPayment($resourcePath,$brand,$id)
    {
        $session = Yii::$app->session;
        $accountid =$session->get('accountid');
        if($brand =='SOFORTUEBERWEISUNG'){
            $responseData = payment::getSofortPayment($brand,$id);

        }elseif ($brand =='MASTER' || $brand =='VISA'){
            $responseData = payment::getCreditcardsPayment($brand,$id);
        }elseif ($brand =='PAYPAL'){
            $responseData = payment::getPayPalPayment($brand,$id);
        }

        $responseData= json_decode($responseData, true);
        $ResultCodes= $responseData['result']['code'];
        if(preg_match("/^(000\.000\.|000\.100\.1|000\.[36])/",$ResultCodes)|| preg_match("/^(000\.400\.0[^3]|000\.400\.100)/",$ResultCodes)){
            $tempArray = $session->get('ShoppingCart');
            $accountid =$session->get('accountid');
            $items = array();
            $customerorderId = array();
            $Account = Account::findIdentity($accountid);
            foreach ($tempArray as $value) {
                if($value['slug'] == 'vps'){
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

                $MailTask = new MailTask();
                $CustomerOrder = new CustomerOrder();
                $CustomerOrder->productid = $value['id'];
                $CustomerOrder->accountid = $accountid;
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

                if(isset($value['option'])){
                    $CustomerOrder->addons= json_encode($value['option']);
                }

                $CustomerOrder->paycycle = $paycycle;
                $date = date("d.m.Y");
                $CustomerOrder->lastpaydate = $date;
                $CustomerOrder->lastpayid= $responseData['ndc'];
                $CustomerOrder->lastpaybrand = $responseData['paymentBrand'];
                $CustomerOrder->payidlog = $responseData['id'];
                $productname= $articlepaycycle['name'];
                if(preg_match("/Start/",$productname)) {
                    $CustomerOrder->active = 1;
                    $CustomerOrder->username =$Account->personal_email;
                }else{
                    $CustomerOrder->username = 'admin';

                }
                $CustomerOrder->initialpasswort = bin2hex(openssl_random_pseudo_bytes(6));
                $CustomerOrder->activate_hash = bin2hex(openssl_random_pseudo_bytes(80));
                $session->set('pay', true);

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
                array_push( $customerorderId, $CustomerOrder->id);
            }
            }

            \app\extensions\greendev\SalesInvoiceTask\SalesInvoiceTask::setSalesInvoiceTask($accountid,$items);

            if ($brand =='MASTER' || $brand =='VISA'){
                $RecurringPayment = new \app\models\Payment\RecurringPayment();
                $RecurringPayment->recurringId =$responseData['registrationId'];
                $RecurringPayment->recurringentityId =$responseData['registrationId'];
                $RecurringPayment->accountid =$accountid;
                $RecurringPayment->cart =json_encode($tempArray);
                $RecurringPayment->customerorderId =json_encode($customerorderId);
                $RecurringPayment->recurringType =$brand;
                if($RecurringPayment->validate()){
                    $RecurringPayment->save();
                    $session->set('ShoppingCart',null);
                }

            }
            return  $this->redirect('/checkout/successful');
        }elseif (
            preg_match("/^(000\.400\.[1][0-9][1-9]|000\.400\.2)/",$ResultCodes)||
            preg_match("/^(800\.[17]00|800\.800\.[123])/",$ResultCodes) ||
            preg_match("/^(900\.[1234]00|000\.400\.030)/",$ResultCodes) ||
            preg_match("/^(800\.[56]|999\.|600\.1|800\.800\.[84])/",$ResultCodes)
        )
        {
            return  $this->redirect('/checkout/notsuccessful');
        }elseif (preg_match("/^(000\.100\.2)/",$ResultCodes) || preg_match("/^(000\.100\.2)/",$ResultCodes)) {
            return  $this->redirect('/checkout/notsuccessful');
        }
        elseif (preg_match("/^(100\.39[765])/",$ResultCodes)) {
            return  $this->redirect('/checkout/notsuccessful');
        }

    }

    public function actionAjaxDevelopmentPayment($data,$resourcePath)
    {
        $mandatdata=json_decode(\app\extensions\greendev\vrpayment\payment::base64url_decode($data),true);


        if($mandatdata['brand'] =='SOFORTUEBERWEISUNG'){
            $responseData = payment::getSofortDashboardPayment($mandatdata['brand'],$resourcePath);

        }elseif ($mandatdata['brand'] =='MASTER' || $mandatdata['brand'] =='VISA'){
            $responseData = payment::getCreditcardsDashboardPayment($mandatdata['brand'],$resourcePath);
        }elseif ($mandatdata['brand'] =='PAYPAL'){
            $responseData = payment::getPayPalDashboardPayment($mandatdata,$resourcePath);
        }
        $responseData= json_decode($responseData, true);
        if(preg_match("/^(000\.000\.|000\.100\.1|000\.[36])/",$responseData['result']['code'])|| preg_match("/^(000\.400\.0[^3]|000\.400\.100)/",$responseData['result']['code'])) {
            $Invoicelog = new Invoice();

            $info = salesInvoice::getInvoicePDFName($mandatdata['invoiceid']);
            $priceinvoice = json_decode($info,true);
            $Invoicelog->salesInvoiceid = $priceinvoice['id'];
            $Invoicelog->customerNumber = $priceinvoice['customerNumber'];
            $Invoicelog->invoiceNumber = $priceinvoice['invoiceNumber'];

            $Invoicelog->salesInvoiceItems = json_encode($priceinvoice['salesInvoiceItems']);
            if ($Invoicelog->save()) {
                $this->layout = false;
                return $this->render('user/thanks');

            }else{
                echo '<pre>';
                print_r($Invoicelog->errors);
                die();
            }
        }

    }

}
