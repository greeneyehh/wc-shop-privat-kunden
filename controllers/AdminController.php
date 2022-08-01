<?php
namespace app\controllers;
use app\extensions\greendev\nextcloud\user;
use app\extensions\greendev\vrpayment\payment;
use app\extensions\greendev\weclapp\articleCategory;
use app\models\AccountPass;
use app\models\cms\Country;
use app\models\shop\Invoice;
use app\models\shop\CustomerOrder;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use app\models\dashboard\KundenloginForm;
use app\models\dashboard\ForgotPasswordForm;
use yii\web\Session;
use yii\filters\VerbFilter;
use app\models\Security\Updatelog;
use app\models\Security\Paypallog;
use yii\data\Pagination;
use app\models\supporttools\NewsletterCreateForm;
use yii\swiftmailer\Mailer;
use app\models\ShopProduct;
use app\models\ShopProductForm;
use app\models\Account;
use app\models\AccountInport;
use app\models\form\CustomerOrderForm;
use app\extensions\greendev\weclapp\article;
use app\extensions\greendev\weclapp\customer;
use app\models\dashboard\ShopProductFormDB;
use app\models\dashboard\RechnungKategorieForm;
use app\models\dashboard\ShopProductDB;
use app\models\dashboard\user\ChangePasswordForm;
use app\models\dashboard\user\kontaktForm;
use app\models\dashboard\user\KontodeleteForm;
use app\models\dashboard\user\StamdatenForm;
use app\models\dashboard\user\Stammdatenbilling_shippingAddressDB;
use app\models\dashboard\user\StamdatenBankForm;
use app\models\dashboard\kontakt\KontaktAutoComplete;
use app\extensions\greendev\weclapp\helpdesk;
use app\extensions\greendev\weclapp\salesInvoice;
use yii\validators\Validator;
use ProxmoxVE\Proxmox;
use NextcloudApiWrapper\Wrapper;
use app\models\seo\Seomanager;
use app\models\seo\SeomanagerForm;
use yii\helpers\ArrayHelper;
use \setasign\Fpdi\Fpdi;
class AdminController extends Controller
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




    public function actionCharts($year=null)
    {
        if (Yii::$app->user->isGuest) {
            return  $this->redirect('/dashboard/login');
        }
        if(Yii::$app->user->identity->right >= 3)
        {


            if($year ==null){
                $year =date('Y');
            }
            $log = \app\models\shop\CustomerPreOrder::find()->select('datetime')->where(['like', 'datetime', $year."%", false])->all();

            $i =1;
            foreach ($log as $value){
            if(preg_match("/Cloudron/",$productname['articleNumber'])){

            }

            }


            //print_r($log);
            $log =json_encode($log);
            return $this->render('charts', ['log'=>$log]);
        }
    }


    function rand_string( $length ) {

        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars),0,$length);

    }

}
