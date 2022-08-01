<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>

<div class="row">
   <div class="col-12">
       <div class="card card-primary">
           <div class="card-header">
               <h3 class="card-title"><?=$id;?></h3>
           </div>
           <div class="card-body">
            <?php foreach ($customer['result'] as $key => $datacustomer): ?>
                <?php if (isset($datacustomer['company'])){
                    echo $datacustomer['company'];
                    if (isset($datacustomer['salutation'])){
                        echo '<p class="text-muted">'.$datacustomer['salutation'].' ';
                    }
                    if (isset($datacustomer['firstName'])){
                        echo $datacustomer['firstName'].' ';
                    }
                    if (isset($datacustomer['lastName'])){
                        echo $datacustomer['lastName'].'</p>';
                    }
                }else{
                    echo 'Privat Person';
                    if (isset($datacustomer['salutation'])){
                        echo '<p class="text-muted">'.$datacustomer['salutation'].' ';
                    }
                    if (isset($datacustomer['firstName'])){
                        echo $datacustomer['firstName'].' ';
                    }
                    if (isset($datacustomer['lastName'])){
                        echo $datacustomer['lastName'].'</p>';
                    }
                }
                ?>
                <hr>
                <?php if (isset($datacustomer['email'])){
                    echo '<p class="text-muted">'. $datacustomer['email'] .'</p>';
                }?>
                   <hr>
               <?php endforeach; ?>


           </div>
           <!-- /.card-body -->
       </div>
        </div>
        <?php foreach ($ShopCategoryProduct['result'] as $key => $products): ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4" >
                <div class="bg-darkblue border-radius-d adjust-h" style="background-color: #004477;color: white;">
                    <div class="p-3" style="text-align: center;">
                        <h3><?=$products['name'];?></h3>
                        <strong style="font-size: 0.8rem;margin-bottom: 0.5rem">Ab <?php echo$products['articlePrices']['0']['price'] + $products['articlePrices']['0']['price']*Yii::$app->params['STEUERSATZ'];?> € inkl. <?= Yii::$app->params['STEUERSATZTEXT'];?> MwSt.</strong>
                        <p></p>
                                              <?= Html::submitButton('auswählen',
                            ['style'=>'vertical-align: bottom; width: 100%;',
                                'class' => 'border mobile-fill anim-1 btn-ajax-modal show step-os','data-vps'=>$products['id'],'data-customerid'=>$id]);
                        ?>

                    </div>
                </div>
            </div>

        <?php   endforeach; ?>

    <div id="wizard">
    </div>

</div>

<?php
$this->registerJs("
$('.step-os').click(function(event) {
	var produktdata ={};
	var array= $(this).data();
	for (var prop in array) {
		produktdata[prop]= array[prop];
	}
$.ajax({
      type: 'POST',
      url: '/dashboard-wizard/step-os',
      data:  produktdata,
      success: function (response) {
      location.href = '#variants';
      $('#stepos').remove();
      $('#steptwo').remove();
      $('#stepthree').remove();
      $('#stepfour').remove();
      $('#stepfive').remove();
      $('#oderinfo').remove();
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

