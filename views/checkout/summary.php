<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
$this -> title = 'Zusammenfassung';
?>
<div class="container">
<div class="hero" id="hero">
<h2>Zusammenfassung</h2>
</div>
<div class="row">
<div class="col-6">
<div class="panel panel-default">
    <div class="panel-body">
    	<div class="row summary">

            <div class="col-6"><span class="pad"><?= $personal_customer_type[$account['personal_customer_type']]; ?></span></div>
    		 <div class="col-6"><span class="pad"><?= $shipping_salutation[$account['personal_salutation']]; ?></span></div>
			<div class="col-6"><span class="pad"><?= $account['personal_firstname']; ?></span></div>
			 <div class="col-6"><span class="pad"><?= $account['personal_lastname']; ?></span></div>
			<div class="col-6"><span class="pad"><?= $account['personal_phone']; ?></span></div>
			<div class="col-6"><span class="pad"><?= $account['personal_email']; ?></span></div>
			<div class="col-6"><span class="pad"><?= $account['billing_street']; ?></span></div>
			<?php if (isset($account['billing_additionalAddressLine1']) && $account['billing_additionalAddressLine1'] != null) {?>
				<div class="col-6"><span class="pad"><?= $account['billing_additionalAddressLine1']; ?></span></div>
			<?php } ?>
			<div class="col-6"><span class="pad"><?= $account['billing_zipcode']; ?></span></div>
			<div class="col-6"><span class="pad"><?= $account['billing_city']; ?></span></div>
			<div class="col-6"><span class="pad"><?= $laender[$account['billing_country']]; ?></span></div>
		   <div class="col-6"><span class="pad"><?= $account['billing_company']; ?></span></div>
		   <?php if (isset($account['billing_department']) && $account['billing_department'] != null) {?>
		   <div class="col-6"><span class="pad"><?= $account['billing_department']; ?></span></div>
		   <?php } ?>
		   <?php if (isset($account['billing_vatId']) && $account['billing_vatId'] != null) {?>
		   <div class="col-6"><span class="pad"><?= $account['billing_vatId']; ?></span></div>
		   <?php } ?>

		   </div>
	</div>
	</div>
</div>
<?php if ($account['billing_shippingAddress'] ==1) {?>

<div class="col-6">
<div class="panel panel-default">
    <div class="panel-body">
    	<div class="row">
    		 <div class="col-6"><span class="pad"><?= $shipping_salutation[$account['shipping_salutation']]; ?></span></div>
    		 <div class="col-6"><span class="pad"><?= $account['shipping_company']; ?></span></div> <div class="col-6"><span class="pad"><?= $account['shipping_department']; ?></span></div>
			<div class="col-6"><span class="pad"><?= $account['shipping_firstname']; ?></span></div> <div class="col-6"><span class="pad"><?= $account['shipping_lastname']; ?></span></div>

			<div class="col-6"><span class="pad"><?= $account['shipping_street']; ?></span></div>
			<?php if (isset($account['shipping_additionalAddressLine1'])) {?>
				<div class="col-6"><span class="pad"><?= $account['shipping_additionalAddressLine1']; ?></span></div>
			<?php } ?>
			<div class="col-6"><span class="pad"><?= $account['shipping_zipcode']; ?></span></div>
			<div class="col-6"><span class="pad"><?= $account['shipping_city']; ?></span></div> <div class="col-6"><span class="pad"><?= $laender[$account['shipping_country']]; ?></span></div>
		</div>
	</div>
	</div>
</div>
<?php } ?>


