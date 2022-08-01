<?php
use backend\assets\AppAsset;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

greeneye\adminlte\AdminlteAsset::register($this);
$adminlteAsset = greeneye\adminlte\AdminlteAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <link href="/css/login-windcloud.css" rel="stylesheet">
    <link href="/css/login/bootstrap.css" rel="stylesheet">
    <link href="/css/login/style.css" rel="stylesheet">
    <link href="/css/login/style-login.css" rel="stylesheet">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="page-template-default startseite">

<?php $this->beginBody() ?>

    <?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
