<?session_start();
	header("Content-Type: text/html; charset=UTF-8");
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');

	$page = clearData($_POST["page"], "i");

$posts = selectCount("product as t1 LEFT JOIN categories as t2 on(t1.categories=t2.id) WHERE t1.active='1' AND t2.in_xml='1'");
	if($posts>0){
		$num = 100;
		$start = strNav($page, $num, $posts);
		$arProd = db2array("SELECT t1.id, t1.img, t1.name, t1.price, t1.categories, t1.article, t1.logistic, t2.code as cat_code, t2.id as cat_id FROM product as t1 LEFT JOIN categories as t2 on(t1.categories=t2.id) WHERE t1.active='1' AND t2.in_xml='1' ORDER BY t1.priority DESC, t1.date DESC LIMIT $start, $num", 2);
		$xml ="";
		foreach($arProd as $iProd){
            $xml .= '<offer id="' . $iProd["id"] . '" available="true">
			            <delivery-options> 
                           <option cost="0" days="' . $iProd["logistic"] . '"/> 
                        </delivery-options>
						<url>http://dobrayashina.ru/'. $iProd["cat_code"] .'/' . $iProd["code"] . '-' . $iProd["id"] . '.html</url>
						<price>' . $iProd["price"] . '</price>
						<currencyId>RUR</currencyId>
						<categoryId>4</categoryId>
						<picture>http://dobrayashina.ru/images/product_cover/' . $iProd["img"] . '</picture>
						<store>false</store>
						<pickup>true</pickup> 
						<delivery>true</delivery>
						<name>' . $iProd["name"] . '</name>
						<description>' . $iProd["name"] . '</description>
						<vendorCode>' . $iProd["article"] . '</vendorCode>
						<age>0</age>
						<manufacturer_warranty>true</manufacturer_warranty>
					</offer>';
		}


		$fp=fopen($_SERVER['DOCUMENT_ROOT']."/price/price.xml","a");
		fwrite($fp, iconv("UTF-8", "WINDOWS-1251", $xml));
		fclose($fp);
	}
		$page++;
		echo $page;
?>