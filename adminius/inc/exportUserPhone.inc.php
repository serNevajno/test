<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
# подключаем библиотеку
//////Подключение к базе
  include($_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php');
/////Подключение библиотеки
  include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/function.inc.php');
  require_once($_SERVER['DOCUMENT_ROOT'] . "/adminius/apiXls/PHPExcel.php");

  $type = clearData($_POST['typeUser'], "i");

# Массив с данными
  function sUserPhone($type = '')
  {
    $query = "";

    if ($_POST['from'] AND $_POST['to']) {
      if (!empty($query)) $query .= " AND";
      $query .= " date_end>='$_POST[from] 00:00:00' AND date_end<='$_POST[to] 23:59:59'";
    }

    if (!empty($type)) {
      if (!empty($query)) $query .= " AND";
      $query .= " typeUser = $type";
    }

    if (!empty($query)) {
      $query = "WHERE" . $query;
    }

    return db2array("SELECT `name`, `phone` FROM `orders` $query GROUP BY `phone`", 2);
  }

  $objPHPExcel = new PHPExcel();
  $objPHPExcel->getProperties()->setCreator("vplaton.pro")
    ->setLastModifiedBy("dobrayashina")
    ->setTitle("User phone")
    ->setCategory("User phone");

  $i = null;
  foreach (sUserPhone($type) as $val) {
    $i++;
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A$i", $val[name]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B$i", $val[phone]);
    //$objPHPExcel->setActiveSheetIndex(0)->setCellValue("C$i", $val[email]);
    //$objPHPExcel->setActiveSheetIndex(0)->setCellValue("D$i", $val[ip]);
  }

  $objPHPExcel->setActiveSheetIndex(0);
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment;filename="userPhone.xlsx"');
  header('Cache-Control: max-age=0');
  header('Cache-Control: max-age=1');

  header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
  header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
  header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
  header('Pragma: public'); // HTTP/1.0

  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  $objWriter->save($_SERVER['DOCUMENT_ROOT'].'/price_provider/userPhone.xlsx');
  readfile($_SERVER['DOCUMENT_ROOT'].'/price_provider/userPhone.xlsx');
}