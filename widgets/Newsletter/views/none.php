<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
?>


    <?php Pjax::begin(); ?>
<?php
$form = ActiveForm::begin([
    'id' => 'form-input-example',
    'validationUrl' => Url::to(['ajax-email-validation']),
     'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
    'options' => [
            'onsubmit' => 'sendAjax(this)'
    ],

]);
?>
<h4 class="mr-0 mr-md-5">Abonnieren Sie unseren Newsletter.</h4>
<div class="form-fields">
        <?= $form->field($model,'email')->label(false)->textInput(['type' => 'email','class'=>'border','placeholder' => "Email-Adresse"]) ?>
        <?= Html::submitButton("Eintragen", ['class' => "border mobile-fill anim-1 show"]); ?>
    </div>

<?php ActiveForm::end(); ?>














<?php Pjax::end(); ?>
    <script>
        function sendAjax(form) {
            var request = $.ajax({
                method: 'post',
                url: '/mail-chimp/signup-user',
                dataType: 'json',
                data: $(form).serialize(),
                beforeSend: function() {
                    console.log("response");

                }
            });
            request.done(function (response) {
                console.log(response);
            })

            // return false;
        }
    </script>