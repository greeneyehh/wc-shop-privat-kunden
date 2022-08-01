<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
$gesamtpreis = null;
?>
<div class="container">
<div class="panel-heading headline">
                <h3 class="panel-title">Warenkorb</h3>
          </div>
    <div class="table-scrollable">

<table class="table table-striped table-bordered table-list">
<thead>
<tr>
<th>Produkt</th>
<th>Domain / OS</th>
<th>Erweiterung</th>
<th>Preis</th>
<th></th>
</tr> 
</thead>
	<tbody>
       	<?php foreach ($cart as $position => $cartone): ?>
        <?php if($cartone['type'] ==1){ ?>

				<tr>
                    <td class="text-center align-middle" style="font-weight: bold;"><?=$cartone['name'];?></td>
                    <td class="text-center align-middle">
                        <?php
                        if ($cartone['domainextension'] ==null OR empty($cartone['domainextension'])) {
                            if(preg_match("/Start/",$cartone['name'])){
                                echo '<span class="input-group-text">next.windcloud.de</span>';
                            }else{
                                if(!empty($cartone['option'])){
                                    foreach ($cartone['option'] as $key => $option):
                                    if($option['name']=="Custom Domain") {
                                        echo '<span class="input-group-text">'. $option['domainextension'].'</span>';
                                    }
                                      endforeach;
                                }else{
                                    $form = ActiveForm::begin(['method' => 'post','action' => ['domain'] ,'enableAjaxValidation'=>true,'validationUrl' => ['cart/ajax-validation'],
                                        'enableClientValidation'=>true]);
                                    echo $form->field($model, 'arryid')->hiddenInput(['value'=> $position])->label(false);
                                    echo $form->field($model,'DomainExtension', ['template' => '{beginLabel}{labelTitle}{endLabel}<div class="input-group">{input}<span class="input-group-text">.windcloud.de</span></div>{error}{hint}'
                                    ])->label(false)->textInput(['class'=>'form-control inputDomainExtension','placeholder' => "Ihre Wunschdomain"]);
                                    ActiveForm::end();
                                }
                            }
                        } else {
                            $form = ActiveForm::begin(['enableClientValidation' => true,'method'=>'post','action' => ['cart/domain-clear']]);
                                echo $form->field($model, 'arryid')->hiddenInput(['value'=> $position])->label(false);
                                echo '<span class="input-group-text float-left">'.$cartone['domainextension'].'</span>';
                                echo Html::submitButton('<span class="fa fa-pencil  float-left"></span>', ['title' => 'Edit', 'class' => 'btn float-right']);
                            ActiveForm::end();
                        } ?>
                    </td>
                    <td class="text-center align-middle">
                    <?php
                        if(isset($cartone['option'])){
                        foreach ($cartone['option'] as $key => $option): ?>
                        <span class="input-group-text"> <?=$option['name'];?>
                        <?php $form = ActiveForm::begin([
                            'enableClientValidation' => true,
                            'method'=>'post',
                            'action' => \yii\helpers\Url::to(['cart/addon-delete/', 'id' => $position,'key'=>$key]),
                        ]); ?>
                        <?= Html::submitButton('<span class="fa fa-trash-o"></span>', ['title' => 'Löschen', 'class' => 'btn del-to-cart' , 'id'=>'del-to-cart','style'=>'width:35px']); ?>
                        <?php ActiveForm::end(); ?></span>
                    <?php $cartone['price'] += $option['price'];

                    endforeach;
                        }
                           ?>
                    </td>
                    <td class="text-center align-middle">
                        	<?=$cartone['price'];?> €
                        <?php $gesamtpreis += $cartone['price'];?>
                        </td>
                    <td class="text-center align-middle">
                        	<?php $form = ActiveForm::begin([
				                'enableClientValidation' => true,
				                'method'=>'post',
				                'action' => ['cart/delete/'.$position],
				            ]); ?>
                            <?= Html::submitButton('<span class="fa fa-trash-o"></span>', ['title' => 'Löschen', 'class' => 'btn del-to-cart' , 'id'=>'del-to-cart']); ?>
                        	 <?php ActiveForm::end(); ?>
                    </td>
				</tr>



            <?php }elseif ($cartone['type'] ==2) {?>
                <tr>
                    <td class="text-center align-middle"><?=$cartone['name'];?></td>
                    <td class="text-center align-middle">
                        <?=$cartone['domainextension'];?>
                    </td>
                    <td class="text-center align-middle">Addon</td>
                    <td class="text-center align-middle">
                        <?= number_format($cartone['price'], 2, '.', '');?> €
                        <?php $gesamtpreis += $cartone['price'];?>
                    </td>
                    <td class="text-center align-middle">
                        <?php $form = ActiveForm::begin([
                            'enableClientValidation' => true,
                            'method'=>'post',
                            'action' => ['cart/delete/'.$position],
                        ]); ?>
                        <?= Html::submitButton('<span class="fa fa-trash-o"></span>', ['title' => 'Löschen', 'class' => 'btn del-to-cart' , 'id'=>'del-to-cart']); ?>

                        <?php ActiveForm::end(); ?>
                    </td>
                </tr>

				<?php }elseif ($cartone['type'] ==3) {?>
                <tr>
                    <td class="text-center align-middle"><?=$cartone['name'];?></td>
                    <td class="text-center align-middle">
                        <?php
//                            $form = ActiveForm::begin(['method' => 'post','action' => ['os'] ,'enableAjaxValidation'=>true,'validationUrl' => ['cart/ajax-validation'],
//                                'enableClientValidation'=>true]);
//                        echo $form->field($modelos, 'arryid')->hiddenInput(['value'=> $position])->label(false);
//                     echo $form->field($modelos, 'OSSystem')->dropDownList($osarray, [ 'class' => 'form-control border','onchange'=>'this.form.submit()'])->label(false);
                            //ActiveForm::end();
                        ?>
                        <?php
                        if(isset($cartone['option'])){
                        foreach ($cartone['option'] as $key => $option):
                            if(isset($option['os']) && $option['os']==true) { ?>
                             <span class="input-group-text"> <?=$option['name'];?>
                            <?php $cartone['price'] += $option['price'];
                             }
                        endforeach;
                        }?>

                    </td>
                    <td class="text-center align-middle">
                    <?php
                        if(isset($cartone['option'])){
                            foreach ($cartone['option'] as $key => $option):
                             if(!isset($option['os'])) { ?>
                        <span class="input-group-text"> <?=$option['name'];?>
                        <?php $form = ActiveForm::begin([
                            'enableClientValidation' => true,
                            'method'=>'post',
                            'action' => \yii\helpers\Url::to(['cart/addon-delete/', 'id' => $position,'key'=>$key]),
                        ]); ?>
                        <?= Html::submitButton('<span class="fa fa-trash-o"></span>', ['title' => 'Löschen', 'class' => 'btn del-to-cart' , 'id'=>'del-to-cart','style'=>'width:35px']); ?>
                        <?php ActiveForm::end(); ?></span>
                    <?php $cartone['price'] += $option['price'];
                             }
                    endforeach;
                        }?>



                    </td>
                    <td class="text-center align-middle">
                        <?= number_format($cartone['price'], 2, '.', '');?> €
                        <?php $gesamtpreis += $cartone['price'];?>
                    </td>
                    <td class="text-center align-middle">
                        <?php $form = ActiveForm::begin([
                            'enableClientValidation' => true,
                            'method'=>'post',
                            'action' => ['cart/delete/'.$position],
                        ]); ?>
                        <?= Html::submitButton('<span class="fa fa-trash-o"></span>', ['title' => 'Löschen', 'class' => 'btn del-to-cart' , 'id'=>'del-to-cart']); ?>

                        <?php ActiveForm::end(); ?>
                    </td>
                </tr>
            <?php } ?>
       <?php  endforeach; ?>
  </tbody>
