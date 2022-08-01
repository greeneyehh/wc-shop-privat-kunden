<?php
namespace app\module\Toasts;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class ToastsWidget extends Widget{
	public function run(){
        return $this->render('index');
		}
	}
?>