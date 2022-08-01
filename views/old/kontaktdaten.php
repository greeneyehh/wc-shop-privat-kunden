 <?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Kontaktdaten';

?>
<div class="site-kontaktdaten">
    	<div class="cart">
    		<h2>Kontaktdaten</h2>
    		<?php $form = ActiveForm::begin(['method' => 'post','action' => ['kontaktdaten']]); ?>	
				<div class="row">
					<div class="col-lg-6">
					<?= $form->field($model,'street')->label(false)->textInput(['placeholder' => "Strasse"]) ?>
					</div>
					<div class="col-lg-6">
					<?= $form->field($model,'streetnumber')->label(false)->textInput(['placeholder' => "Hausnummer"]) ?>
					</div>
					<div class="col-lg-6">
					<?= $form->field($model,'plz')->label(false)->textInput(['placeholder' => "Postleitzahl"]) ?>
					</div>
					<div class="col-lg-6">
					<?= $form->field($model,'ort')->label(false)->textInput(['placeholder' => "Ort"]) ?>
					</div>
					<div class="col-lg-6">
					<?= $form->field($model,'email')->label(false)->textInput(['placeholder' => "Email"]) ?>
					</div>
					<div class="col-lg-6">
					<?= $form->field($model,'phonenumber')->label(false)->textInput(['placeholder' => "Telefonnummer"]) ?>
					</div>
					
					<div class="col-lg-6">
					<?= $form->field($model,'website')->label(false)->textInput(['placeholder' => "Website"]) ?>
					</div>	
					<div class="col-lg-12">
						<?= Html::submitButton('Weiter', ['class' => 'order-btn border-btn']) ?>
					</div>
				</div>
			<?php ActiveForm::end(); ?>
		</div>
</div>
