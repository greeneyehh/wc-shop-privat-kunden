<?php

use yii\helpers\Html;

use app\widgets\ArticleImage\ArticleImageWidget;
?>
<div class="card" id="stepthree">
    <div class="card-header border-radius-d cart-card-addon" style="text-align: center;">
        <h3 class="vary">CONTROL PANEL</h3>
        <h1>(Optional).</h1>
        </div>
        <div class="card-body row justify-content-md-center">
        <?php
                foreach ($panel['result'] as $products):
                    {
                        if(!isset($products['shortDescription2']))
                        {
                            array_push($products, "shortDescription2");
                            $products['shortDescription2'] = null;
                        }else{
                            $letters = array('Jährlich für ', 'Monatlich für ','einmalige Zahlung von ');
                            $output  = str_replace($letters, '', $products['shortDescription2']);
                        }
                        ?>

                        <div class="col-12 col-md-3 col-lg-3 col-xs-4 mb-4">

                            <div class="border-radius-d box-shadow p-3 optionsecoptions justify-content-md-center" id="<?=$products['id'];?>"  style="text-align:center;background-color: #ffffff;height: 100%;">
                                <div class="textwizard">
                                    <h3 class="vary" style="text-align: center;font-size: 1.2rem;"><?=$products['name']?></h3>
                                    <?= ArticleImageWidget::widget(['id' =>$products['id'],'articleImageId'=>array($products['articleImages'])]); ?>
                                    <?php echo isset($variant['description']) ? $variant['description'] : "";?>
                                </div>
                                <p class="price"> <?=number_format( $products['articlePrices']['0']['price'], 2, '.', '');?> €</p>
                                <div class="product-price-brutto justify-content-md-center" style="font-size: 1rem">
                                    <?php print_r(number_format($products['articlePrices']['0']['price'] + $products['articlePrices']['0']['price']*Yii::$app->params['STEUERSATZ'] , 2, '.', ''));?> € inkl. <?= Yii::$app->params['STEUERSATZTEXT'];?> MwSt.
                                    <?= Html::submitButton('auswählen',
                                        ['style'=>'vertical-align: bottom; width: 100%;',
                                            'class' => 'border mobile-fill anim-1 show align-self-end step-four',
                                            'id' => 'button-'.$products['id'] ,'name' => 'productid-'.$products['id'] ,
                                            'data-id'=>$products['id'],'data-name'=>$products['name'],'data-price' =>$products['articlePrices']['0']['price'],'data-slug'=>$slug]);
                                    ?>
                                </div>
                            </div>
                        </div>

                    <?php } endforeach;


                ?>
                    <?= Html::submitButton('Ohne Auswahl weiter',
                        ['style'=>'vertical-align: bottom; width: 100%;',
                            'class' => 'border mobile-fill anim-1 show align-self-end without-choice','data-noPanel'=>1,'data-slug'=>$slug]);
                    ?>
        </div>
</div>


<?php

$this->registerJs("
$('.without-choice').click(function(event) {
var produktdata ={};
	var array= $(this).data();
		var array= $(this).data();
	for (var prop in array) {
		produktdata[prop]= array[prop];
	}
    $.ajax({
      type: 'POST',
      url: '/wizard/step-four',
      data:  produktdata,
      success: function (response) {       
      $('#stepthree').remove();
      $('#stepfour').remove();
      $('#stepfive').remove();
      $('#wizard').append(response);
      location.href = '#stepfour';
      },
      error: function(error) {
        console.log(error)
        alert('Data not saved');
      }
    });
    window.scroll({
  behavior: 'smooth'
});
    
});");
?>


<?php

$this->registerJs("
$('.step-four').click(function(event) {
	var produktdata ={};
	var array= $(this).data();
	for (var prop in array) {
		produktdata[prop]= array[prop];
	}
    $.ajax({
      type: 'POST',
      url: '/wizard/step-four',
      data:  produktdata,
      success: function (response) {
      $('#wizard').append(response);
      location.href = '#stepfour';
      },
      error: function(error) {
        console.log(error)
        alert('Data not saved');
      }
    });
    window.scroll({
  behavior: 'smooth'
});
    
});");
?>
