<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use PayPal\Rest\ApiContext;
use PayPal\Api\OpenIdSession;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Address;
use PayPal\Api\PayerInfo;
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use app\models\ShopProduct;
use app\models\DomainCheck;
use app\models\Security\Paypallog;




class PaymentController extends \yii\web\Controller
{

	public function actionPaypal(){
	 	$session = Yii::$app->session;
		$payer = new Payer();
		$payer->setPaymentMethod("paypal");
/*
 
 		$payer->setPaymentMethod("paypal")
		$payer->setPaymentMethod("credit_card")
		$payer->setPaymentMethod("bank")
	    $payer->setPaymentMethod("pay_upon_invoice")
  		$payer->setPaymentMethod("carrier")
  		$payer->setPaymentMethod("alternate_payment")
*/		
		
		
		
		
		$apiContext = new \PayPal\Rest\ApiContext(new \PayPal\Auth\OAuthTokenCredential(Yii::$app->params['PaypalClientID'],Yii::$app->params['PaypalSecret']));
		$apiContext->setConfig(
            array(
            'mode' => \Yii::$app->params['PAYPAL_MODE'],
            'log.LogEnabled' => true,
            'log.FileName' => '../PayPal.log',
            'log.LogLevel' => 'DEBUG', 
            )
        );
		$ProductId = $session->get('cart');
		$product = ShopProduct::findById($ProductId);
		if($session->get('ProductPaidcycle') == 12){
			$productprice = number_format($product->price * 12 ,2,".","");
			$productprice = $productprice - $productprice /100 * 10;
		}else{
			$productprice = number_format($product->price ,2,".","");
		}
		$producttax = $productprice /100 * $product->tax;
		$item1 = new Item();		
		$item1->setName($product->name)
		->setCurrency('EUR')
		->setQuantity(1)->setSku($ProductId)
		->setPrice(number_format($productprice,2,".",""));
   
   /*   $shippingAddress = new \PayPal\Api\ShippingAddress();
        $shippingAddress->setCity($shippingSession['city']);
        $shippingAddress->setCountryCode($shipping_country->code);
        $shippingAddress->setPostalCode($shippingSession['zip_code']);
        $shippingAddress->setLine1($shippingSession['address']);
        $shippingAddress->setState($shippingSession['state']);
        $shippingAddress->setRecipientName($shippingSession['first_name'] . ' ' . $shippingSession['last_name']);
*/
		$execution = new PaymentExecution();
		$itemList = new ItemList();
		//$itemList->setShippingAddress($shippingAddress);
		$itemList->setItems(array($item1));
		$details = new Details();
		$details->setTax(number_format($producttax,2,".",""))
		->setSubtotal($productprice);		
		$amount = new Amount();
		$amount->setCurrency("EUR")
		->setTotal(number_format($productprice + $producttax,2,".",""))
		->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
        ->setItemList($itemList)
        ->setDescription("Payment description")
        ->setInvoiceNumber(uniqid());
		
				
        $redirectUrls = new RedirectUrls();
        $ReturnUrl = Yii::$app->urlManager->createAbsoluteUrl(['payment/paypal-success', 'success' => 'true']);
		$CancelUrl = Yii::$app->urlManager->createAbsoluteUrl(['payment/paypal-cancel', 'success' => 'false']);
		$redirectUrls->setReturnUrl($ReturnUrl)
		->setCancelUrl($CancelUrl);
		
		$payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));
	
		$request = clone $payment;
		file_put_contents("outputfilepaypalpre.txt", $request);
		try {
           $test = $payment->create($apiContext);

		
        } catch (PayPalConnectionException $ex) {
            echo $ex->getCode();
            echo $ex->getData();
            die($ex);
        } catch (Exception $ex) {
            die($ex);
        }

       
       if ($payment->state == "created" && $payment->payer->payment_method == "paypal") {
           	Yii::$app->session->set('payment_id', $payment->id);
          	header("location: " . $payment->links[1]->href);
           exit();
        }
    }
	
	
	public function actionPaypalSuccess(){
			$session = Yii::$app->session;
			$model = new DomainCheck();
		    $apiContext = new \PayPal\Rest\ApiContext(
		        new \PayPal\Auth\OAuthTokenCredential(
               Yii::$app->params['PaypalClientID'],     
                Yii::$app->params['PaypalSecret']
		        )
		    );

		    $apiContext->setConfig(
		        array(
		            'mode' => \Yii::$app->params['PAYPAL_MODE'],
		        )
		    );
		    // Get payment object by passing paymentId
		    $paymentId = $_GET['paymentId'];
		    $payment = Payment::get($paymentId, $apiContext);
		    $payerId = $_GET['PayerID'];
			
			// Execute payment with payer id
		    $execution = new PaymentExecution();
		    $execution->setPayerId($payerId);
		    try {

		        $result = $payment->execute($execution, $apiContext);
		        if($result->state == "approved"){
						$PayLog = new Paypallog();	
						$PayLog->payid = $result->id;
 						$PayLog->intent  = $result->intent;
						$PayLog->paystate  = $result->state;
						$PayLog->cart  = $result->cart;
						$PayLog->payer = json_encode(json_decode($result->payer, true));
						$PayLog->transactions  = serialize($result->transactions);
						$PayLog->redirect_urls=  serialize(json_decode($result->redirect_urls, true));
						$PayLog->create_time= $result->create_time;
						$PayLog->update_time= $result->update_time;
						$PayLog->links= serialize($result->links);
						if($PayLog->validate()){

							$PayLog->save();
						} 
						$model->domainname = $session->get('ProductDomainExtension');

							if($model->validate()){
								$model->save();
							} 

		            Yii::$app->session->setFlash('success','You have successfully placed the order');
		            return $this->redirect(['payment/successfulpayment']);
		        }
		        var_dump($result);
		    } catch (PayPalConnectionException $ex) {
		        echo $ex->getCode();
		        echo $ex->getData();
		        die($ex);
		    } catch (Exception $ex) {
		        echo $ex->getMessage();
		        die($ex);
		    }
	}
	
	public function actionPaypalCancel(){
	    	
          Yii::$app->session->setFlash('error','There was a problem with payment.Please try again');
          return $this->redirect(['site/summary']);
    }
	
	public function actionSuccessfulpayment()
    {



        return $this->render('successfulpayment');
    }


}