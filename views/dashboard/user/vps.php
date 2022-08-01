<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
$startupos=false;
?>


<div class="card card-primary">
    <div class="card-header box-header-windcloud">
        <h3 class="card-title"><i class="fa fa-comment-o" aria-hidden="true"></i> VPS </h3>
    </div>
    <div class="card-body">
        <div>
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active" role="tab" data-toggle="tab" href="#tab-1">Übersicht</a></li>
                <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#tab-2">Vertragliches</a></li>
                <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#tab-3">Kündigung</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" role="tabpanel" id="tab-1">
                    <div class="card-body">

                        <?php if($product['active'] == 0 ){?>
                            <div class="col-12">
                                <h2>Übersicht</h2>
                                <p>Hier finden Sie eine Übersicht der wichtigsten Details zu Ihrem Produkt.</p>
                                <div class="btn btn-block btn-danger btn-lg">Dieses Produkt ist derzeit nicht aktiv.</div>
                            </div>
                        <?php }else{ ?>
                            <div class="col-12">
                                <h2>Übersicht</h2>
                                <p>Hier finden Sie eine Übersicht der wichtigsten Details zu Ihrem Produkt.</p>
                                <?php if(isset($message)){ echo '<div class="btn btn-block btn-danger btn-lg">'.$message.'</div>';  } ?>
                            </div>

                            <div class="form-group row col-12">
                                <label class="col-12 col-form-label">Account-Bezeichnung:</label>
                                <div class="col-12 col-form-label"><?=Yii::$app->user->identity->accountid;?>-<?=$product['id'];?></div>
                            </div>
                            <div class="form-group row col-12">
                                <label class="col-12 col-form-label">Serverdaten:</label>
                                <div class="col-12 row">
                                    <div class="col-4">Status:</div>
                                    <div class="col-8"><?php if(isset($status->qmpstatus)){ echo $status->qmpstatus;  } ?></div>
                                </div>
                                <div class="col-12 row">
                                    <div class="col-4">OS:</div>
                                    <div class="col-8">
                                        <?php if($os['data']){
                                            if(isset($os['data']['result']['pretty-name'])){
                                                echo $os['data']['result']['pretty-name'];
                                                $startupos=true;
                                            }
                                        } ?>
                                    </div>
                                </div>
                                <div class="col-12 row">
                                    <div class="col-4">IP-Adressen:</div>
                                    <div class="col-8"><?=$ip;?></div>

                                </div>
                            </div>
                            <?php if($customervps['initialsetup']==0 && $startupos){?>
                                <div class="form-group row col-12">
                                    <button type="button" class="btn btn-block btn-primary btn-lg" data-toggle="modal" data-target=".bd-example-modal-lg">Erst Konfiguration</button>
                                </div>
                            <?php }?>
                            <?php if($customervps['initialsetup']==1 ){?>
                                <div class="form-group row col-12">
                                <label class="col-12 col-form-label">Server steuern:</label>
                                <div class="col-3">
                                    <?php $form = ActiveForm::begin(); ?>
                                    <?= $form->field($VpsControl, 'value')->hiddenInput(['value'=>'reboot'])->label(false); ?>
                                    <button class="btn btn-block btn-warning btn-lg btn-app" style="margin: 0 0 10px 0px;" id="reboot" data-id="<?=$product['id'];?>" ><i class="fas fa-redo"></i> Neustart</button>
                                    <?php ActiveForm::end(); ?>


                                </div>
                                <div class="col-3">

                                    <?php $form = ActiveForm::begin(); ?>
                                    <?= $form->field($VpsControl, 'value')->hiddenInput(['value'=>'shutdown'])->label(false); ?>
                                    <button class="btn btn-block btn-danger btn-lg btn-app" style="margin: 0 0 10px 0px;" id="shutdown" data-id="<?=$product['id'];?>" ><i class="fas fa-power-off"></i> Herunterfahren</button>
                                    <?php ActiveForm::end(); ?>


                                </div>
                                <div class="col-3">

                                    <?php if($status->qmpstatus == 'stopped' or $status->qmpstatus == 'paused' OR $status->qmpstatus == 'save-vm'){?>
                                    <?php $form = ActiveForm::begin(); ?>
                                        <?= $form->field($VpsControl, 'value')->hiddenInput(['value'=>'start'])->label(false); ?>
                                        <button class="btn btn-block btn-success btn-lg btn-app" style="margin: 0 0 10px 0px;" id="start" data-id="<?=$product['id'];?>"><i class="fas fa-play"></i> Starten</button>
                                    <?php ActiveForm::end(); ?>
                                    <?php }elseif ($status->qmpstatus =='running'){?>
                                        <?php $form = ActiveForm::begin(); ?>
                                            <?= $form->field($VpsControl, 'value')->hiddenInput(['value'=>'stop'])->label(false); ?>
                                            <button class="btn btn-block btn-primary btn-lg btn-app" style="margin: 0 0 10px 0px;" id="stop" data-id="<?=$product['id'];?>" ><i class="fas fa-stop"></i> Stop</button>
                                        <?php ActiveForm::end(); ?>
                                    <?php }?>



                                </div>
                                <div class="col-3">

                                    <?php if($status->qmpstatus == 'paused' OR $status->qmpstatus == 'stopped' OR $status->qmpstatus == 'save-vm'){?>
                                        <?php $form = ActiveForm::begin(); ?>
                                            <?= $form->field($VpsControl, 'value')->hiddenInput(['value'=>'resume'])->label(false); ?>
                                            <button class="btn btn-block btn-primary btn-lg btn-app" style="margin: 0 0 10px 0px;" id="resume" data-id="<?=$product['id'];?>"><i class="fas fa-play"></i> Resume</button>
                                        <?php ActiveForm::end(); ?>
                                         <?php }elseif ($status->qmpstatus =='running'){?>
                                        <?php $form = ActiveForm::begin(); ?>
                                            <?= $form->field($VpsControl, 'value')->hiddenInput(['value'=>'suspend'])->label(false); ?>
                                            <button class="btn btn-block btn-primary btn-lg btn-app" style="margin: 0 0 10px 0px;" id="suspend" data-id="<?=$product['id'];?>"><i class="fas fa-pause"></i> Pausieren</button>
                                        <?php ActiveForm::end(); ?>
                                         <?php }?>

                                </div>
                                <div class="col-3">

                                    <?php $form = ActiveForm::begin(); ?>
                                        <?= $form->field($VpsControl, 'value')->hiddenInput(['value'=>'snapshot'])->label(false); ?>
                                        <button class="btn btn-block btn-primary btn-lg btn-app" style="margin: 0 0 10px 0px;" id="snapshot" data-id="<?=$product['id'];?>" onclick="snapshot"><i class="fas fa-save"></i> Snapshot</button>
                                    <?php ActiveForm::end(); ?>

                                     </div>
                                <div class="col-3">
                                    <?php $form = ActiveForm::begin(); ?>
                                        <?= $form->field($VpsControl, 'value')->hiddenInput(['value'=>'rollbacksnapshotlist'])->label(false); ?>
                                        <button class="btn btn-block btn-primary btn-lg btn-app" style="margin: 0 0 10px 0px;" id="rollbacksnapshot" data-id="<?=$product['id'];?>" onclick="rollbacksnapshot"><i class="far fa-folder-open"></i>Rollback Snapshot</button>
                                    <?php ActiveForm::end(); ?>
                                   </div>
                            </div>
                            <?php }?>
                        <?php }?>
                    </div>
                </div>
                <div class="tab-pane" role="tabpanel" id="tab-2">
                    <div class="card-body">
                        <div class="col-12">
                            <h2>Vertragsdokumente</h2>
                            <p>Hier finden Sie alle Dokumente zu Ihren Verträgen bei der Windcloud 4.0 GmbH.</p>
                        </div>
                        <div class="form-group row col-12">
                            <div class="col-1 col-form-label"><a target='_blank' href='/dashboard/pdf-contract?accid=Datum_Kundenname_AVV.pdf' ><img  src="/img/pdf.svg" alt="PDF" style="width:50px;"></a></div>
                            <div class="col-11 col-form-label row">
                                <a  target='_blank' href='/dashboard/pdf-contract?accid=Datum_Kundenname_AVV.pdf' >
                                    <label class="col-12">Vertrag zur Auftragsverarbeitung (AVV)</label>
                                    <div class="col-12">20200206_Kunde_WCD </div>
                                </a>
                            </div>

                        </div>
                        <div class="form-group row col-12">
                            <div class="col-1 col-form-label"> <a  target='_blank' href='/dashboard/pdf-download?file=AGB_Windcloud.pdf' ><img  src="/img/pdf.svg" alt="PDF" style="width:50px;"></a></div>
                            <div class="col-11 col-form-label row">
                                <a  target='_blank' href='/dashboard/pdf-download?file=AGB_Windcloud.pdf' >
                                    <label class="col-12">Allgemeine Geschäftsbedingungen</label>
                                    <div class="col-12">Stand: 06.02.2020</div>
                                </a>
                            </div>
                        </div>
                        <div class="form-group row col-12">
                            <div class="col-1 col-form-label"><a  target='_blank' href='/dashboard/pdf-download?file=Service_Level_Agreement_(SLA).pdf' ><img  src="/img/pdf.svg" alt="PDF" style="width:50px;"></a></div>
                            <div class="col-11 col-form-label row">
                                <a  target='_blank' href='/dashboard/pdf-download?file=Service_Level_Agreement_(SLA).pdf' >
                                    <label class="col-12">Service Level Agreement (SLA)</label>
                                    <div class="col-12">Stand: 06.02.2020</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" role="tabpanel" id="tab-3">
                    <div class="card-body">
                        <div class="col-12">
                            <h2>Kündigung</h2>
                            <p>Hier haben Sie die Möglichkeit Ihren Vertrag zu diesem Produkt zu kündigen.</p>
                        </div>
                        <div class="form-group row col-12">
                            <?php if($product['active'] == 1 ){?>
                                <div class="col-12"><h4 class="alert alert-success">Dieses Produkt ist aktiv.</h4></div>
                            <?php }else{ ?>
                                <div class="col-12"><h4 class="alert alert-danger">Dieses Produkt ist derzeit nicht aktiv.</h4></div>
                            <?php } ?>
                        </div>
                        <div class="form-group row col-12">

                            <?php
                            $paycycle= '+14 day';
                            //$date = new DateTime('NOW');
                            $date = strtotime(date("d.m.Y") . $paycycle);
                            $date = date("d.m.Y",$date);
                            ?>



                            <div class="col-12"><h4>Kündigung zum <?= $date;?></h4></div>
                            <?php if($product['cancellation'] == 0 || $product['cancellation'] == '' ){?>
                                <div class="col-12">
                                    <a href="/dashboard/cancellation?id=<?=$product['id'];?>">
                                        <button class="btn btn-block btn-danger btn-lg" id="cancellation">Kündigung</button>
                                    </a>
                                </div>
                            <?php }else{ ?>
                                <div class="col-12"><h4 class="alert alert-danger">Dieses Produkt ist derzeit als Gekündigt Kennzeichnet.</h4></div>
                            <?php } ?>
                        </div>
                        <div class="form-group row col-12">
                            <div class="col-12">
                                <div class="alert alert-info">
                                    Die Kündigung wird zum nächstmöglichen Zeitpunkt wirksam. Eine Kündigung muss mindestens 14 Tage vor der nächsten Verlängerung des Vertrages eingereicht werden, es sei denn Sie haben einen Tarif mit stundenbasierter Abrechnung gebucht.
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            </div>
</div>
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" data-backdrop="static" aria-hidden="false">
        <div class="modal-dialog modal-lg">

            <div class="modal-content ">
                <div class="modal-header" style="border-bottom:0!important;">
                    <h3 class="vary" id="exampleModalLongTitle" style="text-align: center;width: 100%;padding-left: 10%;">Konfiguration</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="text-align: center;width: 10%;height: 100%;background-color: transparent !important">
                        <span aria-hidden="true" style="font-size: 3rem;">×</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body-loader">
                    <?php $form = ActiveForm::begin(['id' => 'setup-form', 'enableClientValidation' => true]); ?>
                    <label class="col-12 col-form-label">Virtuellen Server Passwort:</label>
                    <div class="col-12">
                    <?= $form
                        ->field($VpsSetup, 'passwort', $fieldOptions2)
                        ->label(false)
                        ->passwordInput(['placeholder' => 'Passwort']) ?>
                    <?= $form
                        ->field($VpsSetup, 'passwortConfirmation', $fieldOptions2)
                        ->label(false)
                        ->passwordInput(['placeholder' => 'Passwort wiederholen']) ?>
                    </div>
                    <?php if(!preg_match("/Windows/",$productname['articleNumber'])){?>


                        <label class="col-12 col-form-label">Optional:</label>
                        <div class="col-12">
                        Public-Key-Authentifizierungs Schlüssel
                            <?= $form->field($VpsSetup, 'sshkey')->textArea(['class' => 'textarea','style'=>'width: 100%;'])->label(false);?>
                        </div>
                    <?php } ?>
                    <div class="pull-left">
                        <?= Html::submitButton('Konfiguration Abschließen', ['class' => 'btn btn-success']);?>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
$this->registerJs("$(function () {
$('.textarea').summernote({
  height: 300, 
  code
}).text()
})");

?>

