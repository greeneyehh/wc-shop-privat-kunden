<?php

namespace app\controllers;
use app\extensions\greendev\weclapp\article;
use app\extensions\greendev\weclapp\helpdesk;
use app\models\config\vrpayconfig;
use app\models\shop\CustomerPreOrder;
use PhpParser\Node\Stmt\Echo_;
use Yii;
use app\models\Account;
use app\models\dashboard\KundenloginForm;
use app\models\shop\Invoice;
use app\models\cms\Country;
use app\models\shop\PaymentPostModel;
use app\models\Payment\PaymentResultCodes;
use app\models\shop\CustomerOrder;
use app\models\mailtasker\MailTask;
use app\models\config\vrpaybrandsconfig;
use app\extensions\greendev\weclapp\customer;
use app\extensions\greendev\weclapp\salesInvoice;
use app\extensions\greendev\nextcloud\user;
use app\extensions\greendev\vrpayment\payment;
use app\components\RocketChatComponen;

class CheckoutController extends \yii\web\Controller
{


    public function actionIndex()
    {
        return  $this->redirect('/cart');
    }

	public function actionConfirm()
    {
    	$session = Yii::$app->session;
		$ShoppingCart = $session->get('ShoppingCart');
		if (!Yii::$app->user->isGuest) {
			$session = Yii::$app->session;
			$session->set('accountid',Yii::$app->user->identity->accountid);

			return  $this->redirect('summary');
	  	}
		if (!$ShoppingCart) {
			return $this->redirect('/cart');
		}
    	$model = new Account();
		$tempArray = Country::find()->all();
		$laender = array();
		foreach ($tempArray as $row) {
			$laender[$row['code']] = $row['name'];
		}
    	$kundenloginmodel = new KundenloginForm();
		if($model->load(Yii::$app->request->post())) {
            $customer = new customer();
            $Accountvalidate = Account::findByUsername($model->personal_email);
            if($model->validate() && !isset($Accountvalidate)){
                $passwd=$model->personal_password;
                $model->personal_password = \Yii::$app->params['pwfrontsalt'].md5($model->personal_password).\Yii::$app->params['pwbacksalt'];
                $model->personal_passwordConfirmation = \Yii::$app->params['pwfrontsalt'].md5($model->personal_passwordConfirmation).\Yii::$app->params['pwbacksalt'];
                $model->authKey = Yii::$app->getSecurity()->generateRandomString(120);
                $model->accessToken = Yii::$app->getSecurity()->generateRandomString(120);
                $model->remote_addr = Yii::$app->getRequest()->getUserIP();
                    if($model->save())
                    {
                        $kundenloginmodel->personal_email=$model->personal_email;
                        $kundenloginmodel->personal_password=$passwd;
                        $kundenloginmodel->login();
                        $session->set('accountid',$model->id);
                        $customer->setCustomer($model);
                        $shipping_salutation = array('MR' => 'Herr', 'MRS' => 'Frau');
                        $datamail = ['firstname'=> $model->personal_firstname ,'lastname' => $model->personal_lastname,'gender' => $shipping_salutation[$model->personal_salutation]];
                        \app\extensions\greendev\mailtask\MailTask::setMailTaskCustomer(strtolower($model->personal_email),'createaccount','Zugang zum Kundenportal von Windcloud 4.0 GmbH',$datamail);
                       // $identity=new UserIdentity($model->personal_email,$passwd);
                       // $identity->authenticate();
                        return $this->redirect('/checkout/summary');
                    }else{
                        var_dump($model->errors);
                        var_dump($Accountvalidate);
                    }
            }else{
                if(isset($Accountvalidate)){
                    return $this->render('confirm',['model' => $model,'laender'=>$laender ,'kundenloginmodel'=>$kundenloginmodel]);
                }
                    print_r($model->errors);
            }
        }
        return $this->render('confirm',['model' => $model,'laender'=>$laender ,'kundenloginmodel'=>$kundenloginmodel]);
    }

