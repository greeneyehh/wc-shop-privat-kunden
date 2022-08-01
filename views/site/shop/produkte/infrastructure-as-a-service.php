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
            <h1 class="turkis">IaaS-Lösungen von Windcloud</h1>
            <h2 class="vary">INFRASTRUCTURE<br>AS A SERVICE</h2>
            <ul class="mb-4">
                <li>VMware vCloud Director</li>
                <li>Software Defined Datacenter</li>
                <li>Hochverfügbar nach EN 50600 VK 3</li>
                <li>Rechenztrumsstandort Deutschland</li>
                <li>CO<sub>2</sub>-frei durch 100 % physikalisch grünen Strom</li>
            </ul>
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
        <h3 class="vary mb-5">PRIVATE UND PUBLIC CLOUD MIT VMWARE</h3>
    </div>
    <div class="column-count margin-b">
        <p>
            Mit der von uns angebotenen IaaS-Lösung von VMware können Sie Ihre IT-Ressourcen flexibel und übersichtlich verwalten. VMware vCloud bietet Ihnen ein virtuelles Datacenter, mit dem Sie Ihre virtuelle Infrastruktur über eine zentrale Oberfläche steuern   können. Compute-, Storage- und Netzwerkressourcen lassen sich entsprechend der Anforderungen Ihrer Applikation skalierbar zuweisen – wahlweise über ein Webinterface oder mittels API und CLI.
        </p>
        <p class="mb-5 mt-5">
            <img height="50px" src="<?= Url::to('@web/image/vmware-logo.png');?>" alt="Partner vmware">
        </p>
        <p>
            vCloud Director bietet darüber hinaus mit der Container Service Extension (CSE) Funktionen zur Erstellung, Orchestrierung und Verwaltung von Kubernetes-Clustern. So lassen sich VMs und containerbasierte Applikationen über eine einzige Plattform betreiben.
        </p>
        <p>
            Ihre Infrastruktur virtualisieren wir auf Dell-Hardware in unserem hochsicheren Rechenzentrum in Nordfriesland. Damit ist die Sicherheit und Verfügbarkeit Ihrer Daten und Workloads immer gewährleistet. Zudem sind unsere Produkte zu 100 % DSGVO-konform und klimafreundlich. Für den Betrieb unserer Server nutzen wir ausschließlich Strom aus Erneuerbaren Energien und veredeln die entstehende Abwärme direkt vor Ort.
        </p>
    </div>

    <div class="d-md-block">
        <h3 class="vary mb-5">EINFACH VON ON-PREM IN DIE CLOUD WECHSELN</h3>
    </div>
    <div class="blockImgTxt row margin-b">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-lg-7">
                    <p class="mb-3">
                        Sie nutzen bisher VMware für Ihre Server im Unternehmen? Dann haben Sie jetzt die Möglichkeit Ihre Daten und Workloads einfach in die Cloud umzuziehen. Mit vmware vCloud können Sie Ihre Infrastruktur problemlos in unserem Rechenzentrum abbilden. Vermeiden Sie zukünftig hohe Investitionskosten in Hardware, indem Sie auf eine sichere und datenschutzkonforme IaaS-Lösung setzen. Auch hybride Lösungen sind möglich. Unsere Experten beraten Sie gerne.
                    </p>
                </div>
                <div class="col-12 col-lg-5">
                    <img src="<?= Url::to('@web/image/Server.png');?>" alt="Firma Windcloud">
                </div>
            </div>
        </div>
    </div>

    <div class="margin-b pad">
        <h3 class="vary mb-3">SICHERHEIT &amp; PERFORMANCE<br>UNSERER IAAS-PRODUKTE</h3>
        <p class="mb-5 text-center">
            Leistung, Hochverfügbarkeit und Datenschutz stehen bei uns an erster Stelle.<br>Dafür sorgen wir mit folgenden Maßnahmen:
        </p>
        <div class="column-count">
            <ul>
                <li>Web Application Firewall</li>
                <li>Schutz vor DDoS-Attacken</li>
                <li>Reverse Proxy</li>
                <li>Kemp Loadbalancer</li>
                <li>VMware micro segmentation</li>
                <li>Verfügbarkeit 99,95 %</li>
                <li>Beste Anbindung mit bis zu 1 Gbit</li>
                <li>EN 50600 VK 3 &amp; ISO 27001</li>
                <li>Hochsicheres Rechenzentrum in Schleswig-Holstein</li>
                <li>Dell-Hardware</li>
                <li>Konform mit deutschem und EU-Datenschutzrecht</li>
                <li>24/7 Service &amp; Support</li>
            </ul>
        </div>
    </div>

    <div class="bg-c-darkblue border-radius-d pad margin-b">
        <img class="img-xtra d-none d-lg-block" src="<?= Url::to('@web/image/Windcloud-treibhaus.png');?>" alt="Rechenzentrum">
        <div class="row mb-4">
            <div class="col-12 col-lg-9 text-left">
                <h3 class="mb-4">Warum sind IaaS-Lösungen<br>von Windcloud besonders nachhaltig?</h3>
                <p class="mb-5">
                    Unsere Lösungen sind nicht nur sicher und leistungsstark, sondern auch besonders klimafreundlich.
                    Der Strom für unsere Rechenzentren ist zu 100 % physikalisch grün und kommt größtenteils aus lokalen Windparks.
                    Darüber hinaus veredeln wir die Abwärme unserer Server mit Partnern direkt vor Ort.</p>
                <a class="border mobile-fill anim-1 show" href="/unternehmen/oekosystem">Mehr erfahren</a>
            </div>
        </div>
    </div>


    <div class="d-md-block mb-5">
        <div class="row">

            <div class="col-12 col-md-3 mb-4 text-center icons">
                <img height="150px" src="<?= Url::to('@web/image/Windcloud_Icon-Deutschland.svg');?>" alt="Deutsches Rechenzentrum">
                <p><strong>DEUTSCHES RECHENZENTRUM</strong></p>
            </div>

            <div class="col-12 col-md-3 mb-4 text-center icons">
                <img height="150px" src="<?= Url::to('@web/image/Windcloud_Icon-Support.svg');?>" alt="Support">
                <p><strong>24/7<br>SERVICE &amp; SUPPORT</strong></p>
            </div>

            <div class="col-12 col-md-3 mb-4 text-center icons">
                <img height="150px" src="<?= Url::to('@web/image/Windcloud_Icon-Migration.svg');?>" alt="Migration">
                <p><strong>UNTERSTÜTZUNG BEI PROJEKTIERUNG &amp; MIGRATION</strong></p>
            </div>

            <div class="col-12 col-md-3 mb-4 text-center icons">
                <img height="150px" src="<?= Url::to('@web/image/Windcloud_Icon-Zertifizierung.svg');?>" alt="Zertifizierung">
                <p><strong>EN 50600<br>ZERTIFIZIERUNG</strong></p>
            </div>

        </div>
    </div>






    <div class="bg-c-turkis border-radius-d mb-4 pad" style="display: none;">
        <div class="col-12">
            <div class="row align-items-center">
                <div class="col-12 text-center mb-4">
                    <h2 class="vary">PREISSZENARIEN FÜR IAAS</h2>
                    <p>Unternehmen mit Windows-Server...Lorem ipsum dolor sit amet, consetetur<br>sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut.</p>
                </div>
                <div class="col-12 tabbing">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="Preisbeispiel1-tab" data-toggle="tab" href="#Preisbeispiel1" role="tab" aria-controls="Preisbeispiel1"
                               aria-selected="true">Preisbeispiel 1</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="Preisbeispiel2-tab" data-toggle="tab" href="#Preisbeispiel2" role="tab" aria-controls="Preisbeispiel2"
                               aria-selected="false">Preisbeispiel 2</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="Preisbeispiel3-tab" data-toggle="tab" href="#Preisbeispiel3" role="tab" aria-controls="Preisbeispiel3"
                               aria-selected="false">Preisbeispiel 3</a>
                        </li>
                    </ul>
                    <div class="tab-content mb-4" id="myTabContent">
                        <div class="table-responsive-md tab-pane fade show active" id="Preisbeispiel1" role="tabpanel" aria-labelledby="Preisbeispiel1-tab">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">CPU</th>
                                    <th scope="col">RAM</th>
                                    <th scope="col">Storage</th>
                                    <th scope="col">Netzwerk</th>
                                    <th scope="col">Lizenzen</th>
                                    <th scope="col">Gesamtpreis</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                </tr>
                                <tr>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                </tr>
                                <tr>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive-md tab-pane mb-4 fade" id="Preisbeispiel2" role="tabpanel" aria-labelledby="Preisbeispiel2-tab">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">CPU</th>
                                    <th scope="col">RAM</th>
                                    <th scope="col">Storage</th>
                                    <th scope="col">Netzwerk</th>
                                    <th scope="col">Lizenzen</th>
                                    <th scope="col">Gesamtpreis</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                </tr>
                                <tr>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                </tr>
                                <tr>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive-md tab-pane mb-4 fade" id="Preisbeispiel3" role="tabpanel" aria-labelledby="Preisbeispiel3-tab">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">CPU</th>
                                    <th scope="col">RAM</th>
                                    <th scope="col">Storage</th>
                                    <th scope="col">Netzwerk</th>
                                    <th scope="col">Lizenzen</th>
                                    <th scope="col">Gesamtpreis</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                </tr>
                                <tr>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                </tr>
                                <tr>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                    <td>***</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center margin-b">
        <h4 class="mb-5 lowletter text-center">
            Sie benötigen eine Backup-Lösung für Ihre Infrastruktur?
            <a class="border mobile-fill ml-4 mt-3 anim-1 show" href="/produkte/cloud-backup">Zum Produkt</a>
        </h4>
    </div>

    <div class="bg-c-white border-radius-d margin-b pad p-5">
        <h3 class="vary mb-4">IHRE IAAS-ANFRAGE</h3>
        <p class="text-center mb-5">
            Unsere Experten beraten Sie gerne bei Auswahl und Dimensionierung Ihrer Cloud-Umgebung und unterstützen Sie bei Migration und Onboarding.
        </p>
        <?php $form = ActiveForm::begin(['action' => ['produkte/infrastructure-as-a-service'],'options' => ['method' => 'post'],'class' => 'needs-validation']); ?>
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
            <div class="col-md-6 text-right"></div>
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
                <?= Html::submitButton('Absenden', ['class' => 'btn border']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

    <div class="d-md-block">
        <h3 class="vary mb-5">UNSERE IAAS-KUNDEN</h3>
    </div>


    <div class="d-md-block margin-b">
        <div class="row">
            <div class="col-12 col-md-3 mb-5 text-center">
                <img height="50px" src="<?= Url::to('@web/image/vitabook-logo.png');?>" alt="Partner veeam">
            </div>
            <div class="col-12 col-md-3 mb-5 text-center">
                <img height="50px" src="<?= Url::to('@web/image/abo-wind-logo.png');?>" alt="Partner vmware">
            </div>
            <div class="col-12 col-md-3 mb-5 text-center">
                <img height="50px" src="<?= Url::to('@web/image/nef-logo.png');?>" alt="Partner vmware">
            </div>
            <div class="col-12 col-md-3 mb-5 text-center">
                <img height="50px" src="<?= Url::to('@web/image/Logo_c02free_SW.svg');?>" alt="Partner vmware">
            </div>
        </div>
    </div>
</div>





<?php
$this->registerCssFile("/css/cms/style-iaas.css");
?>
