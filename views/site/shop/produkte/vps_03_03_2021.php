<?php

$this->title = Yii::$app->name;
use yii\helpers\Html;
use yii\helpers\Url;
use app\module\CartModal\CartModalWidget;
use app\extensions\greendev\weclapp\widgets\variantArticleWidgets;

?>
    <div class="container">

        <div class="kachelanimation">
            <div class="netz d-none d-md-block">
                <img class="net" src="<?= Url::to('@web/image/Windcloud-net-768x543.png');?>" title="Windcloud Netz">
            </div>
            <div class="raute"></div>
            <div class="kacheln">
                <div class="big-tile move-in-3">
                    <div class="levitate-5">
                        <img src="<?= Url::to('@web/image/Windcloud-Rechenzentrum-768x543.png');?>" alt="Rechenzentrum als 3D-Visual" title="Rechenzentrum | Windcloud 4.0 GmbH">
                    </div>
                    <div class="box"><div class="trans"></div></div>
                </div>
            </div>
        </div>

        <div id="hero" class="row">
            <div class="col-8 col-md-6 mb-5">
                <h1>Nachhaltige VPS-Lösungen</h1>
                <h2 class="vary">VIRTUAL PRIVATE SERVER</h2>
                <p class="d-none d-md-block"><strong>Vorteile unserer Virtuellen Server</strong></p>
                <ul class="mb-4">
                    <li>SSD-Speicher</li>
                    <li>Linux oder Windows</li>
                    <li>Leistungsstarke Hardware</li>
                    <li>Klimafreundlich</li>
                    <li>Hochverfügbar</li>
                </ul>
            </div>

        </div>

        <img class="shadow-line" src="<?= Url::to('@web/image/schatten.png');?>" alt="shadow-line">

        <div class="d-md-block">
            <h3 class="text-center mb-4">UNSER VPS-ANGEBOT</h3>
        </div>


                <div class="row">
                    <div class="col-12 col-sm-6 col-md-12 col-lg-12" >
                        <div class="bg-c-turkis border-radius-d mb-4 pad">
                            <div class="row align-items-center">
                                <div class="col-12 col-lg-8 mb-4">
                                    <h3 style="color: #FFFFFF"><?=$model['result']['2']['name'];?></h3>
                                    <ul>
                                        <?= $model['result']['2']['description'];?>
                                    </ul>
                                </div>
                                <div class="col-12 col-lg-4 text-center">
                                     <h4 style="color: #FFFFFF">ab <?=$model['result']['2']['articlePrices']['0']['price'];?> € / Monat</h4>
                                    <strong style="font-size: 1rem">Ab <?php echo $model['result']['2']['articlePrices']['0']['price'] + $model['result']['2']['articlePrices']['0']['price']*Yii::$app->params['STEUERSATZ'];?> € inkl. <?= Yii::$app->params['STEUERSATZTEXT'];?> MwSt.</strong>
                                    <br>
                                    <?php
                                    $variant= json_decode(variantArticleWidgets::widget(['id' => $model['result']['2']['id']]),true);
                                    if(empty($variant["result"])){
                                        echo Html::submitButton('In den Warenkorb', ['class' => 'border mobile-fill anim-1 show', 'style'=>'width: 100%;', 'id' => 'button-'.$model['result']['2']['id'] ,'name' => 'productid-'.$model['result']['2']['id'] ,'data-id'=>$model['result']['2']['id'],'data-name'=>$model['result']['2']['name'],'data-DomainExtension'=>'' ,'data-weclapp' => '1' ,'data-price' =>$model['result']['2']['articlePrices']['0']['price'] , 'data-extensionAllowed'=> ($model['result']['2']['shortDescription1'] == 'addon') ? '1' : '0']);
                                    }else{
                                        echo Html::a('Zur Auswahl', [ Url::to('/ajax/vps-variant?id='.$model['result']['2']['id'])],['class' => 'border mobile-fill anim-1 btn-ajax-modal show', 'style'=>'width: 100%;', 'data-toggle'=> 'modal','data-target'=> '#variant-modal','value' => Url::to('/ajax/vps-variant?id='.$model['result']['2']['id'])]);
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <div class="row">

            <?php foreach ($model['result'] as $key => $products): ?>
            <?php if($key != 2){?>
                    <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                        <div class="bg-darkblue border-radius-d adjust-h">
                            <div class="p-3" style="text-align: center;">
                                <h3><?=$products['name'];?></h3>
                                <?= $products['description'];?>
                                <strong style="color: #ffffff !important">ab <?=$products['articlePrices']['0']['price'];?> € / Monat</strong><br>
                                <strong style="font-size: 0.8rem;margin-bottom: 0.5rem">Ab <?php echo$products['articlePrices']['0']['price'] + $products['articlePrices']['0']['price']*Yii::$app->params['STEUERSATZ'];?> € inkl. <?= Yii::$app->params['STEUERSATZTEXT'];?> MwSt.</strong>
                                <br><br>
                                <?php
                                $variant= json_decode(variantArticleWidgets::widget(['id' => $products['id']]),true);
                                if(empty($variant["result"])){
                                    echo Html::submitButton('In den Warenkorb', ['class' => 'border mobile-fill anim-1 add-to-cart show', 'id' => 'button-'.$products['id'] ,'name' => 'productid-'.$products['id'] ,'data-id'=>$products['id'],'data-name'=>$products['name'],'data-DomainExtension'=>'' ,'data-weclapp' => '1' ,'data-price' =>$products['articlePrices']['0']['price'] , 'data-extensionAllowed'=> ($products['shortDescription1'] == 'addon') ? '1' : '0']);
                                }else{
                                    echo Html::submitButton('Zur Auswahl', ['class' => 'border mobile-fill anim-1 btn-ajax-modal show', 'data-toggle'=> 'modal','data-target'=> '#variant-modal','value' => Url::to('/ajax/vps-variant?id='.$products['id']),]);
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php }  endforeach; ?>
        </div>

        <div class="d-md-block">
            <h3 class="text-center  m-5">VIRTUELLE SERVER VON WINDCLOUD</h3>
        </div>

        <div class="column-count margin-b">
            <p>
                Unser grünes vServer-Angebot ist nicht nur besonders klimafreundlich, sondern bietet Ihnen auch die passende Leistung und Flexibilität für Ihre Anwendung. Wir bieten Ihnen verschiedene Betriebssysteme. Zur Auswahl stehen Ihnen Windows und gängigen Linux-Distributionen, wie Debian, CentOS und Ubuntu zur Verfügung. Als Controlpanel können Sie unter anderem Plesk nutzen.
                <br><br>
                Unsere VPS virtualisieren wir auf Dell-Hardware. Durch Speicherung auf SSD-Festplatten haben Sie immer schnellen Zugriff auf Ihre Daten. Optional können Sie eine Backup-Möglichkeit zu Ihrem Virtuellen Server dazu buchen.
                <br><br>
                In unserem nach EN 50600 VK3-zertifizierten Rechenzentrum C1 in Nordfriesland sind Ihre Daten und Workloads sicher und DSGVO-konform aufgehoben. Zudem betreiben unser VPS-Angebot konsequent nachhaltig. Unser Rechenzentrum versorgen wir zu 100% mit physikalisch echtem Grünstrom und verdeln die entstehende Abwärme direkt vor Ort.
            </p>
        </div>

    </div>

    <div class="spacer-image background-1"></div>

    <div class="container">

        <div class="bg-c-white border-radius-d margin-b pad">
            <h3 class="text-center mb-4">SICHERHEIT UNSER VIRTUAL PRIVATE SERVER</h3>
            <div class="column-count">
                <ul>
                    <li>Eigenes hochverfügbares Rechenzentrum</li>
                    <li>Unternehmens- und Rechenzentrumssitz Deutschland</li>
                    <li>Zertifizierungen EN 50600 VK 3 und ISO 27001</li>
                    <li>DSGVO-konform</li>
                    <li>Web Application Firewall</li>
                    <li>Schutz vor DDoS-Attacken</li>
                    <li>Verfügbarkeit 99,95%</li>
                </ul>
            </div>
        </div>

        <div class="bg-c-darkblue border-radius-d mt-5 margin-b">
            <img class="img-xtra d-none d-lg-block" src="<?= Url::to('@web/image/Windcloud-treibhaus.png');?>" alt="Treibhaus">
            <div class="col-12 col-lg-9 mb-4">
                <h3>Klimafreundliche vServer aus Norddeutschland</h3>
                <br>
                <p class="mb-5">
                    Unsere vServer sind nicht nur sicher und leistungsstark, sondern auch besonders klimafreundlich. Der Strom für unsere Rechenzentren ist zu 100% physikalisch grün und kommt größtenteils aus lokalen Windparks. Darüber hinaus veredeln wir die Abwärme unserer Server mit Partnern direkt vor Ort.
                </p>
                <a class="border mobile-fill anim-1 show" href="javascript:">Mehr erfahren</a>
            </div>
        </div>

        <div class="d-md-block margin-b">
            <div class="row">

                <div class="col-12 col-md-4 mb-4 text-center icons">
                    <img  src="<?= Url::to('@web/image/Windcloud_Icon-Deutschland.svg');?>" alt="Deutsches Rechenzentrum">
                    <p><strong>DEUTSCHES<br>RECHENZENTRUM</strong> </p>
                </div>

                <div class="col-12 col-md-4 mb-4 text-center icons">
                    <img  src="<?= Url::to('@web/image/Windcloud_Icon-Nachhaltig.svg');?>" alt="Nachhaltigkeit">
                    <p><strong>100%<br> GRÜNER STROM</strong></p>
                </div>

                <div class="col-12 col-md-4 mb-4 text-center icons">
                    <img src="<?= Url::to('@web/image/Windcloud_Icon-Zertifizierung.svg');?>" alt="SSL verschlüsselt">
                    <p><strong>EN 50600<br>ZERTIFIZIERUNG</strong></p>
                </div>

            </div>
        </div>
        <?= CartModalWidget::widget() ?>
        <div class="modal fade " id="variant-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" data-backdrop="static" aria-hidden="true" >
            <div class="modal-dialog modal-xl" style="background-color: #f6f6f6;" role="document">
                <div class="modal-content" style="background-color: #f6f6f6!important;border-radius: 0!important;" >
                    <div class="modal-header" style="border-bottom:0!important;">
                        <h3 class="vary" id="exampleModalLongTitle" style="text-align: center;width: 100%;padding-left: 10%;">OPTION WÄHLEN</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="text-align: center;width: 10%;height: 100%;background-color: transparent !important">
                            <span aria-hidden="true" style="font-size: 3rem;">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modal-body-loader">

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
$this->registerJs("$('.btn-ajax-modal').click(function (){

$('#exampleModalLongTitle').text('VIRTUAL PRIVATE SERVER KONFIGURATOR');
    $('#modal-body-loader' ).html( '<div class=\"row\"><div class=\"col-12\"><div class=\"overlay loadingcolor\"><i class=\"fa fa-refresh fa-spin fa-3x fa-fw loadingcolor\"></i></div></div></div>' );
    var elm = $(this),
        target = elm.attr('data-target'),
        ajax_body = elm.attr('value');
    $(target).modal('show')
    .find('.modal-body')
    .load(ajax_body);
        
});");
$this->registerJs("$('#carousel-items').on('slide.bs.carousel', function (e) {
    /*
        CC 2.0 License Iatek LLC 2018 - Attribution required
    */
    // console.log(\"click\");
               
    var d = $(e.relatedTarget);
    var idx = d.index();
    var itemsPerSlide = 4;
    var totalItems = $('.carousel-item').length;
 
    if (idx >= totalItems-(itemsPerSlide-1)) {
        var it = itemsPerSlide - (totalItems - idx);
        for (var i=0; i<it; i++) {
            // append slides to end
            if (e.direction==\"left\") {
                $('.carousel-item').eq(i).appendTo('.carousel-inner');
               //console.log(\"left\");
            }
            else {
               $('.carousel-item').eq(0).appendTo('.carousel-inner');
               //console.log(\"right\");
            }
        }
    }
    
});");
$this->registerCssFile("@web/css/cms/style-vps-3.css");
?>