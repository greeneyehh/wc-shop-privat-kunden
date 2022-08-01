<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use app\extensions\greendev\weclapp\salesInvoice;
?>

<h3 class="box-title"><i class="fa fa-money-bill" aria-hidden="true"></i> Rechnungen</h3>


<div class="row">
    <div class="col-md-6">
        <div class="card card-primary ">



            <div class="card-header box-header-windcloud">
                <h3 class="card-title"><i class="fa fa-search" aria-hidden="true"></i> Suche</h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body" style="min-height: 250px">
                <input type="text" class="form-control" id="myInputTextField" placeholder="Suche ...">
                <p></p>
             <div class="row">
                 <div class="col-md-6">  <button type="button" id="leerenSuchfeld" class="btn btn-default" >Suche zurücksetzen</button> </div>
            </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-primary" style="overflow: auto">
            <div class="card-header box-header-windcloud">
                <h3 class="card-title">Offene Rechnung</h3>
            </div>
            <div class="card-body" id="openbill" style="min-height: 250px" style="min-height: 250px">
                <div class="overlay loadingcolor" >
                    <i class="fas fa-2x fa-sync-alt fa-spin "></i>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="card card-primary">
    <div class="card-header box-header-windcloud">
        <h3 class="card-title"><i class="fa fa-reorder" aria-hidden="true"></i> Rechnungsübersicht</h3>
    </div>
    <!-- /.box-header -->
    <div class="card-body" style="min-height: 500px">
        <table id="rechnung" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
            <tr>
                <th width="20%">Status</th>
                <th width="20%">Rechnungsnummer</th>
                <th width="30%" >Datum</th>
                <th width="30%">Betrag</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th width="20%">.</th>
                <th width="20%">.</th>
                <th width="30%">.</th>
                <th width="30%">.</th>
            </tr>

            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->


<?php

$this->registerJs("$(function () {
oTable = $('#rechnung').DataTable({
'paging': true,
'lengthChange': false,
'responsive': true,
'bFilter': true,
'ordering': true,
'fixedColumns': true,
'processing': false,
'info': true,
'ajax':'/ajax/getinvoice',
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

");
$this->registerJs("$.ajax({
        url: '/ajax/openbill',
        complete: function (jqxhr) {
             $('#tableopenbill').DataTable({
                    'paging': true,
                    'lengthChange': false,
                    'searching': false,
                    'ordering': true,
                    'fixedColumns': true,
                    'processing': false,
                    'info': false,
                    'order': [[ 1, 'desc' ]],
                    'pageLength': 2,
                     'language': {
                          'oPaginate': {
                              'sNext': '<i class=\"fas fa-chevron-right\"></i>',
                              'sPrevious': '<i class=\"fas fa-chevron-left\"></i>',
                              }
                          }
             });
        }
    }).done(function(msg ) {
            document.getElementById('openbill').innerHTML = msg;

    });
");
?>
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

            </div>
        </div>
    </div>


<div id="myModal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="myModalLabel">Zahlung</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
            </div>
        </div>
    </div>
</div>


<?php $this->registerJs("
$('#theModal').on('show.bs.modal', function (e) {
   var button = $(e.relatedTarget);
    var modal = $(this);
    modal.find('.modal-body').load(button.data('remote'));
});
");
?>


