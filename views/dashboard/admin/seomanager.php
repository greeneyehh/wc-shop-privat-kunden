<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use app\extensions\greendev\weclapp\salesInvoice;
?>

<h3 class="box-title">Seomanager</h3>

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
        <table id="seo" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
            <tr>
                <th>id</th>
                <th>route</th>
                <th>title</th>
                <th>keywords</th>
                <th>description</th>
                <th>canonical</th>

            </tr>
            </thead>
            <tbody>
            <tr>
                <th>id</th>
                <th>route</th>
                <th>title</th>
                <th>keywords</th>
                <th>description</th>
                <th>canonical</th>
            </tr>

            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->




<div class="modal fade" id="theModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rechnung Bezahlen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
            </div>
        </div>
    </div>
</div>


<?php

$this->registerJs("$(function () {
oTable = $('#seo').DataTable({
'paging': true,
'lengthChange': false,
'responsive': true,
'bFilter': true,
'ordering': true,
'fixedColumns': true,
'processing': false,
'info': true,
'ajax':'/ajax/getseodata',
'order': [[ 1, 'desc' ]],
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


<?php $this->registerJs("
$('#seo tbody').on('click', 'tr', function () {
     var data = oTable.row( this ).data();
        target = '#theModal',
        ajax_body = '/ajax/getseodataupdate?id='+data[0]
    $(target).modal('show')
        .find('.modal-body')
        .load(ajax_body);
        
});
");
?>


