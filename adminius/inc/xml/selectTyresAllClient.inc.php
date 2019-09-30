<?
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
//include ($_SERVER['DOCUMENT_ROOT'].'/inc/apiFunc.inc.php');

$page = clearData($_POST["page"], "i");

/*$client = new SoapClient(SOAP_CLIENT);
$page = clearData($_POST["page"], "i");
$result = array();
        $params =  array
                            (
                                    'login' => SOAP_LOGIN,
                                    'password' => SOAP_PASS,
                                    'filter' => array(
                                            'type_list' => array(0 => "car", 1 => "cartruck", 2 => "vned"),
                                    ),
                                    'page' => $page,
                            );

                    $answer = $client->GetFindTyre($params);


        $arrProduct= arrProduct($answer->GetFindTyreResult->price_rest_list->TyrePriceRest, $answer->GetFindTyreResult->warehouseLogistics->WarehouseLogistic);
        $result = array_merge($result, $arrProduct);*/

global $posts;
global $start;

$num = 100;
$posts = selectCount("categories as t1 LEFT JOIN categories as t2 on(t1.id=t2.section) LEFT JOIN categories as t3 on(t2.id=t3.section) LEFT JOIN product as t4 on(t3.id=t4.categories) WHERE t1.id='1' AND t4.active='1' AND t4.availability>0");
$start = strNav($page, $num, $posts);

$result = db2array("SELECT t4.name, t3.name as model, t2.name as marka, t6.value as diameter, t4.price, t4.price_clear, t4.article, t4.id, t4.code, t3.img, t4.logistic FROM categories as t1 LEFT JOIN categories as t2 on(t1.id=t2.section) LEFT JOIN categories as t3 on(t2.id=t3.section) LEFT JOIN product as t4 on(t3.id=t4.categories) LEFT JOIN filter_value as t5 on(t4.id=t5.id_product) LEFT JOIN element_filter as t6 on(t5.element_value=t6.id) WHERE t1.id='1' AND t4.active='1' AND t4.availability>0 AND t5.id_filter='20' ORDER BY t1.id ASC LIMIT $start, $num", 2);

$proc = selectProcentXml('1');
$xml='';
foreach($result as $iProd){

    $PrProc = $iProd["price_clear"]/100*$proc;
    $PrProc = round($PrProc);
    $price = $iProd["price_clear"]+$PrProc;

    $code = str_replace('.', '', $iProd["article"]);//удалить

    $xml.='<offer id="'.$code.'" available="true">
    			        <delivery-options> 
                           <option cost="0" days="'.$iProd["logistic"].'"/> 
                        </delivery-options>
						<url>http://dobrayashina.ru/tyres/'.$iProd["code"].'-'.$iProd["id"].'.html</url>
						<price>'.$price.'</price>
						<currencyId>RUR</currencyId>
						<categoryId>1</categoryId>
						<picture>http://dobrayashina.ru/images/categories_cover/'.$iProd["img"].'</picture>
						<store>false</store>
						<pickup>true</pickup> 
						<delivery>true</delivery>
						<name>'.$iProd["name"].'</name>
						<vendor>'.$iProd["marka"].'</vendor>
						<model>'.$iProd["model"].'</model>
						<description>'.$iProd["name"].'</description>
						<vendorCode>'.$iProd["article"].'</vendorCode>
						<sales_notes>Может потребоваться предоплата</sales_notes>
						<age>0</age>
						<manufacturer_warranty>true</manufacturer_warranty>
					</offer>';
}
$fp=fopen($_SERVER['DOCUMENT_ROOT']."/price/priceClient.xml","a");
fwrite($fp, iconv("UTF-8", "WINDOWS-1251", $xml));
fclose($fp);
$page++;
echo $page;
?>