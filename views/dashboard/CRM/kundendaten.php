<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
    <div class="confirm" id="hero">
<?php $form = ActiveForm::begin(['options' => ['method' => 'post']]); ?>
    <div class="row"><div class="col" id="hero"><h3 class="panel-title">Kunden Erfassen</h3></div></div>
    <div class="row">
        <div class="col-6">
            <?= $form->field($model, 'personal_customer_type')->dropDownList(['PERSON' => 'Privatkunde', 'ORGANIZATION' => 'Firma'],['prompt'=>'Sie sind*'])->label(false); ?>

        </div>
        <div class="col-6">
            <?= $form->field($model, 'personal_salutation')->dropDownList(['MR' => 'Herr', 'MRS' => 'Frau'],['prompt'=>'Anrede*'])->label(false); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <?= $form->field($model, 'personal_firstname')->label(false)->textInput(['placeholder' => 'Vorname*']); ?>

        </div>

        <div class="col-6">
            <?= $form->field($model, 'personal_lastname')->label(false)->textInput(['placeholder' => 'Nachname*']); ?></div>

    </div>

    <div class="row">
        <div class="col-6">
            <?= $form->field($model, 'personal_email')->label(false)->textInput(['placeholder' => 'E-Mail-Adresse*']); ?>

        </div>
        <div class="col-6">
            <?= $form->field($model, 'personal_phone')->label(false)->textInput(['placeholder' => 'Telefon*']); ?>

        </div>
    </div>

    <div class="row">

        <div class="col-6">
            <?= $form->field($model, 'personal_password')->label(false)->passwordInput(['placeholder' => 'Passwort*' ,'value'=> $pass ,'readonly'=>'']); ?>
        </div>
        <div class="col-6">
            <?= $form->field($model, 'personal_passwordConfirmation')->label(false)->passwordInput(['placeholder' => 'Passwort Wiederholen*','value'=> $pass,'readonly'=>'']); ?>

        </div>
    </div>



    <div id="collapseBusiness" class="collapse" >
        <div class="row"><div class="col" id="hero"><h3 class="panel-title">Firma</h3></div></div>
        <div class="row">
            <div class="col-6"><?= $form->field($model, 'billing_company')->label(false)->textInput(['placeholder' => 'Firma*']); ?></div>
            <div class="col-6"><?= $form->field($model, 'billing_department')->label(false)->textInput(['placeholder' => 'Abteilung']); ?></div>
            <div class="col"><?= $form->field($model, 'billing_vatId')->label(false)->textInput(['placeholder' => 'Umsatzsteuer-ID*']); ?></div>
        </div>
    </div>

    <div class="row"><div class="col" id="hero"><h3 class="panel-title">Adresse</h3></div></div>
    <div class="row">
        <div class="col-6"><?= $form->field($model, 'billing_street')->label(false)->textInput(['placeholder' => 'Stra??e und Nr.*']); ?></div>
        <div class="col-6"><?= $form->field($model, 'billing_additionalAddressLine1')->label(false)->textInput(['placeholder' => 'Adresszusatz (z.B. Postnummer)']); ?></div>
        <div class="col-6"><?= $form->field($model, 'billing_zipcode')->label(false)->textInput(['placeholder' => 'Postleitzahl*']); ?></div>
        <div class="col-6"><?= $form->field($model, 'billing_city')->label(false)->textInput(['placeholder' => 'Stadt*']); ?></div>
        <div class="col-6">

            <?= $form->field($model, 'billing_country')->dropDownList($laender,['prompt'=>'Land*'])->label(false); ?>



        </div>
        <div class="col-6"><?= $form->field($model, 'billing_shippingAddress')->checkBox(['label' => 'Rechnungsanschrift abweichend','data-toggle'=>'collapse', 'aria-expanded'=>false, 'data-target'=>'#collapseOne','checked' => false]);?></div>
    </div>


    <div id="collapseOne" class="collapse">
        <div class="row"><div class="col" id="hero"><h3 class="panel-title">Rechnungsanschrift abweichend</h3></div></div>
        <div class="row">
            <div class="col-6"><?= $form->field($model, 'shipping_salutation')->dropDownList(['MR' => 'Herr', 'MRS' => 'Frau'],['prompt'=>'Anrede*'])->label(false); ?></div>
            <div class="col-6"><?= $form->field($model, 'shipping_company')->label(false)->textInput(['placeholder' => 'Firma']);  ?></div>
            <div class="col-6"><?= $form->field($model, 'shipping_department')->label(false)->textInput(['placeholder' => 'Abteilung']);?></div>
            <div class="col-6"><?= $form->field($model, 'shipping_firstname')->label(false)->textInput(['placeholder' => 'Vorname*']); ?></div>
            <div class="col-6"><?= $form->field($model, 'shipping_lastname')->label(false)->textInput(['placeholder' => 'Nachname*']); ?></div>
            <div class="col-6"><?= $form->field($model, 'shipping_street')->label(false)->textInput(['placeholder' => 'Stra??e und Nr.*']); ?></div>
            <div class="col-6"><?= $form->field($model, 'shipping_additionalAddressLine1')->label(false)->textInput(['placeholder' => 'Adresszusatz (z.B. Postnummer)']); ?></div>
            <div class="col-6"><?= $form->field($model, 'shipping_zipcode')->label(false)->textInput(['placeholder' => 'PLZ*']); ?></div>
            <div class="col-6"><?= $form->field($model, 'shipping_city')->label(false)->textInput(['placeholder' => 'Ort*']); ?></div>
            <div class="col-6"><?= $form->field($model, 'shipping_country')->dropDownList($laender,['prompt'=>'Land*'])->label(false); ?></div>
        </div>
    </div>

    <div class="row">

        <div class="col-6">
            <div class="form-group">
                <?= Html::submitButton('Weiter', ['class' => 'border mobile-fill']) ?>
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>
    </div>



<?php

$this->registerJs("$(function () {

if($('.confirm').length){
document.getElementById('account-personal_customer_type').onchange = function () {
if(document.getElementById('account-personal_customer_type').value == 'ORGANIZATION') {
$('#collapseBusiness').collapse('show');
}else{
$('#collapseBusiness').collapse('hide');
}
}
}

});");

?>
