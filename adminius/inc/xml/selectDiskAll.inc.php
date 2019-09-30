<?
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
	//include ($_SERVER['DOCUMENT_ROOT'].'/inc/apiFunc.inc.php');

    $page = clearData($_POST["page"], "i");
    $malDiam = '0';

    if($_POST["noMalDiam"] == '1'){
        $malDiam = '1';
    }

    /*$client = new SoapClient(SOAP_CLIENT);
	$page = clearData($_POST["page"], "i");
	$result = array();
			$params =  array
								(
										'login' => SOAP_LOGIN,
										'password' => SOAP_PASS,
										'filter' => array(
										),
										'page' => $page,
								);
			
						$answer = $client->GetFindDisk($params);
	
		
			$arrProduct= arrProductDisk($answer->GetFindDiskResult->price_rest_list->DiskPriceRest, $answer->GetFindDiskResult->warehouseLogistics->WarehouseLogistic);
			$result = array_merge($result, $arrProduct);*/

        global $posts;
        global $start;

        $num = 100;
        $posts = selectCount("categories as t1 
        LEFT JOIN categories as t2 on(t1.id=t2.section) 
        LEFT JOIN categories as t3 on(t2.id=t3.section) 
        LEFT JOIN product as t4 on(t3.id=t4.categories)
        LEFT JOIN filter_value as t5 on(t4.id=t5.id_product) 
        LEFT JOIN element_filter as t6 on(t5.element_value=t6.id)
        WHERE t1.id='2' AND t4.active='1' AND t4.availability>0 AND t4.price>0 AND t5.id_filter='25'");
        $start = strNav($page, $num, $posts);

        $result = db2array("SELECT t4.name, t3.name as model, t2.name as marka, t4.price, t4.article, t4.id, t4.code, t3.img, t4.availability, t4.logistic 
FROM categories as t1 
LEFT JOIN categories as t2 on(t1.id=t2.section) 
LEFT JOIN categories as t3 on(t2.id=t3.section) 
LEFT JOIN product as t4 on(t3.id=t4.categories)
LEFT JOIN filter_value as t5 on(t4.id=t5.id_product) 
LEFT JOIN element_filter as t6 on(t5.element_value=t6.id) 
WHERE t1.id='2' AND t4.active='1' AND t4.availability>0 AND t4.price>0 AND t5.id_filter='25' ORDER BY t1.id ASC LIMIT $start, $num", 2);



    $xml='';
	foreach($result as $iProd){
		if($iProd["availability"]>=4){
            if(($iProd["diameter"] != '12' AND $iProd["diameter"] != '13' AND $iProd["diameter"] != '14') OR $malDiam == '0') {
                $code = str_replace('.', '', $iProd["article"]);//удалить
                $name = str_replace("&amp;", "и", $iProd["name"]);
                $name = str_replace("&", "и", $name);
                $marka = str_replace("&amp;", "и", $iProd["marka"]);
                $marka = str_replace("&", "и", $marka);
                $xml .= '<offer id="' . $iProd["id"] . '" available="true">
					    <delivery-options> 
                           <option cost="0" days="' . $iProd["logistic"] . '"/> 
                        </delivery-options>
						<url>http://dobrayashina.ru/disk/' . $iProd["code"] . '-' . $iProd["id"] . '.html</url>
						<price>' . $iProd["price"] . '</price>
						<currencyId>RUR</currencyId>
						<categoryId>2</categoryId>
						<picture>http://dobrayashina.ru/images/categories_cover/' . $iProd["img"] . '</picture>
						<store>false</store>
						<pickup>true</pickup> 
						<delivery>true</delivery>
						<name>' . $name . '</name>
						<vendor>' . $marka . '</vendor>
						<model>' . $iProd["model"] . '</model>
						<description>' . $name . '</description>
						<vendorCode>' . $iProd["article"] . '</vendorCode>
						<sales_notes>Покупка менее 4 по согласованию. Предоплата 100%</sales_notes>
						<min-quantity>4</min-quantity> 
						<age>0</age>
						<manufacturer_warranty>true</manufacturer_warranty>
					</offer>';
            }
		}
	}
	$fp=fopen($_SERVER['DOCUMENT_ROOT']."/price/price.xml","a");
	fwrite($fp, iconv("UTF-8", "WINDOWS-1251", $xml));
	fclose($fp);
	$page++;
	echo $page;
?>