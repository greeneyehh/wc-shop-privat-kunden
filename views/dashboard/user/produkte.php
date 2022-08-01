<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use app\extensions\greendev\weclapp\widgets\ArticleWidgets;
use app\extensions\greendev\weclapp\widgets\ArticleCategoryWidgets;
?>
<div class="clearfix"></div>
<h3 class="box-title"><i class="fa fa-database" aria-hidden="true"></i> Produkte</h3>

<div class="row">
    <div class="col-md-6">
        <div class="card card-primary " style="overflow: auto">
            <div class="card-header box-header-windcloud">
                <h3 class="card-title"><i class="fa fa-search" aria-hidden="true"></i> Suche</h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
                <div class="row">
                    <div class="input-group col-md-12">
                        <label class="control-label col-sm-3">Kategorie </label>
                        <?php $form = ActiveForm::begin(); ?>
                         <?= $form->field($model, 'RechnungKategorie')->dropDownList($Category,['prompt'=>'Alle'])->label(false); ?>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" id="resetsearch" class="btn btn-default resetsearch" >Suche zurücksetzen</button>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <div class="col-md-6">

    </div>
</div>



<div class="card card-primary " style="overflow: auto">
    <div class="card-header box-header-windcloud">
        <h3 class="card-title"><i class="fa fa-reorder" aria-hidden="true"></i> Produktübersicht</h3>
    </div>
    <!-- /.box-header -->
    <div class="card-body" style="min-height: 500px" >
        <table id="product" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
            <tr role="row">
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="activate to sort column descending">ID:</th>
                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="activate to sort column descending">Account-Bezeichnung:</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="activate to sort column ascending">Produkt:</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="activate to sort column ascending">Addons:</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="activate to sort column ascending">Kategorie:</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="activate to sort column ascending">Kosten:</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="activate to sort column ascending">mind. Laufzeit:</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="activate to sort column ascending">Gebucht:</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="activate to sort column ascending">Nächste Abrechnung:</th>
            </tr>
            </thead>
            <tbody>

            </tbody>

        </table>

    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

    <div class="modal fade " id="variant-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Produktinformationen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body-loader">

                </div>
            </div>
        </div>
    </div>
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
'ajax':  '/ajax/getproduct',
 'language': {
     'loadingRecords': '<div class=\"overlay\"><i class=\"fas fa-2x fa-sync-alt fa-spin\"></i></div>',
     'oPaginate': {
        'sNext': '<i class=\"fas fa-chevron-right\"></i>',
        'sPrevious': '<i class=\"fas fa-chevron-left\"></i>',
      }
  }
});
});
$('#rechnungkategorieform-rechnungkategorie').change(function() {
    oTable.search($(this).val()).draw();
});
$( '#resetsearch' ).click(function() {
    $('select').prop('selectedIndex', 0);
  oTable.search('').draw();

});
$('#product tbody ').on('click', 'tr', function () {
var data = oTable.row( this ).data();
console.log(data[4]);
if(data[4] == 'Cloud Storage'){
$('#modal-body-loader' ).html( '<div class=\"row\"><div class=\"col - 12\"><div class=\"overlay loadingcolor\"><i class=\"fa fa - refresh fa - spin fa - 3x fa - fw loadingcolor\"></i></div></div></div>' );
     
        target = '#variant-modal',
        ajax_body = '/ajax/getcontract?id='+data[0]
    $(target).modal('show')
        .find('.modal-body')
        .load(ajax_body);
        
}
if(data[4] == 'Virtuelle Private Server'){
   window.location = '/dashboard/vps?id='+data[0];
}
});

");

?>

