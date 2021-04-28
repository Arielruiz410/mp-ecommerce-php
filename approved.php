<?php 
    require __DIR__  . '/vendor/autoload.php';
    require ('keys.php');    

    $collection_id = $_GET["collection_id"];

    MercadoPago\SDK::setAccessToken(ACCESS_TOKEN);

    $body = file_get_contents('php://input');
    error_log('LPGQ----APPROVED----'.$body);
    
    $cURLConnection = curl_init();

    $urlGetPayment = 'https://api.mercadopago.com/v1/payments/'.$collection_id.'?access_token='.ACCESS_TOKEN;
    
    curl_setopt($cURLConnection, CURLOPT_URL, $urlGetPayment);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

    $payment = curl_exec($cURLConnection);
    
    $http_code = curl_getinfo($cURLConnection, CURLINFO_HTTP_CODE);

    if( $http_code != 200 ){
        
        echo 'El número de error retornado fue: '.$http_code;
        exit();

    }

    curl_close($cURLConnection);

    $paymentResponse = json_decode($payment);
    
    $paymentMethodId = $paymentResponse->payment_method_id;
    $total_paid_amount = $paymentResponse->transaction_details->total_paid_amount;
    $external_reference = $paymentResponse->external_reference;
    $collection_id = $paymentResponse->id;
    
    $html = 'payment_method_id: '.$paymentMethodId.'<br> total_paid_amount: ARS $ '.$total_paid_amount.'<br> external_reference: '.$external_reference.'<br> collection_id: '.$collection_id.'<br>';

    echo 'Tu pago fue realizado con éxito - la información sobre el pago es la siguiente: <br>'.$html.'<br>';
  
    //var_dump($payment).'<br>';

?>
