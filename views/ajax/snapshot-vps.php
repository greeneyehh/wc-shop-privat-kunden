
<h5>Snapshot Liste</h5>
<div class="row">
    <div class="col-12">
        <select id="snapshot" size="10" style="width: 100%">
            <?php foreach ($list as $snapshot => $value): ?>
            <?php if($value->name !='current'){  ?>
                <option value="<?=$value->name;?>"><?=$value->name;?> | <?php $date = date_create();date_timestamp_set($date, $value->snaptime);echo date_format($date, 'Y-m-d H:i:s');?></option>
            <?php
                    }
            endforeach; ?>
        </select>
    </div>
    <div class="col-6">
        <button class="btn btn-block btn-danger btn-lg btn-app" style="margin: 0 0 10px 0px;" id="snapshotdelete" data-id="<?=$product->id;?>" data-node="<?=$product->node;?>" data-vmid="<?=$product->vmid;?>" ><i class="fas fa-trash"></i>Snapshot Löschen</button>
    </div>
    <div class="col-6">
        <button class="btn btn-block btn-danger btn-lg btn-app" style="margin: 0 0 10px 0px;" id="snapshotrollback" data-id="<?=$product->id;?>" data-vmid="<?=$product->vmid;?>" ><i class="fas fa-undo"></i>Snapshot Rollback</button>
    </div>

    </div>






    <?php
    $this->registerJs("
    $('#snapshotrollback').click(function() {
        target = '#variant-modal';
        ajax_body = '/ajax/vm-snapshot-rollback?id='+$(this).data('id')+'&vmid='+$(this).data('node')+'&name='+document.getElementById('snapshot').selectedOptions[0].value;
    $(target).modal('show')
        .find('.modal-body')
        .load(ajax_body);
    });
");
    ?>
<?php
$this->registerJs("
    $('#snapshotdelete').click(function() {
        target = '#variant-modal';
        ajax_body = '/ajax/vm-delete-snapshot?id='+$(this).data('id')+'&node='+$(this).data('node')+'&vmid='+$(this).data('node')+'&name='+document.getElementById('snapshot').selectedOptions[0].value;
    $(target).modal('show')
        .find('.modal-body')
        .load(ajax_body);
    });
");
?>
