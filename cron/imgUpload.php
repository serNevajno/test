<?
session_start();
header("Content-Type: text/html; charset=UTF-8");
//////Подключение к базе
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
/////Подключение библиотеки
include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/function.inc.php');

$temp = db2array("SELECT `id`, `url`, `name`, `id_product` FROM `img_upload` ORDER BY id ASC LIMIT 1");
if($temp) {
    $imgUrl = $temp["url"];
    $img_name = $temp["name"];
    $link = "http://" . $_SERVER['HTTP_HOST'] . "/scripts/phpThumb/phpThumb.php?src=" . $imgUrl . "&fltr[]=wmi|/images/watermark.png|85x200|100|170|120|0";
    $file = file_get_contents($link);
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/images/product_cover/" . $img_name, $file);
    mysql_query("UPDATE `product` SET `img`='$img_name' WHERE id='$temp[id_product]'");
    mysql_query("DELETE FROM `img_upload` WHERE id='$temp[id]'");
}
$temp2 = db2array("SELECT `id`, `url`, `name`, `id_product` FROM `img_upload` ORDER BY id ASC LIMIT 1");
if($temp2) {
  $imgUrl = $temp2["url"];
  $img_name = $temp2["name"];
  $link = "http://" . $_SERVER['HTTP_HOST'] . "/scripts/phpThumb/phpThumb.php?src=" . $imgUrl . "&fltr[]=wmi|/images/watermark.png|85x200|100|170|120|0";
  $file = file_get_contents($link);
  file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/images/product_cover/" . $img_name, $file);
  mysql_query("UPDATE `product` SET `img`='$img_name' WHERE id='$temp2[id_product]'");
  mysql_query("DELETE FROM `img_upload` WHERE id='$temp2[id]'");
}
$temp3 = db2array("SELECT `id`, `url`, `name`, `id_product` FROM `img_upload` ORDER BY id ASC LIMIT 1");
if($temp3) {
  $imgUrl = $temp3["url"];
  $img_name = $temp3["name"];
  $link = "http://" . $_SERVER['HTTP_HOST'] . "/scripts/phpThumb/phpThumb.php?src=" . $imgUrl . "&fltr[]=wmi|/images/watermark.png|85x200|100|170|120|0";
  $file = file_get_contents($link);
  file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/images/product_cover/" . $img_name, $file);
  mysql_query("UPDATE `product` SET `img`='$img_name' WHERE id='$temp3[id_product]'");
  mysql_query("DELETE FROM `img_upload` WHERE id='$temp3[id]'");
}
?>