<?php
namespace app\module\NavBarAddon;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use app\models\cms\CmsNavBarAddon;
class NavBarAddonWidget extends Widget{
	public function run(){
		$url = Yii::$app->getRequest()->getPathInfo();
		$model = CmsNavBarAddon::find()->where(['url' => $url])->one();
		
            if($model){
                return $this->render('index', [
                    'model' => $model,
                ]);
            }
		}
	
	}

?>