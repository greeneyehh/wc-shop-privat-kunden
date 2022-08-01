<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="card" id="stepthree">
    <div class="card-header border-radius-d cart-card-addon" style="text-align: center;">
        <h3 class="vary">
            <?php
            if(isset($nodamain)){
                echo "Wunschsubdomain";
            }else{
                echo "Wunschdomain";
            }

            ?>

        </h3>
        <h1 class="vary">
            <?php
            if(isset($nodamain)){
                echo "Tragen Sie Ihre Wunschsubdomain in das Feld ein.";
            }else{
                echo "Tragen Sie Ihre Wunschdomain in das Feld ein.";
            }

            ?>

        </h1>


    </div>
        <div class="card-body row justify-content-md-center">
            <?php

            if(isset($nodamain)){
?>
                <div class="form-group field-domainform-domainextension required">
                    <div class="input-group"><input type="text" id="domainform-domainextension" class="inputDomainExtension wpcf7-form-control wpcf7-text wpcf7-validates-as-required subdomain" name="DomainForm[DomainExtension]" placeholder="Beispiel: Wunschsubdomain.windcloud.de" aria-required="true"><span class="input-group-text">.windcloud.de</span></div>
                    <p class="help-block help-block-error"></p>
                </div>
  <?php          }else{
                ?>
                <div class="form-group field-domainform-domainextension required">
                    <input type="text" id="domainform-domainextension" class="inputDomainExtension wpcf7-form-control wpcf7-text wpcf7-validates-as-required domain" name="DomainForm[DomainExtension]" placeholder="Beispiel: nextcloud.IhreDomain.de" aria-required="true">
                    <p class="help-block help-block-error"></p>
                </div>
                <?php
            }?>
            <?= Html::submitButton('Weiter',
                        ['style'=>'vertical-align: bottom; width: 100%;',
                            'class' => 'border mobile-fill anim-1 show align-self-end step-four','data-slug'=>$slug]);
                    ?>
        </div>
</div>

<?php

$this->registerJs("
$('.step-four').click(function(event) {
var domain = document.querySelector('.inputDomainExtension').value
        if($('input.subdomain').length){
            domain =domain+'.windcloud.de'
        }
      if(domain.length > 1){
        if (/^([a-zA-Z0-9][a-zA-Z0-9-_]*\.)*[a-zA-Z0-9]*[a-zA-Z0-9-_]*[[a-zA-Z0-9]+$/.test(domain)) {
                  
                        var produktdata ={};
                        var array= $(this).data();
                        for (var prop in array) {
                            produktdata[prop]= array[prop];
                        }
                        produktdata['DomainExtension']= domain;
                        console.log(produktdata);
                        $.ajax({
                          type: 'POST',
                          url: '/wizard/step-four',
                          data:  produktdata,
                          success: function (response) {
                          $('#stepfour').remove();
                          $('#wizard').append(response);
                          location.href = '#stepfour';
                          },
                          error: function(error) {
                            console.log(error)
                            alert('Data not saved');
                          }
                        });
                        window.scroll({
                      behavior: 'smooth'
                    });
             
        }else{
                        $('.help-block-error').text('domain muss zb. IhreDomain.de sein');
        }
            } else {
                        $('.help-block-error').text('domain muss mehr als 2 zeichen haben');
                    }   
});");
?>
