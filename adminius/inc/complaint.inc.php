<?php
if (isset($_POST['id']) and isset($_POST['status'])) {
	// ‘ильтруем полученные данные
	$status = clearData($_POST['status'], "i");
	$id = clearData($_POST['id'], "i");
	$link = $_POST['link'];
	
	mysql_query("UPDATE complaint SET status='$status' WHERE id='$id'");
	if(!$link){
		header( "Location: /adminius/index.php?code=complaint");
	}else{
		header( "Location: ".$link."#tab_4");
	}
	exit();
}elseif(isset($_POST['id']) and !isset($_POST['status'])){
	$id = clearData($_POST['id'], "i");
	mysql_query("DELETE FROM complaint WHERE id='$id'");
	header("Location: /adminius/index.php?code=complaint");
	exit();
}?>