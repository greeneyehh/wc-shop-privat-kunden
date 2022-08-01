<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>

        <img src="<?= Url::to('@web/image/landingpage/top.png');?>" style="position: absolute;width: 100%;margin-bottom: 22px;z-index: 2;">
        <div style="position: relative;z-index:4">
        <h1 style="font-family: Alfa Slab One, serif;text-align: center;pading-top: 2rem;padding-top: 12rem;padding-bottom: 6rem;font-weight: bold;font-size: 8rem;">Emission is our Mission</h1>
        <div class="container" style="font-family: Arimo, serif; font-size: 2rem;line-height: 5rem;">

        <h2 style="pading-top: 2rem;padding-bottom: 1rem;font-weight: bold;font-size: 4rem;"> Wunderbar, dass Sie sich von dem Claim haben leiten lassen auf unsere Homepage.</h2>
        <strong>Was heisst "Emission is our Mission"?</strong><br>
        Wir als Windcloud möchten gemeinsam mit Ihnen dafür sorgen, dass das Bewusstsein für digitales Handeln im Alltag eine neue Aufmerksamkeit erhält.
        Dazu benötigen wir keinen erhobenen Zeigefinger, welcher ermahnt und belehrt, sondern in erster Linie appellieren wir an der Lust am Wandel. Es vergeht kein Tag, an dem man nicht in den Medien von dem Zustand der Welt hört und was es gilt zu leisten.
        Jeder von uns sollte sich aufgerufen fühlen, in den eigenen Rahmen seiner Möglichkeiten, etwas für das große Ziel beizutragen.
        Es gibt unendliche viele davon, aber wo fängt man an und wo hört man auf? Vieles ist sichtbar und erklärt sich, so dass Nutzen und Wirksamkeit umsetzbar scheint. Aber was ist mit den Prozessen, die uns im Hintergrund begleiten, die keine Sichtbarkeit haben? Wir sind in der digitalen Welt stündlich unterwegs und wir nutzen Systeme, ohne zu hinterfragen, was dadurch ausgelöst wird.
        <p><p><p>
        <strong>Wir bei der Windcloud haben daher ein ganz spezielles Verfahren entwickelt, was es uns möglich macht,
            das Unsichtbare sichtbar zu machen, indem CO2 nicht nur neutral, sondern positiv verarbeitet werden kann.
        </strong>
        </p><p><p>
            Konkret wird die durch unser eigenes Rechenzentrum erzeugte Energie direkt in nachhaltige Anwendungen umgewandelt. Als Beweis steht dafür unsere Algenfarm,
            die in regelmäßigen Abständen Ernten einfährt.
            Durch Zuführung der Abwärme vom Rechenzentrum absorbieren die Algen bei Ihrer Photosynthese CO2 und halten sich konstant durch die Jahreszeiten - somit erzeugt jeder Nutzer bei uneingeschränkter Datennutzung einen klimapositiven Effekt.
            Wie man allein nur an diesem Beispiel erkennen kann,<strong> ist es gar nicht so schwer, nicht nur stündlich, sondern fast schon sekündlich die Umwelt entlasten zu können.</strong> Man muss eben nur darum wissen…
            <p>
            <p><p>
            Umso mehr würden wir uns freuen, wenn Sie sich unserer Mission anschließen und uns bei unserem Ziel unterstützen würden.
            <p><p><p>
            Informieren Sie sich gern auf den nachfolgenden Charts über die zahlreichen Angebote von Windcloud und sollten Sie Fragen haben, so kontaktieren Sie uns bitte jederzeit.
            <p><p><p>
        </div>
        </div>
<div class="row" >
<div class="margin-b text-center m-6" style="margin-bottom: 2rem;">
<a class="border mobile-fill anim-1 show" href="/">zum Angebot &gt;</a>
 </div>
 </div>



<style>
strong {
  font-weight: bolder;
  font-size: 2.5rem;
}
.bg-darkblue a::before, #cta-teaser .button a::before {
  background: #ffffff;
}
a::before {
  background-color: #33AAAA;
  color: white !important;
}
a::before, #header a::before, #cta-teaser .button a::before {
  content: "";
  position: absolute;
  background: #33AAAA;
  bottom: 0;
  left: 0;
  right: 100%;
  top: 0;
  z-index: -1;
  -webkit-transition: right 0.18s ease-in;
}

