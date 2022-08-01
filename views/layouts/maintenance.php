<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\module\Footer\FooterWidget;
use app\module\FooterAddon\FooterAddonWidget;
use app\module\NavBar\NavBarWidget;
use yiiui\yii2cookieconsent\widgets\CookieConsent;
use yii\helpers\Url;

use app\extensions\greendev\seotool\seo;
AppAsset::register($this);
seo::checkRoute();
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html class="js" lang="<?= Yii::$app->language ?>">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130021405-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-130021405-2');
    </script>


    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?=seo::FindSEOonRoute();?>
    <?php $this->registerCsrfMetaTags() ?>
    <?php $this->head() ?>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" href="/image/favicon-16x16.png" sizes="16x16">
    <link rel="icon" href="/image/favicon-24x24.png" sizes="24x24">
    <link rel="icon" href="/image/favicon-32x32.png" sizes="32x32">
    <link rel="icon" href="/image/favicon-64x64.png" sizes="64x64">
    <link rel="icon" href="/image/favicon-96x96.png" sizes="96x96">
</head>
    <?php   
    if( Yii::$app->getRequest()->getPathInfo() ) {
    	$newstr = Yii::$app->getRequest()->getPathInfo();


		$start =str_replace("/", " ", $newstr);
    } else {
        $start = 'startseite ';
    }

    if( $start =='produkte managed-nextcloud'){
        $start ='managed-nextcloud';
    }
    if( $start =='produkte cloud-backup'){
        $start ='cloud-backup';
    }
    ?>

<body class="page-template-default <?=$start?>">
<?php $this->beginBody() ?>
<header id="header" class="box-shadow fixed-top bg-white">

    <nav class="navbar navbar-expand-lg navbar-light" role="navigation">
        <div class="container-fluid">
            <div id="menu-shadow">
                <div class="d-flex justify-content-between align-items-center flex-grow-1 flex-lg-grow-0 menu-container">
                    <button class="navbar-toggler collapsed burger" type="button" data-toggle="collapse" data-target="#menu-main" aria-controls="menu-main" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="">
                        <a href="/"><img class="logo" src="<?= Url::to('@web/image/windcloud-logo-web.svg');?>" alt="windcloud-logo-web"></a>
                    </div>
                    <a class="d-lg-none" href="/kontakt">
                        <img src="<?= Url::to('@web/image/icon-contact.svg');?>" alt="Kontakt">
                    </a>
                </div>
            </div>
            <ul class="nav navbar-nav navbar-right">

                <ul class="navbar-nav" style="float: right;">
                    <li class="col-auto text-center nav-item" style="float: right;"> <a class="d-none d-lg-inline contact border" href="/dashboard">Login</a></li>
                </ul>
            </ul>
        </div>
    </nav>
</header>
	<main id="main">
        <div class="container">

            <div class="kachelanimation">
                <div class="netz d-none d-md-block">
                    <img class="net" src="<?= Url::to('@web/image/Windcloud-net-768x543.png');?>" title="Windcloud Netz">
                </div>
                <div class="raute"></div>
                <div class="kacheln">
                    <div class="tile-1 move-in-2-5">
                        <div class="levitate-3">
                            <img src="<?= Url::to('@web/image/Windcloud-windraeder-768x543.png');?>" alt="Windpark als 3D-Visual" title="Windpark | Windcloud 4.0 GmbH">
                            <div class="box"><div class="trans"></div></div>
                        </div>
                    </div>

                    <div class="tile-2 move-in-2">
                        <div class="levitate-4">
                            <img src="<?= Url::to('@web/image/Windcloud-kaserne-768x543.png');?>" alt="Rechenzentrum als 3D-Visual" title="Rechenzentrum | Windcloud 4.0 GmbH">
                            <div class="box"><div class="trans"></div></div>
                        </div>
                    </div>

                    <div class="tile-3 move-in-3">
                        <div class="levitate-5">
                            <img src="<?= Url::to('@web/image/Windcloud-solar-768x543.png');?>" alt="Solarpark als 3D-Visual" title="Solarpark | Windcloud 4.0 GmbH">
                            <div class="box"><div class="trans"></div></div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="hero" class="row margin-b">
                <div class="col-12 col-md-8 col-lg-6 aufmachertext">
                    <h1>Server <br> Wartungsarbeiten</h1>
                    <h2 class="vary">Wir<br class="d-md-none" > Verbessern <br class="d-none d-md-block" >unseren service für sie.</h2>
                    <p class="mb-4">

                    </p>
                </div>
            </div>

        </div>

        <div class="spacer-image background-1"></div>



        <div class="container-fluid">
            <div class="container blockImgTxt logoabbinder text-center">

                <div class="d-md-block">
                    <h3 class="vary mb-5 text-center">KUNDEN</h3>
                </div>

                <div class="d-md-block">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-2 offset-lg-1 mb-5 mb-md-4">
                            <img src="<?= Url::to('@web/image/stadtwerle-husum-logo.png');?>" alt="Logo Stadtwerke Husum">
                        </div>
                        <div class="col-12 col-md-6 col-lg-2 mb-5 mb-md-4">
                            <img src="<?= Url::to('@web/image/vitabook-logo.png');?>" alt="Logo Vita">
                        </div>
                        <div class="col-12 col-md-6 col-lg-2 mb-5 mb-md-4">
                            <img src="<?= Url::to('@web/image/abo-wind-logo.png');?>" alt="Logo Abo Wind">
                        </div>
                        <div class="col-12 col-md-6 col-lg-2 mb-5 mb-md-4">
                            <img src="<?= Url::to('@web/image/joke-event-ag-logo.png');?>" alt="Logo Joke Event AG">
                        </div>
                        <div class="col-12 col-md-6 col-lg-2 offset-md-3 offset-lg-0 mb-4">
                            <img src="<?= Url::to('@web/image/balticfinance-logo.png');?>" alt="Logo balticfinance">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
            <?=CookieConsent::widget([
                'palettePopupBackground' => '#000000',
                'paletteButtonBackground' => '#FBAD38',
                'theme' => 'edgeless',
                'position' => 'bottom',
                'contentDismiss' => 'Ok',
                'contentLink' => 'Mehr erfahren',
                'contentMessage' => 'Diese Website benutzt Cookies. Wenn du die Website weiter nutzt, gehen wir von deinem Einverständnis aus.',
                'contentHref' => '/datenschutzerklaerung',
            ]);
            ?>



	</main>

<?= FooterAddonWidget::widget() ?>

<?= FooterWidget::widget() ?>

<?php $this->endBody();

 $this->registerCssFile("/css/cms/style-navbar-2.css");
?>
</body>
</html>
<?php $this->endPage() ?>
