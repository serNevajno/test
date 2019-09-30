<?
session_start();
//////Подключение к базе
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
/////Подключение библиотеки
include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');

$query = clearData($_POST['query']);
//$query = 'ДТ. обл. Свердловская, г. Екатеринбург';

$q = explode(".", $query);
$arr = array();

if($q) {
  $result = file_get_contents("https://pecom.ru/ru/calc/towns.php");
  $res = json_decode($result);
  if ($res) {
    //echo "<pre>".print_r($res, true)."</pre>";
    foreach ($res as $obj) {
      foreach ($obj as $key => $val){
        if($val == trim(end($q))){
          $arr['idCity'] = $key;
        }
      }
    }
  }
}
echo json_encode($arr);