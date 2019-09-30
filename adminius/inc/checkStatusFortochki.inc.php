<?php
if($_SERVER["REQUEST_METHOD"]=="POST") {
    include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
    include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
    include ($_SERVER['DOCUMENT_ROOT'].'/inc/apiFunc.inc.php');

    $order = clearData($_POST["order"]);
    //$order = 'F635931';

    $client = new SoapClient(SOAP_CLIENT);
    $params =  array
    (
        'login' => SOAP_LOGIN,
        'password' => SOAP_PASS,
        'orderNumber' => $order,
    );

    $answer = $client->GetOrderInfo($params);
    /*echo "<pre>";
    print_r($answer->GetOrderInfoResult->goods->Goods->wrh);
    echo "</pre>";*/
    $nomer = $answer->GetOrderInfoResult->goods->Goods->wrh;
    echo $answer->GetOrderInfoResult->statusName. ". Склад: ".$nomer;
}
?>