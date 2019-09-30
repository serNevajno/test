<?if ($_SERVER["REQUEST_METHOD"] == "POST") {
	error_reporting(0);
    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php');
    /////Подключение библиотеки
    include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/function.inc.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/uploadProduct/upFunc.inc.php');

    /////Замок
    include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/lock.inc.php');

    $arr = file_get_contents($_POST["url"]);
    $res = json_decode($arr, TRUE);

    $r = 1;
    $cStart = $_POST["count"];

    $cEnd = $cStart + 100;
    $arrType = array("Легковые летние", "Легковые зимние", "Легкогрузовые летние", "Легкогрузовые зимние", "Неошипованные легковые", "Неошипованные легкогрузовые", "Нешипуемые легкогрузовые", "Нешипуемые легковые", "Фрикционные легковые", "Фрикционные легкогрузовые",  "Шипованные легковые", "Шипованные легкогрузовые");
    foreach ($res as $item){
        if ($r > $cStart AND $r<$cEnd) {
            if($_POST["type"] == "tyres") {
                if(in_array($item["type"], $arrType)) {
                    if ($item["season"] == "winter") {
                        $season_name = "Зимняя шина ";
                        $seasonId = 156;
                        $season = "w";
                    } elseif ($item["season"] == "summer") {
                        $season_name = "Летняя шина ";
                        $seasonId = 155;
                        $season = "s";
                    } elseif ($item["season"] == "allseason") {
                        $season_name = "Всесезонная шина";
                        $seasonId = 157;
                        $season = "u";
                    }

                    if ($item["thorn"] == "1") {
                        $thornId = "158";
                    } else {
                        $thornId = "159";
                    }

                    $nameClear = $item["name"]; /// Номенклатура.Наименование
                    $name = $season_name . " " . $nameClear;

                    $id_provider = '6';

                    $price = getPriceProvide("1", $item["brand"], $item["diametr"], $season, $item["price"], $id_provider); ///Розничная цена
                    $availability = $item["restyar"] + $item["restspb"] + $item["restekb"] + $item["restrnd"] + $item["restmsk"]; ///Итого
                    $logistic = 5;

                    $date = date("Y-m-d H:i:s");

                    $filter = array();
                    $filter["width"] = $item["width"];
                    $filter["heigth"] = $item["height"];
                    $filter["diameter"] = $item["diametr"];
                    $filter["season"] = $seasonId;
                    $filter["thorn"] = $thornId;

                    addProduct($id_provider, "1", $item["article"], $price, $item["price"], $logistic, $availability, $item["model"], $item["brand"], $name, $item["picture"], $filter);
                }
            }elseif($_POST["type"] == "disk"){
                $id_provider = '6';

                $price = getPriceProvide("2", $item["brand"], $item["diametr"], "", $item["price"], $id_provider); ///Розничная цена
                $availability = $item["restyar"] + $item["restspb"] + $item["restekb"] + $item["restrnd"] + $item["restmsk"]; ///Итого
                $logistic = 7;

                $date = date("Y-m-d H:i:s");

                $filter = array();
                $filter["diameter"] = $item["diametr"];
                $filter["width"] = $item["width"];
                $filter["pcd"] = $item["bolts_count"]."x".$item["bolts_spacing"];
                $filter["dia"] = $item["dia"];
                $filter["et"] = $item["et"];

                addProduct($id_provider, "2", $item["article"], $price, $item["price"], $logistic, $availability, $item["model"], $item["brand"], $item["name"], $item["picture"], $filter);
            }
        }
        $r++;
    }
    echo $cEnd;
}?>