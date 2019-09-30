<?
if($_SERVER["REQUEST_METHOD"]=="POST"){
  error_reporting(0);
  session_start();
  include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
  include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/function.inc.php');
  include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/uploadProduct/upFunc.inc.php');

  function parse_excel_file($filename){
    // подключаем библиотеку
    require_once $_SERVER['DOCUMENT_ROOT'] . '/adminius/apiXls/PHPExcel.php';
    $result = array();

    // получаем тип файла (xls, xlsx), чтобы правильно его обработать
    $file_type = PHPExcel_IOFactory::identify($filename);
    // создаем объект для чтения
    $objReader = PHPExcel_IOFactory::createReader($file_type);
    $objPHPExcel = $objReader->load($filename); // загружаем данные файла в объект
    $result = $objPHPExcel->getActiveSheet()->toArray(); // выгружаем данные из объекта в массив

    return $result;
  }

  $cStart = $_POST["count"];
  $cEnd = $cStart + 100;
  $r = 3;
  $provider = '9';
  $res = parse_excel_file($_SERVER['DOCUMENT_ROOT'] . "/price_provider/shininvest.xlsx");
  foreach ($res as $item) {
    if ($r > $cStart AND $r<$cEnd) {
      $article = $item[1]; ///Номенклатура.Артикул
      $marka = ""; ////Номенклатура.Общ Производитель
      $name = $item[2];
      $model = ""; ////Номенклатура.Общ. Модель
      ////////////////////////////////////////
      $arr = explode(" ", $item[2]);
      $d = explode("x", $arr[2]);
      $e = explode(")", $item[2]);
      if(count($e)>2) {
        $rad = explode("/", str_replace(" ", "", $e[2]));
      }else{
        $rad = explode("/", str_replace(" ", "", $e[1]));
      }

      $diametr = $d[0];
      $width = $d[1];
      $pcd = str_replace(",", ".", $arr[3]);
      $et = $rad[0];
      $dia = str_replace(",", ".", $rad[1]);
      ////////////////////////////////////////
      $price_clear = $item[7]; ///Цена B2B
      $price = getPriceProvide("2", $marka, $diametr, "", $price_clear, $provider); ///Розничная цена
      $availability = str_replace(">","", $item[3]); ///Итого
      $logistic = '1';
      $date = date("Y-m-d H:i:s");

      $filter = array();
      $filter["diameter"] = $diametr;
      $filter["width"] = $width;
      $filter["pcd"] = $pcd;
      $filter["dia"] = $dia;
      $filter["et"] = $et;
      addProduct($provider, "2", $article, $price, $price_clear, $logistic, $availability, $model, $marka, $name, $item[8], $filter);
    }
    $r++;
  }
  echo $cEnd;
}
?>