<style>
    body {

        font-family: 'Ubuntu', sans-serif !important;

    }


</style>
<table id="tableopenbill" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="openrechnung_info">
    <thead>
    <tr>
        <th width="5%">Status</th>
        <th width="35%">Rechnungsnummer</th>
        <th width="35%">Datum</th>
        <th width="25%">Betrag</th>

    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($invoice['result'] as $invoices): ?>
    <?php if($invoices['status'] != "VOID"){?>

            <tr>
                <th width="5%" style="font-weight: normal; text-align: center;"><a  target='_blank' href='/dashboard/pdf-invoice?id=<?=$invoices['id'];?>' ><i class='far fa-file-pdf'></i></a> </th>
                <th width="35%" style="font-weight: normal; text-align: center;"><?= $invoices['invoiceNumber'] ?></th>
                <th width="35%" style="font-weight: normal; text-align: center;"><?=  date("d.m.Y", $invoices['createdDate']/1000) ?></th>
                <th width="25%" style="font-weight: normal; text-align: center;"><?= number_format($invoices['grossAmountInCompanyCurrency'], 2, '.', '') .' Euro'; ?></th>
            </tr>

   <?php }?>


    <?php endforeach; ?>
    </tbody>
</table>

