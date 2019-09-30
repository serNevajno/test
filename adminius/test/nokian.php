<?
    error_reporting(0);
    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php');
    /////Подключение библиотеки
    include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/function.inc.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/uploadProduct/upFunc.inc.php');

    /////Замок
    include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/lock.inc.php');

    $arr = simplexml_load_file($_SERVER["DOCUMENT_ROOT"] . "/provider10tyres.xml");

    //echo "<pre>".print_r($arr, true)."</pre>";

    $r = 1;


    foreach ($arr->offers->offer as $item){
            if ($item->SeasonName == "Зимние шины") {
                $season_name = "Зимняя шина ";
                $seasonId = 156;
                $season = "w";
            } elseif ($item->SeasonName == "Летние шины") {
                $season_name = "Летняя шина ";
                $seasonId = 155;
                $season = "s";
            }else{
                $season_name = "Всесезонная шина";
                $seasonId = 157;
                $season = "u";
            }

            if ($item->param[0] == "true") {
                $thornId = "158";
                $season_name = "Зимняя шина ";
                $seasonId = 156;
                $season = "w";
            } else {
                $thornId = "159";
            }

            $nameClear = $item->prod_info; /// Номенклатура.Наименование
            $model = trim(str_replace("NOKIAN", "", $item->model));
            $name = $season_name . " ".$item->vendor ." ".$model." ". $nameClear;

            if(stristr($name, 'Nordman')) {
                $brand = "Nordman";
            }else{
                $brand = "Nokian";
            }

            $id_provider = '10';

            $price = getPriceProvide("1", $brand, $item->RIM, $season, $item->price, $id_provider); ///Розничная цена
            //echo $name." ".$model." ".$brand."-".$price."(".$item->price.")"." ".$item["id"]." ".$season." ".$thornId;
            //echo "<br>";
            $availability = $item->warehouse; ///Итого
            $logistic = "3";

            $date = date("Y-m-d H:i:s");

            $filter = array();
            $filter["width"] = $item->WIDTH;
            $filter["heigth"] = $item->RATIO;
            $filter["diameter"] = $item->RIM;
            $filter["season"] = $seasonId;
            $filter["thorn"] = $thornId;

            //echo "Сезон - ".$season_name." | id_provider -".$id_provider." | name -".$name." | price - ".$price." | item->price - ". $item->price." | logistic - ".$logistic." | availability - ".$availability." | model - ".$model." | vendor - ".$item->vendor." | filter". print_R($filter, true)."<br>";

            //addProduct($id_provider, "1", $item["id"], $price, $item->price, $logistic, $availability, $model, $brand, $name, "", $filter);
        $r++;
    }
?>