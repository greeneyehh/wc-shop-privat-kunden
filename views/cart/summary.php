<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<?php //print_r($data); ?>


    <div class="card">
        <div class="card-header border-radius-d cart-card-addon" style="text-align: center;">
            Das Produkt wurde zum Warenkorb hinzugefügt
        </div>
        <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <td><span class="pad"><?= $data['name']; ?></span></td>
                            <td class="right"><?= number_format($data['articlePrices']['0']['price'], 2, ",", "."); ?> €</td>
                        </tr>
                    </tbody>
                </table>
            <div class="row">
                <div class="col-7 left"></div>
                <div class="col-5 right"><span class="sumsummary">Bestellwert: <?= number_format($data['articlePrices']['0']['price'], 2, ",", "."); ?> €</span></div>
            </div>
            <?php number_format($steuer = $data['articlePrices']['0']['price'] / 100 * Yii::$app->params['STEUERSATZVOLL'], 2, ",", "."); ?>
            <div class="row">
                <div class="col-6 left"></div>
                <div class="col-6 right">Gesamtsumme:</div>
            </div>
            <div class="row">
                <div class="col-6 left"></div>
                <div class="col-6 right">(inkl. MwSt.) <?= number_format($steuer + $data['articlePrices']['0']['price'], 2, ",", "."); ?> €</div>
            </div>
        </div>
    </div>
<div class="row">
    <div class="col-6 right"><a class="border mobile-fill anim-1 show" data-dismiss="modal" aria-label="Close">weitere Produkte</a></div>
    <div class="col-6 left"><button class="border mobile-fill anim-1 show invert btn-ajax" formaction="/cart" value="/cart">zum Warenkorb</button></div>
</div>



<?php
$this->registerCssFile("/css/cms/style-cart-summary.css");
?>

<?php

$this->registerJs("
$('.modal-xl').addClass('modal-lg');
$('.modal-xl').removeClass('modal-xl');
$('#exampleModalLongTitle').text('');
$('#variant-modal').on('hidden.bs.modal', function () {
  $('.modal-lg').addClass('modal-xl');
$('.modal-lg').removeClass('modal-lg');
});
$('.btn-ajax').click(function (){
var elm = $(this),
ajax_body = elm.attr('value');
window.location.href =ajax_body;
});

");
?>
