<?php
$this->title = Yii::$app->name;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

use app\extensions\greendev\weclapp\widgets\variantInfoWidget;
?>
    <div class="row row-eq-height justify-content-center align-middle" style="margin-top: 25px;">

<?php foreach ($data['result'] as $products):

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

<div class="col-12 col-md-3 col-lg-3 col-xs-4 mb-4 ">
    <div class="border-radius-d box-shadow p-3" style="background-color: #ffffff;height: 100%;">
        <h3 class="vary" style="min-height: 29px;"><?=$products['name']?></h3>
        <p>
            <?= $products['description'];?>
            <?php if ($products['shortDescription1'] == 'domain'){?>
                <input type="text" id="DomainExtension" class="customdomain form-control border wpcf7-form-control wpcf7-text wpcf7-validates-as-required" name="Domain" style="width: 100%;" placeholder="Domain" aria-required="true">
            <?php } ?>
        </p>
        <div class="product-price-brutto" style="font-size: 1rem">
            <p><?=$output;?></p>
            <?php !isset($products['longText']) ?: $products['longText'];?>

            <?php print_r($products['articlePrices']['0']['price'] + $products['articlePrices']['0']['price']*Yii::$app->params['STEUERSATZ']  );?> € inkl. <?= Yii::$app->params['STEUERSATZTEXT'];?> MwSt.
            <?= Html::submitButton('hinzufügen',
                ['style'=>'vertical-align: bottom; width: 100%;',
                    'class' => 'border mobile-fill anim-1 show align-self-end add-to-cart-modal-addon-ajax',
                    'id' => 'button-'.$products['id'] ,'name' => 'productid-'.$products['id'] ,
                    'data-id'=>$products['id'],'data-name'=>$products['name'], 'data-DomainExtension'=>'' ,
                    'data-weclapp' => '1' ,'data-price' =>$products['articlePrices']['0']['price'],
                    'data-extensionAllowed'=> ($products['shortDescription1'] == 'domain') ? '1' : '0']);
            ?>
        </div>
    </div>
    </div>

<?php } endforeach; ?>
    </div>

<h3 class="vary" id="exampleModalLongTitle" style="text-align: center;width: 100%;padding-left: 10%;">Server Panel</h3>
    <div class="row row-eq-height justify-content-center align-middle" style="margin-top: 25px;">
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
    <div class="border-radius-d box-shadow p-3 optionsecoptions" id="<?=$products['id'];?>" style="background-color: #ffffff;height: 100%;">
        <h3 class="vary" style="min-height: 29px;"><?=$products['name']?></h3>
        <p>
            <?= $products['description'];?>
            <?php if ($products['shortDescription1'] == 'domain'){?>
                <input type="text" id="DomainExtension" class="customdomain form-control border wpcf7-form-control wpcf7-text wpcf7-validates-as-required" name="Domain" style="width: 100%;" placeholder="Domain" aria-required="true">
            <?php } ?>
        </p>
        <div class="product-price-brutto" style="font-size: 1rem">
            <p><?=$output;?></p>
            <?php !isset($products['longText']) ?: $products['longText'];?>

            <?php print_r($products['articlePrices']['0']['price'] + $products['articlePrices']['0']['price']*Yii::$app->params['STEUERSATZ']  );?> € inkl. <?= Yii::$app->params['STEUERSATZTEXT'];?> MwSt.

        </div>
    </div>
    </div>

<?php } endforeach;


?>

    </div>
<?php
$this->registerCssFile("/css/cms/style-variant-addon-vps.css");

$this->registerJs(
    "$('.add-to-cart-modal-addon-ajax').click(function(event) {
    var produktdata ={} ;
	var array= $(this).data();
	for (var prop in array) {
	
	console.log(prop)

		    produktdata[prop]= array[prop];
	    
	}
	$.ajax({
      type: 'POST',
      url: '/cart/ajax-add-vps-addon',
      data:  produktdata,
      success: function (response) {
      $('#variant-modal').removeData('bs.modal');
              $('#variant-modal').find('.modal-body').html(response);
              cartcount()
      },
      error: function(error) {
        console.log(error)
        alert('Data not saved');
      }
    });
});"
);$this->registerJs(
    "var selectedDiv = '';
    var x = document.getElementsByClassName('optionsecoptions')
    for (var i = 0; i < x.length; i++) {
    x[i].addEventListener(\"click\", function(){
    var selectedEl = document.querySelector(\".selected\");
    if(selectedEl){
        selectedEl.classList.remove(\"selected\");
    }
        this.classList.add(\"selected\");
    }, false);
}"
);
$this->registerJs(
    "$('.del-addon-from-cart-modal-ajax').click(function(event) {
    var produktdata ={} ;
	var array= $(this).data();
	for (var prop in array) {
		console.log(prop)
        if (prop == 'domainextension') {
            produktdata['domainextension']= document.getElementById('DomainExtension').value;
        }else {
		    produktdata[prop]= array[prop];
	    }
	}
    $.ajax({
      type: 'POST',
      url: '/cart/cart-addon-delete',
      data:  produktdata,
      success: function (response) {
      $('#variant-modal').removeData('bs.modal');
              $('#variant-modal').find('.modal-body').html(response).load(response, function() { });
              cartcount();
      },
      error: function(error) {
        console.log(error)
        alert('Data not saved');
      }
    });
});"
);
$this->registerCss("
.optionsecoptions:hover,
    .optionsecoptions:active {
        background-color: #004477!important;
        transition: background-color 0.4s ease-in, border-color 0.4s ease-in;
        color:#ffffff!important;
    }
    .selected {
            background-color: #004477!important;
            transition: background-color 0.4s ease-in, border-color 0.4s ease-in;
            color:#ffffff!important;    
    }
    .selected h3 ,.selected p ,.optionsecoptions:active h3 ,.optionsecoptions:active p,.optionsecoptions:hover h3 ,.optionsecoptions:hover p{
       color:#ffffff!important;    
    }
");
?>
