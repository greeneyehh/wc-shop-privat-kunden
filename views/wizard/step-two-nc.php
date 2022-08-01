<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="card" id="steptwo">
    <div class="card-header border-radius-d cart-card-addon" style="text-align: center;">
        <h3 class="vary">DOMAIN-ERWEITERUNG</h3>
        <h1>Nutzen Sie Ihre eigene Domain mit vorhandenem DNS-Record für die Nextcloud.</h1>
    </div>
        <div class="card-body row justify-content-md-center" align="center" valign="center">

<?php
                   foreach ($data as $products):?>

                       <div class="col-12 col-md-6 col-lg-4 mb-4" >
                           <div class="border-radius-d box-shadow p-3 justify-content-md-center" style="text-align:center;background-color: #ffffff;height: 100%;">

                               <div class="textwizard"> <h3 class="vary" style="text-align: center;font-size: 1.5rem;"><?=$products['name'];?></h3><?=$products['description'];?>
                               </div>
                               <p class="price"> <?=$products['articlePrices']['0']['price'];?> €</p>
                               <div class="product-price-brutto justify-content-md-center" style="font-size: 1rem">
                                   <?php print_r($products['articlePrices']['0']['price'] + $products['articlePrices']['0']['price']*Yii::$app->params['STEUERSATZ']  );?> € inkl. <?= Yii::$app->params['STEUERSATZTEXT'];?> MwSt.
                                   <?= Html::submitButton('auswählen',
                                       ['style'=>'vertical-align: bottom; width: 100%;',
                                           'class' => 'border mobile-fill anim-1 show align-self-end step-three',
                                           'id' => 'button-'.$products['id'] ,'name' => 'productid-'.$products['id'] ,
                                           'data-id'=>$products['id'],'data-name'=>$products['name'], 'data-DomainExtension'=>'' ,'data-option'=>[],
                                           'data-weclapp' => '1' ,'data-price' =>$products['articlePrices']['0']['price'] ,
                                           'data-extensionAllowed'=> ($products['shortDescription1'] == 'addon') ? '1' : '0','data-slug'=>$slug]);
                                   ?>

                               </div>
                           </div>
                       </div>





                   <?php
                   endforeach;?>
            <?= Html::submitButton('Weiter ohne Domain Erweiterung',
                ['style'=>'vertical-align: bottom; width: 100%;',
                    'class' => 'border mobile-fill anim-1 show align-self-end without-choice-two','data-noPanel'=>1,'data-slug'=>$slug]);
            ?>

        </div>
</div>


<?php

$this->registerJs("
$('.without-choice-two').click(function(event) {
var produktdata ={};
	var array= $(this).data();
		var array= $(this).data();
	for (var prop in array) {
		produktdata[prop]= array[prop];
	}
    $.ajax({
      type: 'POST',
      url: '/wizard/step-three',
      data:  produktdata,
      success: function (response) {       
      $('#stepfive').remove();
      $('#stepthree').remove();
      $('#wizard').append(response);
      location.href = '#stepthree';
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
$('.step-three').click(function(event) {
	var produktdata ={};
	var array= $(this).data();
	for (var prop in array) {
		produktdata[prop]= array[prop];
	}
    $.ajax({
      type: 'POST',
      url: '/wizard/step-three',
      data:  produktdata,
      success: function (response) {
      $('#stepthree').remove();
      $('#stepfour').remove();
      $('#stepfive').remove();
      $('#wizard').append(response);
      location.href = '#stepthree';
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
