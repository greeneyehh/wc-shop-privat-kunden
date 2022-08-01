<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\module\Footer\FooterWidget;
use app\module\FooterAddon\FooterAddonWidget;
use app\module\NavBar\NavBarWidget;
use yiiui\yii2cookieconsent\widgets\CookieConsent;

use app\extensions\greendev\seotool\seo;
AppAsset::register($this);
seo::checkRoute();
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html class="js" lang="<?= Yii::$app->language ?>">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="preload">


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
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet" rel="preload">
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
    <?= NavBarWidget::widget() ?>
</header>

	<main id="main">


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

            <?= $content ?>

	</main>

<?= FooterAddonWidget::widget() ?>

<?= FooterWidget::widget() ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
