<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use app\module\CartModal\CartModalWidget;
?>
<div class="container">

<div id="hero" class="row">
    <div class="col-8 col-lg-5">
        <h1 class="turkis">Backup as a Service (BaaS) und<br> Disaster Recovery (DR)</h1>
        <h2 class="vary">CLOUD BACKUP</h2>
        <ul class="mb-4">
            <li>Für Server und Virtuelle Maschinen</li>
            <li>Standort für Offsite-Backup</li>
            <li>Managed Backup</li>
            <li>Deutsches Rechenzentrum</li>
            <li>Veeam Cloud Connect oder VMware vCAV<br>(vCloud Availibilty)</li>
        </ul>
        <a class="border mobile-fill anim-1 show" href="#BACKUP-KALKULATOR">Jetzt Preis berechnen!</a>
    </div>
    <div class="col">
        <div class="pic">
            <div class="diamond top"><div class="box"><div class="trans"></div></div></div>
            <img class="net" srcset="<?= Url::to('@web/image/Windcloud-net.png');?> 2000w, <?= Url::to('@web/image/Windcloud-net-300x212.png');?> 300w, <?= Url::to('@web/image/Windcloud-net-768x543.png');?> 768w, <?= Url::to('@web/image/Windcloud-net-1024x724.png');?> 1024w, <?= Url::to('@web/image/Windcloud-net-1200x848.png');?>  1200w" sizes="(min-width: 1200px) 540px, (min-width: 992px) 450px, (min-width: 768px) 330px, (min-width: 576px) 510px, calc(100vw - 30px)" src="<?= Url::to('@web/image/Windcloud-net-1024x724.png');?>" title="Windcloud-net" alt="Netz">

            <div class="big-tile move-in-3">
                <div class="img-tile levitate-5">
                    <div class="img">
                        <img srcset="<?= Url::to('@web/image/Windcloud-Rechenzentrum.png');?>  4960w, <?= Url::to('@web/image/Windcloud-Rechenzentrum-300x212.png');?> 300w, <?= Url::to('@web/image/Windcloud-Rechenzentrum-768x543.png');?> 768w, <?= Url::to('@web/image/Windcloud-Rechenzentrum-1024x724.png');?> 1024w, <?= Url::to('@web/image/Windcloud-Rechenzentrum-1200x848.png');?>  1200w" sizes="(min-width: 1200px) 445px, (min-width: 992px) 370px, (min-width: 768px) 270px, (min-width: 576px) 420px, calc(83vw - 30px)" src="<?= Url::to('@web/image/Windcloud-Rechenzentrum-1024x724.png');?>" alt="Rechenzentrum als 3D-Visual" title="Rechenzentrum | Windcloud 4.0 GmbH">          </div>
                    <div class="box"><div class="trans"></div></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-md-block">
    <h3 class="vary mb-4">HOCHVERFÜGBAR ARBEITEN MIT BACKUP <br>AS A SERVICE & DISASTER RECOVERY</h3>
</div>
<div class="column-count margin-b">
    <p>
        Mit den automatisierten Backup-Lösungen von Windcloud gehen Ihnen keine Daten mehr verloren. Ihre kritischen IT-Prozesse lassen sich durch unsere Disaster Recovery Strategie effektiv schützen und im Zweifel schnell und unkompliziert wiederherstellen. Das Cloud Backup in unserem Rechenzentrum in Schleswig-Holstein bietet zudem eine geographische Redundanz, die unabhängig von Ihrem eigentlichen Unternehmensstandort funktioniert. Wir managen nicht nur Ihr Backup, sondern unterstützen Sie auch bei der sicheren Migration Ihrer Daten zu uns.
    </p>
</div>



