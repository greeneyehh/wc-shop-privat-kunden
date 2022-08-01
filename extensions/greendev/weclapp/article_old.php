<?php
namespace app\extensions\greendev\weclapp;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
    class article {
        public static function getArticle() {
            $client = new Client();
            $response = $client->request('GET', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/article', [
                'headers' => ['Content-Type' => 'application/json',
                    'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY']]
            ]);
            return json_decode($response->getBody()->getContents(),true);
        }

        public static function getTestArticle() {
            $client = new Client();
            $response = $client->request('GET', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/article', [
                'headers' => ['Content-Type' => 'application/json',
                    'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY']]
            ]);
            return json_decode($response->getBody()->getContents(),true);
        }




        public static function setArticle() {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/article');
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            $headers = array(
                'AuthenticationToken: ' . \Yii::$app->params['WECLAPP_API_KEY']);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = json_decode(curl_exec($ch));
            curl_close($ch);
            return  $result;
        }
        public static function countArticle() {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/article/count');
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            $headers = array(
                'AuthenticationToken: ' . \Yii::$app->params['WECLAPP_API_KEY']);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = json_decode(curl_exec($ch));
            curl_close($ch);
            return  $result;

        }
        public static function getByIdArticle($id) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/article/id/'.$id);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            $headers = array(
                'AuthenticationToken: ' . \Yii::$app->params['WECLAPP_API_KEY']);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            curl_close($ch);
            return  $result;
        }

        public static function getByNameArticle($string) {
            $ch = curl_init();
            $url= \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/article?name-like='.urlencode($string);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            $headers = array(
                'AuthenticationToken: ' . \Yii::$app->params['WECLAPP_API_KEY']);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            curl_close($ch);
            return  $result;
        }



        public static function getByArrayArticle($array) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/article?id-in='.json_encode($array));
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
            $headers = array(
                'AuthenticationToken: ' . \Yii::$app->params['WECLAPP_API_KEY']);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            curl_close($ch);
            return  $result;
        }

        public static function getByCategoryId($id) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/article?articleCategoryId-eq='.$id.'&sort=articleNumber');


            //articleNumber
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
            $headers = array(
                'AuthenticationToken: ' . \Yii::$app->params['WECLAPP_API_KEY']);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            curl_close($ch);
            return  $result;
        }

        public static function getByCategoryIdandPaycycle($id,$paycycle) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/article?articleCategoryId-eq='.$id.'&sort=articleNumber&name-like='.$paycycle);


            //articleNumber
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            $headers = array(
                'AuthenticationToken: ' . \Yii::$app->params['WECLAPP_API_KEY']);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            curl_close($ch);
            return  $result;
        }


    }
    ?>

