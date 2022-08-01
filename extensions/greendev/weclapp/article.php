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

        public static function countArticle() {
            $client = new Client();
            $response = $client->request('GET', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/article/count', [
                'headers' => ['Content-Type' => 'application/json',
                    'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY']]
            ]);
            return json_decode($response->getBody()->getContents(),true);
        }

        public static function getByIdArticle($id) {
            $client = new Client();
           try {
               $response = $client->get(\Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/article/id/'.$id, [
                   'headers' => ['Content-Type' => 'application/json',
                       'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY']]
               ]);
               return $response->getBody()->getContents();

            } catch (\Exception $e) {
               return $e;
           }
        }

        public static function getByArticleNumber($articleNumber) {
            $client = new Client();
            $response = $client->request('GET', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/article?articleNumber-eq='.urlencode($articleNumber), [
                'headers' => ['Content-Type' => 'application/json',
                    'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY']]
            ]);
            return $response->getBody()->getContents();
        }

        public static function getByNameArticle($string) {


            $client = new Client();
            $response = $client->request('GET', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/article?name-like='.urlencode($string), [
                'headers' => ['Content-Type' => 'application/json',
                    'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY']]
            ]);
            return $response->getBody()->getContents();
        }

        public static function getByArrayArticle($array) {
            $client = new Client();
            $response = $client->request('GET', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/article?id-in='.json_encode($array), [
                'headers' => ['Content-Type' => 'application/json',
                    'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY']]
            ]);
            return $response->getBody()->getContents();
       }

        public static function getByCategoryId($id) {
            $client = new Client();
            $response = $client->request('GET', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/article?articleCategoryId-eq='.$id.'&sort=articleNumber', [
                'headers' => ['Content-Type' => 'application/json',
                    'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY']]
            ]);
            return $response->getBody()->getContents();
        }
        public static function getCategoryIdByCategoryName($name) {
            $client = new Client();
            $response = $client->request('GET', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/articleCategory?name-eq='.$name, [
                'headers' => ['Content-Type' => 'application/json',
                    'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY']]
            ]);
            return $response->getBody()->getContents();
        }

        public static function getByCategoryIdandPaycycle($id,$paycycle) {
            $client = new Client();
            $response = $client->request('GET', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/article?articleCategoryId-eq='.$id.'&sort=articleNumber&name-like='.$paycycle, [
                'headers' => ['Content-Type' => 'application/json',
                    'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY']]
            ]);
            return $response->getBody()->getContents();
        }

        public static function getDownloadArticleImage($id,$articleImageId) {
            $client = new Client();
            $response = $client->request('GET', \Yii::$app->params['WECLAPP_BASE_URL'] .'/webapp/api/v1/article/id/'.$id.'/downloadArticleImage?articleImageId='.$articleImageId,
                [
                    'headers' => ['content-type' => 'image/svg+xml',
                        'Content-Transfer-Encoding' => 'binary',
                    'AuthenticationToken' => \Yii::$app->params['WECLAPP_API_KEY'], ['stream' => true]
                ]
            ]);

            $body = $response->getBody()->getContents();
            $base64 = base64_encode($body);
            $mime = "image/svg+xml";
            $img = ('data:' . $mime . ';base64,' . $base64);

            return $img;
        }

    }
    ?>

