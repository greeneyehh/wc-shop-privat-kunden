<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>

    <div class="container">

        <div class="kachelanimation">
            <div class="netz d-none d-md-block">
                <img class="net" src="<?= Url::to('@web/image/Windcloud-net-768x543.png')?>" title="Windcloud Netz">
            </div>
            <div class="raute"></div>
            <div class="kacheln">
                <div class="tile-1 move-in-2-5">
                    <div class="levitate-3">
                        <img src="<?= Url::to('@web/image/Windcloud-windraeder-768x543.png')?>" alt="Windpark als 3D-Visual" title="Windpark | Windcloud 4.0 GmbH">
                        <div class="box"><div class="trans"></div></div>
                    </div>
                </div>

                <div class="tile-2 move-in-2">
                    <div class="levitate-4">
                        <img src="<?= Url::to('@web/image/Windcloud-kaserne-768x543.png')?>" alt="Rechenzentrum als 3D-Visual" title="Rechenzentrum | Windcloud 4.0 GmbH">
                        <div class="box"><div class="trans"></div></div>
                    </div>
                </div>

                <div class="tile-3 move-in-3">
                    <div class="levitate-5">
                        <img src="<?= Url::to('@web/image/Windcloud-solar-768x543.png')?>" alt="Solarpark als 3D-Visual" title="Solarpark | Windcloud 4.0 GmbH">
                        <div class="box"><div class="trans"></div></div>
                    </div>
                </div>
            </div>
        </div>

        <div id="hero" class="row margin-b">
            <div class="col-12 col-md-8 col-lg-6 aufmachertext">
                <h1>CO2-freie Cloud- und<br>Colocation-Lösungen</h1>
                <h2 class="vary">RECHNEN<br class="d-md-none" > SIE<br class="d-none d-md-block" > MIT WIND</h2>
                <p class="mb-4">
                    Wir versorgen unser Rechenzentrum zu 100% mit physikalisch grünem Strom, größtenteils aus Windenergie. Darüber hinaus veredeln wir die Abwärme unserer Server direkt vor Ort in einer Algenfarm. Unsere leistungsstarken Cloud- und Colocation-Services sind CO2-frei, hochverfügbar und DSGVO-konform.
                </p>
                <a class="border mobile-fill mr-3 anim-1 show" href="/produkte">Unsere Produkte</a>
                <a class="border mobile-fill anim-1 show" href="/unternehmen/oekosystem">Unser Ökosystem</a>
            </div>
        </div>

    </div>

    <div class="spacer-image background-1"></div>

    <div class="container">
        <div class="container blockImgTxt">

            <div class="d-md-block">
                <h3 class="vary mb-4 mb-md-5 text-center">UNSERE PRODUKTE</h3>
            </div>

            <div class="d-md-block">

                <div class="row">
                    <div class="col-12 col-lg-6  mb-4">
                        <div class="bg-darkblue border-radius-d adjust-h">
                            <a  href="javascript:">
                                <div class="col-6">
                                    <div class="p-3">
                                        <img src="<?= Url::to('@web/image/Windcloud_Icon-Colocation.svg')?>" alt="Colocation">
                                        <h3>CO2LOCATION</h3>
                                        <p>Colocation-Lösungen in Norddeutschland</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <ul>
                                        <li>Deutsches Rechenzentrum</li>
                                        <li>Über 40 Carrier verfügbar </li>
                                        <li>Strom 19 Cent/kWh</li>
                                    </ul>
                                    <form method="get" action="/produkte/colocation">
                                        <button class="border mobile-fill anim-1 btn-ajax-modal show">Angebote</button>
                                    </form>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6  mb-4">
                        <div class="bg-cyan border-radius-d adjust-h">
                            <a  href="javascript:">
                                <div class="col-6">
                                    <div class="p-3">
                                        <img src="<?= Url::to('@web/image/Windcloud_Icon-IaaS-1.svg')?>" alt="IAAS">
                                        <h3>IAAS</h3>
                                        <p>Infrastructure as a Service auf Basis von VMware vCloud</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <ul>
                                        <li>VMware vCloud Director</li>
                                        <li>Software Defined Datacenter</li>
                                        <li>Dell Hardware</li>
                                    </ul>
                                    <form method="get" action="/produkte/infrastructure-as-a-service">
                                        <button class="border mobile-fill anim-1 btn-ajax-modal show">Angebote</button>
                                    </form>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-6 col-md-6 col-lg-4 mb-4">
                        <div class="bg-white border-radius-d adjust-h">
                            <a  href="javascript:">
                                <div class="p-3">
                                    <h3 class="vary">CLOUD<br>BACKUP</h3>
                                    <p>Backup as a Service</p>
                                    <ul>
                                        <li>Für Server und VMs</li>
                                        <li>Standort für Offsite-Backup</li>
                                        <li>Managed Backup</li>
                                    </ul>
                                    <form method="get" action="/produkte/cloud-backup">
                                        <button class="border mobile-fill anim-1 btn-ajax-modal show">Angebote</button>
                                    </form>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-6 col-md-6 col-lg-4 mb-4">
                        <div class="bg-white border-radius-d adjust-h">
                            <a  href="javascript:">
                                <div class="p-3">
                                    <h3 class="vary">VPS</h3>
                                    <p>Virtual Private Server</p>
                                    <ul>
                                        <li>SSD-Speicher</li>
                                        <li>Linux oder Windows</li>
                                        <li>Leistungsstarke Hardware</li>
                                    </ul>
                                    <form method="get" action="/produkte/vps">
                                        <button class="border mobile-fill anim-1 btn-ajax-modal show">Angebote</button>
                                    </form>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-12 col-md-12 col-lg-4 mb-4">
                        <div class="bg-white border-radius-d adjust-h">
                            <a  href="javascript:">
                                <div class="p-3">
                                    <h3 class="vary">MANAGED<br>NEXTCLOUD</h3>
                                    <p>Cloud Storage</p>
                                    <ul>
                                        <li>100% CO2-frei</li>
                                        <li>3-fach redundant gesichert</li>
                                        <li>DSGVO-konform</li>
                                    </ul>
                                    <form method="get" action="/produkte/managed-nextcloud">
                                        <button class="border mobile-fill anim-1 btn-ajax-modal show">Angebote</button>
                                    </form>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <div class="container-fluid">
        <div class="container">

            <div class="blockImgTxt row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-lg-5">
                            <h3 class="vary mb-3">WARUM<br>WINDCLOUD?</h3>
                            <p class="mb-4">
                                Nicht nur der globale Luftverkehr und die Industrie tragen zum Klimawandel bei. Auch die Digitalisierung hat Folgen für das Klima. Digitale Infrastrukturen, wie Rechenzentren, sind mittlerweile zu einem bedeutenden Faktor in der globalen Energie- und Klimabilanz geworden.
                                <br>
                                Mit Windcloud haben wir eine nachhaltige Alternative geschaffen. Wir versorgen leistungsfähige Rechenzentren direkt mit lokaler Erneuerbarer Energie. Darüber hinaus nutzen wir die Abwärme unserer Server für weitere Industrien – CO2-frei und wirtschaftlich zugleich.
                            </p>
                            <a class="border mobile-fill anim-1 show" href="/unternehmen/oekosystem">Unser Ökosystem</a>
                        </div>
                        <div class="col-12 col-lg-7">

                            <div class="slider">
                                <div id="carousel-slider" class="carousel slide" data-ride="carousel">

                                    <div class="carousel-inner">
                                        <div class="carousel-item  active">
                                            <img class="border-radius-d" src="<?= Url::to('@web/image/1.jpg')?>" alt="Warum Windcloud">
                                        </div>

                                        <div class="carousel-item">
                                            <img class="border-radius-d" src="<?= Url::to('@web/image/2.jpg')?>" alt="Warum Windcloud">
                                        </div>

                                        <div class="carousel-item">
                                            <img class="border-radius-d" src="<?= Url::to('@web/image/3.jpg')?>" alt="Warum Windcloud">
                                        </div>

                                        <div class="carousel-item">
                                            <img class="border-radius-d" src="<?= Url::to('@web/image/4.jpg')?>" alt="Warum Windcloud">
                                        </div>

                                        <a class="carousel-control-prev" href="#carousel-slider" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon blue" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>

                                        <a class="carousel-control-next" href="#carousel-slider" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon blue" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="spacer-image background-2"></div>

    <div class="container margin-b">

        <div class="d-md-block">
            <h3 class="vary mb-4 mb-md-5 text-center">AKTUELLES</h3>
        </div>

        <div class="d-md-block">
            <div class="row">


                <?php foreach ($news as $newsone): ?>
                    <div class="col-6 col-lg-4 mb-4">
                        <div class="bg-white-news border-radius-d" style="height: 100%;">
                            <div class="p-3">
                              <strong><?php
                                    $date=date_create($newsone->datetime);
                                    echo date_format($date,"d.m.Y");?></strong>
                                   <h3 class="vary"><?=$newsone->titel;?></h3>

                                <a class="border mobile-fill anim-1 show" href="/news/<?=$newsone->slug;?>">mehr</a>
                            </div>
                        </div>
                    </div>

                <?php  endforeach; ?>
            </div>
        </div>

    </div>

    <div class="container-fluid">
        <div class="container blockImgTxt logoabbinder text-center">

            <div class="d-md-block">
                <h3 class="vary mb-5 text-center">KUNDEN</h3>
            </div>

            <div class="d-md-block">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-2 offset-lg-1 mb-5 mb-md-4">
                        <img src="<?= Url::to('@web/image/stadtwerle-husum-logo.png')?>" alt="Logo Stadtwerke Husum">
                    </div>
                    <div class="col-12 col-md-6 col-lg-2 mb-5 mb-md-4">
                        <img src="<?= Url::to('@web/image/vitabook-logo.png')?>" alt="Logo Vita">
                    </div>
                    <div class="col-12 col-md-6 col-lg-2 mb-5 mb-md-4">
                        <img src="<?= Url::to('@web/image/abo-wind-logo.png')?>" alt="Logo Abo Wind">
                    </div>
                    <div class="col-12 col-md-6 col-lg-2 mb-5 mb-md-4">
                        <img src="<?= Url::to('@web/image/joke-event-ag-logo.png')?>" alt="Logo Joke Event AG">
                    </div>
                    <div class="col-12 col-md-6 col-lg-2 offset-md-3 offset-lg-0 mb-4">
                        <img src="<?= Url::to('@web/image/balticfinance-logo.png')?>" alt="Logo balticfinance">
                    </div>
                </div>
            </div>
        </div>
    </div>


    </div>

<?php
$this->registerCssFile("/css/cms/style-welcome-2.css");

?>