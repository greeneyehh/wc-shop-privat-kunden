<?php

$this->title = Yii::$app->name;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

use app\extensions\greendev\weclapp\widgets\variantInfoWidget;

use app\widgets\ArticleImage\ArticleImageWidget;
?>
    <div class="container">
        <div class="d-md-block" id="hero">
            <h2 class="text-center mb-4">
                <?php if($slug == "vps"){
                    echo "VPS KONFIGURATOR";
                }elseif ($slug == "managed-nextcloud"){
                    echo "Nextcloud KONFIGURATOR";
                }
                ?></h2>
        </div>
        <div style="text-align: center;">
            <?php
                if($slug == "vps"){
                    echo "<strong class='vary mb-0 text-center'>Für den Betrieb eines Cloudron Systems ist eine Domäne zwingend erforderlich</strong>";
                }
            ?>
        </div>
        <div id="wizard">

            <?php foreach ($model['result'] as $products): ?>
                <div class="card">
                    <div class="card-header border-radius-d cart-card-addon" style="text-align: center;">
                        <h3 class="vary">
                            <?php if($slug == "vps"){
                                echo "BETRIEBSSYSTEM";
                            }elseif ($slug == "managed-nextcloud"){
                                echo "LAUFZEIT";
                            }
                            ?>
                        </h3>
                        <?php if($slug == "managed-nextcloud"){
                            echo "<h1>Wählen Sie Ihre Laufzeit.</h1>";
                        }
                        ?>
                    </div>
                    <div class="card-body row justify-content-md-center" id="variants">


                        <?php foreach ($products['variants'] as $productsid):
                            if($slug == "vps"){
                                ?>
                                <?php $variant= json_decode(variantInfoWidget::widget(['id' => $productsid['articleId']]),true);
                                if(!isset($variant['shortDescription2']))
                                {
                                    array_push($variant, "shortDescription2");
                                    $variant['shortDescription2'] = null;
                                }else{
                                    $letters = array('Jährlich für ', 'Monatlich für ');
                                    $output  = str_replace($letters, '', $variant['shortDescription2']);
                                }
                                $icon= null;
                                if(preg_match("/Windows/",$variant['longText'])){
                                    $icon ='Windows';
                                }elseif (preg_match("/Linux/",$variant['longText'])){
                                    $icon ='Linux';
                                }elseif (preg_match("/Cloudron/",$variant['longText'])){
                                    $icon ='Cloudron';
                                }

                                ?>

                                <div class="col-12 col-md-6 col-lg-4 mb-4 " >
                                    <div class="border-radius-d box-shadow p-3 justify-content-md-center" style="text-align:center;background-color: #ffffff;height: 100%;">
                                        <div class="textwizard"><h3 class="vary" style="text-align: center;"><?=$icon;?></h3>
                                            <?= ArticleImageWidget::widget(['id' =>$variant['id'],'articleImageId'=>array($variant['articleImages'])]); ?>
                                        </div>
                                        <p class="price"> <?=$variant['articlePrices']['0']['price'];?> €</p>
                                        <div class="product-price-brutto justify-content-md-center" style="font-size: 1rem">
                                            <?php print_r($variant['articlePrices']['0']['price'] + $variant['articlePrices']['0']['price']*Yii::$app->params['STEUERSATZ']  );?> € inkl. <?= Yii::$app->params['STEUERSATZTEXT'];?> MwSt.
                                            <?= Html::submitButton('auswählen',
                                                ['style'=>'vertical-align: bottom; width: 100%;',
                                                    'class' => 'border mobile-fill anim-1 btn-ajax-modal show step-two',
                                                    'id' => 'button-'.$variant['id'] ,'name' => 'productid-'.$variant['id'] ,
                                                    'data-id'=>$variant['id'],'data-name'=>$variant['name'], 'data-DomainExtension'=>'' ,'data-option'=>[],
                                                    'data-weclapp' => '1' ,'data-price' =>$variant['articlePrices']['0']['price'] ,
                                                    'data-extensionAllowed'=> ($variant['shortDescription1'] == 'addon') ? '1' : '0','data-slug'=>$slug]);
                                            ?>
                                        </div>
                                    </div>
                                </div>

                            <?php  }elseif ($slug == "managed-nextcloud"){?>
                                <?php $variant= json_decode(variantInfoWidget::widget(['id' => $productsid['articleId']]),true);
                                if(!isset($variant['shortDescription2']))
                                {
                                    array_push($variant, "shortDescription2");
                                    $variant['shortDescription2'] = null;
                                }else{
                                    $letters = array('Jährlich für ', 'Monatlich für ');
                                    $output  = str_replace($letters, '', $variant['shortDescription2']);
                                }
                                ?>
                                <div class="col-12 col-md-6 col-lg-4 mb-4 " >
                                    <div class="border-radius-d box-shadow p-3 justify-content-md-center" style="text-align:center;background-color: #ffffff;height: 100%;">
                                        <div class="textwizard"><?=$variant['longText']?>
                                        </div>
                                        <p class="price"> <?= number_format($variant['articlePrices']['0']['price'], 2, '.', '');?> €</p>
                                        <div class="product-price-brutto justify-content-md-center" style="font-size: 1rem">
                                            <?php print_r(number_format($variant['articlePrices']['0']['price'] + $variant['articlePrices']['0']['price']*Yii::$app->params['STEUERSATZ'], 2, '.', '')  );?> € inkl. <?= Yii::$app->params['STEUERSATZTEXT'];?> MwSt.
                                            <?= Html::submitButton('auswählen',
                                                ['style'=>'vertical-align: bottom; width: 100%;',
                                                    'class' => 'border mobile-fill anim-1 btn-ajax-modal show step-two',
                                                    'id' => 'button-'.$variant['id'] ,'name' => 'productid-'.$variant['id'] ,
                                                    'data-id'=>$variant['id'],'data-name'=>$variant['name'], 'data-DomainExtension'=>'' ,'data-option'=>[],
                                                    'data-weclapp' => '1' ,'data-price' =>$variant['articlePrices']['0']['price'] ,
                                                    'data-extensionAllowed'=> ($variant['shortDescription1'] == 'addon') ? '1' : '0','data-slug'=>$slug]);
                                            ?>
                                        </div>
                                    </div>
                                </div>


                            <?php }
                        endforeach; ?>


                    </div>
                </div>

            <?php  endforeach; ?>

        </div>


    </div>
    </div>


<?php
$this->registerJs("
$('.step-two').click(function(event) {
	var produktdata ={};
	var array= $(this).data();
	for (var prop in array) {
		produktdata[prop]= array[prop];
	}
    $.ajax({
      type: 'POST',
      url: '/wizard/step-two',
      data:  produktdata,
      success: function (response) {
      location.href = '#variants';
      $('#steptwo').remove();
      $('#stepthree').remove();
      $('#stepfour').remove();
      $('#stepfive').remove();
      $('#wizard').append(response);
      location.href = '#steptwo';
      location.href = '#stepfour';
      
      },
      error: function(error) {
        console.log(error)
        alert('Data not saved');
      }
    });
    
    
});");
?>





<?php
$this->registerCssFile("/css/cms/wizard.css");
?>
