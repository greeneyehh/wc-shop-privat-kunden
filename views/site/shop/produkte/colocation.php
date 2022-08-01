<?php

$this->title = Yii::$app->name;
use yii\helpers\Html;
use yii\helpers\Url;
use app\module\CartModal\CartModalWidget;
use app\extensions\greendev\weclapp\widgets\variantArticleWidgets;
use yii\widgets\ActiveForm;
?>



<div class="container">

    <div class="kachelanimation">
        <div class="netz d-none d-md-block">
            <img class="net" src="<?= Url::to('@web/image/Windcloud-net-768x543.png');?>" title="Windcloud Netz">
        </div>
        <div class="raute"></div>
        <div class="kacheln">
            <div class="big-tile move-in-3">
                <div class="levitate-5">
                    <img src="<?= Url::to('@web/image/Windcloud-Rechenzentrum-768x543.png');?>" alt="Rechenzentrum als 3D-Visual" title="Rechenzentrum | Windcloud 4.0 GmbH">
                </div>
                <div class="box"><div class="trans"></div></div>
            </div>
        </div>
    </div>

    <div id="hero" class="row">
        <div class="col-8 col-md-6">
            <h1 class="turkis">Die nachhaltige Colocation in Schleswig-Holstein</h1>
            <h2 class="vary">CO2LOCATION</h2>
            <ul class="mb-4">
                <li>Rechenzentrumsstandort Deutschland</li>
                <li>100% physikalischer Grünstrom</li>
                <li>Hochverfügbar nach EN 50600 VK 3</li>
                <li>Über 40 Carrier verfügbar</li>
                <li>Strompreis 19 Cent / kWh</li>
            </ul>
        </div>
    </div>

    <div class="d-md-block">
        <h3 class="text-center  m-5">HOCHSICHERE RACKS UND RECHENZENTRUMS<wbr>FLÄCHEN IN NORDDEUTSCHLAND</h3>
    </div>
    <div class="blockImgTxt row">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-lg-6 mb-3">
                    <img src="<?= Url::to('@web/image/Firma.jpg');?>" alt="Firma Windcloud">
                </div>
                <div class="col-12 col-lg-6">
                    <p class="mb-2">
                        Als nachhaltiger Rechenzentrumsbetreiber bieten wir Ihnen Colocation-Lösungen von einem Rack bis hin zu ganzen Bunkern. Ihre Hardware ist dabei durch ein mehrstufiges Zonensicherheitskonzept geschützt. Mit unseren Rechenzentren in Schleswig-Holstein garantieren wir Ihnen eine Mindestverfügbarkeit von 99,95% und vollständige DSGVO-Konformität.
                        Die Energieversorgung wird zu 100% aus physikalisch echtem Grünstrom, größtenteils aus Windenergie, sichergestellt. Damit ist unser Rechenzentrumsbetrieb CO<sub>2</sub>–frei. Die Abwärme Ihrer Server wird darüber hinaus für eine direkt angebundene Algenfarm genutzt.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-c-turkis border-radius-d mt-5 margin-b">
        <h3 class="text-center">Unser Colocation-Angebot</h3>
        <p class="mb-5">
            In unserem Rechenzentrum bieten wir Ihnen große Racks von 19’’ (800 x 1200 mm) mit 42 Höheneinheiten sowie redundanter Kühlung und Stromversorgung. Für die Anbindung zur Ihrem Firmenstandort stehen Ihnen eine Vielzahl von Carrieren mit bis zu 1 Tbit zur Verfügung.
            <br><br>
            <strong>Wir beraten und unterstützen Sie gerne bei Projektierung und Migration Ihrer IT-Umgebung.</strong>
        </p>
        <a class="border mobile-fill anim-1 show" href="#COLOCATION-ANFRAGE">Jetzt anfragen</a>
    </div>

    <div class="blockImgTxt row">
        <div class="col-12">
            <h3 class="vary mb-4 text-left">WINDCLOUD-STANDORTE</h3>
            <div class="row standorte">
                <a class="border mr-2 active show" name="stadt1" href="javascript:;">Enge-Sande</a>
                <a class="border show" name="stadt2" href="javascript:;">Bramstedtlund</a>
            </div>
            <div class="row">
                <div class="col-12 col-lg-7">
                    <p class="stadt1 mb-5">
                        In unserem innovativen Rechenzentrum C1 auf dem GreenTEC Campus in Enge-Sande bieten wir Ihnen einen hochsicheren Raum für Ihre Hardware. An dem ehemaligen Militärstandort stehen Ihnen 28 Racks zur Verfügung. Der Standort bietet mit 44 ehemaligen Nato-Bunkern ein großes Ausbaupotenzial für eine schnelle Realisierung weiterer Colocation-Flächen.
                        <br>
                        Der Betrieb unseres nach EN 50600 VK 3 zertifizierten Rechenzentrums ist komplett CO2-frei. Unser Standort ermöglicht uns die Versorgung mit 100 % Erneuerbarer Energie, zum größten Teil aus Windenergie. Die Abwärme wird direkt in der ans Rechenzentrum angeschlossenen Algenfarm veredelt.
                    </p>
                    <p class="stadt2 mb-5">
                        Der Standort Bramstedtlund ist ein ehemaliges Militärareal und befindet sich seit 2018 in unserem Besitz. Er bietet mit 7 ha Gesamtfläche und 10 Bunkern ein großes Ausbaupotenzial. Hier können zeitnah entsprechend große Colocation-Flächen realisiert werden. Der Start für den Betrieb von Rechenzentren in Bramstedtlund ist für 2022 geplant.
                        <br>
                        Eine grüne Energieversorgung ist hier bereits gesichert. In unmittelbarer Nähe zum Standort stehen uns > 2,4 GW Energie aus Wind, Solar und Biogas zur Verfügung. Auch findet sich auf dem Areal ausreichend Platz, um Anlagen zur Veredelung der entstehenden Rechenzentrumsabwärme im industriellen Stil zu betreiben.
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

