<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
    <?php $form = ActiveForm::begin(['action' => ['produkt-kontakt'],'options' => ['method' => 'post','class'=>'wpcf7-form']]); ?>


    <div class="row new">
        <div class="col-12 col-sm-5 col-md-12 col-lg-5">
            <span class="wpcf7-form-control-wrap your-firstname d-block mb-3">
                <?= $form->field($modelProduktContact, 'subject')->hiddenInput(['value'=> $produkt])->label(false);?>
                <?= $form->field($modelProduktContact, 'firstname')->label(false)->textInput(['size'=>'40','placeholder' => 'Vorname*','class' =>'wpcf7-form-control wpcf7-text wpcf7-validates-as-tel']); ?>
            </span>
            <span class="wpcf7-form-control-wrap your-lastname d-block mb-3">
                <?= $form->field($modelProduktContact, 'lastname')->label(false)->textInput(['placeholder' => 'Nachname*','class' =>'wpcf7-form-control wpcf7-text ','aria-required'=>'true','aria-invalid'=>'false']); ?>
            </span>
            <span class="wpcf7-form-control-wrap your-email d-block mb-3">
                <?= $form->field($modelProduktContact, 'email')->label(false)->textInput(['placeholder' => 'Email*','class' =>'wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-email']); ?>
            </span>
            <span class="wpcf7-form-control-wrap your-tel d-block mb-3">
                <?= $form->field($modelProduktContact, 'tel')->label(false)->textInput(['placeholder' => 'Telefon','class' =>'wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-tel']); ?>
            </span>

        </div>

        <div class="col-12 col-sm-7 col-md-12 col-lg-7"><p><span id="wpcf7-5d15ce4cdc919" class="wpcf7-form-control-wrap your-subject-wrap" style="display:none !important; visibility:hidden !important;">
            <span class="wpcf7-form-control-wrap your-message">
                    <?= $form->field($modelProduktContact, 'message')->label(false)->textarea(['placeholder' => 'Nachricht','class' =>'wpcf7-form-control wpcf7-textarea']); ?>
            </span>
                 <span class="wpcf7-form-control-wrap your-callback">
                    <span class="wpcf7-form-control wpcf7-checkbox">
                              <?= $form->field($modelProduktContact, 'yourcallback',
                                ['template' => '<label>{input}{label}{error}</label>'])->checkBox(['aria-invalid'=>false,'label'=> '<label for="contactform-yourcallback">Bitte rufen Sie mich zurück</label>']);?>
                    </span>
                </span>
                <span class="wpcf7-form-control-wrap your-accept">
                    <span class="wpcf7-form-control wpcf7-acceptance">
                            <?= $form->field($modelProduktContact, 'youraccept',
                                    ['template' => '{input}{label}{error}'])->checkBox(['aria-invalid'=>false,'label'=> '<label for="contactform-youraccept"><span class="wpcf7-list-item-label">Ich habe die <a target="_blank" href="'.Url::to('@web/datenschutzerklaerung').'">Datenschutzbestimmung</a> gelesen.</span></label>']);?>

                    </span>
                </span>

                <?= $form->field($modelProduktContact, 'reCaptcha')->widget(\himiklab\yii2\recaptcha\ReCaptcha::className()) ?>
                <input type="submit" value="Absenden" class="wpcf7-form-control wpcf7-submit border">
                <span class="ajax-loader"></span>
            </p>

        </div>
    </div>
<?php ActiveForm::end(); ?>