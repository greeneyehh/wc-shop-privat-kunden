<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Passwort </b>vergessen</a>
    </div>

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sie sind nur einen Schritt von Ihrem neuen Passwort entfernt. Stellen Sie Ihr Passwort jetzt wieder her.</p>
            <?php $form = ActiveForm::begin(['encodeErrorSummary' => false]); ?>
                        <?= $form->errorSummary($ChangePassword, ['class' => 'alert alert-danger'],null,null); ?>
            <?= $form->field($ChangePassword, 'personal_password', [
                'inputTemplate' => ' <div class="input-group mb-3">{input}<div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div></div>',
            ])->label(false)
                ->passwordInput(['placeholder' => $ChangePassword->getAttributeLabel('personal_password')]) ?>
            <?= $form->field($ChangePassword, 'personal_passwordConfirmation', [
                'inputTemplate' => ' <div class="input-group mb-3">{input}<div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div></div>',
            ])->label(false)
                ->passwordInput(['placeholder' => $ChangePassword->getAttributeLabel('personal_passwordConfirmation')]) ?>
        </div>
        <div class="card-footer">
            <?= Html::submitButton('Passwort ändern', ['class' => 'btn btn-primary btn-block']) ?>

        </div>
        <!-- /.box-body -->
        <?php ActiveForm::end(); ?>


        <div class="card-footer">
                <?= Html::resetButton('Abbrechen', ['class' => 'btn btn-danger btn-block']) ?>
        </div>
        </div>
    </div>
</div>