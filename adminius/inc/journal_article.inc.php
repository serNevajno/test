<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	if (!isset($_POST["id"])) {
		if(!empty($_POST['date_active'])){
			$date = DateTime::createFromFormat('d F Y - H:i', $_POST['date_active']);
			$date_active = $date->format('Y-m-d H:i:s');
		}else{
			$date_active = date('Y-m-d H:i:s');
		}
		
		// Фильтруем полученные данные
		$active = clearData($_POST['active'], "i");
		$name = clearData($_POST['name']);
		$title = clearData($_POST['title']);
		$h1 = clearData($_POST['h1']);
		$meta_d = clearData($_POST['meta_d']);
		$meta_k = clearData($_POST['meta_k']);
		$code = clearData($_POST['code']);
		$text = $_POST['article'];
		$description = clearData($_POST['descriptions']);
		$journal = clearData($_POST['journal'], "i");
		
		$id_user = selectWhatUser();
		
		if(empty($code)){
			$code = greateLink($name);
		}
		
	
		$foto = time()."_".basename($_FILES['img']['name']); // Имя файла исключая путь
	
		// Текст ошибок
		$error_by_file = "<span style=\"font: bold 15px tahoma; color: red;\">Невозможно загрузить файл в директорию. Возможно её не существует</span>";

		// Начало
		if(isset($_FILES["img"])) {
			$myfile_size = $_FILES["img"]["size"];
			$error_flag = $_FILES["img"]["error"];

			// Если ошибок не было
			if($error_flag == 0) {
					
				$DOCUMENT_ROOT = $_SERVER['DOCMENT_ROOT'];
				$upfile = getcwd()."//../images/journal_articles//" . time()."_".basename($_FILES["img"]["name"]);

				if ($_FILES['img']['tmp_name']) {
			  
					//Если не удалось загрузить файл
					if (!move_uploaded_file($_FILES['img']['tmp_name'], $upfile)) {
						echo "$error_by_file";
						exit;
					}

				} else {
						 echo 'Проблема: возможна атака через загрузку файла. ';
						 echo $_FILES['img']['name'];
						 exit;
				}
			 
			} elseif ($myfile_size == 0) {
				   echo "Пустая форма!";
			} 
				// Если ошибок не было

		}
		$date = date("Y-m-d H:i:s");
		
		mysql_query("INSERT INTO journal_articles (active, name, title, meta_d, meta_k, code, text, img, h1, description, date, id_user, date_active, journal) VALUES ('$active', '$name', '$title', '$meta_d', '$meta_k', '$code', '$text', '$foto', '$h1', '$description', '$date', '$id_user', '$date_active', '$journal')") or die(mysql_error());
		$id_element = mysql_insert_id();

		header('Location: index.php?code=journal_article&action=edit&id='.$id_element);
		exit;
	}elseif(isset($_POST["id"]) and isset($_POST['name']) and isset($_POST['title']) and isset($_POST['code'])){
		$active = clearData($_POST['active'], "i");
		$name = clearData($_POST['name']);
		$title = clearData($_POST['title']);
		$h1 = clearData($_POST['h1']);
		$meta_d = clearData($_POST['meta_d']);
		$meta_k = clearData($_POST['meta_k']);
		$code = clearData($_POST['code']);
		$description = $_POST['descriptions'];
		$text = $_POST['article'];
		$journal = clearData($_POST['journal'], "i");

		$img = clearData($_POST['img_old']);
		
		$date = DateTime::createFromFormat('d F Y - H:i', $_POST['date_active']);
		$date_active = $date->format('Y-m-d H:i:s');

		if(empty($code)){
			$code = greateLink($name);
		}
		
		$foto = time()."_".basename($_FILES['img']['name']); // Имя файла исключая путь

		// Текст ошибок
		$error_by_mysql = "<span style=\"font: bold 15px tahoma; color: red;\">Ошибка при добавлении данных в базу</span>";
		$error_by_file = "<span style=\"font: bold 15px tahoma; color: red;\">Невозможно загрузить файл в директорию. Возможно её не существует</span>";

		// Начало
		if(isset($_FILES["img"])) {
			$myfile_size = $_FILES["img_"]["size"];
			$error_flag = $_FILES["img"]["error"];


			// Если ошибок не было
			if($error_flag == 0) {
				
				if(!unlink($_SERVER['DOCUMENT_ROOT']."/images/journal_articles/".$img)) {
					echo("Ошибка удаления файла". $_SERVER['DOCUMENT_ROOT']."/images/journal_articles/".$img);
				}
				
				$DOCUMENT_ROOT = $_SERVER['DOCMENT_ROOT'];
				$upfile = getcwd()."//../images/journal_articles//" . time()."_".basename($_FILES["img"]["name"]);
				
				if ($_FILES['img']['tmp_name']) {
					//Если не удалось загрузить файл
					if (!move_uploaded_file($_FILES['img']['tmp_name'], $upfile)) {
						echo "$error_by_file";
						exit;
					}
				}else{
					echo 'Проблема: возможна атака через загрузку файла. ';
					echo $_FILES['img']['name'];
					exit;
				}
			}elseif ($myfile_size == 0){
				$foto = $img;
			} 
				// Если ошибок не было
		}
		
		// Заносим в базу
		$id = clearData($_POST['id'], "i");

		mysql_query("UPDATE journal_articles SET active='$active', name='$name', title='$title', meta_d='$meta_d', meta_k='$meta_k', code='$code', description='$description', img='$foto', h1='$h1', text='$text', date_active='$date_active', journal='$journal' WHERE id='$id'") or die(mysql_error());
		
		header("Location: index.php?code=journal_article&journal=".$journal);
		exit;
	}elseif(!isset($_POST['name']) and !isset($_POST['title']) and !isset($_POST['code']) and isset($_POST['id'])){
		// Фильтруем полученные данные
		$id = (int)$_POST['id'];
		$journal = clearData($_POST['journal'], "i");
		
		// Заносим в базу
		mysql_query("DELETE FROM journal_articles WHERE id='$id'") or die(mysql_error());

		if(!unlink($_SERVER['DOCUMENT_ROOT']."/images/journal_articles/".$img)) {
			echo("Ошибка удаления файла". $_SERVER['DOCUMENT_ROOT']."/images/journal_article/".$img);
		}
		
		header('Location: index.php?code=journal_article&journal='.$journal);
		exit;
	
	}
}
?> 