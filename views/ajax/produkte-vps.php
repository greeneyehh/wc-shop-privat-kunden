<?php

$this->title = Yii::$app->name;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

use app\extensions\greendev\weclapp\widgets\variantInfoWidget;

?>
    <?php foreach ($model['result'] as $products): ?>

        <div class="row row-eq-height justify-content-center align-middle" style="margin-top: 25px;">
    <?php foreach ($products['variants'] as $productsid): ?>
        <?php $variant= json_decode(variantInfoWidget::widget(['id' => $productsid['articleId']]),true);
            if(!isset($variant['shortDescription2']))
            {
                array_push($variant, "shortDescription2");
                $variant['shortDescription2'] = null;
            }else{
                $letters = array('Jährlich für ', 'Monatlich für ');
                $output  = str_replace($letters, '', $variant['shortDescription2']);
            }
        ?>
        <div class="col-12 col-md-6 col-lg-3 col-xs-4 mb-4" ">
                    <div class="border-radius-d box-shadow p-3" style="background-color: #ffffff;height: 100%;">
                        <?=$variant['longText']?>
                       <p> <?=$output;?></p>
                    <div class="product-price-brutto" style="font-size: 1rem">
                        <?php print_r($variant['articlePrices']['0']['price'] + $variant['articlePrices']['0']['price']*Yii::$app->params['STEUERSATZ']  );?> € inkl. <?= Yii::$app->params['STEUERSATZTEXT'];?> MwSt.
                        <?= Html::submitButton('auswählen',
                                ['style'=>'vertical-align: bottom; width: 100%;',
                                'class' => 'border mobile-fill anim-1 show align-self-end add-to-cart-modal-ajax',
                                'id' => 'button-'.$variant['id'] ,'name' => 'productid-'.$variant['id'] ,
                                'data-id'=>$variant['id'],'data-name'=>$variant['name'], 'data-DomainExtension'=>'' ,'data-option'=>[],
                                'data-weclapp' => '1' ,'data-price' =>$variant['articlePrices']['0']['price'] ,
                                'data-extensionAllowed'=> ($variant['shortDescription1'] == 'addon') ? '1' : '0']);
                        ?>
                    </div>
                </div>
                </div>

    <?php  endforeach; ?>

        </div>
<?php  endforeach; ?>



<?php

$this->registerJs(
    "$('.add-to-cart-modal-ajax').click(function(event) {
    $(this).find('.modal-body' ).html( '<div class=\"row\"><div class=\"col-12\"><div class=\"overlay loadingcolor\"><i class=\"fa fa-refresh fa-spin fa-3x fa-fw loadingcolor\"></i></div></div></div>' );
	var produktdata ={};
	var array= $(this).data();
	for (var prop in array) {
		produktdata[prop]= array[prop];
	}
	$('#exampleModalLongTitle').text('');
	$.ajax({
      type: 'POST',
      url: '/cart/ajax-vps-add',
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
$this->registerCssFile("/css/cms/style-variant-".count($products['variants']).".css");
?>