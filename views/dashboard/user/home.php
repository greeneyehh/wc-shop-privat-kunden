<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>
<h3 class="box-title"><i class="fa fa-home" aria-hidden="true"></i> Übersicht</h3>


<div class="row">
    <div class="col-md-6">
        <div class="card card-primary " style="overflow: auto" style="max-height: 300px">
            <div class="card-header box-header-windcloud">
                <h3 class="card-title" >Informationen</h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body" id="infohome" style="min-height: 300px" >
                <div class="overlay loadingcolor">
                    <i class="fas fa-2x fa-sync-alt fa-spin "></i>
                </div>
            </div>

            <!-- /.box-body -->
        </div>

    </div>
    <div class="col-md-6">
        <div class="card card-primary " style="max-height: 340px">
            <div class="card-header box-header-windcloud">
                <h3 class="card-title">Letzte Rechnung</h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body" id="lastbill" style="min-height: 300px" >
                <div class="overlay loadingcolor">
                    <i class="fas fa-2x fa-sync-alt fa-spin "></i>
                </div>
            </div>

            <!-- /.box-body -->
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary " style="max-height: 300px;min-height: 300px">
            <div class="card-header box-header-windcloud">
                <h3 class="card-title">Offene Tickets</h3>
            </div>
            <div class="card-body" id="opentickets" style="overflow: auto" style="max-height: 300px">
                <div class="overlay loadingcolor">
                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-6">
        <div class="card card-primary " style="min-height: 300px">
            <div class="card-header box-header-windcloud">
                <h3 class="card-title">Offene Rechnung</h3>
            </div>
            <div class="card-body" id="openbill"  style="overflow: auto" style="min-height: 300px">
                <div class="overlay loadingcolor" >
                    <i class="fas fa-2x fa-sync-alt fa-spin "></i>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->registerJs("$.ajax({
        url: '/ajax/homeinfos'
    }).done(function(msg ) {
            document.getElementById('infohome').innerHTML = msg;
    });
");
?>
<?php
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
$this->registerJs("$.ajax({
        url: '/ajax/lastbill',
        complete: function (jqxhr) {
             $('#tablelastbill').DataTable({
                    'paging': true,
                    'lengthChange': false,
                    'searching': false,
                    'ordering': true,
                    'fixedColumns': true,
                    'processing': false,
                    'info': false,
                    'pageLength': 2,
                    'order': [[ 1, 'desc' ]],
                     'language': {
                      'oPaginate': {
                              'sNext': '<i class=\"fas fa-chevron-right\"></i>',
                              'sPrevious': '<i class=\"fas fa-chevron-left\"></i>',
                          }
                      }
             });
        }
    }).done(function(msg ) {
            document.getElementById('lastbill').innerHTML = msg;

    });
");
?>
<?php
$this->registerJs("$.ajax({
        url: '/ajax/opentickets'
    }).done(function(msg ) {
            document.getElementById('opentickets').innerHTML = msg;
    });
");
?>
