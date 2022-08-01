<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

?>
<div class="panel-heading headline">
            <div class="row">
              <div class="col col-xs-6">
                <h3 class="panel-title">Warenkorb <i class="fa fa-shopping-basket"></i></h3>
              </div>
              <div class="col col-xs-6 text-right">
              </div>
            </div>
          </div>

<table class="table table-striped table-bordered table-list">
<thead>
<tr>
<th>Name</th>
<th>Domain</th>
<th>Addon</th>
<th>Preis</th>

</tr> 
</thead>
	<tbody>
       	<?php foreach ($cart as $position => $cartone): ?>

				<tr><td class="text-center align-middle"><?=$cartone['name'];?></td>
<td class="text-center align-middle">
	<?php
	if ($cartone['domainextension'] ==null) {
	 if($cartone['name'] =="Start"){
         echo '<span class="input-group-text">next.windcloud.de</span>';
     }else{
	     $form = ActiveForm::begin(['method' => 'post','action' => ['domain'] ,'enableAjaxValidation'=>true,'validationUrl' => ['cart/ajax-validation'],
         'enableClientValidation'=>false]);
         echo $form->field($model, 'arryid')->hiddenInput(['value'=> $position])->label(false);
         echo $form->field($model,'DomainExtension', ['template' => '{beginLabel}{labelTitle}{endLabel}<div class="input-group">{input}<span class="input-group-text">.windcloud.de</span><button type="submit" class="btn-clear"><span class="fa fa-save"></span></button></div>{error}{hint}'
         ])->label(false)->textInput(['class'=>'form-control','placeholder' => "Ihre Wunschdomain"]);
         ActiveForm::end();
     }


	} else {
		$form = ActiveForm::begin(['enableClientValidation' => true,'method'=>'post','action' => ['cart/domain-clear']]);
			echo $form->field($model, 'arryid')->hiddenInput(['value'=> $position])->label(false);
			echo $cartone['domainextension'];
			echo Html::submitButton('<span class="fa fa-pencil"></span>', ['title' => 'Edit', 'class' => 'btn-clear']);
		ActiveForm::end();
	} ?>


 </td>

                        <td class="text-center align-middle">
                        	<?php
                        	$HDDExtension =$cartone['extensionallowed'];
                        	if($HDDExtension){
                        	if(array_key_exists('addon', $cartone)) {

								if($cartone['addon']== 0 ){
                                    if($cartone['name'] =="Start") {
                                        $select = 'User Erweiternung';
                                    }else{
                                        $select = 'keine Speicherplatz erweiternung';
                                    }
								}else{
                                    if($cartone['name'] =="Start") {
                                        $select = $cartone['addon'].' User';
                                    }else{
                                        $select = $cartone['addon'].' TB';
                                    }
								}
							}else{
                                if($cartone['name'] =="Start") {
                                    $select = 'User Erweiternung';
                                }else{
                                    $select = 'keine Speicherplatz erweiternung';
                                }
                        	}
                                if($cartone['name'] =="Start") {
                                   echo 'test';
                                }else{
                        	    $form = ActiveForm::begin(['enableClientValidation' => true,'method'=>'post','action' => ['cart/addon']]);
								echo $form->field($model, 'productid')->hiddenInput(['value'=> $cartone['id']])->label(false);
								echo $form->field($model, 'arryid')->hiddenInput(['value'=> $position])->label(false);
                        		echo $form->field($model, 'HDDExtension', ['template' => '{beginLabel}{labelTitle}{endLabel}<div class="input-group">{input}<button type="submit" class="btn-clear"><span class="fa fa-save"></span></button></div>{error}{hint}'])->dropDownList($items, ['prompt'=>$select,'class'=>'site-addon-select js-example-basic-single',])->label(false);
								ActiveForm::end();
                                }
                        	}else{

	                        	echo "keine Erweiterung";
                        	}?>
                        	</td>
                        <td class="text-center align-middle">
                        	<?=$cartone['price'];?> €
                        </td>

                        <td class="text-center align-middle">
                        	<?php $form = ActiveForm::begin([
				                'enableClientValidation' => true,
				                'method'=>'post',
				                'action' => ['cart/delete/'.$position],
				            ]); ?>
                        	<?= Html::submitButton('<span class="fa fa-times-circle"></span>', ['title' => 'Löschen', 'class' => 'btn-clear']); ?>
                        	 <?php ActiveForm::end(); ?>
						</td>
				</tr>
       <?php  endforeach; ?>
  </tbody>
<tfoot>
   	<tr>
<th>Name</th>
<th>Domain</th>
<th>Addon</th>
<th>Preis</th>

</tr> 
</tfoot>
</table>

            <div class="row">
              <div class="col col-xs-6">
                <a href="/cart/clear" class="empty-cart borderred mobile-fill" >Warenkorb Leeren</a>
              </div>
              <div class="col col-xs-6 text-right">
              <?php $form = ActiveForm::begin(['method'=>'post','action' => ['checkout/confirm']]); ?>
                <?= Html::submitButton('Zur Kasse gehen', ['title' => 'Zur Kasse gehen', 'class' => 'bordercart mobile-fill']); ?>
                <?php ActiveForm::end(); ?>
              </div>
            </div>

<img class="shadow-line" src="/img/schatten.png">





<?php
$this->registerJs(
    "function myFunction() {
    var x = document.getElementById(\"sometext\");
    x.value = x.value.toUpperCase();
    }"

);
?>