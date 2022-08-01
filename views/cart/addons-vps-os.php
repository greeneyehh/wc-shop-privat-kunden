<?php
$this->title = Yii::$app->name;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

use app\extensions\greendev\weclapp\widgets\variantInfoWidget;
?>
    <div class="row row-eq-height justify-content-center align-middle" style="margin-top: 25px;">

<?php
foreach ($data['result'] as $products):

    $a[$products['id']] = $products['name'];

endforeach; ?>
        <div class="col-12 col-md-6 col-lg-6" >
            <div class="border-radius-d box-shadow p-3" style="background-color: #ffffff;height: 100%;">
                <h3 class="vary" style="min-height: 29px;">Betriebssystem</h3>

                <p><?=Html::activeDropDownList($model, 'OSSystem',$a,['id'=>'OSSystem','class'=>'vary','style'=>'vertical-align: bottom; width: 100%;']);?></p>
                <?= Html::submitButton('auswählen',
                    ['style'=>'vertical-align: bottom; width: 100%;',
                        'class' => 'border mobile-fill anim-1 show align-self-end add-to-cart-modal-addon-ajax',
                        ]);
                ?>
            </div>
        </div>
    </div>
<?php
$this->registerCssFile("/css/cms/style-variant-addon.css");
$this->registerJs("$('#exampleModalLongTitle').text('Betriebssystem WÄHLEN');
    $('.add-to-cart-modal-addon-ajax').click(function(event) {
    var produktdata ={} ;
    produktdata['text']= $(\"#OSSystem :selected\").text();
    produktdata['val']= $(\"#OSSystem :selected\").val(); 
	
	
	$.ajax({
      type: 'POST',
      url: '/cart/ajax-add-os',
      data:  produktdata,
      success: function (response) {
      $('#variant-modal').removeData('bs.modal');
              $('#variant-modal').find('.modal-body').html(response);
              cartcount()
      },
      error: function(error) {
        console.log(error)
        alert('Data not saved');
      }
    });
});"
);
$this->registerJs(
    "$('.del-addon-from-cart-modal-ajax').click(function(event) {
    var produktdata ={} ;
	var array= $(this).data();
	for (var prop in array) {
		console.log(prop)
        if (prop == 'domainextension') {
            produktdata['domainextension']= document.getElementById('DomainExtension').value;
        }else {
		    produktdata[prop]= array[prop];
	    }
	}
    $.ajax({
      type: 'POST',
      url: '/cart/cart-addon-delete',
      data:  produktdata,
      success: function (response) {
      $('#variant-modal').removeData('bs.modal');
              $('#variant-modal').find('.modal-body').html(response).load(response, function() { });
              cartcount();
      },
      error: function(error) {
        console.log(error)
        alert('Data not saved');
      }
    });
});"
);

?>
