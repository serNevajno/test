<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	if (!isset($_POST["id"])) {
		// Фильтруем полученные данные
		$name = clearData($_POST['name']);
		$title = clearData($_POST['title']);
		$h1 = clearData($_POST['h1']);
		$meta_d = clearData($_POST['meta_d']);
		$meta_k = clearData($_POST['meta_k']);
		$code = clearData($_POST['code']);
		$icon = clearData($_POST['icon']);
		$descriptions = $_POST['descriptions'];
		$priority = clearData($_POST['priority'], "i");
		$menu = clearData($_POST['menu'], "i");
		$date = date("Y-m-d H:i:s");
		
		$section = clearData($_POST['section'], "i");
		
		if(empty($code)){
			$code = greateLink($name);
		}
		if($_FILES["img"]["size"]>0){
			$foto = time()."_".basename($_FILES['img']['name']); // Имя файла исключая путь
		
			// Текст ошибок
			$error_by_file = "<span style=\"font: bold 15px tahoma; color: red;\">Невозможно загрузить файл в директорию. Возможно её не существует</span>";

			// Начало
			$myfile_size = $_FILES["img"]["size"];
			$error_flag = $_FILES["img"]["error"];

			// Если ошибок не было
			if($error_flag == 0) {
					
				$DOCUMENT_ROOT = $_SERVER['DOCMENT_ROOT'];
				$upfile = getcwd()."//../images/section//" . time()."_".basename($_FILES["img"]["name"]);

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
		
		mysql_query("INSERT INTO section (name, title, meta_d, meta_k, code, descriptions, priority, menu, date, h1, section, img) VALUES ('$name', '$title', '$meta_d', '$meta_k', '$code', '$descriptions', '$priority', '$menu', '$date', '$h1', '$section', '$foto')") or die(mysql_error());
		
		$id_element = mysql_insert_id();
		addLogs(selectWhatUser(), 6, $id_element, "section");

		header('Location: index.php?code=sections&action=edit&id='.$id_element);
		exit;
	}elseif(isset($_POST["id"]) and isset($_POST['name']) and isset($_POST['title']) and isset($_POST['code'])){
		$name = clearData($_POST['name']);
		$title = clearData($_POST['title']);
		$h1 = clearData($_POST['h1']);
		$meta_d = clearData($_POST['meta_d']);
		$meta_k = clearData($_POST['meta_k']);
		$code = clearData($_POST['code']);
		$icon = clearData($_POST['icon']);
		$descriptions = $_POST['descriptions'];
		$priority = clearData($_POST['priority'], "i");
		$menu = clearData($_POST['menu'], "i");
		$section = clearData($_POST['section'], "i");
		$id = clearData($_POST['id'], "i");
		
		if(empty($code)){
			$code = greateLink($name);
		}
		
	
		// Начало
		if($_FILES["img"]["size"] >0) {
			$foto = time()."_".basename($_FILES['img']['name']); // Имя файла исключая путь

			// Текст ошибок
			$error_by_mysql = "<span style=\"font: bold 15px tahoma; color: red;\">Ошибка при добавлении данных в базу</span>";
			$error_by_file = "<span style=\"font: bold 15px tahoma; color: red;\">Невозможно загрузить файл в директорию. Возможно её не существует</span>";

			$myfile_size = $_FILES["img"]["size"];
			$error_flag = $_FILES["img"]["error"];


			// Если ошибок не было
			if($error_flag == 0) {

				if($img) {
          if (!unlink($_SERVER['DOCUMENT_ROOT'] . "/images/section/" . $img)) {
            //echo("Ошибка удаления файла". $_SERVER['DOCUMENT_ROOT']."/images/section/".$img);
          }
        }
				
				$DOCUMENT_ROOT = $_SERVER['DOCMENT_ROOT'];
				$upfile = getcwd()."//../images/section//" . time()."_".basename($_FILES["img"]["name"]);
				
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
			}
				// Если ошибок не было
			$img = ", img='$foto'";
		}
		
		mysql_query("UPDATE section SET name='$name', title='$title', meta_d='$meta_d', meta_k='$meta_k', code='$code', descriptions='$descriptions', priority='$priority', menu='$menu', h1='$h1', section='$section', icon='$icon', output_main='$output_main', templates='$templates'$img WHERE id='$id' and server=0") or die(mysql_error());
		
		
		addLogs(selectWhatUser(), 7, $id, "section");
		if(!empty($section)){ $getset ="&id=".$section; }else{ $getset =""; }
		header("Location: index.php?code=sections".$getset); 
		exit;
	}elseif(!isset($_POST['name']) and !isset($_POST['title']) and !isset($_POST['code'])){
	
		// Фильтруем полученные данные
		$id = (int)$_POST['id'];
		$id_sect = (int)$_POST['id_sect'];
		
		// Заносим в базу
		mysql_query("DELETE FROM section WHERE id='$id' and server=0") or die(mysql_error());
		addLogs(selectWhatUser(), 8, $id, "section");
		if(!$id_sect){
			header('Location: index.php?code=sections'); 
		}else{
			header('Location: index.php?code=sections&id='.$id_sect);
		}
		exit;
	}
}
?> 