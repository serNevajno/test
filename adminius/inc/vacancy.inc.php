<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	if (!isset($_POST["id"])) {
		// Фильтруем полученные данные
		$date = DateTime::createFromFormat('d F Y - H:i', $_POST['date_active']);
		$date_active = $date->format('Y-m-d H:i:s');
		$active = clearData($_POST['active'], "i");
		$name = clearData($_POST['name']);
		$text = $_POST['article'];
		
		mysql_query("INSERT INTO vacancy (active, name, text, date) VALUES ('$active', '$name', '$text', '$date_active')") or die(mysql_error());
		$id_element = mysql_insert_id();

		header('Location: index.php?code=vacancy&action=edit&id='.$id_element);
		exit;
	}elseif(isset($_POST["id"]) and isset($_POST['name'])){
		$active = clearData($_POST['active'], "i");
		$name = clearData($_POST['name']);
		$text = $_POST['article'];
		$date = DateTime::createFromFormat('d F Y - H:i', $_POST['date_active']);
		$date_active = $date->format('Y-m-d H:i:s');
		
		// Заносим в базу
		$id = clearData($_POST['id'], "i");

		mysql_query("UPDATE vacancy SET active='$active', name='$name', text='$text', date='$date_active' WHERE id='$id'") or die(mysql_error());
		
		header("Location: index.php?code=vacancy");
		exit;
	}elseif(!isset($_POST['name']) and isset($_POST['id'])){
		// Фильтруем полученные данные
		$id = (int)$_POST['id'];
		
		// Заносим в базу
		mysql_query("DELETE FROM vacancy WHERE id='$id'") or die(mysql_error());

		header('Location: index.php?code=vacancy');
		exit;
	}
}
?>