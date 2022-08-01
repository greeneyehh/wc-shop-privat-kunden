<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

?>
    <div class="container">
<div id="hero" class="title">
    <h1>Kundeninformationen</h1>
</div>
<div class="content margin-b">
    <?= $CustomerInformation->description;?>
</div>
</div>

<?php
$this->registerCssFile("/css/cms/style-kundeninformationen.css");
?>