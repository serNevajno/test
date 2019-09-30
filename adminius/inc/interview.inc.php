<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	if (!isset($_POST["id"])) {
		// Фильтруем полученные данные
		$name = clearData($_POST['name']);
		$active = clearData($_POST['active'], "i");
		$date = date("Y-m-d H:i:s");
		
		mysql_query("INSERT INTO interview (name, active, date) VALUES ('$name', '$active', '$date')") or die(mysql_error());
		$id_element = mysql_insert_id();
		addLogs(selectWhatUser(), 6, $id_element, "interview");

		header('Location: index.php?code=interview&action=edit&id='.$id_element);
		exit;
	}elseif(isset($_POST["id"]) and isset($_POST['name'])){
		$name = clearData($_POST['name']);
		$active = clearData($_POST['active'], "i");
		
		// Заносим в базу
		$id = clearData($_POST['id'], "i");

		mysql_query("UPDATE interview SET name='$name', active='$active' WHERE id='$id'") or die(mysql_error());
		
		addLogs(selectWhatUser(), 7, $id, "interview");
		
		foreach ($_POST["questions"] as $key => $item){
			if(!empty($item)){
				$temp = db2array("SELECT COUNT(*) FROM interview_question WHERE id_interview='$id' AND id='$key'");
				$color = $_POST["color"][$key];
				if($temp["COUNT(*)"]>0){
					mysql_query("UPDATE interview_question SET name='$item', color='$color' WHERE id='$key'");
				}else{
					mysql_query("INSERT INTO interview_question (name, color, id_interview) VALUES ('$item', '$color', '$id')");
				}
			}
		}
	
		header("Location: index.php?code=interview");
		exit;
	}elseif(!isset($_POST['name']) and !isset($_POST['title']) and !isset($_POST['code'])){
		// Фильтруем полученные данные
		$id = (int)$_POST['id'];
		
		// Заносим в базу
		
		mysql_query("DELETE FROM interview WHERE id='$id'") or die(mysql_error());

		addLogs(selectWhatUser(), 8, $id, "interview");

		header('Location: index.php?code=interview');
		exit;
	
	}
}
?> 