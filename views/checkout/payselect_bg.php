<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<div class="hero" id="hero">
    <h2>Bitte wählen Sie eine Zahlungsart aus</h2>
</div>

<div class="features-boxed">
    <div class="container">
        <?php $form = ActiveForm::begin([
            'action' => ['checkout/payment']
        ]); ?>

        <div class="row justify-content-center features">
            <div class="col-sm-6 col-md-5 col-lg-3 item">
                <div class="box">
                    <a id="tipp" href="/checkout/payment?brand=PAYPAL" lang="en" hreflang="de"><img src="/image/payment-icons/paypal-alternative2.png"></a>
                    </i>
                </div>
            </div>
            <div class="col-sm-6 col-md-5 col-lg-3 item">
                <div class="box">
                    <a id="tipp" href="/checkout/payment?brand=GIROPAY" lang="en" hreflang="de"><img src="/image/payment-icons/giropay.png"></a>
                    </i>
                </div>
            </div>
            <div class="col-sm-6 col-md-5 col-lg-3 item">
                <div class="box">
                    <a id="tipp" href="/checkout/payment?brand=SOFORTUEBERWEISUNG" lang="en" hreflang="de"> <img src="/image/payment-icons/klarna-sofort.png"></a>
                    </i>
                </div>
            </div>
            <div class="col-sm-6 col-md-5 col-lg-3 item">
                <div class="box">
                    <a id="tipp" href="/checkout/payment?brand=VISA" lang="en" hreflang="de"> <img src="/image/payment-icons/visa.png"></a>
                    </i>
                </div>
            </div>
            <div class="col-sm-6 col-md-5 col-lg-3 item">
                <div class="box">
                    <a id="tipp" href="/checkout/payment?brand=MASTER" lang="en" hreflang="de">  <img src="/image/payment-icons/mastercard.png"></a>
                    </i>
                </div>
            </div>
            <div class="col-sm-6 col-md-5 col-lg-3 item">
                <div class="box">
                    <a id="tipp" href="/checkout/payment?brand=PAYDIREKT" lang="en" hreflang="de"> <img src="/image/payment-icons/paydirekt.png"></a>
                    </i>
                </div>
            </div>
            <div class="col-sm-6 col-md-5 col-lg-3 item">
                <div class="box">
                    <a id="tipp" href="/checkout/payment?brand=DIRECTDEBIT_SEPA" lang="en" hreflang="de"> <img src="/image/payment-icons/sepa.png"></a>
                    </i>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
