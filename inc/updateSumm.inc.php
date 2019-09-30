<?
if($_SERVER["REQUEST_METHOD"]=="POST"){
	session_start(); 
	//////Подключение к базе
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
	/////Подключение библиотеки
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
	
	$id = clearData($_POST['id'], "i");
	$val = clearData($_POST['val'], "i");

    $avail = db2array("SELECT t2.availability FROM basket as t1 LEFT JOIN product as t2 on(t1.product_id=t2.id) WHERE t1.id='$id'");

    if($val<=$avail["availability"]) {
        mysql_query("UPDATE `basket` SET `quantity`='$val' WHERE `id`='$id' and customer='" . session_id() . "'") or die(mysql_error());
    }
	$res = db2array("SELECT quantity, price FROM `basket` WHERE id='$id'");
		
	$arr = array('quantity' => $res['quantity'], 'price' => $res['quantity'] * $res['price'], 'summ' => sumBasket());

    echo json_encode($arr);
}?>