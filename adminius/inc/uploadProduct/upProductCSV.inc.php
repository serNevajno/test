<?//if($_SERVER["REQUEST_METHOD"]=="POST"){
error_reporting(0);
session_start();
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/function.inc.php');
include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/uploadProduct/upFunc.inc.php');
/////Замок
include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/lock.inc.php');

if($_POST["type"] == "1"){
    $nameFile = "provider3tyres.csv";
}elseif($_POST["type"] == "2"){
    $nameFile = "provider3disk.csv";
}elseif($_POST["type"] == "3"){
    $nameFile = "provider4tyres.csv";
}elseif($_POST["type"] == "4"){
    $nameFile = "provider4disk.csv";
}elseif ($_POST["type"] == "5") {
    $nameFile = "provider5tyres.csv";
}elseif ($_POST["type"] == "6") {
    $nameFile = "provider5disk.csv";
}elseif ($_POST["type"] == "7") {
    $nameFile = "provider5TolDisk.csv";
}elseif ($_POST["type"] == "8") {
    $nameFile = "provider7Tyres.csv";
}elseif ($_POST["type"] == "9") {
    $nameFile = "provider7Disk.csv";
} elseif ($_POST["type"] == "10") {
    $nameFile = "provider8Tyres.csv";
} elseif ($_POST["type"] == "11") {
    $nameFile = "provider8Disk.csv";
} elseif ($_POST["type"] == "all1") {
    $nameFile = "AllTyres.csv";
} elseif ($_POST["type"] == "all2") {
    $nameFile = "AllDisk.csv";
}

@mysql_query('set character_set_client="utf8"');
@mysql_query('set character_set_results="utf8"');
@mysql_query('set collation_connection="utf8_general_ci"');
if(!setlocale(LC_ALL, 'ru_RU.utf8')) setlocale(LC_ALL, 'en_US.utf8');

$file = fopen('php://memory', 'w+');
fwrite($file, iconv('CP1251','UTF-8', file_get_contents($_SERVER['DOCUMENT_ROOT']."/price_provider/".$nameFile)));
rewind($file);
$r = 1;

$mes ="";

