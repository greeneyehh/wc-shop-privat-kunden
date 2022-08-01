<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use app\module\ProduktKontakt\KontaktWidget;
?>
    <div class="container">

        <div id="hero" class="row">
            <div class="col-8 col-lg-5">
                <h1>Klimafreundlich, sicher und hochverfügbar</h1>
                <h2 class="vary">PRODUKTE</h2>
                <p class="d-none d-md-block">Digitalisierung geht auch nachhaltig. Mit unseren Cloud- und Colocation-Lösungen profitieren Sie von leistungsstarken Infrastrukturen, die zu 100% mit physikalisch grünem Strom versorgt werden.</p>
            </div>
            <div class="col mb-4">
                <div class="pic">
                    <div class="diamond top"><div class="box"><div class="trans"></div></div></div>
                    <img class="net" srcset="<?= Url::to('@web/image/Windcloud-net.png')?> 2000w,  <?= Url::to('@web/image/Windcloud-net-300x212.png');?> 300w,  <?= Url::to('@web/image/Windcloud-net-768x543.png');?>  768w,   <?=Url::to('@web/image/Windcloud-net-1024x724.png');?> 1024w,  <?= Url::to('@web/image/Windcloud-net-1200x848.png');?>  1200w" sizes="(min-width: 1200px) 540px, (min-width: 992px) 450px, (min-width: 768px) 330px, (min-width: 576px) 510px, calc(100vw - 30px)" src="<?= Url::to('@web/image/Windcloud-net-1024x724.png');?>" title="Windcloud-net" alt="Netz">

                    <div class="big-tile move-in-3">
                        <div class="img-tile levitate-5">
                            <div class="img">
                                <img srcset="<?= Url::to('@web/image/Windcloud-Rechenzentrum.png')?>  4960w, <?= Url::to('@web/image/Windcloud-Rechenzentrum-300x212.png');?> 300w, <?= Url::to('@web/image/Windcloud-Rechenzentrum-768x543.png');?> 768w, <?= Url::to('@web/image/Windcloud-Rechenzentrum-1024x724.png');?> 1024w, <?= Url::to('@web/image/Windcloud-Rechenzentrum-1200x848.png');?>  1200w" sizes="(min-width: 1200px) 445px, (min-width: 992px) 370px, (min-width: 768px) 270px, (min-width: 576px) 420px, calc(83vw - 30px)" src="<?= Url::to('@web/image/Windcloud-Rechenzentrum-1024x724.png');?>" alt="Rechenzentrum als 3D-Visual" title="Rechenzentrum | Windcloud 4.0 GmbH">          </div>
                            <div class="box"><div class="trans"></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-c-turkis border-radius-d mb-4 pad">
            <div class="col-12">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-6 mb-4">
                        <strong class="mb-0">Colocation und Housing</strong>
                        <h2 class="vary">CO<sub>2</sub> LOCATION</h2>
                        <ul>
                            <li>Strompreis 19 Cent / kWh</li>
                            <li>40 Carrier verfügbar</li>
                            <li>Bandbreite bis zu 1 Tbit</li>
                        </ul>
                    </div>
                    <div class="col-12 col-lg-6 text-right">
                        <h3 class="mb-0 d-none">ab 5 €/Monat</h3>
                        <br>
                        <a class="border mobile-fill anim-1 show" href="/produkte/colocation">zum Angebot &gt;</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-md-block">
            <div class="row">
                <div class="col-12 col-lg-6 mb-4">
                    <div class="bg-darkblue border-radius-d box-shadow adjust-h">
                        <div class="p-3">
                            <strong class="mb-0">Iaas-Lösungen von Windcloud</strong>
                            <h2 class="vary">INFRASTRUCTURE AS A SERVICE</h2>
                            <ul>
                                <li>Software Defined Datacenter</li>
                                <li>VMware vCloud</li>
                                <li>Container Service Extension (CSE)</li>
                            </ul>
                            <h3 class="mb-0 d-none">ab 2 €/Monat</h3>
                            <a class="border mobile-fill anim-1 show" href="/produkte/infrastructure-as-a-service">zum Angebot &gt;</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6 mb-4">
                    <div class="bg-darkblue border-radius-d box-shadow adjust-h">
                        <div class="p-3">
                            <strong class="mb-0">Für Server und Virtuelle Infrastrukturen</strong>
                            <h2 class="vary">CLOUD<br>BACKUP</h2>
                            <ul>
                                <li>Backup as a Service</li>
                                <li>Desaster Recovery</li>
                                <li>Veeam und VMware</li>
                            </ul>
                            <h3 class="mb-0 d-none">ab 159 € €/Monat</h3>
                            <a class="border mobile-fill anim-1 show" href="/produkte/cloud-backup">zum Angebot &gt;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-md-block mb-5">
            <div class="row">
                <div class="col-12 col-lg-6 mb-4">
                    <div class="bg-darkblue border-radius-d box-shadow adjust-h">
                        <div class="p-3">
                            <strong class="mb-0">Daten einfach speichern, teilen und bearbeiten</strong>
                            <h2 class="vary">MANAGED NEXTCLOUD</h2>
                            <ul>
                                <li>DSGVO-konform</li>
                                <li>Verschlüsselte Datenübertragung</li>
                                <li>Redundante Datensicherung</li>
                            </ul>
                            <h3 class="mb-0 d-none">ab 2 €/Monat</h3>
                            <a class="border mobile-fill anim-1 show" href="/produkte/managed-nextcloud">zum Angebot &gt;</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6 mb-4">
                    <div class="bg-darkblue border-radius-d box-shadow adjust-h">
                        <div class="p-3">
                            <strong class="mb-0">Klimafreundliche und sichere VPS</strong>
                            <h2 class="vary">VIRTUAL PRIVATE SERVER</h2>
                            <ul>
                                <li>SSD-Speicher</li>
                                <li>Windows oder Linux</li>
                                <li>Optionales Backup</li>
                            </ul>
                            <h3 class="mb-0 d-none">ab 159 € /Monat</h3>
                            <a class="border mobile-fill anim-1 show" href="/produkte/vps">zum Angebot &gt;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="margin-b text-center m-6">
            <strong>Wir beraten Sie gerne, damit Sie die optimale Lösung für Ihre IT-Infrastruktur finden.<br>Darüber hinaus unterstützen wir Sie gerne bei Projektierung und Onboarding.</strong>
            <br><br>
            <a class="border mobile-fill anim-1 show" href="/kontakt">Kontaktieren Sie uns!</a>
        </div>

        <div class="bg-c-white border-radius-d margin-b pad">
            <h3 class="vary mb-4">SICHERHEIT</h3>
            <div class="column-count">
                <ul>
                    <li>Rechenzentrumsstandort Deutschland</li>
                    <li>Zertifizierung nach EN 50600 VK 3</li>
                    <li>Redundante, unterbrechungsfreie Stromversorgung<br>(USV) mit Notstromaggregaten (n+1)</li>
                    <li>4-fach redundante Glasfaseranbindung (bis 1 Tbit)</li>
                    <li>Mehrstufiges Zonen-Sicherheitskonzept</li>
                    <li>Automatische Brandfrüherkennung und Löschanlage</li>
                    <li>Firewall</li>
                    <li>Schutz vor DDoS-Attacken</li>
                    <li>24/7 Service &amp; Support</li>
                </ul>
            </div>
        </div>

        <div class="d-md-block margin-b">
            <div class="row">

                <div class="col-12 col-md-3 mb-4 text-center icons">
                    <img height="150px" src="<?= Url::to('@web/image/Windcloud_Icon-Nachhaltig.svg');?>" alt="NACHHALTIGKEIT">
                    <br>
                    <strong>NACHHALTIG</strong>
                    <p>100% grüner Strom<br>und Abwärmeveredelung</p>
                </div>

                <div class="col-12 col-md-3 mb-4 text-center icons">
                    <img height="150px" src="<?= Url::to('@web/image/Windcloud_Icon-SSL.svg');?>" alt="Deutsches Rechenzentrum">
                    <br>
                    <strong>SICHER</strong>
                    <p>Zertifiziertes Rechenzentrum<br>nach EN 50600 VK 3</p>
                </div>

                <div class="col-12 col-md-3 mb-4 text-center icons">
                    <img height="150px" src="<?= Url::to('@web/image/Windcloud_Icon-DSGVO.svg');?>" alt="DSGVO konform">
                    <br>
                    <strong>DSGVO–KONFORM</strong>
                    <p>Rechenzentrums- und Unternehmenssitz in Deutschland</p>
                </div>

                <div class="col-12 col-md-3 mb-4 text-center icons">
                    <img height="150px" src="<?= Url::to('@web/image/Windcloud_Icon-Support.svg');?>" alt="DSGVO konform">
                    <br>
                    <strong>SUPPORT</strong>
                    <p>24/7 E-Mail-<br>und Telefon-Support</p>
                </div>

            </div>
        </div>

    </div>

<?php
$this->registerCssFile("/css/cms/style-produkte.css");
?>
