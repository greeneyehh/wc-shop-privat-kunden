<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

?>
    <div class="container">
    <div id="hero" class="title">
        <h1>AGB</h1>
    </div>

<?php foreach ($TermsOfService as $terms): ?>
    <div class="content margin-b">
        <h2> <?= $terms->title;?><h2>

                <?= $terms->description;?>

    </div>
<?php  endforeach; ?>

    </div>
<?php
$this->registerCssFile("/css/cms/style-agb.css");
?>