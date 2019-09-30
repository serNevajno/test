<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	if (!isset($_POST['id'])){
		// Фильтруем полученные данные
		$title = clearData($_POST['title']);
		$discriptions = clearData($_POST['discriptions']);
		$url = clearData($_POST['url']);
		$active = clearData($_POST['active'], "i");
		$priority = clearData($_POST['priority'], "i");
		$color = clearData($_POST['color']);

		//================Настройки============= //		
		$foto_light_name = time()."_".basename($_FILES['img']['name']); // Имя файла исключая путь
		
		// Текст ошибок
		$error_by_file = "<span style=\"font: bold 15px tahoma; color: red;\">Невозможно загрузить файл в директорию. Возможно её не существует</span>";
		
		// Начало
		if(isset($_FILES["img"])) {
			$myfile_size = $_FILES["img"]["size"];
			$error_flag = $_FILES["img"]["error"];
			// Если ошибок не было
			if($error_flag == 0) {
				$DOCUMENT_ROOT = $_SERVER['DOCMENT_ROOT'];
				$upfile = getcwd()."//../images/slider//" . time()."_".basename($_FILES["img"]["name"]);

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

		// Заносим в базу
		mysql_query("INSERT INTO slider (title, descriptions, img, url, active, priority, color) VALUES ('$title', '$discriptions', '$foto_light_name', '$url', '$active', '$priority', '$color')") or die(mysql_error());
		$id_element = mysql_insert_id();
		addLogs(selectWhatUser(), 6, $id_element, "slider");

		header('Location: index.php?code=banner&action=edit&id='.$id_element);
		exit;
		
	}elseif(isset($_POST["id"]) and isset($_POST['title'])){
		// Фильтруем полученные данные
		$title = clearData($_POST['title']);
		$discriptions = clearData($_POST['discriptions']);
		$url = clearData($_POST['url']);
		$active = clearData($_POST['active'], "i");
		$priority = clearData($_POST['priority'], "i");
		$color = clearData($_POST['color']);
		$img_s = clearData($_POST['img_s']);
		$id = clearData($_POST['id']);

		//================Настройки============= //

		// Текст ошибок
		$error_by_file = "<span style=\"font: bold 15px tahoma; color: red;\">Невозможно загрузить файл в директорию. Возможно её не существует</span>";
		
		// Начало
		if(isset($_FILES["img"])) {
			$myfile_size = $_FILES["img"]["size"];
			$error_flag = $_FILES["img"]["error"];
			
			
			// Если ошибок не было
			if($myfile_size != 0) {
				$foto_light_name = time()."_".basename($_FILES['img']['name']); // Имя файла исключая путь
				$upfile = getcwd()."//../images/slider//" . time()."_".basename($_FILES["img"]["name"]);				
				if ($_FILES['img']['tmp_name']) {
					if(!empty($img_s)) {
						if (file_exists("../images/slider/".$img_s)){
							if(!unlink("../images/slider/".$img_s)) {echo("Ошибка удаления файла"); exit;}
						}else{
							echo("Файл не найден http://".$_SERVER['SERVER_NAME']."/images/slider/".$img_s);
						}
					}
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
			} else {
				 $foto_light_name = $img_s;
			} 
				// Если ошибок не было
		}
		
		// Заносим в базу
		mysql_query("UPDATE slider SET title='$title', descriptions='$discriptions', img='$foto_light_name', url='$url', active='$active', priority='$priority', color='$color' WHERE id='$id'") or die(mysql_error());
		
		addLogs(selectWhatUser(), 7, $id, "slider");
		
		if(isset($_POST['submit'])):
			header('Location: /adminius/index.php?code=banner');
		elseif(isset($_POST['submit1'])):
			header('Location: /adminius/index.php?code=banner&action=edit&id='.$id);
		endif;
		exit;
	}elseif(!isset($_POST['title'])){
		// Фильтруем полученные данные
		$id = (int)$_POST['id'];
		$img = strip_tags(trim($_POST['img']));
	
		if (file_exists("file://".$_SERVER['DOCUMENT_ROOT']."/images/slider/".$img)){
			 if(!unlink($_SERVER['DOCUMENT_ROOT']."/images/slider/".$img)) {echo("Ошибка удаления файла");}
		}else{
			echo("Файл не найден http://".$_SERVER['SERVER_NAME']."/images/slider/".$img);
		}
		
		// Заносим в базу
		mysql_query("DELETE FROM slider WHERE id='$id'") or die(mysql_error());
		addLogs(selectWhatUser(), 8, $id, "slider");
		header('Location: index.php?code=banner');
		exit;
	}
}?>