<?
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');

	$page = clearData($_POST["page"], "i");
global $posts;
global $start;

$num = 100;
$posts = selectCount("categories as t1 LEFT JOIN categories as t2 on(t1.id=t2.section) LEFT JOIN categories as t3 on(t2.id=t3.section) LEFT JOIN product as t4 on(t3.id=t4.categories) WHERE t1.id='2' AND t4.active='1' AND t4.availability>0");
$start = strNav($page, $num, $posts);

$result = db2array("SELECT t4.name, t3.name as model, t2.name as marka, t4.price, t4.article, t4.id, t4.code, t3.img, t4.availability FROM categories as t1 LEFT JOIN categories as t2 on(t1.id=t2.section) LEFT JOIN categories as t3 on(t2.id=t3.section) LEFT JOIN product as t4 on(t3.id=t4.categories) WHERE t1.id='2' AND t4.active='1' AND t4.availability>0 ORDER BY t1.id ASC LIMIT $start, $num", 2);



$xml='';
	foreach($result as $iProd){
		if($iProd["availability"]>=4){
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
               <image>'.$iProd["img"].'</image>
            </images>
					</part>';
		}
	}
	$fp=fopen($_SERVER['DOCUMENT_ROOT']."/price/priceAUTORU.xml","a");
	fwrite($fp, $xml);
	fclose($fp);
	$page++;
	echo $page;
?>