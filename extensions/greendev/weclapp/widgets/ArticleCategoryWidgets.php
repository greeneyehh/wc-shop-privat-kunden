<?php


namespace app\extensions\greendev\weclapp\widgets;
use Yii;
use yii\base\Widget;


class ArticleCategoryWidgets extends Widget
{
    public $id;
    public $get;
    public function init()
    {

    }


    public function run()
    {
        echo $this->getArticleCategory();

    }



    public function getArticleCategory()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/articleCategory/id/'.$this->id);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        $headers = array(
            'AuthenticationToken: ' . \Yii::$app->params['WECLAPP_API_KEY']);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        $array = json_decode($result,true);

        return  $array[$this->get];
    }


}