<?
/*$arr = file_get_contents("http://online.shininvest.ru/Online8/robot.php?type=disks&login=13828&pwd=82EEEC044FDBEDF4D0E4C42CB6B06C73");
$res = json_decode($arr);*/

error_reporting(0);
session_start();

include($_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php');
/////Подключение библиотеки
include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/function.inc.php');
include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/uploadProduct/upFunc.inc.php');
/////Замок
include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/lock.inc.php');
function chekcArticleProduct2($code){
    echo "SELECT id FROM product WHERE article='$code'";
    $temp = db2array("SELECT id FROM product WHERE article='$code'");
    return $temp["id"];
}
function addProduct2($id_provider, $cat, $article, $price, $price_clear, $logistic, $availability, $model, $marka, $name, $imgUrl, $filter)
{


    $date = date("Y-m-d H:i:s");
    $code_marka = greateLink($marka);
    $code_model = greateLink($model);
    $price_clear = str_replace(" ", "", $price_clear);
    $availability = str_replace("Более ", "", $availability);
    $availability = str_replace(">", "", $availability);

    if (!empty($article)) {


        if(is_numeric($article)){
            $article = (int)$article;
        }
        $start = microtime(true);
        $idProd = chekcArticleProduct2($article);
        echo 'Время выполнения скрипта5: '.round(microtime(true) - $start, 4).' сек.';
        if ($idProd > 0) {  ////Проверяем есть ли товар с таким кодом(артикулом)
            if (checkProviderPriceBufer($idProd, $id_provider)) {
                mysql_query("UPDATE `price_provider_bufer` SET price='$price', price_clear='$price_clear', logistic='$logistic', availability='$availability', date='$date' WHERE id_product='$idProd' AND id_provider='$id_provider'");
            }else {
                mysql_query("INSERT INTO `price_provider_bufer` (`price`, `price_clear`, `logistic`, `availability`, `id_product`, `id_provider`, `date`) VALUES ('$price', '$price_clear', '$logistic', '$availability', '$idProd', '$id_provider', '$date')");
            }

            ///$googPrice = selectGoodPrice($idProd);
            ///mysql_query("UPDATE `product` SET price='$googPrice[price]', price_clear='$googPrice[price_clear]', logistic='$googPrice[logistic]', provider='$googPrice[id_provider]', availability='$googPrice[availability]' WHERE id='$idProd'");
            ///mysql_query("INSERT INTO `upload_product_log` (`action`, `article`, `id_provider`, `date`) VALUES ('4', '$article', '$id_provider', '$date')");
        }else {
            if(!empty($model) AND !empty($marka)) {
                if (checkCategoriesProduct($marka, $model) == 0) { ////Проверяем есть ли той бренд и модель
                    if (checkBrand($marka) == 0) { ////Добавляем бренд
                        mysql_query("INSERT INTO `categories`(`meta_d`, `meta_k`, `h1`, `title`, `code`, `name`, `section`, `active`) VALUES ('$marka', '$marka', '$marka', '$marka', '$code_marka', '$marka', '$cat', '1')");
                        mysql_query("INSERT INTO `upload_product_log`(`action`, `article`, `id_provider`, `date`) VALUES ('1', '$article', '$id_provider', '$date')");
                    }
                    ///Добавляем модель
                    if ($imgUrl) {
                        $link = "http://" . $_SERVER['HTTP_HOST'] . "/scripts/phpThumb/phpThumb.php?src=" . $imgUrl . "&fltr[]=wmi|/images/watermark.png|85x200|100|170|120|0";
                        $file = file_get_contents($link);
                        $img_name = $marka . "-" . $model;
                        $img_name = greateLink($img_name);
                        $img = $img_name . ".png";
                        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/images/categories_cover/" . $img, $file);
                    }
                    $secID = selectCategoriesIdByName($marka);
                    if ($secID > 0) {

                        mysql_query("INSERT INTO `categories`(`meta_d`, `meta_k`, `h1`, `title`, `code`, `name`, `section`, `img`, `active`) VALUES ('$model', '$model', '$model', '$model', '$code_model', '$model', '$secID', '$img', '1')");
                        mysql_query("INSERT INTO `upload_product_log`(`action`, `article`, `id_provider`, `date`) VALUES ('2', '$article', '$id_provider', '$date')");
                        ///Добавляем модель Конец

                    }else{
                        mysql_query("INSERT INTO `upload_product_log`(`action`, `article`, `id_provider`, `date`) VALUES ('5', '$article', '$id_provider', '$date')");
                        if($cat == "1"){
                            $model = "Необработанный товар шины";
                        }else{
                            $model = "Необработанный товар диски";
                        }
                    }
                }
            }else{
                mysql_query("INSERT INTO `upload_product_log`(`action`, `article`, `id_provider`, `date`) VALUES ('6', '$article', '$id_provider', '$date')");
                if($cat == "1"){
                    $model = "Необработанный товар шины";
                    $marka = "Шины";
                }else{
                    $model = "Необработанный товар диски";
                    $marka = "Диски";
                }
            }


            ///Добавляем товар
            $code_name = greateLink($name);
            $secID = checkCategoriesProduct($marka, $model);
            $user = selectWhatUserAdmin();
            if(!empty($name)) {
                $img = "";
                if ($imgUrl AND $cat == "2") {
                    $link = "http://" . $_SERVER['HTTP_HOST'] . "/scripts/phpThumb/phpThumb.php?src=" . $imgUrl . "&fltr[]=wmi|/images/watermark.png|85x200|100|170|120|0";
                    $file = file_get_contents($link);
                    $img_name = $name;
                    $img_name = greateLink($img_name);
                    $img = $img_name . ".png";
                    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/images/product_cover/" . $img, $file);
                }
                mysql_query("INSERT INTO `product`(`meta_d`, `meta_k`, `h1`, `title`, `code`, `name`, `categories`, `active`, `availability`, `date`, `user_id`, `article`, `price`, `price_clear`, `logistic`, `provider`, `img`) VALUES ('$name', '$name', '$name', '$name', '$code_name', '$name', '$secID', '1', '0', '$date', '$user', '$article', '0', '0', '0', '0', '$img')");
                $id_product = mysql_insert_id();

                mysql_query("INSERT INTO `upload_product_log`(`action`, `article`, `id_provider`, `date`) VALUES ('3', '$article', '$id_provider', '$date')");
            }
            if ($id_product > 0) {
                mysql_query("INSERT INTO `price_provider_bufer`(`id_product`, `price`, `price_clear`, `logistic`, `id_provider`,`availability`, `date`) VALUES ('$id_product', '$price', '$price_clear', '$logistic', '$id_provider', '$availability', '$date')");

                if ($cat == "1") {
                    $widthId = selectFilterElementByValue($filter["width"], '19');
                    $heigthId = selectFilterElementByValue($filter["heigth"], '21');
                    $diametrId = selectFilterElementByValue($filter["diameter"], '20');

                    insertFilterValue('19', $widthId, $id_product); ///Ширина
                    insertFilterValue('20', $diametrId, $id_product); ///Диаметр
                    insertFilterValue('21', $heigthId, $id_product); ///Высота
                    insertFilterValue('23', $filter["season"], $id_product); ///Сезоность
                    insertFilterValue('24', $filter["thorn"], $id_product); ///Шиповка
                } elseif ($cat == "2") {
                    $diametrId = selectFilterElementByValue($filter["diameter"], '25');
                    $widthId = selectFilterElementByValue($filter["width"], '26');
                    $pcdId = selectFilterElementByValue($filter["pcd"], '27');

                    insertFilterValue('26', $widthId, $id_product); ///Ширина
                    insertFilterValue('25', $diametrId, $id_product); ///Диаметр
                    insertFilterValue('27', $pcdId, $id_product); ///Сверловка
                    insertFilterValue('28', $filter["et"], $id_product); ///Вылет
                    insertFilterValue('29', $filter["dia"], $id_product); ///Ступица
                }
            }
        }
    }

}
$arr = simplexml_load_file("http://www.shinservice.ru/xml/shinservice-b2b.xml");
///echo "<pre>".print_r($arr->tires, true)."</pre>";

$r = 1;
$cStart = 7;

$cEnd = $cStart+2;

foreach ($arr->tires->tire as $item){
    if ($r > $cStart AND $r<$cEnd) {
        if ($item["season"] == "W") {
            $season_name = "Зимняя шина ";
            $seasonId = 156;
        } elseif ($item["season"] == "S") {
            $season_name = "Летняя шина ";
            $seasonId = 155;
        } elseif ($item["season"] == "U") {
            $season_name = "Всесезонная шина";
            $seasonId = 157;
        }

        if ($item["pin"] == "Y") {
            $thornId = "158";
        } else {
            $thornId = "159";
        }

        $model = $item["model"];
        $name = $season_name . " ".$item["brand"]." ".$model." ". $item["width"]."/".$item["profile"].$item["diam"];

        $id_provider = '3';

        $price = getPriceProvide("1", $item["brand"], $item["diam"], $season, $item["retail_price"], $id_provider); ///Розничная цена
        $availability = $item["stock"]; ///Итого
        $logistic = "3";

        $date = date("Y-m-d H:i:s");

        $filter = array();
        $filter["width"] = $item["width"];
        $filter["heigth"] = $item["profile"];
        $filter["diameter"] = $item["diam"];
        $filter["season"] = $seasonId;
        $filter["thorn"] = $thornId;

        addProduct2($id_provider, "1", $item["id"], $price, $item["retail_price"], $logistic, $availability, $model, $item["brand"], $name, "", $filter);

    }
    $r++;
}
echo $cEnd;

?>