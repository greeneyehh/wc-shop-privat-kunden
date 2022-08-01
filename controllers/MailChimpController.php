<?php
namespace app\controllers;
use app\models\DomainForm;
use Yii;
use yii\web\Controller;
use yii\widgets\ActiveForm;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\cms\NewsletterForm;
use app\models\cms\CmsNewsletter;
class MailChimpController extends Controller

{

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




    public function actionAjaxEmailValidation(){
        $mymodel = new NewsletterForm();
        $mymodel->load(Yii::$app->request->post());
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return \yii\widgets\ActiveForm::validate($mymodel);
        //Yii::app()->end();
    }

    public function actionSignupUser()
    {
        $model = new NewsletterForm();
        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {

                \Yii::$app->response->format = Response::FORMAT_JSON;
                $mailcode= base64_encode($model->email);
                Yii::$app->mailer->compose('layouts/newsletter', ['mailcode' => $mailcode])
                    ->setFrom('newsletter@windcloud.de')
                    ->setTo($model->email)
                    //->attach('/web/image/logo-windcloud.png')
                    ->setSubject('Newsletter Windcloud 4.0 GmbH: Bitte bestätigen Sie Ihre Anmeldung')
                    ->send();
            return $this->goBack();
        }

    }

    public function actionNewsletterConfirm($token)
    {
        $model = new CmsNewsletter();
        $model->email=base64_decode($token);
        $model->remote_addr = Yii::$app->getRequest()->getUserIP();
        if($model->validate()){
            $model->save();
            return $this->render('newsletter-confirm');
        }else{
            return $this->render('newsletter-noconfirm');
        }
    }

    public function actionNewsletterDelete($token)
    {
        //$model = new CmsNewsletter();
       // $model->email=base64_decode($token);

        $model = CmsNewsletter::find()->where(['email'=>base64_decode($token)])->one();
        if (empty($model)) {
            return $this->render('newsletter-nodelete');
        } else {
            $model->delete();
            return $this->render('newsletter-delete');
        }

    }

}

?>



