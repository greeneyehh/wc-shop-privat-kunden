<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>

<div class="container">
<div class="hero" id="hero">
    <h2>Zahlung</h2>
</div>
<script>
    var wpwlOptions = {
        locale: "de",
        registrations: {
            hideInitialPaymentForms: false,
            requireCvv: false
        }
    }

</script>
    <?php
    // print_r(json_encode($responseData));
   // die();
    ?>


<script async src="<?=$Url;?>/v1/paymentWidgets.js?checkoutId=<?=$responseData["id"];?>"></script>
<form action="<?=$ReturnUrl;?>?brand=<?=$entityId;?>" class="paymentWidgets" data-brands="<?=$brand;?>"></form>
</div>


