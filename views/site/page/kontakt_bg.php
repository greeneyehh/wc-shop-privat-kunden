<?php


use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


?>
<div id="hero" class="row">
  <div class="col-12 col-lg-6">
    <h1>KONTAKT</h1>
    <h2 class="vary">Kontaktieren Sie uns</h2>
  </div>
</div>

<div class="row">

  <div class="col-12 col-lg-6 margin-b">
    <p>Wollen Sie mehr über unsere Lösungen erfahren oder haben Sie eine Frage? Schreiben Sie uns einfach! Wir melden uns bei Ihnen.</p>
    <div role="form" class="wpcf7" id="wpcf7-f48-o1" dir="ltr" lang="de-DE">
<div class="screen-reader-response"></div>
	<?php $form = ActiveForm::begin(['action' => ['kontakt'],'options' => ['method' => 'post']]); ?>
<div style="display: none;">
<input type="hidden" name="_wpcf7" value="48">
<input type="hidden" name="_wpcf7_version" value="5.1.3">
<input type="hidden" name="_wpcf7_locale" value="de_DE">
<input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f48-o1">
<input type="hidden" name="_wpcf7_container_post" value="0">
</div>
<div class="row">
<div class="col-6">
    <span class="wpcf7-form-control-wrap your-firstname">
        <?= $form->field($model, 'firstname')->label(false)->textInput(['placeholder' => 'Vorname*','class' =>'wpcf7-form-control wpcf7-text wpcf7-validates-as-required']); ?>
    </span>
  </div>
<div class="col-6">
    <span class="wpcf7-form-control-wrap your-lastname">
    	<?= $form->field($model, 'lastname')->label(false)->textInput(['placeholder' => 'Nachname*','class' =>'wpcf7-form-control wpcf7-text wpcf7-validates-as-required']); ?>
    </span>
  </div>
</div>
<p><span id="wpcf7-5d162694b4c5f" class="wpcf7-form-control-wrap your-subject-wrap" style="display:none !important; visibility:hidden !important;"><label class="hp-message">Bitte lasse dieses Feld leer.</label>
	<input class="wpcf7-form-control wpcf7-text" type="text" name="your-subject" value="" size="40" tabindex="-1" autocomplete="nope">
	</span></p>
<input type="hidden" name="your-type" value="Kontaktaufnahme" class="wpcf7-form-control wpcf7-hidden">
<div class="row">
<div class="col-6">
    <span class="wpcf7-form-control-wrap your-email">
      <?= $form->field($model, 'email')->label(false)->textInput(['placeholder' => 'Email*','class' =>'wpcf7-form-control wpcf7-text wpcf7-validates-as-required']); ?>
    </span>
  </div>
<div class="col-6">
    <span class="wpcf7-form-control-wrap your-tel">
    	 <?= $form->field($model, 'tel')->label(false)->textInput(['placeholder' => 'Telefon','class' =>'wpcf7-form-control wpcf7-text wpcf7-validates-as-required']); ?>
    </span>
  </div>
</div>
<p><span class="wpcf7-form-control-wrap your-message">
	
	
	<?= $form->field($model, 'message')->label(false)->textarea(['placeholder' => 'Nachricht','class' =>'wpcf7-form-control wpcf7-textarea']); ?>
</span></p>
<p class="required">*Pflichtfelder</p>
        <p>	<?= $form->field($model, 'yourcallback',
                ['template' => '<label>{input}{label}{error}</label>'])->checkBox(['aria-invalid'=>false,'label'=> '<label for="contactform-yourcallback">Bitte rufen Sie mich zurück</label>']);?>
        </p>
        <?= $form->field($model, 'youraccept',
        ['template' => '{input}{label}{error}'])->checkBox(['aria-invalid'=>false,'label'=> '<label for="contactform-youraccept">Ich habe die <a target="_blank" href="'.Url::to('@web/datenschutzerklaerung').'">Datenschutzbestimmung</a> gelesen.</label>']);?>
        <?= $form->field($model, 'reCaptcha')->widget(\himiklab\yii2\recaptcha\ReCaptcha::className()) ?>
<input type="submit" value="Absenden" class="wpcf7-form-control wpcf7-submit border" id="myBtn" disabled=""><span class="ajax-loader"></span></p>
<div class="wpcf7-response-output wpcf7-display-none"></div>




        <?php ActiveForm::end(); ?></div>  </div>
 
  <div class="col-12 col-lg-6 margin-b">
    <div class="row">
      <div class="col-7 col-sm-8 col-lg-7 margin-b">
        <h3 class="vary">Vertrieb</h3>
        <p>Sie haben Interesse an unseren Produkten?<br>Kontaktieren Sie unser Vertriebsteam! Wir beraten Sie gerne.</p>
        <a class="icon-phone" href="tel:+4946626148590">04662 / 6148590</a><br>
        <a class="icon-mail" href="mailto:moin@windcloud.de">moin@windcloud.de</a>
      </div>
      <div class="col-5 col-sm-4 col-lg-5">
        <div class="bg-white border-radius-d box-shadow">
          <div class="pic">
            <img srcset="<?= Url::to('@web/image/thomas-reimers-foto.1024x1024.jpg');?> 1024w, <?= Url::to('@web/image/thomas-reimers-foto.1024x1024-150x150.jpg');?> 150w, <?= Url::to('@web/image/thomas-reimers-foto.1024x1024-300x300.jpg');?> 300w, <?= Url::to('@web/image/thomas-reimers-foto.1024x1024-768x768.jpg');?> 768w" sizes="(min-width: 1200px) 255px, (min-width: 992px) 210px, (min-width: 768px) 150px, (min-width: 576px) 240px, calc(50vw - 30px)" src="<?= Url::to('@web/image/thomas-reimers-foto.1024x1024.jpg');?>" alt="Thomas Reimers" title="Thomas Reimers">          </div>
          <div class="p-3 p-sm-4">
            <h5 class="vary m-0">Geschäftsführer</h5>
            <h4 class="vary xs">Thomas<br>Reimers</h4>
          </div>
        </div>
      </div>
    </div>
    <div>
      <h3 class="vary">Support</h3>
      <p>Unser Expertenteam steht Ihnen bei Problemen und Fragen zu Ihren Produkten 24/7 zur Verfügung.</p>
      <a class="icon-phone" href="tel:+4946626148591">04662 / 6148591</a><br>
      <a class="icon-mail" href="mailto:support@windcloud.de">support@windcloud.de</a>
    </div>
  </div>
</div>



<?php
$script = <<< JS
    $('#contactform-youraccept').change(function() {
        if(this.checked ==true){
        document.getElementById("myBtn").disabled = false;    
        }else{
            document.getElementById("myBtn").disabled = true;
        }
        
    });
JS;
$this->registerJs($script);
?>