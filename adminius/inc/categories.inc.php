<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	if (!isset($_POST["id"])) {
		// Фильтруем полученные данные
		$name = clearData($_POST['name']);
		$title = clearData($_POST['title']);
		$meta_d = clearData($_POST['meta_d']);
		$meta_k = clearData($_POST['meta_k']);
		$code = clearData($_POST['code']);
		$descriptions = $_POST['descriptions'];
		$priority = clearData($_POST['priority'], "i");
		$section = clearData($_POST['section'], "i");
		$active = clearData($_POST['active'], "i");
        $in_xml = clearData($_POST['in_xml'], "i");

		if(empty($code)){
			$code = greateLink($name);
		}
		
		if (!empty($_FILES['img']['size'])) {
			$img = uploadPhoto($_FILES['img']['name'], $_FILES['img']['size'], $_FILES['img']['error'], $_FILES['img']['tmp_name'], "categories_cover");

			resize('../images/categories_cover/'.$img, '../images/categories_cover/'.$img, 300);
		}
		
		mysql_query("INSERT INTO categories (name, title, meta_d, meta_k, code, descriptions, priority, section, img, active, in_xml) VALUES ('$name', '$title', '$meta_d', '$meta_k', '$code', '$descriptions', '$priority', '$section', '$img', '$active', '$in_xml')") or die(mysql_error());
		$id_element = mysql_insert_id();
		addLogs(selectWhatUser(), 23, $id_element, "categories");

		header('Location: index.php?code=categories&action=edit&id='.$id_element);
		exit;
	}elseif(isset($_POST["id"]) and isset($_POST['name']) and isset($_POST['title']) and isset($_POST['code'])){
		$name = clearData($_POST['name']);
		$title = clearData($_POST['title']);
		$meta_d = clearData($_POST['meta_d']);
		$meta_k = clearData($_POST['meta_k']);
		$code = clearData($_POST['code']);
		$descriptions = $_POST['descriptions'];
		$priority = clearData($_POST['priority'], "i");
		$section = clearData($_POST['section'], "i");
		$active = clearData($_POST['active'], "i");
        $in_xml = clearData($_POST['in_xml'], "i");

		if(empty($code)){
			$code = greateLink($name);
		}
		
		if(!empty($_FILES['img']['name'])){
			$img = uploadPhoto($_FILES['img']['name'], $_FILES['img']['size'], $_FILES['img']['error'], $_FILES['img']['tmp_name'], "categories_cover");

			resize('../images/categories_cover/'.$img, '../images/categories_cover/'.$img, 300);
			$img = ", img='".$img."'";
		}
		
		// Заносим в базу
		$id = clearData($_POST['id'], "i");

		mysql_query("UPDATE categories SET name='$name', title='$title', meta_d='$meta_d', meta_k='$meta_k', code='$code', descriptions='$descriptions', priority='$priority', active='$active', section='$section', in_xml='$in_xml'$img WHERE id='$id'") or die(mysql_error());
		
		addLogs(selectWhatUser(), 24, $id, "categories");
	
		header( "Location: index.php?code=categories" );
		exit;
	}elseif(!isset($_POST['name']) and !isset($_POST['title']) and !isset($_POST['code'])){
		// Фильтруем полученные данные
		$id = (int)$_POST['id'];
        $section = (int)$_POST['section'];
        $wrsec = "";
		// Заносим в базу
        $sPro = db2array("SELECT id FROM product WHERE categories='$id'", 2);
        foreach ($sPro as $id_del){
            mysql_query("DELETE FROM product WHERE id='$id_del[id]'") or die(mysql_error());
            mysql_query("DELETE FROM price_provider WHERE id_product='$id_del[id]'") or die(mysql_error());
            mysql_query("DELETE FROM filter_value WHERE id_product='$id_del[id]'") or die(mysql_error());

        }
        
		mysql_query("DELETE FROM categories WHERE id='$id'") or die(mysql_error());

		addLogs(selectWhatUser(), 25, $id, "categories");

		if($section){
			$wrsec = "&section=".$section;
		}
		header('Location: index.php?code=categories'.$wrsec);
		exit;
	
	}

}
?> 