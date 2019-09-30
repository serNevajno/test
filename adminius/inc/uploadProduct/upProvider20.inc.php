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

    $arr = simplexml_load_file($_SERVER['DOCUMENT_ROOT']."/price_provider/prov20.xml");

    $cStart = $_POST["count"];

    /* echo "<pre>";
     print_r($res);
     echo "</pre>";*/

    $cEnd = $cStart + 50;
    $r=0;
    foreach ($arr->product as $item) {
                if ($r > $cStart AND $r < $cEnd) {
                    if($item->type == "tire"){
                        $type = "1";
                    }elseif($item->type == "disk"){
                        $type = "2";
                    }

                    if($type == "1") {
                        if ($item->propertes->season == "ЗИМА") {
                            $season_name = "Зимняя шина ";
                            $seasonId = 156;
                            $season = "w";
                        } elseif ($item->propertes->season == "ЛЕТО") {
                            $season_name = "Летняя шина ";
                            $seasonId = 155;
                            $season = "s";
                        } else{
                            $season_name = "Всесезонная шина";
                            $seasonId = 157;
                            $season = "u";
                        }


                        $filter = array();
                        $filter["width"] = $item->propertes->width;
                        $filter["heigth"] = $item->propertes->height;
                        $filter["diameter"] = $item->propertes->radius;
                        $filter["season"] = $seasonId;
                        $filter["thorn"] = 159;
                        if($seasonId == '156'){
                            $tempID = db2array("SELECT id FROM product WHERE article='$item->articleexternal'");
                            $filter["thorn"] = 0;
                            if(!$tempID["id"]){
                                $secID = checkCategoriesProduct($item->brand, $item->model);
                                if($secID){
                                    $idFil = db2array("SELECT t2.element_value FROM `product` as t1 LEFT JOIN `filter_value` as t2 on(t1.id=t2.id_product) WHERE t1.categories='$secID' AND t2.id_filter='24' LIMIT 1");
                                    $filter["thorn"] = $idFil["element_value"];
                                }
                            }
                        }

                        $name_clear = str_replace("Автошина ", "", $item->name);
                        $name = $season_name . " ".$name_clear;
                    }elseif($type == "2"){
                        $filter = array();
                        $filter["diameter"] = $item->propertes->radius;
                        $filter["width"] = $item->propertes->width;
                        $filter["pcd"] = $item->propertes->numberfixtures."x".$item->propertes->wheelbase;
                        $filter["dia"] = $item->propertes->dia;
                        $filter["et"] = $item->propertes->et;

                        $season = "";
                        $name = $item->name;
                    }

                    $id_provider = '20';
                    $price = getPriceProvide($type, $item->brand, $item->radius, $season, $item->price, $id_provider); ///Розничная цена
                    $availability = $item->quantity; ///Итого
                    $logistic = 4;
                    if($type == 1) {
                      addProduct($id_provider, $type, $item->articleexternal, $price, $item->price, $logistic, $availability, $item->model, $item->brand, $name, $item->image, $filter);
                    }
                }
                $r++;

    }

    echo $cEnd;
}?>