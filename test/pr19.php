<?
/*session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php');
/////Подключение библиотеки
include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/function.inc.php');

/////Замок
include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/lock.inc.php');

if($_POST["skl"] == "1"){
    $token = "Akef3t4xlh3abw3_iO7cgRceSmjT6uwh";///Москва
    $nameFile = "prov19.xml";
}elseif($_POST["skl"] == "2"){
    $token = "AR-jJspcjmHYHLTtRzNvgDmRR7DZPUIU";///Пермь
    $nameFile = "prov21.xml";
}elseif($_POST["skl"] == "3"){
    $token = "2U7JuuWdk2LcPbhQ6U2flCIKmObH8Oy8";///ННовгород
    $nameFile = "prov22.xml";
}
$token = "2U7JuuWdk2LcPbhQ6U2flCIKmObH8Oy8";///ННовгород
$nameFile = "prov22.xml";
//$arr = simplexml_load_file("https://webmim.svrauto.ru/api/v1/catalog/unload?access-token=".$token_mos."&format=xml");
$parameters = [
    'access-token' => $token,
    'format' => 'xml',
    'gzip' => true
];
$url = 'https://webmim.svrauto.ru/api/v1/catalog/unload?' . http_build_query($parameters);
file_put_contents($nameFile, gzdecode(stream_get_contents(fopen($url, 'rb'))));
$arr = simplexml_load_file($nameFile);
$count = 0;
foreach ($arr->COMMODITIES as $item) {
    if ($item->attributes()["NAME"] == "TYRE") {
        print_r($item->COMMODITY);
        //$count+=count($item->COMMODITY);
    }
}*/
///echo $count;
?>