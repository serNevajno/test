<?
if($_SERVER["REQUEST_METHOD"]=="POST"){
	// Фильтруем полученные данные
	$id = (int)$_POST['id'];
	$id_prod = (int)$_POST['productOrder_id'];
	// Заносим в базу
	mysql_query("DELETE FROM `order_product` WHERE id='$id_prod'");
	

	header('Location: /adminius/index.php?code=orders&action=edit&id='.$id);
	exit;
}
?> 