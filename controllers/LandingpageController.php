<?php
namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\dashboard\KundenloginForm;
use app\models\dashboard\ForgotPasswordForm;
use yii\filters\VerbFilter;
use yii\data\Pagination;


class LandingpageController extends Controller
{
	public function beforeAction($action)
	{
	    $this->layout = 'landingpage';
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
    	return $this->render('emissionisourmission');
	}

	public function actionEmissionisourmission()
	{
	return $this->render('landingpage/emissionisourmission');
	}

}
