<?php


namespace app\extensions\greendev\weclapp;


use GuzzleHttp\Client;

class articleCategory
{
    public static function getAllCategory() {
        $client = new Client();
        $response = $client->request('GET', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/articleCategory', [
            'headers' => ['Content-Type' => 'application/json',
                'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY']]
        ]);
        return json_decode($response->getBody()->getContents(),true);
    }
    public static function getCategoryById($id) {
        $client = new Client();
        $response = $client->request('GET', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/articleCategory/id/'.$id, [
            'headers' => ['Content-Type' => 'application/json',
                'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY']]
        ]);
        return json_decode($response->getBody()->getContents(),true);
    }
}