<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>
 <div id="p0" data-pjax-container="" data-pjax-push-state="" data-pjax-timeout="1000">
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

        <h4 class="mr-0 mr-md-5">Abonnieren Sie unseren Newsletter.</h4>
        <input type="hidden" name="_csrf" value="D3wZeFXEkJsayYPIS1k4q6Hja9DdlUyoWRwKAGi0gHBuRSlKGpfaykCe0KkedArF6qsiprHMedAvdX94P_bNMQ==">
        <div class="form-fields">
            <?= $form->field($model,'email')->label(false)->textInput(['type' => 'email','class'=>'border','placeholder' => "Email-Adresse"]) ?>
            <?= Html::submitButton("Eintragen", ['class' => "border mobile-fill anim-1 show"]); ?>
        </div>
<?php ActiveForm::end(); ?>
 </div> 
