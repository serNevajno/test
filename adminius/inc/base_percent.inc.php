<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	$type = clearData($_POST['type'], "i");
	$percent = clearData($_POST['percent']);
		
	mysql_query("UPDATE base_extra_charge SET percent='$percent' WHERE id='$type'") or die(mysql_error());
	if($type == "1"){
				header('Location: index.php?code=extra_charge_tyres');
			}else{
				header('Location: index.php?code=extra_charge_disk');
	}
}
?>