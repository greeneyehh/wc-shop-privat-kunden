<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\dashboard\user\ChangePasswordForm */
/* @var $form ActiveForm */
?>
<div class="Updatelog">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'old_password') ?>
        <?= $form->field($model, 'personal_password') ?>
        <?= $form->field($model, 'personal_passwordConfirmation') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- Updatelog -->
