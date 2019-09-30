<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	if(!isset($_POST["id"]) and isset($_POST["name"]) and isset($_POST["cat"])) {
		// Фильтруем полученные данные
		$name = clearData($_POST['name']);
		$type = clearData($_POST['type'], "i");
		$model = clearData($_POST['model'], "i");
		$cat = clearData($_POST['cat'], "i");
		$priority = clearData($_POST['priority'], "i");
		
		// Заносим в базу
		mysql_query("INSERT INTO filter (name, type, categories, model, priority) VALUES ('$name', '$type', '$cat', '$model', '$priority')") or die(mysql_error());
		header('Location: index.php?code=categories&action=edit&id='.$cat.'#tab_2');
		exit;
	}elseif(isset($_POST["id"]) and isset($_POST['name'])){
		// Фильтруем полученные данные
		$name = clearData($_POST['name']);
		$type = clearData($_POST['type'], "i");
		$cat = clearData($_POST['cat'], "i");
		$model = clearData($_POST['model'], "i");
		$id = clearData($_POST['id'], "i");
		$priority = clearData($_POST['priority'], "i");
			
		// Заносим в базу
		mysql_query("UPDATE filter SET name='$name', type='$type', model='$model', priority='$priority' WHERE id='$id'") or die(mysql_error());
		header('Location: index.php?code=categories&action=edit&id='.$cat.'#tab_2');
		exit;
	}elseif(isset($_POST["id"]) and !isset($_POST['name']) and !isset($_POST['type']) and isset($_POST["cat"])){
		// Фильтруем полученные данные
		$id = (int)$_POST['id'];
		$cat = (int)$_POST['cat'];
		if ($id != 1) {
			// Заносим в базу
			mysql_query("DELETE FROM filter WHERE id='$id'") or die(mysql_error());
		}
		header('Location: index.php?code=categories&action=edit&id='.$cat.'#tab_2');
		exit;
	}

}
?> 