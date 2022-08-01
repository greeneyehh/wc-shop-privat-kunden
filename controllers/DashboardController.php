<?php
namespace app\controllers;
use app\commands\MailJob;
use app\commands\NextCloudJob;
use app\extensions\greendev\nextcloud\user;
use app\extensions\greendev\vrpayment\payment;
use app\extensions\greendev\weclapp\articleCategory;
use app\extensions\greendev\weclapp\variantArticle;
use app\models\AccountPass;
use app\models\cms\Country;
use app\models\config\vrpaybrandsconfig;
use app\models\logserver\vrpaymentlog;
use app\models\logserver\weclapplog;
use app\models\logserver\nextcloudlog;
use app\models\product\ProductType;
use app\models\shop\Invoice;
use app\models\shop\CustomerOrder;
use app\models\shop\CustomerPreOrder;
use app\models\shop\PaymentPostModel;
use app\models\VPSTask\VPSIPS;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\dashboard\KundenloginForm;
use app\models\dashboard\ForgotPasswordForm;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use app\models\supporttools\NewsletterCreateForm;
use app\models\ShopProduct;
use app\models\ShopProductForm;
use app\models\Account;
use app\models\AccountInport;
use app\models\form\CustomerOrderForm;
use app\models\form\VpsSetup;
use app\extensions\greendev\weclapp\article;
use app\extensions\greendev\weclapp\customer;
use app\models\config\vrpayconfig;
use app\models\dashboard\RechnungKategorieForm;
use app\models\dashboard\user\ChangePasswordForm;
use app\models\dashboard\user\kontaktForm;
use app\models\dashboard\user\KontodeleteForm;
use app\models\dashboard\user\StamdatenForm;
use app\models\dashboard\user\Stammdatenbilling_shippingAddressDB;
use app\models\dashboard\user\StamdatenBankForm;
use app\models\dashboard\kontakt\KontaktAutoComplete;
use app\extensions\greendev\weclapp\helpdesk;
use app\extensions\greendev\weclapp\salesInvoice;
use app\models\seo\Seomanager;
use \setasign\Fpdi\Fpdi;
use app\models\cms\CmsNews;

class DashboardController extends Controller
{
	public function beforeAction($action)
	{
	    $this->layout = 'dashboard';
	    return parent::beforeAction($action);
	}

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
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


	public function actionIndex()
    {
		if (Yii::$app->user->isGuest) {
			return  $this->redirect('/dashboard/login');
        }
        $article = new article();
        $customer = new customer();
        return $this->render('user/home', [
            'article' => $article,
            'customer' => $customer,
        ]);
	}

	public function actionTimeline()
    {
		if (Yii::$app->user->isGuest) {
			return  $this->redirect('/dashboard/login');
        }
        $article = new article();
        $customer = new customer();
        return $this->render('user/timeline', [
            'article' => $article,
            'customer' => $customer,
        ]);
	}

	public function actionLogin()
    {
		$this->layout = 'login';
		$model = new KundenloginForm();
        $ForgotPasswordForm = new ForgotPasswordForm();
			if (!Yii::$app->user->isGuest) {
				return  $this->redirect('/dashboard');
	        }
	        if ($model->load(Yii::$app->request->post()) && $model->login()) {

	            return  $this->redirect('/dashboard');
	        }
	 		$model->personal_password = '';
			return $this->render('login', [
	            'model' => $model,'ForgotPassword' => $ForgotPasswordForm
	        ]);
	}

