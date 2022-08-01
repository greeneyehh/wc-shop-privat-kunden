<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
?>
<h3 class="box-title"><i class="fa fa-cog" aria-hidden="true"></i> Stammdaten</h3>

<div class="row">
    <div class="col-md-8">


    <pre>
<?php print_r($stamdaten);?>
</pre>
    </div>

    <div class="col-md-4">

    <div class="card card-primary">
            <div class="card-header box-header-windcloud">
                <h3 class="card-title"><i class="fa fa-key" aria-hidden="true"></i> Passwort ändern</h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($ChangePassword, 'old_password')->label(false)
                    ->passwordInput(['placeholder' => $ChangePassword->getAttributeLabel('old_password')]) ?>
                <?= $form->field($ChangePassword, 'personal_password')->label(false)
                    ->passwordInput(['placeholder' => $ChangePassword->getAttributeLabel('personal_password')]) ?>
                <?= $form->field($ChangePassword, 'personal_passwordConfirmation') ->label(false)
                    ->passwordInput(['placeholder' => $ChangePassword->getAttributeLabel('personal_passwordConfirmation')]) ?>
            </div>
            <div class="card-footer">
                    <?= Html::submitButton('Passwort ändern', ['class' => 'btn btn-primary']) ?>

            </div>
            <!-- /.box-body -->
            <?php ActiveForm::end(); ?>
        </div>
        <div class="card card-primary">
            <div class="card-header box-header-windcloud">
                <h3 class="card-title"><i class="fa fa-user-secret" aria-hidden="true"></i> Zwei-Faktor-Authentifizierung (2FA)</h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
                die Zwei-Faktor-Authentifizierung (2FA) ist in Planung
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-default">Zwei-Faktor-Authentifizierung aktivieren</button>
            </div>



            <!-- /.box-body -->
        </div>

        <div class="card card-primary">

            <?php $form = ActiveForm::begin(); ?>
            <div class="card-header box-header-windcloud">
                <h3 class="card-title"><i class="fa fa-trash" aria-hidden="true"></i> Kundenkonto löschen</h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
                <?= $form->field($trash, 'accountid')->hiddenInput(['value'=> Yii::$app->user->identity->accountid ])->label(false); ?>
                <?= $form->field($trash, 'delcheck',
                    ['template' => '{input}{label}{error}'])->checkBox(['aria-invalid'=>false,'label'=> 'Ich möchte mein Konto bei Windcloud 4.0 GmbH löschen']);?>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-danger">löschen</button>
            </div>

            <?php ActiveForm::end(); ?>

            <!-- /.box-body -->
        </div>



    </div>
