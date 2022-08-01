<?php

use yii\helpers\Html;
use app\widgets\ArticleImage\ArticleImageWidget;
?>
<div class="card" id="steptwo">
    <div class="card-header border-radius-d cart-card-addon" style="text-align: center;"><h3 class="vary">DISTRIBUTION</h3></div>
        <div class="card-body row justify-content-md-center" align="center" valign="center">
            <?php foreach ($data as $variant): ?>


                <div class="col-12 col-md-6 col-lg-3 mb-4" >
                    <div class="border-radius-d box-shadow p-3 justify-content-md-center" style="text-align:center;background-color: #ffffff;height: 100%;">
                        <div class="textwizard">
                            <h3 class="vary" style="text-align: center;font-size: 1rem;"><?=$variant['name'];?></h3>
                            <?= ArticleImageWidget::widget(['id' =>$variant['id'],'articleImageId'=>array($variant['articleImages'])]); ?>

                            <?php
                            echo isset($variant['description']) ? $variant['description'] : "";?>
                        </div>

                        <div class="product-price-brutto justify-content-md-center" style="font-size: 1rem">
                           <?= Html::submitButton('auswählen',
                                ['style'=>'vertical-align: bottom; width: 100%;',
                                    'class' => 'border mobile-fill anim-1 btn-ajax-modal show step-three',
                                    'id' => 'button-'.$variant['id'] ,'name' => 'productid-'.$variant['id'] ,
                                    'data-id'=>$variant['id'],'data-name'=>$variant['name'], 'data-DomainExtension'=>'' ,'data-option'=>[],
                                    'data-weclapp' => '1' ,'data-customerid'=>$customerid,'data-customerid'=>$customerid,'data-price' =>$variant['articlePrices']['0']['price']]);
                            ?>
                        </div>
                    </div>
                </div>



            <?php endforeach; ?>
        </div>
</div>


<?php

$this->registerJs("
$('.step-three').click(function(event) {
	var produktdata ={};
	var array= $(this).data();
	for (var prop in array) {
		produktdata[prop]= array[prop];
	}
    $.ajax({
      type: 'POST',
      url: '/dashboard-wizard/step-three',
      data:  produktdata,
      success: function (response) {
      $('#stepthree').remove();
      $('#stepfour').remove();
      $('#stepfive').remove();
      $('#oderinfo').remove();
      $('#wizard').append(response);
      location.href = '#stepthree';
      },
      error: function(error) {
        console.log(error)
        alert('Data not saved');
      }
    });
    window.scroll({
  behavior: 'smooth'
});
    
});");
?>

