<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	session_start();
	header("Content-Type: text/html; charset=UTF-8");
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
	
	if($_POST["name"] == "username"){
			mysql_query("UPDATE orders SET name='$_POST[value]' WHERE id='$_POST[pk]'") or die(mysql_error());
	}
	
	if($_POST["name"] == "phone"){
			mysql_query("UPDATE orders SET phone='$_POST[value]' WHERE id='$_POST[pk]'") or die(mysql_error());
	}
	
	if($_POST["name"] == "address"){
			mysql_query("UPDATE orders SET address='$_POST[value]' WHERE id='$_POST[pk]'") or die(mysql_error());
	}
	
	if($_POST["name"] == "delivery"){
			mysql_query("UPDATE orders SET delivery='$_POST[value]' WHERE id='$_POST[pk]'") or die(mysql_error());
	}
	
	if($_POST["name"] == "region_id_add"){
			mysql_query("UPDATE orders SET region='$_POST[value]' WHERE id='$_POST[pk]'") or die(mysql_error());
	}

  if($_POST["name"] == "editName"){
	  if($_POST['cause']) {
	    $id = clearData($_POST['id'], "i");
	    $summ = clearData($_POST['summ'], "i");
	    $cause = clearData($_POST['cause']);

      mysql_query("UPDATE orders SET summ='$summ', cause='$cause' WHERE id='$id'") or die(mysql_error());

      echo "Данные изменены!";

    }
  }
}
?>