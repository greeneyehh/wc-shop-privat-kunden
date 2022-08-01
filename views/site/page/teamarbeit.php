<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>
    <div class="container">
<div id="hero" class="row margin-b header" style="margin-bottom: -2rem!important;">
    <div class="col-6">
        <h1>Sicher und effizient zusammenarbeiten</h1>
        <h2 class="vary">TEAMARBEIT MIT WINDCLOUD
        </h2>
        <p class="d-none d-md-block">Mit den <strong>nachhaltigen Cloud-Lösungen</strong> von Windcloud können Sie Ihre Teamarbeit einfach und flexibel organisieren. Wir hosten Ihre Daten und Workloads ausschließlich in unseren <strong>CO2-freien Rechenzentren</strong> in Norddeutschland.</p>

    </div>
    <div class="col">
        <div class="pic">
            <div class="diamond top"><div class="box"><div class="trans"></div></div></div>
            <img class="net" srcset="<?= Url::to('@web/image/Windcloud-net.png');?> 2000w, <?= Url::to('@web/image/Windcloud-net-300x212.png');?> 300w, <?= Url::to('@web/image/Windcloud-net-768x543.png');?> 768w, <?= Url::to('@web/image/Windcloud-net-1024x724.png');?> 1024w, <?= Url::to('@web/image/Windcloud-net-1200x848.png ');?> 1200w" sizes="(min-width: 1200px) 540px, (min-width: 992px) 450px, (min-width: 768px) 330px, (min-width: 576px) 510px, calc(100vw - 30px)" src="<?= Url::to('@web/image/Windcloud-net-1024x724.png');?>" title="Windcloud-net">
            <div class="small-tile move-in-2">
                <div class="img-tile levitate-3">
                    <div class="img">
                        <img srcset="<?= Url::to('@web/image/Windcloud-windraeder-klein.png');?>  4960w, <?= Url::to('@web/image/Windcloud-windraeder-klein-300x212.png');?> 300w, <?= Url::to('@web/image/Windcloud-windraeder-klein-768x543.png');?> 768w, <?= Url::to('@web/image/Windcloud-windraeder-klein-1024x724.png');?> 1024w, <?= Url::to('@web/image/Windcloud-windraeder-klein-1200x848.png');?> 1200w" sizes="(min-width: 1200px) 445px, (min-width: 992px) 370px, (min-width: 768px) 270px, (min-width: 576px) 420px, calc(83vw - 30px)" src="<?= Url::to('@web/image/Windcloud-windraeder-klein-1024x724.png');?>" alt="Sicheres Rechenzentrum als 3D-Visual" title="Sichere Rechenzentren | Windcloud 4.0 GmbH">          </div>
                    <div class="box small"><div class="trans"></div></div>
                </div>
            </div>

            <div class="big-tile move-in-3">
                <div class="img-tile levitate-5">
                    <div class="img">
                        <img srcset="<?= Url::to('@web/image/Windcloud-kaserne.png');?>  4960w, <?= Url::to('@web/image/Windcloud-kaserne-300x212.png');?> 300w, <?= Url::to('@web/image/Windcloud-kaserne-768x543.png');?> 768w, <?= Url::to('@web/image/Windcloud-kaserne-1024x724.png');?> 1024w, <?= Url::to('@web/image/Windcloud-kaserne-1200x848.png ');?> 1200w" sizes="(min-width: 1200px) 445px, (min-width: 992px) 370px, (min-width: 768px) 270px, (min-width: 576px) 420px, calc(83vw - 30px)" src="<?= Url::to('@web/image/Windcloud-kaserne-1024x724.png');?>" alt="Rechenzentrum als 3D-Visual" title="Rechenzentrum | Windcloud 4.0 GmbH">          </div>
                    <div class="box"><div class="trans"></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 d-md-none">
        <p>Windcloud ist mehr als ein <strong>Cloud Hosting Provider</strong>. Wir besitzen und betreiben unser eigenes Rechenzentrumsnetzwerk. Dadurch haben wir die volle Kontrolle über unsere <strong>Cloud-Lösungen</strong> – von der <strong>Energieversorgung</strong> bis zum Schutz der <strong>IT-Ressourcen</strong>.</p>
    </div>
