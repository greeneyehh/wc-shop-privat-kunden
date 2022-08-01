<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>


<div class="container">


    <div class="bg-white-news border-radius-d" style="height: 100%;">
        <div class="p-3">
            <strong>03.09.2020</strong>
            <h3 class="vary">Gelungene Premiere: Windcloud eröffnet CO2-absorbierendes Rechenzentrum</h3>

            <a class="border mobile-fill anim-1 show" href="/news/windcloud-eroeffnet-co2-absorbierendes-rechenzentrum">mehr</a>
        </div>
    </div>
<div id="hero"><h1><?= Html::encode($this->title) ?></h1></div>
    <div class="site-error">


        <div class="alert alert-danger">
            <?= nl2br(Html::encode($message)) ?>
        </div>

        <p>
            Der obige Fehler trat auf, während der Webserver Ihre Anforderung verarbeitete.
        </p>
        <p>
            Bitte kontaktieren Sie uns, wenn Sie glauben, dass dies ein Serverfehler ist. Danke.
        </p>
    </div>


</div>