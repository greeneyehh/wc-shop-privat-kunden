<?php

namespace app\controllers;
use app\commands\MailJob;
use app\models\cms\NewsletterForm;
use Yii;
use himiklab\sitemap\behaviors\SitemapBehavior;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\cms\ContactForm;
use app\models\ShopProduct;
use app\models\ShopProductForm;
use app\models\DomainForm;
use app\models\shop\ShopSlugCategory;
use app\models\form\ColocationForm;
use app\models\cms\UnternehmenSlugCategory;
use app\models\cms\CmsNews;
use app\models\cms\ShopImprint;
use app\models\cms\ShopTermsOfService;
use app\models\cms\ShopCustomerInformation;
use app\models\cms\ShopDataProtection;
use app\models\cms\ShopCancellationTerms;
use app\extensions\greendev\weclapp\article;
use app\extensions\greendev\weclapp\helpdesk;
use yii\web\Session;
class SiteController extends Controller
{
    public function beforeAction($action)
    {
        $mymodel = \app\models\config\config::find()->where(['name' => 'maintenance'])->one();
        if($mymodel['variable'] == 1){
            $this->layout = 'maintenance';
        }
        else{
            $this->layout = 'main';
        }

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
            'sitemap' => [
                'class' => SitemapBehavior::className(),
                'scope' => function ($model) {

                    $model->select(['url', 'lastmod']);
                    $model->andWhere(['is_deleted' => 0]);
                },
                'dataClosure' => function ($model) {
                    return [
                        'loc' => Url::to($model->url, true),
                        'lastmod' => strtotime($model->lastmod),
                        'changefreq' => SitemapBehavior::CHANGEFREQ_DAILY,
                        'priority' => 0.8
                    ];
                }
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

	public function actionIndex($site = null)
    {
		$session = Yii::$app->session;
			if (!$session->isActive){
				$session->open();
			}
        $news = CmsNews::find()->orderBy('datetime DESC')->limit('3')->all();
		return $this->render('page/index',[
            'news'=>$news,
        ]);
    }

    public function actionAjaxEmailValidation(){
        $mymodel = new NewsletterForm();
        $mymodel->load(Yii::$app->request->post());
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return \yii\widgets\ActiveForm::validate($mymodel);
    }

	public function actionAjaxValidation(){
		  $mymodel = new DomainForm();
		  $mymodel->load(Yii::$app->request->post());
		  Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		  return \yii\widgets\ActiveForm::validate($mymodel);
	}

	public function actionAgb()
    {
        $TermsOfService = ShopTermsOfService::find()->orderBy('id DESC')->all();
        return $this->render('page/agb',['TermsOfService'=> $TermsOfService]);

    }

	public function actionDatenschutzerklaerung()
    {
        $ShopDataProtection =ShopDataProtection::find()->orderBy('id DESC')->one();
        return $this->render('page/datenschutzerklaerung',['ShopDataProtection'=> $ShopDataProtection]);
    }

	public function actionWiderrufsbelehrung()
	 {
         $ShopCancellationTerms =ShopCancellationTerms::find()->orderBy('id DESC')->one();
        return $this->render('page/widerrufsbelehrung',['ShopCancellationTerms'=> $ShopCancellationTerms]);
    }

	public function actionUnternehmen($slug= null)
    {
        if ($slug != null ) {
            $SlugCategory = UnternehmenSlugCategory::findByLabel($slug);
            $SlugId=$SlugCategory->categoryid;
            $ShopProduct = new article();
            $ShopCategoryProduct =$ShopProduct->getByCategoryId($SlugId);
            $view = $SlugCategory->views;
            if(empty($view)){
                $view = 'default';
            }
            $array = json_decode($ShopCategoryProduct,true);
            return $this->render('shop/unternehmen/'.$view, [
                'model' => $array
            ]);
        }else {
            return $this->render('page/unternehmen');
        }
    }

	public function actionSicherheit()
    {
        return $this->render('page/sicherheit');
    }

	public function actionProdukte($slug= null)
    {
		if ($slug != null ) {
            $SlugCategory = ShopSlugCategory::findByLabel($slug);
            if(empty($SlugCategory)){
                return  $this->redirect('/produkte');
            }
            $SlugId=$SlugCategory->categoryid;
            $ShopProduct = new article();
            $ShopCategoryProduct =$ShopProduct->getByCategoryId($SlugId);
            $view = $SlugCategory->views;
            if(empty($view)){
                $view = 'default';
            }
            $array = json_decode($ShopCategoryProduct,true);
            if($slug == 'colocation'){
                $modelcustom = new ColocationForm();
                $racks=array('1' => '1','2' => '2','3' => '3','4' => '4','5' => '5');
                $bandwidth=array('1' => '1','2' => '2','3' => '3','4' => '4','5' => '5');
                if($modelcustom->load(Yii::$app->request->post())) {
                    $message = '<table class="tg"><tr>
                <th class="tg-031e">Vorname, Name: </th>
                <th class="tg-031e">'.$modelcustom->name.'</th></tr>
                <tr>
                <th class="tg-031e">Firma: </th>
                <th class="tg-031e">'.$modelcustom->company.'</th></tr>
                <tr>
                <th class="tg-031e">E-Mail: </th>
                <th class="tg-031e">'.$modelcustom->email.'</th></tr>
                <tr>
                <th class="tg-031e">Telefon: </th>
                <th class="tg-031e">'.$modelcustom->phone.'</th></tr>
                <tr>
                <th class="tg-031e">Nachricht: </th>
                <th class="tg-031e">'.$modelcustom->message.'</th></tr>
                <tr>
                <th class="tg-031e">Bandbreite: </th>
                <th class="tg-031e">'.$modelcustom->bandwidth.'</th></tr>
                <tr>
                <th class="tg-031e">Racks: </th>
                <th class="tg-031e">'.$modelcustom->racks.'</th></tr>   
                <tr>
                <th class="tg-031e">migration: </th>
                <th class="tg-031e">'.$modelcustom->migration.'</th></tr>
                <tr>
                <th class="tg-031e">dsgvo: </th>
                <th class="tg-031e">'.$modelcustom->dsgvo.'</th></tr>
                
                </table>';

                    $helpdesk = new helpdesk();
                    $senddata= ['area' => '22385' ,'subject'=>'COLOCATION-ANFRAGE von Windcloud 4.0 GmbH','priority'=> '2087','assignedUserId'=> '3317','personal_email'=> strtolower($modelcustom->email),'message' => $message];
                    $helpdesk->shopCreateTicket($senddata);

                    return $this->render('page/mailthanks');
                }
                return $this->render('shop/produkte/'.$view, [
                    'model' => $array,
                    'modelcustom' => $modelcustom,
                    'racks' => $racks,
                    'bandwidth' => $bandwidth
                ]);
            }elseif($slug == 'infrastructure-as-a-service'){
                $modelcustom = new ColocationForm();
                $racks=array('1' => '1','2' => '2','3' => '3','4' => '4','5' => '5');
                $bandwidth=array('1' => '1','2' => '2','3' => '3','4' => '4','5' => '5');
                if($modelcustom->load(Yii::$app->request->post())) {

                $message = '<table class="tg"><tr>
                <th class="tg-031e">Vorname, Name: </th>
                <th class="tg-031e">'.$modelcustom->name.'</th></tr>
                <tr>
                <th class="tg-031e">Firma: </th>
                <th class="tg-031e">'.$modelcustom->company.'</th></tr>
                <tr>
                <th class="tg-031e">E-Mail: </th>
                <th class="tg-031e">'.$modelcustom->email.'</th></tr>
                <tr>
                <th class="tg-031e">Telefon: </th>
                <th class="tg-031e">'.$modelcustom->phone.'</th></tr>
                <tr>
                <th class="tg-031e">Nachricht: </th>
                <th class="tg-031e">'.$modelcustom->message.'</th></tr>
                <tr>
                <th class="tg-031e">Racks: </th>
                <th class="tg-031e">'.$modelcustom->migration.'</th></tr>
                <tr>
                <th class="tg-031e">dsgvo: </th>
                <th class="tg-031e">'.$modelcustom->dsgvo.'</th></tr>
                
                </table>';
                    $helpdesk = new helpdesk();
                    $senddata= ['area' => '22385' ,'subject'=>'IAAS-ANFRAGE von Windcloud 4.0 GmbH','priority'=> '2087','assignedUserId'=> '3317','personal_email'=> strtolower($modelcustom->email),'message' => $message];
                    $helpdesk->shopCreateTicket($senddata);
                    return $this->render('page/mailthanks');
                }
                return $this->render('shop/produkte/'.$view, [
                    'model' => $array,
                    'modelcustom' => $modelcustom,
                    'racks' => $racks,
                    'bandwidth' => $bandwidth
                ]);
            }elseif($slug == 'cloud-backup'){
                $modelcustom = new ColocationForm();
                $racks=array('1' => '1','2' => '2','3' => '3','4' => '4','5' => '5');
                $bandwidth=array('1' => '1','2' => '2','3' => '3','4' => '4','5' => '5');
                if($modelcustom->load(Yii::$app->request->post())) {
                $message = '<table class="tg"><tr>
                <th class="tg-031e">Vorname, Name: </th>
                <th class="tg-031e">'.$modelcustom->name.'</th></tr>
                <tr>
                <th class="tg-031e">Firma: </th>
                <th class="tg-031e">'.$modelcustom->company.'</th></tr>
                <tr>
                <th class="tg-031e">E-Mail: </th>
                <th class="tg-031e">'.$modelcustom->email.'</th></tr>
                <tr>
                <th class="tg-031e">Telefon: </th>
                <th class="tg-031e">'.$modelcustom->phone.'</th></tr>
                <tr>
                <th class="tg-031e">Nachricht: </th>
                <th class="tg-031e">'.$modelcustom->message.'</th></tr>
                <tr>
                <th class="tg-031e">Virtuelle Server: </th>
                <th class="tg-031e">'.$modelcustom->bandwidth.'</th></tr>
                <tr>
                <th class="tg-031e">Storage: </th>
                <th class="tg-031e">'.$modelcustom->racks.'</th></tr>   
                <tr>
                <th class="tg-031e">migration: </th>
                <th class="tg-031e">'.$modelcustom->migration.'</th></tr>
                <tr>
                <th class="tg-031e">dsgvo: </th>
                <th class="tg-031e">'.$modelcustom->dsgvo.'</th></tr>
                
                </table>';

                    $helpdesk = new helpdesk();
                    $senddata= ['area' => '22385' ,'subject'=>'Cloud-Backup-ANFRAGE von Windcloud 4.0 GmbH','priority'=> '2087','assignedUserId'=> '3317','personal_email'=> strtolower($modelcustom->email),'message' => $message];
                    $helpdesk->shopCreateTicket($senddata);

                    return $this->render('page/mailthanks');
                }
                return $this->render('shop/produkte/'.$view, [
                    'model' => $array,
                    'modelcustom' => $modelcustom,
                    'racks' => $racks,
                    'bandwidth' => $bandwidth
                ]);
            }
            else{
                return $this->render('shop/produkte/'.$view, [
                    'model' => $array
                ]);
            }
        }else {
			return $this->render('page/produkte');
		}
    }

    public function actionRechenzentrum()
    {
        return $this->render('page/rechenzentrum');
    }

	public function actionImpressum()
    {

        $imprint = ShopImprint::find()->orderBy('id DESC')->one();
        return $this->render('page/impressum',['imprint'=> $imprint]);
    }

	public function actionKontakt()
    {
    	$model = new ContactForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->youraccept = 1) {
               // $datamail= ['mailcode' => $model->firstname .' '. $model->lastname ,'mail'=> strtolower($model->email),'name'=>$model->firstname .' '. $model->lastname ,'message' => $model->message,'callback' => $model->yourcallback ,'phonenumber' =>$model->tel,'email' =>$model->email];
               // \app\extensions\greendev\mailtask\MailTask::setMailTaskCustomer(strtolower(Yii::$app->params['contactEmail']),'kontakt','Kontaktaufnahme von '  .$model->email .' name '.$model->firstname .' '. $model->lastname,$datamail,'noreply@windcloud.de');

                if($model->yourcallback == 1)
                {
                    $yourcallback= "<span style='font-size:12.0pt;sans-serif;color:#3B3838;mso-style-textfill-fill-color:#3B3838;mso-style-textfill-fill-alpha:100.0%'>um rückruf gebeten: ". $model->tel."</span></strong>";
                }else{
                    $yourcallback='';
                }

                $message = '<table class="tg"><tr>
                <th class="tg-031e">'.$model->firstname.' '.$model->lastname.'</th></tr><tr>
                <th class="tg-031e">'.$model->message.'</th></tr><tr>
                <th class="tg-031e">'.$yourcallback.'</th>
                </tr></table>';

                $helpdesk = new helpdesk();
                $senddata= ['area' => '22385' ,'subject'=>'Kontaktaufnahme von ' . $model->firstname .' '. $model->lastname,'priority'=> '2087','assignedUserId'=> '3317','personal_email'=> strtolower($model->email),'message' => $message];
                $helpdesk->shopCreateTicket($senddata);
                return $this->refresh();
            }
        }
        return $this->render('page/kontakt', [
            'model' => $model,
        ]);
    }

