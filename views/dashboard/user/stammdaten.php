<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
?>
<h3 class="box-title"><i class="fa fa-cog" aria-hidden="true"></i> Stammdaten</h3>

<div class="row">

    <div class="col-md-8">
        <?php if (isset($stamdaten['company'])) {?>
        <div class="card card-primary">
            <div class="card-header box-header-windcloud">
                <h3 class="card-title"><i class="fa fa-user-o" aria-hidden="true"></i> Firma </h3>
            </div>

            <div class="card-body">
                <?php $form = ActiveForm::begin(); ?>
                <div class="row">
                    <div class="col-sm-4">Unternehmen:</div>
                    <?php  $company=null;?>
                    <?php
                    if (isset($stamdaten['personCompany'])) {
                        $company=$stamdaten['personCompany'];
                    }elseif (isset($stamdaten['company'])){
                        $company=$stamdaten['company'];
                    }
                    ?>

                    <div class="col-sm-8"><?= $form->field($Account,'billing_company')->label(false)->textInput(['value' =>  $company,'readonly'=> true]) ?></div>
                </div>


                <div class="row">
                    <div class="col-sm-4">Steuernummer / Umsatzsteuer ID:</div>
                    <?php
                    if (!empty($stamdaten['vatRegistrationNumber'])) {
                        $vat=$stamdaten['vatRegistrationNumber'];
                    }else{
                        $vat="";
                    }
                    ?>

                    <div class="col-sm-8"><?= $form->field($Account,'billing_vatId')->label(false)->textInput(['value' =>  $vat,'readonly'=> true]) ?></div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
            <div class="card-footer">
                <div class="row">



                </div>
            </div>
        </div>
        <?php }?>
        <div class="card card-primary">
            <div class="card-header box-header-windcloud">
                <h3 class="card-title"><i class="fa fa-user-o" aria-hidden="true"></i> Ansprechpartner </h3>
            </div>
            <div class="card-body">

                <?php $form = ActiveForm::begin(); ?>
                <div class="row">
                    <div class="col-sm-4">Anrede:</div>
                    <?php
                    $salutation = ['MR' => 'Herr', 'MRS' => 'Frau'];
                    if (!empty($stamdaten['salutation'])) {
                        $salutationAnsprechpartner=$salutation[$stamdaten['salutation']];
                    }else{
                        $salutationAnsprechpartner="";
                    }
                    ?>

                    <div class="col-sm-8"><?= $form->field($Account,'personal_salutation')->label(false)->textInput(['value' =>  $salutationAnsprechpartner,'readonly'=> true]) ?></div>
                </div>


                <div class="row">
                    <div class="col-sm-4">Vorname:</div>
                    <?php
                    if (!empty($stamdaten['firstName'])) {
                        $firstName=$stamdaten['firstName'];
                    }else{
                        $firstName="";
                    }
                    ?>

                    <div class="col-sm-8"><?= $form->field($Account,'personal_firstname')->label(false)->textInput(['value' =>  $firstName,'readonly'=> true]) ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-4">Nachname:</div>
                    <?php
                    if (!empty($stamdaten['lastName'])) {
                        $lastName=$stamdaten['lastName'];
                    }else{
                        $lastName="";
                    }
                    ?>

                    <div class="col-sm-8"><?= $form->field($Account,'personal_lastname')->label(false)->textInput(['value' =>  $lastName,'readonly'=> true]) ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-4">E-Mail-Adresse:</div>
                    <?php
                    if (!empty($stamdaten['email'])) {
                        $email=$stamdaten['email'];
                    }else{
                        $email="";
                    }
                    ?>

                    <div class="col-sm-8"><?= $form->field($Account,'personal_email')->label(false)->textInput(['value' =>  $email,'readonly'=> true]) ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-4">Telefon:</div>
                    <?php
                    if (!empty($stamdaten['phone'])) {
                        $phone=$stamdaten['phone'];
                    }else{
                        $phone="";
                    }
                    ?>

                    <div class="col-sm-8"><?= $form->field($Account,'personal_phone')->label(false)->textInput(['value' =>  $phone,'readonly'=> true]) ?></div>
                </div>
                <?php ActiveForm::end(); ?>

            </div>
            <div class="card-footer">
                <div class="row">

                </div>
            </div>
        </div>
        <div class="card card-primary">
            <div class="card-header box-header-windcloud">
                <h3 class="card-title"><i class="fa fa-user-o" aria-hidden="true"></i> Stammdaten </h3>
            </div>
            <div class="card-body">
                <?php $form = ActiveForm::begin(); ?>
                <?php
                if($billing_shippingAddress == 0 ){
                    ?>

                    <?php
                    $key = array_search('1', array_column($stamdaten['addresses'], 'primeAddress'));
                    $key2 = array_search('1', array_column($stamdaten['addresses'], 'invoiceAddress'));

                    ?>

                    <?= $form->field($StamdatenForm, 'billing_shippingAddress')->hiddenInput(['value' => '0'])->label(false); ?>

                    <?php $salutation =['MR' => 'Herr', 'MRS' => 'Frau'];?>
                    <div class="row">
                        <div class="col-sm-4">Anrede:</div>



                        <?php if(isset($stamdaten['addresses'][$key]['salutation'])){?>
                         <div class="col-sm-8"> <?= $form->field($StamdatenForm, 'billing_salutation')->dropDownList(['MR' => 'Herr', 'MRS' => 'Frau'],['options'=>[ $stamdaten['addresses'][$key]['salutation'] => ['selected' => true]]])->label(false); ?></div>
                    <?php }elseif ($stamdaten['salutation']){?>
                            <div class="col-sm-8"> <?= $form->field($StamdatenForm, 'billing_salutation')->dropDownList(['MR' => 'Herr', 'MRS' => 'Frau'],['options'=>[ $stamdaten['salutation'] => ['selected' => true]]])->label(false); ?></div>

                        <?php }?>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">Vorname:</div>

                        <?php if(isset($stamdaten['addresses'][$key]['firstName'])){?>
                            <div class="col-sm-8"><?= $form->field($StamdatenForm,'billing_firstName')->label(false)->textInput(['value' =>  $stamdaten['addresses'][$key]['firstName']]) ?></div>
                        <?php }elseif ($stamdaten['firstName']){?>
                            <div class="col-sm-8"><?= $form->field($StamdatenForm,'billing_firstName')->label(false)->textInput(['value' =>  $stamdaten['firstName']]) ?></div>
                        <?php }?>



                    </div>

                    <div class="row">
                        <div class="col-sm-4">Nachname:</div>


                        <?php if(isset($stamdaten['addresses'][$key]['lastName'])){?>
                            <div class="col-sm-8"><?= $form->field($StamdatenForm,'billing_lastName')->label(false)->textInput(['value' =>  $stamdaten['addresses'][$key]['lastName']]) ?></div>

                        <?php }elseif ($stamdaten['lastName']){?>
                            <div class="col-sm-8"><?= $form->field($StamdatenForm,'billing_lastName')->label(false)->textInput(['value' =>  $stamdaten['lastName']]) ?></div>

                        <?php }?>




                    </div>

                    <div class="row">
                        <div class="col-sm-4">Straße:</div>
                        <div class="col-sm-8"><?= $form->field($StamdatenForm,'billing_street1')->label(false)->textInput(['value' =>  $stamdaten['addresses'][$key]['street1']]) ?></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">Stadt:</div>
                        <div class="col-sm-8"><?= $form->field($StamdatenForm,'billing_city')->label(false)->textInput(['value' => $stamdaten['addresses'][$key]['city']]) ?></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">PLZ:</div>
                        <div class="col-sm-8"><?= $form->field($StamdatenForm,'billing_zipcode')->label(false)->textInput(['value' => $stamdaten['addresses'][$key]['zipcode']]) ?></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">Land:</div>
                        <div class="col-sm-8"><?= $form->field($StamdatenForm, 'billing_countryCode')->dropDownList($laender,['options'=>[ $stamdaten['addresses'][$key]['countryCode'] => ['selected' => true]]])->label(false); ?></div>
                    </div>

                    <?php
                }else{
                    ?>

                    <?php
                    $key = array_search('1', array_column($stamdaten['addresses'], 'primeAddress'));

                    ?>
                    <?php
                    $key2 = array_search('1', array_column($stamdaten['addresses'], 'invoiceAddress'));

                    ?>
                    <?= $form->field($StamdatenForm, 'billing_shippingAddress')->hiddenInput(['value' => '1'])->label(false); ?>

                    <div class="card card-primary ">
                        <div class="card-header box-header-windcloud">
                            <h3 class="card-title"><i class="fa fa-home" aria-hidden="true"></i> Hauptanschrift</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="card-body" style="min-height: 250px">
                            <?php $salutation =['MR' => 'Herr', 'MRS' => 'Frau'];?>
                            <div class="row">
                                <div class="col-sm-4">Anrede:</div>
                                <div class="col-sm-8"> <?= $form->field($StamdatenForm, 'billing_salutation')->dropDownList(['MR' => 'Herr', 'MRS' => 'Frau'],['options'=>[ $stamdaten['addresses'][$key]['salutation'] => ['selected' => true]]])->label(false); ?></div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">Vorname:</div>
                                <div class="col-sm-8"><?= $form->field($StamdatenForm,'billing_firstName')->label(false)->textInput(['value' =>  $stamdaten['addresses'][$key]['firstName']]) ?></div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">Nachname:</div>
                                <div class="col-sm-8"><?= $form->field($StamdatenForm,'billing_lastName')->label(false)->textInput(['value' =>  $stamdaten['addresses'][$key]['lastName']]) ?></div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">Straße:</div>
                                <div class="col-sm-8"><?= $form->field($StamdatenForm,'billing_street1')->label(false)->textInput(['value' =>  $stamdaten['addresses'][$key]['street1']]) ?></div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">Stadt:</div>
                                <div class="col-sm-8"><?= $form->field($StamdatenForm,'billing_city')->label(false)->textInput(['value' => $stamdaten['addresses'][$key]['city']]) ?></div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">PLZ:</div>
                                <div class="col-sm-8"><?= $form->field($StamdatenForm,'billing_zipcode')->label(false)->textInput(['value' => $stamdaten['addresses'][$key]['zipcode']]) ?></div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">Land:</div>
                                <div class="col-sm-8"><?= $form->field($StamdatenForm, 'billing_countryCode')->dropDownList($laender,['options'=>[ $stamdaten['addresses'][$key]['countryCode'] => ['selected' => true]]])->label(false); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary ">
                        <div class="card-header box-header-windcloud">
                            <h3 class="card-title"><i class="fa fa-file-text-o" aria-hidden="true"></i> Rechnungsanschrift Abweichend </h3>
                            <div class="card-tools">
                                <a class="btn btn-tool" href="<?= Url::toRoute('/dashboard/deletestammdaten'); ?>"><i class="fas fa-times"></i></a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="card-body" style="min-height: 250px">


                            <?php if(isset($stamdaten['addresses'][$key2])){?>

                                <div class="row">
                                    <div class="col-sm-4">Anrede:</div>
                                    <div class="col-sm-8"> <?= $form->field($StamdatenForm, 'shipping_salutation')->dropDownList(['MR' => 'Herr', 'MRS' => 'Frau'],['options'=>[ $stamdaten['addresses'][$key2]['salutation'] => ['selected' => true]]])->label(false); ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">Vorname:</div>
                                    <div class="col-sm-8"><?= $form->field($StamdatenForm,'shipping_firstName')->label(false)->textInput(['value' =>  $stamdaten['addresses'][$key2]['firstName']]) ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">Nachname:</div>
                                    <div class="col-sm-8"><?= $form->field($StamdatenForm,'shipping_lastName')->label(false)->textInput(['value' =>  $stamdaten['addresses'][$key2]['lastName']]) ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">Straße:</div>
                                    <div class="col-sm-8"><?= $form->field($StamdatenForm,'shipping_street1')->label(false)->textInput(['value' =>  $stamdaten['addresses'][$key2]['street1']]) ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">Stadt:</div>
                                    <div class="col-sm-8"><?= $form->field($StamdatenForm,'shipping_city')->label(false)->textInput(['value' => $stamdaten['addresses'][$key2]['city']]) ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">PLZ:</div>
                                    <div class="col-sm-8"><?= $form->field($StamdatenForm,'shipping_zipcode')->label(false)->textInput(['value' => $stamdaten['addresses'][$key2]['zipcode']]) ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">Land:</div>
                                    <div class="col-sm-8"><?= $form->field($StamdatenForm, 'shipping_countryCode')->dropDownList($laender,['options'=>[ $stamdaten['addresses'][$key2]['countryCode'] => ['selected' => true]]])->label(false); ?></div>
                                </div>

                            <?php }else{ ?>

                                <div class="row">
                                    <div class="col-sm-4">Anrede:</div>
                                    <div class="col-sm-8"> <?= $form->field($StamdatenForm, 'shipping_salutation')->dropDownList(['MR' => 'Herr', 'MRS' => 'Frau'])->label(false); ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">Vorname:</div>
                                    <div class="col-sm-8"><?= $form->field($StamdatenForm,'shipping_firstName')->label(false)->textInput() ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">Nachname:</div>
                                    <div class="col-sm-8"><?= $form->field($StamdatenForm,'shipping_lastName')->label(false)->textInput() ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">Straße:</div>
                                    <div class="col-sm-8"><?= $form->field($StamdatenForm,'shipping_street1')->label(false)->textInput() ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">Stadt:</div>
                                    <div class="col-sm-8"><?= $form->field($StamdatenForm,'shipping_city')->label(false)->textInput() ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">PLZ:</div>
                                    <div class="col-sm-8"><?= $form->field($StamdatenForm,'shipping_zipcode')->label(false)->textInput() ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">Land:</div>
                                    <div class="col-sm-8"><?= $form->field($StamdatenForm, 'shipping_countryCode')->dropDownList($laender)->label(false); ?></div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>




                    <?php
                }
                ?>






            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-sm-6">
                        <?= Html::submitButton('Speichern', ['class' => 'btn btn-primary']) ?>
                        <?php ActiveForm::end(); ?>
                    </div>
                    <div class="col-sm-6">
                        <?php
                        if($billing_shippingAddress == 0 ){
                            ?>
                            <a class="btn btn-success" href="<?= Url::toRoute('/dashboard/addstammdaten'); ?>">Rechnungsanschrift Abweichend hinzufügen</a>
                        <?php }else{ ?>

                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="card card-primary" style="display: none;">
            <div class="card-header box-header-windcloud">
                <h3 class="card-title"><i class="fa fa-user-o" aria-hidden="true"></i> Bankkonto </h3>
            </div>
            <div class="card-body">
                <?php $form = ActiveForm::begin(); ?>
                <?php if(isset($stamdaten['bankAccounts'][0])){?>
                    <div class="row">
                        <div class="col-sm-4">Kontoinhaber:</div>
                        <div class="col-sm-8"><?= $form->field($StamdatenBankForm,'accountHolder')->label(false)->textInput(['value' =>  $stamdaten['bankAccounts'][0]['accountHolder']]) ?></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">IBAN:</div>
                        <div class="col-sm-8"><?= $form->field($StamdatenBankForm,'accountNumber')->label(false)->textInput(['value' =>  $stamdaten['bankAccounts'][0]['accountNumber']]) ?></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">SWIFT-BIC:</div>
                        <div class="col-sm-8"><?= $form->field($StamdatenBankForm,'bankCode')->label(false)->textInput(['value' =>  $stamdaten['bankAccounts'][0]['bankCode']]) ?></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">Kreditinstitut:</div>
                        <div class="col-sm-8"><?= $form->field($StamdatenBankForm,'creditInstitute')->label(false)->textInput(['value' =>  $stamdaten['bankAccounts'][0]['creditInstitute']]) ?></div>
                    </div>
                <?php }else{ ?>
                    <div class="row">
                        <div class="col-sm-4">Kontoinhaber:</div>
                        <div class="col-sm-8"><?= $form->field($StamdatenBankForm,'accountHolder')->label(false)->textInput() ?></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">IBAN:</div>
                        <div class="col-sm-8"><?= $form->field($StamdatenBankForm,'accountNumber')->label(false)->textInput() ?></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">SWIFT-BIC:</div>
                        <div class="col-sm-8"><?= $form->field($StamdatenBankForm,'bankCode')->label(false)->textInput() ?></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">Kreditinstitut:</div>
                        <div class="col-sm-8"><?= $form->field($StamdatenBankForm,'creditInstitute')->label(false)->textInput() ?></div>
                    </div>
                <?php } ?>


            </div>
            <div class="card-footer">
                <?= Html::submitButton('Speichern', ['class' => 'btn btn-primary']) ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>

        <div class="card card-primary">
            <div class="card-header box-header-windcloud">
                <h3 class="card-title"><i class="fa fa-user-o" aria-hidden="true"></i> Bankkonto </h3>
            </div>
            <div class="card-body">
                Zurzeit ist eine digitale Erstellung eines SEPA-Lastschriftmandat nicht möglich, bitte kontaktieren Sie hierzu die <a href="https://windcloud.de/dashboard/kontakt">Buchhaltung</a>
            </div>
            <div class="card-footer">

            </div>
        </div>

    </div>

    <div class="col-md-4">

        <div class="card card-primary">
            <div class="card-header box-header-windcloud">
                <h3 class="card-title"><i class="fa fa-key" aria-hidden="true"></i> Passwort ändern</h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($ChangePassword, 'old_password')->label(false)
                    ->passwordInput(['placeholder' => $ChangePassword->getAttributeLabel('old_password')]) ?>
                <?= $form->field($ChangePassword, 'personal_password')->label(false)
                    ->passwordInput(['placeholder' => $ChangePassword->getAttributeLabel('personal_password')]) ?>
                <?= $form->field($ChangePassword, 'personal_passwordConfirmation') ->label(false)
                    ->passwordInput(['placeholder' => $ChangePassword->getAttributeLabel('personal_passwordConfirmation')]) ?>
            </div>
            <div class="card-footer">
                <?= Html::submitButton('Passwort ändern', ['class' => 'btn btn-primary']) ?>

            </div>
            <!-- /.box-body -->
            <?php ActiveForm::end(); ?>
        </div>
        <div class="card card-primary">
            <div class="card-header box-header-windcloud">
                <h3 class="card-title"><i class="fa fa-user-secret" aria-hidden="true"></i> Zwei-Faktor-Authentifizierung (2FA)</h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
                die Zwei-Faktor-Authentifizierung (2FA) ist in Planung
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-default">Zwei-Faktor-Authentifizierung aktivieren</button>
            </div>



            <!-- /.box-body -->
        </div>

        <div class="card card-primary">

            <?php $form = ActiveForm::begin(); ?>
            <div class="card-header box-header-windcloud">
                <h3 class="card-title"><i class="fa fa-trash" aria-hidden="true"></i> Kundenkonto löschen</h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
                <?= $form->field($trash, 'accountid')->hiddenInput(['value'=> Yii::$app->user->identity->accountid ])->label(false); ?>
                <?= $form->field($trash, 'delcheck',
                    ['template' => '{input}{label}{error}'])->checkBox(['aria-invalid'=>false,'label'=> 'Ich möchte mein Konto bei Windcloud 4.0 GmbH löschen']);?>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-danger">löschen</button>
            </div>

            <?php ActiveForm::end(); ?>

            <!-- /.box-body -->
        </div>



    </div>