</div>
<div class="content margin-b footer-info" style="margin-bottom: 9rem;">
<div class="row">
    <div class="col-1"></div>
<div class="col-5">
    <div class="card card-left">
        <div class="card-body">
            <h2 class="text-uppercase">Videokonferenzen einfach & sicher
            </h2>
            <h5>mit Jitsi Meet</h5>

                <ul>
                    <li>Videokonferenz, Chat & Screen Sharing</li>
                    <li>DSGVO-konform</li>
                    <li>Beste Performance bei höchster Sicherheit</li>
                    <li>Deutsches Rechenzentrum</li>
                    <li>CO2-frei durch echten Grünstrom</li>
                </ul>

            <h2 class="text-uppercase text-left">
                Kostenlos!
            </h2>
            <div style="text-align: center">
                <a class="border mobile-fill text-center a-left" href="https://meet.windcloud.de/">Jetzt direkt starten!</a>
            </div>
            <div class="meet-link" style="margin-bottom: 20px;">
            <a  target='_blank' class="meet-link-a" href='/pdf-download?file=Anwenderleitfaden_Windcloud_Meet.pdf' >Anwenderleitfaden Windcloud Meet</a>
            </div>
        </div>
    </div>
</div>

<div class="col-5">
    <div class="card card-right">
        <div class="card-body">
            <h2 class="text-uppercase">
                Cloud Storage für Teamarbeit
            </h2>
            <h5>unsere Managed Nextcloud</h5>

                <ul>
                    <li>Daten in der Cloud speichern & teilen</li>
                    <li>Einfach Gruppen- und Benutzerverwaltung</li>
                    <li>Dokumente gemeinsam online bearbeiten</li>
                    <li>CO2-freies Rechenzentrum</li>
                    <li>DSGVO-konform & ISO 27001-zertifiziert</li>
                </ul>

            <h2 class="text-uppercase text-right">
                ab 15 € / Monat
            </h2>
            <div style="text-align: center">
                <a class="border mobile-fill text-center a-right" href="produkte/nextcloud">Zum Nextcloud-Angebot</a>
            </div>
            <div class="meet-link" style="margin-bottom: 20px;">

            </div>
        </div>
    </div>
</div>
    <div class="col-1"></div>

</div>

    <img class="shadow-line" src="/img/schatten.png" alt="shadow-line">
    <div class="row ">
        <div class="col-1"></div>
        <div class="col-7">
            <h2 class="vary mb-3">Was macht Windcloud?</h2>
            <p>Wir betreiben CO2-freie Rechenzentren. An unserem Standort in Nordfriesland (Schleswig-Holstein) beziehen wir bereits heute zu 100 % Strom aus Erneuerbaren Energien, zum größten Teil aus Windenergie. Auf dieser Basis bieten wir unseren Kunden nachhaltige Cloud-Lösungen und Colocation-Flächen. Unsere Produkte und Services sind DSGVO-konform, ISO 27001-zertifiziert und durch ein umfassendes IT-Sicherheitskonzept vor Attacken und unbefugten Zugriffen geschützt.</p>
        </div>
        <div class="col-3"><img srcset="<?= Url::to('@web/image/Windcloud-windraeder-klein-logo.png');?>" alt="Rechenzentrum als 3D-Visual" title="Rechenzentrum | Windcloud 4.0 GmbH"> </div>
        <div class="col-1"></div>
        <div class="col-1"></div>
        <div class="col-7">
            <a class="border mobile-fill text-center readmore" href="/">Mehr erfahren!</a>
        </div>
        <div class="col-3"></div>
        <div class="col-1"></div>
    </div>





</div>
</div>

<?php
$this->registerCssFile("/css/cms/style-teamarbeit.css");
?>