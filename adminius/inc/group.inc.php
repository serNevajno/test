<?php if($_SERVER["REQUEST_METHOD"]=="POST"){
	if (isset($_POST['name']) and !isset($_POST['id'])){
		$name = clearData($_POST['name']);
		$banner = clearData($_POST['banner'], "i");
		$users = clearData($_POST['users'], "i");
		$sections = clearData($_POST['sections'], "i");
		$orders = clearData($_POST['orders'], "i");
		$message_admin = clearData($_POST['message_admin'], "i");
		$settings = clearData($_POST['settings'], "i");
		$admin = clearData($_POST['admin'], "i");
		$blog = clearData($_POST['blog'], "i");
		$slider = clearData($_POST['slider'], "i");
		$del = clearData($_POST['del'], "i");
		$banner = clearData($_POST['banner'], "i");
		$extra_charge = clearData($_POST['extra_charge'], "i");
		$product = clearData($_POST['product'], "i");
		$finance = clearData($_POST['finance'], "i");
		$xml = clearData($_POST['xml'], "i");
		$xmlAUTORU = clearData($_POST['xmlAUTORU'], "i");
		$xmlClient = clearData($_POST['xmlClient'], "i");

		// Заносим в базу
		mysql_query("INSERT INTO `admin_group`(name, banner, users, sections, orders, message_admin, settings, admin, del, blog, extra_charge, product, slide, finance, xml, xmlAUTORU, xmlClient) VALUES ('$name', '$banner', '$users', '$sections', '$orders', '$message_admin', '$settings', '$admin', '$del', '$blog', '$extra_charge', '$product', '$slider', '$finance', '$xml', '$xmlAUTORU', '$xmlClient')") or die(mysql_error());
		$id_element = mysql_insert_id();
		//addLogs(selectWhatUser(), 6, $id_element, "admin_group");

		header('Location: index.php?code=group');
		exit;
	}elseif(isset($_POST['name']) and isset($_POST['id'])){
		$id = clearData($_POST['id'], "i");
		$name = clearData($_POST['name']);
		$banner = clearData($_POST['banner'], "i");
		$users = clearData($_POST['users'], "i");
		$sections = clearData($_POST['sections'], "i");
		$orders = clearData($_POST['orders'], "i");
		$message_admin = clearData($_POST['message_admin'], "i");
		$settings = clearData($_POST['settings'], "i");
		$admin = clearData($_POST['admin'], "i");
		$blog = clearData($_POST['blog'], "i");
		$slider = clearData($_POST['slider'], "i");
		$del = clearData($_POST['del'], "i");
		$banner = clearData($_POST['banner'], "i");
		$extra_charge = clearData($_POST['extra_charge'], "i");
		$product = clearData($_POST['product'], "i");
    $finance = clearData($_POST['finance'], "i");
    $xml = clearData($_POST['xml'], "i");
    $xmlAUTORU = clearData($_POST['xmlAUTORU'], "i");
    $xmlClient = clearData($_POST['xmlClient'], "i");
		
		// Заносим в базу
		mysql_query("UPDATE admin_group SET name='$name', banner='$banner', users='$users', sections='$sections', orders='$orders', message_admin='$message_admin', settings='$settings', admin='$admin', del='$del', blog='$blog', extra_charge='$extra_charge', product='$product', slider='$slider', finance='$finance', xml='$xml', xmlAUTORU='$xmlAUTORU', xmlClient='$xmlClient' WHERE id='$id'") or die(mysql_error());
		//addLogs(selectWhatUser(), 6, $id, "admin_group");

		header('Location: index.php?code=group');
		exit;
	}elseif(!isset($_POST['name']) and isset($_POST['id'])){
		$id = clearData($_POST['id'], "i");
		
		// Заносим в базу
		mysql_query("DELETE FROM admin_group WHERE id='$id'") or die(mysql_error());
		//addLogs(selectWhatUser(), 8, $id, "admin_group");
		header('Location: index.php?code=group');
		exit;
	}
}?>