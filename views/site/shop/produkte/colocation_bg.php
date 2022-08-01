<?php

$this->title = Yii::$app->name;
use yii\helpers\Html;
use yii\helpers\Url;
use app\module\CartModal\CartModalWidget;
use app\extensions\greendev\weclapp\widgets\variantArticleWidgets;

?>


<div class="container">

    <div id="hero" class="row">
        <div class="col-8 col-lg-5">
            <h1 class="turkis">Die nachhaltige Colocation<br>in Schleswig-Holstein</h1>
            <h2 class="vary">CO<sub>2</sub>LOCATION</h2>
            <ul class="mb-4">
                <li>Rechenzentrumsstandort Deutschland</li>
                <li>100% physikalischer Grünstrom</li>
                <li>Hochverfügbar nach EN 50600 VK 3</li>
                <li>Über 40 Carrier verfügbar</li>
                <li>Strompreis 19 Cent / kWh</li>
            </ul>
        </div>
        <div class="col">
            <div class="pic">
                <div class="diamond top"><div class="box"><div class="trans"></div></div></div>
                <img class="net" srcset="<?= Url::to('@web/image/Windcloud-net.png');?> 2000w, <?= Url::to('@web/image/Windcloud-net-300x212.png');?> 300w, <?= Url::to('@web/image/Windcloud-net-768x543.png');?> 768w, <?= Url::to('@web/image/Windcloud-net-1024x724.png');?> 1024w, <?= Url::to('@web/image/Windcloud-net-1200x848.png');?>  1200w" sizes="(min-width: 1200px) 540px, (min-width: 992px) 450px, (min-width: 768px) 330px, (min-width: 576px) 510px, calc(100vw - 30px)" src="<?= Url::to('@web/image/Windcloud-net-1024x724.png');?>" title="Windcloud-net" alt="Netz">

                <div class="big-tile move-in-3">
                    <div class="img-tile levitate-5">
                        <div class="img">
                            <img srcset="<?= Url::to('@web/image/Windcloud-kaserne.png');?>  4960w, <?= Url::to('@web/image/Windcloud-kaserne-300x212.png');?> 300w, <?= Url::to('@web/image/Windcloud-kaserne-768x543.png');?> 768w, <?= Url::to('@web/image/Windcloud-kaserne-1024x724.png');?> 1024w, <?= Url::to('@web/image/Windcloud-kaserne-1200x848.png');?>  1200w" sizes="(min-width: 1200px) 445px, (min-width: 992px) 370px, (min-width: 768px) 270px, (min-width: 576px) 420px, calc(83vw - 30px)" src="<?= Url::to('@web/image/Windcloud-kaserne-1024x724.png');?>" alt="Rechenzentrum als 3D-Visual" title="Rechenzentrum | Windcloud 4.0 GmbH">          </div>
                        <div class="box"><div class="trans"></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-md-block">
        <h3 class="vary mb-5">HOCHSICHERE RACKS UND RECHENZENTRUMS<wbr>FLÄCHEN IN NORDDEUTSCHLAND</h3>
    </div>
    <div class="blockImgTxt row mb-5">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-lg-6 mb-3">
                    <img src="<?= Url::to('@web/image/Firma.png');?>" alt="Firma Windcloud">
                </div>
                <div class="col-12 col-lg-6">
                    <p class="mb-2">
                        Als nachhaltiger Rechenzentrumsbetreiber bieten wir Ihnen <strong>Colocation-Lösungen</strong> von einem Rack bis hin zu ganzen Bunkern. Ihre Hardware ist dabei durch ein mehrstufiges <strong>Zonensicherheitskonzept</strong> geschützt. Mit unseren Rechenzentren in Schleswig-Holstein garantieren wir Ihnen eine Mindestverfügbarkeit von 99,95% und vollständige <strong>DSGVO-Konformität</strong>.
                        <br><br>
                        Die Energieversorgung wird durch ein versorgerunabhängiges Arealnetz sichergestellt, das den Bezug von 100% physikalisch grünem Strom, größtenteils aus <strong>Windenergie</strong>, garantiert.
                        <br><br>
                        Damit ist unser Rechenzentrumsbetrieb <strong>CO<sub>2</sub>–frei</strong>. Die Abwärme Ihrer Server wird darüber hinaus für eine direkt angebundene <strong>Algenfarm</strong> genutz.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center margin-b">
        <p class="mb-5 text-left">
            In unserem Rechenzentrum bieten wir Ihnen große Racks von 19’’ (800 x 1200 mm) mit 42 Höheneinheiten sowie redundanter Kühlung und Stromversorgung. Für die Anbindung zur Ihrem Firmenstandort stehen Ihnen eine Vielzahl von Carrieren mit bis zu 1 Tbit zur Verfügung. Wir beraten und unterstützen Sie gerne bei Projektierung und Migration Ihrer IT-Umgebung.
        </p>
        <a class="border mobile-fill" href="#COLOCATION-ANFRAGE">Jetzt anfragen</a>
    </div>

    <div class="blockImgTxt row margin-b">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-lg-7">
                    <h3 class="vary mb-4 text-left">WINDCLOUD-STANDORTE</h3>
                    <a class="border mobile-fill mr-2 mb-2 active" name="stadt1" href="javascript:;">Enge-Sande</a>
                    <a class="border mobile-fill mb-2" name="stadt2" href="javascript:;">Bramstedtlund</a>
                    <br><br>
                    <p class="stadt1 mb-2">
                        In unserem innovativen Rechenzentrum C1 / C1+ auf dem GreenTEC Campus in Enge-Sande bieten wir Ihnen einen hochsicheren Raum für Ihre Hardware. An dem ehemaligen Militärstandort stehen Ihnen … m² Rechenzentrumsfläche und bis zu … Racks zur Verfügung. Der Standort bietet mit … Bunkern ein großes Ausbaupotenzial für eine schnelle Realisierung weiterer Colocation-Flächen. Der Betrieb unseres nach EN 50600 VK 3 und ISO 27001 zertifizierten Rechenzentrums ist komplett CO2-frei. Unser Standort ermöglicht uns die Versorgung mit 100 % Erneuerbarer Energie, zum größten Teil aus Windenergie. Die Abwärme wird direkt in der ans Rechenzentrum angeschlossenen Algenfarm veredelt.
                    </p>
                    <p class="stadt2 mb-2">
                        Der Standort bietet mit … Bunkern ein großes Ausbaupotenzial für eine schnelle Realisierung weiterer Colocation-Flächen. Der Betrieb unseres nach EN 50600 VK 3 und ISO 27001 zertifizierten Rechenzentrums ist komplett CO2-frei. Unser Standort ermöglicht uns die Versorgung mit 100 % Erneuerbarer Energie, zum größten Teil aus Windenergie. Die Abwärme wird direkt in der ans Rechenzentrum angeschlossenen Algenfarm veredelt. In unserem innovativen Rechenzentrum C1 / C1+ auf dem GreenTEC Campus in Enge-Sande bieten wir Ihnen einen hochsicheren Raum für Ihre Hardware. An dem ehemaligen Militärstandort stehen Ihnen … m² Rechenzentrumsfläche und bis zu … Racks zur Verfügung.
                    </p>
                </div>
                <div class="col-12 col-lg-5">
                    <img class="stadt1" src="<?= Url::to('@web/image/karte-enge-sande.png');?>" alt="Karte Enge-Sande">
                    <img class="stadt2" src="<?= Url::to('@web/image/karte-bramstedtlund.png');?>" alt="Karte Bramstedtlund">
                </div>
            </div>
        </div>
    </div>

