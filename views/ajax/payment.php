<script>
    var wpwlOptions = {
        locale: "de"
    }
</script>

<script src="https://test.vr-pay-ecommerce.de/v1/paymentWidgets.js?checkoutId=<?=$responseData["id"];?>"></script>
<form action="https://development.windcloud.de/dashboard/thanks?brand=<?=$brand;?>&invoicenumber=<?=$invoicenumber?>&accountid=<?= Yii::$app->user->identity->accountid?>" class="paymentWidgets" data-brands="<?=$brand;?>"></form>


