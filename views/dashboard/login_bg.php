<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Dashboard Login';


$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>




<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Windcloud</b>Dashboard</a>
    </div>
    <p class="info"></p>
    <div class="card" style="border-radius: 1rem 0 1rem 0;">
        <div class="card-body login-card-body" style="border-radius: 1rem 0 1rem 0;">
            <p class="login-box-msg">Dashboard Login</p>
            <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

            <?= $form
                ->field($model, 'personal_email', $fieldOptions1)
                ->label(false)
                ->textInput(['placeholder' => 'E-Mail']) ?>

            <?= $form
                ->field($model, 'personal_password', $fieldOptions2)
                ->label(false)
                ->passwordInput(['placeholder' => 'Passwort']) ?>

            <div class="row">
                <div class="col-8">
                    <?= $form->field($model, 'rememberMe')->checkbox() ?>
                </div>
                <div class="col-4">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
            <a href="#" data-toggle="modal" data-target="#forgot-password">Ich habe mein Passwort vergessen</a><br>
        </div>
    </div>
</div>




<div class="modal fade" id="forgot-password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Passwort vergessen</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">

                <?php $form = ActiveForm::begin( ['id' => 'ForgotPassword']); ?>
                <?php //$form = ActiveForm::begin( ['id' => 'ForgotPassword','action' => '/ajax/forgot-password','options' => ['method' => 'post'] , 'enableAjaxValidation' => true]); ?>
                <?= $form
                    ->field($ForgotPassword, 'personal_email', $fieldOptions1)
                    ->label(false)
                    ->textInput(['placeholder' => $model->getAttributeLabel('personal_email')]) ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
                <?= Html::submitButton('Neues Passwort', ['class' => 'btn btn-primary add-new-pw add-new-pw', 'name' => 'login-button']) ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>



<?php
$js = <<<JS
    $('#ForgotPassword').on('beforeSubmit', function(){
       var data = $(this).serialize();
        $.ajax({
            url: '/ajax/forgot-password',
            type: 'POST',
            data: data,
            success: function(res){
                 $('#forgot-password').modal('hide');
                       const Toast = Swal.mixin({
                          toast: true,
                          position: 'top-end',
                          showConfirmButton: false,
                          timer: 3000
                        });
                       var obj  = JSON.parse(res); 
                                                  Toast.fire({
                                    type: obj.status,
                                    title: obj.text
                                  }) 
                       document.getElementById("forgotpasswordform-personal_email").value = ""; 
            },
            error: function(){
               console.log('error');
            }
        });
        return false;
    });
JS;
$this->registerJs($js);
?>


