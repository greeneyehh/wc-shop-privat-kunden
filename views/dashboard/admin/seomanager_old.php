<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<h3 class="box-title"><i class="fa fa-money-bill" aria-hidden="true"></i> Seo Manager</h3>
<?php
$ajax=array();
$ajax['type']='POST';
$ajax['url']= "user/type";
$ajax['update']='#Update-id';
$ajax['data']="js:'parentname='+jQuery(this).val()";
$value['empty']='Select Type';
$value['ajax']=$ajax;
?>
<div class="row">
    <div class="col-md-8">
    <?php $form = ActiveForm::begin();
    $listData=ArrayHelper::map($modeldb,'id','route');
    echo $form->field($model, 'route')->dropDownList($listData, ['prompt'=>'Url...'],$value);
   ActiveForm::end(); ?>
    </div>
</div>
