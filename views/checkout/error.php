<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

?>
<div class="site-error">

    <h1>Ihre zahlung ist fehlgeschlagen</h1>

    <div class="alert alert-danger">
        bitte wenden sie sich an unseren support
        <p><?= nl2br(Html::encode($message)) ?></p>
    </div>


</div>
