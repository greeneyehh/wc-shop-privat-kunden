<?php
namespace app\controllers;

use app\extensions\greendev\weclapp\variantArticle;
use app\models\DomainForm;
use app\models\OsForm;
use app\models\product\ProductType;
use app\models\shop\CustomerOrder;
use app\models\shop\ShopSlugCategory;
use himiklab\sitemap\behaviors\SitemapBehavior;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\base\Behavior;
use yii\web\Response;
use app\models\Security\Updatelog;
use app\extensions\greendev\weclapp\article;
class DashboardWizardController extends Controller
{
    public function beforeAction($action)
    {
        $this->layout = 'dashboard';
        return parent::beforeAction($action);
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

        public function actionStepOs()
		{
            if (Yii::$app->user->isGuest) {
                return  $this->redirect('/dashboard/login');
            }
            if(Yii::$app->user->identity->right >= 5)
            {
            if (Yii::$app->request->isAjax) {
                if(Yii::$app->request->post()){

                    $session = Yii::$app->session;
                    unset($session['ShoppingWizard']);
                    unset($session['ShoppingWizardAddon']);
                    $ShopProduct = new variantArticle();
                    $array = $ShopProduct->getByVariantId(Yii::$app->request->post()['vps']);
                    $customerid = Yii::$app->request->post()['customerid'];
                    $data = json_decode($array,true);
                    return $this->renderAjax('index',
                    ['model' => $data,'customerid'=>$customerid]
                    );
                }else{

                    $message= "Bitte gehen sie einen schritt zurück";
                    return $this->renderAjax('error',['message'=>$message]);

                }
            }
            }
		}

	public function actionStepTwo()
		{
            if (Yii::$app->user->isGuest) {
                return  $this->redirect('/dashboard/login');
            }
            if(Yii::$app->user->identity->right >= 5)
            {
            if (Yii::$app->request->isAjax) {
                if(Yii::$app->request->post()) {
                $session = Yii::$app->session;
                $data = Yii::$app->request->post();
                unset($session['ShoppingWizard']);
                $tempArray = $session->get('ShoppingWizard');

                        $data["WizardType"] = 1;
                        $data["type"] = 3;
                        if (!$tempArray) {
                            $tempArray['StepOne'] = $data;
                        } else {
                            $tempArray['StepOne'] = $data;
                        }
                        $session->set('ShoppingWizard', $tempArray);
                        $variantArticle = new variantArticle();
                        $VariantArticleNumber = null;

                if (preg_match("/Cloudron/", $data['name'])){
                    $Article = new Article();
                    $vpstag = str_replace(" Cloudron", "", $tempArray['StepOne']['name']);
                    $articledata= $Article->getByNameArticle($vpstag.' Backup');
                    $articledata = json_decode($articledata,true);
                    $customerid = Yii::$app->request->post()['customerid'];
                return $this->renderAjax('step-four',['backup'=>$articledata['result'],'customerid'=>$customerid]);
                }else{
                        if (preg_match("/Windows/", $data['name'])) {
                            $VariantArticleNumber = 'Windows.Distributionen';
                        } else{
                            $VariantArticleNumber = 'Linux.Distributionen';
                        }

                            $ShopCategoryProduct = $variantArticle->getByVariantArticleNumber($VariantArticleNumber);
                            $ShopCategoryProduct = json_decode($ShopCategoryProduct, true);

                            $ArticleNumber = [];
                            foreach ($ShopCategoryProduct['result']['0']['variants'] as $key => $value) {
                                array_push($ArticleNumber, $value['articleId']);
                            }
                            $Articlearray = new Article();
                            $OsForm = new OsForm();
                            $Article = $Articlearray->getByArrayArticle($ArticleNumber);
                            $Article = json_decode($Article, true);
                    $customerid = Yii::$app->request->post()['customerid'];
                            return $this->renderAjax('step-two', ['post' => Yii::$app->request->post(), 'data' => $Article['result'],'customerid'=>$customerid]);



                }


            }

        }
        }
	}

	public function actionStepThree()
		{
            if (Yii::$app->user->isGuest) {
                return  $this->redirect('/dashboard/login');
            }
            if(Yii::$app->user->identity->right >= 5)
            {
            if (Yii::$app->request->isAjax) {
                if(Yii::$app->request->post()){
                    $data= Yii::$app->request->post();
                    $session = Yii::$app->session;
                    $tempArray = $session->get('ShoppingWizard');
                        $data["WizardType"] =  2;
                        $data["type"] =3;
                        $data["os"] =1;
                        $idarray = array_key_last($tempArray);
                        if(preg_match("/Windows/",$data['name'])){
                            $tempArray['StepTwo']=$data;
                            $session->set('ShoppingWizard',$tempArray);
                            $Article = new Article();
                            $vpstag = str_replace(" Windows", "", $tempArray['StepOne']['name']);
                            $articledata= $Article->getByNameArticle($vpstag.' Backup');
                            $articledata = json_decode($articledata,true);
                            $customerid = Yii::$app->request->post()['customerid'];
                            return $this->renderAjax('step-four',['backup'=>$articledata['result'],'customerid'=>$customerid]);
                        }

                        $tempArray['StepTwo']=$data;
                        $session->set('ShoppingWizard',$tempArray);
                        $Article = new Article();
                        $ShopCategoryProduct =$Article->getByIdArticle($data['id']);
                        $Product =$Article->getByIdArticle($tempArray['StepOne']['id']);
                        $Product = json_decode($Product,true);
                        $ShopCategory=null;
                        if(preg_match("/Linux/",$Product['longText'])){
                            $SlugCategory = ShopSlugCategory::findByLabel('VPS-Panel');
                            $SlugId=$SlugCategory->categoryid;
                            $ShopCategoryProduct =$Article->getByCategoryId($SlugId);
                            $ShopCategory = json_decode($ShopCategoryProduct,true);
                            $vpstag = str_replace(" Linux", "", $tempArray['StepOne']['name']);
                            $articledata= $Article->getByNameArticle($vpstag.' Backup');
                            $articledata = json_decode($articledata,true);
                            $customerid = Yii::$app->request->post()['customerid'];
                            return $this->renderAjax('step-four',['backup'=>$articledata['result'],'customerid'=>$customerid]);
                        }
                    $customerid = Yii::$app->request->post()['customerid'];
                        return $this->renderAjax('step-three',['panel'=>$ShopCategory,'tempArray'=>$tempArray,'idlastarray'=>$idarray,'customerid'=>$customerid]);
                }
            }
            }
		}

    public function actionStepFour ()
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 5)
        {
        if (Yii::$app->request->isAjax) {
            if(Yii::$app->request->post()){
                $data= Yii::$app->request->post();
                $session = Yii::$app->session;
                $tempArray = $session->get('ShoppingWizard');
                if(isset($data["nopanel"]) && $data["nopanel"] == 1){

                    if(isset($tempArray['StepThree'])) {
                        unset($tempArray['StepThree']);
                        $session->set('ShoppingWizard', $tempArray);
                    }
                    $Article = new Article();
                    $Product =$Article->getByIdArticle($tempArray['StepOne']['id']);
                    $vpstag = str_replace(" Windows", "", $tempArray['StepOne']['name']);
                    $articledata= $Article->getByNameArticle($vpstag.' Backup');
                    $articledata = json_decode($articledata,true);
                    $customerid = Yii::$app->request->post()['customerid'];
                    return $this->renderAjax('step-four',['backup'=>$articledata['result'],'customerid'=>$customerid]);
                }else{

                    $idarray = array_key_last($tempArray);
                    $data= Yii::$app->request->post();
                    $data["WizardType"] =  3;
                    $data["type"] =3;
                    $tempArray['StepThree']=$data;
                    $session->set('ShoppingWizard',$tempArray);
                    $Article = new Article();
                    $Product =$Article->getByIdArticle($tempArray['StepOne']['id']);
                    $vpstag = str_replace(" Windows", "", $tempArray['StepOne']['name']);
                    $articledata= $Article->getByNameArticle($vpstag.' Backup');
                    $articledata = json_decode($articledata,true);
                    $customerid = Yii::$app->request->post()['customerid'];
                    return $this->renderAjax('step-four',['backup'=>$articledata['result'],'customerid'=>$customerid]);

                }


            }
        }
        }
    }

    public function actionStepFive  ()
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 5)
        {
        if (Yii::$app->request->isAjax) {
            if(Yii::$app->request->post()){
                $data= Yii::$app->request->post();
                if(isset($data["nopanel"]) && $data["nopanel"] == 1){
                    $session = Yii::$app->session;
                    $tempArray = $session->get('ShoppingWizard');
                    if(isset($tempArray['StepFour'])){
                        unset($tempArray['StepFour']);
                        $session->set('ShoppingWizard',$tempArray);
                    }
                    $customerid = Yii::$app->request->post()['customerid'];
                    return $this->renderAjax('step-five',['tempcat'=>$tempArray,'customerid'=>$customerid]);
                }else{
                $session = Yii::$app->session;
                $tempArray = $session->get('ShoppingWizard');
                $data= Yii::$app->request->post();
                $data["WizardType"] =  4;
                $data["type"] =3;
                $data["backup"] =1;
                   $tempArray['StepFour']=$data;
                $session->set('ShoppingWizard',$tempArray);
                    $customerid = Yii::$app->request->post()['customerid'];
                return $this->renderAjax('step-five',['tempcat'=>$tempArray,'customerid'=>$customerid]);
                }
            }
        }
    }
    }


    public function actionTwoCart  ()
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 5)
        {
            if (Yii::$app->request->isAjax) {
                if(Yii::$app->request->post()){
                    $customerid = Yii::$app->request->post()['customerid'];
                    $session = Yii::$app->session;
                    $datapost= Yii::$app->request->post();
                    $ShoppingWizard = $session->get('ShoppingWizard');
                    $session->set('ShoppingCart',null);
                    $ShoppingCart = $session->get('ShoppingCart');
                    $WizardAddon = $session->get('ShoppingWizardAddon');
                    $ShoppingWizard['StepOne']['option']=null;

                    if(!empty($WizardAddon)){
                        if(empty($ShoppingWizard['StepOne']['option'])){
                            $ShoppingWizard['StepOne']['option'] =$WizardAddon;
                        }else{
                            array_push($ShoppingWizard['StepOne']['option'],$WizardAddon);
                        }

                    }

                        if(!empty($WizardAddon)){
                            if(empty($ShoppingWizard['StepThree']['option'])){
                                $ShoppingWizard['StepThree']['option'] =$WizardAddon;
                            }else{
                                array_push($ShoppingWizard['StepThree']['option'],$WizardAddon);
                            }
                            if(empty($ShoppingWizard['StepFour']['option'])){
                                $ShoppingWizard['StepFour']['option'] =$WizardAddon;
                            }else{
                                array_push($ShoppingWizard['StepFour']['option'],$WizardAddon);
                            }
                        }


                    if(!empty( $ShoppingWizard['StepTwo'])){
                        if(empty($ShoppingWizard['StepOne']['option'])){
                            $ShoppingWizard['StepOne']['option'][] =$ShoppingWizard["StepTwo"];
                        }else{
                            array_push($ShoppingWizard['StepOne']['option'],$ShoppingWizard["StepTwo"]);
                        }

                    }
                    if(!empty( $ShoppingWizard['StepThree'])){
                        if(empty($ShoppingWizard['StepOne']['option'])){
                            $ShoppingWizard['StepOne']['option'][] =$ShoppingWizard["StepThree"];
                        }else{
                            array_push($ShoppingWizard['StepOne']['option'],$ShoppingWizard["StepThree"]);
                        }

                    }
                    if(!empty( $ShoppingWizard['StepFour'])){
                        if(empty($ShoppingWizard['StepFour']['option'])){
                            $ShoppingWizard['StepOne']['option'][] =$ShoppingWizard["StepFour"];
                        }else{
                            array_push($ShoppingWizard['StepOne']['option'],$ShoppingWizard["StepFour"]);
                        }

                    }
                    if(!empty($ShoppingCart)){
                        array_push($ShoppingCart,$ShoppingWizard['StepOne']);
                    }else{
                        $ShoppingCart[]=$ShoppingWizard['StepOne'];
                    }

                    $session->set('DashboardCustomerVps',$ShoppingCart);
                    unset($ShoppingWizard);
                    unset($WizardAddon);

                    $session->set('ShoppingWizardTemp',null);
                    $session->set('ShoppingWizard',null);
                    $session->set('ShoppingWizardAddon',null);
                    return $this->renderAjax('orderinfo',['customerid'=>$customerid]);
                }
            }
        }
    }




    public function actionAjaxAddAddon() {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 5)
        {
            if (Yii::$app->request->isAjax) {
                $data= Yii::$app->request->post();
                if (Yii::$app->request->post())
                {
                    $session = Yii::$app->session;
                    $WizardAddon = $session->get('ShoppingWizardAddon');
                    $tempArray = $session->get('ShoppingWizard');


                    if(isset($data['delete'])){
                        $id=array_search($data['id'], array_column($WizardAddon, 'id'));
                        unset($WizardAddon[$id]);
                        $session->set('ShoppingWizardAddon',$WizardAddon);
                       // $id2=array_search($data['id'], array_column($tempArray, 'id'));

                        $key = array_search(
                            $data['id'],
                            array_filter(
                                array_combine(
                                    array_keys($tempArray),
                                    array_column(
                                        $tempArray, 'id'
                                    )
                                )
                            )
                        );
                        unset($tempArray[$key]);
                        $session->set('ShoppingWizard',$tempArray);
                    }else{
                        if(!$WizardAddon){
                            $WizardAddon[] = $data;
                        }else{
                            array_push($WizardAddon, $data);
                        }
                        array_push($tempArray, $data);
                        $session->set('ShoppingWizard',$tempArray);
                        $session->set('ShoppingWizardAddon',$WizardAddon);
                    }
                    $ShopProduct = new article();
                    $name= str_replace(' ', '-', $tempArray['StepOne']['name']);;
                    $array = $ShopProduct->getCategoryIdByCategoryName("nc-addon-".$name);
                    $CategoryId = json_decode($array,true);
                    $product = $ShopProduct->getByCategoryId($CategoryId['result']['0']['id']);
                    $product = json_decode($product,true);
                    $pos = strpos( $tempArray['StepOne']['name'],"12");
                    if ($pos === false) {
                        $ncaddon = $ShopProduct->getCategoryIdByCategoryName("nc-addon");
                    }
                    else{
                        $ncaddon = $ShopProduct->getCategoryIdByCategoryName("nc-addon-12");
                    }
                    $CategoryIdncaddon = json_decode($ncaddon,true);
                    $ncaddon = $ShopProduct->getByCategoryId($CategoryIdncaddon['result']['0']['id']);
                    $ncaddon = json_decode($ncaddon,true);
                    $productdata= array_merge($product['result'], $ncaddon['result']);
                    $customerid = Yii::$app->request->post()['customerid'];
                    return $this->renderAjax('step-four-nc-add',['data'=>$productdata,'WizardAddon'=>$WizardAddon,'customerid'=>$customerid]);
                }
            }
        }
    }


    public function actionAddVps() {


        $session = Yii::$app->session;
        $ShoppingCart = $session->get('DashboardCustomerVps');

       // $cart = json_decode($ShoppingCart);
        echo '<pre>';
        print_r($ShoppingCart);
        $items = array();
        $customerid = Yii::$app->request->post()['customerid'];
        foreach ($ShoppingCart as $value) {
                $CustomerOrder = new CustomerOrder();
                $CustomerOrder->productid = $value['id'];

                $CustomerOrder->accountid  =$customerid;
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
                    \app\extensions\greendev\vps\VPSTask::createVPSTask($customerid,$CustomerOrder->id,$CustomerOrder->initialpasswort,$value);
                }
        }

     //   \app\extensions\greendev\SalesInvoiceTask\SalesInvoiceTask::setSalesInvoiceTask($customerid,$items);

    }

}
