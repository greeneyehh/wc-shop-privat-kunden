<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="container">

<div id="hero">
    <h1>Windcloud 4.0 GmbH</h1>
    <h2 class="vary">Neue digitale<br>Infrastrukturen</h2>
</div>

<div class="slider bg-gradient border-radius-d my-5">
    <div id="carousel-slider" class="carousel align-items-center slide" data-ride="carousel" >
        <div class="carousel-inner align-items-center">


            <div class="carousel-item align-items-center active" style="min-height: 240px;">
                <div class="row justify-content-center align-items-center adjust-h">
                    <div class="col-10 col-md-9 col-lg-7 text-center align-items-center">
                        Moin Moin!<br><br>Wir sind Windcloud.</div>
                </div>
            </div>


            <div class="carousel-item align-items-center" style="min-height: 240px;" >
                <div class="row justify-content-center align-items-center adjust-h" >
                    <div class="col-10 col-md-9 col-lg-7 text-center align-items-center">
                        Wir betreiben CO<sub>2</sub>-neutrale Rechenzentren.              </div>
                </div>
            </div>


            <div class="carousel-item align-items-center" style="min-height: 240px;">
                <div class="row justify-content-center align-items-center adjust-h" >
                    <div class="col-10 col-md-9 col-lg-7 text-center align-items-center">
                        Damit senken wir aktiv den enormen Energieverbrauch und die hohen CO<sub>2</sub>-Emissionen von IKT.              </div>
                </div>
            </div>


            <div class="carousel-item align-items-center ">
                <div class="row justify-content-center align-items-center adjust-h" >
                    <div class="col-10 col-md-9 col-lg-7 text-center align-items-center">
                        Denn wir betreiben unsere Rechenzentren direkt mit Windenergie an der Westküste Schleswig-Holsteins.              </div>
                </div>
            </div>


            <div class="carousel-item align-items-center " style="min-height: 240px;">
                <div class="row justify-content-center align-items-center adjust-h" >
                    <div class="col-10 col-md-9 col-lg-7 text-center align-items-center">
                        Darüber hinaus nutzen wir die Abwärme unserer Server für weitere Industrien, etwa für den Anbau von Lebensmitteln.              </div>
                </div>
            </div>


            <div class="carousel-item align-items-center " style="min-height: 240px;">
                <div class="row justify-content-center align-items-center adjust-h" >
                    <div class="col-10 col-md-9 col-lg-7 text-center align-items-center">
                        Unsere Rechenzentren sind dadurch besonders nachhaltig, kosteneffizient und sicher.              </div>
                </div>
            </div>


            <div class="carousel-item align-items-center " style="min-height: 240px;">
                <div class="row justify-content-center align-items-center adjust-h" >
                    <div class="col-10 col-md-9 col-lg-7 text-center align-items-center">
                        Wir haben gerade erst angefangen.<br>
                        <br>
                        Starten Sie mit uns!              </div>
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

<div class="column-count margin-b">
    <p>
        Windcloud steht für <strong>Nachhaltigkeit</strong> in den Bereichen <strong>Rechenzentren</strong> und <strong>Cloud-Computing</strong>. Durch unseren ganzheitlichen Ansatz
        verändern wir digitale Infrastrukturen radikal. Wir sparen Energie durch <strong>hocheffiziente Systeme</strong> im Rechenzentrum, nutzen konsequent <strong>Grünstrom</strong>
        aus Erneuerbaren Energien und schaffen darüber hinaus rentable Verwertungsmöglichkeiten für die <strong>Abwärme</strong> unserer Server. Damit treiben wir innovativ
        die <strong>Kopplung von Sektoren</strong> voran und schließen Energiekreisläufe. Mit dem Aufbau eines <strong>digital-industriellen</strong> Ökosystems veredeln wir
        <strong>Windstrom</strong> vor Ort und stärken so die lokale Wirtschaft.
    </p>
</div>

<img class="shadow-line" src="<?= Url::to('@web/img/schatten.png');?>" alt="shadow-line">


