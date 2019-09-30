<?if ($_SERVER["REQUEST_METHOD"] == "POST") {
    error_reporting(0);
    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php');
    /////Подключение библиотеки
    include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/function.inc.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/uploadProduct/upFunc.inc.php');

    /////Замок
    include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/lock.inc.php');

    $arr = simplexml_load_file("http://www.shinservice.ru/xml/shinservice-b2b.xml");

    ///echo "<pre>".print_r($arr->tires, true)."</pre>";

    $r = 1;
    $cStart = $_POST["count"];

    $cEnd = $cStart + 100;

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

            $price = getPriceProvide("1", $item["brand"], $item["diam"], mb_strtolower($item["season"]), $item["price"], $id_provider); ///Розничная цена
            $availability = $item["stock"]; ///Итого
            $logistic = "10";

            $date = date("Y-m-d H:i:s");

            $filter = array();
            $filter["width"] = $item["width"];
            $filter["heigth"] = $item["profile"];
            $filter["diameter"] = $item["diam"];
            $filter["season"] = $seasonId;
            $filter["thorn"] = $thornId;

            addProduct($id_provider, "1", $item["sku"], $price, $item["price"], $logistic, $availability, $model, $item["brand"], $name, "", $filter);
        }
        $r++;
    }
    echo $cEnd;
}?>