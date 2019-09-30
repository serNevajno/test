<?
    error_reporting(0);
    header("Content-Type: text/html;charset=utf8");
    include($_SERVER['DOCUMENT_ROOT'] . '/inc/redirect.inc.php');
	session_start(); 
	//////Подключение к базе
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
	/////Подключение библиотеки
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');

	if($_SERVER["REQUEST_METHOD"]=="POST"){
		include($_SERVER['DOCUMENT_ROOT'].'/inc/'.$_POST["func"].'.inc.php');
	}
	
	///Востановление пароля
	if (isset($_GET["id"]) AND (isset($_GET["secret"]))) {
		include ($_SERVER['DOCUMENT_ROOT'].'/inc/recovery.inc.php');
	}
	if (isset($_GET["code"])) {
		if(isset($_GET["id_news"])){
			$meta_item = selectNewsById($_GET["id_news"]);
			newViewBlog($meta_item["view"], $_GET["id_news"]);
		}else{
			$meta_item = selectMeta($_GET["code"]);	
		}
		if (!$meta_item){
			header("HTTP/1.0 404 Not Found");
			header("Location: /404.html");
			exit();
		}
	}elseif(isset($_GET["categories_code"])){
		/*if(isset($_GET["product_code"])){
			$meta_item = array();
			include($_SERVER['DOCUMENT_ROOT'].'/inc/apiFunc.inc.php');
			if($_GET["categories_code"] == "tyres"){
				$iProduct = fullProductTyresApi($_GET["product_code"]);
				$meta_item["categories"] = "1";
			}elseif($_GET["categories_code"] == "disk"){
				$iProduct = fullProductDiskApi($_GET["product_code"]);
				$meta_item["categories"] = "2";
			}

			$meta_item["title"] = $iProduct["name"];
			$meta_item["meta_d"] = $iProduct["name"];
			$meta_item["name"] = $iProduct["name"];

			if(!$iProduct){
				header("HTTP/1.0 404 Not Found");
				header("Location: /404.html");
				exit();
			}
		}else{*/
			if(isset($_GET["id"])){
				$meta_item = selectProductById($_GET["id"]);
				if(!$meta_item){
					header("HTTP/1.0 404 Not Found");
					header("Location: /404.html");
					exit();
				}
			}else{
				$meta_item = selectMetaCategories($_GET["categories_code"]);
				if(!$meta_item){
					header("HTTP/1.0 404 Not Found");
					header("Location: /404.html");
					exit();
				}
			}

	}else{
		$meta_item = selectMeta("main");
	}

	$iUser = selectUserID();
	$settings = settingsSite();
	$sSocial = selectSocial();
	$session_admin = selectSessionAdmin();
	$session = selectSession();
	if(!$session AND $_GET["code"] == "profile"){
		header("Location: /");
		exit();
	}
	if($session AND $_GET["code"] == "registration"){
		header("Location: /");
		exit();
	}
	if ($settings['active']==1 or $session_admin){
		include($_SERVER['DOCUMENT_ROOT'].'/templates/header2.tpl.php');
		
		if (isset($_GET["code"])) {
			if(file_exists($_SERVER['DOCUMENT_ROOT'].'/templates/'.$_GET["code"].'.tpl.php')){
				include($_SERVER['DOCUMENT_ROOT'].'/templates/'.$_GET["code"].'.tpl.php');
			}else{
				include($_SERVER['DOCUMENT_ROOT'].'/templates/section.tpl.php');
			}
		}elseif(isset($_GET["categories_code"])){
			if($_GET["categories_code"] == "disk"){
				if(isset($_GET["product_code"])){
					//include($_SERVER['DOCUMENT_ROOT'].'/templates/productDetailForApi.tpl.php');
                    include($_SERVER['DOCUMENT_ROOT'].'/templates/productDetail.tpl.php');
                    newViewProduct($meta_item["view"], $_GET["id"]);
				}else{
					include($_SERVER['DOCUMENT_ROOT'].'/templates/disk.tpl.php');
				}
			}elseif($_GET["categories_code"] == "tyres"){
				        if(isset($_GET["product_code"])) {
                    //include($_SERVER['DOCUMENT_ROOT'].'/templates/productDetailForApi.tpl.php');
                    include($_SERVER['DOCUMENT_ROOT'] . '/templates/productDetail.tpl.php');
                    newViewProduct($meta_item["view"], $_GET["id"]);
                }elseif (isset($_GET["section_code"])){
                    if(checkSection($meta_item["id"])){
                        include($_SERVER['DOCUMENT_ROOT'].'/templates/categoriesList.tpl.php');
                    }else{
                        $sec = 1;
                        include($_SERVER['DOCUMENT_ROOT'].'/templates/productList.tpl.php');
                    }
				}else{
					include($_SERVER['DOCUMENT_ROOT'].'/templates/tyres.tpl.php');
				}
			}else{
				if(isset($_GET["id"])){
					include($_SERVER['DOCUMENT_ROOT'].'/templates/productDetail.tpl.php');
					newViewProduct($meta_item["view"], $_GET["id"]);
				}else{
					if(checkSection($meta_item["id"])){
						include($_SERVER['DOCUMENT_ROOT'].'/templates/categoriesList.tpl.php');
					}else{
						$sec = 1;
						include($_SERVER['DOCUMENT_ROOT'].'/templates/productList.tpl.php');
					}
				}
			}
		}else{
			include($_SERVER['DOCUMENT_ROOT'].'/templates/main.tpl.php');
		}
		
		include($_SERVER['DOCUMENT_ROOT'].'/templates/footer.tpl.php');
	}else{
		include($_SERVER['DOCUMENT_ROOT'].'/templates/maintenance.tpl.php');
	}
echo date("H:i O");
?>