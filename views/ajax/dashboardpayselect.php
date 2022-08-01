<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<div class="row justify-content-center features">
    <?php foreach ($vrpaybrands as $brands ): ?>
        <div class="col-sm-6 col-md-5 col-lg-3 item">
            <div class="box">
                <a id="tipp" href="/dashboard/payment?entityId=<?=$brands['entityId'];?>&brand=<?=$brands['name'];?>&invoicenumber=<?=$invoicenumber;?>&id=<?=$id;?>" lang="en" hreflang="de"><img src="<?= Url::to('@web/image/payment-icons/'.$brands['image']);?>" style="width: 120px;"></a>
            </div>
        </div>
    <?php  endforeach; ?>
</div>
<?php
$this->registerJs("
$('.btn-action').click(function(){
    var url = $(this).data('url'); 
    $('#theModal').modal('hide');
    
       $('#myModal2 .modal-body').load(url);
       $('#myModal2').modal('show');
});
");
?>