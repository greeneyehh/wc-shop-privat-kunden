<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Account */
/* @var $form ActiveForm */
?>
<div class="container">
    <div class="confirm" id="hero">
         <div class="card-body login-card-body" style="border-radius: 1rem 0 1rem 0;">
                <p></p>
                <?php $form = ActiveForm::begin(['options' => ['method' => 'post']]); ?>
                <div class="row"><div class="col" id="hero"><h3 class="panel-title">Kundenkonto erstellen</h3></div></div>
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
                        <?= $form->field($model, 'personal_password')->label(false)->passwordInput(['placeholder' => 'Passwort*']); ?>

                    </div>
                    <div class="col-6">
                        <?= $form->field($model, 'personal_passwordConfirmation')->label(false)->passwordInput(['placeholder' => 'Passwort Wiederholen*']); ?>

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
                    <div class="col-6"><?= $form->field($model, 'billing_street')->label(false)->textInput(['placeholder' => 'Straße und Nr.*']); ?></div>
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
                        <div class="col-6"><?= $form->field($model, 'shipping_street')->label(false)->textInput(['placeholder' => 'Straße und Nr.*']); ?></div>
                        <div class="col-6"><?= $form->field($model, 'shipping_additionalAddressLine1')->label(false)->textInput(['placeholder' => 'Adresszusatz (z.B. Postnummer)']); ?></div>
                        <div class="col-6"><?= $form->field($model, 'shipping_zipcode')->label(false)->textInput(['placeholder' => 'PLZ*']); ?></div>
                        <div class="col-6"><?= $form->field($model, 'shipping_city')->label(false)->textInput(['placeholder' => 'Ort*']); ?></div>
                        <div class="col-6"><?= $form->field($model, 'shipping_country')->dropDownList($laender,['prompt'=>'Land*'])->label(false); ?></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        Bitte beachten Sie unsere Hinweise zum <a title="Datenschutzbestimmungen" href="/datenschutzerklaerung" target="_blank">Datenschutz</a>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <?= Html::submitButton('Weiter', ['class' => 'border mobile-fill float-right']) ?>
                        </div>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            </div>
        </div>

    </div><!-- confirm -->





</div><!-- confirm -->

<?php
$this->registerCssFile("/css/cms/style-summary.css");
?>




