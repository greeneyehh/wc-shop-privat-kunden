<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="container">
    <?php $form = ActiveForm::begin(['options' => ['method' => 'post']]); ?>
    <h3 class="box-title"><?=$newsdata['slug'];?></h3>
    <div class="row">
        <div class="col-sm-4">Slug: </div>
        <div class="col-sm-8"><?= $form->field($newsdata,'slug')->label(false)->textInput(['value' =>  $newsdata['slug']]) ?></div>
    </div>
    <div class="row">
        <div class="col-sm-4">Title: </div>
        <div class="col-sm-8"><?= $form->field($newsdata,'titel')->label(false)->textInput(['value' =>  $newsdata['titel']]) ?></div>
    </div>
    <div class="row">
        <div class="col-sm-4">Datum: </div>
        <div class="col-sm-8"><?= $form->field($newsdata,'datetime')->label(false)->textInput(['value' =>  $newsdata['datetime'],'data-target'=> '#datetimepicker6','class'=>'datetimepicker-input']) ?></div>
    </div>
    <div class="row">
        <div class="col-sm-4">Description: </div>
    </div>
    <div class="row">
        <div class="col-sm-12"><?= $form->field($newsdata,'description')->textarea(['rows' => '6','value' =>  $newsdata['description'],'id'=>'summernote'])->label(false) ?></div>
    </div>
    <div class="row">
        <div class="col-sm-8"></div>
        <div class="col-sm-4 row"><div class="col-sm-6"><a class="btn btn-primary" href="/dashboard/newsmanager">Abbrechen</a></div><div class="col-sm-6"><?= Html::submitButton('Speichern', ['class' => 'btn btn-primary']) ?></div></div>
    </div> <p>
    <?php ActiveForm::end(); ?>
</div>
<?php
$this->registerJs("$( document ).ready(function() {
   $('#summernote').summernote({
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']]
    ]
    });
  });");
?>
