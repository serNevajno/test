<?
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php');
/////Подключение библиотеки
include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/function.inc.php');

/////Замок
include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/lock.inc.php');
$token_mos = "Akef3t4xlh3abw3_iO7cgRceSmjT6uwh";
$token_perm = "AR-jJspcjmHYHLTtRzNvgDmRR7DZPUIU";
///$arr = simplexml_load_file("https://webmim.svrauto.ru/api/v1/catalog/unload?access-token=".$token_mos."&format=xml");
$parameters = [
    'access-token' => $token_mos,
    'format' => 'xml',
    'gzip' => true
];
/*$url = 'https://webmim.svrauto.ru/api/v1/catalog/unload?' . http_build_query($parameters);
file_put_contents('test.xml', gzdecode(stream_get_contents(fopen($url, 'rb'))));*/

$arr = simplexml_load_file("test.xml");
///echo "<pre>".print_r($arr, true)."</pre>";
$total = 0;
$ff = 0;
$img = 0;
foreach ($arr->COMMODITIES as $item){
    if($item->attributes()["NAME"] == "DISK") {
        //echo "<pre>" . print_r($item, true) . "</pre>";
        $total+=count($item->COMMODITY);
        foreach ($item->COMMODITY as $prod){
            $temp = db2array("SELECT id FROM product WHERE article='$prod->SMNFCODE' AND img=''");

            if($temp["id"]>0){
                $link = "http://" . $_SERVER['HTTP_HOST'] . "/scripts/phpThumb/phpThumb.php?src=" . $prod->SPICTURE . "&fltr[]=wmi|/images/watermark.png|85x200|100|170|120|0";
                $file = file_get_contents($link);
                $img_name = $prod->SMODIFNAME;
                $img_name = greateLink($img_name);
                $img = $img_name . ".png";
                file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/images/product_cover/" . $img, $file);
                ///echo "UPDATE `product` SET img='$img' WHERE id='$temp[id]'";
                mysql_query("UPDATE `product` SET img='$img' WHERE id='$temp[id]'");
                $ff++;
            }
        /*    if ($prod->SSEASON == "Зимняя") {
                $season_name = "Зимняя шина ";
                $seasonId = 156;
            } elseif ($prod->SSEASON == "Летняя") {
                $season_name = "Летняя шина ";
                $seasonId = 155;
            } elseif ($prod->SSEASON == "Всесезонная") {
                $season_name = "Всесезонная шина";
                $seasonId = 157;
            }

            if ($prod->STHORNING == "Ш.") {
                $thornId = "158";
            } else {
                $thornId = "159";
            }*/
           //echo $prod->SPICTURE."<br>";///Код производителя
            /*echo $prod->SMARKA."<br>";///бренд
            echo $prod->SMODEL."<br>";///Модель
            echo $prod->SDIAMETR."<br>";///Диаметр
            echo $prod->SWIDTH."<br>";///ширина
            echo $prod->SHEIGHT."<br>";///Высиота
            echo $prod->STHORNING."<br>";///Шиповка
            echo $prod->NREST."<br>";///Остаток
            echo $prod->TERRITORY_NAME."<br>";///Склад
            echo $prod->STHORNING."<br>";///Сезон*/
        }
    }
}
echo $total." ".$ff;
?>