    public function actionRegister()
    {
        $this->layout = 'login';
        $session = Yii::$app->session;
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

                    return $this->redirect('/dashboard/login');
                }else{
                    var_dump($model->errors);
                    var_dump($Accountvalidate);
                }
            }else{
                if(isset($Accountvalidate)){
                    return $this->render('user/reg',['model' => $model,'laender'=>$laender ,'kundenloginmodel'=>$kundenloginmodel]);
                }
                print_r($model->errors);
            }
        }
        return $this->render('user/reg',['model' => $model,'laender'=>$laender ,'kundenloginmodel'=>$kundenloginmodel]);
    }

	public function actionForgotpassword($token,$mail)
	{
        $this->layout = 'login';
        $ChangePassword = new ChangePasswordForm();
        $user = AccountPass::findByUsername(strtolower($mail));
            if($ChangePassword->load(Yii::$app->request->post())) {
                if($ChangePassword->personal_password == $ChangePassword->personal_passwordConfirmation){
                    if($user->accessToken == $token) {
                        $user->personal_password = \Yii::$app->params['pwfrontsalt'] . md5($ChangePassword->personal_password) . \Yii::$app->params['pwbacksalt'];
                        $user->personal_passwordConfirmation = \Yii::$app->params['pwfrontsalt'] . md5($ChangePassword->personal_passwordConfirmation) . \Yii::$app->params['pwbacksalt'];
                        $user->accessToken ='';
                        $user->save();
                        return  $this->redirect('/dashboard/login');
                    }else{
                        Yii::$app->session->setFlash('message', "Passwords don't match!");
                        $ChangePassword->addError('*' ,"Dein Sicherheitstoken ist abgelaufen");
                        return $this->render('user/forgotpassword', [
                            'token' => $token,'mail' =>$mail,'ChangePassword'=>$ChangePassword
                        ]);
                    }
                }


            }
        $timestamp =  date('d.m.Y H:i:s');
        if($user->forgotpasswordtime > $timestamp){
        if($user->accessToken == $token) {
        return $this->render('user/forgotpassword', [
            'token' => $token,'mail' =>$mail,'ChangePassword'=>$ChangePassword
        ]);
        }else{
            $ChangePassword->addError('*' ,"Dein Sicherheitstoken ist abgelaufen");
            return $this->render('user/forgotpassword', [
                'token' => $token,'mail' =>$mail,'ChangePassword'=>$ChangePassword
            ]);
        }
        }else{

            $ChangePassword->addError('*' ,"Dein Sicherheitstoken ist abgelaufen");
            return $this->render('user/forgotpassword', [
                'token' => $token,'mail' =>$mail,'ChangePassword'=>$ChangePassword
            ]);


        }
	}

	public function actionKontodelete($token,$mail)
	{
        $this->layout = 'login';
        $user = Account::findByUsername(strtolower($mail));
        $timestamp =  date('d.m.Y H:i:s');



        if($user->deletetime > $timestamp){

        if($user->deleteToken == $token) {

        return $this->render('user/kontodelete', [
            'token' => $token,'mail' =>$mail ,'user' => $user
        ]);
        }
        }
	}

	public function actionProdukte()
	{
		if (Yii::$app->user->isGuest) {
			return  $this->redirect('/dashboard/login');
        }
		if(Yii::$app->user->identity->right >= 0)
		{
            $model = new RechnungKategorieForm();
            $AllCategory = new articleCategory();
            $Category =$AllCategory->getAllCategory();
            $ar=[];
            foreach ($Category['result'] as $Categoryname){
                if(isset($Categoryname['description'])){
                    $ar[$Categoryname['description']] = $Categoryname['description'];
                }else{
                    $ar["Virtuelle Private Server"]="Virtuelle Private Server";
                }

            }

			return $this->render('user/produkte', [
            'Category' => $ar,'model' =>$model
        ]);
		}
		else {
			return  $this->redirect('/dashboard');
		}
	}
    public function actionKundenproductsvps()
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 4)
        {

            return $this->render('/dashboard/admin/Kundenproductsvps');
        }
        else {
            return  $this->redirect('/dashboard');
        }
    }

    public function actionVps($id)
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 0)
        {
            if (Yii::$app->user->isGuest) {
                return  $this->redirect('/dashboard/login');
            }
            $message=null;
            $CustomerOrder = new CustomerOrder();
            $product = $CustomerOrder::find()->where(['accountid' => Yii::$app->user->identity->accountid,'id' => $id])->one();
            $VpsControl = new \app\models\dashboard\VpsControlModel();
            if($VpsControl->load(Yii::$app->request->post())) {

                if($VpsControl->value == "start"){
                    \app\extensions\greendev\proxmox\proxmox::qemuStart(Yii::$app->user->identity['accountid'].'-'.$id,$product->vmid);
                }
                if($VpsControl->value == "stop"){
                    \app\extensions\greendev\proxmox\proxmox::qemuStop(Yii::$app->user->identity['accountid'].'-'.$id,$product->vmid);
                }
                if($VpsControl->value == "shutdown"){

                    \app\extensions\greendev\proxmox\proxmox::qemuShutdown(Yii::$app->user->identity['accountid'].'-'.$id,$product->vmid);
                }
                if($VpsControl->value == "reboot"){

                    \app\extensions\greendev\proxmox\proxmox::qemuReboot(Yii::$app->user->identity['accountid'].'-'.$id,$product->vmid);
                }
                if($VpsControl->value == "resume"){
                    \app\extensions\greendev\proxmox\proxmox::qemuResume(Yii::$app->user->identity['accountid'].'-'.$id,$product->vmid);
                }
                if($VpsControl->value == "suspend"){
                    \app\extensions\greendev\proxmox\proxmox::qemuSuspend(Yii::$app->user->identity['accountid'].'-'.$id,$product->vmid);
                }
                if($VpsControl->value == "snapshot"){
                    \app\extensions\greendev\proxmox\proxmox::createQemuSnapshot(Yii::$app->user->identity['accountid'].'-'.$id,$product->vmid);
                }
                if($VpsControl->value == "rollbacksnapshotlist"){
                    $list = \app\extensions\greendev\proxmox\proxmox::qemuSnapshot(Yii::$app->user->identity['accountid'].'-'.$id,$product->vmid);
                    $arrayFoo = (array) $list->data;
                    $article = new article();
                    $productname= $article->getByIdArticle($product->productid);
                    $productname = json_decode($productname,true);
                    return $this->render('user/snapshot-vps', ['product' => $product,'productname' => $productname,'list'=>$arrayFoo,'VpsControl'=>$VpsControl]);
                }
                if($VpsControl->value == "snapshotrollback"){
                    $list = \app\extensions\greendev\proxmox\proxmox::qemuSnapshot(Yii::$app->user->identity['accountid'].'-'.$id,$product->vmid);
                    $arrayFoo = (array) $list->data;
                    $article = new article();
                    $productname= $article->getByIdArticle($product->productid);
                    \app\extensions\greendev\proxmox\proxmox::QemuSnapshotRollback(Yii::$app->user->identity['accountid'].'-'.$id,$product->vmid,$VpsControl->snapshotname);
                }
                if($VpsControl->value == "snapshotdelete"){
                    $list = \app\extensions\greendev\proxmox\proxmox::qemuSnapshot(Yii::$app->user->identity['accountid'].'-'.$id,$product->vmid);
                    $arrayFoo = (array) $list->data;
                    $article = new article();
                    $productname= $article->getByIdArticle($CustomerOrder->productid);
                    \app\extensions\greendev\proxmox\proxmox::deleteQemuSnapshot(Yii::$app->user->identity['accountid'].'-'.$id,$product->vmid,$VpsControl->snapshotname);
                }
            }
            $ProductType = new ProductType();
            $producttype = $ProductType::find()->where(['productid' => $product->productid])->one();

            $userarray = \app\extensions\greendev\proxmox\proxmox::qemuCurrent(Yii::$app->user->identity->accountid.'-'.$id);
            if($product->active != 0 ){
                $os=\app\extensions\greendev\proxmox\proxmox::qemuGetOsInfo(Yii::$app->user->identity->accountid.'-'.$id);
                $os = json_decode(json_encode($os), true);
                $ip = VPSIPS::find()->where(['status' => 1,'vmid'=>$product->vmid,'accountid'=>Yii::$app->user->identity->accountid])->one();
                $ip = $ip->ip;
            }else{
                $os="";
                $ip ="";
            }
                $article = new article();
                $productname= $article->getByIdArticle($product->productid);
                $productname = json_decode($productname,true);
                $customervps= \app\models\customeroder\customervps::find()->where(['accountid' => Yii::$app->user->identity->accountid,'vmid'=>$product->vmid,'customeroderid'=>$id])->one();
                $VpsSetup= new VpsSetup();
                if($VpsSetup->load(Yii::$app->request->post())) {

                    if(preg_match("/Windows/",$productname['articleNumber'])){
                        $test2 =\app\extensions\greendev\proxmox\proxmox::setuserpassword(Yii::$app->user->identity['accountid'].'-'.$id,$product->vmid, "Administrator",$VpsSetup->passwort);
                        $exec ='reg add HKEY_LOCAL_MACHINE\SYSTEM\CurrentControlSet\Services\NetBT\Parameters\Interfaces\Tcpip_{84a795f4-e26c-4178-9103-6b416b3079c6} /v NetbiosOptions /t REG_DWORD /d 2 /f';
                        \app\extensions\greendev\proxmox\proxmox::qemuAgentExec(Yii::$app->user->identity['accountid'].'-'.$id,$product->vmid,$exec);

                        $hostname ='hostname';
                        $hostnameexec = \app\extensions\greendev\proxmox\proxmox::qemuAgentExec(Yii::$app->user->identity['accountid'].'-'.$id,$product->vmid,$hostname);
                        $hostnameStatus = \app\extensions\greendev\proxmox\proxmox::qemuAgentStatus(Yii::$app->user->identity['accountid'].'-'.$id,$product->vmid,$hostnameexec->data->pid);
                        $hostnameold =trim ( $hostnameStatus['out-data'] , " \n\r\t\v\0" );
                        $hostnamenew =Yii::$app->user->identity['accountid'].'-'.$id;
                        $hostnamechange ="WMIC computersystem where caption='$hostnameold' rename '$hostnamenew'";
                        $hostnameexec = \app\extensions\greendev\proxmox\proxmox::qemuAgentExec(Yii::$app->user->identity['accountid'].'-'.$id,$product->vmid,$hostnamechange);
                        $exec0 ='netsh interface ipv4 set address name="Ethernet" static '.$ip.' 255.255.255.0 128.0.64.253';
                        \app\extensions\greendev\proxmox\proxmox::qemuAgentExec(Yii::$app->user->identity['accountid'].'-'.$id,$product->vmid,$exec0);
                        $exec2 ='netsh interface ip set dns name="Ethernet" static 91.218.23.243';
                        \app\extensions\greendev\proxmox\proxmox::qemuAgentExec(Yii::$app->user->identity['accountid'].'-'.$id,$product->vmid,$exec2);
                        $exec3 ='netsh interface ip add dns name="Ethernet" 91.218.23.242 index=2';
                        \app\extensions\greendev\proxmox\proxmox::qemuAgentExec(Yii::$app->user->identity['accountid'].'-'.$id,$product->vmid,$exec3);
                        \app\extensions\greendev\proxmox\proxmox::qemuReboot(Yii::$app->user->identity['accountid'].'-'.$id,$product->vmid);
                    }else{

                        \app\extensions\greendev\proxmox\proxmox::setuserpassword(Yii::$app->user->identity['accountid'].'-'.$id,$product->vmid, "root",$VpsSetup->passwort);
                        $exec ="/etc/windcloud/./createStaticConnection.sh ".$ip." 128.0.64.253 91.218.23.243";
                        \app\extensions\greendev\proxmox\proxmox::qemuAgentExec(Yii::$app->user->identity['accountid'].'-'.$id,$product->vmid,$exec);
                        $exec ="sudo hostnamectl set-hostname ".Yii::$app->user->identity['accountid'].'-'.$id;
                        \app\extensions\greendev\proxmox\proxmox::qemuAgentExec(Yii::$app->user->identity['accountid'].'-'.$id,$product->vmid,$exec);

                    }
                    if($VpsSetup->sshkey){
                        $exec ="mkdir /root/.ssh";
                        \app\extensions\greendev\proxmox\proxmox::qemuAgentExec(Yii::$app->user->identity['accountid'].'-'.$id,$product->vmid,$exec);
                        \app\extensions\greendev\proxmox\proxmox::qemuAgentFileWrite(Yii::$app->user->identity['accountid'].'-'.$id,$product->vmid,$VpsSetup->sshkey,"/root/.ssh/authorized_keys");
                        \app\extensions\greendev\proxmox\proxmox::qemuAgentExec(Yii::$app->user->identity['accountid'].'-'.$id,$product->vmid,"chmod 600 /root/.ssh/authorized_keys");
                    }
                    if(preg_match("/Cloudron/",$productname['articleNumber'])){
                        $cloudronsetup = file_get_contents('https://cloudron.io/cloudron-setup');
			//$cloudronsetup = file_get_contents(\Yii::$app->basePath.'/assets/update.sh');
                        \app\extensions\greendev\proxmox\proxmox::qemuAgentFileWrite(Yii::$app->user->identity['accountid'].'-'.$id,$product->vmid,$cloudronsetup,"/root/cloudron-setup");

			//\app\extensions\greendev\proxmox\proxmox::qemuAgentExec(Yii::$app->user->identity['accountid'].'-'.$id,$product->vmid,"wget https://cloudron.io/cloudron-setup > /root/cloudron-setup");
                        \app\extensions\greendev\proxmox\proxmox::qemuAgentExec(Yii::$app->user->identity['accountid'].'-'.$id,$product->vmid,"chmod +x /root/cloudron-setup");
                        $cloudron = \app\extensions\greendev\proxmox\proxmox::qemuAgentExec(Yii::$app->user->identity['accountid'].'-'.$id,$product->vmid,'/root/./cloudron-setup --skip-reboot');
                    }

                    $customervps= \app\models\customeroder\customervps::find()->where(['accountid' => Yii::$app->user->identity->accountid,'vmid'=>$product->vmid,'customeroderid'=>$id])->one();
                    $customervps->initialsetup=1;
                    if($customervps->validate()){
                        $customervps->save();
                    }else{
                        print_r($customervps->errors);
                    }
                }
                return $this->render('user/vps',['product' => $product,'productname' => $productname,'status'=>$userarray->data,'ip'=>$ip,'os'=>$os,'VpsControl'=>$VpsControl,'customervps'=>$customervps,'VpsSetup'=>$VpsSetup,'message'=>$message]);
        }
        else {
            return  $this->redirect('/dashboard');
        }
    }

	public function actionRechnungen()
	{
		if (Yii::$app->user->isGuest) {
			return  $this->redirect('/dashboard/login');
        }
		if(Yii::$app->user->identity->right >= 0)
		{
			return $this->render('user/rechnungen');
		}
		else {
			return  $this->redirect('/dashboard');
		}
	}

	public function actionStammdaten()
	{
		if (Yii::$app->user->isGuest) {
			return  $this->redirect('/dashboard/login');
        }
		if(Yii::$app->user->identity->right >= 0)
		{
            $session = Yii::$app->session;
            $Account = new Account();
            $StamdatenForm = new StamdatenForm();
            $StamdatenBankForm =new StamdatenBankForm();
            $ChangePassword = new ChangePasswordForm();
            /*muss noch richtig gemacht weden*/
            if($ChangePassword->load(Yii::$app->request->post())) {
                if(Yii::$app->user->identity->personal_password == \Yii::$app->params['pwfrontsalt'].md5($ChangePassword->old_password).\Yii::$app->params['pwbacksalt'] ){
                    if($ChangePassword->personal_password == $ChangePassword->personal_passwordConfirmation){
                        $user = Account::findIdentity(Yii::$app->user->identity->accountid);
                        $user->personal_password = \Yii::$app->params['pwfrontsalt'].md5($ChangePassword->personal_password).\Yii::$app->params['pwbacksalt'] ;
                        $user->personal_passwordConfirmation = \Yii::$app->params['pwfrontsalt'].md5($ChangePassword->personal_passwordConfirmation).\Yii::$app->params['pwbacksalt'];
                        $user->save();
                    }
                }
            }
            /*muss noch richtig gemacht weden*/
            $model = Account::findIdentity(Yii::$app->user->identity->accountid);
            $stamdaten = json_decode(customer::getByIdCustomer(Yii::$app->user->identity->accountid),true);



            if($model->load(Yii::$app->request->post())) {
                echo "<pre>";
                print_r(Yii::$app->request->post());
                die();
            }
            $year = array();
            for($i = 1899;$i<= 2019;$i++){
                $year["$i"] = $i;
            }
            $trash = new KontodeleteForm();
            if($trash->load(Yii::$app->request->post())) {
                if($trash->delcheck){



			$account = Account::findIdentity($trash->accountid);
                    $CustomerOrder = new CustomerOrder();
                    $product = $CustomerOrder::find()->where(['accountid' => $trash->accountid,'cancellation' => null])->count();
                    if($product == 0){
		    $account->deleteToken = Yii::$app->getSecurity()->generateRandomString(120);
                    $now = date("d.m.Y H:i:s");
                    $timestamp = date("d.m.Y H:i:s", strtotime("+24 hours $now"));
                    $account->deletetime = $timestamp;
                    Yii::$app->mailer->compose('layouts/kontodelete', ['mailcode' => $account->deleteToken,'mail'=> strtolower($account->personal_email),'name'=>$account->personal_firstname .' '. $account->personal_lastname])
                        ->setFrom('noreply@windcloud.de')
                        ->setTo(strtolower($account->personal_email))
                        ->setSubject('Kundenkonto Löschen Windcloud 4.0 GmbH')
                        ->send();

                    	$account->save();
                   // echo $trash->accountid;
//$trash->addError('delcheck','haben noch nicht gekündigte Produkte!');
			}else{
				$trash->addError('delcheck','haben noch nicht gekündigte Produkte!');
                     		//Yii::$app->session->setFlash('info', 'Sie haben noch nicht gekündigte Produkte!"');
                    	}
                }

            }
            $tempArray = Country::find()->all();
            $laender = array();
            foreach ($tempArray as $row) {
                $laender[$row['code']] = $row['name'];
            }
            $billing_shippingAddress =$session->get('billing_shippingAddress');


            if(isset($stamdaten['result'][0])){
                if(empty($session->get('billing_shippingAddress'))){
                    if ($stamdaten['result'][0]['primaryAddressId'] == $stamdaten['result'][0]['invoiceAddressId']){
                        $session->set('billing_shippingAddress',0);
                    }else{
                        $session->set('billing_shippingAddress',1);
                    }
                }
            }

            if($StamdatenForm->load(Yii::$app->request->post())) {
                $AccountStammdatenbilling = Stammdatenbilling_shippingAddressDB::find()->where(['accountid' => Yii::$app->user->identity->accountid])->one();

                $billing_shippingAddress1 =$session->get('billing_shippingAddress');
                if($StamdatenForm->billing_shippingAddress == 1){
                    $addresses =null;
                    $addresses[]= array(
                        "salutation"=> $StamdatenForm->billing_salutation,
                        "firstName"=> $StamdatenForm->billing_firstName,
                        "lastName"=> $StamdatenForm->billing_lastName,
                        'city' => $StamdatenForm->billing_city,
                        'countryCode' => $StamdatenForm->billing_countryCode,
                        'street1' => $StamdatenForm->billing_street1,
                        'zipcode' => $StamdatenForm->billing_zipcode,
                        'primeAddress' =>true
                    );
                    $addresses[]= array(
                        "salutation"=> $StamdatenForm->shipping_salutation,
                        "firstName"=> $StamdatenForm->shipping_firstName,
                        "lastName"=> $StamdatenForm->shipping_lastName,
                        'city' => $StamdatenForm->shipping_city,
                        'countryCode' => $StamdatenForm->shipping_countryCode,
                        'street1' => $StamdatenForm->shipping_street1,
                        'zipcode' => $StamdatenForm->shipping_zipcode,
                        'invoiceAddress' =>true,
                    );
                    $session->set('billing_shippingAddress',1);
                    $AccountStammdatenbilling->billing_shippingAddress = true;
                }else{
                    $addresses =null;
                    $addresses[]= array(
                        "salutation"=> $StamdatenForm->billing_salutation,
                        "firstName"=> $StamdatenForm->billing_firstName,
                        "lastName"=> $StamdatenForm->billing_lastName,
                        'city' => $StamdatenForm->billing_city,
                        'countryCode' => $StamdatenForm->billing_countryCode,
                        'street1' => $StamdatenForm->billing_street1,
                        'zipcode' => $StamdatenForm->billing_zipcode,
                        'invoiceAddress' =>true,
                        'primeAddress' =>true
                    );
                    $session->set('billing_shippingAddress',0);
                    $AccountStammdatenbilling->billing_shippingAddress = false;
                }

                $stamdaten['result'][0]['addresses'] =$addresses;
                customer::setUpdateCustomer($stamdaten['result'][0]['id'],$stamdaten);

                if($AccountStammdatenbilling->validate()){
                    $AccountStammdatenbilling->save();
                   // return  $this->redirect('/dashboard/stammdaten');
                    /*return $this->render('user/stammdaten', [
                        'ChangePassword' => $ChangePassword,
                        'model'=>$model,
                        'laender'=>$laender,
                        'stamdaten'=>$stamdaten['result'][0],
                        'StamdatenForm'=>$StamdatenForm,

                        'billing_shippingAddress'=> $billing_shippingAddress,
                        'year' => $year,
                        'trash' => $trash,
                    ]);*/
                }
                return  $this->redirect('/dashboard/stammdaten');

            }


            if($StamdatenBankForm->load(Yii::$app->request->post())){

                $bankdata[]= array(
                    "accountHolder"=> $StamdatenBankForm->accountHolder,
                    "accountNumber"=> $StamdatenBankForm->accountNumber,
                    "bankCode"=> $StamdatenBankForm->bankCode,
                    'creditInstitute' => $StamdatenBankForm->creditInstitute,
                    'primary' =>true
                );

                $stamdaten['result'][0]['bankAccounts'] =$bankdata;
                customer::setUpdateCustomer($stamdaten['result'][0]['id'],$stamdaten);

                return  $this->redirect('/dashboard/stammdaten');
            }

            if(isset($stamdaten['result'][0])){
                return $this->render('user/stammdaten', [
                    'ChangePassword' => $ChangePassword,
                    'model'=>$model,
                    'laender'=>$laender,
                    'stamdaten'=>$stamdaten['result'][0],
                    'StamdatenForm'=>$StamdatenForm,
                    'Account'=>$Account,
                    'StamdatenBankForm'=>$StamdatenBankForm,
                    'billing_shippingAddress'=> $billing_shippingAddress,
                    'year' => $year,
                    'trash' => $trash,
                    ]);
            }else {
                  return $this->render('user/stammdatenleer', [
                                    'ChangePassword' => $ChangePassword,
                                    'model'=>$model,
                                    'laender'=>$laender,
                                    'StamdatenBankForm'=>$StamdatenBankForm,
                                    'billing_shippingAddress'=> $billing_shippingAddress,
                                    'year' => $year,
                                    'trash' => $trash,
                  ]);
            }
		}
		else {
			return  $this->redirect('/dashboard');
		}
	}

    public function actionAddstammdaten(){
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        $session = Yii::$app->session;
        $session->set('billing_shippingAddress',null);
        $session->set('billing_shippingAddress',1);
        return  $this->redirect('/dashboard/stammdaten');

    }

    public function actionDeletestammdaten(){
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        $session = Yii::$app->session;
        $session->set('billing_shippingAddress',null);
        $session->set('billing_shippingAddress',0);
        return  $this->redirect('/dashboard/stammdaten');
    }

    public function actionThanks($data,$resourcePath=null)
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 0)
        {
            $sepamandat = new \app\models\form\SepaForm();
            if($sepamandat->load(Yii::$app->request->post())) {
                if($sepamandat->validate()){
                    $mandatdata=json_decode(\app\extensions\greendev\vrpayment\payment::base64url_decode($data),true);
                    $mandat =\app\extensions\greendev\vrpayment\payment::getRegistrationDashboardSepaMandate($sepamandat,$mandatdata);
                    if(preg_match("/^(000\.000\.|000\.100\.1|000\.[36])/",$mandat['resultcode'])|| preg_match("/^(000\.400\.0[^3]|000\.400\.100)/",$mandat['resultcode'])){

                        $resultdata =json_decode($mandat['cart'],true);

                        $Invoicelog = new Invoice();

                        $Invoicelog->salesInvoiceid = $resultdata['id'];
                        $Invoicelog->customerNumber =$resultdata['customerNumber'];
                        $Invoicelog->invoiceNumber = $resultdata['invoiceNumber'];

                        $Invoicelog->salesInvoiceItems =  json_encode($resultdata['salesInvoiceItems']);
                        if ($Invoicelog->save()) {
                            return $this->render('user/thanks');
                        }
                    }
                    else{
                        return $this->render('user/error',['data'=>$mandat['response']]);
                    }
                }
            }else{

                $PaymentPostModel=json_decode(\app\extensions\greendev\vrpayment\payment::base64url_decode($data),true);
                return $this->render('user/waiting');

            }




        }
    }

    public function actionThanks22222($brand,$invoicenumber,$accountid,$invoiceid)
    {

        $responseData = payment::getPayment($brand,$invoiceid);
        $salesInvoiceid=json_decode($responseData,true);

        if(isset($salesInvoiceid['id'])){
            $Invoicelog = new Invoice();
            $Invoicelog->salesInvoiceid = $salesInvoiceid['id'];
            $Invoicelog->customerNumber = $accountid;
            $Invoicelog->invoiceNumber = $invoicenumber;
            $Invoicelog->salesInvoiceItems =  json_encode($responseData);


            if ($Invoicelog->save()) {

            } else {
                echo "MODEL NOT SAVED";
                print_r($Invoicelog->getAttributes());
                print_r($Invoicelog->getErrors());
                exit;
            }
        }
        $session = Yii::$app->session;
        $session->set('ShoppingCart',null);

        return $this->render('user/thanks');
    }

    public function actionKontakt()
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 0)
        {
            $kontaktForm = new kontaktForm();
            $helpdesk = new helpdesk();
            $ticket = $helpdesk->getTicket(Yii::$app->user->identity['accountid']);
            $tickets = json_decode($ticket,true);
            $TicketCategory = $helpdesk->getTicketCategory();
            $TicketCategorys = json_decode($TicketCategory,true);

            $KontaktAutoComplete = new KontaktAutoComplete();
            $KontaktAutoComplete = $KontaktAutoComplete::find()->all();
            $AutoComplete=[];
            foreach ($KontaktAutoComplete as $Complete){
                array_push($AutoComplete, $Complete['text']);
            }

            $CategoryData=[];
            foreach ($TicketCategorys['result'] as $Categorys){
                $CategoryData[$Categorys['id']] = $Categorys['name'];
            }

            $TicketUser = $helpdesk->getUser();
            $TicketgetUser = json_decode($TicketUser,true);


            $UserData=[];
            foreach ($TicketgetUser['result'] as $User){
                $UserData[$User['id']] = $User['firstName'] .' '.$User['lastName'];
            }



            if($kontaktForm->load(Yii::$app->request->post()) && $kontaktForm->validate()) {
                    $helpdesk->createTicket($kontaktForm);
                return $this->redirect('/dashboard/kontakt');
            }

            $ticketcount=[];
            foreach ($tickets['result'] as $ticketscount){
                if(isset($ticketscount['solution']))
                {
                    array_push($ticketcount,$ticketscount);
                }
            }
            $count = count($ticketcount);
            $pagination = new Pagination(['totalCount' => $count]);
            $pagination->defaultPageSize = 3;
            $ticketpagination = $helpdesk->getTicketByStatusPage(Yii::$app->user->identity['accountid'],$pagination->page+1,'3');
            $ticketspagination = json_decode($ticketpagination,true);



            return $this->render('user/kontakt',['kontaktForm'=>$kontaktForm,'ticket'=>$ticketspagination ,'UserData'=> $UserData,'CategoryData'=> $CategoryData,'AutoComplete'=>$AutoComplete,'pagination'=> $pagination]);

        }
        else {
            return  $this->redirect('/dashboard');
        }
    }

    public function actionAbuse()
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 0)
        {
            $ShopProduct = new ShopProductForm();
            $product = ShopProduct::find()->all();
            return $this->render('user/abuse', [
                'product' => $product,
            ]);
        }
        else {
            return  $this->redirect('/dashboard');
        }
    }

    public function actionPayment($entityId,$brand,$invoicenumber,$id)
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 0)
        {
            echo 'bitte warten diese funtion wird noch erstellt';
        }
        else {
            return  $this->redirect('/dashboard');
        }
    }

    public function actionPdfInvoice($id)
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 0)
        {
            $invoice = new salesInvoice();
            $invoice =$invoice->getInvoicePDF($id);
           return \Yii::$app->response->SendFile(\Yii::$app->basePath.'/salesInvoice/',$invoice)->send();
        }
        else {
            return  $this->redirect('/dashboard');
        }
    }

    public function actionPdfDownload($file)
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 0)
        {

            return \Yii::$app->response->sendFile(\Yii::$app->basePath.'/documents/'.$file)->send();

        }
        else {
            return  $this->redirect('/dashboard');
        }
    }

    public function actionPdfContract($accid)
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 0)
        {
            $stamdaten = \GuzzleHttp\json_decode(customer::getByIdCustomer(Yii::$app->user->identity->accountid),true);

           $primaryAddressId= $stamdaten['result'][0]['primaryAddressId'];

            $primaryAddressIdsearch = array_search($primaryAddressId,$stamdaten['result'][0]['addresses'],true);

            $key = array_search($primaryAddressId, array_column($stamdaten['result'][0]['addresses'], 'id'));

            $pdf = new Fpdi('P','mm','A4');
            $pdf->AddPage();
            $pdf->AddFont('Ubuntu-Bold','B','Ubuntu-Bold.php');

            $pdf->setSourceFile(\Yii::$app->basePath."/documents/Datum_Kundenname_AVV_PDF.pdf");

            $tplIdx = $pdf->importPage(1);
            $pdf->useImportedPage($tplIdx, 0, 0, null ,null ,false );
            $pdf->AddPage();
            $tplIdx2 = $pdf->importPage(2);
            $pdf->useImportedPage($tplIdx2, 0, 0, null ,null ,false );
            //Name

            if($stamdaten['result'][0]['partyType'] == 'ORGANIZATION'){
                            $pdf->SetFont('Ubuntu-Bold','B',10);
                            $pdf->SetTextColor(0, 68, 119);
                            $pdf->SetXY(24, 107);
                            $pdf->Write(0, 'und der Firma');
            }
            elseif ($stamdaten['result'][0]['partyType'] == 'PERSON'){
                            $pdf->SetFont('Ubuntu-Bold','B',10);
                            $pdf->SetTextColor(0, 68, 119);
                            $pdf->SetXY(24, 107);
                            $pdf->Write(0, 'und der Person');
            }



            if($stamdaten['result'][0]['partyType'] == 'ORGANIZATION'){
                $pdf->SetFont('Ubuntu-Bold','B',10);
                $pdf->SetTextColor(0, 68, 119);
                $pdf->SetXY(24, 124);
                $company = iconv('UTF-8', 'windows-1252', $stamdaten['result'][0]['company']);
                $pdf->Write(0, $company);
            }
            elseif ($stamdaten['result'][0]['partyType'] == 'PERSON'){
                $pdf->SetFont('Ubuntu-Bold','B',10);
                $pdf->SetTextColor(0, 68, 119);
                $pdf->SetXY(24, 124);
                $firstName = iconv('UTF-8', 'windows-1252', $stamdaten['result'][0]['addresses'][$key]['firstName']);
                $lastName = iconv('UTF-8', 'windows-1252',$stamdaten['result'][0]['addresses'][$key]['lastName']);

                $pdf->Write(0, $firstName.' '.$lastName);
            }
            if($stamdaten['result'][0]['partyType'] == 'ORGANIZATION'){
                $pdf->SetFont('Arial','',10);
                $pdf->SetTextColor(0, 68, 119);
                $pdf->SetXY(85.5, 124);
                $pdf->Write(0, 'Firmenname');
            }
            elseif ($stamdaten['result'][0]['partyType'] == 'PERSON'){
                $pdf->SetFont('Arial','',10);
                $pdf->SetTextColor(0, 68, 119);
                $pdf->SetXY(85.5, 124);
                $pdf->Write(0, 'Personname');
            }

            $pdf->SetFont('Ubuntu-Bold','B',10);
            $pdf->SetTextColor(0, 68, 119);
            $pdf->SetXY(24, 135.5);
            $street = iconv('UTF-8', 'windows-1252', $stamdaten['result'][0]['addresses'][$key]['street1']);
            $pdf->Write(0, $street);

            //Postleitzahl, Ort

            $pdf->SetFont('Ubuntu-Bold','B',10);
            $pdf->SetTextColor(0, 68, 119);
            $pdf->SetXY(24, 147);
            $city = iconv('UTF-8', 'windows-1252',$stamdaten['result'][0]['addresses'][$key]['city']);
            $pdf->Write(0, $stamdaten['result'][0]['addresses'][$key]['zipcode'].' '.$city);

            //customerNumber
            $pdf->SetFont('Ubuntu-Bold','B',10);
            $pdf->SetTextColor(0, 68, 119);
            $pdf->SetXY(24, 197);
            $pdf->Write(0, $stamdaten['result'][0]['customerNumber']);


            $pdf->AddPage();
            $tplIdx3 = $pdf->importPage(3);
            $pdf->useImportedPage($tplIdx3, 0, 0, null ,null ,false );

            $pdf->AddPage();
            $tplIdx3 = $pdf->importPage(4);
            $pdf->useImportedPage($tplIdx3, 0, 0, null ,null ,false );

            $pdf->AddPage();
            $tplIdx3 = $pdf->importPage(5);
            $pdf->useImportedPage($tplIdx3, 0, 0, null ,null ,false );

            $pdf->AddPage();
            $tplIdx3 = $pdf->importPage(6);
            $pdf->useImportedPage($tplIdx3, 0, 0, null ,null ,false );


            $pdf->AddPage();
            $tplIdx3 = $pdf->importPage(7);
            $pdf->useImportedPage($tplIdx3, 0, 0, null ,null ,false );

            $pdf->AddPage();
            $tplIdx3 = $pdf->importPage(8);
            $pdf->useImportedPage($tplIdx3, 0, 0, null ,null ,false );

            $pdf->AddPage();
            $tplIdx3 = $pdf->importPage(9);
            $pdf->useImportedPage($tplIdx3, 0, 0, null ,null ,false );

            $pdf->AddPage();
            $tplIdx3 = $pdf->importPage(10);
            $pdf->useImportedPage($tplIdx3, 0, 0, null ,null ,false );

            $invoice = $pdf->Output();

            return \Yii::$app->response->sendFile(\Yii::$app->basePath.'/salesInvoice/',$invoice)->send();

        }
        else {
            return  $this->redirect('/dashboard');
        }
    }

	public function actionNewsletterCreate()
	{
		if (Yii::$app->user->isGuest) {
			return  $this->redirect('/dashboard/login');
        }
		$model = new NewsletterCreateForm();

    	if($model->load(Yii::$app->request->post())) {
			Yii::$app->mailer->compose()
				->setTo($model->to)
				->setFrom(\Yii::$app->params['senderEmail'])
				->setSubject($model->subject)
				->setHtmlBody($model->content)
				->send();
		}
		return $this->render('supporttools/newslettercreate',['model' => $model]);
	}

	public function actionLogout()
    {
        Yii::$app->user->logout();
		return  $this->redirect('/dashboard');
        //return $this->goHome();
    }

    public function actionKundendaten()
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }

        if(Yii::$app->user->identity->right >= 4)
        {
            $model = new Account();
            $tempArray = Country::find()->all();
            $laender = array();
            foreach ($tempArray as $row) {
                $laender[$row['code']] = $row['name'];
            }
                if($model->load(Yii::$app->request->post())) {
                    $customer = new customer();
                    $Accountvalidate = Account::findByUsername($model->personal_email);
                    if($model->validate() && !isset($Accountvalidate)){
                        $postpass =$model->personal_password;
                        $model->personal_password = \Yii::$app->params['pwfrontsalt'].md5($model->personal_password).\Yii::$app->params['pwbacksalt'] ;
                        $model->personal_passwordConfirmation = \Yii::$app->params['pwfrontsalt'].md5($model->personal_passwordConfirmation).\Yii::$app->params['pwbacksalt'] ;
                        $model->authKey = Yii::$app->getSecurity()->generateRandomString(120);
                        $model->accessToken = Yii::$app->getSecurity()->generateRandomString(120);
                        $model->remote_addr =Yii::$app->getRequest()->getUserIP();


                        $customerdata = json_decode(json_encode($customer->setCustomer($model)), true);

                        $model->accountweclappid =$customerdata['customerNumber'];
                            if($model->save())
                            {

                            $shipping_salutation = array('MR' => 'Herr', 'MRS' => 'Frau');
                            Yii::$app->mailer->compose('layouts/createaccountadmin', ['firstname'=> $model->personal_firstname ,'lastname' => $model->personal_lastname,'gender' => $shipping_salutation[$model->personal_salutation],'pass'=>$postpass])
                                ->setFrom('noreply@windcloud.de')
                                ->setTo(strtolower($model->personal_email))
                                ->setSubject('Zugang zum Kundenportal von Windcloud 4.0 GmbH')
                                ->send();
                                return $this->redirect('/dashboard/customeracquisition');
                            }

                            return $this->redirect('/dashboard/customeracquisition');

                    }
                }
            $pass = $this->rand_string(12);
            return $this->render('/dashboard/CRM/kundendaten',['model' => $model,'laender'=>$laender,'pass'=>$pass]);
        }
        else {
            return  $this->redirect('/dashboard');
        }


    }

    public function actionKundenproducts()
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 4)
        {

            return $this->render('/dashboard/admin/Kundenproducts');
        }
        else {
            return  $this->redirect('/dashboard');
        }


    }

    public function actionCustomeracquisition()
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 4)
        {
            return $this->render('/dashboard/CRM/customeracquisition');
        }
    }

    public function actionProductsunlock($id,$hash)
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 3)
        {
            $CustomerOrder = CustomerOrder::find()->where(['id' =>$id,'activate_hash' =>$hash])->one();
            $CustomerData = Account::findIdentity($CustomerOrder->accountid);

            $article = new article();
            $articlepaycycle = $article->getByIdArticle($CustomerOrder->productid);
            $articlepaycycle = json_decode($articlepaycycle,true);
            $productname = $articlepaycycle['name'];
            if($productname == 'Start'){
                $username = $CustomerOrder->id. '' .$CustomerOrder->accountid;
            }else{
                $username = 'admin';
            }
                if($CustomerOrder->load(Yii::$app->request->post())){
                    if($CustomerOrder->validate())
                    {

                        $CustomerOrder->save();



                    if($CustomerOrder->active == 1){
                        /*Yii::$app->mailer->compose('layouts/productsunlock', ['account' => $username,'productname'=>$productname,'initialpasswort'=> $CustomerOrder->initialpasswort,'domain'=>$CustomerOrder->domain,'CustomerData'=>$CustomerData,'mail'=>$CustomerData->personal_email])
                            ->setFrom('noreply@windcloud.de')
                            ->setTo(strtolower($CustomerData->personal_email))
                            ->setSubject('Ihr Produkt ist jetzt Aktiv! Windcloud 4.0 GmbH')
                            ->send();*/



                        $datamail = ['account' => $username,'productname'=>$productname,'initialpasswort'=> $CustomerOrder->initialpasswort,'domain'=>$CustomerOrder->domain,'personal_salutation'=>$CustomerData['personal_salutation'],'personal_firstname'=>$CustomerData['personal_firstname'],'personal_lastname'=>$CustomerData['personal_lastname'],'mail'=>$CustomerData->personal_email];
                        \app\extensions\greendev\mailtask\MailTask::setMailTaskCustomer(strtolower($CustomerData->personal_email),'productsunlock','Ihr Produkt ist jetzt Aktiv! Windcloud 4.0 GmbH',$datamail);

                    }elseif ($CustomerOrder->active == 0){

                        /*
                           Yii::$app->mailer->compose('layouts/productslock', ['account' => $username,'initialpasswort'=> $CustomerOrder->initialpasswort,'domain'=>$CustomerOrder->domain])
                            ->setFrom('noreply@windcloud.de')
                            ->setTo(strtolower($CustomerData->personal_email))
                            ->setSubject('Ihr Produkt ist jetzt Deaktiv! Windcloud 4.0 GmbH')
                            ->send();
*/
                    }




                    }
                    else{
                        print_r($CustomerOrder->errors);
                    }
                }
                return $this->render('/dashboard/admin/productsunlock',['CustomerOrder'=>$CustomerOrder,'username'=> $username,'articlepaycycle'=>$articlepaycycle,'CustomerData'=>$CustomerData]);
            }
        else {
            return  $this->redirect('/dashboard');
        }


    }

    public function actionAddproducts()
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 4)
        {

            $CustomerOrder = new CustomerOrder();
            print_r(Yii::$app->request->post());

                if ($CustomerOrder->load(Yii::$app->request->post())) {
                    $CustomerOrder->activate_hash = bin2hex(openssl_random_pseudo_bytes(80));
                    if($CustomerOrder->validate()){
                        if($CustomerOrder->save())
                        {
                            $product = \GuzzleHttp\json_decode(\app\extensions\greendev\weclapp\article::getByIdArticle($CustomerOrder->productid));
                            \app\extensions\greendev\mailtask\MailTask::setMailTask($CustomerOrder->username,$CustomerOrder,$product->name);
                            $Account = Account::findIdentity($CustomerOrder->accountid);
                            if(Yii::$app->request->post()['InvoiceCreate'])
                            {
                                $items = array();
                                $itemsdata = array();
                                $itemsdata['id'] = $product->id;
                                $itemsdata['domain'] = $CustomerOrder->domain;
                                if(isset($value['option'])){
                                    $itemsdata['option'] = $value['option'];
                                }
                                $paycycle='';
                                if (strpos($product->shortDescription2, 'Jährlich') !== false || strpos($product->shortDescription2, 'Jahr') !== false) {
                                    $paycycle= '12';
                                }
                                if (strpos($product->shortDescription2, 'Monatlich') !== false) {
                                    $paycycle= '1';
                                }
                                $itemsdata['paycycle'] = $paycycle;
                                array_push( $items, $itemsdata);
                                $invoice = new salesInvoice();
                                $invoice->createInvoice($CustomerOrder->accountid,$items);
                            }
                            if(preg_match("/Start/",$product->name)) {
                                $nextcloud = user::AddUser($CustomerOrder->username,$CustomerOrder->id . '' .$CustomerOrder->accountid,$Account->personal_email,$CustomerOrder->initialpasswort, $product->recordItemGroupName."GB");
                                if(preg_match("/(ok|100|OK)/",$nextcloud)){
                                    Yii::$app->mailer->compose('layouts/productsunlock', ['account' => $CustomerOrder->username,'productname'=>$product->name,'initialpasswort'=> $CustomerOrder->initialpasswort,'domain'=>$CustomerOrder->domain,'CustomerData'=>$Account,'mail'=>$Account->personal_email])
                                        ->setFrom('noreply@windcloud.de')
                                        ->setTo(strtolower($Account->personal_email))
                                        ->setSubject('Ihr Produkt ist jetzt Aktiv! Windcloud 4.0 GmbH')
                                        ->send();
                                }
                            }

                            return  $this->redirect('/dashboard/kundenproducts');
                        }
                        echo '<pre>-----';
                        print_r($CustomerOrder);
                        die();
                    }



                }

        }
        else {
            return  $this->redirect('/dashboard');
        }


    }

    public function actionSeomanager()
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 4)
        {
            return $this->render('/dashboard/admin/seomanager');
        }
        else {
            return  $this->redirect('/dashboard');
        }


    }

    public function actionNewsmanager()
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 4)
        {
            return $this->render('/dashboard/admin/newsmanager');
        }
        else {
            return  $this->redirect('/dashboard');
        }


    }

    public function actionNewsmanagerCreate()
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 2)
        {
            $newsdata = new CmsNews();
            if ($newsdata->load(Yii::$app->request->post())) {
                if($newsdata->validate()){
                    if($newsdata->save())
                    {
                        return  $this->redirect('/dashboard/newsmanager');
                    }
                }
            }


            return $this->render('/dashboard/admin/newscreate',['newsdata'=>$newsdata]);
        }
        else {
            return  $this->redirect('/dashboard');
        }


    }

    public function actionNewsmanagerEdit($id)
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 2)
        {
            $newsdata = CmsNews::find()->where(['id' => $id])->one();
            if ($newsdata->load(Yii::$app->request->post())) {
                if($newsdata->validate()){
                    if($newsdata->save())
                    {
                        return  $this->redirect('/dashboard/newsmanager');
                    }
                }
            }


            return $this->render('/dashboard/admin/newsedit',['newsdata'=>$newsdata]);
        }
        else {
            return  $this->redirect('/dashboard');
        }


    }

    public function actionNewsmanagerDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 2)
        {
            $newsdata = CmsNews::find()->where(['id' => $id])->one();
            if ($newsdata->load(Yii::$app->request->post())) {

                if($newsdata->validate()){
                    if($newsdata->delete())
                    {
                        return  $this->redirect('/dashboard/newsmanager');
                    }
                }
            }


            return $this->render('/dashboard/admin/newsdelete',['newsdata'=>$newsdata]);
        }
        else {
            return  $this->redirect('/dashboard');
        }


    }





    public function actionPressespiegel()
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 4)
        {
            $pressespiegel = \app\models\cms\CmsPressespiegel::find()->orderBy('datetime DESC')->all();
            return $this->render('/dashboard/admin/pressespiegelmanager',['pressespiegel'=>$pressespiegel]);
        }
        else {
            return  $this->redirect('/dashboard');
        }


    }

    public function actionPressespiegelCreate()
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 2)
        {
            $Pressespiegeldata = new \app\models\cms\CmsPressespiegel();
            if ($Pressespiegeldata->load(Yii::$app->request->post())) {
                if($Pressespiegeldata->validate()){
                    if($Pressespiegeldata->save())
                    {
                        return  $this->redirect('/dashboard/pressespiegel');
                    }
                }
            }
            return $this->render('/dashboard/admin/pressespiegelcreate',['pressespiegeldata'=>$Pressespiegeldata]);
        }
        else {
            return  $this->redirect('/dashboard');
        }


    }

    public function actionPressespiegelEdit($id)
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 2)
        {
            $pressespiegeldata = \app\models\cms\CmsPressespiegel::find()->where(['id' => $id])->one();
            if ($pressespiegeldata->load(Yii::$app->request->post())) {
                if($pressespiegeldata->validate()){
                    if($pressespiegeldata->save())
                    {
                        return  $this->redirect('/dashboard/pressespiegel');
                    }
                }
            }


            return $this->render('/dashboard/admin/pressespiegeledit',['pressespiegeldata'=>$pressespiegeldata]);
        }
        else {
            return  $this->redirect('/dashboard');
        }


    }

    public function actionPressespiegelDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 2)
        {
            $pressespiegeldata = \app\models\cms\CmsPressespiegel::find()->where(['id' => $id])->one();
            if ($pressespiegeldata->load(Yii::$app->request->post())) {
                if($pressespiegeldata->validate()){
                    if($pressespiegeldata->delete())
                    {
                        return  $this->redirect('/dashboard/pressespiegel');
                    }
                }
            }


            return $this->render('/dashboard/admin/pressespiegeldelete',['pressespiegeldata'=>$pressespiegeldata]);
        }
        else {
            return  $this->redirect('/dashboard');
        }


    }









    public function actionMonthlyInvoice()
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 4)
        {

            $date = date("m.Y");
            //$CustomerOrder = CustomerOrder::find()->where(['cancellation'=>1,'cancellationdate'=>$date])->all();
            $CustomerOrder = CustomerOrder::find()->where(['active' =>'1'])->filterWhere(['like', 'cancellationdate', $date])->all();



            $date = date("d.m.Y");
            $Account = Account::find()->all();
          //  $CustomerOrder = CustomerOrder::find()->where(['active' =>'1','paycycle'=>1,'datetime'=>$date])->all();
/*
            if ($CustomerOrder->load(Yii::$app->request->post())) {
                echo '<pre>-----';
                print_r($CustomerOrder);
                die();
            }*/

            return $this->render('/dashboard/admin/monthlyinvoice',['CustomerOrder'=> $CustomerOrder,'Account'=> $Account,'date' =>$date]);
        }
        else {
            return  $this->redirect('/dashboard');
        }


    }

    public function actionMonthlyCancellation()
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 4)
        {
            $date = date("m.Y");
            $CustomerOrder = CustomerOrder::find()->where(['cancellation'=>1])->filterWhere(['like', 'cancellationdate', $date])->all();
            $model = new CustomerOrderForm();
            if ($model->load(Yii::$app->request->post())) {

                    //user::UserDisable($CustomerOrder);

            }
            return $this->render('/dashboard/admin/monthlycancellation',['CustomerOrder'=> $CustomerOrder,'model'=>$model]);
        }
        else {
            return  $this->redirect('/dashboard');
        }


    }

    public function actionSetseoupdate()
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 4)
        {
            $Seomanager = new Seomanager();
            if ($Seomanager->load(Yii::$app->request->post())) {
                $seodata = Seomanager::find()->where(['route' => $Seomanager->route])->one();
                $seodata->route = $Seomanager->route;
                $seodata->title = $Seomanager->title;
                $seodata->keywords = $Seomanager->keywords;
                $seodata->description = $Seomanager->description;
                $seodata->canonical = $Seomanager->canonical;
                if($seodata->validate()){
                    if($seodata->save())
                    {
                        return  $this->redirect('/dashboard/seomanager');
                    }
                }
            }

        }
        else {
            return  $this->redirect('/dashboard/');
        }


    }

    public function actionWeclapplog()
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 5)
        {
            $log = weclapplog::find()->all();
            return $this->render('/dashboard/admin/weclapplog',['log'=> $log]);

        }
        else {
            return  $this->redirect('/dashboard/');
        }


    }

    public function actionVrpaymentlog()
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 5)
        {

            $url='https://oppwa.com/v1/resultcodes';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $responseData = curl_exec($ch);
            if(curl_errno($ch)) {
                return curl_error($ch);
            }
            curl_close($ch);
            $responseData = json_decode($responseData, true);
            $ResultCodes= $responseData['resultCodes'];
            $log = vrpaymentlog::find()->all();
            return $this->render('/dashboard/admin/vrpaymentlog',['log'=> $log,'resultcodes'=>$ResultCodes]);

        }
        else {
            return  $this->redirect('/dashboard/');
        }


    }

    public function actionNextcloudlog()
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 5)
        {


            $log = nextcloudlog::find()->all();
            return $this->render('/dashboard/admin/nextcloudlog',['log'=> $log]);

        }
        else {
            return  $this->redirect('/dashboard/');
        }


    }

    public function actionCustomerpreorder()
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 5)
        {
            $log = CustomerPreOrder::find()->all();
            return $this->render('/dashboard/admin/customerpreorder',['log'=> $log]);

        }
        else {
            return  $this->redirect('/dashboard/');
        }


    }

    public function actionVrBrandsConfiguration()
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 5)
        {
            $log = vrpaybrandsconfig::find()->all();
            return $this->render('/dashboard/admin/vrbrandsconfiguration',['log'=> $log]);

        }
        else {
            return  $this->redirect('/dashboard/');
        }


    }

    public function actionVrConfiguration()
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 5)
        {
            $log = vrpayconfig::find()->all();
            echo 'test';
            return $this->render('/dashboard/admin/vrconfiguration',['log'=> $log]);

        }
        else {
            return  $this->redirect('/dashboard/');
        }


    }

    public function actionImport($page)
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 5)
        {
            $userarray = customer::getImportCustomer($page);
            $counter = 0;
            foreach ($userarray['result'] as $key => $row) {
                $Account = new AccountInport();
                 if(isset($row['customerCategoryName']) && $row['customerCategoryName'] != 'Standard'  ){
                   $Account->accountid =$row['customerNumber'];
                   $Account->personal_customer_type=$row['partyType'];
                if (isset($row['salutation'])) {

                    $Account->personal_salutation=$row['salutation'];
                }else{
                    $Account->personal_salutation='MR';
                }


                if($row['partyType'] == 'PERSON'){

                    $Account->personal_firstname=$row['firstName'];

                    $Account->personal_lastname=$row['lastName'];
                }elseif ($row['partyType'] == 'ORGANIZATION'){

                    $Account->billing_company=$row['company'];
                    if (isset($row['contacts'][0]['firstName'])) {
                    $Account->personal_firstname= $row['contacts'][0]['firstName'];
                    }else{
                        $Account->personal_firstname= 'firstName';
                    }

                    if (isset($row['contacts'][0]['lastName'])) {
                        $Account->personal_lastname= $row['contacts'][0]['lastName'];
                    }else{
                        $Account->personal_lastname= 'lastName';
                    }

                }
                if (isset($row['email'])) {
                    $Account->personal_email=$row['email'];

                }
                if (isset($row['phone'])) {
                    $Account->personal_phone=$row['phone'];

                }else{
                    $Account->personal_phone='null';
                }

                    $pwd = bin2hex(openssl_random_pseudo_bytes(4));
                    $Account->shipping_street ='null';
                    $Account->shipping_salutation ='null';
                    $Account->shipping_company ='null';
                    $Account->shipping_department ='null';
                    $Account->shipping_lastname ='null';
                    $Account->shipping_firstname ='null';
                    $Account->shipping_additionalAddressLine1 ='null';
                    $Account->shipping_zipcode ='null';
                    $Account->shipping_city ='null';
                    $Account->shipping_country ='null';


                    $Account->billing_street ='bitte nach tragen';
                    $Account->billing_vatId ='bitte nach tragen';
                    $Account->billing_zipcode ='bitte nach tragen';
                    $Account->billing_country ='bitte nach tragen';
                    $Account->billing_city ='bitte nach tragen';
                    $Account->billing_additionalAddressLine1 ='null';
                    $Account->billing_shippingAddress ='null';

                   $Account->billing_department ='null';

                   $Account->personal_password =$pwd;
                   $Account->personal_password = \Yii::$app->params['pwfrontsalt'].md5($pwd).\Yii::$app->params['pwbacksalt'] ;
                   $Account->personal_passwordConfirmation = \Yii::$app->params['pwfrontsalt'].md5($pwd).\Yii::$app->params['pwbacksalt'] ;
                   $Account->authKey = Yii::$app->getSecurity()->generateRandomString(120);
                   $Account->accessToken = Yii::$app->getSecurity()->generateRandomString(120);
                   $Account->remote_addr =Yii::$app->getRequest()->getUserIP();
                   $stamdaten = Account::findIdentity($row['customerNumber']);

                   if($Account->validate()){

                     if (empty($stamdaten)) {
                        $Account->save();
                         echo 'ist noch nicht da <br>';
                     }else{
                       echo 'ist schon da <br>';
                   }
                   }else{
                       echo 'nicht validate<br>';
                   }
                   echo $row['customerNumber'];
                   //echo $pwd.'<br>';
                     echo  '---'.$counter++;
            }


            }

        }

    }

    public function actionImportById($id)
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 5)
        {
//            $userarray = customer::getByIdCustomer($id);
            $userarray = json_decode(customer::getByIdCustomer($id),true);
            $counter = 0;
            foreach ($userarray['result'] as $key => $row) {
                $Account = new AccountInport();
                if(isset($row['customerCategoryName']) && $row['customerCategoryName'] != 'Standard'  ){
                echo 'ja';
		$Account->accountid =$row['customerNumber'];
                    $Account->personal_customer_type=$row['partyType'];
                    if (isset($row['salutation'])) {
                        $Account->personal_salutation=$row['salutation'];
                    }else{
                        $Account->personal_salutation='MR';
                    }
                    if($row['partyType'] == 'PERSON'){
                        $Account->personal_firstname=$row['firstName'];
                        $Account->personal_lastname=$row['lastName'];
                    }elseif ($row['partyType'] == 'ORGANIZATION'){
                        $Account->billing_company=$row['company'];
                        if (isset($row['contacts'][0]['firstName'])) {
                            $Account->personal_firstname= $row['contacts'][0]['firstName'];
                        }else{
                            $Account->personal_firstname= 'firstName';
                        }

                        if (isset($row['contacts'][0]['lastName'])) {
                            $Account->personal_lastname= $row['contacts'][0]['lastName'];
                        }else{
                            $Account->personal_lastname= 'lastName';
                        }
                    }
                    if (isset($row['email'])) {
                        $Account->personal_email=$row['email'];
                    }
                    if (isset($row['phone'])) {
                        $Account->personal_phone=$row['phone'];
                    }else{
                        $Account->personal_phone='null';
                    }
                    $pwd = bin2hex(openssl_random_pseudo_bytes(4));
                    $Account->shipping_street ='null';
                    $Account->shipping_salutation ='null';
                    $Account->shipping_company ='null';
                    $Account->shipping_department ='null';
                    $Account->shipping_lastname ='null';
                    $Account->shipping_firstname ='null';
                    $Account->shipping_additionalAddressLine1 ='null';
                    $Account->shipping_zipcode ='null';
                    $Account->shipping_city ='null';
                    $Account->shipping_country ='null';
                    $Account->billing_street ='bitte nach tragen';
		    $Account->billing_vatId ='bitte nach tragen';
                    $Account->billing_zipcode ='bitte nach tragen';
                    $Account->billing_country ='bitte nach tragen';
                    $Account->billing_city ='bitte nach tragen';
                    $Account->billing_additionalAddressLine1 ='null';
                    $Account->billing_shippingAddress ='null';
                    $Account->billing_department ='null';
                    $Account->personal_password =$pwd;
                    $Account->personal_password = \Yii::$app->params['pwfrontsalt'].md5($pwd).\Yii::$app->params['pwbacksalt'] ;
                    $Account->personal_passwordConfirmation = \Yii::$app->params['pwfrontsalt'].md5($pwd).\Yii::$app->params['pwbacksalt'] ;
                    $Account->authKey = Yii::$app->getSecurity()->generateRandomString(120);
                    $Account->accessToken = Yii::$app->getSecurity()->generateRandomString(120);
                    $Account->remote_addr =Yii::$app->getRequest()->getUserIP();
                    $stamdaten = Account::findIdentity($row['customerNumber']);
		   // echo '<pre>';
                   // print_r($userarray);
		   // echo '</pre><pre>';
		  //  var_dump($Account->errors);
			print_r($stamdaten);
			print_r($Account);

	            if($Account->validate()){
                        if (empty($stamdaten)) {
                            $Account->save();
                            echo 'ist noch nicht da <br>';
                        }else{
                            echo 'ist schon da <br>';
                        }
                    }else{
			print_r($Account->errors);
                        echo 'nicht validate<br>';
                    }

                }


            }

        }

    }

    public function actionKundenupdate()
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 5)
        {
            $Account = Account::find()->all();
            foreach ($Account as $key => $row) {
                echo '<pre>';
                $model = Account::findByID($row['accountid']);

                $model->accountweclappid = $row['accountid'];

                if($model->validate()){
                    $model->save();

                }else{
                    var_dump($model['accountid']);
                    echo '<br>';
                    var_dump($model->errors);
                    echo '-----------------------';

                }




            }

        }

    }

    public function actionNexttest()
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 5)
        {
            echo'<pre>';
                print_r(user::AddUser('clarakruse@posteo.de','3451001349','clarakruse@posteo.de','a979920e3d7a', "25GB"));
            echo'</pre>';
        }

    }

    public function actionJobtest()
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 5)
        {
            Yii::$app->queue->delay(5 * 60)->push(new NextCloudJob([
            'user' => 'info@green-dev.de',
            'accountid' => Yii::$app->user->identity->getId(),
            'group' => 'tesdfxcvxcv',
            'email' => 'info@green-dev.de',
            'password' => 'accinfoconsole',
            'quota' => '25GB',
            'productname' => 'Start',
            'domain' => 'next-dev.windcloud.de',
        ]));
        }
    }


    public function actionIpPool($from,$to)
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 5) {
            $i = $from;
            /*while ($i <= $to)
            {

                $IpPool = new \app\models\VPSTask\VPSIPS();
                $IpPool->ip = '128.0.64.'.$i;
                $IpPool->save();
                $i++  ;            // Wert wird um 1 erhöht
            }*/

        }
    }

    function rand_string( $length ) {

        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars),0,$length);

    }

    public function actionCancellation($id) {

            if (Yii::$app->user->isGuest) {
                return  $this->redirect('/dashboard/login');
            }
            $CustomerOrder = CustomerOrder::find()->where(['id' => $id])->one();

            if($CustomerOrder->accountid == Yii::$app->user->identity->accountid){

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
                    return  $this->redirect('/dashboard/vps?id='.$id);
                }else{
                    var_dump($CustomerOrder->errors);
                }
            }else{
                return  $this->redirect('/dashboard/vps?id='.$id);
            }

    }

    public function actionInvoicePay($invoiceid,$invoicenumber) {

        $invoice = new salesInvoice();
        $invoice =$invoice->getInvoicePDFName($invoiceid);

        $invoice = json_decode($invoice, true);

        $PaymentPostModel = new PaymentPostModel();

        $vrpaybrands = vrpaybrandsconfig::find()->where(['status' => 1])->all();
        $paybrands = array();
        foreach ($vrpaybrands as $row) {
            if($row['name'] == "PAYPALSDK" || $row['name'] === "SOFORTUEBERWEISUNGSDK"){
                $paybrands[$row['name']] = '<img src="/image/payment-icons/'.$row['image'].'" size="20px" style="width: 120px;">';
            }

        }


        if ($PaymentPostModel->load(Yii::$app->request->post())) {
           switch ($PaymentPostModel->brand) {
                case 'DIRECTDEBIT_SEPA':
                    $model = new \app\models\form\SepaForm();
                    return $this->render('brands/DIRECTDEBIT_SEPA',['model'=>$model]);
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
                    $Checkout=\app\extensions\greendev\PaypalApi\PayPal::getDashboardCheckout($AccessToken,$invoice['customerNumber'],$invoice['grossAmount'],$invoice);
                    return $this->redirect($Checkout);
                case 'SOFORTUEBERWEISUNGSDK':
                    $Checkout=\app\extensions\greendev\SofortueberweisungApi\sofort::getDashboardCheckout($invoice['customerNumber'],$invoice['grossAmount']);
                    return $this->redirect($Checkout);
            }
        }



        return $this->render('/dashboard/user/InvoicePay',['invoice'=> $invoice,
            'PaymentPostModel' => $PaymentPostModel,
            'vrpaybrands' => $paybrands]);
    }



    public function actionPaymentSepamandat(){
        $session = Yii::$app->session;
        $sepamandat = new \app\models\form\SepaForm();
        if($sepamandat->load(Yii::$app->request->post())) {
            if($sepamandat->validate()){
                $mandat =\app\extensions\greendev\vrpayment\payment::getRegistrationSepaMandate($sepamandat);
                if(isset($mandat['resultcode'])){
                    if(preg_match("/^(000\.000\.|000\.100\.1|000\.[36])/",$mandat['resultcode'])){

                        $RecurringPayment = new \app\models\Payment\RecurringPayment();
                        $RecurringPayment->recurringId =$mandat['registrationsId'];
                        $RecurringPayment->recurringentityId =$mandat['registrationsId'];
                        $RecurringPayment->accountid =$mandat['accountid'];
                        $RecurringPayment->cart =json_encode($mandat['cart']);
                        $RecurringPayment->customerorderId ='0';
                        $RecurringPayment->recurringType ='DIRECTDEBIT_SEPA';
                        if($RecurringPayment->validate()){
                            $RecurringPayment->save();
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

    public function actionPaymentPaypal($token,$PayerID){
        $session = Yii::$app->session;
        $AccessToken=\app\extensions\greendev\PaypalApi\PayPal::getAccessToken();
        $model = \app\extensions\greendev\PaypalApi\PayPal::getDashboardCheckoutCapture($AccessToken,$token,$PayerID);
        if($model== 'COMPLETED'){
            return $this->redirect(['checkout/successful']);
        }else{
            return $this->redirect(['checkout/notsuccessful']);
        }

    }

    public function actionPaymentSofortueberweisung($trx)
    {
        $model = \app\extensions\greendev\SofortueberweisungApi\sofort::getDashboardTransactionData($trx);
        if ($model) {
            return $this->redirect(['checkout/successful']);
        } else {
            return $this->redirect(['checkout/notsuccessful']);
        }
    }
    public function actionSession()
    {
        $session = Yii::$app->session;
        $tempArray = $session->get('ShoppingCart');
        echo "<pre>";
        print_r($tempArray);
        die();
    }






}
