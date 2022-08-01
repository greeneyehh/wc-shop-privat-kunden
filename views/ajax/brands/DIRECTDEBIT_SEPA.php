<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

?>
<div class="container">
    <div class="hero" id="hero">
        <h2></h2>
    </div>


<div class="bg-c-white border-radius-d margin-b pad p-5" id="SEPA">
    <h3 class="vary mb-4">SEPA-Lastschriftmandat</h3>
    <p class="text-center mb-5" style="color:#004477;">
        Ich/Wir ermächtige(n) die Windcloud 4.0 GmbH Zahlungen von meinem/unserem Konto mittels Lastschrift
        einzuziehen. Zugleich weise(n) ich/wir mein/unser Kreditinstitut an, die von auf mein/unser Konto gezogenen Lastschriften einzulösen.
        Hinweis: Ich kann/Wir können innerhalb von acht Wochen, beginnend mit dem Belastungsdatum, die Erstattung des belasteten Betrags verlangen. Es gelten dabei die mit meinem/unserem Kreditinstitut vereinbarten Bedingungen.
    </p>
    <?php $form = ActiveForm::begin(['id' => 'SEPA-form','action' => ['dashboard/thanks?data='.$data],'options' => ['method' => 'post'],'class' => 'needs-validation']); ?>
        <div class="form-row">
            <div class="col-md-12 mb-6">
                <?= $form->field($model, 'holder')->label(false)->textInput(['placeholder' => 'Kontoinhaber (Vorname, Nachname)','class' =>'form-control border']) ?>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-12 mb-6">
                <?= $form->field($model, 'IBAN')->label(false)->textInput(['placeholder' => 'IBAN','class' =>'form-control border','id'=>'iban']) ?>
            </div>
            <div class="col-md-6 mb-3 text-left">
                <a href="/checkout/summary" class="btn border anim-1 show">Zurück</a>
            </div>
            <div class="col-md-6 mb-3 text-right">
                <?= Html::submitButton('Mandat Erteilen', ['class' => 'btn border anim-1 show']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</div>
</div>

<?php
$this->registerCssFile("/css/cms/style-SEPA.css");
?>
<?php
$this->registerJsFile("/js/iban.js");
?>
<?php

$this->registerJs("
$( document ).ready(function() {
const iban = document.getElementById('iban');
iban.addEventListener('focusout', (event) => { 
if (IBAN.isValid(iban.value)) {
  var str = iban.value
  var res = str.replaceAll(' ', '').replaceAll(':', '').replaceAll(',', '').replaceAll('.', '').replaceAll('--', '');
  iban.value =res.trim();

console.log('ok');
}

});

});
");

?>

