<?php
namespace app\module\ProduktKontakt;
use app\models\cms\ContactForm;
use app\models\cms\ProduktContactForm;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class KontaktWidget extends Widget{
    public $produkt;

    public function init()
    {
        parent::init();
        if ($this->produkt === null) {
            $this->produkt = 'Hello World';
        }
    }


	public function run(){
        $modelProduktContact = new ContactForm();
        //return $this->render('index',['produkt' => $this->produkt]);
        return $this->render('index',['modelProduktContact' => $modelProduktContact,'produkt' => $this->produkt]);
		}
	
	}

?>