</table>
        <p class="infobox help-block help-block-error has-error">Bitte tragen Sie noch Ihre Wunschdomain ins obere Feld ein, um die Bestellung fortzusetzen!</p>
    </div>
<div class="row">
    <div class="col-8"></div>
    <div class="col-4">
        <table style="width:100%">
            <tr>
                <td style="color: #004477;font-weight: bold;">Bestellwert: </td>
                <td style="color: #004477;font-weight: bold;"><?= number_format($gesamtpreis, 2, '.', '');?> €</td>
            </tr>
            <tr style="border-top: 1px solid white;">
                <td style="color: #004477;">Gesamtsumme:<br>
                    (inkl. MwSt.)</td>
                <td style="color: #004477;"><?= number_format($gesamtpreis + $gesamtpreis *Yii::$app->params['STEUERSATZ'] , 2, '.', '');?> €</td>
            </tr>
        </table>



    </div>
</div>
<p></p>
            <div class="row">
              <div class="col col-xs-6">
                <a href="/cart/clear" class="border mobile-fill anim-1 show" >Warenkorb leeren</a>
              </div>
              <div class="col col-xs-6 text-right">
              <?php $form = ActiveForm::begin(['method'=>'post','action' => ['checkout/confirm']]); ?>
                <?= Html::submitButton('Zur Kasse gehen', ['title' => 'Zur Kasse gehen', 'class' => 'border mobile-fill anim-1 show','disabled'=>1, 'id'=> 'submitButton']); ?>
                <?php ActiveForm::end(); ?>
              </div>
            </div>

    <div class="shadow-line" style="height: 70px"></div>

    <div class="bg-white border-radius-d box-shadow">

        <div class="row align-items-center">
            <div class="logo col-3 col-md-2 mx-auto">
                <h5 class="vary">Zahlungsmöglichkeiten</h5>
            </div>
		
		    <?php foreach ($vrpaybrands as $brand):?>
			<div class="logo col-2 col-md-1 mx-auto"><?=$brand?></div>
		    <?php  endforeach; ?>
		<div class="logo col-2 col-md-1 mx-auto"><img src="/image/payment-icons/sepa.png" size="90px" style="width: 90px;"></div>
 	
        </div>
    </div>
	  <span style="font-size: 12px">* Für einen SEPA Zahlung verfahren müssen sie eine erstmal Zahlung mit einer der anderen Zahlungsarten durchführen ist das geschehen nehmen Sie bitte Kontakt mit uns auf</span>
	
	<p>
	
	<div class="modal fade " id="addon-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" >
        <div class="modal-dialog modal-xl" style="background-color: #f6f6f6;" role="document">
            <div class="modal-content" style="background-color: #f6f6f6!important;border-radius: 0!important;" >
                <div class="modal-header" style="border-bottom:0!important;">
                    <h3 class="vary" id="exampleModalLongTitle" style="text-align: center;width: 100%;padding-left: 10%;">ADDON WÄHLEN</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="text-align: center;width: 10%;height: 100%;background-color: transparent !important">
                        <span aria-hidden="true" style="font-size: 3rem;">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body-loader">

                </div>
            </div>
        </div>
    </div>


