<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	if(!isset($_POST["id"]) and isset($_POST["title"]) and isset($_POST["categories"])) {
		// Фильтруем полученные данные
		$active = (int)$_POST['active'];
		$main = (int)$_POST['main'];
		$title = clearData($_POST['title']);
		$meta_k = clearData($_POST['meta_k']);
		$meta_d = clearData($_POST['meta_d']);
		$name = clearData($_POST['name']);
		$related = clearData($_POST['related']);
		$description = $_POST['description'];
		$price = clearData($_POST['price']);
		$price_clear = clearData($_POST['price_clear']);
		$sale = clearData($_POST['sale']);
		$availability = clearData($_POST['availability']);
		$logistic = clearData($_POST['logistic']);
		$categories =  (int)$_POST['categories'];
		$priority = (int)$_POST['priority'];
		$provider = (int)$_POST['provider'];
		$warranty = (int)$_POST['warranty'];
		$attention = (int)$_POST['attention'];
		$gift = (int)$_POST['gift'];
		$code = clearData($_POST['code']);
		$video = clearData($_POST['video']);
		$article = clearData($_POST['article']);
		$dop_articles = clearData($_POST['dop_articles']);
		
		if(empty($code)){
			$code = greateLink($name);
		}
		
		if (!empty($_FILES['img']['size'])) {
			$img = uploadPhoto($_FILES['img']['name'], $_FILES['img']['size'], $_FILES['img']['error'], $_FILES['img']['tmp_name'], "product_cover");

			resize('../images/product_cover/'.$img, '../images/product_cover/'.$img, 1000);
		}
			$date = date("Y-m-d H:i:s");
			$user = selectWhatUserAdmin();
			$sql = "INSERT INTO product (active, main, title, meta_k, meta_d, name, related, description, price, price_clear, sale, categories, priority, availability, img, date, user_id, provider, warranty, attention, gift, code, youtube_url, logistic, article) VALUES ('$active', '$main', '$title', '$meta_k', '$meta_d', '$name', '$related', '$description', '$price', '$price_clear', '$sale', '$categories', '$priority', '$availability', '$img', '$date', '$user', '$provider', '$warranty', '$attention', '$gift', '$code', '$video', '$logistic', '$article')";
			$result = mysql_query($sql) or die(mysql_error());
			$id = mysql_insert_id();
			for ($i=0; $i<10; $i++) {
				if ($_FILES[photo][size][$i] > 0) {
					uploadGallery($_FILES[photo][name][$i], $_FILES[photo][size][$i], $_FILES[photo][error][$i], $_FILES[photo][tmp_name][$i], $id);
				}
			}
			if($id AND $dop_articles){
                $arrDopArc = explode(",", $dop_articles);
                foreach ($arrDopArc as $iDopArc){
                    $art = trim($iDopArc);
                    mysql_query("INSERT INTO `product_articles`(`id_product`, `article`) VALUES ('$id','$art')") or die(mysql_error());
				}
			}
			//addLogs($user, 20, $id, "product");

		header('Location: /adminius/index.php?code=product&action=edit&id='.$id);
		exit;
	}elseif(isset($_POST["id"]) and isset($_POST["title"]) and isset($_POST["categories"])) {
		// Фильтруем полученные данные
		$id = (int)$_POST['id'];
		$active = (int)$_POST['active'];
		$main = (int)$_POST['main'];
		$title = clearData($_POST['title']);
		$meta_k = clearData($_POST['meta_k']);
		$meta_d = clearData($_POST['meta_d']);
		$name = clearData($_POST['name']);
		$related = clearData($_POST['related']);
		$description = $_POST['description'];
		$price = clearData($_POST['price']);
        $price_clear = clearData($_POST['price_clear']);
		$sale = clearData($_POST['sale']);
		$availability = clearData($_POST['availability']);
		$logistic = clearData($_POST['logistic']);
		$categories =  (int)$_POST['categories'];
		$cat_old =  (int)$_POST['cat_old'];
		$priority = (int)$_POST['priority'];
		$provider = (int)$_POST['provider'];
		$warranty = (int)$_POST['warranty'];
		$attention = (int)$_POST['attention'];
		$gift = (int)$_POST['gift'];
		$code = clearData($_POST['code']);
		$n = clearData($_POST['n'], "i");
		$filter = $_POST["fil_element"];
		$video = clearData($_POST['video']);
		$article = clearData($_POST['article']);
        $dop_articles = clearData($_POST['dop_articles']);

		if(empty($code)){
			$code = greateLink($name);
		}
		
		if(!empty($_FILES['img']['name'])){
			$img = uploadPhoto($_FILES['img']['name'], $_FILES['img']['size'], $_FILES['img']['error'], $_FILES['img']['tmp_name'], "product_cover");

			resize('../images/product_cover/'.$img, '../images/product_cover/'.$img, 1000);
			$img = ", img='".$img."'";
		}
		
		// Заносим в базу
			$date = date("Y-m-d H:i:s");
			$sql = "UPDATE product SET active='$active', main='$main', title='$title', meta_k='$meta_k', meta_d='$meta_d', name='$name', related='$related', description='$description', sale='$sale', availability='$availability', priority='$priority', price='$price', price_clear='$price_clear', warranty='$warranty', attention='$attention', youtube_url='$vidoe', gift='$gift', code='$code', logistic='$logistic', article='$article', date='$date'$img WHERE id='$id'";
			mysql_query($sql) or die(mysql_error());
			//addLogs(selectWhatUser(), 21, $id, "product");

        mysql_query("DELETE FROM `product_articles` WHERE id_product='$id'") or die(mysql_error());
        if($dop_articles){
            $arrDopArc = explode(",", $dop_articles);
            foreach ($arrDopArc as $iDopArc){
                $art = trim($iDopArc);
                mysql_query("INSERT INTO `product_articles`(`id_product`, `article`) VALUES ('$id','$art')") or die(mysql_error());
            }
        }

		for ($i=0; $i<$n; $i++) {
			if (isset($_POST[del_photo][$i]) AND $_POST[del_photo][$i] == 1) {
				deleteGallery($_POST[id_photo][$i]);
			}
		}
		for ($i=0; $i<10; $i++) {
			if ($_FILES[photo][size][$i] > 0) {
				uploadGallery($_FILES[photo][name][$i], $_FILES[photo][size][$i], $_FILES[photo][error][$i], $_FILES[photo][tmp_name][$i], $id);
			}
		}
		if($cat_old == $categories){
			if($filter) {
				foreach ($filter as $id_filter => $id_filter_element) {
				  if (selectCountValueFilter($id_filter, $id) > 0) {
					updateFilterValue($id_filter, $id_filter_element, $id);
				  } else {
					insertFilterValue($id_filter, $id_filter_element, $id);
				  }
				}
			  }
		}else{
			mysql_query("DELETE FROM `filter_value` WHERE id_product='$id'");
		}
		header('Location: /adminius/index.php?code=product&cat='.$categories);
		exit;
	}elseif(isset($_POST["id"]) and !isset($_POST["title"]) and !isset($_POST["categories"]) and isset($_POST["cat"])) {
		// Фильтруем полученные данные
		$id = (int)$_POST['id'];
		$cat = (int)$_POST["cat"];

		// Заносим в базу
		mysql_query("DELETE FROM product WHERE id='$id'") or die(mysql_error());
		mysql_query("DELETE FROM price_provider WHERE id_product='$id'") or die(mysql_error());
		mysql_query("DELETE FROM filter_value WHERE id_product='$id'") or die(mysql_error());
		addLogs(selectWhatUser(), 22, $id, "product");
		
		header('Location: /adminius/index.php?code=product&cat='.$cat);
		exit;
	}elseif(isset($_POST["product"]) and !isset($_POST["title"]) and !$_POST["categories"] and isset($_POST["cat"])) {
    $cat = (int)$_POST["cat"];

    foreach ($_POST['product'] as $id){
      mysql_query("DELETE FROM product WHERE id='$id'") or die(mysql_error());
      mysql_query("DELETE FROM price_provider WHERE id_product='$id'") or die(mysql_error());
      mysql_query("DELETE FROM filter_value WHERE id_product='$id'") or die(mysql_error());
      addLogs(selectWhatUser(), 22, $id, "product");
		}

    header('Location: /adminius/index.php?code=product&cat='.$cat);
    exit();
	}
}
?> 