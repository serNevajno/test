<?if($_SERVER["REQUEST_METHOD"]=="POST"){
		
		$phone = clearData($_POST['phone']);
		$email = clearData($_POST['email']);
		$emailTwo = clearData($_POST['emailTwo']);
		$addres = clearData($_POST['addres']);
		$time_work = clearData($_POST['time_work']);
        $time_pop = clearData($_POST['time_pop']);
		$work_text = clearData($_POST['work_text']);
		$maps = clearData($_POST['maps'], "h");
		$active = clearData($_POST['active'], "i");
		
		
		$sql = "UPDATE `settings` SET `phone`='$phone',`email`='$email',`emailTwo`='$emailTwo',`active`='$active',`addres`='$addres', time_work='$time_work', `maps`='$maps', `work_text`='$work_text', `time_pop`='$time_pop' WHERE 1";
		mysql_query($sql) or die(mysql_error());
		
		$ctn2 = count($_POST['id_social']);
		for($j=0; $j<=$ctn2; $j++){
			$name_social = $_POST['name_social'][$j];
			$url_social = $_POST['url_social'][$j];
			$id = $_POST['id_social'][$j];
		$sql3 = "UPDATE `social_network` SET `name_social`='$name_social',`url_social`='$url_social' WHERE id = '$id'";
		mysql_query($sql3) or die(mysql_error());
		}
		
		if(isset($_POST['del_social'])){
			echo $sql2 = "DELETE FROM `social_network` WHERE `id` IN ( " . implode( ', ', $_POST['del_social'] ) . " )";
			mysql_query($sql2) or die(mysql_error());
		}
			
		if(isset($_POST['new_url_social']) and isset($_POST['new_name_social'])){
			$ctn = count($_POST['new_url_social']);
			for($i=1;$i<=$ctn;$i++){
				$name_social = clearData($_POST['new_name_social'][$i]);
				$url_social = clearData($_POST['new_url_social'][$i]);
				echo $sql1 = "INSERT INTO social_network (name_social, url_social) VALUES ('$name_social', '$url_social')";
				mysql_query($sql1) or die(mysql_error());
			}
		}
		
header('Location: /adminius/index.php?code=settings');
exit;
}?>