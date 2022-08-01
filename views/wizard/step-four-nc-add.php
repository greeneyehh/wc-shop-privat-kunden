<?php

use yii\helpers\Html;

?>
<div class="card-header border-radius-d cart-card-addon" style="text-align: center;">
    <h3 class="vary">Addons</h3>
    <h1>Wählen Sie optionale Addons für Ihre Nextcloud.</h1></div>
<div class="card-body row justify-content-md-center">

    <?php foreach ($data as $products):?>

<?php
    $exits=null;
    if(in_array($products['id'], array_column($WizardAddon, 'id'))){
        $exits='disabled';
    }
?>
        <div class="col-12 col-md-6 col-lg-4 mb-4" >
            <div class="border-radius-d box-shadow p-3 justify-content-md-center <?=$exits?>" style="text-align:center;background-color: #ffffff;height: 100%;">

                <div class="textwizard"> <h3 class="vary" style="text-align: center;font-size: 1.5rem;"><?=$products['name'];?></h3><?=$products['description'];?>
                </div>
                <p class="price"> <?= number_format($products['articlePrices']['0']['price'], 2, '.', '');?> €</p>
                <div class="product-price-brutto justify-content-md-center" style="font-size: 1rem">
                    <?php print_r(number_format($products['articlePrices']['0']['price'] + $products['articlePrices']['0']['price']*Yii::$app->params['STEUERSATZ'], 2, '.', ''));?> € inkl. <?= Yii::$app->params['STEUERSATZTEXT'];?> MwSt.
                    <?php
                    if($exits=='disabled'){
                        echo Html::submitButton('Auswahl Löschen',
                            ['style'=>'vertical-align: bottom; width: 100%;',
                                'class' => 'border mobile-fill anim-1 show align-self-end add-to-addons',
                                'id' => 'button-'.$products['id'] ,'name' => 'productid-'.$products['id'] ,
                                'data-id'=>$products['id'],'data-name'=>$products['name'],
                                'data-weclapp' => '1' ,'data-price' =>$products['articlePrices']['0']['price'],'data-DomainExtension'=>'' ,'data-delete'=>true,'data-slug'=>$slug]);
                    }else{
                        echo Html::submitButton('hinzufügen',
                            ['style'=>'vertical-align: bottom; width: 100%;',
                                'class' => 'border mobile-fill anim-1 show align-self-end add-to-addons',
                                'id' => 'button-'.$products['id'] ,'name' => 'productid-'.$products['id'] ,
                                'data-id'=>$products['id'],'data-name'=>$products['name'],
                                'data-weclapp' => '1' ,'data-price' =>$products['articlePrices']['0']['price'],'data-DomainExtension'=>'' ,'data-slug'=>$slug]);
                    }
                    ?>

                </div>
            </div>
        </div>
<?php endforeach;?>
<?= Html::submitButton('weiter',
    ['style'=>'vertical-align: bottom; width: 100%;',
        'class' => 'border mobile-fill anim-1 show align-self-end without-choice','data-noPanel'=>1,'data-slug'=>$slug]);
?>


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
      url: '/wizard/step-five',
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
<?php
$this->registerJs("
$('.add-to-addons').click(function(event) {
	var produktdata ={};
	var array= $(this).data();
	for (var prop in array) {
		produktdata[prop]= array[prop];
	}
    $.ajax({
      type: 'POST',
      url: '/wizard/ajax-add-addon',
      data:  produktdata,
      success: function (response) {
       $('#stepfive').remove();
      $('#wizard').find('#stepfour').html(response);
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
