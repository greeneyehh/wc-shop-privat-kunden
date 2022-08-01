<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<?php $form = ActiveForm::begin(['options' => ['method' => 'post']]); ?>
<?= $form->field($newsdata, 'id')->hiddenInput(['id'=> $newsdata->id])->label(false);?>
<div class="card card-primary " style="overflow: auto">
    <div class="card-header box-header-windcloud">
        <h3 class="card-title"><i class="fa fa-reorder" aria-hidden="true"></i>News Löschen</h3>
    </div>
    <div class="card-body" style="min-height: 500px" >
<div class="container">
	<div id="hero" class="row">
		<div class="col col-xl-9">
			<h5 class="vary"><?=  $newsdata->datetime;?></h5>
			<h1><?=$newsdata->titel;?></h1>
		</div>
	</div>

    <?php $form->field($newsdata, 'id')->hiddenInput()->label(false); ?>

<div class="content margin-b">
	<?=$newsdata->description;?>
</div>
</div>
    </div>
<div class="card-footer text-muted">

        <a class="btn btn-primary float-left" href="/dashboard/newsmanager">Abbrechen</a><?= Html::submitButton('Löschen', ['class' => 'btn btn-danger float-right']) ?>


</div>


</div>
<?php ActiveForm::end(); ?>
    <?php
    $this->registerCssFile("/css/cms/style-news.css");
    ?>