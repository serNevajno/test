<?if ($_SERVER["REQUEST_METHOD"] == "POST") {
    error_reporting(0);
    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php');
    /////Подключение библиотеки
    include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/function.inc.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/uploadProduct/upFunc.inc.php');

    /////Замок
    include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/lock.inc.php');
    $aRes = array();

    $cStart = $_POST["count"];
    $skl = $_POST["skl"];

    if($skl == "1"){
        $id_provider = '19';//Моска
        $logistic = 10;
        $nameFile = "prov19.xml";
    }elseif($skl == "2"){
        $id_provider = '21';///Пермь
        $logistic = 4;
        $nameFile = "prov21.xml";
    }elseif($skl == "3"){
        $id_provider = '22';///НН
        $logistic = 7;
        $nameFile = "prov22.xml";
    }elseif($skl == "4"){
        $id_provider = '23';///Уфа
        $logistic = 7;
        $nameFile = "prov23.xml";
    }
    /* echo "<pre>";
     print_r($res);
     echo "</pre>";*/
    $arr = simplexml_load_file($_SERVER['DOCUMENT_ROOT']."/price_provider/".$nameFile);

    $cEnd = $cStart + 20;
    $r=0;
    foreach ($arr->COMMODITIES as $item) {
        if ($item->attributes()["NAME"] == "TYRE") {///OR $item->attributes()["NAME"] == "DISK"
            foreach ($item->COMMODITY as $prod) {
                if ($r > $cStart AND $r < $cEnd) {
                    if($item->attributes()["NAME"] == "TYRE"){
                        $type = "1";
                    }elseif($item->attributes()["NAME"] == "DISK"){
                        $type = "2";
                    }

                    if($type == "1") {
                        if ($prod->SSEASON == "Зимняя") {
                            $season_name = "Зимняя шина ";
                            $seasonId = 156;
                            $season = "w";
                        } elseif ($prod->SSEASON == "Летняя") {
                            $season_name = "Летняя шина ";
                            $seasonId = 155;
                            $season = "s";
                        } elseif ($prod->SSEASON == "Всесезонная") {
                            $season_name = "Всесезонная шина";
                            $seasonId = 157;
                            $season = "u";
                        }

                        if ($prod->STHORNING == "Ш.") {
                            $thornId = "158";
                        } else {
                            $thornId = "159";
                        }

                        $filter = array();
                        $filter["width"] = $prod->SWIDTH;
                        $filter["heigth"] = $prod->SHEIGHT;
                        $filter["diameter"] = $prod->SDIAMETR;
                        $filter["season"] = $seasonId;
                        $filter["thorn"] = $thornId;
                        $SMODIFNAME = str_replace($prod->SMARKA, $prod->SMARKORIG, $prod->SMODIFNAME);
                        $name = $season_name . " ".$SMODIFNAME;
                        if($prod->SMARKORIG == ''){
                            $brand = $prod->SMARKA;
                        }else{
                            $brand = $prod->SMARKORIG;
                        }

                    }elseif($type == "2"){
                        $filter = array();
                        $filter["diameter"] = $prod->SDIAMETR;
                        $filter["width"] = str_replace('.0','',str_replace(',','.',$prod->SWIDTH));
                        $filter["pcd"] = $prod->SHOLESQUANT."x".str_replace(',','.',$prod->SPCD);
                        $filter["dia"] = str_replace(',','.',$prod->SDIA);
                        $filter["et"] = str_replace(',','.',$prod->SWHEELOFFSET);

                        $season = "";
                        $name = $prod->SMODIFNAME;
                        $brand = $prod->SMARKA;
                    }


                    $price = getPriceProvide($type, $brand, $prod->SDIAMETR, $season, $prod->NPRICE_PREPAYMENT, $id_provider); ///Розничная цена
                    $availability = $prod->NREST; ///Итого


                    addProduct($id_provider, $type, $prod->SMNFCODE, $price, $prod->NPRICE_PREPAYMENT, $logistic, $availability, $prod->SMODEL, $brand, $name, $prod->SPICTURE, $filter);
                }
                $r++;
            }
        }
    }

    echo $cEnd;
}?>