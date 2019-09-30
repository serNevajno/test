<?
session_start();
header("Content-Type: text/html; charset=UTF-8");
//////Подключение к базе
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
/////Подключение библиотеки
include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/function.inc.php');
/////Замок
include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/lock.inc.php');

/*$select_categories = selectCategoriesBySection(2);
foreach($select_categories as $item){
    $select = selectCategoriesBySection($item["id"]);
    foreach ($select as $ISec) {
        if($ISec["active"] == "1"){
            if(checkSectionCat($ISec["id"]) == 0) {
                echo $ISec["name"]. " - ". $ISec["section"];
                echo "<br>";
                ////mysql_query("DELETE FROM categories WHERE id='$ISec[id]'") or die(mysql_error());
            }
        }
    }
}*/

$temp = db2array("SELECT article FROM product WHERE active='1'", 2);
$i=0;
foreach ($temp as $item){
    $co = db2array("SELECT COUNT(*) FROM product WHERE article='$item[article]'");
    if($co["COUNT(*)"]>1){
        $cFil = 0;
        $id = 0;
        $fil = db2array("SELECT t1.id, t1.article, (SELECT COUNT(*) FROM filter_value WHERE id_product=t1.id) as fil FROM `product` as t1 WHERE t1.article='$item[article]'", 2);
        foreach ($fil as $iFil){
            if($cFil<$iFil["fil"]){
                $cFil = $iFil["fil"];
                $id = $iFil["id"];
            }
        }
        //echo $item[article]."<br>";
       /* mysql_query("DELETE FROM `product` WHERE id='$id'");
        mysql_query("DELETE FROM price_provider WHERE id_product='$id'") or die(mysql_error());
        mysql_query("DELETE FROM filter_value WHERE id_product='$id'") or die(mysql_error());*/
        $i++;
    }
}
echo $i;
?>