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
				$xml.='
          <part>
			      <id>'.$iProd["article"].'</id>
			      <title>'.$name.'</title>
			      <catalogue_numbers>
               <catalogue_number>'.$iProd["article"].'</catalogue_number>
            </catalogue_numbers>
            <is_new>True</is_new>
						<price>'.$iProd["price"].'</price>
						<availability>
               <isAvailable>True</isAvailable>
            </availability>
						<images>
               <image>http://'.$_SERVER['SERVER_NAME'].'/images/product_cover/'.$iProd["img"].'</image>
            </images>
					</part>';
		}


		$fp=fopen($_SERVER['DOCUMENT_ROOT']."/priceAUTORU.xml","a");
		fwrite($fp, $xml);
		fclose($fp);
	}
		$page++;
		echo $page;
?>