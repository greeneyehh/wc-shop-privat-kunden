<?php

$this->title = Yii::$app->name;
use yii\helpers\Html;
use yii\helpers\Url;
use app\module\CartModal\CartModalWidget;
use app\extensions\greendev\weclapp\widgets\variantArticleWidgets;

?>
    <div class="container">


        <div id="hero" class="row">
            <div class="col-8 col-lg-5">
                <h1>Speichern, teilen und bearbeiten</h1>
                <h2 class="vary">MANAGED<br>NEXTCLOUD</h2>
                <p class="d-none d-md-block"><strong>Vorteile unserer Nextcloud</strong></p>
                <ul class="mb-4">
                    <li>100 % CO2-frei</li>
                    <li>3-fach redundant gesichert</li>
                    <li>DSGVO-konform</li>
                    <li>ISO27001-zertifiziert</li>
                    <li>Deutsches Rechenzentrum</li>
                </ul>
                <a class="border mobile-fill anim-1 show" href="#managed-nextcloud">Direkt starten!</a>
            </div>
            <div class="col mb-4">
                <div class="pic">
                    <div class="diamond top"><div class="box"><div class="trans"></div></div></div>
                    <img class="net" srcset="<?= Url::to('@web/image/Windcloud-net.png');?>  2000w, <?= Url::to('@web/image/Windcloud-net-300x212.png');?>  300w, <?= Url::to('@web/image/Windcloud-net-768x543.png');?>  768w, <?= Url::to('@web/image/Windcloud-net-1024x724.png');?>  1024w, <?= Url::to('@web/image/Windcloud-net-1200x848.png');?>   1200w" sizes="(min-width: 1200px) 540px, (min-width: 992px) 450px, (min-width: 768px) 330px, (min-width: 576px) 510px, calc(100vw - 30px)" src="<?= Url::to('@web/image/Windcloud-net-1024x724.png');?> " title="Windcloud-net" alt="Netz">

                    <div class="big-tile move-in-3">
                        <div class="img-tile levitate-5">
                            <div class="img">
                                <img srcset="<?= Url::to('@web/image/Windcloud-Rechenzentrum.png');?>  4960w, <?= Url::to('@web/image/Windcloud-Rechenzentrum-300x212.png');?> 300w, <?= Url::to('@web/image/Windcloud-Rechenzentrum-768x543.png');?> 768w, <?= Url::to('@web/image/WWindcloud-Rechenzentrum-1024x724.png');?> 1024w, <?= Url::to('@web/image/Windcloud-Rechenzentrum-1200x848.png');?>  1200w" sizes="(min-width: 1200px) 445px, (min-width: 992px) 370px, (min-width: 768px) 270px, (min-width: 576px) 420px, calc(83vw - 30px)" src="<?= Url::to('@web/image/Windcloud-Rechenzentrum-1024x724.png');?>" alt="Rechenzentrum als 3D-Visual" title="Rechenzentrum | Windcloud 4.0 GmbH">          </div>
                            <div class="box"><div class="trans"></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <img class="shadow-line" src="<?= Url::to('@web/image/schatten.png');?>" alt="shadow-line">

        <div class="d-md-block">
            <h3 class="vary mb-4">HOCHVERF??GBAR UND<br>LEICHT ZU BEDIENEN</h3>
        </div>
        <div class="column-count margin-b" id="managed-nextcloud">
            <p>
                Speichern, verwalten und bearbeiten Sie Ihre Daten flexibel und ??bersichtlich in der Cloud und bestimmen Sie selbst, wer welche Zugriffsrechte hat.
                Sie behalten die volle Kontrolle. Die Bedienung Ihrer Nextcloud ist ganz einfach - Sie brauchen keine Expertenkenntnisse. Alle Updates ??bernehmen wir f??r Sie.
                Ihre Nextcloud betreiben wir ausschlie??lich in unseren ISO 27001-zertifizierten und CO2-neutralen Rechenzentren in Schleswig-Holstein.
                Zur Einhaltung Ihrer Compliance-Richtlinien bieten wir Ihnen zudem ein gepr??ftes DSGVO-konformes Vertragswerk.
                Wir garantieren Ihnen Datenschutz nach deutschem und europ??ischem Recht
            </p>
        </div>

        <div class="d-md-block margin-b">
            <div class="row">
                
                <?php foreach ($model['result'] as $products): ?>
                    <?php
                    if(!in_array("shortDescription1", $products))
                    {
                        array_push($products, "shortDescription1");
                    }
                    if(!isset($products['shortDescription2']))
                    {
                        array_push($products, "shortDescription2");
                        $products['shortDescription2'] = null;
                    }
                    ?>
                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                        <div class="bg-darkblue border-radius-d box-shadow adjust-h">
                            <div class="p-3">
                                <h3 class="vary" style="min-height: 29px;"><?=$products['name']?></h3>
                                <p><?= $products['description'];?><strong style="color: #ffffff !important">Ab <?=$products['articlePrices']['0']['price'];?>  ??? / <?=(preg_match("/J??hrlich/",$products['shortDescription2'])) ? 'Jahr': 'Monat' ?></strong><br>
                                    <strong style="font-size: 1rem">Ab <?php echo$products['articlePrices']['0']['price'] + $products['articlePrices']['0']['price']*Yii::$app->params['STEUERSATZ'];?> ??? inkl. <?= Yii::$app->params['STEUERSATZTEXT'];?> MwSt.</strong></p>

                                <?php
                                $variant= json_decode(variantArticleWidgets::widget(['id' => $products['id']]),true);
                                if(empty($variant["result"])){
                                    echo Html::submitButton('In den Warenkorb', ['class' => 'border mobile-fill anim-1 add-to-cart show', 'id' => 'button-'.$products['id'] ,'name' => 'productid-'.$products['id'] ,'data-id'=>$products['id'],'data-name'=>$products['name'],'data-DomainExtension'=>'' ,'data-weclapp' => '1' ,'data-price' =>$products['articlePrices']['0']['price'] , 'data-extensionAllowed'=> ($products['shortDescription1'] == 'addon') ? '1' : '0']);
                                }else{
                                    echo Html::submitButton('zur Auswahl', ['class' => 'border mobile-fill anim-1 btn-ajax-modal show', 'data-toggle'=> 'modal','data-target'=> '#variant-modal','value' => Url::to('/ajax/variant?id='.$products['id']),]);
                                }
                                ?>


                            </div>
                        </div>
                    </div>

                <?php  endforeach; ?>





            </div>
        </div>

        <div class="bg-c-white border-radius-d margin-b pad">
            <h3 class="vary mb-4">SICHERHEIT</h3>
            <div class="column-count">
                <ul>
                    <li>Eigenes hochsicheres Rechenzentrum in <br>Schleswig-Holstein</li>
                    <li>Vertrag zur Auftragsdatenverarbeitung (ADV)</li>
                    <li>Privater virtueller Server ab Tarif 'Brise'</li>
                    <li>SSL-Verschl??sselung der Daten??bertragung</li>
                    <li>3-fach-redundante CEPH-Datenspeicherung auf lokal verschl??sselten Datentr??gern</li>
                    <li>Zwei-Faktor-Authentifizierung (2FA) m??glich</li>
                </ul>
            </div>
        </div>

        <div class="d-md-block margin-b">
            <div class="row">

                <div class="col-12 col-md-3 mb-3 text-center icons">
                    <img height="150px" src="<?= Url::to('@web/image/Windcloud_Icon-Deutschland.svg');?>" alt="Deutsches Rechenzentrum">
                    <p>DEUTSCHES RECHENZENTRUM</p>
                </div>

                <div class="col-12 col-md-3 mb-3 text-center icons">
                    <img height="150px" src="<?= Url::to('@web/image/Windcloud_Icon-SSL.svg');?>" alt="SSL verschl??sselt">
                    <p>SSL VERSCHL??SSELT</p>
                </div>

                <div class="col-12 col-md-3 mb-3 text-center icons">
                    <img height="150px" src="<?= Url::to('@web/image/Windcloud_Icon-DSGVO.svg');?>" alt="DSGVO konform">
                    <p>DSGVO KONFORM</p>
                </div>
                <div class="col-12 col-md-3 mb-3 text-center icons">
                    <img height="150px" src="<?= Url::to('@web/image/Windcloud_Icon-Nachhaltig.svg');?>" alt="100 % gr??ner Strom">
                    <p>100 % GR??NER STROM</p>
                </div>
            </div>
        </div>

        <div class="slider bg-c-darkblue border-radius-d margin-b">

            <div id="carousel-slider" class="carousel slide" data-ride="carousel">

                <ol class="carousel-indicators">
                    <li data-target="#carousel-slider" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-slider" data-slide-to="1"></li>
                    <li data-target="#carousel-slider" data-slide-to="2"></li>
                    <li data-target="#carousel-slider" data-slide-to="3"></li>
                    <li data-target="#carousel-slider" data-slide-to="4"></li>
                </ol>

                <div class="carousel-inner">
                    <br>
                    <p class="text-center">Nextcloud-Funktionen im ??berblick</p>
                    <h3 class="vary mb-4">MEHR ALS NUR CLOUD STORAGE</h3>

                    <div class="carousel-item row justify-content-center align-items-center active" style="min-height: 230px;">
                        <div class="bg-c-darkblue border-radius-d pad">
                            <div class="col-12">
                                <div class="row align-items-center">
                                    <div class="col-12 col-lg-6 mb-4">
                                        <img src="<?= Url::to('@web/image/cloud-screen-01.jpg');?>" alt="Cloud Screen">
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <strong class="mb-2">Daten einfach speichern und teilen:</strong>
                                        <ul>
                                            <li>Alle Dateien und Ordner auf einen Blick</li>
                                            <li>Dateien mit anderen Nextcloud-Nutzern oder extern teilen</li>
                                            <li>Gruppen anlegen und Zugriffsrechte dediziert verteilen</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item row justify-content-center align-items-center" style="min-height: 230px;">
                        <div class="bg-c-darkblue border-radius-d pad">
                            <div class="col-12">
                                <div class="row align-items-center">
                                    <div class="col-12 col-lg-6 mb-4">
                                        <img src="<?= Url::to('@web/image/cloud-screen-02.jpg');?>" alt="Cloud Screen">
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <strong class="mb-2">E-Mail, Kalender und Kontakte einbinden:</strong>
                                        <ul>
                                            <li>Nextcloud als E-Mail Client nutzen</li>
                                            <li>Kontakte speichern und verwalten</li>
                                            <li>Eine Vielzahl von Kalendern einbinden und den ??berblick behalten</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item row justify-content-center align-items-center" style="min-height: 230px;">
                        <div class="bg-c-darkblue border-radius-d pad">
                            <div class="col-12">
                                <div class="row align-items-center">
                                    <div class="col-12 col-lg-6 mb-4">
                                        <img src="<?= Url::to('@web/image/cloud-screen-03.jpg');?>" alt="Cloud Screen">
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <strong class="mb-2">Nextcloud-Apps f??r noch mehr Funktionen:</strong>
                                        <ul>
                                            <li>Viele Apps direkt verf??gbar</li>
                                            <li>Ab Tarif ???Brise??? Apps selber installieren</li>
                                            <li>Gro??e Auswahl an Apps, bspw. zur sicheren Passwort-Verwaltung</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item row justify-content-center align-items-center" style="min-height: 230px;">
                        <div class="bg-c-darkblue border-radius-d pad">
                            <div class="col-12">
                                <div class="row align-items-center">
                                    <div class="col-12 col-lg-6 mb-4">
                                        <img src="<?= Url::to('@web/image/cloud-screen-04.jpg');?>" alt="Cloud Screen">
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <strong class="mb-2">Office-Dokumente gemeinsam online bearbeiten:</strong>
                                        <ul>
                                            <li>Mit der integrierten App OnlyOffice</li>
                                            <li>Dokumente, Tabellen und Pr??sentationen im Browser bearbeiten</li>
                                            <li>Zusammen als Team an einem Dokument arbeiten</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item row justify-content-center align-items-center" style="min-height: 230px;">
                        <div class="bg-c-darkblue border-radius-d pad">
                            <div class="col-12">
                                <div class="row align-items-center">
                                    <div class="col-12 col-lg-6 mb-4">
                                        <img src="<?= Url::to('@web/image/cloud-screen-05.jpg');?>" alt="Cloud Screen">
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <strong class="mb-2">Nextcloud auf Desktop und Smartphone:</strong>
                                        <ul>
                                            <li>Clients f??r Windows, Apple und Linux verf??gbar</li>
                                            <li>Apps f??r Android und iOS f??r Zugriff ??bers Smartphone</li>
                                            <li>Automatische Synchronisation Ihrer Daten</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <a class="carousel-control-prev" href="#carousel-slider" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon blue" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>

                <a class="carousel-control-next" href="#carousel-slider" role="button" data-slide="next">
                    <span class="carousel-control-next-icon blue" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>

            </div>
        </div>

        <div class="d-md-block">
            <h3 class="vary mb-4">100 % CO2-FREI DATEN<br>IN DER CLOUD SPEICHERN</h3>
        </div>
        <div class="margin-b">
            <p>
                Managed Nextcloud ist die nachhaltige L??sung f??r Kunden, die neben h??chster Datensicherheit, eine funktionale und simpel zu bedienende Cloud-L??sung suchen, die zu 100 % klimafreundlich ist. Unseren eigenen Anspruch an Nachhaltigkeit garantieren wir durch folgende Ma??nahmen:
            </p>
        </div>
        <div class="blockImgTxt row margin-b">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-lg-5">
                        <img src="<?= Url::to('@web/image/Windcloud-windraeder-768x543.png');?>" alt="Windcraft">
                    </div>
                    <div class="col-12 col-lg-7">
                        <p class="mb-2"><strong>CO2-frei:</strong>  Unsere Cloud-L??sungen sind durch den Bezug von 100 % physikalisch gr??nen Strom CO2-frei.</p>
                        <p class="mb-2"><strong>Erneuerbare Energie:</strong> An unserem Standort Nordfriesland (Schleswig-Holstein) nutzen wir Strom direkt aus lokalen Erneuerbaren Energiequellen.</p>
                        <p class="mb-2"><strong>Abw??rme-Veredelung:</strong> Wir veredeln die Abw??rme unserer Server direkt in einer ans Rechenzentrum angeschlossenen Algenfarm.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-md-block">
            <h3 class="vary mb-4">FAQ</h3>
        </div>

        <div class="row margin-b">
            <div class="col-12 mx-auto">
                <div class="accordion" id="faqExample">
                    <div>
                        <div class="card-header p-2" id="headingOne">
                            <p class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Wie lange dauert die Bereitstellung meiner Managed Nextcloud?
                                </button>
                            </p>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#faqExample">
                            <div class="card-body">
                                Die Bereitstellung Ihrer Nextcloud dauert werktags maximal 24 Stunden. In der Regel steht Ihnen die Nextcloud aber schneller zur Verf??gung. Sobald Ihre Nextcloud fertig eingerichtet ist, erhalten Sie eine E-Mail mit Zugangsdaten und k??nnen dann direkt starten.
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="card-header p-2" id="headingTwo">
                            <p class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Wie sicher sind meine Daten in der Managed Nextcloud?
                                </button>
                            </p>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqExample">
                            <div class="card-body">
                                Ihre Daten sch??tzen wir in der Nextcloud mit verschiedenen Ma??nahmen vor unbefugtem Zugriff und Verlust. So speichern wir Ihre Daten ausschlie??lich auf CEPH-Datenspeichern, auf denen Ihre Daten zu jeder Zeit 3-fach redundant gesichert sind. Die Daten??bertragung erfolgt verschl??sselt ??ber SSL. Zudem setzen wir nur modernste Hardware in unserem eigenen hochverf??gbaren Rechenzentrum f??r den Betrieb Ihrer Nextcloud ein. Optional k??nnen Sie noch eine Zwei-Faktor-Authentifizierung (2FA) in Ihrer Nextcloud aktivieren.
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="card-header p-2" id="headingThree">
                            <p class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Wo werden meine Daten gespeichert?
                                </button>
                            </p>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faqExample">
                            <div class="card-body">
                                Wir speichern Ihre Daten ausschlie??lich in unserem CO2-freien Rechenzentren in Nordfriesland / Schleswig-Holstein. Das Rechenzentrum ist EN 50600 VK 3 zertifiziert und besitzt damit die zweith??chste Verf??gbarkeitsklasse (hochverf??gbar). Das Rechenzentrum hat eine redundante Stromversorgung und eine automatische Brandmelde- und L??schanlage. Zudem ist es geographisch mehrfach redundant ans Glasfasernetz angebunden.
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="card-header p-2" id="headingFour">
                            <p class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Ist die Managed Nextcloud DSGVO-konform?
                                </button>
                            </p>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingThree" data-parent="#faqExample">
                            <div class="card-body">
                                Ja, die Windcloud 4.0 GmbH hat sowohl ihren Firmensitz als auch alle Rechenzentrumsstandorte in Deutschland und stellt seinen Kunden ausschlie??lich DSGVO-konforme Produkte zur Verf??gung. Wir bieten Ihnen zudem ein DSGVO-konformes Vertragswerk, etwa einen Auftragsverarbeitungsvertrag (AVV), damit Sie auch personenbezogene Daten datenschutzkonform in der Nextcloud speichern k??nnen.
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="card-header p-2" id="headingFive">
                            <p class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    Muss ich IT-Experte sein, um die Managed Nextcloud nutzen zu k??nnen?
                                </button>
                            </p>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingThree" data-parent="#faqExample">
                            <div class="card-body">
                                Nein, die Nextcloud ist ein einfach zu bedienender Cloud-Speicher, der besonders benutzerfreundlich ist. Den Betrieb der Hardware und der Server-Infrastruktur im Hintergrund ??bernehmen wir f??r Sie.
                                Somit k??nnen Sie sich aufs wesentliche konzentrieren. Auch Updates der Nextcloud nehmen wir auf Wunsch kostenlos f??r Sie vor.
                                Sollten Sie trotzdem mal eine Frage oder ein Problem haben, k??nnen Sie sich jederzeit an unseren Support (support@windcloud.de) wenden.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




<?= CartModalWidget::widget() ?>
        <div class="modal fade " id="variant-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" >
            <div class="modal-dialog modal-xl" style="background-color: #f6f6f6;" role="document">
                <div class="modal-content" style="background-color: #f6f6f6!important;border-radius: 0!important;" >
                    <div class="modal-header" style="border-bottom:0!important;">
                        <h3 class="vary" id="exampleModalLongTitle" style="text-align: center;width: 100%;padding-left: 10%;">OPTION W??HLEN</h3>
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
    $('#modal-body-loader' ).html( '<div class=\"row\"><div class=\"col-12\"><div class=\"overlay loadingcolor\"><i class=\"fa fa-refresh fa-spin fa-3x fa-fw loadingcolor\"></i></div></div></div>' );
    var elm = $(this),
        target = elm.attr('data-target'),
        ajax_body = elm.attr('value');

    $(target).modal('show')
    .find('.modal-body')
    .load(ajax_body);
        
});");
?>
<?php
$this->registerCssFile("/css/cms/style-nextcloud.css");
?>