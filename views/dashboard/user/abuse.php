<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>
<h3 class="box-title"><i class="fa fa-ban" aria-hidden="true"></i> Abusehinweise</h3>


<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header box-header-windcloud">
                <h3 class="card-title"><i class="fa fa-search" aria-hidden="true"></i> Suche</h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
                <div class="row">

                    <div class="input-group col-md-12">
                        <label class="control-label col-sm-3">Hosting </label>
                        <select class="form-control col-sm-9" id="hosting_id" name="hosting_id">
                            <option value="Alle">Alle</option>
                        </select>
                    </div>

                    <div class="input-group col-md-12">
                        <label class="control-label col-sm-3">Einträge je Seite </label>
                        <select class="form-control col-sm-9" id="entrysperpage" name="entrysperpage">
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="250">250</option>
                            <option value="500">500</option>
                        </select>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-default" onclick="leerenSuchfeld(); return false;">Suche zurücksetzen</button>
                <button type="submit" class="btn btn-default" onclick="listInvoice(1); return false;">Suchen</button>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header box-header-windcloud">
                <h3 class="card-title"><i class="fa fa-info-circle" aria-hidden="true"></i> Erklärung</h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
                Hier finden Sie eine Übersicht über Ihre Abusehinweise.
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>



<div class="card card-primary">
    <div class="card-header box-header-windcloud">
        <h3 class="card-title"><i class="fa fa-reorder" aria-hidden="true"></i> Ergebnis</h3>
    </div>
    <!-- /.box-header -->
    <div class="card-body">
        <div class="alert alert-info">
            Sie haben derzeit keine Abusehinweise.
        </div>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->