<div class="spacer-image background-1"></div>

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
                        <li>Automatische Brandfrüherkennung & Löschanlage</li>
                    </ul>
                </div>
                <div class="col-12 col-lg-6">
                    <h1>Energie &amp; Klimatisierung</h1>
                    <ul class="mb-4">
                        <li>CO2-frei durch 100 % physikalischen Grünstrom</li>
                        <li>Rack mit Aufnahme von 2,5 bis 6 kW</li>
                        <li>AB-Stromversorgung</li>
                        <li>Redundante Unterbrechungsfreie Stromversorgung (USV) mit Notstromaggregaten (n+1)</li>
                        <li>Redundante direkte freie Kühlung (n+1)</li>
                    </ul>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12">
                </div>
                <div class="col-12 col-lg-6">
                    <h1>Standort</h1>
                    <ul class="mb-4">
                        <li>Autarkes Arealnetz (in Planung)</li>
                        <li>Geologisch sichere Region</li>
                        <li>Außerhalb von Überschwemmungsgebieten</li>
                        <li>Kein Erstanschlagsgegebiet (Terrorzone 1)</li>
                        <li>Perfekter Georedundanzstandort</li>
                    </ul>
                </div>
                <div class="col-12 col-lg-6">
                    <h1>Anbindung</h1>
                    <ul class="mb-4">
                        <li>Geografisch 3-fach redundante Glasfaseranbindung</li>
                        <li>Physikalische 4-Wege redundante Trassenführung</li>
                        <li>Bandbreite bis zu 1 Tbit/s</li>
                        <li>Über 40 Carrier verfügbar</li>
                        <li>Redundante Gebäudeeinführung</li>
                        <li>Internes Netzwerk 100 Gbit / sec</li>
                        <li>Eigene BGP-Router-Infrastruktur (AS210226)</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <div class="bg-c-darkblue border-radius-d pad margin-b">
        <img class="img-xtra d-none d-lg-block" src="<?= Url::to('@web/image/Windcloud-treibhaus.png');?>" alt="Rechenzentrum">
        <div class="row mb-4">
            <div class="col-12 col-lg-10">
                <strong>Für noch mehr Nachhaltigkeit:</strong>
                <h3 class="mb-3">Wir nutzen die Abwärme Ihrer Server direkt vor Ort</h3>
                <a class="border" href="javascript:">Mehr erfahren</a>
            </div>
        </div>
    </div>

    <div class="d-md-block mb-5">
        <div class="row">

            <div class="col-12 col-md-4 mb-4 text-center icons">
                <img height="150px" src="<?= Url::to('@web/image/Windcloud_Icon-E-Auto.svg');?>" alt="E-Auto Ladestation">
                <p>KOSTENLOSES LADEN<br>IHRES E-AUTOS<br> AM RECHENZENTRUM</p>
            </div>

            <div class="col-12 col-md-4 mb-4 text-center icons">
                <img height="150px" src="<?= Url::to('@web/image/Windcloud_Icon-Support.svg');?>" alt="Supp">
                <p>24/7<br>SERVICE &amp; SUPPORT</p>
            </div>

            <div class="col-12 col-md-4 mb-4 text-center icons">
                <img height="150px" src="<?= Url::to('@web/image/Windcloud_Icon-Migration.svg');?>" alt="Migration">
                <p>UNTERSTÜTZUNG BEI PROJEKTIERUNG &amp; MIGRATION</p>
            </div>

        </div>
    </div>

    <div class="bg-c-white border-radius-d margin-b pad p-5" id="COLOCATION-ANFRAGE">
        <h3 class="vary mb-4">COLOCATION-ANFRAGE</h3>
        <p class="text-center mb-5" style="color:#004477;">
            Sie haben Interesse an unseren CO2-freien Colocation-Lösungen?<br>Dann kontaktieren Sie uns und erhalten Sie Ihr Angebot!
        </p>

        <?php $form = ActiveForm::begin(['action' => ['produkte/colocation'],'options' => ['method' => 'post'],'class' => 'needs-validation']); ?>
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <?= $form->field($modelcustom, 'name')->label(false)->textInput(['placeholder' => 'Vorname, Name*','class' =>'form-control border wpcf7-form-control wpcf7-text wpcf7-validates-as-required']); ?>
            </div>
            <div class="col-md-6 mb-3">
                <?= $form->field($modelcustom, 'email')->label(false)->textInput(['placeholder' => 'E-Mail*','class' =>'form-control border']); ?>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <?= $form->field($modelcustom, 'company')->label(false)->textInput(['placeholder' => 'Firma*','class' =>'form-control border']); ?>
            </div>
            <div class="col-md-6 mb-3">
                <?= $form->field($modelcustom, 'phone')->label(false)->textInput(['placeholder' => 'Telefon','class' =>'form-control border']); ?>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-12 mb-3">
                <?= $form->field($modelcustom, 'message')->label(false)->textInput(['placeholder' => 'Ihre Nachricht an uns','class' =>'form-control border']); ?>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-3">
                <div class="form-group">
                    <?= $form->field($modelcustom, 'racks')->dropDownList($racks, ['prompt'=>'Anzahl Racks','class' =>'form-control border'])->label(false); ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?= $form->field($modelcustom, 'bandwidth')->dropDownList($bandwidth, ['prompt'=>'Bandbreite (GB)','class' =>'form-control border'])->label(false); ?>
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
                            <?= $form->field($modelcustom, 'migration')->checkBox(['aria-invalid'=>false,'class'=>'custom-control-input','label'=> '<span class="custom-control-label turkis">Ich benötige Unterstützung bei Migration und Projektierung</span>']);?>
                        </label>
                    </div>
                    <div class="form-check">

                        <label class="custom-control custom-checkbox">
                            <?= $form->field($modelcustom, 'dsgvo')->checkBox(['aria-invalid'=>false,'class'=>'custom-control-input','label'=> '<span class="custom-control-label turkis" for="invalidCheck">Ich habe die Datenschutzbestimmungen gelesen</span>
                            <div class="invalid-feedback">
                                <p class="grey">Bestätigen Sie die DSGVO.</p>
                            </div>']);?>
                        </label>


                    </div>
                </div>
            </div>
            <div class="col-md-5 text-right">
                <?= Html::submitButton('Absenden', ['class' => 'btn border anim-1 show']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

    <div class="d-md-block">
        <h3 class="text-center mb-5">UNSERE COLOCATION-KUNDEN</h3>
    </div>

    <div class="d-md-block margin-b">
        <div class="row">
            <div class="col-12 col-md-6 mb-5 text-center">
                <img height="50px" src="<?= Url::to('@web/image/softfair-logo.png');?>" alt="Partner Softfair">
            </div>
            <div class="col-12 col-md-6 mb-5 text-center">
                <img height="50px" src="<?= Url::to('@web/image/balticfinance-logo.png');?>" alt="Partner balticfinance">
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
$this->registerCssFile("/css/cms/style-colocation-2.css");
?>

