<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="container">
    <div class="diamond top"><div class="box"><div class="trans"></div></div></div>
    <div class="diamond bottom"><div class="box"><div class="trans"></div></div></div>
    <div id="hero" class="margin-b">
        <div class="row">
            <div class="col-11 col-md-7">
                <h1>Presse</h1>
                <h2 class="vary mb-3">Informationen <br> und aktuelle <br>Meldungen</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-7">
                <p>Windcloud betreibt zusammen mit starken Partnern den Aufbau eines digital-industriellen Ökosystems entlang der Nordseeküste Deutschlands. Herzstück ist ein verteiltes Netzwerk aus Metro-Clustern hochmoderner Rechenzentren. Diese wandeln Grünstrom direkt in Rechenleistung für Cloud- und Hosting-Lösungen um.</p>
            </div>
        </div>

    </div>


    <div class="row margin-b">
        <div class="col-12 col-lg-6">
            <div class="row">
                <div class="col-7 col-sm-8 col-lg-7 margin-b">
                    <h3 class="vary">Presse Kontakt</h3>
                    <p>Für Presse-Anfragen stehen wir Ihnen gerne zur Verfügung.</p>
                    <a class="icon-phone" href="tel:+4946626148590">04662 / 6148590</a>
                    <br>
                    <a class="icon-mail" href="mail:presse@windcloud.de">presse@windcloud.de</a>
                </div>

            </div>
        </div>
    </div>

    <img class="shadow-line" src="<?= Url::to('@web/img/schatten.png');?>">

    <div class="margin-b">
        <h2 class="vary mb-3">Rechnen Sie mit Wind</h2>
        <p class="column-count" style="color:#004477;">
            Die Windcloud 4.0 GmbH verfolgt die Vision einer CO<sub>2</sub>-freien Zukunft digitaler Infrastrukturen. Um das zu realisieren, ist Windcloud <strong>Bauherr und Betreiber hocheffizienter Rechenzentren</strong>,
            die direkt mit lokal erzeugtem <strong>Grünstrom</strong> versorgt werden. Für den Bau der Rechenzentren hat Windcloud ehemalige Bundeswehranlagen (mit 54 Nato-Bunkern) und Gewerbeflächen an 3 Standorten
            in Nordfriesland an der <strong>Westküste Schleswig-Holsteins</strong> erworben.
            <br>
            Auf diesem Fundament bietet Windcloud seinen Kunden hochmoderne und nachhaltige Cloud-Produkte im Bereich <strong>Storage</strong> und <strong>Virtualisierung</strong>, <strong>Colocation</strong>
            sowie <strong>Managed Kubernetes-Lösungen</strong> mit höchster Sicherheit und Verfügbarkeit an. Neben der Vermarktung digitaler Rechenzentrumsleistungen betreibt Windcloud den Aufbau eines
            <strong>digital-industriellen Ökosystems</strong>, das Energie- und Stoffströme sinnvoll verknüpft und die lokale Veredelung der Serverabwärme (für Indoor Farming, Fischzucht etc.) vorsieht.
            <br>
            Durch die intelligente Verbindung von <strong>Erneuerbaren Energien</strong>, <strong>Rechenzentren</strong> und Industrien zur <strong>Abwärmeveredelung</strong> erreicht Windcloud kurzfristig
            eine Kostenreduktion von 15-25% und mittelfristig von 40-70%. Windcloud strebt an, das grüne Cloud-Rückgrat der deutschen und europäischen Industrie 4.0 &amp; Industrial IoT zu werden.
        </p>
    </div>

    <div id="news" class="margin-b">
        <h2 class="vary mb-3">Newsticker</h2>
        <div class="row d-none d-md-flex">
            <?php foreach ($news as $newsone): ?>
                <div class="col-12 col-md-4 mb-3">




                    <div class="bg-darkblue border-radius-d box-shadow adjust-h">
                        <div class="p-3" style="height: 300px;">
                            <strong class="mb-0" ><?php
                                $date=date_create($newsone->datetime);
                                echo date_format($date,"d.m.Y");?></strong>
                            <p style="height: 170px;"><?=$newsone->titel;?></p>
                            <a class="border mobile-fill anim-1 show" href="/news/<?=$newsone->slug;?>">Mehr &gt;</a>
                        </div>
                    </div>













                </div>
            <?php  endforeach; ?>
        </div>

        <div id="carousel-news" class="carousel slide bg-gradient border-radius-d d-md-none" data-ride="carousel">
            <div class="carousel-inner">

                <?php foreach ($news as $key => $newsone): ?>
                <?php
                if($key ==0){?>
                <div class="carousel-item active" style="min-height: 0px;">
                    <?php
                    }else{
                    ?>
                    <div class="carousel-item" style="min-height: 0px;">
                        <?php
                        }
                        ?>


                        <a href="/news/<?=$newsone->slug;?>">
                            <div class="adjust-h" style="min-height: 0px;">
                                <h5 class="vary"><?php
                                    $date=date_create($newsone->datetime);
                                    echo date_format($date,"d.m.Y");?></h5>
                                <p><?=$newsone->titel;?></p>
                                <div class="arrow border">Mehr was auch immer</div>
                            </div>
                        </a>
                    </div>
                    <?php  endforeach; ?>



                </div>
                <a class="carousel-control-prev" href="#carousel-news" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon white" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-news" role="button" data-slide="next">
                    <span class="carousel-control-next-icon white" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>


            </div>
        </div>

        <div id="logo" class="margin-b">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h2 class="vary mb-3">Logo</h2>
                    <p class="mb-4">Unser Logo können Sie gerne im Rahmen Ihrer Berichte über die Windcloud 4.0 GmbH verwenden (Copyright Windcloud 2018).</p>
                </div>
            </div>


            <div class="row d-none d-md-flex">
                <div class="col-md-4 mb-3">
                    <a download="" href="<?= Url::to('@web/image/WIND_Logo_Wort-Bildmarke_horizontal_RGB.png');?>">
                        <div class="bg-white border-radius-d box-shadow">
                            <div class="pic">
                                <img srcset="<?= Url::to('@web/image/WIND_Logo_Wort-Bildmarke_horizontal_RGB.png');?> 2816w, <?= Url::to('@web/image/WIND_Logo_Wort-Bildmarke_horizontal_RGB-300x167.png');?> 300w, <?= Url::to('@web/image/WIND_Logo_Wort-Bildmarke_horizontal_RGB-768x427.png');?> 768w, <?= Url::to('@web/image/WIND_Logo_Wort-Bildmarke_horizontal_RGB-1024x570.png');?> 1024w, <?= Url::to('@web/image/WIND_Logo_Wort-Bildmarke_horizontal_RGB-1200x668.png');?> 1200w" sizes="(min-width: 1200px) 350px, (min-width: 992px) 290px, (min-width: 768px) 210px, (min-width: 576px) 150px, calc(33vw - 30px)" src="<?= Url::to('@web/image/WIND_Logo_Wort-Bildmarke_horizontal_RGB-1024x570.png');?>" alt="Windcloud 4.0 GmbH Logo" title="Windcloud 4.0 GmbH Logo">              </div>
                            <div class="icon-download text-center">Logo + Slogan</div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-3">
                    <a download="" href="<?= Url::to('@web/image/WIND_Logo_Wort-Bildmarke_vertikal_RGB.png');?>">
                        <div class="bg-white border-radius-d box-shadow">
                            <div class="pic">
                                <img srcset="<?= Url::to('@web/image/WIND_Logo_Wort-Bildmarke_vertikal_RGB.png');?> 1564w, <?= Url::to('@web/image/WIND_Logo_Wort-Bildmarke_vertikal_RGB-150x150.png');?> 150w, <?= Url::to('@web/image/WIND_Logo_Wort-Bildmarke_vertikal_RGB-300x300.png');?> 300w, <?= Url::to('@web/image/WIND_Logo_Wort-Bildmarke_vertikal_RGB-768x770.png');?> 768w, <?= Url::to('@web/image/WIND_Logo_Wort-Bildmarke_vertikal_RGB-1021x1024.png');?> 1021w, <?= Url::to('@web/image/WIND_Logo_Wort-Bildmarke_vertikal_RGB-1200x1203.png');?> 1200w" sizes="(min-width: 1200px) 350px, (min-width: 992px) 290px, (min-width: 768px) 210px, (min-width: 576px) 150px, calc(33vw - 30px)" src="<?= Url::to('@web/image/WIND_Logo_Wort-Bildmarke_vertikal_RGB-1021x1024.png');?>" alt="Windcloud 4.0 GmbH Logo" title="Windcloud 4.0 GmbH Logo">              </div>
                            <div class="icon-download text-center">Logo</div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-3">
                    <a download="" href="<?= Url::to('@web/image/WIND_Logo_Bildmarke_RGB.png');?>">
                        <div class="bg-white border-radius-d box-shadow">
                            <div class="pic">
                                <img srcset="<?= Url::to('@web/image/WIND_Logo_Bildmarke_RGB.png');?> 1564w, <?= Url::to('@web/image/WIND_Logo_Bildmarke_RGB-300x231.png');?> 300w, <?= Url::to('@web/image/WIND_Logo_Bildmarke_RGB-768x592.png');?> 768w, <?= Url::to('@web/image/WIND_Logo_Bildmarke_RGB-1024x790.png');?> 1024w, <?= Url::to('@web/image/WIND_Logo_Bildmarke_RGB-1200x925.png');?> 1200w" sizes="(min-width: 1200px) 350px, (min-width: 992px) 290px, (min-width: 768px) 210px, (min-width: 576px) 150px, calc(33vw - 30px)" src="<?= Url::to('@web/image/WIND_Logo_Bildmarke_RGB-1024x790.png');?>" alt="Windcloud 4.0 GmbH Logo" title="Windcloud 4.0 GmbH Logo">              </div>
                            <div class="icon-download text-center">Bildmarke</div>
                        </div>
                    </a>
                </div>
            </div>

            <div id="carousel-logo" class="carousel slide bg-white border-radius-d box-shadow d-md-none" data-ride="carousel">
                <div class="carousel-inner">

                    <div class="carousel-item active" style="min-height: 0px;">
                        <a download="" href="<?= Url::to('@web/image/WIND_Logo_Wort-Bildmarke_horizontal_RGB.png');?>">
                            <div class="adjust-h" style="min-height: 0px;">
                                <div class="pic">
                                    <img srcset="<?= Url::to('@web/image/WIND_Logo_Wort-Bildmarke_horizontal_RGB.png');?> 2816w, <?= Url::to('@web/image/WIND_Logo_Wort-Bildmarke_horizontal_RGB-300x167.png');?> 300w, <?= Url::to('@web/image/WIND_Logo_Wort-Bildmarke_horizontal_RGB-768x427.png');?> 768w, <?= Url::to('@web/image/WIND_Logo_Wort-Bildmarke_horizontal_RGB-1024x570.png');?> 1024w, <?= Url::to('@web/image/WIND_Logo_Wort-Bildmarke_horizontal_RGB-1200x668.png');?> 1200w" sizes="(min-width: 1200px) 1110px, (min-width: 992px) 930px, (min-width: 768px) 690px, (min-width: 576px) 510px, calc(100vw - 30px)" src="<?= Url::to('@web/image/WIND_Logo_Wort-Bildmarke_horizontal_RGB-1024x570.png');?>" alt="Windcloud 4.0 GmbH Logo" title="Windcloud 4.0 GmbH Logo">              </div>
                                <div class="icon-download text-center">Logo + Slogan</div>
                            </div>
                        </a>
                    </div>
                    <div class="carousel-item  " style="min-height: 0px;">
                        <a download="" href="<?= Url::to('@web/image/WIND_Logo_Wort-Bildmarke_vertikal_RGB.png');?>">
                            <div class="adjust-h" style="min-height: 0px;">
                                <div class="pic">
                                    <img srcset="<?= Url::to('@web/image/WIND_Logo_Wort-Bildmarke_vertikal_RGB.png');?> 1564w, <?= Url::to('@web/image/WIND_Logo_Wort-Bildmarke_vertikal_RGB-150x150.png');?> 150w, <?= Url::to('@web/image/WIND_Logo_Wort-Bildmarke_vertikal_RGB-300x300.png');?> 300w, <?= Url::to('@web/image/WIND_Logo_Wort-Bildmarke_vertikal_RGB-768x770.png');?> 768w, <?= Url::to('@web/image/WIND_Logo_Wort-Bildmarke_vertikal_RGB-1021x1024.png');?> 1021w, <?= Url::to('@web/image/WIND_Logo_Wort-Bildmarke_vertikal_RGB-1200x1203.png');?> 1200w" sizes="(min-width: 1200px) 1110px, (min-width: 992px) 930px, (min-width: 768px) 690px, (min-width: 576px) 510px, calc(100vw - 30px)" src="<?= Url::to('@web/image/WIND_Logo_Wort-Bildmarke_vertikal_RGB-1021x1024.png');?>" alt="Windcloud 4.0 GmbH Logo" title="Windcloud 4.0 GmbH Logo">              </div>
                                <div class="icon-download text-center">Logo</div>
                            </div>
                        </a>
                    </div>
                    <div class="carousel-item  " style="min-height: 0px;">
                        <a download="" href="<?= Url::to('@web/image/WIND_Logo_Bildmarke_RGB.png');?>">
                            <div class="adjust-h" style="min-height: 0px;">
                                <div class="pic">
                                    <img srcset="<?= Url::to('@web/image/WIND_Logo_Bildmarke_RGB.png');?> 1564w, <?= Url::to('@web/image/WIND_Logo_Bildmarke_RGB-300x231.png');?> 300w, <?= Url::to('@web/image/WIND_Logo_Bildmarke_RGB-768x592.png');?> 768w, <?= Url::to('@web/image/WIND_Logo_Bildmarke_RGB-1024x790.png');?> 1024w, <?= Url::to('@web/image/WIND_Logo_Bildmarke_RGB-1200x925.png');?> 1200w" sizes="(min-width: 1200px) 1110px, (min-width: 992px) 930px, (min-width: 768px) 690px, (min-width: 576px) 510px, calc(100vw - 30px)" src="<?= Url::to('@web/image/WIND_Logo_Bildmarke_RGB-1024x790.png');?>" alt="Windcloud 4.0 GmbH Logo" title="Windcloud 4.0 GmbH Logo">              </div>
                                <div class="icon-download text-center">Bildmarke</div>
                            </div>
                        </a>
                    </div>

                </div>
                <a class="carousel-control-prev" href="#carousel-logo" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon blue" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-logo" role="button" data-slide="next">
                    <span class="carousel-control-next-icon blue" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

        <div id="visual" class="margin-b">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h2 class="vary mb-3">Visuals</h2>
                    <p class="mb-4">Hier finden Sie Grafiken unserer Infrastruktur in hoher Auflösung zum Download zur Bebilderung Ihres Artikels (Copyright Windcloud 2018).</p>
                </div>
                <div class="col-12 col-md-6 mb-4">
                    <a download="" href="<?= Url::to('@web/image/Platten-Formation01.png');?>">
                        <div class="pic">
                            <img srcset="<?= Url::to('@web/image/Platten-Formation01.png');?> 5600w, <?= Url::to('@web/image/Platten-Formation01-300x188.png');?> 300w, <?= Url::to('@web/image/Platten-Formation01-768x481.png');?> 768w, <?= Url::to('@web/image/Platten-Formation01-1024x641.png');?> 1024w, <?= Url::to('@web/image/Platten-Formation01-1200x752.png');?> 1200w" sizes="(min-width: 1200px) 540px, (min-width: 992px) 450px, (min-width: 768px) 330px, (min-width: 576px) 510px, calc(100vw - 30px)" src="<?= Url::to('@web/image/Platten-Formation01-1024x641.png');?>" alt="Rechenzentrum mit Windpark und Abwärme-Veredlung als 3D-Visual" title="CO2-neutrales Rechenzentrum | Windcloud 4.0 GmbH">        </div>
                        <div class="icon-download text-center">Aufbauplan</div>
                    </a>
                </div>
            </div>


            <div class="row d-none d-md-flex">

                <div class="col-md-4 mb-3">
                    <a download="" href="<?= Url::to('@web/image/Windcloud-kaserne.png');?>">
                        <div class="img-tile">
                            <div class="img">
                                <img srcset="<?= Url::to('@web/image/Windcloud-kaserne.png');?> 4960w, <?= Url::to('@web/image/Windcloud-kaserne-300x212.png');?> 300w, <?= Url::to('@web/image/Windcloud-kaserne-768x543.png');?> 768w, <?= Url::to('@web/image/Windcloud-kaserne-1024x724.png');?> 1024w, <?= Url::to('@web/image/Windcloud-kaserne-1200x848.png');?> 1200w" sizes="(min-width: 1200px) 445px, (min-width: 992px) 370px, (min-width: 768px) 270px, (min-width: 576px) 510px, calc(100vw - 30px)" src="<?= Url::to('@web/image/Windcloud-kaserne-1024x724.png');?>" alt="Rechenzentrum als 3D-Visual" title="Rechenzentrum | Windcloud 4.0 GmbH">              </div>
                        </div>
                        <div class="icon-download text-center">Rechenzentren</div>
                    </a>
                </div>


                <div class="col-md-4 mb-3">
                    <a download="" href="<?= Url::to('@web/image/Windcloud-windraeder.png');?>">
                        <div class="img-tile">
                            <div class="img">
                                <img srcset="<?= Url::to('@web/image/Windcloud-windraeder.png');?> 4960w, <?= Url::to('@web/image/Windcloud-windraeder-300x212.png');?> 300w, <?= Url::to('@web/image/Windcloud-windraeder-768x543.png');?> 768w, <?= Url::to('@web/image/Windcloud-windraeder-1024x724.png');?> 1024w, <?= Url::to('@web/image/Windcloud-windraeder-1200x848.png');?> 1200w" sizes="(min-width: 1200px) 445px, (min-width: 992px) 370px, (min-width: 768px) 270px, (min-width: 576px) 510px, calc(100vw - 30px)" src="<?= Url::to('@web/image/Windcloud-windraeder-1024x724.png');?>" alt="Windpark als 3D-Visual" title="Windpark | Windcloud 4.0 GmbH">              </div>
                        </div>
                        <div class="icon-download text-center">Windräder</div>
                    </a>
                </div>


                <div class="col-md-4 mb-3">
                    <a download="" href="<?= Url::to('@web/image/Windcloud-treibhaus.png');?>">
                        <div class="img-tile">
                            <div class="img">
                                <img srcset="<?= Url::to('@web/image/Windcloud-treibhaus.png');?> 4960w, <?= Url::to('@web/image/Windcloud-treibhaus-300x212.png');?> 300w, <?= Url::to('@web/image/Windcloud-treibhaus-768x543.png');?> 768w, <?= Url::to('@web/image/Windcloud-treibhaus-1024x724.png');?> 1024w, <?= Url::to('@web/image/Windcloud-treibhaus-1200x848.png');?> 1200w" sizes="(min-width: 1200px) 445px, (min-width: 992px) 370px, (min-width: 768px) 270px, (min-width: 576px) 510px, calc(100vw - 30px)" src="<?= Url::to('@web/image/Windcloud-treibhaus-1024x724.png');?>" alt="Abwärme-Veredelung durch Vertical Farming als 3D-Visual" title="Abwärme-Veredelung | Windcloud 4.0 GmbH">              </div>
                        </div>
                        <div class="icon-download text-center">Gewächshaus</div>
                    </a>
                </div>

            </div>

            <div id="carousel-visual" class="carousel slide d-md-none" data-ride="carousel">
                <div class="carousel-inner">

                    <div class="carousel-item active" style="min-height: 0px;">
                        <a download="" href="<?= Url::to('@web/image/Windcloud-kaserne.png');?>">
                            <div class="img-tile">
                                <div class="img">
                                    <img srcset="<?= Url::to('@web/image/Windcloud-kaserne.png');?> 4960w, <?= Url::to('@web/image/Windcloud-kaserne-300x212.png');?> 300w, <?= Url::to('@web/image/Windcloud-kaserne-768x543.png');?> 768w, <?= Url::to('@web/image/Windcloud-kaserne-1024x724.png');?> 1024w, <?= Url::to('@web/image/Windcloud-kaserne-1200x848.png');?> 1200w" sizes="(min-width: 1200px) 1110px, (min-width: 992px) 930px, (min-width: 768px) 690px, (min-width: 576px) 510px, calc(100vw - 30px)" src="<?= Url::to('@web/image/Windcloud-kaserne-1024x724.png');?>" alt="Rechenzentrum als 3D-Visual" title="Rechenzentrum | Windcloud 4.0 GmbH">              </div>
                            </div>
                            <div class="icon-download text-center">Rechenzentren</div>
                        </a>
                    </div>
                    <div class="carousel-item  " style="min-height: 0px;">
                        <a download="" href="<?= Url::to('@web/image/Windcloud-windraeder.png');?>">
                            <div class="img-tile">
                                <div class="img">
                                    <img srcset="<?= Url::to('@web/image/Windcloud-windraeder.png');?> 4960w, <?= Url::to('@web/image/Windcloud-windraeder-300x212.png');?> 300w, <?= Url::to('@web/image/Windcloud-windraeder-768x543.png');?> 768w, <?= Url::to('@web/image/Windcloud-windraeder-1024x724.png');?> 1024w, <?= Url::to('@web/image/Windcloud-windraeder-1200x848.png');?> 1200w" sizes="(min-width: 1200px) 1110px, (min-width: 992px) 930px, (min-width: 768px) 690px, (min-width: 576px) 510px, calc(100vw - 30px)" src="<?= Url::to('@web/image/Windcloud-windraeder-1024x724.png');?>" alt="Windpark als 3D-Visual" title="Windpark | Windcloud 4.0 GmbH">              </div>
                            </div>
                            <div class="icon-download text-center">Windräder</div>
                        </a>
                    </div>
                    <div class="carousel-item  " style="min-height: 0px;">
                        <a download="" href="<?= Url::to('@web/image/Windcloud-treibhaus.png');?>">
                            <div class="img-tile">
                                <div class="img">
                                    <img srcset="<?= Url::to('@web/image/Windcloud-treibhaus.png');?> 4960w, <?= Url::to('@web/image/Windcloud-treibhaus-300x212.png');?> 300w, <?= Url::to('@web/image/Windcloud-treibhaus-768x543.png');?> 768w, <?= Url::to('@web/image/Windcloud-treibhaus-1024x724.png');?> 1024w, <?= Url::to('@web/image/Windcloud-treibhaus-1200x848.png');?> 1200w" sizes="(min-width: 1200px) 1110px, (min-width: 992px) 930px, (min-width: 768px) 690px, (min-width: 576px) 510px, calc(100vw - 30px)" src="<?= Url::to('@web/image/Windcloud-treibhaus-1024x724.png');?>" alt="Abwärme-Veredelung durch Vertical Farming als 3D-Visual" title="Abwärme-Veredelung | Windcloud 4.0 GmbH">              </div>
                            </div>
                            <div class="icon-download text-center">Gewächshaus</div>
                        </a>
                    </div>

                </div>
                <a class="carousel-control-prev" href="#carousel-visual" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon blue" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-visual" role="button" data-slide="next">
                    <span class="carousel-control-next-icon blue" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

        <img class="shadow-line" src="<?= Url::to('@web/img/schatten.png');?>">


        <div id="bottom-teaser" class="row margin-b">
            <div class="col-12 col-sm">
                <a href="/unternehmen/ueber-uns">
                    <div class="bg-white box-shadow">
                        <div class="row">
                            <div class="col-12 col-xl-9">
                                <h5 class="vary">Wer sind wir?</h5>
                                <h4 class="vary text-uppercase">Windcloud ist Bauherr und Betreiber grüner Rechenzentren in Nord­deutschland.</h4>
                                <div class="arrow border">Mehr</div>
                            </div>
                        </div>
                    </div>
                    <div class="img-tile">
                        <div class="img">
                            <img srcset="<?= Url::to('@web/image/Windcloud-kaserne.png');?> 4960w, <?= Url::to('@web/image/Windcloud-kaserne-300x212.png');?> 300w, <?= Url::to('@web/image/Windcloud-kaserne-768x543.png');?> 768w, <?= Url::to('@web/image/Windcloud-kaserne-1024x724.png');?> 1024w, <?= Url::to('@web/image/Windcloud-kaserne-1200x848.png');?> 1200w" sizes="(min-width: 1200px) 445px, (min-width: 992px) 370px, (min-width: 768px) 270px, (min-width: 576px) 420px, calc(83vw - 30px)" src="<?= Url::to('@web/image/Windcloud-kaserne-1024x724.png');?>" alt="Rechenzentrum als 3D-Visual" title="Rechenzentrum | Windcloud 4.0 GmbH">        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-1"></div>
            <div class="col-12 col-sm">
                <a href="/unternehmen/oekosystem">
                    <div class="bg-white box-shadow">
                        <div class="row">
                            <div class="col-12 col-xl-9">
                                <div>
                                    <h5 class="vary">Wie funktioniert Windcloud?</h5>
                                    <h4 class="vary text-uppercase">Unsere Rechenzentren bilden den Kern eines digital-industriellen Ökosystems.</h4>
                                    <div class="arrow border">Mehr</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="img-tile">
                        <div class="img">
                            <img srcset="<?= Url::to('@web/image/Windcloud-windraeder.png');?> 4960w, <?= Url::to('@web/image/Windcloud-windraeder-300x212.png');?> 300w, <?= Url::to('@web/image/Windcloud-windraeder-768x543.png');?> 768w, <?= Url::to('@web/image/Windcloud-windraeder-1024x724.png');?> 1024w, <?= Url::to('@web/image/Windcloud-windraeder-1200x848.png');?> 1200w" sizes="(min-width: 1200px) 445px, (min-width: 992px) 370px, (min-width: 768px) 270px, (min-width: 576px) 420px, calc(83vw - 30px)" src="<?= Url::to('@web/image/Windcloud-windraeder-1024x724.png');?>" alt="Windpark als 3D-Visual" title="Windpark | Windcloud 4.0 GmbH">        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <?php
    $this->registerCssFile("/css/cms/style-presse.css");
    ?>


