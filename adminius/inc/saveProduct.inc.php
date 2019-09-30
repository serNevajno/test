<?if($_SERVER['REQUEST_METHOD'] == 'POST'){
	include($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
	include($_SERVER['DOCUMENT_ROOT'].'/inc/apiFunc.inc.php');
	
	$id = clearData($_POST['id'], "i");
	$code = clearData($_POST['code']);
	$type = clearData($_POST['type']);
	$quantity = clearData($_POST['quantity'], "i");

	$iProduct = selectProductByArtiсle($code);

	$price = $iProduct["price"] - (($iProduct["price"] / 100)*$iProduct["sale"]);

	if($type != 'tyres' AND $type != 'disk'){
	    $type = $iProduct["categories"];
    }
	
	 /*echo "<pre>".print_r($iProduct)."</pre>";*/

    mysql_query("INSERT INTO `order_product` (`product_id`, `id_order`, `name`, `quantity`, `price`, `categories`, `day`, `sale`, `price_clear`, `provider`) VALUES ('$iProduct[id]','$id','$iProduct[name]','$quantity','$price','$type','$iProduct[logistic]','$iProduct[sale]' , '$iProduct[price_clear]', '$iProduct[provider]')") or die(mysql_error());


	header('Location: /adminius/index.php?code=orders&action=edit&id='.$id);
	exit;
}?>