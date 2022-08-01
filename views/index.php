<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use app\components\CartModal\CartModalWidget;
?>
<div class="site-index">
    <div class="body-content">
		<div class="row">
		    	<?php foreach ($product as $products): ?>
						<div class="col-lg-3 col-sm-6 product-item">
						    <div class="product-container">
						        <div class="row">
						            <div class="col-md-12">
						                <a href="#" class="product-image"><img src="image/Nextcloud_Logo.svg.png" alt="product-image" /></a>
						            </div>
						        </div>
						        <div class="row">
						      		<div class="col-xs-12"><h2><?=$products->name;?></h2></div>
						        </div>
						        <div class="row">
						            <div class="col-xs-12">
						                <p class="product-description"><?=$products->description;?> </p>
						                <div class="row">
						                    <div class="col-xs-12">
						                        <p class="product-price"><?=$products->price;?>  € / Monat</p>
						                    </div>
						                </div>
						                <div class="row">
						                    <div class="col-xs-12">
						                       <?= Html::submitButton('In den Warenkorb', ['class' => 'add-to-cart order-btn border-btn', 'id' => 'button-'.$products->id ,'name' => 'productid-'.$products->id ,'data-id'=>$products->id,'data-name'=>$products->name ,'data-price' =>$products->price]) ?>
						                    </div>
						                </div>
						            </div>
						        </div>
						    </div>
						</div>
				<?php  endforeach; ?>
		</div>

	</div>
   <?= CartModalWidget::widget() ?>
</div>
