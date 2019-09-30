<?php if($_SERVER["REQUEST_METHOD"]=="POST"){
		for ($i=0; $i<count($_POST['img']); $i++) {
			updateTextPhotoKlient($_POST[id_photo][$i], $_POST[text_photo][$i], $_POST[priority_photo][$i]);
			if (isset($_POST[del_photo][$i]) AND $_POST[del_photo][$i] == 1) {
				
				if (file_exists("../images/photogallery/".$_POST[img][$i])){
					 if(!unlink($_SERVER['DOCUMENT_ROOT']."/images/photogallery/".$_POST[img][$i])) {
						echo("Ошибка удаления файла");
					}
				}else{
					echo("Файл не найден http://".$_SERVER['SERVER_NAME']."/images/photogallery/".$_POST[img][$i]);
				}
				
				deletePhotoKlient($_POST[id_photo][$i]);
			}
		}
		for ($i=0; $i<count($_FILES['photo']['name']); $i++) {
			if ($_FILES[photo][size][$i] > 0) {
				uploadPhotoGalleryKlient($_FILES[photo][name][$i], $_FILES[photo][size][$i], $_FILES[photo][error][$i], $_FILES[photo][tmp_name][$i], $_POST[new_text_photo][$i], $_POST[new_priority_photo][$i]);
			}
		}

		header('Location: /adminius/index.php?code=klient');
		exit;
}
?>