<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	if (isset($_POST['id'])){
		
		$id = clearData($_POST['id'], "i");
    $active = clearData($_POST['active'], "i");
    $note = clearData($_POST['note']);
		
		$sql = "UPDATE users SET note='$note', active='$active' WHERE id = '$id'";
		$result = mysql_query($sql) or die(mysql_error());
		

		header('Location: /adminius/index.php?code=users&action=detail&id='.$id);
		exit;
	}
}?>