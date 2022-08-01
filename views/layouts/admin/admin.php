<?php
use yii\helpers\Html;
if (Yii::$app->controller->action->id === 'login') { 
echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\DashboardAsset::register($this);
    } else {
        app\assets\DashboardAsset::register($this);
    }

    greeneye\adminlte\AdminlteAsset::register($this);
    $adminlteAsset = greeneye\adminlte\AdminlteAsset::register($this);


    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="/js/iban.js"></script>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <link rel="icon" href="/image/favicon-16x16.png" sizes="16x16">
<link rel="icon" href="/image/favicon-24x24.png" sizes="24x24">
<link rel="icon" href="/image/favicon-32x32.png" sizes="32x32">
<link rel="icon" href="/image/favicon-64x64.png" sizes="64x64">
<link rel="icon" href="/image/favicon-96x96.png" sizes="96x96">
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>

        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset]
        )
        ?>

        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>

    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>









