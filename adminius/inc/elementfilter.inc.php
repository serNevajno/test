<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	if(isset($_POST['filter']) and isset($_POST['name']) and !isset($_POST['id'])){
		// Фильтруем полученные данные
		$name = clearData($_POST['name']);
		$filter = clearData($_POST['filter'], "i");
		$idcat = clearData($_POST['idcat'], "i");
		
		// Заносим в базу
		mysql_query("INSERT INTO element_filter (value, id_filter) VALUES ('$name', '$filter')") or die(mysql_error());
	
		header('Location: index.php?code=elementfilter&filter='.$filter.'&idcat='.$idcat);
		exit;
	}elseif(isset($_POST['filter']) and isset($_POST['name']) and isset($_POST['id'])){
		// Фильтруем полученные данные
		$name = clearData($_POST['name']);
		$filter = clearData($_POST['filter'], "i");
		$id = clearData($_POST['id'], "i");
		$idcat = clearData($_POST['idcat'], "i");
		
		// Заносим в базу
		mysql_query("UPDATE element_filter SET value='$name' WHERE id='$id'") or die(mysql_error());
	
		header('Location: index.php?code=elementfilter&filter='.$filter.'&idcat='.$idcat);
		exit;
	}elseif(isset($_POST['filter']) and !isset($_POST['name']) and isset($_POST['id'])){
		// Фильтруем полученные данные
		$id = (int)$_POST['id'];
		$filter = (int)$_POST['filter'];
		$idcat = clearData($_POST['idcat'], "i");
		
		if ($id != 1) {
			// Заносим в базу
			mysql_query("DELETE FROM element_filter WHERE id='$id'") or die(mysql_error());

		}
		header('Location: index.php?code=elementfilter&filter='.$filter.'&idcat='.$idcat);
		exit;
	}

}
?> 