a{
  font-size: 1.2rem;
}

.bg-darkblue a:hover {
  color: #004477;
  border-color: #fff !important;
}
a.border:hover, a.border:active {
  text-decoration: none;
}
a.border {
  width: 211px;
}


a {
  color: #fff;
  border-color: #fff;
  display: block;
  margin: 2rem 0 0 0;
}
a:hover, a:not(:hover), button, input, a {
  transition: 0.08s ease-in;
  overflow: hidden;
  background: none;
  position: relative;
}
a:hover {
  color: white;
background-color: #fff;
}
a, a:hover, a:active {
  text-decoration: none;
background-color: #fff;

}
a:hover {
  color: #0056b3;
  background-color: #fff;
  text-decoration: underline;
}
a:hover, a:not( :hover ), button, input,  a {
    transition:  0.08s ease-in;
    overflow:hidden;
    position: relative
}
.border {
  border: 0.1875rem solid !important;
    border-top-color: currentcolor;
    border-right-color: currentcolor;
    border-bottom-color: currentcolor;
    border-left-color: currentcolor;
  padding: 0.5rem;
  font-weight: bold;
  display: inline-block;
  margin-bottom: 0.5rem;
  text-align: center;
}
.border {
  border: 2px solid #dee2e6 !important;
}
a {
  color: #ffffff;
  border-color: #33AAAA;
}
a {
  font-size: 1.2rem;
}





/* Animation */

.appearing:not(.js-hide), .no-js.appearing {
    animation: appearing 1.3s 1 ease-out;
}

@keyframes appearing {
    0% {
        opacity: 0;
        transform: translate(43px, -25px)
    }

    100% {
        opacity: 1;
        transform: translate(0, 0)
    }
}

.move-in-2 {
    -webkit-animation: moveIn 2s 1 ease-out;
    -moz-animation: moveIn 2s 1 ease-out;
    -ms-animation: moveIn 2s 1 ease-out;
    -o-animation: moveIn 2s 1 ease-out;
    animation: moveIn 2s 1 ease-out;
}

.move-in-2-5 {
    -webkit-animation: moveIn 2.5s 1 ease-out;
    -moz-animation: moveIn 2.5s 1 ease-out;
    -ms-animation: moveIn 2.5s 1 ease-out;
    -o-animation: moveIn 2.5s 1 ease-out;
    animation: moveIn 2.5s 1 ease-out;
}

.move-in-3 {
    -webkit-animation: moveIn 3s 1 ease-out;
    -moz-animation: moveIn 3s 1 ease-out;
    -ms-animation: moveIn 3s 1 ease-out;
    -o-animation: moveIn 3s 1 ease-out;
    animation: moveIn 3s 1 ease-out;
}

@-webkit-keyframes moveIn {
    0% {
        -webkit-transform: translate(300%, -300%);
    }

    100% {
        -webkit-transform: translate(0, 0);
    }
}

@-moz-keyframes moveIn {
    0% {
        -moz-transform: translate(300%, -300%);
    }

    100% {
        -moz-transform: translate(0, 0);
    }
}

@-ms-keyframes moveIn {
    0% {
        -ms-transform: translate(300%, -300%);
    }

    100% {
        -ms-transform: translate(0, 0);
    }
}

@-o-keyframes moveIn {
    0% {
        -o-transform: translate(300%, -300%);
    }

    100% {
        -o-transform: translate(0, 0);
    }
}

@keyframes moveIn {
    0% {
        transform: translate(300%, -300%);
    }

    100% {
        transform: translate(0, 0);
    }
}

.levitate-3 {
    -webkit-animation: levitate 3s infinite ease-in-out;
    -moz-animation: levitate 3s infinite ease-in-out;
    -ms-animation: levitate 3s infinite ease-in-out;
    -o-animation: levitate 3s infinite ease-in-out;
    animation: levitate 3s infinite ease-in-out;
}

.levitate-4 {
    -webkit-animation: levitate 4s infinite ease-in-out;
    -moz-animation: levitate 4s infinite ease-in-out;
    -ms-animation: levitate 4s infinite ease-in-out;
    -o-animation: levitate 4s infinite ease-in-out;
    animation: levitate 4s infinite ease-in-out;
}

