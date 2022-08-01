<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="card card-primary " style="overflow: auto">
    <div class="card-header box-header-windcloud">
        <h3 class="card-title"><i class="fa fa-reorder" aria-hidden="true"></i>Pressespiegel Erstellen</h3>
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
        <div class="col-sm-4 row"><div class="col-sm-6"><a class="btn btn-primary" href="/dashboard/newsmanager">Abbrechen</a></div><div class="col-sm-6"><?= Html::submitButton('Speichern', ['class' => 'btn btn-primary']) ?></div></div>
    </div>
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
moment().format('DD-MM-YYYY, h:mm:ss'); // November 16th 2020, 4:41:38 pm
$(function () {
  $('#datetimepicker1').datetimepicker({
  timeZone: 'Europe/Berlin',
format: 'YYYY-MM-DD H:mm:ss',
   });
    });
  });");
?>

