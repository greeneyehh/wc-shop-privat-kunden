<?php
namespace app\module\Footer;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class FooterWidget extends Widget{
	public function run(){

        return $this->render('index');
		}
	
	}

?>