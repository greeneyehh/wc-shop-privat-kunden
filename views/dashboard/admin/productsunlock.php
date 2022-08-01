<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

?>
<div class="card card-primary" style="width:60%;margin: auto;margin-top: 100px;">
    <div class="card-header box-header-windcloud">
        <h3 class="card-title"><i class="fa fa-user-o" aria-hidden="true"></i> Produktzuordnung </h3>
    </div>
    <div class="card-body">


<div class="row" style="margin-bottom: 50px;">

    <div class="col-6">

        <div class="row">
            <div class="col-12"><h4>Firmendaten</h4></div>
            <div class="col-6">Frimenname:</div>
            <div class="col-6"><?= $CustomerData['shipping_company'];?></div>
            <div class="col-6">Straße und Nr.:</div>
            <div class="col-6"><?= $CustomerData['billing_street'];?></div>
            <div class="col-6">Postleitzahl: </div>
            <div class="col-6"><?= $CustomerData['billing_zipcode'];?></div>
            <div class="col-6">Stadt: </div>
            <div class="col-6"><?= $CustomerData['billing_city'];?></div>
            <div class="col-6">Land: </div>
            <div class="col-6"><?= $CustomerData['billing_country'];?></div>
            <div class="col-12" style="padding-top: 50px;"><h4>Ansprechpatner</h4></div>
            <div class="col-6">Anrede:</div>
            <div class="col-6"><?= $CustomerData['personal_salutation'];?></div>
            <div class="col-6">Nachname:</div>
            <div class="col-6"><?= $CustomerData['personal_lastname'];?></div>
            <div class="col-6">Vorname:</div>
            <div class="col-6"><?= $CustomerData['personal_firstname'];?></div>
            <div class="col-6">E-mail:</div>
            <div class="col-6"><?= $CustomerData['personal_email'];?></div>
            <div class="col-6">Telefonnummer:</div>
            <div class="col-6"><?= $CustomerData['personal_phone'];?></div>

            <div class="col-12" style="padding-top: 50px;"><h4>Nextcloud Daten</h4></div>
            <div class="col-6">Benutzernamen:</div>
            <div class="col-6"><?= $username;?></div>
            <div class="col-6">initialpasswort.:</div>
            <div class="col-6"><?= $CustomerOrder['initialpasswort'];?></div>
            <div class="col-6">domain: </div>
            <div class="col-6"><?= $CustomerOrder['domain'];?></div>


        </div>


    </div>
    <div class="col-6">
<div class="row">
    <div class="col-2"></div>
        <div class="col-8 product-item">
            <div class="product-container">
                <div class="row">
                    <div class="col-md-12">
                        <a href="#" class="product-image"><img src="<?= Url::to('@web/image/Nextcloud_Logo.svg.png');?>" alt="product-image"/></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12"><h2><?=$articlepaycycle['name']?></h2></div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <?=$articlepaycycle['description'];?>
                        <div class="row">
                            <div class="col-xs-12">
                                <text class="product-price" style="font-weight: bold;color: #3e444c;"><?php print_r($articlepaycycle['articlePrices']['0']['price']);?>  € / <?=($articlepaycycle['shortDescription2'] == 'Jahr') ? 'Jahr': 'Monat' ?></text>
                            </div>
                            <div class="col-xs-12">
                                <text class="product-price-brutto" style="font-size: 1rem"><?php print_r($articlepaycycle['articlePrices']['0']['price'] + $articlepaycycle['articlePrices']['0']['price']*0.19 );?> € inkl. 19% MwSt.</text>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="col-2"></div>
</div>
    </div>
</div>


        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($CustomerOrder, 'active')->dropDownList(['0' => 'deaktivieren', '1' => 'aktivieren'])->label(false); ?>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-sm-6">
                <?= Html::submitButton('Speichern', ['class' => 'btn btn-primary']) ?>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="col-sm-6">


            </div>
        </div>
    </div>
</div>