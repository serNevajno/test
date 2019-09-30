<?php
if (isset($_GET["code"])) {
	$filename = '../adminius/templates/'.$_GET["code"].'.tpl.php';
			if (file_exists($filename)) {
				include ($_SERVER['DOCUMENT_ROOT'].'/adminius/templates/'.$_GET["code"].'.tpl.php');
			}else{
				echo "Файл шаблона не найден ".$filename;
			}
}
?>