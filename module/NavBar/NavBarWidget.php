<?php
namespace app\module\NavBar;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use app\models\cms\CmsNavbar;
class NavBarWidget extends Widget{
	public function run(){
		$mainMenu = CmsNavbar::find()->orderBy(['sort' => SORT_ASC])->all();
        return $this->render('index', [
	            'mainMenu' => $mainMenu,
	        ]);
		}
	
	}

?>