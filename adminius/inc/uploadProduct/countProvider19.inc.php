<?
session_start();
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
}elseif($_POST["skl"] == "4"){
    $token = "nbVXbD7LINNkrJfpQgW4N2Qy8LLk0MXl";///ННовгород
    $nameFile = "prov23.xml";
}

//$arr = simplexml_load_file("https://webmim.svrauto.ru/api/v1/catalog/unload?access-token=".$token_mos."&format=xml");
$parameters = [
    'access-token' => $token,
    'format' => 'xml',
    'gzip' => true
];
$url = 'https://webmim.svrauto.ru/api/v1/catalog/unload?' . http_build_query($parameters);
file_put_contents($_SERVER['DOCUMENT_ROOT']."/price_provider/".$nameFile, gzdecode(stream_get_contents(fopen($url, 'rb'))));
$arr = simplexml_load_file($_SERVER['DOCUMENT_ROOT']."/price_provider/".$nameFile);
$count = 0;
foreach ($arr->COMMODITIES as $item) {
    if ($item->attributes()["NAME"] == "TYRE" OR $item->attributes()["NAME"] == "DISK") {
        $count+=count($item->COMMODITY);
    }
}
/*mysql_query("TRUNCATE TABLE `prov19` ");
foreach ($arr->COMMODITIES as $item) {
    if ($item->attributes()["NAME"] == "TYRE" OR $item->attributes()["NAME"] == "DISK") {
        foreach ($item->COMMODITY as $prod) {
            if ($item->attributes()["NAME"] == "TYRE") {
                $type = "1";
            } elseif ($item->attributes()["NAME"] == "DISK") {
                $type = "2";
            }
            mysql_query("INSERT INTO `prov19`(`type`, `SSEASON`, `STHORNING`, `SWIDTH`, `SHEIGHT`, `SDIAMETR`, `SMARKA`, `SMARKORIG`, `SMODIFNAME`, `SHOLESQUANT`, `SDIA`, `SWHEELOFFSET`, `NPRICE_PREPAYMENT`, `NREST`, `SPICTURE`, `SMNFCODE`, `SPCD`, `SMODEL`) VALUES ('$type', '$prod->SSEASON', '$prod->STHORNING', '$prod->SWIDTH', '$prod->SHEIGHT', '$prod->SDIAMETR', '$prod->SMARKA', '$prod->SMARKORIG', '$prod->SMODIFNAME', '$prod->SHOLESQUANT', '$prod->SDIA', '$prod->SWHEELOFFSET', '$prod->NPRICE_PREPAYMENT', '$prod->NREST', '$prod->SPICTURE', '$prod->SMNFCODE', '$prod->SPCD', '$prod->SMODEL')");
        }
        $count+=count($item->COMMODITY);
    }

}*/
echo $count;
?>