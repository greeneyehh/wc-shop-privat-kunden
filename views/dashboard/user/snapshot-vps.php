<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>
<div class="card card-primary">
    <div class="card-header box-header-windcloud">
        <h3 class="card-title"><i class="fa fa-comment-o" aria-hidden="true"></i> VPS Snapshot Liste </h3>
    </div>
    <div class="card-body">

<div class="row">
    <div class="col-12">
        <select id="snapshot" size="20" style="width: 100%" onchange="selectFunction()">
            <?php foreach ($list as $snapshot => $value): ?>
            <?php if($value->name !='current'){  ?>
                <option value="<?=$value->name;?>"><?=$value->name;?> | <?php $date = date_create();date_timestamp_set($date, $value->snaptime);echo date_format($date, 'Y-m-d H:i:s');?></option>
            <?php
                    }
            endforeach; ?>
        </select>
    </div>
    <div class="col-6">
            <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($VpsControl, 'value')->hiddenInput(['value'=>'snapshotdelete'])->label(false); ?>
                <?= $form->field($VpsControl, 'snapshotname')->hiddenInput(['value'=>'snapshotname','id'=>'snapshotdelete'])->label(false); ?>
                <button class="btn btn-block btn-danger btn-lg btn-app" style="margin: 0 0 10px 0px;" id="snapshotdelete" data-id="<?=$product->id;?>" data-node="<?=$product->node;?>" data-vmid="<?=$product->vmid;?>" ><i class="fas fa-trash"></i>Snapshot Löschen</button>
            <?php ActiveForm::end(); ?>

    </div>
    <div class="col-6">
        <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($VpsControl, 'value')->hiddenInput(['value'=>'snapshotrollback'])->label(false); ?>
            <?= $form->field($VpsControl, 'snapshotname')->hiddenInput(['value'=>'snapshotname','id'=>'snapshotrollback'])->label(false); ?>
            <button class="btn btn-block btn-danger btn-lg btn-app" style="margin: 0 0 10px 0px;" id="snapshotrollback" data-id="<?=$product->id;?>" data-vmid="<?=$product->vmid;?>" ><i class="fas fa-undo"></i>Snapshot Rollback</button>
        <?php ActiveForm::end(); ?>
    </div>

    </div>

    </div>



<?php
$this->registerJs("
 let sel = document.getElementById('snapshot');
    sel.addEventListener ('change', function () {
              
           let snapshotdelete = document.getElementById('snapshotdelete');
           snapshotdelete.value = this.value;
           let snapshotrollback = document.getElementById('snapshotrollback');
           snapshotrollback.value = this.value;
    });
");
?>