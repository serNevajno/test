<?
session_start();
//////Подключение к базе
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
/////Подключение библиотеки
include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');

$name = clearData($_POST['name']);
$rn = clearData($_POST['rn']);
$arr = explode("(", $name);
$city = trim($arr[0]);
$id = "auto";
$towns = file_get_contents('https://pecom.ru/ru/calc/towns.php');
foreach (json_decode($towns) as $val){
    foreach ($val as $key => $item){
        if (($item != $city AND $item == $city . " (" . $rn . " р-н)") OR ($item == $city AND $item != $city . " (" . $rn . " р-н)")){
            $id = $key;
        }
    }
}
echo $id;
?>