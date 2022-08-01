<?php
namespace app\module\FooterAddon;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use app\models\cms\CmsFooterAddon;
class FooterAddonWidget extends Widget{
	public function run(){
		$url = Yii::$app->getRequest()->getPathInfo();
		$model = CmsFooterAddon::find()->where(['url' => $url])->one();
		
		if($model){
			return $this->render('index', [
	            'model' => $model,
	        ]);
		}else{
			return $this->render('default', [
	            'model' => $model,
	        ]);
		}
		

		
		}
	
	}

?>