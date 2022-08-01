<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use app\extensions\greendev\weclapp\salesInvoice;
?>
monthlyinvoice2
<input type="text" class="form-control datetimepicker-input" data-target="#reservationdate">

<?php foreach ($CustomerOrder as $position => $cartone): ?>
    <?php   print_r($cartone['accountid']);?>
<br>
<?php $form = ActiveForm::begin(['method'=>'post']);?>
<pre>
    <?php   print_r($cartone);?>
    <?php   print_r($Account[array_search($cartone['accountid'], array_column($Account, 'accountid'))]);?>
</pre>
    <?= Html::submitButton('<span class="fa fa-times-circle"></span>', ['title' => 'Löschen', 'class' => 'btn-clear del-to-cart' , 'id'=>'del-to-cart']); ?>
    <?php ActiveForm::end(); ?>
    <hr>
<?php  endforeach; ?>





<?php

$this->registerJs("
$(function () {
$('#reservationdate').datetimepicker({
   format: 'L'
});
$('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });


$('#reservation').daterangepicker();

$('#reservationtime').daterangepicker({
timePicker: true,
timePickerIncrement: 30,
locale: {
format: 'MM/DD/YYYY hh:mm A'
}
});

})");
?>
