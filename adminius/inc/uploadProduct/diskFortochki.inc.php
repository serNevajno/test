<?
error_reporting(0);
session_start();
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/function.inc.php');
include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/uploadProduct/upFunc.inc.php');
include ($_SERVER['DOCUMENT_ROOT'].'/inc/apiFunc.inc.php');
/////Замок
include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/lock.inc.php');

$client = new SoapClient(SOAP_CLIENT);
$page = clearData($_POST["page"], "i");
$result = array();
$params =  array
(
    'login' => SOAP_LOGIN,
    'password' => SOAP_PASS,
    'filter' => array(
    ),
    'page' => $page,
);

$answer = $client->GetFindDisk($params);


$arrProduct= arrProductDisk($answer->GetFindDiskResult->price_rest_list->DiskPriceRest, $answer->GetFindDiskResult->warehouseLogistics->WarehouseLogistic);
$result = array_merge($result, $arrProduct);

foreach($result as $iProd){
        $name = str_replace("&", "&amp;", $iProd["name"]);
        $model = str_replace("&", "&amp;", $iProd["model"]);
        $marka = str_replace('&', '&amp;', $iProd["marka"]);

        $filter = array();
        $filter["diameter"] = $iProd["diameter"];
        $filter["width"] = $iProd["width"];
        $filter["pcd"] = $iProd["pcd"];
        $filter["et"] = $iProd["et"];
        $filter["dia"] = $iProd["dia"];


        addProduct("1", "2", $iProd["code"], $iProd["price"], $iProd["price_clear"], $iProd["dayLog"], $iProd["kol"], $model, $marka, $name, $iProd["img"], $filter);

}

$page++;
echo $page;
?>