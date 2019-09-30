<?session_start();
	header("Content-Type: text/html; charset=UTF-8");
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');

	$page = clearData($_POST["page"], "i");
	
	$posts = selectCount("product WHERE active='1' AND categories IN ($_POST[categories])");
	if($posts>0){
		$num = 2;
		$start = strNav($page, $num, $posts);
		$arProd = db2array("SELECT id, img, name, price, categories, article FROM product WHERE active='1' AND categories IN ($_POST[categories]) ORDER BY priority DESC, date DESC LIMIT $start, $num", 2);
		$xml ="";
		foreach($arProd as $iProd){
				$name = str_replace("&", "&amp;", $iProd["name"]);
				$model = str_replace("&", "&amp;", $iProd["model"]);
				$marka = str_replace('&', '&amp;', $iProd["marka"]);
				$xml.='<offer id="'.$iProd["article"].'" available="true">
							<url>http://dobrayashina.ru/disk/'.$iProd["code"].'.html</url>
							<price>'.$iProd["price"].'</price>
							<currencyId>RUR</currencyId>
							<categoryId>'.$iProd["categories"].'</categoryId>
							<picture>http://dobrayashina.ru/images/product_cover/'.$iProd["img"].'</picture>
							<store>false</store>
							<pickup>true</pickup> 
							<delivery>true</delivery>
							<name>'.$name.'</name>
							<age>0</age>
							<manufacturer_warranty>true</manufacturer_warranty>
						</offer>'; 
		}


		$fp=fopen($_SERVER['DOCUMENT_ROOT']."/price.xml","a");  
		fwrite($fp, iconv("UTF-8", "WINDOWS-1251", $xml));
		fclose($fp);
	}
		$page++;
		echo $page;
?>