<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use app\module\CartModal\CartModalWidget;
?>

    <div class="container">

        <div id="hero" class="row margin-b">
            <div class="col-5">
                <h1>100 % CO2-frei durch grünen Strom<br>und Abwärmeveredelung</h1>
                <h2 class="vary">ÖKOSYSTEM</h2>
                <p class="d-none d-md-block">Mit Windcloud haben wir eine nachhaltige Alternative zum konventionellen Rechenzentrumsbetrieb geschaffen. Unsere leistungsfähigen Rechenzentren versorgen wir direkt mit lokaler Erneuerbarer Energie. Darüber hinaus nutzen wir die Abwärme unserer Server für weitere Industrien - CO2-frei und wirtschaftlich zugleich.</p>
            </div>
            <div class="col mb-4">
                <div class="pic">
                    <div class="diamond top"><div class="box"><div class="trans"></div></div></div>
                    <img class="net" srcset="<?= Url::to('@web/image/Windcloud-net.png');?> 2000w, <?= Url::to('@web/image/Windcloud-net-300x212.png');?> 300w, <?= Url::to('@web/image/Windcloud-net-768x543.png');?> 768w, <?= Url::to('@web/image/Windcloud-net-1024x724.png');?> 1024w, <?= Url::to('@web/image/Windcloud-net-1200x848.png');?>  1200w" sizes="(min-width: 1200px) 540px, (min-width: 992px) 450px, (min-width: 768px) 330px, (min-width: 576px) 510px, calc(100vw - 30px)" src="<?= Url::to('@web/image/Windcloud-net-1024x724.png');?>" title="Windcloud-net" alt="Netz">

                </div>
            </div>
        </div>


        <div class="videowall col-12 margin-b">
            <div class="row">
                <div class="col-4 order-1 order-md-0 d-none d-md-block">

                </div>
                <div class="col-5 col-md-4 order-2 order-md-1" style="z-index: 8;">
                    <img src="<?= Url::to('@web/image/Windcloud-Turmplatte01.gif');?>" alt="Erneuerbare Energie">
                </div>
                <div class="col-7 col-md-4 order-0 order-md-2">
                    <div class="bubble right">
                        <p>Erneuerbare Energie</p>
                        <span>
                In den Umspannwerken in Nordfriesland wird ausschließlich Strom aus Erneuerbaren Energiequellen umgespannt und verteilt. Somit können wir unser Rechenzentrum zu 100% mit physikalisch echtem Grünstrom versorgen. In naher Zukunft werden wir ein versorgerunabhängiges Arealnetz realisieren und können damit Strom direkt vom Windpark beziehen.
                </span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-7 col-md-4 order-0 order-md-0">
                    <div class="bubble left">
                        <p>Das Rechenzentrum</p>
                        <span>
                Das Rechenzentrum ist der Kern des Windcloud-Ökosystems. Unsere Rechenzentren bauen und betreiben wir in ehemaligen Militärgebäuden und Bunkern in Schleswig-Holstein. Sie bilden die Basis für unser Cloud- und Colocation-Angebot.
                </span>
                    </div>
                </div>
                <div class="col-5 col-md-4 order-2 order-md-1" style="z-index: 6;">
                    <span class="tiletext right d-none d-sm-block">Der Strom für die Windcloud-Rechenzentren kommt zu 100% aus lokaler Erneuerbarer Energie.</span>
                    <img src="<?= Url::to('@web/image/Windcloud-Turmplatte02.gif');?>" alt="Rechenzentrum">
                </div>
                <div class="col-4 order-1 order-md-2 d-none d-md-block">

                </div>
            </div>

            <div class="row">
                <div class="col-4 order-1 order-md-0 d-none d-md-block">

                </div>
                <div class="col-5 col-md-4 order-2 order-md-1" style="z-index: 4;">
                    <span class="tiletext left d-none d-sm-block">Die Server-Abwärme ist bei uns kein Abfall-Produkt. Wir nutzen diese zusammen mit Partnern bspw. für das Beheizen einer Algenfarm. Damit steigern wir die Nachhaltigkeit und Wirtschaftlichkeit unseres Gesamtsystems.</span>
                    <img src="<?= Url::to('@web/image/Windcloud-Turmplatte03.gif');?>" alt="Algenfarm">
                </div>
                <div class="col-7 col-md-4 order-0 order-md-2">
                    <div class="bubble right">
                        <p>Die Algenfarm</p>
                        <span>
                Algen benötigen nicht nur Wärme zum Wachsen, sondern binden dabei auch große Mengen CO2. Dadurch wird durch den Betrieb unseres Rechenzentrums CO2 aus der Umwelt absorbiert.
                </span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-7 col-md-4 order-0 order-md-0">

                </div>
                <div class="col-5 col-md-4 order-2 order-md-1" style="z-index: 2;">
                    <span class="tiletext right d-none d-sm-block">Algen finden sowohl in der Nahrungsmittelindustrie als auch in der Kosmetik- und Pharmabranche Verwendung. Somit generieren wir aus dem Rechenzentrumsbetrieb ein zusätzliches nachhaltiges Produkt.</span>

                    <video poster="Demofilm.png" controls>
                        <source src="Windcloud-Turmplatte04.webm" type="video/webm" />
                        <source src="Demofilm.ogg"  type="video/ogg" />
                    </video>

                    <video id="video_background" preload="auto" autoplay="true" loop="loop" muted="muted" volume="0">
                        <source src="<?= Url::to('@web/image/Windcloud-Turmplatte04.webm');?>" type="video/webm">
                    </video>

                    <img src="<?= Url::to('@web/image/Windcloud-Turmplatte04.gif');?>" alt="Unternehmen">
                </div>
                <div class="col-4 order-1 order-md-2 d-none d-md-block">

                </div>
            </div>
        </div>


    </div>



<?php
$this->registerCssFile("/css/cms/style-oekosystem.css");
?>
