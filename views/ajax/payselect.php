<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="row justify-content-center features">
    <?php $form = ActiveForm::begin(['action' => ['ajax/payselect/','invoiceid'=>$invoiceid,'invoicenumber'=>$invoicenumber], 'options' => [
        'class' => 'comment-form'
    ],	'enableAjaxValidation'=>true,
    ]); ?>
        <div class="hiddenradio">
            <h3>Zahlungsmittel wählen</h3>
            <?= $form->field($PaymentPostModel, 'brand')->inline()->radioList( $vrpaybrands, ['encode' => false],['class'=>'checkbox-tools'])->label(false)?>
            <div class="row">
                <div class="col-6"><button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button></div>
                <div class="col-6">
                    <?= Html::submitButton('auswählen',
                        ['style'=>'vertical-align: bottom; width: 100%;',
                            'class' => 'border mobile-fill anim-1 show align-self-end add-to-cart-modal-ajax',]);
                    ?>
                </div>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>

<?php
$this->registerJs("
            $('.comment-form').submit(function(event) {
            event.preventDefault(); // stopping submitting
            var data = $(this).serializeArray();
            var url = $(this).attr('action');
       
           	$.ajax({
              type: 'POST',
              url: url,
              data:  data,
              beforeSend: function(){
                $('#theModal').find('.modal-body').append('<div class=\"overlay loadingcolor\"><i class=\"fas fa-2x fa-sync-alt fa-spin \"></i></div>');
              },
              success: function (response) {
              $('#theModal').removeData('bs.modal');
                $('#theModal').find('.modal-body').html(response).load(response, function() { });
              },
              error: function(error) {
                console.log(error)
              }
            });
        });


");

?>



<?php
$this->registerCssFile("/css/cms/dashboard/style-payselect.css");
?>
