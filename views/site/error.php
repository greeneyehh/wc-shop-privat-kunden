<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>


<div class="container">


    <div class="bg-c-white border-radius-d margin-b pad" style="margin-top: 12rem;">
        <div class="p-3">
            <h1 class="vary">Die Seite wurde nicht gefunden</h1>
            <h2 class="vary">Sorry</h2>
            <p>Es tut uns leid. Beim Laden der Seite ist ein Fehler aufgetreten.
                Bitte
                versuchen Sie es noch einmal. Sollte der Fehler erneut auftreten,
                schreiben Sie uns bitte an support@windcloud.de.</p>
            <a class="border mobile-fill anim-1 show" href="<?= Yii::$app->request->referrer?>">Einen Schritt zurück gehen</a>
        </div>
    </div>

