<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use app\module\CartModal\CartModalWidget;
?>
<div class="site-index">
    <div class="body-content">

        <p class="pad">
            default
        </p>
        <img class="shadow-line" src="<?= Url::to('@web/img/schatten.png');?>">
        <div class="row">
            <?php foreach ($model['result'] as $products): ?>

            <?php
                    if(!in_array("shortDescription1", $model['result']))
                    {
                        $products['shortDescription1']= 0;
                    }
                ?>

                <div class="col-lg-3 col-sm-6 product-item">
                    <div class="product-container">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="#" class="product-image"><img src="<?= Url::to('@web/image/Nextcloud_Logo.svg.png');?>" /></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12"><h2><?=$products['name']?></h2></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <p class="product-description"><?=$products['description'];?></p>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <p class="product-price"><?=($products['shortDescription1'] == 'addon') ? 'ab': '' ?> <?php print_r($products['articlePrices']['0']['price']);?>  € / Monat</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <?= Html::submitButton('In den Warenkorb', ['class' => 'border mobile-fill add-to-cart order-btn border-btn', 'id' => 'button-'.$products['id'] ,'name' => 'productid-'.$products['id'] ,'data-id'=>$products['id'],'data-name'=>$products['name'] ,'data-weclapp' => 'true' ,'data-price' =>$products['articlePrices']['0']['price'] , 'data-addonallowed'=> ($products['shortDescription1'] == 'addon') ? '1' : '0']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>







            <?php  endforeach; ?>
        </div>
        <p></p>
        <img class="shadow-line" src="<?= Url::to('@web/img/schatten.png');?>">
    </div>
    <?= CartModalWidget::widget() ?>
</div>


