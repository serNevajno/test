<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	if (!isset($_POST["id"])) {
		// Фильтруем полученные данные
		$name = clearData($_POST['name']);
		$content = $_POST['content'];
	
		$foto = time()."_".greateNameImg(basename($_FILES['img']['name'])); // Имя файла исключая путь
		$pdf = time()."_".greateNameImg(basename($_FILES['pdf']['name'])); // Имя файла исключая путь
		
		$date = $_POST['year']."-".$_POST['month']."-01";
		
		// Текст ошибок
		$error_by_file = "<span style=\"font: bold 15px tahoma; color: red;\">Невозможно загрузить файл в директорию. Возможно её не существует</span>";

		// Начало
		if(isset($_FILES["img"])) {
			$myfile_size = $_FILES["img"]["size"];
			$error_flag = $_FILES["img"]["error"];

			// Если ошибок не было
			if($error_flag == 0) {
					
				$DOCUMENT_ROOT = $_SERVER['DOCMENT_ROOT'];
				$upfile = getcwd()."//../images/journal_img//".$foto;

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
		if(isset($_FILES["pdf"])) {
			$myfile_size = $_FILES["pdf"]["size"];
			$error_flag = $_FILES["pdf"]["error"];

			// Если ошибок не было
			if($error_flag == 0) {
					
				$DOCUMENT_ROOT = $_SERVER['DOCMENT_ROOT'];
				$upfile = getcwd()."//../images/journal_pdf//".$pdf;

				if ($_FILES['pdf']['tmp_name']) {
			  
					//Если не удалось загрузить файл
					if (!move_uploaded_file($_FILES['pdf']['tmp_name'], $upfile)) {
						echo "$error_by_file";
						exit;
					}

				} else {
						 echo 'Проблема: возможна атака через загрузку файла. ';
						 echo $_FILES['pdf']['name'];
						 exit;
				}
			 
			} elseif ($myfile_size == 0) {
				   echo "Пустая форма!";
			} 
				// Если ошибок не было

		}
		
		mysql_query("INSERT INTO journal (name, img, pdf, date, content) VALUES ('$name', '$foto', '$pdf', '$date', '$content')") or die(mysql_error());
		$id_element = mysql_insert_id();

		header('Location: index.php?code=journal&action=edit&id='.$id_element);
		exit;
	}elseif(isset($_POST["id"]) and isset($_POST['name'])){
		$name = clearData($_POST['name']);
		$content = $_POST['content'];
	
		$foto = time()."_".greateNameImg(basename($_FILES['img']['name'])); // Имя файла исключая путь
		$pdf = time()."_".greateNameImg(basename($_FILES['pdf']['name'])); // Имя файла исключая путь
		$img = clearData($_POST['img_old']);
		$pdf_old = clearData($_POST['old_pdf']);
		
		$date = $_POST['year']."-".$_POST['month']."-01";

		// Текст ошибок
		$error_by_mysql = "<span style=\"font: bold 15px tahoma; color: red;\">Ошибка при добавлении данных в базу</span>";
		$error_by_file = "<span style=\"font: bold 15px tahoma; color: red;\">Невозможно загрузить файл в директорию. Возможно её не существует</span>";



		// Начало
		if(isset($_FILES["img"])) {
			$myfile_size = $_FILES["img"]["size"];
			$error_flag = $_FILES["img"]["error"];


			// Если ошибок не было
			if($error_flag == 0) {
				
				if(!unlink($_SERVER['DOCUMENT_ROOT']."/images/journal_img/".$img)) {
					echo("Ошибка удаления файла". $_SERVER['DOCUMENT_ROOT']."/images/journal_img/".$img);
				}
				
				$DOCUMENT_ROOT = $_SERVER['DOCMENT_ROOT'];
				$upfile = getcwd()."//../images/journal_img//" .$foto;
				
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
		
		if(isset($_FILES["pdf"])) {
			$myfile_size_pdf = $_FILES["pdf"]["size"];
			$error_flag_pdf = $_FILES["pdf"]["error"];


			// Если ошибок не было
			if($error_flag_pdf == 0) {
				
				if(!unlink($_SERVER['DOCUMENT_ROOT']."/images/journal_pdf/".$pdf_old)) {
					echo("Ошибка удаления файла". $_SERVER['DOCUMENT_ROOT']."/images/journal_pdf/".$pdf_old);
				}
				
				$DOCUMENT_ROOT = $_SERVER['DOCMENT_ROOT'];
				$upfile = getcwd()."//../images/journal_pdf//".$pdf;
				
				if ($_FILES['pdf']['tmp_name']) {
					//Если не удалось загрузить файл
					if (!move_uploaded_file($_FILES['pdf']['tmp_name'], $upfile)) {
						echo "$error_by_file";
						exit;
					}
				}else{
					echo 'Проблема: возможна атака через загрузку файла. ';
					echo $_FILES['pdf']['name'];
					exit;
				}
			}elseif ($myfile_size_pdf == 0){
				$pdf = $pdf_old;
			} 
				// Если ошибок не было
		}
		
		// Заносим в базу
		$id = clearData($_POST['id'], "i");

		mysql_query("UPDATE journal SET name='$name', img='$foto', pdf='$pdf', content='$content', date='$date' WHERE id='$id'") or die(mysql_error());
	
		header("Location: index.php?code=journal");
		exit;
	}elseif(!isset($_POST['name']) and isset($_POST['id'])){
		// Фильтруем полученные данные
		$id = (int)$_POST['id'];
		
		// Заносим в базу
		
		mysql_query("DELETE FROM journal WHERE id='$id'") or die(mysql_error());

		header('Location: index.php?code=journal');
		exit;
	
	}

}
?> 