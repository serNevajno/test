<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	if(isset($_POST['del_message'])){
		$sql = "DELETE FROM `order_services` WHERE `id` IN ( " . implode( ', ', $_POST['del_message'] ) . " )";
		$result = mysql_query($sql) or die(mysql_error());
		header("Location: /adminius/index.php?code=order_services");
		exit;
	}
}?>