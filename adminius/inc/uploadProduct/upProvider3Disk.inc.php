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

    //echo "<pre>".print_r($arr->wheels, true)."</pre>";

    $r = 1;
    $cStart = $_POST["count"];

    $cEnd = $cStart + 100;

    foreach ($arr->wheels->wheel as $item){
        if ($r > $cStart AND $r<$cEnd) {
            //echo "<pre>".print_r($item, true)."</pre>";
            $model = $item["model"];
            $size = explode(" / ", $item["size"]);
            $diameter = $size[0];
            $width = str_replace("J", "", $size[1]);
            $p = explode(".", $item["pcd"]);
            $pc = $p[0];
            if($p[1]>0){
                $pc.=".".$p[1];
            }
            $pcd = $item["bp"]."x".$pc;
            $name = "Диск" . " ".$item["brand"]." ".$model." R".$diameter."/".$width." | ".$pcd." ET ".$item["et"];

            $id_provider = '3';

            $price = getPriceProvide("2", $item["brand"], $diameter, "", $item["price"], $id_provider); ///Розничная цена
            $availability = $item["stock"]; ///Итого
            $logistic = "10";

            $date = date("Y-m-d H:i:s");

            $filter = array();
            $filter["diameter"] = $diameter;
            $filter["width"] = $width;
            $filter["pcd"] = $pcd;
            $filter["dia"] = $item["centerbore"];
            $filter["et"] = $item["et"];

            addProduct($id_provider, "2", $item["sku"], $price, $item["price"], $logistic, $availability, $model, $item["brand"], $name, "", $filter);
        }
        $r++;
    }
    echo $cEnd;
}?>