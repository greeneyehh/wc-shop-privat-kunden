<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="diamond bottom"><div class="box"><div class="trans"></div></div></div>
<div id="hero" class="row flex-column flex-md-row-reverse margin-b">
  <div class="col-12 col-md-6">
    <div class="pic">
      <div class="diamond top"><div class="box"><div class="trans"></div></div></div>
      <img class="net" srcset="<?= Url::to('@web/image/Windcloud-net.png');?> 2000w, <?= Url::to('@web/image/Windcloud-net-300x212.png');?> 300w, <?= Url::to('@web/image/Windcloud-net-768x543.png');?> 768w, <?= Url::to('@web/image/Windcloud-net-1024x724.png');?> 1024w, <?= Url::to('@web/image/Windcloud-net-1200x848.png');?> 1200w" sizes="(min-width: 1200px) 540px, (min-width: 992px) 450px, (min-width: 768px) 330px, (min-width: 576px) 510px, calc(100vw - 30px)" src="<?= Url::to('@web/image/Windcloud-net-1024x724.png');?>" title="Windcloud-net">
      <div class="tile-1 move-in-2-5">
        <div class="img-tile levitate-3">
          <div class="img">
            <img srcset="<?= Url::to('@web/image/Windcloud-windraeder.png');?> 4960w, <?= Url::to('@web/image/Windcloud-windraeder-300x212.png');?> 300w, <?= Url::to('@web/image/Windcloud-windraeder-768x543.png');?> 768w, <?= Url::to('@web/image/Windcloud-windraeder-1024x724.png');?> 1024w, <?= Url::to('@web/image/Windcloud-windraeder-1200x848.png');?> 1200w" sizes="(min-width: 1200px) 445px, (min-width: 992px) 370px, (min-width: 768px) 270px, (min-width: 576px) 420px, calc(83vw - 30px)" src="<?= Url::to('@web/image/Windcloud-windraeder-1024x724.png" alt="Windpark als 3D-Visual');?>" title="Windpark | Windcloud 4.0 GmbH">          </div>
          <div class="box"><div class="trans"></div></div>
        </div>
      </div>

      <div class="tile-2 move-in-2">
        <div class="img-tile levitate-4">
          <div class="img">
            <img srcset="<?= Url::to('@web/image/Windcloud-kaserne.png');?> 4960w, <?= Url::to('@web/image/Windcloud-kaserne-300x212.png');?> 300w, <?= Url::to('@web/image/Windcloud-kaserne-768x543.png');?> 768w, <?= Url::to('@web/image/Windcloud-kaserne-1024x724.png');?> 1024w, <?= Url::to('@web/image/Windcloud-kaserne-1200x848.png');?> 1200w" sizes="(min-width: 1200px) 445px, (min-width: 992px) 370px, (min-width: 768px) 270px, (min-width: 576px) 420px, calc(83vw - 30px)" src="<?= Url::to('@web/image/Windcloud-kaserne-1024x724.png" alt="Rechenzentrum als 3D-Visual');?>" title="Rechenzentrum | Windcloud 4.0 GmbH">          </div>
          <div class="box"><div class="trans"></div></div>
        </div>
      </div>

      <div class="tile-3 move-in-3">
        <div class="img-tile levitate-5">
          <div class="img">
            <img srcset="<?= Url::to('@web/image/Windcloud-solar.png');?> 4960w, <?= Url::to('@web/image/Windcloud-solar-300x212.png');?> 300w, <?= Url::to('@web/image/Windcloud-solar-768x543.png');?> 768w, <?= Url::to('@web/image/Windcloud-solar-1024x724.png');?> 1024w, <?= Url::to('@web/image/Windcloud-solar-1200x848.png');?> 1200w" sizes="(min-width: 1200px) 445px, (min-width: 992px) 370px, (min-width: 768px) 270px, (min-width: 576px) 420px, calc(83vw - 30px)" src="<?= Url::to('@web/image/Windcloud-solar-1024x724.png" alt="Solarpark als 3D-Visual');?>" title="Solarpark | Windcloud 4.0 GmbH">          </div>
          <div class="box"><div class="trans"></div></div>
        </div>
      </div>

    </div>
  </div>
  <div class="col-12 col-md-6">
    <h1>Willkommen bei Windcloud</h1>
    <h2 class="vary">Wir betreiben<br>CO<sub>2</sub>-neutrale Rechenzentren</h2>
    <p>
      Wir sind der Partner für <strong>nachhaltige Digitalisierung</strong>. Durch unser Konzept der Direktversorgung mit <strong>grüner Energie</strong> 
      schaffen wir besonders kosteneffiziente Infrastrukturen. Unsere <strong>Cloud-Lösungen</strong> sind nachhaltig zu wettbewerbsfähigen Preisen.
    </p>
    <a class="border mobile-fill" href="/produkte">Zu den Produkten</a>
  </div>
