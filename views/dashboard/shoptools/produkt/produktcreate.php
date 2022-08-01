<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\dashboard\ShopProductFormDB */
/* @var $form ActiveForm */
?>
<div class="dashboard-shoptools-produkt-produktupdate">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'name')->label(false)->textInput(['placeholder' => "Name"]) ?>
        <?= $form->field($model, 'description')->label(false)->textArea(['rows' => 6,'placeholder' => "Beschreibung"]) ?>
        <?= $form->field($model, 'price')->label(false)->textInput(['placeholder' => "Preis"]) ?>
        <?= $form->field($model, 'tax')->label(false)->textInput(['placeholder' => "Steuer"]) ?>
        <?= $form->field($model, 'addons')->label(false)->textInput(['placeholder' => "addon"]) ?>
<div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
</div>
    <?php ActiveForm::end(); ?>