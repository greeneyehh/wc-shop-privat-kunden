<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\dashboard\ShopProductFormDB */
/* @var $form ActiveForm */
?>
<div class="dashboard-shoptools-produkt-produktupdate">

    <?php $form = ActiveForm::begin(); ?>
		<?= $form->field($model, 'ProductId')->hiddenInput(['value' => $product->id])->label(false);?>
        <?= $form->field($model, 'name')->label(false)->textInput(['value' => $product->name]) ?>
        <?= $form->field($model, 'description')->label(false)->textArea(['rows' => 6, 'value' => $product->description]) ?>
        <?= $form->field($model, 'price')->label(false)->textInput([ 'value' => $product->price]) ?>
        <?= $form->field($model, 'tax')->label(false)->textInput([ 'value' => $product->tax]) ?>
        <?= $form->field($model, 'addons')->label(false)->textInput(['value' => $product->addons]) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>