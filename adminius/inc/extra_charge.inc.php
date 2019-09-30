<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	if (!isset($_POST["id"])) {

		$type = clearData($_POST['type'], "i");
		$brand = clearData($_POST['brand']);
		$diameter = clearData($_POST['diameter']);
		$season = clearData($_POST['season']);
		$percent = clearData($_POST['percent']);

		$temp = db2array("SELECT id FROM extra_charge WHERE type='$type' AND diameter='$diameter' AND brand='$brand' AND season='$season' AND percent='$percent'");
		if($temp["id"] > 0){
			header('Location: index.php?code=extra_charge_tyres&action=edit&id='.$temp["id"]);
		}else{
			mysql_query("INSERT INTO extra_charge (type, brand, diameter, season, percent) VALUES ('$type', '$brand', '$diameter', '$season', '$percent')") or die(mysql_error());
			if($type == "1"){
				header('Location: index.php?code=extra_charge_tyres');
			}else{
				header('Location: index.php?code=extra_charge_disk');
			}
		}

		exit;
	}elseif(isset($_POST["id"]) and isset($_POST['brand']) and isset($_POST['diameter']) and isset($_POST['percent'])){
		$id = clearData($_POST['id']);
		$type = clearData($_POST['type'], "i");
		$brand = clearData($_POST['brand']);
		$diameter = clearData($_POST['diameter']);
		$season = clearData($_POST['season']);
		$percent = clearData($_POST['percent']);
		
		// ������� � ����

		mysql_query("UPDATE extra_charge SET brand='$brand', diameter='$diameter', season='$season', percent='$percent' WHERE id='$id'") or die(mysql_error());
	
			if($type == "1"){
				header('Location: index.php?code=extra_charge_tyres');
			}else{
				header('Location: index.php?code=extra_charge_disk');
			}
		exit;
	}elseif(!isset($_POST['brand']) and !isset($_POST['diameter']) and !isset($_POST['percent']) AND isset($_POST['id'])){
		// ��������� ���������� ������
		$id = (int)$_POST['id'];
		$type = clearData($_POST['type'], "i");
		// ������� � ����
		
		mysql_query("DELETE FROM extra_charge WHERE id='$id'") or die(mysql_error());
		
		if($type == "1"){
				header('Location: index.php?code=extra_charge_tyres');
		}else{
				header('Location: index.php?code=extra_charge_disk');
		}
		exit;
	
	}

}
?> 