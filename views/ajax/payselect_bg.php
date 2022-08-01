<div class="row justify-content-center features">
    <div class="col-sm-3 col-md-5 col-lg-3 item">
        <div class="box">
             <button class="btn btn-action" data-url="/ajax/payment?id=<?=$id;?>&invoicenumber=<?=$invoicenumber;?>&brand=PAYPAL" id="btnAction1"><img src="/image/payment-icons/paypal-alternative2.png" style="width: 120px"></button>
        </div>
    </div>
    <div class="col-sm-3 col-md-5 col-lg-3 item">
        <div class="box">
            <button class="btn btn-action" data-url="/ajax/payment?id=<?=$id;?>&invoicenumber=<?=$invoicenumber;?>&brand=GIROPAY" id="btnAction1"><img src="/image/payment-icons/giropay.png" style="width: 120px"></button>
        </div>
    </div>
    <div class="col-sm-3 col-md-5 col-lg-3 item">
        <div class="box">
            <button class="btn btn-action" data-url="/ajax/payment?id=<?=$id;?>&invoicenumber=<?=$invoicenumber;?>&brand=SOFORTUEBERWEISUNG" id="btnAction1"><img src="/image/payment-icons/klarna-sofort.png" style="width: 120px"></button>
        </div>
    </div>
    <div class="col-sm-3 col-md-5 col-lg-3 item">
        <div class="box">
            <button class="btn btn-action" data-url="/ajax/payment?id=<?=$id;?>&invoicenumber=<?=$invoicenumber;?>&brand=VISA" id="btnAction1"><img src="/image/payment-icons/visa.png" style="width: 120px"></button>
        </div>
    </div>
    <div class="col-sm-3 col-md-5 col-lg-3 item">
        <div class="box">
            <button class="btn btn-action" data-url="/ajax/payment?id=<?=$id;?>&invoicenumber=<?=$invoicenumber;?>&brand=MASTER" id="btnAction1"><img src="/image/payment-icons/mastercard.png" style="width: 120px"></button>
        </div>
    </div>
    <div class="col-sm-3 col-md-5 col-lg-3 item">
        <div class="box">
            <button class="btn btn-action" data-url="/ajax/payment?id=<?=$id;?>&invoicenumber=<?=$invoicenumber;?>&brand=PAYDIREKT" id="btnAction1"><img src="/image/payment-icons/sepa.png" style="width: 120px"></button>
        </div>
    </div>
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