</div>
<img class="shadow-line" src="/img/schatten.png">
 			<div class="panel panel-default">
   					 <div class="panel-heading">
      				  <h3 class="panel-title">Warenkorb</h3></div>
    					<div class="panel-body">
                            <div class="table-scrollable">
							<table class="table">
							  <thead>
							    <tr>
							      <th scope="col">Name</th>
							      <th scope="col">Domain</th>
							      <th scope="col">Erweiterung</th>
							      <th scope="col" class="right">Grundpreis</th>
							    </tr>
							  </thead>
							  <tbody>
							  	<?php 
							  	$gesamtpreis=null;
							  	foreach ($cart as $position => $cartone): ?> 
							    <tr>
							   
							      <td><?= $cartone['name']; ?></td>
							      <td>
                                      <?php
                                      if ($cartone['domainextension'] == null) {
                                         if($cartone['type'] ==1){
                                             if($cartone['name'] == 'Start' || $cartone['name'] =='Start Basic'|| $cartone['name'] =='Start Erweitert'){
                                                 echo 'https://next.windcloud.de';
                                             }else{
                                                 echo $cartone['domainextension'] = 'https://'.strtolower ($account['personal_lastname']).'-'. strtolower ($account['personal_firstname']).'-'.$cartone['id'].'.windcloud.de';
                                             }
                                         }else{
                                             echo "Keine domain";
                                         }

                                      }else{
                                          echo $cartone['domainextension'] ;
                                      }
                                      ?>

                                      </td>
							      <td>
							      	<?php
										if ($cartone['extensionallowed'] == 1) {
											if (isset($cartone['addon'])) {
												echo $cartone['addon'] . ' TB';
											}
										}
									?>
                                      <?php
                                      if(isset($cartone['option'])){
                                          foreach ($cartone['option'] as $key => $option): ?>
                                              <span class="input-group-text"> <?=$option['name'];?></span><br>
                                              <?php $cartone['price'] += $option['price'];

                                          endforeach;
                                      }

                                      ?>

                                  </td>
							      <td class="righttd"><?= number_format($cartone['price'], 2, ",", "."); ?> €</td>
							     
							    </tr>
							    <?php $gesamtpreis += $cartone['price'];

									endforeach;
 ?>
							  </tbody>
							</table>
                        </div>
							<hr>
							<div class="row">

							<div class="col-md-6 col-sm-6 col-xs-6 left">Gesamt (netto)</div>
							<div class="col-md-6 col-sm-6 col-xs-6 right"><?= number_format($gesamtpreis, 2, ",", "."); ?> €</div>						
							
							<div class="col-md-6 col-sm-6 col-xs-6 left">Umsatzsteuer <?= Yii::$app->params['STEUERSATZTEXT'];?></div>
							<div class="col-md-6 col-sm-6 col-xs-6 right"><?= number_format($steuer = $gesamtpreis / 100 * Yii::$app->params['STEUERSATZVOLL'], 2, ",", "."); ?> €</div>
							
							</div>
							<hr>
							<div class="row">
								<div class="col-md-6 col-sm-6 col-xs-6 left"><span class="sumsummary">Gesamtbetrag</span></div>
								<div class="col-md-6 col-sm-6 col-xs-6 right"><span class="sumsummary"><?= number_format($steuer + $gesamtpreis, 2, ",", "."); ?> €</span></div>
							</div>
	</div>
		<?php $form = ActiveForm::begin(['method' => 'post']); ?>
                <div class="hiddenradio">
                    <h3>Zahlungsmittel wählen</h3>
                    <?= $form->field($PaymentPostModel, 'brand')->inline()->radioList( $vrpaybrands, ['encode' => false],['class'=>'checkbox-tools'])->label(false)?>
                </div>
				<div class="row">
						<div class="col-md-8 col-sm-8 col-xs-8 left agb">Es gelten unsere AGB, die Sie jederzeit hier einsehen können <a title="AGB's" href="/agb" target="_blank">Link zu den AGB's </a> </div>
                </div>
                <div class="row" style="padding-bottom: 60px;">
                    <div class="col-md-6 col-sm-6 col-xs-6 left" >
                        <?= $form->field($PaymentPostModel, 'cart')->hiddenInput(['value'=> json_encode($cart)])->label(false);?>
                        <?= $form->field($PaymentPostModel, 'account')->hiddenInput(['value'=> $account['accountid'] ])->label(false);?>

                        <a href="/cart" class="border mobile-fill anim-1 show">Abbrechen</a>

                    </div>
		                <div class="col-md-6 col-sm-6 col-xs-6 right" >
                            <?= $form->field($PaymentPostModel, 'cart')->hiddenInput(['value'=> json_encode($cart)])->label(false);?>
                            <?= $form->field($PaymentPostModel, 'account')->hiddenInput(['value'=> $account['accountid'] ])->label(false);?>

                           	<?= Html::submitButton('Zahlungspflichtig bestellen', ['class' => 'border mobile-fill anim-1 btn-ajax-modal show', 'name' => 'buy', 'value'=> 'true']) ?>
						</div>

                </div>
		                   
		<?php ActiveForm::end(); ?>	
	</div>

</div>
<?php
$this->registerCssFile("/css/cms/style-summary.css");
?>
