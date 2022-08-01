<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>





<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- SEARCH FORM -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->

        <!-- Notifications Dropdown Menu -->

        <li class="nav-item">

            <span class="logo-lg">Angemeldet als <?= Yii::$app->user->identity->personal_firstname?> <?= Yii::$app->user->identity->personal_lastname?> ( <?= Yii::$app->user->identity->accountid?> )   <?= Html::a('Logout',['/dashboard/logout'],['data-method' => 'post', 'class' => 'btn bg-navy btn-flat margin']) ?></span>
        </li>
    </ul>
</nav>