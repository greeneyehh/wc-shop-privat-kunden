<?php
namespace app\controllers;
use app\models\config\vrpaybrandsconfig;
use app\models\product\ProductType;
use app\models\shop\ShopSlugCategory;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\web\Session;
use app\models\AddonsForm;
use app\models\DomainCheck;
use app\models\DomainForm;
use app\models\OsForm;
use app\models\Addons;
use app\models\ShopProduct;
use app\extensions\greendev\weclapp\article;
use app\extensions\greendev\weclapp\variantArticle;
use floor12\notification\Notification;
class CartController extends Controller
{
	public function beforeAction($action) { 
	     $this->enableCsrfValidation = false; 
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

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
	
	public function actionAjaxValidation(){
		  $mymodel = new DomainForm();
		  $mymodel->load(Yii::$app->request->post());
		  Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if(\yii\widgets\ActiveForm::validate($mymodel) == false)
            {
                $session = Yii::$app->session;
                $data = Yii::$app->request->post();
                $session = Yii::$app->session;
                $tempArray = $session->get('ShoppingCart');
                $tempArray[$mymodel->arryid]['domainextension'] = $mymodel->DomainExtension . ".windcloud.de";
                $session->set('ShoppingCart',$tempArray);
                return  $this->redirect('/cart');
            }else{
                  return \yii\widgets\ActiveForm::validate($mymodel);
            }
	}

	public function actionIndex()
    {
		$session = Yii::$app->session;
		$tempArray = $session->get('ShoppingCart');
		$model = new DomainForm();
		$modelos = new OsForm();
		$addons = Addons::find()->orderBy(['id' => SORT_ASC])->all();
        $vrpaybrands = vrpaybrandsconfig::find()->where(['status' => 1])->all();
        $paybrands = array();
        foreach ($vrpaybrands as $row) {
            $paybrands[$row['name']] = '<img src="/image/payment-icons/'.$row['image'].'" size="90px" style="width: 90px;">';
        }
        $osarray=[
            "Debian" => "Debian",
            "Ubuntu" => "Ubuntu",
            "openSUSE" => "openSUSE",
            "CentOS" => "CentOS",
        ];
		$items=[];
		foreach ($addons as $addon) {
    		$items[$addon->value] =$addon->name;
		}
		if (!$tempArray) {
			return $this->render('emptycart');
		} else {
			return $this->render('index', [
			'osarray'=>$osarray,
			'items' => $items,
			'model' => $model,
			'modelos' => $modelos,
	        'cart' => $tempArray,
             'vrpaybrands' => $paybrands
	        ]);
		}
    }

	public function actionAdd()
    {
        if (Yii::$app->request->post())
        {
            $session = Yii::$app->session;
            $data = Yii::$app->request->post();
            $ProductType = new ProductType();
            $producttype = $ProductType::find()->where(['productid' => $data['id']])->one();
            $tempproducttype = [
                "type" => $producttype->type,
            ];
            $data["type"] = $producttype->type;
            $tempArray = $session->get('ShoppingCart');
                if(!$tempArray){
                    $tempArray[] =$data;
                }else{
                    array_push($tempArray, $data);
                }

            $session->set('ShoppingCart',$tempArray);
            Yii::$app->session->setFlash('success', ['heading' => 'Firmendaten', 'text' => 'Gespeichert!']);

            echo count($tempArray);
        }
    }

    public function actionAjaxAdd() {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->request->post())
            {
               $postdata= Yii::$app->request->post();
                $session = Yii::$app->session;
                $tempArray = $session->get('ShoppingCart');
                $data = Yii::$app->request->post();
                $ProductType = new ProductType();
                $producttype = $ProductType::find()->where(['productid' => $data['id']])->one();
                $tempproducttype = [
                    "type" => $producttype->type,
                ];
                $data["type"] = $producttype->type;
                if(!$tempArray){
                    $tempArray[] =$data;
                }else{
                    array_push($tempArray, $data);
                }

                $session->set('ShoppingCart',$tempArray);
                $idarray = array_key_last($tempArray);
                if(preg_match("/Start/",$postdata['name'])) {
                    $ShopProduct = new article();
                    $Product =$ShopProduct->getByIdArticle($data['id']);
                    $Product = json_decode($Product,true);
                    return $this->renderAjax('summary',['data'=>$Product]);
                }else{
                    $ShopProduct = new article();
                    $SlugCategory = ShopSlugCategory::findByLabel('nextcloud-addon');
                    $SlugId=$SlugCategory->categoryid;
                    $tempArray = $session->get('ShoppingCart');
                    $ShopCategoryProduct =$ShopProduct->getByCategoryId($SlugId);
                    $ShopCategoryProduct = json_decode($ShopCategoryProduct,true);

                    return $this->renderAjax('addons',['data'=>$ShopCategoryProduct,'tempArray'=>$tempArray,'idlastarray'=>null]);
                }
            }
        }
    }

    public function actionAjaxAddAddon() {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->request->post())
            {
                $session = Yii::$app->session;
                $tempArray = $session->get('ShoppingCart');
                $data = Yii::$app->request->post();
                $idarray = array_key_last($tempArray);
                $tempArray[$idarray]['option'][] =$data;

                if(preg_match("/Custom Domain/",$data['name'])){
                    $tempArray[$idarray]['domainextension']=$data['domainextension'];
                }

                $session->set('ShoppingCart',$tempArray);
                $ShopProduct = new article();
                $SlugCategory = ShopSlugCategory::findByLabel('nextcloud-addon');
                $SlugId=$SlugCategory->categoryid;
                $ShopCategoryProduct =$ShopProduct->getByCategoryId($SlugId);
                $ShopCategoryProduct = json_decode($ShopCategoryProduct,true);
                return $this->renderAjax('addons',['data'=>$ShopCategoryProduct,'tempArray'=>$tempArray,'idlastarray'=>$idarray]);
            }
        }
    }

    public function actionAjaxVpsAdd() {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->request->post())
            {
                $session = Yii::$app->session;
                unset($session['ShoppingCartTamp']);
                $tempArray = $session->get('ShoppingCartTamp');
                $data = Yii::$app->request->post();
                $ProductType = new ProductType();
                $producttype = $ProductType::find()->where(['productid' => $data['id']])->one();
                $data["type"] = $producttype->type;
                if(!$tempArray){
                    $tempArray[] =$data;
                }else{
                    array_push($tempArray, $data);
                }
                $session->set('ShoppingCartTamp',$tempArray);
                $idarray = array_key_last($tempArray);
                $variantArticle = new variantArticle();
                              $VariantArticleNumber= null;
                if(preg_match("/Windows/",$data['name'])){
                    $VariantArticleNumber='Windows.Distributionen';
                }else{
                    $VariantArticleNumber='Linux.Distributionen';
                }

                $ShopCategoryProduct =$variantArticle->getByVariantArticleNumber($VariantArticleNumber);
                $ShopCategoryProduct = json_decode($ShopCategoryProduct,true);
              // print_r($ShopCategoryProduct['result']['0']);
                $ArticleNumber=[];
                foreach ($ShopCategoryProduct['result']['0']['variants'] as $key => $value){
                    array_push($ArticleNumber, $value['articleId']);
                }
                $Articlearray = new Article();
                $OsForm =new OsForm();
                $Article= $Articlearray->getByArrayArticle($ArticleNumber);
                $Article = json_decode($Article,true);
                return $this->renderAjax('addons-vps-os',['model'=>$OsForm,'data'=>$Article,'tempArray'=>$tempArray,'idlastarray'=>null]);
            }
        }
    }

    public function actionAjaxAddOs() {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->request->post())
            {
                $session = Yii::$app->session;
                $tempArray = $session->get('ShoppingCartTamp');
                $data = Yii::$app->request->post();
                $idarray = array_key_last($tempArray);
                $Article = new Article();
                $ShopCategoryProduct =$Article->getByIdArticle($data['val']);
                $ShopCategoryProduct = json_decode($ShopCategoryProduct,true);
                $tempArray[$idarray]['OSSystem'][]=$data['text'];
                $option[]=null;
                $option['extensionallowed'] =0;
                $option['price'] =$ShopCategoryProduct['articlePrices']['0']['price'];
                $option['weclapp'] =null;
                $option['domainextension'] =null;
                $option['name'] =$ShopCategoryProduct['name'];
                $option['id']=$ShopCategoryProduct['id'];
                $option['type']=3;
                $option['os']=true;

                $tempArray[$idarray]['option'][] =$option;
                $session->set('ShoppingCartTamp',$tempArray);
                $Product =$Article->getByIdArticle($tempArray[$idarray]['id']);
                $Product = json_decode($Product,true);
                $vpstag = str_replace(" Windows", "", $tempArray[$idarray]['name']);
                $articledata= $Article->getByNameArticle($vpstag.' Backup');
                $articledata = json_decode($articledata,true);
                $ShopCategory=null;
                if(preg_match("/Linux/",$Product['longText'])){
                    $SlugCategory = ShopSlugCategory::findByLabel('VPS-Panel');
                    $SlugId=$SlugCategory->categoryid;
                    $ShopCategoryProduct =$Article->getByCategoryId($SlugId);
                    $ShopCategory = json_decode($ShopCategoryProduct,true);
/*
                    foreach ($ShopCategory['result'] as $key => $value){
                        array_push($articledata['result'], $value);
                    }*/
                }
                return $this->renderAjax('addons-vps',['data'=>$articledata,'panel'=>$ShopCategory,'tempArray'=>$tempArray,'idlastarray'=>$idarray]);
            }
        }
    }

    public function actionAjaxAddOption() {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->request->post())
            {
                $session = Yii::$app->session;
                $tempArray = $session->get('ShoppingCartTamp');
                $data = Yii::$app->request->post();
                $idarray = array_key_last($tempArray);
                $Article = new Article();
                $ShopCategoryProduct =$Article->getByIdArticle($data['val']);
                $ShopCategoryProduct = json_decode($ShopCategoryProduct,true);
                $tempArray[$idarray]['OSSystem'][]=$data['text'];
                $option[]=null;
                $option['extensionallowed'] =0;
                $option['price'] =$ShopCategoryProduct['articlePrices']['0']['price'];
                $option['weclapp'] =null;
                $option['domainextension'] =null;
                $option['name'] =$ShopCategoryProduct['name'];
                $option['id']=$ShopCategoryProduct['id'];
                $option['type']=3;
                $tempArray[$idarray]['option'][] =$option;
                $session->set('ShoppingCartTamp',$tempArray);
                $Product =$Article->getByIdArticle($tempArray[$idarray]['id']);
                $Product = json_decode($Product,true);
                $vpstag = str_replace(" Windows", "", $tempArray[$idarray]['name']);
                $articledata= $Article->getByNameArticle($vpstag.' Backup');
                $articledata = json_decode($articledata,true);
                if(preg_match("/Linux/",$Product['longText'])){
                    $SlugCategory = ShopSlugCategory::findByLabel('VPS-Panel');
                    $SlugId=$SlugCategory->categoryid;
                    $ShopCategoryProduct =$Article->getByCategoryId($SlugId);
                    $ShopCategory = json_decode($ShopCategoryProduct,true);

                    foreach ($ShopCategory['result'] as $key => $value){
                        array_push($articledata['result'], $value);
                    }
                }
                return $this->renderAjax('addons-vps',['data'=>$articledata,'tempArray'=>$tempArray,'idlastarray'=>$idarray]);
            }
        }
    }

    public function actionAjaxAddVpsAddon() {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->request->post())
            {
                $session = Yii::$app->session;
                $tempArray = $session->get('ShoppingCartTamp');
                $data = Yii::$app->request->post();
                $idarray = array_key_last($tempArray);
                $data['type']=3;
                $tempArray[$idarray]['option'][] =$data;
                $session->set('ShoppingCartTamp',$tempArray);

                $Product =$session->get('ShoppingCartTamp');
                return $this->renderAjax('summary-vps',['data'=>$Product]);

            }
        }
    }

    public function actionAjaxAddVpsToCart() {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->request->post())
            {
                $session = Yii::$app->session;
                $tempArray = $session->get('ShoppingCart');
                $array = $session->get('ShoppingCartTamp');

                if(!$tempArray){
                    $tempArray[] =$array['0'];
                }else{
                    array_push($tempArray, $array['0']);
                }
                $session->set('ShoppingCart',$tempArray);
                return $this->redirect('/cart');
            }
        }
    }

    public function actionDomain()
    {
    	
		$mymodel = new DomainForm();
	    if($mymodel->load(Yii::$app->request->post()))
	    {
	   	 $session = Yii::$app->session;
			$data = Yii::$app->request->post(); 
			$session = Yii::$app->session;
			$tempArray = $session->get('ShoppingCart');
			$tempArray[$mymodel->arryid]['domainextension'] = $mymodel->DomainExtension . ".windcloud.de";
			$session->set('ShoppingCart',$tempArray);
    		return  $this->redirect('/cart');
		}
	}

    public function actionOs()
    {
        $mymodel = new OsForm();
        if($mymodel->load(Yii::$app->request->post()))
        {
            $session = Yii::$app->session;
            $data = Yii::$app->request->post();
            $session = Yii::$app->session;
            $tempArray = $session->get('ShoppingCart');
            $tempArray[$mymodel->arryid]['os'] = $mymodel->OSSystem;
            $session->set('ShoppingCart',$tempArray);
            return  $this->redirect('/cart');
        }
    }

	public function actionAddon()
    {
    	
		$mymodel = new DomainForm();
	
    	if($mymodel->load(Yii::$app->request->post()))
	    {
	   	 $session = Yii::$app->session;
			$data = Yii::$app->request->post(); 
			$session = Yii::$app->session;
            $tempArray = $session->get('ShoppingCart');

            if (array_key_exists("weclapp", $tempArray[$mymodel->arryid])){
                if($tempArray[$mymodel->arryid]['weclapp'] =1){
                    $ShopProduct = new article();
                    $ShopCategoryProduct =$ShopProduct->getByIdArticle($mymodel->productid);
                    $product = json_decode($ShopCategoryProduct,true);
                    $product['price'] = $product['articlePrices']['0']['price'];
                    $product = (object) $product;
                }
            }else{
                $product = ShopProduct::find()->where(['id' => $mymodel->productid])->one();
            }




			$addons = Addons::find()->where(['id' => $mymodel->HDDExtension])->one();

			$tempArray[$mymodel->arryid]['price'] = $product->price + $addons->preis;	
			$tempArray[$mymodel->arryid]['addon'] = $mymodel->HDDExtension;	
			$session->set('ShoppingCart',$tempArray);
    		return  $this->redirect('/cart');
		}
			

	}

    public function actionDomainClear()
    {
    	
		$mymodel = new DomainForm();
	
    	if($mymodel->load(Yii::$app->request->post()))
	    {
	   	 $session = Yii::$app->session;
			$data = Yii::$app->request->post(); 
			$session = Yii::$app->session;
			$tempArray = $session->get('ShoppingCart');
			$tempArray[$mymodel->arryid]['domainextension'] = null;
			$session->set('ShoppingCart',$tempArray);
    		return  $this->redirect('/cart');
            echo count($tempArray);
		}
			

	}
	
	public function actionClear()
    {
        $session = Yii::$app->session;
        $tempArray = $session->get('ShoppingCart');
        unset($tempArray);
        $session->set('ShoppingCart',null);
        return  $this->redirect('/cart');


    }
	
	public function actionDelete($id)
    {
		$session = Yii::$app->session;
		$tempArray = $session->get('ShoppingCart'); 
		unset($tempArray[$id]);

		$session->set('ShoppingCart',$tempArray);
       //echo "$('.total-count').html('<span class=\"fa fa-shopping-basket\"></span><span class=\"cartcount\">".count($tempArray)."</span>')";
        //echo $this->getView()->registerJs("$('.total-count').html('<span class=\"fa fa-shopping-basket\"></span><span class=\"cartcount\">".count($tempArray)."</span>')");
		return  $this->redirect('/cart');
    }

    public function actionAddonDelete($id,$key)
    {
        $session = Yii::$app->session;
        $tempArray = $session->get('ShoppingCart');
        unset($tempArray[$id]['option'][$key]);
        $session->set('ShoppingCart',$tempArray);
        //echo "$('.total-count').html('<span class=\"fa fa-shopping-basket\"></span><span class=\"cartcount\">".count($tempArray)."</span>')";
        //echo $this->getView()->registerJs("$('.total-count').html('<span class=\"fa fa-shopping-basket\"></span><span class=\"cartcount\">".count($tempArray)."</span>')");
        return  $this->redirect('/cart');
    }

    public function actionCartAddonDelete()
    {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->request->post())
            {

                $session = Yii::$app->session;
                $tempArray = $session->get('ShoppingCart');
                $data = Yii::$app->request->post();
                $idarray = array_key_last($tempArray);
                $keyCart = null;
                foreach ($tempArray[$idarray]['option'] as $key => $value) {

                   if($value['id'] ==$data['key'] ){
                       $keyCart =$key;
                   }


                }
                 unset($tempArray[$idarray]['option'][$keyCart]);
                $session->set('ShoppingCart',$tempArray);
                $ShopProduct = new article();
                $SlugCategory = ShopSlugCategory::findByLabel('nextcloud-addon');
                $SlugId=$SlugCategory->categoryid;
                $ShopCategoryProduct =$ShopProduct->getByCategoryId($SlugId);
                $ShopCategoryProduct = json_decode($ShopCategoryProduct,true);
                return $this->renderAjax('addons',['data'=>$ShopCategoryProduct,'tempArray'=>$tempArray,'idlastarray'=>$idarray]);




            }
        }
    }

	public function actionCount()
    {
		$session = Yii::$app->session;
		$tempArray = $session->get('ShoppingCart');
		$count= null;

		if(empty($tempArray)){
            $count= 0;
        }else{
            $count= count($tempArray);
        }
        if(isset($count)){
            return $count;
        }
    }

}
