<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	if (isset($_POST["func"])) {
		$filename = '../adminius/inc/'.$_POST["func"].'.inc.php';
			if (file_exists($filename)) {
				include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/'.$_POST["func"].'.inc.php');
			}else{
				echo "Файл не найден ".$filename;
			}
	}
}
?>