</div>

<img class="shadow-line" src="<?= Url::to('@web/img/schatten.png');?>" alt="shadow-line">

<h5 class="vary">Warum Windcloud?</h5>
<div class="row margin-b justify-content-between">
  <div class="col-12 col-sm">
    <h2 class="vary">Die Folgen des Klimawandels sind bereits heute spürbar.</h2>
  </div>
  <div class="col-12 col-sm">
    <p>
      Dem Weltklimarat zufolge muss jetzt schnell und weitreichend gehandelt werden, um die Erderwärmung auf <strong>1,5 Grad</strong>
      zu begrenzen. Ungeachtet dessen basiert der Großteil der Industrieprozesse immer noch auf klimaschädlichen Energieträgern. Das gilt auch für Rechenzentren, die durch die rasante Verbreitung 
      <strong>digitaler Technologien</strong>, zu einem bedeutenden Faktor in der <strong>globalen Energie- und Klimabilanz</strong> geworden sind.
    </p>
  </div>
</div>

  <div class="slider bg-c-turkis border-radius-d margin-b">
    <h3 class="title text-center px-3">Umwelteffekte digitaler Technologien in Zahlen</h3>
   

    <div id="carousel-slider" class="carousel slide" data-ride="carousel">

      <div class="carousel-inner">

        
          <div class="carousel-item row justify-content-center align-items-center active" style="min-height: 230px;">
            <div class="row justify-content-center align-items-center adjust-h" style="min-height: 230px;">
              <div class="big text-end">
                7%              </div>
              <div class="col-11 col-lg-5 text text-center text-lg-left">
                <p><b>der globalen Energieproduktion.<br></b>So viel verbrauchen Informations- und Kommunikationstechnologien heute. <b>Rechenzentren</b> haben daran einen entscheidenden Anteil.</p>
              </div>
            </div>
          </div>

          
          <div class="carousel-item row justify-content-center align-items-center" style="min-height: 230px;">
            <div class="row justify-content-center align-items-center adjust-h" style="min-height: 230px;">
              <div class="big text-end">
                47              </div>
              <div class="col-11 col-lg-5 text text-center text-lg-left">
                <p><b>Mrd. Kwh Strom<br></b>verbrauchen Informations- und Kommunikationstechnologien ungefähr jedes Jahr in Deutschland – mit steigender Tendenz.</p>
              </div>
            </div>
          </div>

          
          <div class="carousel-item row justify-content-center align-items-center" style="min-height: 230px;">
            <div class="row justify-content-center align-items-center adjust-h" style="min-height: 230px;">
              <div class="big text-end">
                2%              </div>
              <div class="col-11 col-lg-5 text text-center text-lg-left">
                <p><b>der globalen CO2-Emissionen<br></b>werden durch Rechenzentren verursacht. Innerhalb des gesamten IKT-Sektors haben sie die am schnellsten wachsende <b>CO2-Bilanz</b>.</p>
              </div>
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