</div>

<?php
function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }

    return false;
}
?>




<?php
$this->registerJs(
    "function myFunction() {
    var x = document.getElementById(\"sometext\");
    x.value = x.value.toUpperCase();
    }  
    var buttondissabledcount = 0;
    var buttondissabledinput = 0;
        function checkemtybutton(){
               $('input.inputDomainExtension').each(function( index ) {
                    if($(this).val() ==''){
                        buttondissabledcount++;
                    }
                }); 
                buttondissabledinput++;
        }
     $('input.inputDomainExtension').blur(function() {
            checkemtybutton();
     });
     checkemtybutton();
     if(buttondissabledcount == 0 && buttondissabledinput !=0){
            $('#submitButton').removeAttr('disabled');
            $('.infobox').hide();
     }
    var submitButton = document.getElementById('submitButton');


              submitButton.onclick = function() {
                console.log(\"in onclick\");
              };
              
             	$('.total-count').html('<span class=\"fa fa-shopping-basket\"></span><span class=\"cartcount\">'+ sessionStorage.getItem('shoppingCart')+'</span>');
              "

);
?>
<?php
$this->registerJs("$('.btn-ajax-modal').click(function (){
    $('#modal-body-loader' ).html( '<div class=\"row\"><div class=\"col-12\"><div class=\"overlay loadingcolor\"><i class=\"fa fa-refresh fa-spin fa-3x fa-fw loadingcolor\"></i></div></div></div>' );
    var elm = $(this),
        target = elm.attr('data-target'),
        ajax_body = elm.attr('value');

    $(target).modal('show')
    .find('.modal-body')
    .load(ajax_body);
        
});");
?>
<?php
$this->registerCssFile("/css/cms/style-cart.css");
?>
