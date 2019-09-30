<?include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
include ($_SERVER['DOCUMENT_ROOT'].'/inc/apiFunc.inc.php');

$client = new SoapClient(SOAP_CLIENT);
try {
    $params =  array
    (
        'login' => SOAP_LOGIN,
        'password' => SOAP_PASS,
        'filter' => array(
            'type_list' => array(0 => "car", 1 => "cartruck", 2 => "vned"),
        ),
        'page' => 0,
    );

    $answer = $client->GetFindTyre($params);
} catch (Exception $exc) {
    $error = 'Ошибка. Товар либо сервис недоступны.';
}
if($answer->GetFindTyreResult->totalPages>0){
    mysql_query("DELETE FROM `price_provider_bufer` WHERE id_provider='1'");
}
echo $answer->GetFindTyreResult->totalPages;
?>