<div id="reasons" class="row margin-b">
  <div class="col-12">
    <div class="row align-items-center">
      <div class="col-12 col-lg-6 mb-3">
        <div class="pic">
          <img class="net" srcset="<?= Url::to('@web/image/Windcloud-net.png');?> 2000w, <?= Url::to('@web/image/Windcloud-net-300x212.png');?> 300w, <?= Url::to('@web/image/Windcloud-net-768x543.png');?> 768w, <?= Url::to('@web/image/Windcloud-net-1024x724.png');?> 1024w, <?= Url::to('@web/image/Windcloud-net-1200x848.png');?> 1200w" sizes="(min-width: 1200px) 540px, (min-width: 992px) 450px, (min-width: 768px) 330px, (min-width: 576px) 510px, calc(100vw - 30px)" src="<?= Url::to('@web/image/Windcloud-net-1024x724.png');?>" title="Windcloud-net">          <div class="img-tile tile-1 levitate-4">
            <div class="img">
              <img srcset="<?= Url::to('@web/image/Windcloud-windraeder-wasser.png');?> 4960w, <?= Url::to('@web/image/Windcloud-windraeder-wasser-300x212.png');?> 300w, <?= Url::to('@web/image/Windcloud-windraeder-wasser-768x543.png');?> 768w, <?= Url::to('@web/image/Windcloud-windraeder-wasser-1024x724.png');?> 1024w, <?= Url::to('@web/image/Windcloud-windraeder-wasser-1200x848.png');?> 1200w" sizes="(min-width: 1200px) 445px, (min-width: 992px) 370px, (min-width: 768px) 570px, (min-width: 576px) 420px, calc(83vw - 30px)" src="<?= Url::to('@web/image/Windcloud-windraeder-wasser-1024x724.png" alt="Offshore-Windpark als 3D-Visual');?>" title="Offshore-Windpark | Windcloud 4.0 GmbH">            </div>
            <div class="box"><div class="trans"></div></div>
          </div>
          <div class="img-tile tile-2 levitate-5">
            <div class="img">
              <img srcset="<?= Url::to('@web/image/Windcloud-solar.png');?> 4960w, <?= Url::to('@web/image/Windcloud-solar-300x212.png');?> 300w, <?= Url::to('@web/image/Windcloud-solar-768x543.png');?> 768w, <?= Url::to('@web/image/Windcloud-solar-1024x724.png');?> 1024w, <?= Url::to('@web/image/Windcloud-solar-1200x848.png');?> 1200w" sizes="(min-width: 1200px) 445px, (min-width: 992px) 370px, (min-width: 768px) 570px, (min-width: 576px) 420px, calc(83vw - 30px)" src="<?= Url::to('@web/image/Windcloud-solar-1024x724.png" alt="Solarpark als 3D-Visual');?>" title="Solarpark | Windcloud 4.0 GmbH">            </div>
            <div class="box"><div class="trans"></div></div>
          </div>
          <div class="img-tile tile-3 levitate-3">
            <div class="img">
              <img srcset="<?= Url::to('@web/image/Windcloud-windraeder-klein.png');?> 4960w, <?= Url::to('@web/image/Windcloud-windraeder-klein-300x212.png');?> 300w, <?= Url::to('@web/image/Windcloud-windraeder-klein-768x543.png');?> 768w, <?= Url::to('@web/image/Windcloud-windraeder-klein-1024x724.png');?> 1024w, <?= Url::to('@web/image/Windcloud-windraeder-klein-1200x848.png');?> 1200w" sizes="(min-width: 1200px) 445px, (min-width: 992px) 370px, (min-width: 768px) 570px, (min-width: 576px) 420px, calc(83vw - 30px)" src="<?= Url::to('@web/image/Windcloud-windraeder-klein-1024x724.png" alt="Windpark-klein als 3D-Visual');?>" title="Windpark-klein | Windcloud 4.0 GmbH">            </div>
            <div class="box small"><div class="trans"></div></div>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-6">
        <h2 class="vary">Für eine Zukunft mit CO<sub>2</sub>-neutralen Rechenzentren</h2>
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="row">
      <div class="col-6 col-lg-3">
        <p>1. Windcloud ist die <strong>nachhaltige</strong> Alternative im Bereich <strong>Cloud-Computing</strong>. Wir sind Vorreiter auf dem Gebiet CO<sub>2</sub>-neutraler Rechenzentren.</p>
      </div>
      <div class="col-6 col-lg-3">
        <p>2. Unsere Energieversorgung basiert auf der lokalen Nutzung von <strong>Erneuerbaren Energien</strong> an der Westküste <strong>Schleswig-Holsteins</strong>.</p>
      </div>
      <div class="col-6 col-lg-3">
        <p>3. Wir bieten Ihnen schon jetzt <strong>grüne Cloud-Lösungen</strong> in den Bereichen IaaS, Managed Kubernetes und Storage.</p>
      </div>
      <div class="col-6 col-lg-3">
        <p>4. Bereits heute arbeiten wir aktiv daran, die <strong>Abwärme</strong> aus unseren <strong>Rechenzentren</strong> für weitere Industrien nutzbar zu machen.</p>
      </div>
    </div>
  </div>
