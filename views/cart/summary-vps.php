<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
$price =null;
?>
 <div class="card">
        <div class="card-header border-radius-d cart-card-addon" style="text-align: center;">
            Soll das Produkt so in den Warenkorb hinzugefügt werden
        </div>
        <div class="card-body">

                <table class="table">
                    <tbody>

                          <?php foreach ($data as $products):?>
                            <tr>
                                <td><span class="pad"><?= $products['name']; ?></span></td>
                                <td class="right"><?= number_format($products['price'], 2, ",", "."); ?> €</td>
                                <?php $price = $products['price']?>
                            </tr>
                          <?php endforeach;
                          foreach ($data['0']['option'] as $option):?>
                              <tr>
                                <td><span class="pad"><?= $option['name']; ?></span></td>
                                <td class="right"><?= number_format($option['price'], 2, ",", "."); ?> €</td>
                                  <?php $price += $option['price']?>
                              </tr>
                          <?php endforeach; ?>
                    </tbody>
                </table>
            <div class="row">
                <div class="col-7 left"></div>
                <div class="col-5 right"><span class="sumsummary">Bestellwert: <?= number_format($price, 2, ",", "."); ?> €</span></div>
            </div>
            <?php number_format($steuer = $price / 100 * Yii::$app->params['STEUERSATZVOLL'], 2, ",", "."); ?>
            <div class="row">
                <div class="col-6 left"></div>
                <div class="col-6 right">Gesamtsumme:</div>
            </div>
            <div class="row">
                <div class="col-6 left"></div>
                <div class="col-6 right">(inkl. MwSt.)  <?= number_format($steuer + $price, 2, ",", "."); ?> €</div>
            </div>
        </div>
    </div>
<div class="row">
    <div class="col-6 right"><a class="border mobile-fill anim-1 show" data-dismiss="modal" aria-label="Close">weitere Produkte</a></div>
    <div class="col-6 left">
        <?= Html::submitButton('In den Warenkorb',
            ['style'=>'vertical-align: bottom; width: 100%;',
                'class' => 'border mobile-fill anim-1 show invert ajax-add-vps-to-cart',
                'id' => 'button-'.$products['id'] ,'name' => 'productid-'.$products['id']]);
        ?>
    </div>
</div>



<?php
$this->registerCssFile("/css/cms/style-cart-summary.css");
?>

<?php

$this->registerJs("

$('#exampleModalLongTitle').text('');
$('.btn-ajax').click(function (){
var elm = $(this),
ajax_body = elm.attr('value');
window.location.href =ajax_body;
});

");


$this->registerJs(
    "$('.ajax-add-vps-to-cart').click(function(event) {
	$.ajax({
      type: 'POST',
      url: '/cart/ajax-add-vps-to-cart',
      data:  {
          id: 'addcart',
        },
    });
});"
);

?>
