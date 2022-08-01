 <?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Firmendaten';

?>
<div class="site-kundendaten">
    	<div class="cart">
    		<h2>Firmendaten</h2>
    		<?php $form = ActiveForm::begin(['method' => 'post','action' => ['kundendaten']]); ?>	
				<div class="row">
					<div class="col-lg-12">
						<?= $form->field($model,'firma')->label(false)->textInput(['placeholder' => "Firmennamen"]) ?>
					</div>
					<h2>Ansprechpartner</h2>
					<div class="col-lg-6">
					<?= $form->field($model,'apname')->label(false)->textInput(['placeholder' => "Vorname"]) ?>
					</div>
					<div class="col-lg-6">
					<?= $form->field($model,'aplastname')->label(false)->textInput(['placeholder' => "Nachnamen"]) ?>
					</div>
					<div class="col-lg-12"><?= Html::submitButton('Weiter', ['class' => 'order-btn border-btn']) ?></div>
				</div>
			<?php ActiveForm::end(); ?>
		</div>
</div>
