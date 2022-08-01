<?php


namespace app\extensions\greendev\seotool;
use Yii;
use app\models\seo\Seomanager;
use yii\helpers\Html;
use yii\helpers\Url;

class seo
{
    public static function checkRoute()
    {
        $route = Yii::$app->request->getPathInfo();
        $post = file_get_contents("php://input");
        $seoPage = Seomanager::findOne(['route' => $route]);
        $module = new Seomanager();
        if (empty($seoPage)) {
            $module->route = $route;
            $module->post = $post;
            $module->created = date('Y-m-d H:i:s');
            $module->remote_addr = Yii::$app->getRequest()->getUserIP();
            if (!Yii::$app->user->isGuest) {
                if(Yii::$app->user->identity->right >= 3) {
                    if ($module->save()) {
                        return true;
                    }
                }
            }
            return true;
        }
    }

    public static function FindSEOonRoute()
    {
        $route = Yii::$app->request->getPathInfo();
        $seoPage = Seomanager::findOne(['route' => $route]);
        if (empty($seoPage)) {
            self::checkRoute();
        }elseif($route = Null or $route =''){

            $data ="<meta name='robots' content='index, follow'>";
            $data .="<title>".$seoPage->title."</title>";
            $data .="<meta name='keywords' content='".$seoPage->keywords."'>";
            $data .="<meta name='description' content='".$seoPage->description."'>";
            $data .="<meta name='image' content='" .Url::home('https')."image/WIND_Logo_Wort-Bildmarke_horizontal_RGB.png' />";
            $data .="<meta name='url' content='".Url::home('https')."'/'".$route."'>";
            $data .="<link rel='canonical' href='".$seoPage->canonical."'>";

            $data .="<meta property='og:locale' content='de_DE' />";
            $data .="<meta property='og:title' content='".$seoPage->title."' />";
            $data .="<meta property='og:type' content='website'/>";
            $data .="<meta property='og:image' content='" .Url::home('https')."image/WIND_Logo_Wort-Bildmarke_horizontal_RGB.png' />";
            $data .="<meta property='og:site_name' content='".$seoPage->title."' />";
            $data .="<meta property='og:url' content='".$seoPage->canonical."' />";
            $data .="<meta property='og:image' content='" .Url::home('https')."image/WIND_Logo_Wort-Bildmarke_horizontal_RGB.png' />";
            $data .="<meta property='og:description' content='".$seoPage->description."' />";

            return $data;
        }else{
            $data ="<meta name='robots' content='index, follow'>";
            $data .="<title>".$seoPage->title."</title>";
            $data .="<meta name='keywords' content='".$seoPage->keywords."'>";
            $data .="<meta name='description' content='".$seoPage->description."'>";
            $data .="<meta name='image' content='" .Url::home('https')."image/WIND_Logo_Wort-Bildmarke_horizontal_RGB.png' />";
            $data .="<meta name='url' content='".Url::home('https')."'/'".$route."'>";
            $data .="<link rel='canonical' href='".$seoPage->canonical."'>";

            $data .="<meta property='og:locale' content='de_DE' />";
            $data .="<meta property='og:title' content='".$seoPage->title."' />";
            $data .="<meta property='og:type' content='website'/>";
            $data .="<meta property='og:image' content='" .Url::home('https')."image/WIND_Logo_Wort-Bildmarke_horizontal_RGB.png' />";
            $data .="<meta property='og:site_name' content='".$seoPage->title."' />";
            $data .="<meta property='og:url' content='".$seoPage->canonical."' />";
            $data .="<meta property='og:description' content='".$seoPage->description."' />";

            return $data;
            }


    }

}