<div class="blockImgTxt row margin-b">
    <div class="col-12">
        <div class="row">
            <div class="col-12 col-lg-7">
                <h1 class="turkis">BaaS &amp; DR mit Windcloud</h1>
                <h3 class="vary mb-4 text-left">DIE VORTEILE UNSERER RECHENZENTREN</h3>
                <p class="mb-2">
                    Unsere hochsicheren Rechenzentren bieten die perfekte Basis für Ihr <strong>Offsite Backup</strong>. Die Empfehlung des Bundesamtes für Sicherheit in der Informationstechnik (BSI) sieht vor,
                    dass das <strong>Georedundanz gebende Rechenzentrum</strong> mindestens 200 Kilometer entfernt vom Hauptstandort sein sollte.
                    Mit unserem Rechenzentrum im hohen Norden Deutschlands können wir diesen Abstand zu den meisten Wirtschaftszentren in Deutschland einhalten.
                    Damit bieten wir Ihnen den optimalen Standort für Ihr Backup, der außerdem vollkommene <strong>DSGVO-Konformität</strong> bietet.
                    Darüber hinaus sind unsere Rechenzentren durch die direkte Versorgung mit Grünstrom <strong>CO2-frei</strong> und damit Vorreiter in Sachen Nachhaltigkeit in der deutschen Cloud- und Rechenzentrumsbranche.
                </p>
            </div>
            <div class="col-12 col-lg-5 image-bottom">
                <img src="<?= Url::to('@web/image/Karte.png');?>" alt="Karte">
            </div>
        </div>
    </div>
</div>

<div class="d-md-block margin-b">
    <div class="row">
        <div class="col-12 col-lg-6 mb-4">
            <div class="bg-darkblue border-radius-d box-shadow adjust-h">
                <div class="p-3">
                    <strong class="mb-0 turkis">Das Veeam-Backup</strong>
                    <h2 class="vary">VEEAM CLOUD CONNECT</h2>
                    <p>
                        Veeam Cloud Connect bietet Ihnen die Möglichkeit, ein einfaches und effektives Backup Ihrer Virtuellen Maschinen oder stationären Server in regelmäßigen Intervallen zu erstellen.
                        Nutzen Sie einfach Ihre vorhandene Veeam-Lizenz oder lassen Sie sich eine Lizenz von uns buchen.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6 mb-4">
            <div class="bg-darkblue border-radius-d box-shadow adjust-h">
                <div class="p-3">
                    <strong class="mb-0 turkis">Das VMware Backup</strong>
                    <h2 class="vary">VWMARE VCLOUD AVAILIBILTY</h2>
                    <p>
                        vCAV ist speziell für das Backup von VMware- Instanzen entwickelt worden. Wenn Sie bereits eine VMware-Infrastruktur nutzen, lässt sich Ihr Backup optimal mit vCAV umsetzen.
                        Auch als IaaS-Kunden von Windcloud können Sie Ihre Umgebung einfach sichern.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-md-block">
    <h3 class="vary mb-4">LEISTUNGSUMFANG</h3>
</div>

<div class="blockImgTxt row margin-b">
    <div class="col-12">
        <div class="row mb-4">
            <div class="col-12">
                <h1>Backup Policy</h1>
            </div>
            <div class="col-12 col-lg-4">
                <p>Full Backup:</p>
                <p>Inkrementelles Backup:</p>
            </div>
            <div class="col-12 col-lg-8">
                <p>Wöchentlich</p>
                <p>Täglich</p>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-12">
                <h1>Restore</h1>
            </div>
            <div class="col-12 col-lg-4">
                <p>24/7-Service:</p>
                <p>Optionen:</p>
            </div>
            <div class="col-12 col-lg-8">
                <p>Wiederherstellung der Daten rund um die Uhr</p>
                <p>Wiederherstellung von Backups ersetzend oder auch als neue Instanz</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h1>Weitere optionale Services</h1>
            </div>
            <div class="col-12 col-lg-4">
                <p>Reporting:</p>
                <p>Monitoring:</p>
                <p>Verfügbarkeit:</p>
            </div>
            <div class="col-12 col-lg-8">
                <p>Einsicht in die gesicherten Objekte</p>
                <p>24/7-Verfügbarkeits-Check</p>
                <p>99,95 %</p>
            </div>
        </div>
    </div>
</div>