    public function actionSummary()
    {
        $session = Yii::$app->session;
        $tempArray = Country::find()->all();
        $laender = array();
        foreach ($tempArray as $row) {
            $laender[$row['code']] = $row['name'];
        }
        $shipping_salutation = array('MR' => 'Herr', 'MRS' => 'Frau');
        $personal_customer_type = array('PERSON' => 'Privatkunde', 'ORGANIZATION' => 'Firma');
        $tempArray = $session->get('ShoppingCart');
        $model = new Account();
        $ShoppingCart = $session->get('ShoppingCart');
        if (!$ShoppingCart) {
            return $this->redirect('/cart');
        }
        $accountid =$session->get('accountid');
        $PaymentPostModel = new PaymentPostModel();
        $weclappaccount =customer::getByIdCustomer($accountid);
        $account = Account::find()->where(['accountid' => $accountid])->one();
        $vrpaybrands = vrpaybrandsconfig::find()->where(['status' => 1])->all();
        $paybrands = array();
        foreach ($vrpaybrands as $row) {
            $paybrands[$row['name']] = '<img src="/image/payment-icons/'.$row['image'].'" size="20px" style="width: 120px;">';
        }
        if ($PaymentPostModel->load(Yii::$app->request->post())) {
            foreach ($tempArray as $value) {
                $article = new article();
                $articlepaycycle= $article->getByIdArticle($value['id']);
                $articlepaycycle = json_decode($articlepaycycle,true);

                $CustomerPreOrder = new CustomerPreOrder();
                $CustomerPreOrder->sessionid = Yii::$app->session->getId();
                $CustomerPreOrder->productid = $value['id'];
                $CustomerPreOrder->accountid = $session->get('accountid');
                if(preg_match("/Start/",$articlepaycycle['name'])) {
                    $CustomerPreOrder->domain = 'https://'.\Yii::$app->params['NEXTCLOUD_API_HOSTNAME'];
                }else{
                    if($value['domainextension'] == '' OR $value['domainextension'] == null){
                        $CustomerPreOrder->domain = 'https://'.$value['domainextension'];
                    }else{
                        $CustomerPreOrder->domain = 'https://'.$value['domainextension'];
                    }
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
                if(isset($value['option'])) {
                    $CustomerPreOrder->addons = json_encode($value['option']);
                }
                $CustomerPreOrder->paycycle = $paycycle;
                if($CustomerPreOrder->validate()){
                    $CustomerPreOrder->save();
                }
            }


            switch ($PaymentPostModel->brand) {
                case 'DIRECTDEBIT_SEPA':
                    $model = new \app\models\form\SepaForm();
                    return $this->render('brands/DIRECTDEBIT_SEPA',['model'=>$model]);
                case 'SOFORTUEBERWEISUNG':
                    $model = \app\extensions\greendev\vrpayment\payment::getCheckoutSofortRegistration();
                    $model = json_decode($model, true);

                    if(isset($model['redirect']['url'])){
                        return $this->redirect($model['redirect']['url']);
                    }else{
                        return $this->render('noresult');
                    }

                case 'PAYPAL':
                    $model = \app\extensions\greendev\vrpayment\payment::getCheckoutPayPalRegistration();
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
                        return $this->render('noresult');
                    }

                case 'VISA':
                    $model = \app\extensions\greendev\vrpayment\payment::getCheckoutCreditcardsRegistration('VISA');
                    $vrpayconfig = \app\models\config\vrpayconfig::find()->asArray()->all();
                    $keyReturnUrl = array_search('ReturnUrl', array_column($vrpayconfig, 'name'));
                    $keyUrl = array_search('Url', array_column($vrpayconfig, 'name'));
                    $model = json_decode($model, true);
                    return $this->render('brands/VISA',['model'=>$model,'brand'=>'VISA','Url'=>$vrpayconfig[$keyUrl]['variable'],'ReturnUrl'=>$vrpayconfig[$keyReturnUrl]['variable']]);
                case 'MASTER':
                    $model = \app\extensions\greendev\vrpayment\payment::getCheckoutCreditcardsRegistration('MASTER');
                    $vrpayconfig = \app\models\config\vrpayconfig::find()->asArray()->all();
                    $keyReturnUrl = array_search('ReturnUrl', array_column($vrpayconfig, 'name'));
                    $keyUrl = array_search('Url', array_column($vrpayconfig, 'name'));
                    $model = json_decode($model, true);
                    return $this->render('brands/MASTER',['model'=>$model,'brand'=>'MASTER','Url'=>$vrpayconfig[$keyUrl]['variable'],'ReturnUrl'=>$vrpayconfig[$keyReturnUrl]['variable']]);

                case 'PAYPALSDK':
                    $AccessToken=\app\extensions\greendev\PaypalApi\PayPal::getAccessToken();
                    $Checkout=\app\extensions\greendev\PaypalApi\PayPal::getCheckout($AccessToken,$ShoppingCart);

                    return $this->redirect($Checkout);
                case 'SOFORTUEBERWEISUNGSDK':
                    $Checkout=\app\extensions\greendev\SofortueberweisungApi\sofort::getCheckout($ShoppingCart);
                    return $this->redirect($Checkout);
            }
        }


        return $this->render('summary',['account'=>$account,
            'laender'=>$laender,
            'shipping_salutation'=>$shipping_salutation,
            'personal_customer_type'=>$personal_customer_type,
            'cart' => $tempArray,
            'PaymentPostModel' => $PaymentPostModel,
            'vrpaybrands' => $paybrands]);
    }

