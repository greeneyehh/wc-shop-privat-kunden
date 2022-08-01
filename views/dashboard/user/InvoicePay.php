<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>

    <div class="invoice p-3 mb-3">
    <!-- title row -->
    <div class="row">
        <div class="col-12">
            <h4>
                <img width="100px" src="<?= Url::to('@web/image/WIND_Logo_Wort-Bildmarke_vertikal_RGB-768x770.png');?>" alt="Rechenzentrum als 3D-Visual" title="Rechenzentrum | Windcloud 4.0 GmbH">
            </h4>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <b>Rechnung <?=$invoice['invoiceNumber']?></b><br>
            <br>
            <b>Kunden-Nr.:</b> <?=$invoice['customerNumber']?><br>
            </b><br>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Pos.</th>
                    <th>Art.-Nr.</th>
                    <th>Bezeichnung</th>
                    <th>Menge</th>
                    <th>Einheit</th>
                    <th>Preis/Einh €</th>
                    <th>Gesamt €</th>
                </tr>
                </thead>
                <tbody>


                <?php foreach ($invoice['salesInvoiceItems'] as $product): ?>
                    <tr>
                        <td><?=$product['positionNumber']; ?></td>
                        <td><?=$product['articleNumber']; ?></td>
                        <td><?=$product['title']; ?></td>
                        <td><?=$product['quantity']; ?></td>
                        <td><?=$product['unitName']; ?> </td>
                        <td style="text-align: right;"><?= number_format($product['unitPrice'], 2, '.', '') .' €'; ?></td>
                        <td style="text-align: right;"><?= number_format($product['netAmount'], 2, '.', '') .' €'; ?></td>
                    </tr>
                <?php  endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
        <!-- accepted payments column -->
        <div class="col-6">

        </div>
        <!-- /.col -->
        <div class="col-6">

            <div class="table-responsive">
                <table class="table">
                    <tbody><tr>
                        <th style="width:50%">Positionen netto</th>
                        <td style="text-align: right;"><?= number_format($invoice['netAmount'], 2, '.', '') .' €'; ?> </td>
                    </tr>
                    <tr>
                        <th>Positionen USt. 19,00% auf <?= number_format($invoice['netAmount'], 2, '.', '') .' €'; ?></th>
                        <td style="text-align: right;"><?= number_format($invoice['grossAmount'] - $invoice['netAmount'], 2, '.', '')  .' €'; ?> </td>
                    </tr>

                    <tr>
                        <th>Endsumme</th>
                        <td style="text-align: right;"><?= number_format($invoice['grossAmount'], 2, '.', '') .' €'; ?></td>
                    </tr>
                    </tbody></table>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-12">
            <?php $form = ActiveForm::begin(['method' => 'post']); ?>
            <div class="hiddenradio">
                <h3>Zahlungsmittel wählen</h3>
                <?= $form->field($PaymentPostModel, 'brand')->inline()->radioList( $vrpaybrands, ['encode' => false],['class'=>'checkbox-tools'])->label(false)?>
            </div>

            <div class="row" style="padding-bottom: 60px;">
                <div class="col-md-6 col-sm-6 col-xs-6 left" >
                    <?= $form->field($PaymentPostModel, 'cart')->hiddenInput(['value'=> json_encode(number_format($invoice['grossAmount'], 2, '.', ''))])->label(false);?>
                    <?= $form->field($PaymentPostModel, 'account')->hiddenInput(['value'=> $invoice['customerNumber'] ])->label(false);?>

                    <a href="/dashboard/rechnungen" class="border mobile-fill anim-1 show">Abbrechen</a>

                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 right" >
                    <?= $form->field($PaymentPostModel, 'cart')->hiddenInput(['value'=> json_encode(number_format($invoice['grossAmount'], 2, '.', ''))])->label(false);?>
                    <?= $form->field($PaymentPostModel, 'account')->hiddenInput(['value'=> $invoice['customerNumber'] ])->label(false);?>

                    <?= Html::submitButton('bezahlen', ['class' => 'border mobile-fill anim-1 btn-ajax-modal show', 'name' => 'buy', 'value'=> 'true']) ?>
                </div>

            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<?php
$this->registerCssFile("/css/cms/style-summary.css");
?>
