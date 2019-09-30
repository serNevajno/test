<?
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
	//include ($_SERVER['DOCUMENT_ROOT'].'/inc/apiFunc.inc.php');

    $page = clearData($_POST["page"], "i");
    $malDiam = '0';

    if($_POST["noMalDiam"] == '1'){
        $malDiam = '1';
    }

    if($_POST["s"] == '1' OR $_POST["w"] == '1' OR $_POST["u"] == '1') {
        $season =" AND (";

        if($_POST["s"] == '1'){
            $season.="t8.element_value='155'";
            $or=" OR ";
        }
        if($_POST["w"] == '1'){
            $season.=$or."t8.element_value='156'";
            $or=" OR ";
        }
        if($_POST["u"] == '1'){
            $season.=$or."t8.element_value='157'";
        }
        $season.=")";
    }
    if($_POST["s"] == '1' AND $_POST["w"] == '1' AND $_POST["u"] == '1'){
        $season = "";
    }

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

    $num = 200;
    $posts = db2array("SELECT COUNT(DISTINCT t4.id) FROM categories as t1 
    LEFT JOIN categories as t2 on(t1.id=t2.section) 
    LEFT JOIN categories as t3 on(t2.id=t3.section) 
    LEFT JOIN product as t4 on(t3.id=t4.categories) 
    LEFT JOIN filter_value AS t5 ON (t4.id = t5.id_product)
    LEFT JOIN element_filter as t6 on(t5.element_value=t6.id) 
    LEFT JOIN filter_value as t8 on(t4.id=t8.id_product)
    LEFT JOIN element_filter as t7 on(t8.element_value=t7.id)
    WHERE t1.id='1' AND t4.active='1' AND t4.availability>0 AND t4.price>0 AND t5.id_filter='20' AND t8.id_filter='23'$season");
    $start = strNav($page, $num, $posts["COUNT(DISTINCT t4.id)"]);

    $result = db2array("SELECT t4.name, t3.name as model, t2.name as marka, t6.value as diameter, t4.price, t4.article, t4.id, t4.code, t3.img, t4.logistic, t4.availability 
    FROM categories as t1 
    LEFT JOIN categories as t2 on(t1.id=t2.section) 
    LEFT JOIN categories as t3 on(t2.id=t3.section) 
    LEFT JOIN product as t4 on(t3.id=t4.categories) 
    LEFT JOIN filter_value as t5 on(t4.id=t5.id_product) 
    LEFT JOIN element_filter as t6 on(t5.element_value=t6.id) 
    LEFT JOIN filter_value as t8 on(t4.id=t8.id_product)
    LEFT JOIN element_filter as t7 on(t8.element_value=t7.id)
    WHERE t1.id='1' AND t4.active='1' AND t4.availability>0 AND t4.price>0 AND t5.id_filter='20' AND t8.id_filter='23'$season GROUP BY t4.id ORDER BY t4.id ASC LIMIT $start, $num", 2);

	$xml='';

	foreach($result as $iProd){
        if($iProd["availability"]>=4) {
            if(($iProd["diameter"] != '12' AND $iProd["diameter"] != '13' AND $iProd["diameter"] != '14') OR $malDiam == '0') {
                if ($iProd["diameter"] == '18' OR $iProd["diameter"] == '19' OR $iProd["diameter"] == '20' OR $iProd["diameter"] == '21') {
                    $proc = $iProd["price"] / 100 * 5;
                    $proc = round($proc);
                    $oldprice = '<oldprice>' . ($iProd["price"] + $proc) . '</oldprice>';
                } else {
                    $oldprice = '';
                }
                $name = str_replace('*', ' ', $iProd["name"]);
                $name = str_replace('✩', '', $iProd["name"]);
                $code = str_replace('.', '', $iProd["article"]);//удалить

                $xml .= '<offer id="' . $iProd["id"] . '" available="true">
			            <delivery-options> 
                           <option cost="0" days="' . $iProd["logistic"] . '"/> 
                        </delivery-options>
						<url>http://dobrayashina.ru/tyres/' . $iProd["code"] . '-' . $iProd["id"] . '.html</url>
						<price>' . $iProd["price"] . '</price>
						<currencyId>RUR</currencyId>
						<categoryId>1</categoryId>
						<picture>http://dobrayashina.ru/images/categories_cover/' . $iProd["img"] . '</picture>
						<store>false</store>
						<pickup>true</pickup> 
						<delivery>true</delivery>
						<name>' . $name . '</name>
						<vendor>' . $iProd["marka"] . '</vendor>
						<model>' . $iProd["model"] . '</model>
						<description>' . $name . '</description>
						<vendorCode>' . $iProd["article"] . '</vendorCode>
						<sales_notes>Покупка менее 4 по согласованию. Предоплата 100%</sales_notes>
						<min-quantity>4</min-quantity>' . $oldprice . '
						<age>0</age>
						<manufacturer_warranty>true</manufacturer_warranty>
					</offer>';
            }
        }
        if($iProd["id"] == '58018'){
           // echo "error-".$page;
        }
	}
	$fp=fopen($_SERVER['DOCUMENT_ROOT']."/price/price.xml","a");
  if(!fwrite($fp, iconv("UTF-8", "WINDOWS-1251", $xml))) {
    echo "SELECT t4.name, t3.name as model, t2.name as marka, t6.value as diameter, t4.price, t4.article, t4.id, t4.code, t3.img, t4.logistic, t4.availability 
    FROM categories as t1 
    LEFT JOIN categories as t2 on(t1.id=t2.section) 
    LEFT JOIN categories as t3 on(t2.id=t3.section) 
    LEFT JOIN product as t4 on(t3.id=t4.categories) 
    LEFT JOIN filter_value as t5 on(t4.id=t5.id_product) 
    LEFT JOIN element_filter as t6 on(t5.element_value=t6.id) 
    LEFT JOIN filter_value as t8 on(t4.id=t8.id_product)
    LEFT JOIN element_filter as t7 on(t8.element_value=t7.id)
    WHERE t1.id='1' AND t4.active='1' AND t4.availability>0 AND t4.price>0 AND t5.id_filter='20' AND t8.id_filter='23'$season GROUP BY t4.id ORDER BY t4.id ASC LIMIT $start, $num";
  }
	//fwrite($fp, iconv("UTF-8", "WINDOWS-1251", $xml));
	fclose($fp);
	$page++;
	echo $page;
?>