    public function actionProduktKontakt()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->youraccept = 1) {
                $datamail=  ['mailcode' => $model->firstname .' '. $model->lastname ,'mail'=> strtolower($model->email),'name'=>$model->firstname .' '. $model->lastname ,'message' => $model->message,'callback' => $model->yourcallback ,'phonenumber' =>$model->tel,'email' =>$model->email];
                \app\extensions\greendev\mailtask\MailTask::setMailTaskCustomer(strtolower(Yii::$app->params['produktcontactEmail']),'kontakt',$model->subject . ' Kontaktaufnahme von ' .$model->email .' name ' .$model->firstname .' '. $model->lastname,$datamail,'noreply@windcloud.de');
                return $this->refresh();
            }

        }
        return $this->render('page/produktkontakt', [
            'model' => $model,
        ]);
    }

	public function actionPresse()
    {
    	$news = CmsNews::find()->orderBy('datetime DESC')->limit('3')->all();
		return $this->render('page/presse',[
       		'news'=>$news,
        ]);
    }

	public function actionNews($slug= null)
    {
    	$news = CmsNews::find()->orderBy('datetime DESC')->limit('3')->all();

		$news = CmsNews::find()->where(['slug' => $slug])->one();
		return $this->render('page/news',[
       		'news'=>$news,
        ]);

	}


    public function actionNewsArchiv()
    {
        $query = CmsNews::find()->orderBy('datetime DESC');
        $count = $query->count();
        $pagination = new \yii\data\Pagination(['totalCount' => $count]);
        $pagination->setPageSize(5);
        $models = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        if (Yii::$app->request->isAjax) {
            return $this->renderPartial('page/NewsArchivAjax',[
                'news'=>$models,
                'pages' => $pagination,
            ]);
        } else {
            return $this->render('page/NewsArchiv',[
                'news'=>$models,
                'pages' => $pagination,
            ]);
        }


    }

	public function actionNewsletter()
    {
    	echo 'danke';
        return;
    }

    public function actionTeamarbeit()
    {
        return $this->render('page/teamarbeit');
    }

    public function actionKundeninformationen()
    {
        $CustomerInformation = ShopCustomerInformation::find()->orderBy('id DESC')->one();
        return $this->render('page/kundeninformationen',['CustomerInformation'=> $CustomerInformation]);

    }

    public function actionPdfDownload($file)
    {
            return \Yii::$app->response->sendFile(\Yii::$app->basePath.'/documents/'.$file)->send();
    }



}

