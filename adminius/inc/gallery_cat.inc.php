<?php if($_SERVER["REQUEST_METHOD"]=="POST"){
	if (isset($_POST['name']) and !isset($_POST['id'])){
		// Фильтруем полученные данные
			$name = $_POST['name'];
			$code = $_POST['code'] == "" ? linkURL($_POST['name']) : $_POST['code'];
			//================Настройки============= //
			
			$fotos_dir = "../images/photogallery/";   // Директория для фотографий
			$foto_name = $fotos_dir.time()."_".basename($_FILES['img']['name']); // Имя файла исключая путь
			$foto_light_name = time()."_".basename($_FILES['img']['name']); // Имя файла исключая путь
			$foto_tag = "<img src=\"$foto_name\" border=\"0\">"; // Готовый тэг для вставки картинки на страницу
			$foto_tag_preview = "<img src=\"$foto_name\" border=\"0\" width=\"$maxwidth\">"; // Тот же тэг, но для превью
			
			// Текст ошибок
			$error_by_file = "<span style=\"font: bold 15px tahoma; color: red;\">Невозможно загрузить файл в директорию. Возможно её не существует</span>";



			// Начало
			if(isset($_FILES["img"])) {
				$myfile_size = $_FILES["img"]["size"];
				$error_flag = $_FILES["img"]["error"];


				// Если ошибок не было
				if($error_flag == 0) {
						
					$DOCUMENT_ROOT = $_SERVER['DOCMENT_ROOT'];
					$upfile = getcwd()."//../images/photogallery//" . time()."_".basename($_FILES["img"]["name"]);

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
			$sql = "INSERT INTO photogallery_cat (name, img, code) VALUES ('$name', '$foto_light_name', '$code')";
			$result = mysql_query($sql) or die(mysql_error());
			
			header('Location: /adminius/index.php?code=gallery_cat');
			exit;
	}elseif(isset($_POST['name']) and isset($_POST['id'])){
		$id= clearData($_POST['id']);
		$name = clearData($_POST['name']);
		
		$code = $_POST['code'] == "" ? linkURL($_POST['name']) : $_POST['code'];

		$img_old = clearData($_POST['img_old']);

		
		//================Настройки============= //
		$fotos_dir = "../images/photogallery/"; // Директория для фотографий товаров

		$foto_light_name = time()."_".basename($_FILES['img']['name']); // Имя файла исключая путь

		// Текст ошибок
		$error_by_file = "<span style=\"font: bold 15px tahoma; color: red;\">Невозможно загрузить файл в директорию. Возможно её не существует</span>";

		// Начало

		$myfile_size = $_FILES["img"]["size"];
		$error_flag = $_FILES["img"]["error"];

		// Если ошибок не было
		if ($myfile_size == 0) {
			$img = $img_old;
		}else{
			$DOCUMENT_ROOT = $_SERVER['DOCMENT_ROOT'];
			$upfile = getcwd()."//../images/photogallery//" . time()."_".basename($_FILES["img"]["name"]);

			if ($_FILES['img']['tmp_name']) {
				//Если не удалось загрузить файл
				if (!move_uploaded_file($_FILES['img']['tmp_name'], $upfile)) {
					echo "$error_by_file";
					exit;
				}
				$img = $foto_light_name;
			}
		}
		// Если ошибок не было
		
		// Заносим в базу
		$sql = "UPDATE photogallery_cat SET name='$name', code='$code', img='$img' WHERE id='$id'";
		$result = mysql_query($sql) or die(mysql_error());

		header('Location: /adminius/index.php?code=gallery_cat');
		exit;
	}elseif(!isset($_POST['name']) and isset($_POST['id'])){
		// Фильтруем полученные данные
		$id = (int)$_POST['id'];
		
		// Заносим в базу
		$sql = "DELETE FROM photogallery_cat WHERE id='$id'";
		$result = mysql_query($sql) or die(mysql_error());
		
		header('Location: /adminius/index.php?code=gallery_cat');
		exit;
	}
}
?>