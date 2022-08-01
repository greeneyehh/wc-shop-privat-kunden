<?php
$this->title = Yii::$app->name;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

use app\extensions\greendev\weclapp\widgets\variantInfoWidget;
?>
    <div class="row row-eq-height justify-content-center align-middle" style="margin-top: 25px;">

<?php

foreach ($data['result'] as $products): ?>

        <?php
        if($idlastarray !== null){
            if(array_search($products['id'], array_column($tempArray[$idlastarray]['option'], 'id')) !== False) {?>
        <?php if(!isset($products['shortDescription2']))
        {
        array_push($products, "shortDescription2");
        $products['shortDescription2'] = null;
        }else{
        $letters = array('Jährlich für ', 'Monatlich für ','einmalige Zahlung von ');
        $output  = str_replace($letters, '', $products['shortDescription2']);
        }
        ?>


        <div class="col-12 col-md-6 col-lg-3 col-xs-4 mb-4" ">
        <div class="border-radius-d box-shadow p-3" style="background-color: #ffffff;height: 100%; opacity: .2">
            <h3 class="vary" style="min-height: 29px;"><?=$products['name']?></h3>
            <p>
                <?= $products['description'];?>
                <?php if ($products['shortDescription1'] == 'domain')
                {
                    ?>
                        <input type="text" id="DomainExtension" class="customdomain form-control border wpcf7-form-control wpcf7-text wpcf7-validates-as-required" name="Domain" style="width: 100%;" placeholder="Domain" aria-required="true">
                <?php } ?>
            </p>
            <div class="product-price-brutto" style="font-size: 1rem">
                <p><?=$output;?></p>
                <?=$products['longText']?>
                <?php print_r($products['articlePrices']['0']['price'] + $products['articlePrices']['0']['price']*Yii::$app->params['STEUERSATZ']  );?> € inkl. <?= Yii::$app->params['STEUERSATZTEXT'];?> MwSt.
                <?= Html::submitButton('Löschen',
                    ['style'=>'vertical-align: bottom; width: 100%;',
                        'class' => 'border mobile-fill anim-1 show align-self-end del-addon-from-cart-modal-ajax',
                        'id' => 'button-'.$products['id'] ,'name' => 'productid-'.$products['id'] ,
                        'data-id'=>$idlastarray,'data-key'=> $products['id']]);
                ?>
            </div>
        </div>
    </div>
        <?php }else{

        if(!isset($products['shortDescription2']))
        {
            array_push($products, "shortDescription2");
            $products['shortDescription2'] = null;
        }else{
            $letters = array('Jährlich für ', 'Monatlich für ','einmalige Zahlung von ');
            $output  = str_replace($letters, '', $products['shortDescription2']);
        }
        ?>

        <div class="col-12 col-md-6 col-lg-3 col-xs-4 mb-4" ">
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
                <?=$products['longText']?>
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


<?php  }
        }else{


        if(!isset($products['shortDescription2']))
        {
            array_push($products, "shortDescription2");
            $products['shortDescription2'] = null;
        }else{
            $letters = array('Jährlich für ', 'Monatlich für ','einmalige Zahlung von ');
            $output  = str_replace($letters, '', $products['shortDescription2']);
        }
        ?>

<div class="col-12 col-md-6 col-lg-3 col-xs-4 mb-4" ">
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
            <?=$products['longText']?>
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
<?php
$this->registerCssFile("/css/cms/style-variant-addon.css");
?>


<?php

$this->registerJs(
    "$('.add-to-cart-modal-addon-ajax').click(function(event) {
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
      url: '/cart/ajax-add-addon',
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
);

?>
<?php

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

?>
