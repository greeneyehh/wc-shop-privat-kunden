<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
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
<div id="main">
    <div class="container">
        <div id="hero" class="row flex-column flex-md-row-reverse margin-b">
            <div class="col-12 col-md-6">
                <div class="pic">
                    <div class="diamond top"><div class="box"><div class="trans"></div></div></div>
                    <img class="net" srcset="/image/Windcloud-net.png, /image/Windcloud-net-300x212.png 300w, /image/Windcloud-net-768x543.png 768w, /image/Windcloud-net-1024x724.png 1024w, /image/Windcloud-net-1200x848.png 1200w" sizes="(min-width: 1200px) 540px, (min-width: 992px) 450px, (min-width: 768px) 330px, (min-width: 576px) 510px, calc(100vw - 30px)" src="/image/Windcloud-net.png" title="Windcloud-net">
                    <div class="tile-1 move-in-2">
                        <div class="img-tile levitate-3">
                            <div class="img">
                                <img srcset="/image/Windcloud-windraeder.png 4960w, /image/Windcloud-windraeder-300x212.png 300w, /image/Windcloud-windraeder-768x543.png 768w, /image/Windcloud-windraeder-1024x724.png 1024w, /image/Windcloud-windraeder-1200x848.png 1200w" sizes="(min-width: 1200px) 445px, (min-width: 992px) 370px, (min-width: 768px) 270px, (min-width: 576px) 420px, calc(83vw - 30px)" src="/image/Windcloud-windraeder.png" alt="Windpark als 3D-Visual" title="Windpark | Windcloud 4.0 GmbH">          </div>
                            <div class="box"><div class="trans"></div></div>
                        </div>
                    </div>

                    <div class="tile-2 move-in-2">
                        <div class="img-tile levitate-4">
                            <div class="img">
                                <img srcset="/image/Windcloud-kaserne.png 4960w, /image/Windcloud-kaserne-300x212.png 300w, /image/Windcloud-kaserne-768x543.png 768w, /image/Windcloud-kaserne-1024x724.png 1024w, /image/Windcloud-kaserne-1200x848.png 1200w" sizes="(min-width: 1200px) 445px, (min-width: 992px) 370px, (min-width: 768px) 270px, (min-width: 576px) 420px, calc(83vw - 30px)" src="/image/Windcloud-kaserne-1024x724.png" alt="Rechenzentrum als 3D-Visual" title="Rechenzentrum | Windcloud 4.0 GmbH">          </div>
                            <div class="box"><div class="trans"></div></div>
                        </div>
                    </div>

                    <div class="tile-3 move-in-2-5">
                        <div class="img-tile levitate-5">
                            <div class="img">
                                <img srcset="/image/Windcloud-solar.png 4960w, /image/Windcloud-solar-300x212.png 300w, /image/Windcloud-solar-768x543.png 768w, /image/Windcloud-solar-1024x724.png 1024w, /image/Windcloud-solar-1200x848.png 1200w" sizes="(min-width: 1200px) 445px, (min-width: 992px) 370px, (min-width: 768px) 270px, (min-width: 576px) 420px, calc(83vw - 30px)" src="/image/Windcloud-solar-1024x724.png" alt="Solarpark als 3D-Visual" title="Solarpark | Windcloud 4.0 GmbH">          </div>
                            <div class="box"><div class="trans"></div></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="login-box">
            <p class="info"></p>
            <div class="card" style="border-radius: 1rem 0 1rem 0;">
                <div class="card-body login-card-body" style="border-radius: 1rem 0 1rem 0;">
                    <h2 class="login-text">Login</h2>
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
                        <div class="col-6">
                            <?= $form->field($model, 'rememberMe')->checkbox(['class' => 'remember']) ?>
                        </div>
                        <div class="col-6">
                            <?= Html::submitButton('Login', ['class' => 'border mobile-fill', 'name' => 'login-button']) ?>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                    <a href="#" data-toggle="modal" data-target="#forgot-password"><h1>Ich habe mein Passwort vergessen</h1></a>
                </div>
            </div>
        </div>




        <div class="modal fade" id="forgot-password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Passwort vergessen</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

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
                          timer: 5000
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


