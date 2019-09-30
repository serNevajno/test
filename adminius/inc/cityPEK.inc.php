<?
mb_internal_encoding("UTF-8");
session_start();
//////Подключение к базе
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
/////Подключение библиотеки
include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
function mb_ucfirst($text) {
  return mb_strtoupper(mb_substr($text, 0, 1)) . mb_substr($text, 1);
}
$query = clearData($_POST['query']);
$query = mb_ucfirst($query);
//$query = 'челя';

$search = "";

$n = mb_strlen($query);
if($query) {
  $result = file_get_contents("https://pecom.ru/ru/calc/towns.php");
  $res = json_decode($result);
  //echo "<pre>".print_r($res, true)."</pre>";
  if ($res) {
    foreach ($res as $item) {
      foreach ($item as $key => $val) {
        if($query == mb_substr($val,0, $n)){
          $search .= "<li data-id='" . $key . "' style='list-style: none;cursor: pointer;'><div class='block-title'>" . $val . "</div></li>";
        }
      }
    }
  }
}
echo $search;
?>