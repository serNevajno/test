<?php if($_SERVER["REQUEST_METHOD"]=="POST"){
		for ($i=0; $i<count($_POST['img']); $i++) {
			updateTextPhoto($_POST[id_photo][$i], $_POST[text_photo][$i], $_POST[priority_photo][$i]);
			if (isset($_POST[del_photo][$i]) AND $_POST[del_photo][$i] == 1) {
				
				if (file_exists("../images/photogallery/".$_POST[img][$i])){
					 if(!unlink($_SERVER['DOCUMENT_ROOT']."/images/photogallery/".$_POST[img][$i])) {
						echo("Ошибка удаления файла");
					}
				}else{
					echo("Файл не найден http://".$_SERVER['SERVER_NAME']."/images/photogallery/".$_POST[img][$i]);
				}
				
				deletePhoto($_POST[id_photo][$i]);
			}
		}
		for ($i=0; $i<count($_FILES['photo']['name']); $i++) {
			if ($_FILES[photo][size][$i] > 0) {
				uploadPhotoGallery($_FILES[photo][name][$i], $_FILES[photo][size][$i], $_FILES[photo][error][$i], $_FILES[photo][tmp_name][$i], $_POST[new_text_photo][$i], $_POST[new_priority_photo][$i], 0);
			}
		}
		

		header('Location: /adminius/index.php?code=gallery');
		exit;
		
		/*if (isset($_POST['title']) and !isset($_POST['id'])){
		// Фильтруем полученные данные
		$title = stripslashes(trim(strip_tags($_POST['title'])));
		$meta_k = stripslashes(trim(strip_tags($_POST['meta_k'])));
		$meta_d = stripslashes(trim(strip_tags($_POST['meta_d'])));
		$text = $_POST['text'];
		$code = $_POST['code'] == "" ? linkURL($title) : $_POST['code'];
		$active = (int)$_POST['active'];
		$status = (int)$_POST['status'];
		$priority = (int)$_POST['priority'];
		$cat = (int)$_POST['cat'];
		$date = clearData($_POST['date']);
		$text_photo ="";
		$priority_photo="";
		
		$sql = "INSERT INTO photogallery (title, meta_k, meta_d, active, code, status, priority, date, text, cat) VALUES ('$title', '$meta_k', '$meta_d', '$active', '$code', '$status', '$priority', '$date', '$text', '$cat')";
		$result = mysql_query($sql) or die(mysql_error());
		$id = mysql_insert_id();

		for ($i=0; $i<count($_FILES['filesToUpload']['name']); $i++) {
			if ($_FILES[filesToUpload][size][$i] > 0) {
				uploadPhotoGallery($_FILES[filesToUpload][name][$i], $_FILES[filesToUpload][size][$i], $_FILES[filesToUpload][error][$i], $_FILES[filesToUpload][tmp_name][$i], $text_photo, $priority_photo, $id);
			}
		}
		header('Location: /adminius/index.php?code=gallery&action=edit&id='.$id);
		exit;
	}elseif(isset($_POST['title']) and isset($_POST['id'])){
		$id= clearData($_POST['id'], "i");
		$active= clearData($_POST['active'], "i");
		$status= clearData($_POST['status'], "i");
		$date= clearData($_POST['date']);
		$title= clearData($_POST['title']);
		$text= $_POST['text'];
		$meta_d= clearData($_POST['meta_d']);
		$meta_k= clearData($_POST['meta_k']);
		if(empty($_POST['code'])){
			$code = linkURL($_POST['title']);
		}else{
			$code = clearData($_POST['code']);
		}
		$priority = clearData($_POST['priority'], "i");
		$cat = clearData($_POST['cat'], "i");
		
		mysql_query("UPDATE photogallery SET title='$title', meta_k='$meta_k', meta_d='$meta_d', active='$active', status='$status', priority='$priority', date='$date', code='$code', text='$text' WHERE id = '$id'") or die(mysql_error());

		
		for ($i=0; $i<count($_POST['img']); $i++) {
			updateTextPhoto($_POST[id_photo][$i], $_POST[text_photo][$i], $_POST[priority_photo][$i]);
			if (isset($_POST[del_photo][$i]) AND $_POST[del_photo][$i] == 1) {
				
				if (file_exists("../images/photogallery/".$_POST[img][$i])){
					 if(!unlink($_SERVER['DOCUMENT_ROOT']."/images/photogallery/".$_POST[img][$i])) {
						echo("ќшибка удалени¤ файла");
					}
				}else{
					echo("‘айл не найден http://".$_SERVER['SERVER_NAME']."/images/photogallery/".$_POST[img][$i]);
				}
				
				deletePhoto($_POST[id_photo][$i]);
			}
		}
		for ($i=0; $i<count($_FILES['photo']['name']); $i++) {
			if ($_FILES[photo][size][$i] > 0) {
				uploadPhotoGallery($_FILES[photo][name][$i], $_FILES[photo][size][$i], $_FILES[photo][error][$i], $_FILES[photo][tmp_name][$i], $_POST[new_text_photo][$i], $_POST[new_priority_photo][$i], $id);
			}
		}
		
		if (isset($_POST['submit'])):
			header('Location: /adminius/index.php?code=gallery_cat');
		elseif(isset($_POST['submit1'])):
			header('Location: /adminius/index.php?code=gallery&action=edit&id='.$id);
		endif;
		exit;
	}elseif(!isset($_POST['title']) and isset($_POST['id'])){
		// Фильтруем полученные данные
		$id = (int)$_POST['id'];
		
		$select_photo = selectAllPhoto($id);
		foreach($select_photo as $item):
			if (file_exists("../images/photogallery/".$item['img'])){
				 if(!unlink($_SERVER['DOCUMENT_ROOT']."/images/photogallery/".$item['img'])) {
					//echo("Ошибка удаления файла");
				}
			}else{
				//echo("Файл не найден http://".$_SERVER['SERVER_NAME']."/images/photogallery/".$item['img']);
			}
		endforeach;
		// Заносим в базу
		deleteGallery($id);
		deletePhoto($id);
		header('Location: /adminius/index.php?code=gallery');
		exit;
	}*/
}
?>