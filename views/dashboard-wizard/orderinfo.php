<?php
use yii\helpers\Html;
?>

<div class="card" id="oderinfo">
    <div class="card-header border-radius-d cart-card-addon" style="text-align: center;">
        <h3 class="vary">Option</h3>
    </div>
    <div class="card-body row justify-content-md-center">
    <div class="col-12">
        datum:
    </div>


    <div class="col-12">
        <div class="checkbox">
            <label for="customerorder-active">
                <input type="hidden" name="InvoiceCreate" value="0"><input type="checkbox" id="customerorder-active" name="InvoiceCreate" value="1">
                <label for="contactform-youraccept">Rechnung Erstellen</label>
            </label>
            <p class="help-block help-block-error"></p>

        </div>
    </div>


    <div class="col-12">
        <?= Html::submitButton('Produkt Zuweisen', ['class' => 'btn btn-default bordercart mobile-fill step-buy', 'name' => 'buy', 'value'=> 'true','data-customerid'=>$customerid]) ?>
    </div>
    </div>
</div>

<?php
$this->registerJs("
$('.step-buy').click(function(event) {
	var produktdata ={};
	var array= $(this).data();
	for (var prop in array) {
		produktdata[prop]= array[prop];
	}
$.ajax({
      type: 'POST',
      url: '/dashboard-wizard/add-vps',
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
