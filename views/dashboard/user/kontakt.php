<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\AutoComplete;
use greeneye\adminlte\widgets\NewLinkPager;
$explanation =null;
?>
<h3 class="box-title"><i class="fa fa-comment" aria-hidden="true"></i> Kontakt</h3>


<div class="card card-primary">
        <div class="card-header box-header-windcloud">
            <h3 class="card-title"><i class="fa fa-reorder" aria-hidden="true"></i>Tickets</h3>
        </div>
        <!-- /.box-header -->
        <div class="card-body" style="min-height: 310px">
            <table id="ticketstatus" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                    <tr>
                        <th width="15%">ID</th>
                        <th width="25%">Betreff</th>
                        <th width="20%" >Status</th>
                        <th width="20%">Datum</th>
                        <th width="20%">Letzte aktuallisierung </th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
    </div>
</div>
<div class="row">
    <div class="col-md-7">
        <div class="card card-primary">
            <div class="card-header box-header-windcloud">
                <h3 class="card-title"><i class="fa fa-comment-o" aria-hidden="true"></i> Kontakt </h3>
            </div>
            <div class="card-body">
                <?php $form = ActiveForm::begin(); ?>
                <div class="input-group col-md-12" style="width:100%">
                    <label class="control-label col-sm-3">Bereich </label>
                    <div class="form-group col-sm-9" >
                        <?= $form->field($kontaktForm, 'area')->dropDownList($CategoryData)->label(false); ?>
                    </div>
                </div>
                <div class="input-group col-md-12">
                    <label class="control-label col-sm-3">Betreff </label>
                    <div class="form-group col-sm-9" >
                        <?= $form->field($kontaktForm, 'subject')->label(false)->textInput(['placeholder' => $kontaktForm->getAttributeLabel('subject'),'class'=>'form-control'])->widget(AutoComplete::classname(), ['clientOptions' => ['source' => $AutoComplete,]]) ?>
                    </div>
                </div>
                <div class="input-group col-md-12">
                    <label class="control-label col-sm-3">Mitteilung </label>
                    <div class="form-group" style="width:100%">
                        <?= $form->field($kontaktForm, 'message')->textArea(['class' => 'textarea'])->label(false);?>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="pull-right">
                        <?= Html::submitButton('Abschicken', ['class' => 'btn btn-success']);?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card card-primary">
            <div class="card-header box-header-windcloud">
                <h3 class="card-title"><i class="fa fa-info-circle" aria-hidden="true"></i> Erklärung</h3>
            </div>
            <div class="card-body" style="height: 598px">
                    <?php foreach ($ticket['result'] as $tickets):



                    $statusname ="";
                        /*switch ($tickets['ticketStatusId']) {
                            case "WAITING":
                                $tickets['status'] = "value ticket-purple";
                                $statusname ="Wartend";
                                break;
                            case "IN_PROGRESS":
                                $tickets['status'] = "value ticket-yellow";
                                $statusname ="In Bearbeitung";
                                break;
                            case "FIXED":
                                $tickets['status'] = "value ticket-dark-green";
                                $statusname ="Gelöst";
                                break;
                            case "WONT_FIX":
                                $tickets['status'] = "value ticket-red";
                                $statusname ="Keine Lösung";
                                break;
                            case "CLOSED":
                                $tickets['status'] = "value ticket-light-blue";
                                $statusname ="Geschlossen";
                                break;
                            case "FIXED":
                                $tickets['status'] = "value ticket-dark-green";
                                $statusname ="Gelöst";
                                break;
                        }*/
                     //   echo '<pre>';
                     //   print_r($tickets);
                    //    echo '</pre>';
                        if(isset($tickets['solution']))
                        {
                            date_default_timezone_set("UTC");

                    ?> <div class="card">
              <div class="card-header <?=$tickets['status'];?>">
                <h3 class="card-title"><?=$tickets['ticketNumber'].' | '.$CategoryData[$tickets['ticketCategoryId']].' | '.$UserData[$tickets['assignedUserId']].' | '.$tickets['ticketStatusName'] ;?></h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fas fa-minus"></i></button>
                </div>
              </div>
              <div class="card-body disabled" ><?= $tickets['solution'];?></div>
              <div class="card-footer" >
               <div class="row">
                   <div class="col-md-6">letzte Aktualisierung </div>
                   <div class="col-md-6"><?= date("d.m.y H:i:s", $tickets['lastModifiedDate']/1000);?></div>
                </div>
              </div>
            </div>
             <?php }  endforeach; ?>

        </div>
            <div class="card-footer">
                <div class="pull-right">
                    <?php
                    echo NewLinkPager::widget([
                        'pagination' => $pagination,
                        'class' => 'paginate_button page-item',
                        'prevPageLabel' => '<i class="fas fa-chevron-left"></i>',
                        'nextPageLabel' => '<i class="fas fa-chevron-right"></i>',
                        'prevPageCssClass' => 'paginate_button page-item previous',
                        'nextPageCssClass' => 'paginate_button page-item next',
                        'pageCssClass' => 'paginate_button page-item ',
                        'firstPageLabel' => false,
                        'registerLinkTags' => true,
                        'options' => [
                            'class' => 'pagination',
                        ],
                        'linkOptions' => [
                            'class' => 'page-link',
                        ],

                    ]);
                    ?>
                </div>
            </div>
    </div>
</div>
<?php

$this->registerJs("$(function () {
$('.textarea').summernote({
  toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['picture', ['picture']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']],
     ['lineHeights',  ['0.2', '0.3', '0.4', '0.5', '0.6', '0.8', '1.0', '1.2', '1.4', '1.5', '2.0', '3.0']]
  ],
  height: 300, 
})
})");

?>
<?php
$this->registerJs("$(function () {
$('#ticketstatus').DataTable({

'paging': true,
'lengthChange': false,
'searching': false,
'ordering': true,
'fixedColumns': true,
'processing': false,
'info': false,
'pageLength': 3,
'ajax':  '/ajax/getopenticket',
'order': [[ 0, 'desc' ]],
  'language': {
     'loadingRecords': '<div class=\"overlay\"><i class=\"fas fa-2x fa-sync-alt fa-spin\"></i></div>',
     'infoEmpty': ' ',
      'zeroRecords':'Keine Tickets vorhanden',
      'oPaginate': {
      'sNext': '<i class=\"fas fa-chevron-right\"></i>',
      'sPrevious': '<i class=\"fas fa-chevron-left\"></i>',
       },
  }
});
});");
?>

