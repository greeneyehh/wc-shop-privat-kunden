<?php

use yii\helpers\Html;

?>
<div class="card" id="stepfour">
    <div class="card-header border-radius-d cart-card-addon" style="text-align: center;">
        <h3 class="vary">Backup</h3>
        <h1>(Optional)</h1>
    <div class="card-body row justify-content-md-center">
            <?php
                   foreach ($backup as $products):
                    {

                        ?>

                        <div class="col-12 col-md-3 col-lg-3 col-xs-4 mb-4">
                            <div class="border-radius-d box-shadow p-3 optionsecoptions"  style="text-align:center;background-color: #ffffff;height: 100%;">
                                <div class="textwizard">
                                <h3 class="vary" style="text-align: center;font-size: 1.2rem;"><?=$products['name']?></h3>
                                    <?php
                                    if(isset($products['description'])) {
                                        echo $products['description'];
                                    }

                                    ?>
                                </div>

                                <p class="price"> <?=number_format( $products['articlePrices']['0']['price'], 2, '.', '');?> €</p>
                                <div class="product-price-brutto justify-content-md-center" style="font-size: 1rem">
                                    <?php print_r(number_format($products['articlePrices']['0']['price'] + $products['articlePrices']['0']['price']*Yii::$app->params['STEUERSATZ'] , 2, '.', ''));?> € inkl. <?= Yii::$app->params['STEUERSATZTEXT'];?> MwSt.
                                    <?= Html::submitButton('auswählen',
                                        ['style'=>'vertical-align: bottom; width: 100%;',
                                            'class' => 'border mobile-fill anim-1 show align-self-end step-five',
                                            'id' => 'button-'.$products['id'] ,'name' => 'productid-'.$products['id'] ,
                                            'data-id'=>$products['id'],'data-name'=>$products['name'],'data-customerid'=>$customerid,'data-price' =>$products['articlePrices']['0']['price'],'Backup' => 1]);
                                    ?>
                                </div>

                            </div>
                        </div>

                    <?php } endforeach;


                ?>
                    <?= Html::submitButton('Ohne Auswahl weiter',
                        ['style'=>'vertical-align: bottom; width: 100%;',
                            'class' => 'border mobile-fill anim-1 show align-self-end without-choice','data-customerid'=>$customerid,'data-noPanel'=>1]);
                    ?>
        </pre>

    </div>
</div>

<?php

$this->registerJs("
$('.without-choice').click(function(event) {
var produktdata ={};
	var array= $(this).data();
	for (var prop in array) {
		produktdata[prop]= array[prop];
	}
    $.ajax({
      type: 'POST',
      url: '/dashboard-wizard/step-five',
      data:  produktdata,
      success: function (response) {
      $('#stepfive').remove();
      $('#oderinfo').remove();
      $('#wizard').append(response);
      location.href = '#stepfive';
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
$('.step-five').click(function(event) {
	var produktdata ={};
	var array= $(this).data();
	for (var prop in array) {
		produktdata[prop]= array[prop];
	}
    $.ajax({
      type: 'POST',
      url: '/dashboard-wizard/step-five',
      data:  produktdata,
      success: function (response) {
      $('#stepfive').remove();
      $('#wizard').append(response);
      location.href = '#stepfive';
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
