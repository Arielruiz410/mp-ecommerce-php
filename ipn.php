<?php
    require __DIR__  . '/vendor/autoload.php';
    require ('keys.php');

    MercadoPago\SDK::setAccessToken(ACCESS_TOKEN);

    $body = file_get_contents('php://input');
    error_log('AR----IPN----'.$body);
    ?>
