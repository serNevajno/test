<?php if($_SERVER["REQUEST_METHOD"]=="POST"){
	if (isset($_POST['login']) and !isset($_POST['id'])){
		$login = clearData($_POST['login']);
		$name = clearData($_POST['name']);
		$group = clearData($_POST['group']);
		$pass=trim($_POST['pass']);
		$pass = md5($pass);

		// ������� � ����
		mysql_query("INSERT INTO admin_user (login, password, id_group, name) VALUES ('$login', '$pass', '$group', '$name')") or die(mysql_error());
		$id_element = mysql_insert_id();
		addLogs(selectWhatUser(), 6, $id_element, "admin_user");

		foreach($_POST['region'] as $item){
            $item = clearData($item, "i");
            mysql_query("INSERT INTO `admin_region` (`id_admin`, `id_region`) VALUES ('$id_element', '$item')");
        }

		header('Location: index.php?code=adminUser');
		exit;
	}elseif(isset($_POST['login']) and isset($_POST['id'])){
		$id = clearData($_POST['id'], "i");
		$login = clearData($_POST['login']);
		$name = clearData($_POST['name']);
		$group = clearData($_POST['group']);
		
		if(!empty($_POST['pass'])){
			$pass=trim($_POST['pass']);
			$pass = md5($pass);
			$pass = ", password='$pass'";
		}
		// ������� � ����
		mysql_query("UPDATE admin_user SET login='$login', name='$name', id_group='$group'$pass WHERE id='$id'") or die(mysql_error());
		addLogs(selectWhatUser(), 6, $id, "admin_user");

        mysql_query("DELETE FROM admin_region WHERE id_admin='$id'") or die(mysql_error());
        foreach($_POST['region'] as $item){
            $item = clearData($item, "i");
            mysql_query("INSERT INTO `admin_region` (`id_admin`, `id_region`) VALUES ('$id', '$item')");
        }

		header('Location: index.php?code=adminUser');
		exit;
	}elseif(!isset($_POST['login']) and isset($_POST['id'])){
		$id = clearData($_POST['id'], "i");
		
		// ������� � ����
		mysql_query("DELETE FROM admin_user WHERE id='$id'") or die(mysql_error());
        mysql_query("DELETE FROM admin_region WHERE id_admin='$id'") or die(mysql_error());
		addLogs(selectWhatUser(), 8, $id, "admin_user");
		header('Location: index.php?code=adminUser');
		exit;
	}
}?>