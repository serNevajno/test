<?
function checkProviderPrice($idProd, $id_provider){
    $temp = db2array("SELECT COUNT(*) FROM price_provider WHERE id_product='$idProd' AND id_provider='$id_provider'");
    return $temp["COUNT(*)"];
}
function checkProviderPriceBufer($idProd, $id_provider){
    $temp = db2array("SELECT COUNT(*) FROM price_provider_bufer WHERE id_product='$idProd' AND id_provider='$id_provider'");
    return $temp["COUNT(*)"];
}
function getPriceProvide($type, $brand, $diameter, $season, $price, $provider){
    if(!empty($season)){
        $wr_season = " AND t1.season='".$season."'";
    }

    $temp = db2array("SELECT t1.percent 
		FROM extra_charge as t1 
		LEFT JOIN categories as t2 on(t1.brand=t2.id) 
		LEFT JOIN element_filter as t3 on(t1.diameter=t3.id) 
		WHERE t2.name='$brand' AND t3.value='$diameter' AND t1.type='$type'$wr_season");
    if(!$temp["percent"]){
        $temp = db2array("SELECT t1.percent 
				FROM extra_charge as t1 
				LEFT JOIN categories as t2 on(t1.brand=t2.id) 
				WHERE t2.name='$brand' AND t1.diameter='0' AND t1.type='$type'$wr_season");
        if(!$temp["percent"]){
            $temp = db2array("SELECT percent FROM base_extra_charge WHERE id='$type'");
        }

    }
    $price = str_replace(" ", "", $price);
    $onePer = $price/100;
    $per = $onePer*$temp["percent"];
    $sPer = $price+$per;
    $price = ceil($sPer/10) * 10;
    $price = $price + selectProviderExtraCharge($provider);
    return $price;
}
function selectGoodPrice($idProd){
    $temp = db2array("SELECT `id_provider` FROM `price_provider`WHERE id_product = '$idProd' GROUP BY id_provider", 2);
    $arr = array();
    $arr["logistic"]=777;
    $arr["price"]=77777777;
    $arr["availability"] = 77777777;
    $bolshe = 0;

    foreach ($temp as $item) {
        $prov = db2array("SELECT price, price_clear, logistic, availability FROM `price_provider`WHERE id_product = '$idProd' AND id_provider='$item[id_provider]' ORDER BY date DESC LIMIT 1");

        /*if($arr["logistic"]> $prov["logistic"] OR ($arr["logistic"] == $prov["logistic"] AND $arr["price"] > $prov["price"])){*/
        if($prov["availability"]>=4 AND (($arr["price"] > $prov["price"]) OR ($arr["price"] == $prov["price"] AND $arr["logistic"] > $prov["logistic"]))){
            $arr["price"] = $prov["price"];
            $arr["price_clear"] = $prov["price_clear"];
            $arr["logistic"] = $prov["logistic"];
            $arr["availability"] = $prov["availability"];
            $arr["id_provider"]= $item["id_provider"];
            $bolshe = 1;
        }

    }
    if($bolshe == 0){
        foreach ($temp as $item) {
            $prov = db2array("SELECT price, price_clear, logistic, availability FROM `price_provider`WHERE id_product = '$idProd' AND id_provider='$item[id_provider]' ORDER BY date DESC LIMIT 1");

            if(($arr["price"] > $prov["price"]) OR ($arr["price"] == $prov["price"] AND $arr["logistic"] > $prov["logistic"])){
                $arr["price"] = $prov["price"];
                $arr["price_clear"] = $prov["price_clear"];
                $arr["logistic"] = $prov["logistic"];
                $arr["availability"] = $prov["availability"];
                $arr["id_provider"]= $item["id_provider"];
            }

        }
    }
    return $arr;
}
function addProduct($id_provider, $cat, $article, $price, $price_clear, $logistic, $availability, $model, $marka, $name, $imgUrl, $filter)
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

        if($cat == '2'){
          $idProd = chekcArticleProductDisk($article, $id_provider, $cat);
        }else{
          $idProd = chekcArticleProduct($article, $cat);
        }

        if ($idProd > 0) {  ////Проверяем есть ли товар с таким кодом(артикулом)
            if($price>0) {
              if (checkProviderPriceBufer($idProd, $id_provider)) {
                mysql_query("UPDATE `price_provider_bufer` SET price='$price', price_clear='$price_clear', logistic='$logistic', availability='$availability', date='$date' WHERE id_product='$idProd' AND id_provider='$id_provider'");
              } else {
                mysql_query("INSERT INTO `price_provider_bufer` (`price`, `price_clear`, `logistic`, `availability`, `id_product`, `id_provider`, `date`) VALUES ('$price', '$price_clear', '$logistic', '$availability', '$idProd', '$id_provider', '$date')");
              }
            }
            ///$googPrice = selectGoodPrice($idProd);
            ///mysql_query("UPDATE `product` SET price='$googPrice[price]', price_clear='$googPrice[price_clear]', logistic='$googPrice[logistic]', provider='$googPrice[id_provider]', availability='$googPrice[availability]' WHERE id='$idProd'");
            ///mysql_query("INSERT INTO `upload_product_log` (`action`, `article`, `id_provider`, `date`) VALUES ('4', '$article', '$id_provider', '$date')");
        }else {
           if($model!='' AND !empty($marka)) {
                    if (checkCategoriesProduct($marka, $model) == 0) { ////Проверяем есть ли той бренд и модель
                        if($cat == "1"){
                            $model = "Необработанный товар шины";
                        }else{
                            $model = "Необработанный товар диски";
                        }
                        /*if (checkBrand($marka) == 0) { ////Добавляем бренд
                            mysql_query("INSERT INTO `categories`(`meta_d`, `meta_k`, `h1`, `title`, `code`, `name`, `section`, `active`) VALUES ('$marka', '$marka', '$marka', '$marka', '$code_marka', '$marka', '$cat', '1')");
                            ///mysql_query("INSERT INTO `upload_product_log`(`action`, `article`, `id_provider`, `date`) VALUES ('1', '$article', '$id_provider', '$date')");
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
                            ///mysql_query("INSERT INTO `upload_product_log`(`action`, `article`, `id_provider`, `date`) VALUES ('2', '$article', '$id_provider', '$date')");
                            ///Добавляем модель Конец

                        }else{
                            ///mysql_query("INSERT INTO `upload_product_log`(`action`, `article`, `id_provider`, `date`) VALUES ('5', '$article', '$id_provider', '$date')");
                            if($cat == "1"){
                                $model = "Необработанный товар шины";
                            }else{
                                $model = "Необработанный товар диски";
                            }
                        }*/
                    }
            }else{
                    ///mysql_query("INSERT INTO `upload_product_log`(`action`, `article`, `id_provider`, `date`) VALUES ('6', '$article', '$id_provider', '$date')");
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
            if($secID<=0){
              if($cat == "1"){
                $secID = '27';
              }elseif($cat == "2"){
                $secID = '28';
              }
            }
            if(!empty($name)) {
                $img = "";
                if ($imgUrl AND $cat == "2") {
                    /*$link = "http://" . $_SERVER['HTTP_HOST'] . "/scripts/phpThumb/phpThumb.php?src=" . $imgUrl . "&fltr[]=wmi|/images/watermark.png|85x200|100|170|120|0";
                    $file = file_get_contents($link);
                    $img_name = $name;
                    $img_name = greateLink($img_name);
                    $img = $img_name . ".png";
                    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/images/product_cover/" . $img, $file);*/
                }
                $id_product =0;
                $result = mysql_query("INSERT INTO `product`(`meta_d`, `meta_k`, `h1`, `title`, `code`, `name`, `categories`, `active`, `availability`, `date`, `user_id`, `article`, `price`, `price_clear`, `logistic`, `provider`, `img`, `provider_upload`) VALUES ('$name', '$name', '$name', '$name', '$code_name', '$name', '$secID', '1', '0', '$date', '$user', '$article', '0', '0', '0', '0', '$img', '$id_provider')");
                if($result) {
                  $id_product = mysql_insert_id();
                }
                ///mysql_query("INSERT INTO `upload_product_log`(`action`, `article`, `id_provider`, `date`) VALUES ('3', '$article', '$id_provider', '$date')");
            }
            if ($id_product > 0) {
                if ($imgUrl AND $cat == "2") {
                    $img_name = $name;
                    $img_name = greateLink($img_name);
                    $img = $img_name . ".png";
                    mysql_query("INSERT INTO `img_upload`(`url`, `name`, `id_product`, `dir`) VALUES ('$imgUrl', '$img', '$id_product', 'product_cover')");
                }
                if($price>0) {
                  mysql_query("INSERT INTO `price_provider_bufer`(`id_product`, `price`, `price_clear`, `logistic`, `id_provider`,`availability`, `date`) VALUES ('$id_product', '$price', '$price_clear', '$logistic', '$id_provider', '$availability', '$date')");
                }
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

function addProductTest($id_provider, $cat, $article, $price, $price_clear, $logistic, $availability, $model, $marka, $name, $imgUrl, $filter){
    $date = date("Y-m-d H:i:s");
    $code_marka = greateLink($marka);
    $code_model = greateLink($model);
  if($model!=''){
      echo "fsdklfjsd";
  }
    $price_clear = str_replace(" ", "", $price_clear);
    $availability = str_replace("Более ", "", $availability);
    $availability = str_replace(">", "", $availability);

    if (!empty($article)) {
        if(is_numeric($article)){
            $article = (int)$article;
        }
        $idProd = chekcArticleProduct($article);
        if ($idProd > 0) {  ////Проверяем есть ли товар с таким кодом(артикулом)
            if (checkProviderPriceBufer($idProd, $id_provider)) {
                echo "UPDATE `price_provider_bufer` SET price='$price', price_clear='$price_clear', logistic='$logistic', availability='$availability', date='$date' WHERE id_product='$idProd' AND id_provider='$id_provider'"."<br>";
                ///mysql_query("UPDATE `price_provider_bufer` SET price='$price', price_clear='$price_clear', logistic='$logistic', availability='$availability', date='$date' WHERE id_product='$idProd' AND id_provider='$id_provider'");
            }else {
                echo "INSERT INTO `price_provider_bufer` (`price`, `price_clear`, `logistic`, `availability`, `id_product`, `id_provider`, `date`) VALUES ('$price', '$price_clear', '$logistic', '$availability', '$idProd', '$id_provider', '$date')"."<br>";
                //mysql_query("INSERT INTO `price_provider_bufer` (`price`, `price_clear`, `logistic`, `availability`, `id_product`, `id_provider`, `date`) VALUES ('$price', '$price_clear', '$logistic', '$availability', '$idProd', '$id_provider', '$date')");
            }

            ///$googPrice = selectGoodPrice($idProd);
            ///mysql_query("UPDATE `product` SET price='$googPrice[price]', price_clear='$googPrice[price_clear]', logistic='$googPrice[logistic]', provider='$googPrice[id_provider]', availability='$googPrice[availability]' WHERE id='$idProd'");
            ///mysql_query("INSERT INTO `upload_product_log` (`action`, `article`, `id_provider`, `date`) VALUES ('4', '$article', '$id_provider', '$date')");
        }else {
            if($model!='' AND !empty($marka)) {
                if (checkCategoriesProduct($marka, $model) == 0) { ////Проверяем есть ли той бренд и модель
                    if (checkBrand($marka) == 0) { ////Добавляем бренд
                        echo "1INSERT INTO `categories`(`meta_d`, `meta_k`, `h1`, `title`, `code`, `name`, `section`, `active`) VALUES ('$marka', '$marka', '$marka', '$marka', '$code_marka', '$marka', '$cat', '1')"."<br>";
                        ///mysql_query("INSERT INTO `categories`(`meta_d`, `meta_k`, `h1`, `title`, `code`, `name`, `section`, `active`) VALUES ('$marka', '$marka', '$marka', '$marka', '$code_marka', '$marka', '$cat', '1')");
                        echo "INSERT INTO `upload_product_log`(`action`, `article`, `id_provider`, `date`) VALUES ('1', '$article', '$id_provider', '$date')"."<br>";
                        ///mysql_query("INSERT INTO `upload_product_log`(`action`, `article`, `id_provider`, `date`) VALUES ('1', '$article', '$id_provider', '$date')");
                    }
                    ///Добавляем модель
                   /* if ($imgUrl) {
                        $link = "http://" . $_SERVER['HTTP_HOST'] . "/scripts/phpThumb/phpThumb.php?src=" . $imgUrl . "&fltr[]=wmi|/images/watermark.png|85x200|100|170|120|0";
                        $file = file_get_contents($link);
                        $img_name = $marka . "-" . $model;
                        $img_name = greateLink($img_name);
                        $img = $img_name . ".png";
                        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/images/categories_cover/" . $img, $file);
                    }*/
                    $secID = selectCategoriesIdByName($marka);
                    if ($secID > 0) {
                        echo "2INSERT INTO `categories`(`meta_d`, `meta_k`, `h1`, `title`, `code`, `name`, `section`, `img`, `active`) VALUES ('$model', '$model', '$model', '$model', '$code_model', '$model', '$secID', '$img', '1')"."<br>";
                        ///mysql_query("INSERT INTO `categories`(`meta_d`, `meta_k`, `h1`, `title`, `code`, `name`, `section`, `img`, `active`) VALUES ('$model', '$model', '$model', '$model', '$code_model', '$model', '$secID', '$img', '1')");
                        echo "INSERT INTO `upload_product_log`(`action`, `article`, `id_provider`, `date`) VALUES ('2', '$article', '$id_provider', '$date')"."<br>";
                        ///mysql_query("INSERT INTO `upload_product_log`(`action`, `article`, `id_provider`, `date`) VALUES ('2', '$article', '$id_provider', '$date')");
                        ///Добавляем модель Конец

                    }else{
                        echo "INSERT INTO `upload_product_log`(`action`, `article`, `id_provider`, `date`) VALUES ('5', '$article', '$id_provider', '$date')"."<br>";
                        ///mysql_query("INSERT INTO `upload_product_log`(`action`, `article`, `id_provider`, `date`) VALUES ('5', '$article', '$id_provider', '$date')");
                        if($cat == "1"){
                            $model = "Необработанный товар шины";
                        }else{
                            $model = "Необработанный товар диски";
                        }
                    }
                }
            }else{
                echo "INSERT INTO `upload_product_log`(`action`, `article`, `id_provider`, `date`) VALUES ('6', '$article', '$id_provider', '$date')"."<br>";
                ///mysql_query("INSERT INTO `upload_product_log`(`action`, `article`, `id_provider`, `date`) VALUES ('6', '$article', '$id_provider', '$date')");
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
               /* if ($imgUrl AND $cat == "2") {
                    $link = "http://" . $_SERVER['HTTP_HOST'] . "/scripts/phpThumb/phpThumb.php?src=" . $imgUrl . "&fltr[]=wmi|/images/watermark.png|85x200|100|170|120|0";
                    $file = file_get_contents($link);
                    $img_name = $name;
                    $img_name = greateLink($img_name);
                    $img = $img_name . ".png";
                    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/images/product_cover/" . $img, $file);
                }*/
               echo "INSERT INTO `product`(`meta_d`, `meta_k`, `h1`, `title`, `code`, `name`, `categories`, `active`, `availability`, `date`, `user_id`, `article`, `price`, `price_clear`, `logistic`, `provider`, `img`) VALUES ('$name', '$name', '$name', '$name', '$code_name', '$name', '$secID', '1', '0', '$date', '$user', '$article', '0', '0', '0', '0', '$img')"."<br>";
                ///mysql_query("INSERT INTO `product`(`meta_d`, `meta_k`, `h1`, `title`, `code`, `name`, `categories`, `active`, `availability`, `date`, `user_id`, `article`, `price`, `price_clear`, `logistic`, `provider`, `img`) VALUES ('$name', '$name', '$name', '$name', '$code_name', '$name', '$secID', '1', '0', '$date', '$user', '$article', '0', '0', '0', '0', '$img')");
                $id_product = mysql_insert_id();
                echo "INSERT INTO `upload_product_log`(`action`, `article`, `id_provider`, `date`) VALUES ('3', '$article', '$id_provider', '$date')"."<br>";
                ///mysql_query("INSERT INTO `upload_product_log`(`action`, `article`, `id_provider`, `date`) VALUES ('3', '$article', '$id_provider', '$date')");
            }
                echo "INSERT INTO `price_provider_bufer`(`id_product`, `price`, `price_clear`, `logistic`, `id_provider`,`availability`, `date`) VALUES ('$id_product', '$price', '$price_clear', '$logistic', '$id_provider', '$availability', '$date')"."<br>";
                ///mysql_query("INSERT INTO `price_provider_bufer`(`id_product`, `price`, `price_clear`, `logistic`, `id_provider`,`availability`, `date`) VALUES ('$id_product', '$price', '$price_clear', '$logistic', '$id_provider', '$availability', '$date')");

                if ($cat == "1") {
                    echo $widthId = selectFilterElementByValue($filter["width"], '19')."<br>";
                    echo $heigthId = selectFilterElementByValue($filter["heigth"], '21')."<br>";
                    echo $diametrId = selectFilterElementByValue($filter["diameter"], '20')."<br>";
                    echo $filter["season"]."<br>";
                    echo $filter["thorn"]."<br>";
                } elseif ($cat == "2") {
                    echo $diametrId = selectFilterElementByValue($filter["diameter"], '25')."<br>";
                    echo $widthId = selectFilterElementByValue($filter["width"], '26')."<br>";
                    echo $pcdId = selectFilterElementByValue($filter["pcd"], '27')."<br>";
                    echo $filter["et"]."<br>";
                    echo $filter["dia"]."<br>";
                }

        }
    }
    echo "--------------------------------------------------------------------------------"."<br>";
}
?>