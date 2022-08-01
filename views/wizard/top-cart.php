<table class="table">
    <tbody>
    <?php
    $summe=0;
    foreach ($tempcat as $key =>$products):
        if (isset($products['price'])){
            $summe+= $products['price'];
        }
        ?>


    <tr>
        <td>
                <?php if ($key =="StepOne"){
                    echo '<h3 class="vary" style="text-align: center;font-size: 1.5rem">'.$products['name'].'</h3>';
                }else{
                    echo '<h3 class="vary" style="text-align: center;font-size: 0.5rem">'.$products['name'].'</h3>';
                }
                ?></td>
        <td class="right">

            <?php if ($key !="StepOne"){
            if (isset($products['price'])){echo number_format($products['price'], 2, '.', '') .' €';}
            }?>
        </td>

    </tr><?php  endforeach;?>
    </tbody>
</table>



        <table style="width:100%">
            <tbody><tr>
                <td style="color: #004477;font-weight: bold;">Bestellwert: </td>
                <td style="color: #004477;font-weight: bold;"><?= number_format($summe, 2, '.', '');?>  €</td>
            </tr>
            <tr style="border-top: 1px solid white;">
                <td style="color: #004477;">Gesamtsumme:<br>
                    (inkl. MwSt.)</td>
                <td style="color: #004477;"><?= number_format($summe + $summe *Yii::$app->params['STEUERSATZ'] , 2, '.', '');?> € (inkl. MwSt.)</td>
            </tr>
            </tbody>
        </table>
