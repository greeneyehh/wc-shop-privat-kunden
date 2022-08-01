 <?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>
    	<div class="row">
		<div class="col-lg-4  ml-auto">
		
		</div>
	    			<div class="col-lg-4  ml-auto">
		    				
							<div class="item item-<?=$product->id;?>"><h2 class="zentriert"><?=$product->name;?></h2></div>
							<div class="item item-<?=$product->id;?>"><span class="zentriertbox"><?=$product->description;?></span></div>
							<div class="item item-<?=$product->id;?>"><h2 class="zentriert"><?=$product->price;?>  € / Monat</h2></div>
							<div class="item item-0"> <?= Html::submitButton('Hier Bestellen', ['class' => 'order-btn border-btn', 'name' => 'productid-'.$product->id,]) ?></div>
					</div>
	<div class="col-lg-4  ml-auto">

	</div>
		</div>
