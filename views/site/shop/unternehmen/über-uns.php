<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="container-fluid">
<video playsinline autoplay muted loop poster="<?= Url::to('@web/image/polina.jpg');?>" id="bgvid" style="width: 100%">
    <source src="<?= Url::to('@web/video/WindcloudClips01-500px.webm');?>" type="video/webm">
</video>

<div class="container">

<div id="hero">
    <h2 class="vary">WIR SIND WINDCLOUD</h2>
    <h1>Windcloud ist der nachhaltige Rechenzentrumsbetreiber und Anbieter für Cloud- und
        Colocation-Lösungen aus dem hohen Norden Deutschlands.</h1>
</div>
    <div class="d-md-block">
        <div class="column-count margin-b">
            <p>
                Unsere Besonderheit: Wir versorgen unser Rechenzentrum
                zu 100 % mit physikalisch echtem Grünstrom, größtenteils
                aus Windenergie. Darüber hinaus haben wir ein Konzept für
                die Nachnutzung der entstehenden Abwärme entwickelt.
                Auf dem Dach unseres Rechenzentrums haben wir eine

                Algenfarm gebaut, die wir mit der Abwärme der Server
                beheizen. Dadurch können wir unser Rechenzentrum nicht
                nur CO2-frei betreiben, sondern auch zusätzlich CO2 aus der
                Umwelt absorbieren.
            </p>
        </div>
        <div class="bg-gray border-radius-d margin-b">
            <h3 class="vary mb-4 font-size-2 text-transform-uppercase font-weight-bold text-center">DAS UNTERNEHMEN</h3>
            <div class="column-count">
                <ul>
                    <li>Gegründet im Jahr 2018</li>
                    <li>Mehr als 200 Kunden</li>
                    <li>2 Standorte in Nordfriesland</li>
                    <li>100 % physikalisch echter Grünstrom</li>
                    <li>1 Algenfarm zur Abwärme-Nachnutzung</li>
                    <li>99,99 % Verfügbarkeit unseres Rechenzentrums</li>
                    <li>Anbindung ans globale Datennetz mit bis zu 1 Tbit / s</li>
                    <li>Mehrstufiges Zonen-Sicherheitskonzept</li>
                    <li>24 / 7 Support</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="d-md-block">
        <div class="row">
            <div class="col-12 col-lg-6 mb-4">
                <h1>Unsere Vision</h1>
                <h2 class="text-transform-none font-size-1 font-weight-bold">Mit dem Betrieb von
                Rechenzentren mehr
                CO2 zu absorbieren<br> als
                auszustoßen.</h2>
            </div>
            <div class="col-12 col-lg-6 mb-4">
                <h1>Unsere Standort</h1>
                <h2 class="vary">NORDFRIESLAND</h2>
                <p>
                Wir haben uns bewusst für den Standort Nordfriesland an
                der Westküste Schleswig-Holsteins entschieden. Neben der
                sicheren Versorgung mit Erneuerbarer Energie haben wir
                hier ein innovatives Umfeld aus nachhaltigen Technologie-
                Unternehmen gefunden, etwa auf dem GreenTEC Campus in
                Enge-Sande. Hier haben wir unseren Unternehmenssitz und
                betreiben unser Rechenzentrum.<br>
                In Bramstedtlund haben wir zudem ein ehemaliges
                Militärareal erworben, das wir in den kommenden Jahren in
                einen grünen Gewerbepark umwandeln werden. Hier sollen
                Rechenzentren in Kombination mit verschiedenen
                Konzepten zur Abwärme-Nachnutzung entstehen.
                </p>
            </div>
        </div>
    </div>

    <div class="d-md-block" style="padding-top: 4rem;display: none;">
        <h2 style="display: none;" class="vary text-center">DAS TEAM</h2>
    </div>
    <div class="d-md-block" style="display: none;">
        <div class="row align-items-center" style="display: none;">
            <div class="col-12 col-md-6 col-lg-3 mb-4 team-col" style="margin-left: auto !important;margin-right: auto !important;">
                <div class="team">
                    <img class="team-img" src="<?= Url::to('@web/image/team/WILFRIED-RITTER.webp');?>">
                </div>
                <h1>CEO / Co-Founder</h1>
                <h2 class="vary font-size-3">WILFRIED<br>RITTER</h2>
                <p>Infrastruktur & Operations&nbsp<br>&nbsp;</p>
            </div>

            <div class="col-12 col-md-6 col-lg-3 mb-4 team-col" style="margin-left: auto !important;margin-right: auto !important;">
                <div class="team">
                    <img class="team-img" src="<?= Url::to('@web/image/team/STEPHAN-SLADEK.webp');?>">
                </div>
                <h1>CTO</h1>
                <h2 class="vary font-size-3">STEPHAN<br>SLADEK</h2>
                <p>Produkte & Services<br>&nbsp;</p>
            </div>
        </div>
    </div>
