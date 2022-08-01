<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use app\extensions\greendev\weclapp\salesInvoice;
?>

<h3 class="box-title"><i class="fa fa-money-bill" aria-hidden="true"></i> Kunden Produkt Erfassen</h3>

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
        <table id="product" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
            <tr>
                <th width="20%">Customer Number</th>
                <th width="20%">First Name / Frimenname</th>
                <th width="20%" >Last Name / Frimenname</th>
                <th width="20%" >Kategorie</th>
                <th width="20%">E-Mail / Telefon</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th width="20%">.</th>
                <th width="20%">.</th>
                <th width="20%">.</th>
                <th width="20%">.</th>
                <th width="20%">.</th>
            </tr>

            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->


<?php

$this->registerJs("$(function () {
oTable = $('#product').DataTable({
'paging': true,
'lengthChange': false,
'responsive': true,
'bFilter': true,
'ordering': false,
'fixedColumns': true,
'processing': false,
'info': true,
'ajax':'/ajax/getuserforadmin',
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

$('#product tbody').on('click', 'tr', function () {
    $('#modal-body-loader' ).html( '<div class=\"row\"><div class=\"col - 12\"><div class=\"overlay loadingcolor\"><i class=\"fa fa - refresh fa - spin fa - 3x fa - fw loadingcolor\"></i></div></div></div>' );
     var data = oTable.row( this ).data();
        target = '#theModal',
        ajax_body = '/ajax/addvpsproducts?id='+data[0]
    $(target).modal('show')
        .find('.modal-body')
        .load(ajax_body);
        
});

");

?>


<div  class="modal fade" id="theModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Produkt Erfassen</h5>
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





