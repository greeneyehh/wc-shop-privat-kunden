<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>

<div class="container" id="div1">
    <br>
    <p class="info" ></p>
    <div class="row"></div>
    <div class="bg-c-white border-radius-d margin-b pad">
    <div class="loader">
        <img height="500px" src="<?= Url::to('@web/image/Windcloud-Turmplatte01.gif');?>" alt="loader">
    </div>
    <div class="blink_me vary"><strong>Ihre Daten werden verarbeitet</strong></div>
    <p class="info" ></p>
    <br>
    </div>
</div>
<?php
$this->registerCssFile("/css/cms/style-waiting.css");
?>
<?php
$this->registerJs("
const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
var data =urlParams.get('data');
var resourcePath = urlParams.get('resourcePath');
setTimeout(() => { 
$.ajax({url: '/ajax/ajax-development-payment?data='+data+'&resourcePath='+resourcePath, success: function(result){
$('#div1').html(result);
}});
}, 2000);
");
?>