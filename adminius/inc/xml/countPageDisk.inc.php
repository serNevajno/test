<?
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');

$temp = db2array("SELECT COUNT(*) FROM categories as t1 LEFT JOIN categories as t2 on(t1.id=t2.section) LEFT JOIN categories as t3 on(t2.id=t3.section) LEFT JOIN product as t4 on(t3.id=t4.categories) WHERE t1.id='2' AND t4.active='1' AND t4.price>0 AND t4.availability>0");

$total = (($temp["COUNT(*)"] - 1) / 100) + 1;
$total =  intval($total);

echo $total;
?>