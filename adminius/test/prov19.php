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
$token = "Akef3t4xlh3abw3_iO7cgRceSmjT6uwh";///Москва
$nameFile = "prov19.xml";

$arr = simplexml_load_file($nameFile);
echo "j";
$count = 0;
$old = 0;
$new = 0;
foreach ($arr->COMMODITIES as $item) {
    if ($item->attributes()["NAME"] == "TYRE" OR $item->attributes()["NAME"] == "DISK") {
        if($item->attributes()["NAME"] == "TYRE"){
            $cat = "1";
        }
        if($item->attributes()["NAME"] == "DISK"){
            $cat = "2";
        }
        foreach ($item->COMMODITY as $prod) {
            $idProd = chekcArticleProduct($prod->SMNFCODE, $cat);
            if($idProd){
                $old++;
            }else{
                $new++;
            }
            $count++;
        }

    }
}
echo $old." - ".$new." - ".$count;
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
?>