<div class="executive d-none d-md-block margin-b">
    <h2 class="vary mb-4">Management</h2>
    <div class="row">

        <div class="col-12 col-md-4 mb-4">
            <div class="bg-white border-radius-d box-shadow adjust-h">


                <div class="img">
                    <img src="<?= Url::to('@web/image/photo-gf-stephan-sladek.jpg');?>" alt="Management Stephan Sladek" title="Stephan Sladek">    </div>

                <div class="p-4">
                    <h5 class="vary mb-0" style="min-height: 23px;">IT-System Engineer</h5><h3 class="vary" style="min-height: 86px;">Stephan<br>Sladek</h3><ul class="m-0"><li>IT Services</li><li>Security</li><li>Infrastructure as a Service</li></ul>    </div>


            </div>
        </div>
        <div class="col-12 col-md-4 mb-4">
            <div class="bg-white border-radius-d box-shadow adjust-h">


                <div class="img">
                    <img src="<?= Url::to('@web/image/photo-gf-wilfried-ritter.jpg');?>" alt="Management Wilfried Ritter" title="Wilfried Ritter">    </div>

                <div class="p-4">
                    <h5 class="vary mb-0" style="min-height: 23px;">Energie- und Gebäudetechniker</h5><h3 class="vary" style="min-height: 86px;">Wilfried<br>Ritter</h3><ul class="m-0"><li>Facility</li><li>Infrastruktur</li><li>Operations</li><li>Project Management</li></ul>    </div>


            </div>
        </div>
    </div>
</div>

<div class="executive d-md-none margin-b">
    <div id="carousel-executive" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner border-radius-d box-shadow">
            <div class="carousel-item active" style="min-height: 0px;">
                <div class="bg-white border-radius-d box-shadow adjust-h" style="min-height: 0px;">


                    <div class="img">
                        <img srcset="<?= Url::to('@web/image/photo-gf-thomas-reimers.jpg');?> 620w, <?= Url::to('@web/image/photo-gf-thomas-reimers-150x150.jpg');?> 150w, <?= Url::to('@web/image/photo-gf-thomas-reimers-300x300.jpg');?> 300w" sizes="(min-width: 1200px) 350px, (min-width: 992px) 290px, (min-width: 768px) 210px, (min-width: 576px) 420px, calc(83vw - 30px)" src="<?= Url::to('@web/image/photo-gf-thomas-reimers.jpg');?>" alt="Management Thomas Reimers" title="Thomas Reimers">    </div>

                    <div class="p-4">
                        <h5 class="vary mb-0" style="min-height: 23px;">Wirtschaftsingenieur</h5><h3 class="vary" style="min-height: 86px;">Thomas<br>Reimers</h3><ul class="m-0"><li>Business Development</li><li>Vermarktung</li><li>Partnerschaften</li><li>Public Affairs</li></ul>    </div>


                </div>
            </div>
            <div class="carousel-item" style="min-height: 0px;">
                <div class="bg-white border-radius-d box-shadow adjust-h" style="min-height: 0px;">


                    <div class="img">
                        <img srcset="<?= Url::to('@web/image/photo-gf-stephan-sladek.jpg');?> 620w, <?= Url::to('@web/image/photo-gf-stephan-sladek-150x150.jpg');?>  150w, <?= Url::to('@web/image/photo-gf-stephan-sladek-300x300.jpg');?> 300w" sizes="(min-width: 1200px) 350px, (min-width: 992px) 290px, (min-width: 768px) 210px, (min-width: 576px) 420px, calc(83vw - 30px)" src="<?= Url::to('@web/image/photo-gf-stephan-sladek.jpg');?>" alt="Management Stephan Sladek" title="Stephan Sladek">    </div>

                    <div class="p-4">
                        <h5 class="vary mb-0" style="min-height: 23px;">IT-System Engineer</h5><h3 class="vary" style="min-height: 86px;">Stephan<br>Sladek</h3><ul class="m-0"><li>IT Services</li><li>Security</li><li>Infrastructure as a Service</li></ul>    </div>


                </div>
            </div>
            <div class="carousel-item" style="min-height: 0px;">
                <div class="bg-white border-radius-d box-shadow adjust-h" style="min-height: 0px;">


                    <div class="img">
                        <img srcset="<?= Url::to('@web/image/photo-gf-wilfried-ritter.jpg');?> 620w, <?= Url::to('@web/image/photo-gf-wilfried-ritter-150x150.jpg');?> 150w, <?= Url::to('@web/image/photo-gf-wilfried-ritter-300x300.jpg');?> 300w" sizes="(min-width: 1200px) 350px, (min-width: 992px) 290px, (min-width: 768px) 210px, (min-width: 576px) 420px, calc(83vw - 30px)" src="<?= Url::to('@web/image/photo-gf-wilfried-ritter.jpg');?>" alt="Management Wilfried Ritter" title="Wilfried Ritter">    </div>

                    <div class="p-4">
                        <h5 class="vary mb-0" style="min-height: 23px;">Energie- und Gebäudetechniker</h5><h3 class="vary" style="min-height: 86px;">Wilfried<br>Ritter</h3><ul class="m-0"><li>Facility</li><li>Infrastruktur</li><li>Operations</li><li>Project Management</li></ul>    </div>


                </div>
            </div>
        </div>

        <a class="carousel-control-prev" href="#carousel-executive" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon blue" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>

        <a class="carousel-control-next" href="#carousel-executive" role="button" data-slide="next">
            <span class="carousel-control-next-icon blue" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>

    </div>
