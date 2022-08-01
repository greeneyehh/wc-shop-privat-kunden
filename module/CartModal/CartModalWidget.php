<?php
namespace app\module\CartModal;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class CartModalWidget extends Widget{
	public function run(){

        return $this->render('index');
		}
	
	}

?>