</div>
</div>

<div class="container">


<div class="membership margin-b z-index" style="padding-top: 2rem;">
    <h2 class="vary">Partner</h2>
    <h1 style="padding-bottom: 1rem;">Unsere Gesellschafter</h1>
    <div class="row">
        <div class="col-12 col-md-4 mb-4">
            <div class="bg-white border-radius-d adjust-h" style="height: 100%">

                <a href="https://www.greentec-campus.de/" target="_blank" title="GreenTEC Campus">
                    <div class="img">
                        <img srcset="<?= Url::to('@web/image/logo-greentec-campus.jpg');?> 620w, <?= Url::to('@web/image/logo-greentec-campus-300x150.jpg');?> 300w" sizes="(min-width: 1200px) 350px, (min-width: 992px) 290px, (min-width: 768px) 210px, (min-width: 576px) 420px, calc(83vw - 30px)" src="<?= Url::to('@web/image/logo-greentec-campus.jpg');?>" alt="Logo GreenTEC Campus" title="GreenTEC Campus">    </div>

                    <div class="p-4">
                        <h3 class="vary" style="min-height: 29px;">GreenTEC Campus</h3><p>Der GreenTEC Campus in Enge-Sande ist Standort für innovative Unternehmen in den Bereichen Erneuerbare Energie, E-Mobilität und Green Data.</p>    </div>

                </a>
            </div>
        </div>
        <div class="col-12 col-md-4 mb-4">
            <div class="bg-white border-radius-d adjust-h" style="height: 100%">

                <a href="https://denkerwulf.de/" target="_blank" title="Denker &amp; Wulf AG">
                    <div class="img">
                        <img srcset="<?= Url::to('@web/image/logo-denker-wulf-ag.jpg');?> 620w, <?= Url::to('@web/image/logo-denker-wulf-ag-300x150.jpg');?> 300w" sizes="(min-width: 1200px) 350px, (min-width: 992px) 290px, (min-width: 768px) 210px, (min-width: 576px) 420px, calc(83vw - 30px)" src="<?= Url::to('@web/image/logo-denker-wulf-ag.jpg');?>" alt="Logo Denker &amp; Wulf AG" title="Denker &amp; Wulf AG">    </div>

                    <div class="p-4">
                        <h3 class="vary" style="min-height: 29px;">Denker &amp; Wulf AG</h3><p>Die Denker &amp; Wulf AG gehört zu den wichtigsten Windparkentwicklern Deutschlands. Sie betreibt etwa 700 Windkraftanlagen mit mehr als 1,4 GW installierter Leistung.</p>    </div>

                </a>
            </div>
        </div>
        <div class="col-12 col-md-4 mb-4">
            <div class="bg-white border-radius-d adjust-h" style="height: 100%">

                <a href="http://www.abe-gruppe.de/" target="_blank" title="ABE Group">
                    <div class="img">
                        <img srcset="<?= Url::to('@web/image/logo-abe-group-2.jpg');?> 620w, <?= Url::to('@web/image/logo-abe-group-2-300x150.jpg');?> 300w" sizes="(min-width: 1200px) 350px, (min-width: 992px) 290px, (min-width: 768px) 210px, (min-width: 576px) 420px, calc(83vw - 30px)" src="<?= Url::to('@web/image/logo-abe-group-2.jpg');?>" alt="Logo ABE Group" title="ABE">    </div>

                    <div class="p-4">
                        <h3 class="vary" style="min-height: 29px;">ABE Group</h3><p>Die ABE Group ist Planer, Bauer &amp; Betreiber von Umspannwerken, Mittelspannungsnetzen und Groß-Speichermedien im GW-Bereich.</p>    </div>

                </a>
            </div>
        </div>
    </div>