	public function actionPayselect()
	{
        $PaymentPostModel = new PaymentPostModel();
        if($PaymentPostModel->load(Yii::$app->request->post())) {
            $session = Yii::$app->session;
            $tempArray = $session->get('ShoppingCart');
            foreach ($tempArray as $value) {
                $CustomerPreOrder = new CustomerPreOrder();
                $CustomerPreOrder->sessionid = Yii::$app->session->getId();
                $CustomerPreOrder->productid = $value['id'];
                $CustomerPreOrder->accountid = $session->get('accountid');
                $article = new article();
                $articlepaycycle= $article->getByIdArticle($value['id']);
                $articlepaycycle = json_decode($articlepaycycle,true);

                if(preg_match("/Start/",$articlepaycycle['name'])) {
                    $CustomerPreOrder->domain = 'https://'.\Yii::$app->params['NEXTCLOUD_API_HOSTNAME'];
                }else{
                    if($value['domainextension'] == '' OR $value['domainextension'] == null){
                        $CustomerPreOrder->domain = 'https://'.$value['domainextension'];
                    }else{
                        $CustomerPreOrder->domain = 'https://'.$value['domainextension'];
                    }
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
                if(isset($value['option'])) {
                    $CustomerPreOrder->addons = json_encode($value['option']);
                }
                $CustomerPreOrder->paycycle = $paycycle;
                if($CustomerPreOrder->validate()){
                    $CustomerPreOrder->save();
                } else {
                    // validation failed: $errors is an array containing error messages
                    $errors = $CustomerPreOrder->errors;
                    print_r($errors);
                    die();
                }
            }
            $vrpaybrands = vrpaybrandsconfig::find()->where(['status' => 1])->all();;

            return $this->render('payselect',['PaymentPostModel' => $PaymentPostModel,'vrpaybrands'=>$vrpaybrands]);
        }
        else{
            return  $this->redirect('/checkout/summary');
        }
	}

    public function actionPayment($entityId,$brand)
    {
        $responseData = payment::getRegistration($entityId);
        $responseData = json_decode($responseData, true);
        $vrpaybrands = vrpaybrandsconfig::find()->where(['entityId'=>$entityId,'status' => 1])->one();
        $vrpayconfig = vrpayconfig::find()->asArray()->all();
        $keyReturnUrl = array_search('ReturnUrl', array_column($vrpayconfig, 'name'));
        $keyUrl = array_search('Url', array_column($vrpayconfig, 'name'));
        $values = Yii::$app->params;
        return $this->render('test',['values' =>$values,'responseData' => $responseData,'entityId'=>$entityId,'brand'=>$brand,'vrpaybrands'=>$vrpaybrands,'Url'=>$vrpayconfig[$keyUrl]['variable'],'ReturnUrl'=>$vrpayconfig[$keyReturnUrl]['variable']]);
    }


    public function actionTransactionCheck ($brand,$id,$resourcePath)
    {

        return $this->render('waiting');

    }
    public function actionThanks($brand=null,$id,$resourcePath)
    {

        return $this->render('waiting');

    }

    public function actionNotsuccessful()
    {
        return $this->render('notsuccessful');
    }


    public function actionSuccessful()
    {
        return $this->render('successful');
    }
	public function actionLogin()
    {
        $kundenloginmodel = new KundenloginForm();
        $model = new Account();
        $tempArray = Country::find()->all();
        $laender = array();
        foreach ($tempArray as $row) {
            $laender[$row['code']] = $row['name'];
        }
		$session = Yii::$app->session;
	    if ($kundenloginmodel->load(Yii::$app->request->post()) && $kundenloginmodel->login()) {
			$session->set('accountid',Yii::$app->user->identity->accountid);
			$accountid =$session->get('accountid');
			$account = Account::find()->where(['accountid' => $accountid])->one();
			$account->remote_addr =Yii::$app->getRequest()->getUserIP();
			$account->save();
            return $this->redirect('summary');
	    }
        return $this->render('confirm',['model' => $model,'laender'=>$laender ,'kundenloginmodel'=>$kundenloginmodel]);

	}

	public function actionAjaxVoucher(){

		return $this->redirect('summary');
	}
}
