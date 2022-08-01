<div>
    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link active" role="tab" data-toggle="tab" href="#tab-1">Übersicht</a></li>
        <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#tab-2">Vertragliches</a></li>
        <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#tab-3">Kündigung</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" role="tabpanel" id="tab-1">
            <div class="card-body">
            <div class="col-12">
            <h2>Übersicht</h2>
                <p>Hier finden Sie eine Übersicht der wichtigsten Details zu Ihrem Produkt.</p>
                <?php if($product['active'] == 0 ){?>
                <div class="btn btn-block btn-danger btn-lg">Dieses Produkt ist derzeit nicht aktiv.</div>
                <?php } ?>

        </div>
        <div class="form-group row col-12">
            <label class="col-12 col-form-label">Account-Bezeichnung:</label>
            <div class="col-12 col-form-label"><?=$product['productid'];?> | <?=$product['id'];?></div>
        </div>
        <div class="form-group row col-12">
            <label class="col-12 col-form-label">URL zum Verwaltungspanel:</label>
            <div class="col-12">
                <a target="_blank" href="<?=$product['domain'];?>"><?=$product['domain'];?></a>
            </div>
        </div>
        <div class="form-group row col-12">
            <label class="col-12 col-form-label">Login-Name im Verwaltungspanel:</label>
            <div class="col-12 col-form-label row"><div class="col-4">Ihr Benutzernamen:</div><div class="col-8">



                    <?php if( preg_match("/Start/",$productname['name'])){?>
                        <?=$product['username'];?>
                    <?php }else{ ?>
                        admin
                    <?php } ?>



                </div></div>
            <div class="col-12 col-form-label row"><div class="col-4">Ihr Initialpasswort:</div><div class="col-8"><?=$product['initialpasswort'];?></div></div>
        </div>
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
                    $date = strtotime(date("d.m.Y") . $paycycle);
                    $date = date("d.m.Y",$date);
                   ?>
                   <div class="col-12"><h4>Kündigung zum <?= $date;?></h4></div>
                   <?php if($product['cancellation'] == 0 || $product['cancellation'] == '' ){?>

                   <div class="col-12"><button class="btn btn-block btn-danger btn-lg" id="cancellation" data-id="<?=$product['id'];?>" onclick="cancellation">Kündigung</button></div>
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
<?php
$this->registerJs("
    $('#cancellation').click(function() {
        target = '#variant-modal';
        ajax_body = '/ajax/cancellation?id='+$(this).data('id');
    $(target).modal('show')
        .find('.modal-body')
        .load(ajax_body);
    });
");
?>