</div>

    <div class="membership margin-b z-index">
        <h1 style="padding-bottom: 1rem;">Unsere Partner</h1>
        <div class="bg-white border-radius-d">
            <div class="row align-items-center">
                <div class="logo col-8 col-md-2 mx-auto">
                    <a href="https://www.cloudron.io" target="_blank" title="Cloudron">
                        <img src="<?= Url::to('@web/image/cloudron-logo.png');?>" alt="Cloudron" title="Cloudron" height="68px"></a>
                </div>
                <div class="logo col-8 col-md-2 mx-auto">
                    <a href="https://de.novastor.com" target="_blank" title="NovaStore">
                        <img src="<?= Url::to('@web/image/1953acf5c8260519772e08d521b1ccb501713621.png');?>" alt="NovaStore" title="NovaStore" height="68px"></a>
                </div>
                <div class="logo col-8 col-md-2 mx-auto">
                    <a href="https://cloudogu.com/de/" target="_blank" title="Cloudogu">
                        <img src="<?= Url::to('@web/image/Cloudogu_Wort+Bild_blau.png');?>" alt="Cloudogu" title="Cloudogu" height="68px"></a>
                </div>
                <div class="logo col-8 col-md-2 mx-auto">
                    <a href="https://dierck-gruppe.de" target="_blank" title="Dierck Gruppe">
                        <img src="<?= Url::to('@web/image/dierck-gruppe.png');?>" alt="Dierck Gruppe" title="Dierck Gruppe" height="68px"></a>
                </div>

            </div>
        </div>
    </div>

<div class="membership margin-b z-index">
    <h1 style="padding-bottom: 1rem;">Unsere Partner für den Rechenzentrumsbetrieb</h1>
    <div class="bg-white border-radius-d">
        <div class="row align-items-center">
            <div class="logo col-8 col-md-2 mx-auto">
                <a href="https://www.de-cix.net/" target="_blank" title="Deutsche Commercial Internet Exchange">
                    <img src="<?= Url::to('@web/image/DE-CIX_Logo_2016_rgb.png');?>" alt="Deutsche Commercial Internet Exchange" title="Deutsche Commercial Internet Exchange" height="68px">        </a>
            </div>
            <div class="logo col-8 col-md-2 mx-auto">
                <a href="https://www.delltechnologies.com" target="_blank" title="Dell Technologies">
                    <img src="<?= Url::to('@web/image/Dell_Technologies_logo.svg.png');?>" alt="Dell Technologies" title="Dell Technologies" height="68px"></a>
            </div>
            <div class="logo col-8 col-md-2 mx-auto">
                <a href="https://www.globalconnect.de/" target="_blank" title="GlobalConnect GmbH">
                    <img src="<?= Url::to('@web/image/GlobalConnect_LogotypeBrandmark_BusinessBlue_RGB.png');?>" alt="GlobalConnect GmbH" title="GlobalConnect GmbH" height="68px">        </a>
            </div>
            <div class="logo col-8 col-md-2 mx-auto">
                <a href="https://www.novagreen-microalgae.de/" target="_blank" title="NOVAgreen Projektmanagement GmbH">
                    <img src="<?= Url::to('@web/image/novagreen.jpg');?>" alt="NOVAgreen Projektmanagement GmbH" title="NOVAgreen Projektmanagement GmbH" height="68px">        </a>
            </div>
            <div class="logo col-8 col-md-2 mx-auto">
                <a href="https://www.ripe.net" target="_blank" title="RIPE Network Coordination Centre">
                    <img src="<?= Url::to('@web/image/RIPE-NCC-Member.png');?>" alt="RIPE Network Coordination Centre" title="RIPE Network Coordination Centre" height="68px">        </a>
            </div>
        </div>
    </div>
</div>

