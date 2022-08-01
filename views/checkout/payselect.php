<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<div class="container">
<div class="hero" id="hero">
    <h2>Bitte wählen Sie eine Zahlungsart aus</h2>
</div>

<div class="features-boxed">
    <div class="container">
        <?php $form = ActiveForm::begin([
            'action' => ['checkout/payment']
        ]); ?>

        <div class="row justify-content-center features">

        <?php foreach ($vrpaybrands as $brands ): ?>


            <div class="col-sm-6 col-md-5 col-lg-3 item">
                <div class="box">
                    <a id="tipp" href="/checkout/payment?entityId=<?=$brands['entityId'];?>&brand=<?=$brands['name'];?>" lang="en" hreflang="de">  <img src="/image/payment-icons/<?=$brands['image'];?>" size="80px"></a>
                    </i>
                </div>
            </div>


        <?php  endforeach; ?>



            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
</div>
