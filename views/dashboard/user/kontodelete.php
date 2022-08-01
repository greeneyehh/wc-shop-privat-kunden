<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Kontodaten </b>Löschen</a>
    </div>

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg"><?=$user['personal_firstname']; ?> <?=$user['personal_lastname']; ?></p>
            <p class="login-box-msg">Du Bist nur einen Schritt von Löschen deiner Kontodaten entfernt.</p>


        <div class="card-footer">
                <?= Html::resetButton('Abbrechen', ['class' => 'btn btn-danger btn-block']) ?>
        </div>
        </div>
    </div>
</div>