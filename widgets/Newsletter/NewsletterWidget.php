<?php
namespace app\widgets\Newsletter;

use Yii;

use app\models\cms\NewsletterForm;
class NewsletterWidget extends \yii\bootstrap\Widget{
	public function run(){
		if (Yii::$app->request->isAjax) {
			echo "test";
		}
		$model = new NewsletterForm();
        return $this->render('none',['model' => $model]);
	}
	
}

?>