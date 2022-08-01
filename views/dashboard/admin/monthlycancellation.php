<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use app\extensions\greendev\weclapp\salesInvoice;
?>
monthlycancellation



<?php foreach ($CustomerOrder as $position => $cartone): ?>
<pre>
    <?php   print_r($cartone);?>
    <?php   print_r($cartone['id']. '' .$cartone['accountid']);?>

</pre>
<hr>
    <br>

<?php  endforeach; ?>
