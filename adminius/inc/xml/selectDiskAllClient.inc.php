<?
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
//include ($_SERVER['DOCUMENT_ROOT'].'/inc/apiFunc.inc.php');

$page = clearData($_POST["page"], "i");

global $posts;
global $start;

$num = 100;
$posts = selectCount("categories as t1 LEFT JOIN categories as t2 on(t1.id=t2.section) LEFT JOIN categories as t3 on(t2.id=t3.section) LEFT JOIN product as t4 on(t3.id=t4.categories) WHERE t1.id='2' AND t4.active='1' AND t4.availability>0");
$start = strNav($page, $num, $posts);

$result = db2array("SELECT t4.name, t3.name as model, t2.name as marka, t4.price, t4.price_clear, t4.article, t4.id, t4.code, t3.img, t4.availability, t4.logistic FROM categories as t1 LEFT JOIN categories as t2 on(t1.id=t2.section) LEFT JOIN categories as t3 on(t2.id=t3.section) LEFT JOIN product as t4 on(t3.id=t4.categories) WHERE t1.id='2' AND t4.active='1' AND t4.availability>0 ORDER BY t1.id ASC LIMIT $start, $num", 2);

$proc = selectProcentXml('2');
$xml='';
foreach($result as $iProd){
    $PrProc = $iProd["price_clear"]/100*$proc;
    $PrProc = round($PrProc);
    $price = $iProd["price_clear"]+$PrProc;

    if($iProd["availability"]>=4){
        $code = str_replace('.', '', $iProd["article"]);//удалить

        $xml.='<offer id="'.$code.'" available="true">
        				<delivery-options> 
                           <option cost="0" days="'.$iProd["logistic"].'"/> 
                        </delivery-options>
						<url>http://dobrayashina.ru/disk/'.$iProd["code"].'-'.$iProd["code"].'.html</url>
						<price>'.$price.'</price>
						<currencyId>RUR</currencyId>
						<categoryId>2</categoryId>
						<picture>http://dobrayashina.ru/disk/'.$iProd["code"].'-'.$iProd["code"].'.html</picture>
						<store>false</store>
						<pickup>true</pickup> 
						<delivery>true</delivery>
						<name>'.$iProd["name"].'</name>
						<vendor>'.$iProd["marka"].'</vendor>
						<model>'.$iProd["model"].'</model>
						<description>'.$iProd["name"].'</description>
						<vendorCode>'.$iProd["article"].'</vendorCode>
						<sales_notes>При заказе менее 4 штук необходима предоплата</sales_notes>
						<age>0</age>
						<manufacturer_warranty>true</manufacturer_warranty>
					</offer>';
    }
}
$fp=fopen($_SERVER['DOCUMENT_ROOT']."/price/priceClient.xml","a");
fwrite($fp, iconv("UTF-8", "WINDOWS-1251", $xml));
fclose($fp);
$page++;
echo $page;
?>