if($_POST["count"] == 1){
    if($_POST["type"] == "1") {
        $cStart = 6;
    }elseif($_POST["type"] == "2"){
        $cStart = 5;
    }elseif($_POST["type"] == "3"){
        $cStart = 2;
    }elseif($_POST["type"] == "4"){
        $cStart = 2;
    }elseif($_POST["type"] == "5"){
        $cStart = 1;
    }elseif($_POST["type"] == "6"){
        $cStart = 1;
    }elseif($_POST["type"] == "7"){
        $cStart = 1;
    }elseif($_POST["type"] == "8"){
        $cStart = 1;
    }elseif($_POST["type"] == "9"){
        $cStart = 1;
    } elseif ($_POST["type"] == "10") {
        $cStart = 1;
    } elseif ($_POST["type"] == "11") {
        $cStart = 1;
    } elseif ($_POST["type"] == "all1") {
      $cStart = 1;
    } elseif ($_POST["type"] == "all2") {
      $cStart = 1;
    }
}else{
    $cStart = $_POST["count"];
}
$cEnd = $cStart + 100;
while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
    if ($r > $cStart AND $r<$cEnd) {
        if($_POST["type"] == "1") {
            $season = mysql_escape_string($data[0]); ///Сезон
            if ($season == "W") {
                $season_name = "Зимняя шина ";
                $seasonId = 156;
            } elseif ($season == "S") {
                $season_name = "Летняя шина ";
                $seasonId = 155;
            } elseif ($season == "U") {
                $season_name = "Всесезонная шина";
                $seasonId = 157;
            }

            $article = mysql_escape_string($data[3]); ///Номенклатура.Артикул
            $marka = mysql_escape_string($data[6]); ////Номенклатура.Общ Производитель
            $nameClear = mysql_escape_string($data[4]); /// Номенклатура.Наименование
            $name = $season_name . $marka . " " . $nameClear;
            $model = mysql_escape_string($data[7]); ////Номенклатура.Общ. Модель
            $diameterClear = mysql_escape_string($data[8]); ///Номенклатура.Диски Диаметр
            $diameter = str_replace("R", "", $diameterClear);
            $width = mysql_escape_string($data[9]); ///Номенклатура.Ширина
            $heigth = mysql_escape_string($data[10]); ///Номенклатура.Высота

            $price_clear = mysql_escape_string($data[14]); ///Цена B2B
            $price = getPriceProvide("1", $marka, $diameter, mb_strtolower($season), $price_clear, "3"); ///Розничная цена
            $availability = mysql_escape_string($data[17]); ///Итого
            $logistic = '7';

            $date = date("Y-m-d H:i:s");
            $id_provider = '3';

            $filter = array();
            $filter["width"] = $width;
            $filter["heigth"] = $heigth;
            $filter["diameter"] = $diameter;
            $filter["season"] = $seasonId;
            $filter["thorn"] = "159";

            addProduct($id_provider, "1", $article, $price, $price_clear, $logistic, $availability, $model, $marka, $name, "", $filter);
        }elseif($_POST["type"] == "2") {
            $article = mysql_escape_string($data[2]); ///Номенклатура.Артикул
            $marka = mysql_escape_string($data[5]); ////Номенклатура.Общ Производитель
            $nameClear = mysql_escape_string($data[3]); /// Номенклатура.Наименование
            $name = $marka . " " . $nameClear;
            $model = mysql_escape_string($data[6]); ////Номенклатура.Общ. Модель
            $dh = mysql_escape_string($data[7]); ///Номенклатура.Диски Диаметр
            $dh = explode(" / ", $dh);
            $diameter = $dh[0];
            $width = str_replace("J", "", $dh[0]);
            $width = str_replace(".0", "", $width);
            $pcd = mysql_escape_string($data[8]);
            $pcd = str_replace("PCD ", "", $pcd);
            $dia = mysql_escape_string($data[9]);
            if($dia!="*"){
                $dia = str_replace("ЦО ", "", $dia);
            }else{
                $dia = 0;
            }
            $et = mysql_escape_string($data[9]);
            $et = str_replace("ET  ", "", $et);
            $price_clear = mysql_escape_string($data[14]); ///Цена B2B
            $price = getPriceProvide("2", $marka, $diameter, "", $price_clear, "3"); ///Розничная цена
            $availability = mysql_escape_string($data[17]); ///Итого
            $availability = preg_replace("/[^0-9]/", '', $availability);
            $logistic = '7';
            $code_marka = greateLink($marka);
            $code_model = greateLink($model);
            $date = date("Y-m-d H:i:s");
            $id_provider = '3';

            $filter = array();
            $filter["diameter"] = $diameter;
            $filter["width"] = $width;
            $filter["pcd"] = $pcd;
            $filter["dia"] = $dia;
            $filter["et"] = $et;
            addProduct($id_provider, "2", $article, $price, $price_clear, $logistic, $availability, $model, $marka, $name, "", $filter);
        }elseif($_POST["type"] == "3") {
            $season = mysql_escape_string($data[4]); ///Сезон
            if ($season == "Зима") {
                $season_name = "Зимняя шина ";
                $seasonId = 156;
                $season_price = "w";
            } elseif ($season == "Лето") {
                $season_name = "Летняя шина ";
                $seasonId = 155;
                $season_price = "s";
            } elseif ($season == "Всесезон") {
                $season_name = "Всесезонная шина";
                $seasonId = 157;
                $season_price = "u";
            }

            $thorn = mysql_escape_string($data[5]);
            if($thorn == "ш."){
                $thornId = "158";
            }else{
                $thornId = "159";
            }

            $article = mysql_escape_string($data[6]); ///Номенклатура.Артикул
            $marka = mysql_escape_string($data[8]); ////Номенклатура.Общ Производитель
            $nameClear = mysql_escape_string($data[9]); /// Номенклатура.Наименование
            $name = $season_name . " " . $nameClear;
            $model = ""; ////Номенклатура.Общ. Модель
            $diameter = mysql_escape_string($data[3]); ///Номенклатура.Диски Диаметр

            $width = mysql_escape_string($data[1]); ///Номенклатура.Ширина
            $heigth = mysql_escape_string($data[2]); ///Номенклатура.Высота

            $price_clear = mysql_escape_string($data[10]); ///Цена B2B

            $price = getPriceProvide("1", $marka, $diameter, mb_strtolower($season_price), $price_clear, "4"); ///Розничная цена

            $availability1 = str_replace(">", "", mysql_escape_string($data[15]));
            $availability2 = str_replace(">", "", mysql_escape_string($data[16]));
            $availability3 = str_replace(">", "", mysql_escape_string($data[17]));
            $availability = $availability1+$availability2+$availability3;


            $logistic = '10';

            $date = date("Y-m-d H:i:s");
            $id_provider = '4';

            $filter = array();
            $filter["width"] = $width;
            $filter["heigth"] = $heigth;
            $filter["diameter"] = $diameter;
            $filter["season"] = $seasonId;
            $filter["thorn"] = $thornId;

            addProduct($id_provider, "1", $article, $price, $price_clear, $logistic, $availability, $model, $marka, $name, "", $filter);
        }elseif($_POST["type"] == "4") {
            $article = mysql_escape_string($data[5]); ///Номенклатура.Артикул
            $marka = mysql_escape_string($data[7]); ////Номенклатура.Общ Производитель
            $name = mysql_escape_string($data[8]); /// Номенклатура.Наименование

            $model =""; ////Номенклатура.Общ. Модель

            $diameter = mysql_escape_string($data[1]);
            $width = mysql_escape_string($data[2]);
            $pcd = mysql_escape_string($data[0]);
            $pcd = str_replace("*", "x", $pcd);

            $dia = mysql_escape_string($data[3]);
            $et = mysql_escape_string($data[4]);

            $price_clear = mysql_escape_string($data[9]); ///Цена
            $price = getPriceProvide("2", $marka, $diameter, "", $price_clear, "4"); ///Розничная цена
            $availability1 = str_replace(">", "", mysql_escape_string($data[13]));
            $availability2 = str_replace(">", "", mysql_escape_string($data[14]));
            $availability3 = str_replace(">", "", mysql_escape_string($data[15]));
            $availability = $availability1+$availability2+$availability3;

            $logistic = '10';

            $date = date("Y-m-d H:i:s");
            $id_provider = '4';

            $filter = array();
            $filter["diameter"] = $diameter;
            $filter["width"] = $width;
            $filter["pcd"] = $pcd;
            $filter["dia"] = $dia;
            $filter["et"] = $et;

            addProduct($id_provider, "2", $article, $price, $price_clear, $logistic, $availability, $model, $marka, $name, "", $filter);
        }elseif($_POST["type"] == "5") {
            $season = mysql_escape_string($data[12]); ///Сезон
            if ($season == "зимняя") {
                $season_name = "Зимняя шина ";
                $seasonId = 156;
                $seasonF = "w";
            } elseif ($season == "летняя") {
                $season_name = "Летняя шина ";
                $seasonId = 155;
                $seasonF = "s";
            } elseif ($season == "") {
                $season_name = "Всесезонная шина";
                $seasonId = 157;
                $seasonF = "u";
            }

            $thorn = mysql_escape_string($data[5]);
            if($thorn == "шип"){
                $thornId = "158";
            }else{
                $thornId = "159";
            }

            $article = mysql_escape_string($data[0]); ///Номенклатура.Артикул
            $marka = mysql_escape_string($data[2]); ////Номенклатура.Общ Производитель
            $nameClear = mysql_escape_string($data[4]); /// Номенклатура.Наименование
            $name = $season_name." ". $nameClear;
            $model = mysql_escape_string($data[3]); ////Номенклатура.Общ. Модель
            $diameter = mysql_escape_string($data[6]); ///Номенклатура.Диски Диаметр

            $width = mysql_escape_string($data[9]); ///Номенклатура.Ширина
            $heigth = mysql_escape_string($data[8]); ///Номенклатура.Высота

            $price_clear = mysql_escape_string($data[14]); ///Цена B2B
            $id_provider = '5';
            $price = getPriceProvide("1", $marka, $diameter, $seasonF, $price_clear, $id_provider); ///Розничная цена
            $availability = mysql_escape_string($data[13]); ///Итого
            $logistic = '1';

            $date = date("Y-m-d H:i:s");

            $filter = array();
            $filter["width"] = $width;
            $filter["heigth"] = $heigth;
            $filter["diameter"] = $diameter;
            $filter["season"] = $seasonId;
            $filter["thorn"] = $thornId;

            addProduct($id_provider, "1", $article, $price, $price_clear, $logistic, $availability, $model, $marka, $name, "", $filter);
        }elseif($_POST["type"] == "6") {
            $article = mysql_escape_string($data[3]); ///Номенклатура.Артикул
            $marka = mysql_escape_string($data[0]); ////Номенклатура.Общ Производитель
            $name = mysql_escape_string($data[4]); /// Номенклатура.Наименование

            $model = mysql_escape_string($data[1]); ////Номенклатура.Общ. Модель

            $diameter = mysql_escape_string($data[6]);
            $width = str_replace(",", ".", mysql_escape_string($data[5]));
            $pcd_kol = mysql_escape_string($data[7]);
            $pcd_width = str_replace(",", ".", mysql_escape_string($data[8]));
            $pcd = $pcd_kol."x".$pcd_width;

            $dia = str_replace(",", ".", mysql_escape_string($data[10]));
            $et = str_replace(",", ".", mysql_escape_string($data[9]));

            $price_clear = mysql_escape_string($data[15]); ///Цена

            $id_provider = '5';
            $price = getPriceProvide("2", $marka, $diameter, "", $price_clear, $id_provider); ///Розничная цена
            $availability = mysql_escape_string($data[16]);

            $logistic = '1';

            $date = date("Y-m-d H:i:s");

            $filter = array();
            $filter["diameter"] = $diameter;
            $filter["width"] = $width;
            $filter["pcd"] = $pcd;
            $filter["dia"] = $dia;
            $filter["et"] = $et;

            addProduct($id_provider, "2", $article, $price, $price_clear, $logistic, $availability, $model, $marka, $name, "", $filter);
        }elseif($_POST["type"] == "7") {
            $article = mysql_escape_string($data[3]); ///Номенклатура.Артикул
            $marka = mysql_escape_string($data[0]); ////Номенклатура.Общ Производитель
            $name = mysql_escape_string($data[4]); /// Номенклатура.Наименование

            $model = mysql_escape_string($data[1]); ////Номенклатура.Общ. Модель

            $diameter = mysql_escape_string($data[6]);
            $width = str_replace(",0", "", mysql_escape_string($data[5]));
            $width = str_replace(",", ".", $width);
            $pcd_kol = mysql_escape_string($data[7]);
            $pcd_width = str_replace(",", ".", mysql_escape_string($data[8]));
            $pcd = $pcd_kol."x".$pcd_width;

            $dia = str_replace(",", ".", mysql_escape_string($data[10]));
            $et =str_replace(",", ".", mysql_escape_string($data[9]));;

            $price_clear = mysql_escape_string($data[15]); ///Цена

            $id_provider = '5';
            $price = getPriceProvide("2", $marka, $diameter, "", $price_clear, $id_provider); ///Розничная цена
            $availability = mysql_escape_string($data[16]);

            $logistic = '10';

            $date = date("Y-m-d H:i:s");

            $filter = array();
            $filter["diameter"] = $diameter;
            $filter["width"] = $width;
            $filter["pcd"] = $pcd;
            $filter["dia"] = $dia;
            $filter["et"] = $et;

            addProduct($id_provider, "2", $article, $price, $price_clear, $logistic, $availability, $model, $marka, $name, "", $filter);
        }elseif($_POST["type"] == "8") {
            $article = mysql_escape_string($data[0]); ///Номенклатура.Артикул
            $price_clear = mysql_escape_string($data[4]); ///Цена B2B
            $item = selectProductByArtiсleForCSV($article, 1);
            $price = getPriceProvide("1", $item["brand"], $item["diameter"], $item["season"], $price_clear, "7"); ///Розничная цена
            $availability = mysql_escape_string($data[2]); ///Итого
            $logistic = '0';

            $date = date("Y-m-d H:i:s");
            $id_provider = '7';

            addProduct($id_provider, "1", $article, $price, $price_clear, $logistic, $availability, "", "", "", "", "");
        }elseif($_POST["type"] == "9") {
            $article = mysql_escape_string($data[0]); ///Номенклатура.Артикул
            $price_clear = mysql_escape_string($data[4]); ///Цена B2B
            $item = selectProductByArtiсleForCSV($article, 2);
            $price = getPriceProvide("2", $item["brand"], $item["diameter"], "", $price_clear, "7"); ///Розничная цена
            $availability = mysql_escape_string($data[2]); ///Итого
            $logistic = '0';

            $date = date("Y-m-d H:i:s");
            $id_provider = '7';

            addProduct($id_provider, "2", $article, $price, $price_clear, $logistic, $availability, "", "", "", "", "");
        }elseif($_POST["type"] == "10") {
            $article = mysql_escape_string($data[0]); ///Номенклатура.Артикул
            $price_clear = mysql_escape_string($data[4]); ///Цена B2B
            $item = selectProductByArtiсleForCSV($article, 1);
            $price = getPriceProvide("1", $item["brand"], $item["diameter"], $item["season"], $price_clear, "8"); ///Розничная цена
            $availability = mysql_escape_string($data[2]); ///Итого
            $logistic = '0';

            $date = date("Y-m-d H:i:s");
            $id_provider = '8';

            addProduct($id_provider, "1", $article, $price, $price_clear, $logistic, $availability, "", "", "", "", "");
        }elseif($_POST["type"] == "11") {
            $article = mysql_escape_string($data[0]); ///Номенклатура.Артикул
            $price_clear = mysql_escape_string($data[4]); ///Цена B2B
            $item = selectProductByArtiсleForCSV($article, 2);
            $price = getPriceProvide("2", $item["brand"], $item["diameter"], "", $price_clear, "8"); ///Розничная цена
            $availability = mysql_escape_string($data[2]); ///Итого
            $logistic = '0';

            $date = date("Y-m-d H:i:s");
            $id_provider = '8';

            addProduct($id_provider, "2", $article, $price, $price_clear, $logistic, $availability, "", "", "", "", "");
        }elseif($_POST["type"] == "12") {

        }elseif($_POST["type"] == "all1"){
          $season = mysql_escape_string($data[0]); ///Сезон
          if ($season == "Зима") {
            $season_name = "Зимняя шина ";
            $seasonId = 156;
            $season_price = "w";
          } elseif ($season == "Лето") {
            $season_name = "Летняя шина ";
            $seasonId = 155;
            $season_price = "s";
          } elseif ($season == "Всесезон") {
            $season_name = "Всесезонная шина";
            $seasonId = 157;
            $season_price = "u";
          }

          $thorn = mysql_escape_string($data[5]);
          if($thorn == "ш"){
            $thornId = "158";
          }else{
            $thornId = "159";
          }

          $article = mysql_escape_string($data[1]); ///Номенклатура.Артикул
          $marka = mysql_escape_string($data[3]); ////Номенклатура.Общ Производитель
          $nameClear = mysql_escape_string($data[2]); /// Номенклатура.Наименование
          $name = $season_name . " " . $nameClear;
          $model = mysql_escape_string($data[4]); ////Номенклатура.Общ. Модель
          $diameter = mysql_escape_string($data[5]); ///Номенклатура.Диски Диаметр

          $width = mysql_escape_string($data[6]); ///Номенклатура.Ширина
          $heigth = mysql_escape_string($data[7]); ///Номенклатура.Высота

          $filter = array();
          $filter["width"] = $width;
          $filter["heigth"] = $heigth;
          $filter["diameter"] = $diameter;
          $filter["season"] = $seasonId;
          $filter["thorn"] = $thornId;

          addProduct("", "1", $article, "", "", "", "", $model, $marka, $name, "", $filter);
        }elseif($_POST["type"] == "all2"){
          $article = mysql_escape_string($data[3]); ///Номенклатура.Артикул
          $marka = mysql_escape_string($data[0]); ////Номенклатура.Общ Производитель
          $name = mysql_escape_string($data[4]); /// Номенклатура.Наименование

          $model = mysql_escape_string($data[1]); ////Номенклатура.Общ. Модель

          $diameter = mysql_escape_string($data[6]);
          $width = str_replace(",0", "", mysql_escape_string($data[5]));
          $width = str_replace(",", ".", $width);
          $pcd_kol = mysql_escape_string($data[7]);
          $pcd_width = str_replace(",", ".", mysql_escape_string($data[8]));
          $pcd = $pcd_kol."x".$pcd_width;

          $dia = str_replace(",", ".", mysql_escape_string($data[10]));
          $et =str_replace(",", ".", mysql_escape_string($data[9]));;


          $filter = array();
          $filter["diameter"] = $diameter;
          $filter["width"] = $width;
          $filter["pcd"] = $pcd;
          $filter["dia"] = $dia;
          $filter["et"] = $et;

          addProduct($id_provider, "2", $article, $price, $price_clear, $logistic, $availability, $model, $marka, $name, "", $filter);
        }
    }
    $r++;
}
fclose($file);
echo $cEnd;
?>