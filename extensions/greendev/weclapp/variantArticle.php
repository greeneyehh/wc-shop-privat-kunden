<?php


namespace app\extensions\greendev\weclapp;
use GuzzleHttp\Client;

class variantArticle
{
    public static function getByVariantId($id) {
        $client = new Client();
        $response = $client->request('GET', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/variantArticle?primaryArticleId-eq='.$id, [
            'headers' => ['Content-Type' => 'application/json',
                'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY']]
        ]);
        return $response->getBody()->getContents();
    }
    public static function getByVariantArticleNumber($id) {
        $client = new Client();
        $response = $client->request('GET', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/variantArticle?variantArticleNumber-eq='.$id, [
            'headers' => ['Content-Type' => 'application/json',
                'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY']]
        ]);
        return $response->getBody()->getContents();
    }

}