<?php
error_reporting(0);
header("Content-Type: text/html;charset=utf8");
session_start();

//////Подключение к базе
include($_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php');
/////Подключение библиотеки
include($_SERVER['DOCUMENT_ROOT'] . '/inc/function.inc.php');

//$temp = db2array("SELECT t1.categories, t1.id, t1.article, t2.name FROM price_provider as t1 WHERE t1.id_provider='7'", 2);

@mysql_query('set character_set_client="utf8"');
@mysql_query('set character_set_results="utf8"');
@mysql_query('set collation_connection="utf8_general_ci"');
if(!setlocale(LC_ALL, 'ru_RU.utf8')) setlocale(LC_ALL, 'en_US.utf8');

$file = fopen('php://memory', 'w+');
fwrite($file, iconv('CP1251','UTF-8', file_get_contents($_SERVER["DOCUMENT_ROOT"]."/1.csv")));
rewind($file);
$date = date("Y-m-d H:i:s");
while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
    echo "<br>";
    //$temp = db2array("SELECT id FROM product WHERE article='$data[1]'");
       if($temp){
           //echo $temp["id"];
          ///mysql_query("INSERT INTO `price_provider`(`id_product`, `price`, `price_clear`, `logistic`, `id_provider`, `availability`, `date`) VALUES ('$temp[id]','$data[3]','$data[4]','0','7','$data[2]','$date')");
       }else{
           echo "Нет";
       }
}

fclose($file);
echo "Ok";
?>