</div>

<div class="container-fluid">
    <div class="slider margin-b">

        <div id="carousel-slider" class="carousel slide" data-ride="carousel">

            <div class="carousel-inner">
                <div class="carousel-item row justify-content-center align-items-center active">
                    <div class="row aufmacher">
                        <img class="img-fluid w-100" src="<?= Url::to('@web/image/server-rack.jpg');?>" alt="Server Rack">
                    </div>
                </div>

                <div class="carousel-item row justify-content-center align-items-center">
                    <div class="row aufmacher">
                        <img class="img-fluid w-100" src="<?= Url::to('@web/image/server-parts.jpg');?>" alt="Server Parts">
                    </div>
                </div>

                <div class="carousel-item row justify-content-center align-items-center">
                    <div class="row aufmacher">
                        <img class="img-fluid w-100" src="<?= Url::to('@web/image/server-modul.jpg');?>" alt="Server Modul">
                    </div>
                </div>

                <div class="carousel-item row justify-content-center align-items-center">
                    <div class="row aufmacher">
                        <img class="img-fluid w-100" src="<?= Url::to('@web/image/server-loeschanlage.jpg');?>" alt="Server Löschanlage">
                    </div>
                </div>
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

<div class="container">

    <div class="d-md-block text-center mb-5">
        <h3 class="vary mb-4">DIE VORTEILE DER WINDCLOUD-COLOCATION</h3>
        <p>
            Unsere leistungsstarke Infrastruktur bildet die perfekte Umgebung für Ihre Hardware und Workloads<br>und ist durch ein umfassendes Sicherheitskonzept geschützt.
        </p>
    </div>

    <div class="blockImgTxt row mb-5">
        <div class="col-12">
            <div class="row mb-2">
                <div class="col-12">
                </div>
                <div class="col-12 col-lg-6">
                    <h1>Sicherheit</h1>
                    <ul class="mb-4">
                        <li>Zertifizierung nach ISO 27001 &amp; EN 50600 VK 3</li>
                        <li>Zonen-Sicherheitskonzept</li>
                        <li>2 Faktor-Authentifizierung bis ans Rack</li>
                        <li>Wärmebildkamera</li>
                        <li>Automatische Brandfrüherkennung &amp; Löschanlage</li>
                    </ul>
                </div>
                <div class="col-12 col-lg-6">
                    <h1>Energie &amp; Klimatisierung</h1>
                    <ul class="mb-4">
                        <li>CO2-frei durch 100% physikalischen Grünstrom</li>
                        <li>Rack mit Aufnahme von 2,5 bis 6 kW</li>
                        <li>AB-Stromversorgung</li>
                        <li>Redundante Unterbrechungsfreie Stromversorgun (USV) mit Notstromaggregaten (n+1)</li>
                        <li>Redundante direkte freie Kühlung (n+1)</li>
                    </ul>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12">
                </div>
                <div class="col-12 col-lg-6">
                    <h1>Standort</h1>
                    <ul class="mb-4">
                        <li>Autarkes Arealnetz (versorgerunabhängi</li>
                        <li>Geologisch sichere Regio</li>
                        <li>Außerhalb von Überschwemmungsgebiete</li>
                        <li>Kein Erstanschlagsgegebiet (Terrorzone 1)</li>
                        <li>Perfekter Georedundanzstandor</li>
                    </ul>
                </div>
                <div class="col-12 col-lg-6">
                    <h1>Anbindung</h1>
                    <ul class="mb-4">
                        <li>Geografisch 3-fach redundante Glasfaseranbindung</li>
                        <li>Physikalische 4-Wege redundante Trassenführung</li>
                        <li>Bandbreite bis zu 1 TBit</li>
                        <li>Über 40 Carrier verfügbar (Link Liste)</li>
                        <li>Redundante Gebäudeeinführung</li>
                        <li>Internes Netzwerk 100 Gbit/sec</li>
                        <li>Eigene BGP-Router-Infrastruktur (AS210226)</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-c-darkblue border-radius-d pad margin-b">
        <img class="img-xtra d-none d-lg-block" src="<?= Url::to('@web/image/Windcloud-treibhaus.png');?>" alt="Rechenzentrum">
        <div class="row mb-4">
            <div class="col-12 col-lg-10 text-left">
                <strong>Für noch mehr Nachhaltigkeit:</strong>
                <h3 class="mb-5">Wir nutzen die Abwärme Ihrer Server direkt vor Ort</h3>
                <a class="border mobile-fill" href="/unternehmen/ökosystem">Mehr erfahren</a>
            </div>
        </div>
    </div>


    <div class="d-md-block mb-5">
        <div class="row">

            <div class="col-12 col-md-3 mb-4 text-center icons">
                <img height="150px" src="<?= Url::to('@web/image/Windcloud_Icon-Deutschland.svg');?>" alt="Deutsches Rechenzentrum">
                <p>KOSTENLOSES LADEN IHRES E-AUTOS AM RECHENZENTRUM</p>
            </div>

            <div class="col-12 col-md-3 mb-4 text-center icons">
                <img height="150px" src="<?= Url::to('@web/image/Windcloud_Icon-SSL.svg');?>" alt="SSL verschlüsselt">
                <p>24/7<br>SERVICE &amp; SUPPORT</p>
            </div>

            <div class="col-12 col-md-3 mb-4 text-center icons">
                <img height="150px" src="<?= Url::to('@web/image/Windcloud_Icon-DSGVO.svg');?>" alt="DSGVO konform">
                <p>UNTERSTÜTZUNG BEI PROJEKTIERUNG &amp; MIGRATION</p>
            </div>

            <div class="col-12 col-md-3 mb-4 text-center icons">
                <img height="150px" src="<?= Url::to('@web/image/Windcloud_Icon-Deutschland.svg');?>" alt="Deutsches Rechenzentrum">
                <p>EN 50600<br>ZERTIFIZIERUNG</p>
            </div>
        </div>
    </div>

    <div class="bg-c-turkis border-radius-d mb-4 pad" id="COLOCATION-ANFRAGE">
        <div class="col-12">
            <div class="row align-items-center">
                <div class="col-12 text-center">
                    <h2 class="vary">PREISE FÜR COLOCATION-SERVICES</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-c-white border-radius-d margin-b pad p-5" >
        <h3 class="vary mb-4">COLOCATION-ANFRAGE</h3>
        <p class="text-center mb-5">
            Sie haben Interesse an unseren CO2-freien Colocation-Lösungen?<br>Dann kontaktieren Sie uns und erhalten Sie Ihr Angebot.
        </p>
        <form class="needs-validation" novalidate>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <input type="text" class="form-control border" id="validationCustom01" placeholder="Vorname, Name*" required>
                </div>
                <div class="col-md-6 mb-3">
                    <input type="text" class="form-control border" id="validationCustom02" placeholder="E-Mail*" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <input type="text" class="form-control border" id="validationCustom03" placeholder="Firma*" required>
                    <!--div class="invalid-feedback">
                      <p class="grey">Bitte eine Firma eintragen.</p>
                    </div-->
                </div>
                <div class="col-md-6 mb-3">
                    <input type="text" class="form-control border" id="validationCustom04" placeholder="Telefon">
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <input type="text" class="form-control border" id="validationCustom05" placeholder="Ihre Nachricht an uns">
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-3">
                    <div class="form-group">
                        <select class="form-control border" id="validationCustom06" required>
                            <option disabled>Anzahl Racks</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <select class="form-control border" id="validationCustom07" required>
                            <option disabled>Bandbreite</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 text-right">
                    <p class="grey mb-5">*Pflichtfeld</p>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-7 mb-3">
                    <div class="form-group">
                        <div class="form-check">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" id="checkbox" class="custom-control-input" value="0">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-label turkis">Ich benötige Unterstützung bei Migration und Projektierung</span>
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" id="invalidCheck" class="custom-control-input" value="" required>
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-label turkis" for="invalidCheck">Ich habe die Datenschutzbestimmungen gelesen</span>
                                <div class="invalid-feedback">
                                    <p class="grey">Bestätigen Sie die DSGVO.</p>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 text-right">
                    <button class="btn border" type="submit">Absenden</button>
                </div>
            </div>
        </form>
    </div>

    <div class="d-md-block">
        <h3 class="vary mb-5">UNSERE COLOCATION-KUNDEN</h3>
    </div>

    <div class="d-md-block margin-b">
        <div class="row">
            <div class="col-12 col-md-4 mb-5 text-center">
                <img height="50px" src="<?= Url::to('@web/image/veeam-logo.png');?>" alt="Partner veeam">
            </div>
            <div class="col-12 col-md-4 mb-5 text-center">
                <img height="50px" src="<?= Url::to('@web/image/vmware-logo.png');?>" alt="Partner vmware">
            </div>
            <div class="col-12 col-md-4 mb-5 text-center">
                <img height="50px" src="<?= Url::to('@web/image/vmware-logo.png');?>" alt="Partner vmware">
            </div>
        </div>
    </div>


</div>
<?php
$this->registerJs(
    "$(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
});
    
$('[name=\"stadt2\"]').click(function() {
    $(this).addClass('active');
    $('[name=\"stadt1\"]').removeClass('active');
    $('.stadt1').css('display','none');
    $('.stadt2').css('display','block');
});
$('[name=\"stadt1\"]').click(function() {
    $(this).addClass('active');
    $('[name=\"stadt2\"]').removeClass('active');
    $('.stadt2').css('display','none');
    $('.stadt1').css('display','block');
});
"
);
?>
<?php
$this->registerCssFile("/css/cms/style-colocation.css");
?>

