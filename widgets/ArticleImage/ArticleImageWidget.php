<?php
namespace app\widgets\ArticleImage;

use Yii;

use app\extensions\greendev\weclapp\article;
class ArticleImageWidget extends \yii\bootstrap\Widget{

    public $id;
    public $width;
    public $articleImageId;
    public function init()
    {

    }
	public function run(){


        if(isset($this->articleImageId)){
            if(!empty($this->articleImageId)){

                //$key = array_search('1', array_column($this->articleImageId[0] , 'mainImage'));
                $key=null;
                foreach ($this->articleImageId[0] as $key=> $ImageId) {
                    if($ImageId['mainImage'] == 1){
                        $key = $ImageId['id'];

                    }


                }
                if ($key !=null){
                    $model= article::getDownloadArticleImage($this->id,$ImageId['id']);
                    return $this->render('index',['model' => $model,'width'=>$this->width]);
                }

            }

        }


	}

}

?>