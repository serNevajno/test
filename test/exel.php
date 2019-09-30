<?
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//////Подключение к базе
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
/////Подключение библиотеки
include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');

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

$root = $_SERVER['DOCUMENT_ROOT'];
$filename = $root.'/price_provider/shininvest.xlsx';
$res = parse_excel_file($filename);
echo $res[0][0];
foreach ($res as $item){
  ///echo $item[3]." - ".str_replace(">","", $item[3])."<br>";
  /*$arr = explode(" ", $item[2]);
  $d = explode("x", $arr[2]);
  $e = explode(")", $item[2]);
  if(count($e)>2) {
    $r = explode("/", str_replace(" ", "", $e[2]));
  }else{
    $r = explode("/", str_replace(" ", "", $e[1]));
  }

  $diametr = $d[0];
  $width = $d[1];
  $pcd = str_replace(",", ".", $arr[3]);
  $et = $r[0];
  $dia = str_replace(",", ".", $r[1]);
  echo $item[2]."<br>";
  echo "diametr: ".$d[0]."; width: ".$d[1]."; pcd: ".$pcd."; et: ".$r[0]."; dia: ".$r[1]."<br>";*/
}

echo "<pre>";
print_r($res);
echo "</pre>";
?>