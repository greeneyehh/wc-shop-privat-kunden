<?php
use Yii;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>
<h3 class="box-title"><i class="fa fa-info-circle" aria-hidden="true"></i> Fehler</h3>


<div class="row">
    <div class="col-md-12">
        <div class="card card-primary " style="overflow: auto" style="max-height: 300px">
            <div class="card-header box-header-windcloud">
                <h3 class="card-title" >Informationen</h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body" id="infohome" style="min-height: 300px" >
                <?= $info;?>
            </div>

            <!-- /.box-body -->
        </div>

    </div>
</div>
