<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<h4><span><span>Newsletter</span></span></h4>
<?php
$form = ActiveForm::begin([
    'action' => ['newsletter'],
    'options' => [
        'class' => 'mc4wp-form mc4wp-form-174',
        'id' => 'mc4wp-form-1',
        'data-id' =>'174',
        'data-name'=> 'Newsletter'
        
    ]
]); 
?>
<div class="mc4wp-form-fields">
<?= $form->field($model,'email')->label(false)->textInput(['type' => 'email','class'=>'border','placeholder' => "Email-Adresse"]) ?>
<span class="arrow"><?= Html::submitButton("Eintragen", ['class' => "border"]); ?></span>

</div>


<?php ActiveForm::end(); ?>  