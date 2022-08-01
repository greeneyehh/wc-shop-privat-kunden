<?php

use yii\helpers\Html;

?>
<div class="card" id="stepfive">
    <div class="card-header border-radius-d cart-card-addon" style="text-align: center;">
        <h3 class="vary"><?php if($slug == "vps"){
            echo "IHRE VPS KONFIGURATION";
        }elseif ($slug == "managed-nextcloud"){
            echo "IHRE MANAGED NEXTCLOUD";
        }
        ?></h3>
    </div>
    <div class="card-body row">


        <table class="table">
            <tbody>
            <?php $summe=0;
            foreach ($tempcat as $products):

                if (isset($products['price'])){
                    $summe+= $products['price'];
                }
                ?>
            <tr>
                <td><span class="pad"> <?php if(isset($products['name'])){
                                echo $products['name'];
                        };?></span></td>
                <td class="right"> <?php if (isset($products['price'])){echo number_format($products['price'], 2, '.', '') .' €';}?>
                </td>
            </tr>
            <?php  endforeach; ?>
            </tbody>
        </table>




                <table class="table summe">
                    <tbody><tr>
                        <td style="color: #004477;font-weight: bold;">Bestellwert: </td>
                        <td style="color: #004477;font-weight: bold;"><?= number_format($summe, 2, '.', '');?>  €</td>
                    </tr>
                    <tr style="border-top: 1px solid white;">
                        <td style="color: #004477;">Gesamtsumme:<br>
                            (inkl. MwSt.)</td>
                        <td style="color: #004477;"><?= number_format($summe + $summe *Yii::$app->params['STEUERSATZ'] , 2, '.', '');?> € (inkl. MwSt.)</td>
                    </tr>
                    </tbody></table>



        <?= Html::submitButton('In den Warenkorb',
            ['style'=>'vertical-align: bottom; width: 100%;',
                'class' => 'border mobile-fill anim-1 show align-self-end step-four',
                'data-id'=>"vps",'data-slug'=>$slug]);
        ?>



    </div>
</div>


<?php

$this->registerJs("
$('.step-four').click(function(event) {
	var produktdata ={};
	var array= $(this).data();
	for (var prop in array) {
		produktdata[prop]= array[prop];
	}
    $.ajax({
      type: 'POST',
      url: '/wizard/two-cart',
      data:  produktdata,
      success: function (response) {
      $('#stepfive').remove();
      $('#wizard').append(response);
      location.href = '#stepfour';
      }
    });
    window.scroll({
  behavior: 'smooth'
});
    
});");
?>