<div class="membership margin-b z-index">
    <h2 class="vary">Mitgliedschaften</h2>
    <h1 style="padding-bottom: 1rem;">Wir engagieren uns für nachhaltige und sichere Digitalisierung</h1>
    <div class="bg-white border-radius-d ">
        <div class="row align-items-center">
            <div class="logo col-8 col-md-2 mx-auto">
                <a href="https://wtsh.de/partner-des-echten-nordens/" target="_blank" title="Schleswig-Holstein - Der echte Norden">
                    <img srcset="<?= Url::to('@web/image/logo-schleswig-holstein.jpg');?> 490w, <?= Url::to('@web/image/logo-schleswig-holstein-300x133.jpg');?> 300w" sizes="(min-width: 1200px) 255px, (min-width: 992px) 210px, (min-width: 768px) 150px, (min-width: 576px) 465px, calc(91vw - 30px)" src="<?= Url::to('@web/image/logo-schleswig-holstein.jpg');?>" alt="Logo Schleswig-Holstein - Der echte Norden" title="Schleswig-Holstein – Der echte Norden">        </a>
            </div>
            <div class="logo col-8 col-md-2 mx-auto">
                <a href="https://www.greentec-campus.de/" target="_blank" title="GreenTEC e.V.">
                    <img srcset="<?= Url::to('@web/image/logo-greentec-ev.jpg');?> 490w, <?= Url::to('@web/image/logo-greentec-ev-300x133.jpg');?> 300w" sizes="(min-width: 1200px) 255px, (min-width: 992px) 210px, (min-width: 768px) 150px, (min-width: 576px) 465px, calc(91vw - 30px)" src="<?= Url::to('@web/image/logo-greentec-ev.jpg');?>" alt="Logo GreenTec e.V." title="GreenTec e.V.">        </a>
            </div>
            <div class="logo col-8 col-md-2 mx-auto">
                <a href="https://www.diwish.de/" target="_blank" title="DIWISH">
                    <img srcset="<?= Url::to('@web/image/logo-diwish.jpg');?> 490w, <?= Url::to('@web/image/logo-diwish-300x133.jpg');?> 300w" sizes="(min-width: 1200px) 255px, (min-width: 992px) 210px, (min-width: 768px) 150px, (min-width: 576px) 465px, calc(91vw - 30px)" src="<?= Url::to('@web/image/logo-diwish.jpg');?>" alt="Logo DiWiSH" title="DiWiSH">        </a>
            </div>
            <div class="logo col-8 col-md-2 mx-auto">
                <a href="https://www.allianz-fuer-cybersicherheit.de/" target="_blank" title="Allianz für Cyber-Sicherheit">
                    <img srcset="<?= Url::to('@web/image/logo-allianz-fuer-cyber-sicherheit.jpg');?> 490w, <?= Url::to('@web/image/logo-allianz-fuer-cyber-sicherheit-300x133.jpg');?> 300w" sizes="(min-width: 1200px) 255px, (min-width: 992px) 210px, (min-width: 768px) 150px, (min-width: 576px) 465px, calc(91vw - 30px)" src="<?= Url::to('@web/image/logo-allianz-fuer-cyber-sicherheit.jpg');?>" alt="Logo Allianz für Cyber-Sicherheit" title="Allianz für Cyber-Sicherheit">        </a>
            </div>
            <div class="logo col-8 col-md-2 mx-auto">
                <a href="https://www.bski.de/" target="_blank" title="Bundesverband für den Schutz Kritischer Infrastrukturen (BSKI) e.V.">
                    <img srcset="<?= Url::to('@web/image/bski.jpg');?> 490w, <?= Url::to('@web/image/bski.jpg');?> 300w" sizes="(min-width: 1200px) 255px, (min-width: 992px) 210px, (min-width: 768px) 150px, (min-width: 576px) 465px, calc(91vw - 30px)" src="<?= Url::to('@web/image/bski.jpg');?>" alt="Logo Allianz für Cyber-Sicherheit" title="Allianz für Cyber-Sicherheit">        </a>
            </div>
            <div class="logo col-8 col-md-2 mx-auto">
                <a href="https://sdialliance.org/" target="_blank" title="Sustainable Digital Infrastructure Alliance e.V.">
                    <img src="<?= Url::to('@web/image/sdia-logo.png');?>" alt="Logo Allianz für Cyber-Sicherheit" title="Allianz für Cyber-Sicherheit">        </a>
            </div>
        </div>
    </div>
</div>


    <div class="margin-b z-index">

            <div class="row">
                <div class="col-12 col-md-6 mb-6">
                    <div class="bg-darkblue border-radius-d adjust-h">
                        <div class="p-3">
                            <h1 class="vary font-color-turquoise text-transform-none">Unser Ökosystem</h1>
                            <div class="font-color-white font-size-3 font-weight-bold">Wir nutzen die Abwärme
                                Ihrer  <br>Server direkt vor Ort</div>
                            <a class="border mobile-fill anim-1 show" href="/unternehmen/oekosystem">Mehr erfahren</a>
                        </div>
                    </div>
                </div>





                <div class="col-12 col-md-6 mb-6" >
                    <div class="bg-darkblue border-radius-d adjust-h">
                        <div class="p-3">
                            <h1 class="vary font-color-turquoise text-transform-none">Unsere Produkte</h1>
                            <div class="font-color-white font-size-3 font-weight-bold">Wir bieten grüne Cloud- und
                                Colocation-Lösungen</div>
                            <a class="border mobile-fill anim-1 show" href="/produkte">Zu den Produkten</a>
                        </div>
                    </div>
                </div>
            </div>

    </div>
</div>
<?php
$this->registerCssFile("/css/cms/style-unternehmen-2.css");
?>
