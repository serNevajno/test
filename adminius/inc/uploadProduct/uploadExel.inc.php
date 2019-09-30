<?
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  session_start();
  include($_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php');
  /////Подключение библиотеки
  include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/function.inc.php');

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

  $name = explode(".", $_FILES["file_exel"]["name"]);
  if ($name[1] == "xlsx") {
    $nameFile = "shininvest.xlsx";
    if (copy($_FILES["file_exel"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/price_provider/" . $nameFile)) {
      $mess=0;
      $res = parse_excel_file($_SERVER['DOCUMENT_ROOT'] . "/price_provider/" . $nameFile);
      if($res[0][0] == "disk9"){
        foreach ($res as $item) {
          $mess++;
        }
      }else{
        $mess = "error";
      }
    } else {
      $mess = 0;
    }
  }
  echo $mess;
}
?>