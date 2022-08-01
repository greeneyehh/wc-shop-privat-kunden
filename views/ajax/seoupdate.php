
<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<?php $form = ActiveForm::begin(['action' => ['dashboard/setseoupdate'],'options' => ['method' => 'post']]); ?>
<h3 class="box-title"><?=$seodata['route'];?></h3>

<?= $form->field($seodata, 'route')->hiddenInput(['value'=> $seodata['route']])->label(false); ?>
<div class="row">
    <div class="col-sm-4">Title: </div>
    <div class="col-sm-8"><?= $form->field($seodata,'title')->label(false)->textInput(['value' =>  $seodata['title']]) ?></div>
</div>
<div class="row">
    <div class="col-sm-4">Keywords: </div>
    <div class="col-sm-8"><?= $form->field($seodata,'keywords')->label(false)->textInput(['value' =>  $seodata['keywords']]) ?></div>
</div>
<div class="row">
    <div class="col-sm-4">Description: </div>
    <div class="col-sm-8"><?= $form->field($seodata,'description')->label(false)->textInput(['value' =>  $seodata['description']]) ?></div>
</div>
<div class="row">
    <div class="col-sm-4">Canonical: </div>
    <div class="col-sm-8"><?= $form->field($seodata,'canonical')->label(false)->textInput(['value' =>  $seodata['canonical']]) ?></div>
</div>

<?= Html::submitButton('Speichern', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>
