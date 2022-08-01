<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<script type="text/javascript">
			sessionStorage.clear();
			$(".total-count").html("Warenkorb");
			</script>
    <div class="container">
<div class="content margin-b">
<div class="bg-c-turkis border-radius-d margin-b pad">
	<div id="hero">
		<h1>Einkaufswagen</h1>
		<h2 class="vary">Ihr Warenkorb ist leer.</h2>
	</div>
</div>
</div>
</div>


<?php
$this->registerCssFile("/css/cms/style-cart.css");
?>