</div>


<div class="partner d-none d-md-block margin-b">
    <h2 class="vary mb-4">Partner</h2>
    <div class="row">
        <div class="col-12 col-md-4 mb-4">
            <div class="bg-white border-radius-d box-shadow adjust-h">

                <a href="https://www.greentec-campus.de/" target="_blank" title="GreenTEC Campus">
                    <div class="img">
                        <img srcset="<?= Url::to('@web/image/logo-greentec-campus.jpg');?> 620w, <?= Url::to('@web/image/logo-greentec-campus-300x150.jpg');?> 300w" sizes="(min-width: 1200px) 350px, (min-width: 992px) 290px, (min-width: 768px) 210px, (min-width: 576px) 420px, calc(83vw - 30px)" src="<?= Url::to('@web/image/logo-greentec-campus.jpg');?>" alt="Logo GreenTEC Campus" title="GreenTEC Campus">    </div>

                    <div class="p-4">
                        <h3 class="vary" style="min-height: 29px;">GreenTEC Campus</h3><p>Der GreenTEC Campus in Enge-Sande ist Standort für innovative Unternehmen in den Bereichen Erneuerbare Energie, E-Mobilität und Green Data.</p>    </div>

                </a>
            </div>
        </div>
        <div class="col-12 col-md-4 mb-4">
            <div class="bg-white border-radius-d box-shadow adjust-h">

                <a href="https://denkerwulf.de/" target="_blank" title="Denker &amp; Wulf AG">
                    <div class="img">
                        <img srcset="<?= Url::to('@web/image/logo-denker-wulf-ag.jpg');?> 620w, <?= Url::to('@web/image/logo-denker-wulf-ag-300x150.jpg');?> 300w" sizes="(min-width: 1200px) 350px, (min-width: 992px) 290px, (min-width: 768px) 210px, (min-width: 576px) 420px, calc(83vw - 30px)" src="<?= Url::to('@web/image/logo-denker-wulf-ag.jpg');?>" alt="Logo Denker &amp; Wulf AG" title="Denker &amp; Wulf AG">    </div>

                    <div class="p-4">
                        <h3 class="vary" style="min-height: 29px;">Denker &amp; Wulf AG</h3><p>Die Denker &amp; Wulf AG gehört zu den wichtigsten Windparkentwicklern Deutschlands. Sie betreibt etwa 700 Windkraftanlagen mit mehr als 1,4 GW installierter Leistung.</p>    </div>

                </a>
            </div>
        </div>
        <div class="col-12 col-md-4 mb-4">
            <div class="bg-white border-radius-d box-shadow adjust-h">

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

