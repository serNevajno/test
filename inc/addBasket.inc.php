<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	session_start(); 
	//////Подключение к базе
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
	/////Подключение библиотеки
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');

	include ($_SERVER['DOCUMENT_ROOT'].'/inc/apiFunc.inc.php');
	
	$quantity = clearData($_POST["quantity"], "i");
	$code = clearData($_POST["code"]);
	$type = clearData($_POST["type"]);

		$date = date("Y-m-d H:i:s");
		
		/*if($type == "tyres"){
			if($quantity>0){
				$date = date("Y-m-d H:i:s");
				$iProduct = fullProductTyresApi($code);
				$name = mysql_real_escape_string($iProduct["name"]);
				
				$temp = db2array("SELECT quantity FROM basket WHERE code='$code' AND customer='".session_id()."'");
				if($temp["quantity"] > 0){
					$quantity_new = $quantity + $temp["quantity"];
					mysql_query("UPDATE `basket` SET quantity='$quantity_new', price='$iProduct[price]', day='$iProduct[dayLog]', price_clear='$iProduct[price_clear]' WHERE code='$code'") or die(mysql_error());
				}else{
					mysql_query("INSERT INTO basket (customer, quantity, date, code, price, name, img, categories, day, price_clear) VALUES ('".session_id()."', '$quantity', '$date', '$iProduct[code]', '$iProduct[price]', '$name', '$iProduct[img_small]', 'tyres', '$iProduct[dayLog]', '$iProduct[price_clear]')") or die(mysql_error());
				}
			}
		}elseif($type == "disk"){
			if($quantity>0){
				$iProduct = fullProductDiskApi($code);
			
				$name = mysql_real_escape_string($iProduct["name"]);
				
				$temp = db2array("SELECT quantity FROM basket WHERE code='$code' AND customer='".session_id()."'");
				if($temp["quantity"] > 0){
					$quantity_new = $quantity + $temp["quantity"];
					mysql_query("UPDATE `basket` SET quantity='$quantity_new', price='$iProduct[price]', day='$iProduct[dayLog]', price_clear='$iProduct[price_clear]' WHERE code='$code'") or die(mysql_error());
				}else{
					mysql_query("INSERT INTO basket (customer, quantity, date, code, price, name, img, categories, day, price_clear) VALUES ('".session_id()."', '$quantity', '$date', '$iProduct[code]', '$iProduct[price]', '$name', '$iProduct[img_small]', 'disk', '$iProduct[dayLog]', '$iProduct[price_clear]')") or die(mysql_error());
				}
			}
		}else{*/
			$iProduct = selectProductById($code);
			if($type == "disk"){
                $cat = "disk";
                $img = "/images/categories_cover/".$iProduct[cat_images];
            }elseif ($type == "tyres"){
                $cat = "tyres";
                $img = "/images/categories_cover/".$iProduct[cat_images];
            }else{
                $cat = $iProduct[categories];
                $img = $iProduct[img];
            }

			$name = mysql_real_escape_string($iProduct["name"]);
			$price = $iProduct["price"] - (($iProduct["price"] / 100)*$iProduct["sale"]);
			$temp = db2array("SELECT quantity FROM basket WHERE product_id='$code' AND customer='".session_id()."'");
			if($temp["quantity"] > 0){
				$quantity_new = $quantity + $temp["quantity"];
				mysql_query("UPDATE `basket` SET quantity='$quantity_new', price='$price', price_clear='$iProduct[price_clear]', day='$iProduct[dayLog]', sale='$iProduct[sale]', day='$iProduct[logistic]' WHERE product_id='$code'") or die(mysql_error());
			}else{
				mysql_query("INSERT INTO basket (customer, quantity, date, product_id, price, price_clear, name, img, categories, sale, day) VALUES ('".session_id()."', '$quantity', '$date', '$iProduct[id]', '$price', '$iProduct[price_clear]', '$name', '$img', '$cat', '$iProduct[sale]', '$iProduct[logistic]')") or die(mysql_error());
			}

	
		$sBasket = selectBasket();
		$res =' <a href="/basket.html">
										<i class="fa fa-shopping-basket"></i>
										<span class="badge">'.count($sBasket).'</span>
									</a>
									<ul class="cart-dropdown">
										<li class="bg-white bg1-gray-15 color-inher">';
		foreach($sBasket as $iBasket){
			$func = "delBasket('".$iBasket["id"]."')";
			$res.= '<div class="product-item">
													<div class="row m-lg-0">
														<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 p-l-lg-0">
															<a href="'.$iBasket["url"].'" class="product-img"><img src="'.$iBasket["img"].'" alt="image"></a>
														</div>
														<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 p-lg-0">
															<div class="product-caption text-left">
																<h4 class="product-name p-lg-0">
																	<a href="'.$iBasket["url"].'">'.$iBasket["name"].'</a>
																</h4>
																<p>'.$iBasket["quantity"].' x <strong>'.$iBasket["price"].'.00 руб</strong></p>
															</div>
														</div>
														<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 p-lg-0">
															<i class="fa fa-remove remove-cart-item" onClick="'.$func.'"></i>
														</div>
													</div>
												</div>';
		}
		$res.='<div class="p-t-lg-15 p-b-lg-10">Итог : <strong class="pull-right price">'.sumBasket().'.00 руб</strong></div>
											<div class="clearfix"></div>
											<a href="/basket.html" class="ht-btn pull-right" style="width:100%;text-align:center;">Перейти в корзину</a></li>
									</ul>';
		echo $res;
}
?>