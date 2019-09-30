<?/*
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
include ($_SERVER['DOCUMENT_ROOT'].'/inc/apiFunc.inc.php');
echo "ok";
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
echo $error = 'Ошибка. Товар либо сервис недоступны.';
}
echo "<pre>";
print_r($answer);
echo "<pre>";
echo $answer->GetFindTyreResult->totalPages;
echo $answer->GetFindTyreResult->totalPages;
echo "ok";
*/?>