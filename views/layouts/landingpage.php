<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
//AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="https://fonts.googleapis.com/css?family=Arimo" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Alfa+Slab+One" rel="stylesheet">
    <link rel="stylesheet" href="<?= Url::to('@web/landingpage/bootstrap/css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?= Url::to('@web/landingpage/css/styles.css');?>">
    <script src="<?= Url::to('@web/landingpage/bootstrap/js/bootstrap.min.js');?>"></script>
</head>
<body style="border-color: #004477;background: #004477;color: #ffffff;">
<?php $this->beginBody() ?>
     <?= $content ?>

<footer style="position: relative;z-index:4">
<img src="<?= Url::to('@web/image/landingpage/bottom.png');?>" style="width: 100%;">
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
