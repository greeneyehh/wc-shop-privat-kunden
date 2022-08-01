<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>


    <div class="container">

        <div id="hero">
            <h1>Nachhaltiges Cloudron-Hosting auf VPS von Windcloud</h1>
            <h2 class="vary">CLOUDRON</h2>
        </div>
        <div class="d-md-block">
            <div>
                <p>
                    Cloudron ist die einfache Lösung zur Verwaltung von Applikationen auf Ihrem Virtuellen Server. Egal ob WordPress, Nextcloud oder GitLab – Mit Cloudron werden Ihnen Ihre Apps direkt inklusive Datenbanken, automatisierter DNS-Einrichtung, Zertifikatsverwaltung und zentralisierter Benutzerverwaltung bereitgestellt. Zudem werden Ihre Apps automatisch geupdatet und bleiben somit sicher und auf dem neuesten Stand. Ihr Vorteil bei Windcloud: Ihr Cloudron-Server wird zu 100 % grün in unserem Rechenzentrum in Norddeutschland betrieben.
                <br>
                </p>

                <a class="border mobile-fill anim-1 show" href="/produkte/vps">Cloudron-Server buchen</a>
            </div>

        </div>
        <div style="padding-bottom: 3rem;margin: 0 auto;text-align: center;" >
            <img src="<?= Url::to('@web/image/cloudron_Logo.png');?>" style="width: 350px;">
        </div>



    </div>

<div class="container-fluid">
<div class="container">

    <div class="membership margin-b z-index" style="padding-top: 3rem;">
        <h2 class="vary text-center font-size-2 " >APPS AUF CLOUDRON</h2>
    <div class="text-center font-size-4" >
        <p>Im Cloudron App Store stehen Ihnen über 100 Apps zur Verfügung, die Sie direkt ohne
            Aufwand installieren können.
        </p>
        <a class="border mobile-fill anim-1 show" target="_blank" href="https://www.cloudron.io/store/index.html">Cloudron App Store</a>
    </div>
        <div style="padding-top: 2rem;" >
            <div class="row">
                    <div class="col-8" style="margin: 0 auto;text-align: center;"  >
                        <img src="<?= Url::to('@web/image/cloudron.png');?>">
                    </div>
            </div>


        </div>
    </div>



</div>
</div>

<div class="container">

    <div class="membership margin-b z-index" style="padding-top: 3rem;margin-bottom: 4rem;">
        <h2 class="vary text-center font-size-2 " >CLOUDRON AUF WINDCLOUD</h2>
        <div class="text-center font-color-turquoise font-size-4 " >
            <p class="font-color-darkblue">Unsere Cloudron-Server sind nicht nur sicher und leistungsstark, sondern auch besonders klimafreundlich. Der Strom
                für unsere Rechenzentren ist zu 100 % physikalisch grün und kommt größtenteils aus lokalen Windparks. Darüber
                hinaus veredeln wir die Abwärme unserer Server mit Partnern direkt vor Ort.
            </p>
            <a class="border mobile-fill anim-1 show" href="/unternehmen/oekosystem">Mehr erfahren</a>
        </div>
    </div>
    <div class="membership margin-b z-index">
        <div class="bg-c-darkblue border-radius-d pad margin-b" style="padding: 1rem 2.5rem 1rem 2.5rem;">
           <div class="row mb-4"></div>
            <h3 class="mb-4 font-color-white">Buchen Sie jetzt Ihren Cloudron-Server ganz einfach bei Windcloud:</h3>
            <ul class="font-color-white">
                <li class="font-color-white">Wählen Sie den passenden Virtual Privat Server für Ihre Applikationen</li>
                <li class="font-color-white"> Wählen Sie Cloudron als Betriebssystem aus</li>
                <li class="font-color-white"> Ihr Server steht Ihnen kurze Zeit später zur Verfügung</li>

            </ul>
            <p style="padding-top: 1rem;">
                <a class="border mobile-fill anim-1 show"  style="margin:0 auto;" href="/produkte/vps">Zum VPS-Angebot</a>
            </p>
        </div>
        </div>
    </div>

</div>
<?php
$this->registerCssFile("/css/cms/style-cloudron-2.css");
?>

