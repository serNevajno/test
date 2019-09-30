<?php
if (isset($_POST['submit'])) {
	// Фильтруем полученные данные
/* 	echo "<pre>".print_r($_POST)."</pre>"; */
	
	$id = clearData($_POST['id'], "i");
	$id_order = clearData($_POST['id_order'], "i");
	$quantity = clearData($_POST['quantity'], "i");
    $nzsp = clearData($_POST['nzsp']);

	// Заносим в базу
    $order_product = db2array("SELECT product_id, quantity, provider, in_storage, price, price_clear FROM order_product WHERE id='$id'");
    if($order_product["provider"] == "7" OR $order_product["in_storage"] == "1"){
        $ava = db2array("SELECT availability FROM price_provider WHERE id_provider='7' AND id_product='$order_product[product_id]' ORDER BY date DESC LIMIT 1");
        if($ava) {
            if ($quantity > $order_product["quantity"]) {
                $val = $quantity - $order_product["quantity"];
                if ($val > $ava["availability"]) {
                    header('Location: /adminius/index.php?code=orders&action=update&id=' . $id . '&error=1');
                    exit;
                }
                $availability = $ava["availability"] - $val;
            } elseif ($quantity < $order_product["quantity"]) {
                $val = $order_product["quantity"] - $quantity;
                $availability = $ava["availability"] + $val;
            } elseif ($quantity == $order_product["quantity"]) {
                $availability = $ava["availability"];
            }
            mysql_query("UPDATE product SET availability='$availability' WHERE provider='7' AND id='$order_product[product_id]'");
            mysql_query("UPDATE price_provider SET availability='$availability' WHERE id_provider='7' AND id_product='$order_product[product_id]'");
        }else{
            if ($quantity > $order_product["quantity"]) {
                header('Location: /adminius/index.php?code=orders&action=update&id=' . $id . '&error=1');
                exit;
            }elseif($quantity < $order_product["quantity"]){
                $date = date("Y-m-d H:i:s");
                $availability = $order_product["quantity"] - $quantityl;
                mysql_query("INSERT INTO `price_provider`(`id_product`, `price`, `price_clear`, `logistic`, `id_provider`, `availability`, `date`) VALUES ('$order_product[product_id]', '$order_product[price]', '$order_product[price_clear]', '0', '7', '$availability', '$date')");
            }
        }

    }
	mysql_query("UPDATE `order_product` SET `quantity`='$quantity', `nzsp`='$nzsp' WHERE id='$id'");
	
	header('Location: /adminius/index.php?code=orders&action=edit&id='.$id_order);
	exit;
}
?> 