</div>

<img class="shadow-line" src="<?= Url::to('@web/img/schatten.png');?>" alt="shadow-line">


<div id="bottom-teaser" class="row margin-b">
  <div class="col-12 col-sm">
    <a href="/rechenzentrum">
      <div class="bg-white box-shadow">
        <div class="row">
          <div class="col-12 col-xl-9">
            <h5 class="vary">Wie funktioniert Windcloud?</h5>
            <h4 class="vary text-uppercase">Unsere Rechenzentren bilden den Kern eines digital-industriellen Ökosystems.</h4>
            <div class="arrow border">Mehr</div>
          </div>
        </div>
      </div>
      <div class="img-tile">
        <div class="img">
          <img srcset="<?= Url::to('@web/image/Windcloud-windraeder.png');?> 4960w, <?= Url::to('@web/image/Windcloud-windraeder-300x212.png');?> 300w, <?= Url::to('@web/image/Windcloud-windraeder-768x543.png');?> 768w, <?= Url::to('@web/image/Windcloud-windraeder-1024x724.png');?> 1024w, <?= Url::to('@web/image/Windcloud-windraeder-1200x848.png');?> 1200w" sizes="(min-width: 1200px) 445px, (min-width: 992px) 370px, (min-width: 768px) 270px, (min-width: 576px) 420px, calc(83vw - 30px)" src="<?= Url::to('@web/image/Windcloud-windraeder-1024x724.png" alt="Windpark als 3D-Visual');?>" title="Windpark | Windcloud 4.0 GmbH">        </div>
      </div>
    </a>
  </div>
  <div class="col-md-1"></div>
  <div class="col-12 col-sm">
    <a href="/unternehmen">
      <div class="bg-white box-shadow">
        <div class="row">
          <div class="col-12 col-xl-9">
            <div>
              <h5 class="vary">Wer sind wir?</h5>
              <h4 class="vary text-uppercase">Windcloud ist Bauherr und Betreiber grüner Rechenzentren in Nord­deutschland.</h4>
              <div class="arrow border">Mehr</div>
            </div>
          </div>
        </div>
      </div>
      <div class="img-tile">
        <div class="img">
          <img srcset="<?= Url::to('@web/image/Windcloud-kaserne.png');?> 4960w, <?= Url::to('@web/image/Windcloud-kaserne-300x212.png');?> 300w, <?= Url::to('@web/image/Windcloud-kaserne-768x543.png');?> 768w, <?= Url::to('@web/image/Windcloud-kaserne-1024x724.png');?> 1024w, <?= Url::to('@web/image/Windcloud-kaserne-1200x848.png');?> 1200w" sizes="(min-width: 1200px) 445px, (min-width: 992px) 370px, (min-width: 768px) 270px, (min-width: 576px) 420px, calc(83vw - 30px)" src="<?= Url::to('@web/image/Windcloud-kaserne-1024x724.png" alt="Rechenzentrum als 3D-Visual');?>" title="Rechenzentrum | Windcloud 4.0 GmbH">        </div>
      </div>
    </a>
  </div>
</div>