.levitate-5 {
    -webkit-animation: levitate 5s infinite ease-in-out;
    -moz-animation: levitate 5s infinite ease-in-out;
    -ms-animation: levitate 5s infinite ease-in-out;
    -o-animation: levitate 5s infinite ease-in-out;
    animation: levitate 5s infinite ease-in-out;
}

@-webkit-keyframes levitate {
    0%, 100% {
        -webkit-transform: translate(0, 0);
    }

    50% {
        -webkit-transform: translate(0, 4%);
    }
}

@-moz-keyframes levitate {
    0%, 100% {
        -moz-transform: translate(0, 0);
    }

    50% {
        -moz-transform: translate(0, 4%);
    }
}

@-ms-keyframes levitate {
    0%, 100% {
        -ms-transform: translate(0, 0);
    }

    50% {
        -ms-transform: translate(0, 4%);
    }
}

@-o-keyframes levitate {
    0%, 100% {
        -o-transform: translate(0, 0);
    }

    50% {
        -o-transform: translate(0, 4%);
    }
}

@keyframes levitate {
    0%, 100% {
        transform: translate(0, 0);
    }

    50% {
        transform: translate(0, 4%);
    }
}

.show.anim-1,
.show.anim-2,
.show.anim-3 {
    -webkit-clip-path: polygon(0% 0%, 0% 0%, 0% 100%, 0% 100%);
    clip-path: polygon(0% 0%, 0% 0%, 0% 100%, 0% 100%);
}

.show.anim-1 {
    -webkit-animation: polygons .5s 1 .2s forwards;
    animation: polygons .5s 1 0.2s forwards;
}

.show.anim-2 {
    -webkit-animation: polygons .5s 1 .45s forwards;
    animation: polygons .5s 1 0.45s forwards;
}

.show.anim-3 {
    -webkit-animation: polygons .5s 1 .7s forwards;
    animation: polygons .5s 1 .7s forwards;
}

@-webkit-keyframes polygons {
    33% {
        -webkit-clip-path: polygon(0% 0%, 20% 0%, 50% 100%, 0% 100%);
    }

    66% {
        -webkit-clip-path: polygon(0% 0%, 80% 0%, 50% 100%, 0% 100%);
    }

    100% {
        -webkit-clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%);
    }
}

@keyframes polygons {
    33% {
        -webkit-clip-path: polygon(0% 0%, 20% 0%, 50% 100%, 0% 100%);
        clip-path: polygon(0% 0%, 20% 0%, 50% 100%, 0% 100%);
    }

    66% {
        -webkit-clip-path: polygon(0% 0%, 80% 0%, 50% 100%, 0% 100%);
        clip-path: polygon(0% 0%, 80% 0%, 50% 100%, 0% 100%);
    }

    100% {
        -webkit-clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%);
        clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%);
    }
}

@-webkit-keyframes cta-background {
    0%, 66% {
        background-color: white;
        color: #88BB55;
    }

    100% {
    }
}

@-moz-keyframes cta-background {
    0%, 66% {
        background-color: white;
        color: #88BB55;
    }

    100% {
    }
}

@-ms-keyframes cta-background {
    0%, 66% {
        background-color: white;
        color: #88BB55;
    }

    100% {
    }
}

@-o-keyframes cta-background {
    0%, 66% {
        background-color: white;
        color: #88BB55;
    }

    100% {
    }
}

@keyframes cta-background {
    0%, 66% {
        background-color: white;
        color: #88BB55;
    }

    100% {
    }
}

@-webkit-keyframes product-background {
    0%, 66% {
        background-color: #33AAAA;
        color: #004477;
    }

    100% {
    }
}

@-moz-keyframes product-background {
    0%, 66% {
        background-color: #33AAAA;
        color: #004477;
    }

    100% {
    }
}

@-ms-keyframes product-background {
    0%, 66% {
        background-color: #33AAAA;
        color: #004477;
    }

    100% {
    }
}

@-o-keyframes product-background {
    0%, 66% {
        background-color: #33AAAA;
        color: #004477;
    }

    100% {
    }
}

@keyframes product-background {
    0%, 66% {
        background-color: #33AAAA;
        color: #004477;
    }

    100% {
    }
}


</style>
