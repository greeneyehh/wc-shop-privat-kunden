<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>






<h3 class="box-title">Weclapp Transferlog</h3>

<div class="row">
    <div class="col-md-6">
        <div class="card card-primary ">
            <div class="card-header box-header-windcloud">
                <h3 class="card-title"><i class="fa fa-search" aria-hidden="true"></i> Suche</h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body" style="min-height: 150px">
                <input type="text" class="form-control" id="myInputTextField" placeholder="Suche ...">
                <p></p>
                <div class="row">
                    <div class="col-md-6">  <button type="button" id="leerenSuchfeld" class="btn btn-default" >Suche zurücksetzen</button> </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">

    </div>
</div>



<div class="card card-primary">
    <div class="card-header box-header-windcloud">
        <h3 class="card-title"><i class="fa fa-reorder" aria-hidden="true"></i> Ergebnis</h3>
    </div>
    <!-- /.box-header -->
    <div class="card-body" style="min-height: 500px">
        <table id="log" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
            <tr>
                <th>id</th>
                <th>sessionid</th>
                <th>type</th>
                <th>content</th>
                <th>result</th>
                <th>created_at</th>

            </tr>
            </thead>
            <?php foreach ($log as $position => $logs): ?>

                    <tr>
                        <td ><?= $logs['id'] ?></td>
                        <td><?= $logs['sessionid'] ?></td>
                        <td><?= $logs['type'] ?></td>
                        <td style="height:80px;max-width: 300px; overflow:scroll" >
                            <details>
                                <summary>anzeigen</summary>
                                <?= $logs['content'] ?>
                            </details></td>
                        <td style="height:80px;max-width: 300px; overflow:scroll">
                            <details>
                                <summary>anzeigen</summary>
                                <p><?= $logs['result'] ?></p>
                            </details>
                        </td>
                        <td><?= $logs['created_at'] ?></td>

                    </tr>

            <?php  endforeach; ?>

            <tbody>
            <tr>
                <th>id</th>
                <th>sessionid</th>
                <th>type</th>
                <th>content</th>
                <th>result</th>
                <th>created_at</th>
            </tr>

            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->





<?php

$this->registerJs("$(function () {
oTable = $('#log').DataTable({
'paging': true,
'lengthChange': false,
'responsive': true,
'bFilter': true,
'ordering': true,
'fixedColumns': true,
'processing': false,
'info': true,
'order': [[ 0, 'desc' ]],
 'language': {
     'loadingRecords': '<div class=\"overlay\"><i class=\"fas fa-2x fa-sync-alt fa-spin\"></i></div>',
     'oPaginate': {
        'sNext': '<i class=\"fas fa-chevron-right\"></i>',
        'sPrevious': '<i class=\"fas fa-chevron-left\"></i>',
      }
  }
});
});
$('#myInputTextField').keyup(function(){
      oTable.search($(this).val()).draw() ;
})

$( '#leerenSuchfeld' ).click(function() {
    document.getElementById('myInputTextField').value ='';
  oTable.search('').draw();

});


");

?>