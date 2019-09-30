<?
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/apiFunc.inc.php');
	
	$client = new SoapClient(SOAP_CLIENT);
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
			$result = array_merge($result, $arrProduct);

	$xml='';
	foreach($result as $iProd){
			$name = str_replace("&", "&amp;", $iProd["name"]);
			$model = str_replace("&", "&amp;", $iProd["model"]);
			$marka = str_replace('&', '&amp;', $iProd["marka"]);
			if($iProd["diameter"] == '18' OR $iProd["diameter"] == '19' OR $iProd["diameter"] == '20' OR $iProd["diameter"] == '21'){
				$proc = $iProd["price"]/100*5;
				$proc = round($proc);
				$oldprice = '<oldprice>'.($iProd["price"]+$proc).'</oldprice>';
			}else{
				$oldprice = '';
			}
			

			$code = str_replace('.', '', $iProd["code"]);//удалить

			$xml.='<offer id="'.$code.'" available="true">
						<url>http://dobrayashina.ru/tyres/'.$iProd["code"].'.html</url>
						<price>'.$iProd["price"].'</price>
						<currencyId>RUR</currencyId>
						<categoryId>1</categoryId>
						<picture>'.$iProd["img"].'</picture>
						<store>false</store>
						<pickup>true</pickup> 
						<delivery>true</delivery>
						<name>'.$name.'</name>
						<vendor>'.$marka.'</vendor>
						<model>'.$model.'</model>
						<description>'.$name.'</description>
						<vendorCode>'.$iProd["code"].'</vendorCode>
						<sales_notes>При заказе менее 4 штук необходима предоплата</sales_notes>
						'.$oldprice.'
						<age>0</age>
						<manufacturer_warranty>true</manufacturer_warranty>
					</offer>'; 
	}
	$fp=fopen($_SERVER['DOCUMENT_ROOT']."/price.xml","a");  
	fwrite($fp, iconv("UTF-8", "WINDOWS-1251", $xml));
	fclose($fp);
	$page++;
	echo $page;
?>