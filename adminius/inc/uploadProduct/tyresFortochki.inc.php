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
        'type_list' => array(0 => "car", 1 => "cartruck", 2 => "vned"),
    ),
    'page' => $page,
);

$answer = $client->GetFindTyre($params);


$arrProduct= arrProduct($answer->GetFindTyreResult->price_rest_list->TyrePriceRest, $answer->GetFindTyreResult->warehouseLogistics->WarehouseLogistic);
$result = array_merge($result, $arrProduct);

/*echo "<pre>";
print_r($answer);
echo "</pre>";*/
foreach($result as $iProd) {
  $name = str_replace("&", "&amp;", $iProd["name"]);
  $model = str_replace("&", "&amp;", $iProd["model"]);
  $marka = str_replace('&', '&amp;', $iProd["marka"]);
  $filter = array();
  $filter["width"] = $iProd["width"];
  $filter["heigth"] = $iProd["heigth"];
  $filter["diameter"] = $iProd["diameter"];
  $filter["season"] = $iProd["seasonId"];
  $filter["thorn"] = $iProd["thornId"];

  if ($iProd["code"] != '13609' AND $iProd["code"] != '453046') {
    addProduct("1", "1", $iProd["code"], $iProd["price"], $iProd["price_clear"], $iProd["dayLog"], $iProd["kol"], $model, $marka, $name, $iProd["img_big"], $filter);
  }
}

$page++;
echo $page;
?>