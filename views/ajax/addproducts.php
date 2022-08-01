<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>
<?php $form = ActiveForm::begin(['action' => ['dashboard/addproducts'],'options' => ['method' => 'post']]); ?>
<div class="row">
   <div class="col-12">

        <?= $form->field($CustomerOrder, 'accountid')->hiddenInput(['value'=> $id])->label(false); ?>
        </div>
        <div class="col-12">
            Produkt:
            <?=$form->field($CustomerOrder, 'productid', ['template' => '{beginLabel}{labelTitle}{endLabel}{input}{error}{hint}'])->dropDownList($ShopCategoryProduct, ['class'=>'site-addon-select'])->label(false);?>
        </div>
        <div class="col-12">
            Domain:
            <?= $form->field($CustomerOrder, 'domain')->label(false)->textInput(['placeholder' => 'domain','class' =>'wpcf7-form-control wpcf7-text wpcf7-validates-as-required']); ?>
        </div>
        <div class="col-12">
             <?=$form->field($CustomerOrder, 'paycycle', ['template' => '{beginLabel}{labelTitle}{endLabel}{input}{error}{hint}'])->dropDownList($paycycle, ['class'=>'site-addon-select js-example-tags',])->label(false);?>
        </div>
        <div class="col-12">
            datum:
            <?= $form->field($CustomerOrder, 'lastpaydate')->label(false)->textInput(['placeholder' => 'TT.MM.JJJJ','class' =>'wpcf7-form-control wpcf7-text wpcf7-validates-as-required']); ?>
        </div>
        <div class="col-12">
            Bei Start bitte hier E-Mail eintragen sonst admin <br>
           <?= $form->field($CustomerOrder, 'username')->label(false)->textInput(['placeholder' => 'username','class' =>'wpcf7-form-control wpcf7-text wpcf7-validates-as-required']); ?>
        </div>
        <div class="col-12 row">
            <div class="col-8"> <?= $form->field($CustomerOrder, 'initialpasswort')->label(false)->textInput(['placeholder' => 'initialpasswort','class' =>'wpcf7-form-control wpcf7-text wpcf7-validates-as-required']); ?>  </div>
            <div class="col-4">  <button class="btn btn-default" type="button" onclick="generatePassword()">generiere Passwort</button>  </div>
        </div>

        <div class="col-12">
            <div class="checkbox">
                <label for="customerorder-active">
                    <input type="hidden" name="InvoiceCreate" value="0"><input type="checkbox" id="customerorder-active" name="InvoiceCreate" value="1">
                    <label for="contactform-youraccept">Rechnung Erstellen</label>
                </label>
                <p class="help-block help-block-error"></p>

            </div>
        </div>


        <div class="col-12">
            <?= $form->field($CustomerOrder, 'active',
                ['template' => '{input}{label}{error}'])->checkBox(['aria-invalid'=>false,'label'=> '<label for="contactform-youraccept">Produkt ist aktiv</label>']);?>
            <?= Html::submitButton('Produkt Zuweisen', ['class' => 'btn btn-default bordercart mobile-fill', 'name' => 'buy', 'value'=> 'true']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>

<?php
$this->registerJs("
$('.js-example-tags').select2({
});");
?>
<?php
$this->registerJs("

function generatePassword() {
var length = 12,
charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789',
retVal = '';
for (var i = 0, n = charset.length; i < length; ++i) {
retVal += charset.charAt(Math.floor(Math.random() * n));
}
document.getElementById('customerorder-initialpasswort').value = retVal;
}
");
?>
