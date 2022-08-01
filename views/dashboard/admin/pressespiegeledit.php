<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="card card-primary " style="overflow: auto">
    <div class="card-header box-header-windcloud">
        <h3 class="card-title"><i class="fa fa-reorder" aria-hidden="true"></i>Pressespiegel Update</h3>
    </div>
    <div class="card-body" style="min-height: 500px" >
    <?php $form = ActiveForm::begin(['options' => ['method' => 'post']]); ?>
    <div class="row">
        <div class="col-sm-4">Medium: </div>
        <div class="col-sm-8"><?= $form->field($pressespiegeldata,'medium')->label(false)->textInput(['style' => 'text-transform: lowercase','id'=>'slug']) ?></div>
    </div>
    <div class="row">
        <div class="col-sm-4">Title: </div>
        <div class="col-sm-8"><?= $form->field($pressespiegeldata,'titel')->label(false)->textInput() ?></div>
    </div>
    <div class="row">
        <div class="col-sm-4">Link: </div>
        <div class="col-sm-8"><?= $form->field($pressespiegeldata,'link')->label(false)->textInput() ?></div>
    </div>
    <div class="row">
        <div class="col-sm-4">Datum: </div>
        <div class="col-sm-8"><?= $form->field($pressespiegeldata,'datetime')->label(false)->textInput(['data-target'=> '#datetimepicker6','class'=>'datetimepicker-input','placeholder'=>'2020-08-18 00:00:00','id'=>'datetimepicker1']) ?></div>
    </div>
    <div class="row">
        <div class="col-sm-8"></div>
        <div class="col-sm-4 row"><div class="col-sm-6"><a class="btn btn-primary" href="/dashboard/pressespiegel">Abbrechen</a></div><div class="col-sm-6"><?= Html::submitButton('Speichern', ['class' => 'btn btn-primary']) ?></div></div>
    </div> <p>
    <?php ActiveForm::end(); ?>
</div>
</div>
<?php
$this->registerCssFile("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css");
$this->registerCssFile("/css/bootstrap-datetimepicker.css");
?>
<?php
$this->registerJsFile("https://code.jquery.com/jquery-3.5.1.js");
$this->registerJsFile("https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js");
$this->registerJsFile(Yii::$app->request->BaseUrl . "/js/bootstrap-datetimepicker.min.js", ['depends' => [yii\web\JqueryAsset::className()]])?>


<?php
$this->registerJs("$( document ).ready(function() {
   $('#summernote').summernote({
  toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['fontname', ['fontname']],
    ['color', ['color']],
    ['table', ['table']],
    ['picture', ['picture']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']],
    ['insert', ['link', 'picture', 'video']],
    ['view', ['fullscreen', 'codeview', 'help']],
    ['lineHeights',  ['0.2', '0.3', '0.4', '0.5', '0.6', '0.8', '1.0', '1.2', '1.4', '1.5', '2.0', '3.0']],
  ],
  height: 600, 
})
const slug = document.getElementById('slug');
slug.addEventListener('focusout', (event) => { 
  var str = slug.value
  var res = str.replaceAll(' ', '-').replaceAll(':', '-').replaceAll(',', '-').replaceAll('.', '').replaceAll('--', '');
  slug.value =res.trim();
  console.log(res.trim());
});
moment().format('DD-MM-YYYY, h:mm:ss'); // November 16th 2020, 4:41:38 pm
$(function () {
  $('#datetimepicker1').datetimepicker({
  timeZone: 'Europe/Berlin',
format: 'YYYY-MM-DD H:mm:ss',
   });
    });
  });");
?>