<div class="partner d-md-none margin-b">
    <div id="carousel-partner" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner border-radius-d box-shadow">
            <div class="carousel-item active" style="min-height: 0px;">
                <div class="bg-white border-radius-d box-shadow adjust-h" style="min-height: 0px;">

                    <a href="https://www.greentec-campus.de/" target="_blank" title="GreenTEC Campus">
                        <div class="img">
                            <img srcset="<?= Url::to('@web/image/logo-greentec-campus.jpg');?> 620w, <?= Url::to('@web/image/logo-greentec-campus-300x150.jpg');?> 300w" sizes="(min-width: 1200px) 350px, (min-width: 992px) 290px, (min-width: 768px) 210px, (min-width: 576px) 420px, calc(83vw - 30px)" src="<?= Url::to('@web/image/logo-greentec-campus.jpg');?>" alt="Logo GreenTEC Campus" title="GreenTEC Campus">    </div>

                        <div class="p-4">
                            <h3 class="vary" style="min-height: 29px;">GreenTEC Campus</h3><p>Der GreenTEC Campus in Enge-Sande ist Standort für innovative Unternehmen in den Bereichen Erneuerbare Energie, E-Mobilität und Green Data.</p>    </div>

                    </a>
                </div>
            </div>
            <div class="carousel-item" style="min-height: 0px;">
                <div class="bg-white border-radius-d box-shadow adjust-h" style="min-height: 0px;">

                    <a href="https://denkerwulf.de/" target="_blank" title="Denker &amp; Wulf AG">
                        <div class="img">
                            <img srcset="<?= Url::to('@web/image/logo-denker-wulf-ag.jpg');?> 620w, <?= Url::to('@web/image/logo-denker-wulf-ag-300x150.jpg');?> 300w" sizes="(min-width: 1200px) 350px, (min-width: 992px) 290px, (min-width: 768px) 210px, (min-width: 576px) 420px, calc(83vw - 30px)" src="<?= Url::to('@web/image/logo-denker-wulf-ag.jpg');?>" alt="Logo Denker &amp; Wulf AG" title="Denker &amp; Wulf AG">    </div>

                        <div class="p-4">
                            <h3 class="vary" style="min-height: 29px;">Denker &amp; Wulf AG</h3><p>Die Denker &amp; Wulf AG gehört zu den wichtigsten Windparkentwicklern Deutschlands. Sie betreibt etwa 700 Windkraftanlagen mit mehr als 1,4 GW installierter Leistung.</p>    </div>

                    </a>
                </div>
            </div>
            <div class="carousel-item" style="min-height: 0px;">
                <div class="bg-white border-radius-d box-shadow adjust-h" style="min-height: 0px;">

                    <a href="http://www.abe-gruppe.de/" target="_blank" title="ABE Group">
                        <div class="img">
                            <img srcset="<?= Url::to('@web/image/logo-abe-group-2.jpg');?> 620w, <?= Url::to('@web/image/logo-abe-group-2-300x150.jpg');?> 300w" sizes="(min-width: 1200px) 350px, (min-width: 992px) 290px, (min-width: 768px) 210px, (min-width: 576px) 420px, calc(83vw - 30px)" src="<?= Url::to('@web/image/logo-abe-group-2.jpg');?>" alt="Logo ABE Group" title="ABE">    </div>

                        <div class="p-4">
                            <h3 class="vary" style="min-height: 29px;">ABE Group</h3><p>Die ABE Group ist Planer, Bauer &amp; Betreiber von Umspannwerken, Mittelspannungsnetzen und Groß-Speichermedien im GW-Bereich.</p>    </div>

                    </a>
                </div>
            </div>
        </div>

        <a class="carousel-control-prev" href="#carousel-partner" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon blue" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>

        <a class="carousel-control-next" href="#carousel-partner" role="button" data-slide="next">
            <span class="carousel-control-next-icon blue" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>

    </div>
</div>

<img class="shadow-line" src="<?= Url::to('@web/img/schatten.png')?>" alt="shadow-line">

<div class="membership margin-b z-index">
    <h2 class="vary mb-4">Mitgliedschaften</h2>
    <div class="bg-white border-radius-d box-shadow">
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
        </div>
    </div>
</div>

<div class="w-100"><div class="diamond bottom"><div class="box"><div class="trans"></div></div></div>
</div>
</div>
<?php
$this->registerCssFile("/css/cms/style-unternehmen.css");
?>