<div id="BACKUP-KALKULATOR" class="bg-c-white border-radius-d margin-b pad p-5">
    <h3 class="vary mb-4">BACKUP-KALKULATOR FÜR VEEAM</h3>
    <p class="mb-5">
        Ermitteln Sie jetzt den Preis für Ihr Backup mit Veeam Cloud Connect bei Windcloud. Mit unserem Backup-Kalkulator bekommen Sie eine Übersicht über die Kosten für Ihr Backup.
    </p>
    <?php $form = ActiveForm::begin(['action' => ['produkte/cloud-backup'],'options' => ['method' => 'post'],'class' => 'needs-validation']); ?>
    <div class="row mb-3">
        <div class="col-12 col-lg-2 text-right">
            <h1 for="serverRange">Virtuelle Server</h1>
        </div>
        <div class="col-12 col-lg-8">
            <input type="range" class="custom-range" value="1" min="1" max="100" name="ColocationForm[bandwidth]"  id="serverRange">
        </div>
        <div class="col-12 col-lg-2 text-left">
            <h1><span id="theServer">XX</span></h1>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12 col-lg-2 text-right">
            <h1 for="storageAmount">Storage (TB)</h1>
        </div>
        <div class="col-12 col-lg-8">
            <input type="range" class="custom-range" value="0.1" min="0.1" max="150" step="0.1" name="ColocationForm[racks]" id="storageAmount">

        </div>
        <div class="col-12 col-lg-2 text-left">
            <h1><span id="theStorage">XX</span></h1>
        </div>
    </div>
    <h3 class="mb-5 text-center">Preis ab <span id="thePrice">XXX</span> €</h3>
    <p class="mb-5">
        Der Preis berücksichtigt die Anzahl der Virtuellen Server und den von Ihnen benötigten Speicher. Ein genaues Angebot lassen wir Ihnen gerne zukommen, wenn wir Ihre genauen Anforderungen, bspw. die Backup-Häufigkeit, kennen.
    </p>
    <h1 class="turkis mb-4 text-center">Übermitteln Sie uns jetzt Ihre Anforderungen<br>und erhalten Sie ein unverbindliches Angebot!</h1>
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <?= $form->field($modelcustom, 'name')->label(false)->textInput(['placeholder' => 'Vorname, Name*','class' =>'form-control border']); ?>
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
            <div class="col-md-6 mb-3">
                <br>
                <div class="form-group">
                    <div class="form-check">
                        <label class="custom-control custom-checkbox">
                            <?= $form->field($modelcustom, 'migration')->checkBox(['aria-invalid'=>false,'class'=>'custom-control-input','label'=> '<span class="custom-control-label turkis">Ich benötige Unterstützung beim initialen Backup</span>']);?>
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
            <div class="col-md-6 mb-3 text-right">
                <p class="grey">*Pflichtfeld</p>
                <?= Html::submitButton('Absenden', ['class' => 'btn border anim-1 show']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
</div>

<div class="d-md-block">
    <h3 class="vary mb-5">UNSERE PARTNER FÜR BACKUP</h3>
</div>

<div class="d-md-block margin-b">
    <div class="row">
        <div class="col-12 col-md-4 mb-5 text-center icons">
            <img height="50px" src="<?= Url::to('@web/image/veeam-logo.png');?>" alt="Partner veeam">
        </div>
        <div class="col-12 col-md-4 mb-5 text-center icons">
            <img height="50px" src="<?= Url::to('@web/image/vmware-logo.png');?>" alt="Partner vmware">
        </div>
        <div class="col-12 col-md-4 mb-5 text-center icons">
            <img height="50px" src="<?= Url::to('@web/image/NovaStor_Logo.svg');?>" alt="Partner NovaStor">
        </div>
    </div>
</div>


</div>
</div>



<?php
$this->registerJs(
    "
function scrollrechner() {
  var elmnt = document.getElementById(\"rechner\");
  elmnt.scrollIntoView();
}
"
);
?>
<?php
$this->registerJsFile(Yii::$app->request->BaseUrl . '/js/cms/cloud-backup.js');
?>





<?php
$this->registerCssFile("/css/cms/style-backup.css");
?>
