
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
            style: "card",
            locale: "de",
            registrations: {
                hideInitialPaymentForms: false,
                requireCvv: false
            }
        }

    </script>



    <style>
    .wpwl-label-brand, .wpwl-wrapper-brand, .wpwl-wrapper-registration-registrationId, .wpwl-wrapper-registration-brand, .wpwl-wrapper-registration-number, .wpwl-wrapper-registration-expiry {
    display: none;
    }
    .wpwl-form .wpwl-form-card .wpwl-clearfix input::placeholder {
        color: #fff !important;
        opacity: .5;
    }
    .wpwl-control .wpwl-control-cardHolder input::placeholder {
        color: #fff !important;
        opacity: .5;
    }
    </style>
    <script async src="<?=$Url;?>/v1/paymentWidgets.js?checkoutId=<?=$model["id"];?>"></script>
    <form action="<?=$ReturnUrl;?>?data=<?=$data;?>" class="paymentWidgets" data-brands="VISA"></form>
</div>

