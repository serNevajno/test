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
										),
										'page' => $page,
								);
			
						$answer = $client->GetFindDisk($params);
	
		
			$arrProduct= arrProduct($answer->GetFindDiskResult->price_rest_list->DiskPriceRest, $answer->GetFindDiskResult->warehouseLogistics->WarehouseLogistic);
			$result = array_merge($result, $arrProduct);

	$xml='';
	foreach($result as $iProd){
		if($iProd["kol"]>=4){
			$name = str_replace("&", "&amp;", $iProd["name"]);
			$model = str_replace("&", "&amp;", $iProd["model"]);
			$marka = str_replace('&', '&amp;', $iProd["marka"]);
			$xml.='
          <part>
			      <id>'.$iProd["code"].'</id>
			      <title>'.$name.'</title>
			      <catalogue_numbers>
               <catalogue_number>'.$iProd["code"].'</catalogue_number>
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
	$fp=fopen($_SERVER['DOCUMENT_ROOT']."/priceAUTORU.xml","a");
	fwrite($fp, $xml);
	fclose($fp);
	$page++;
	echo $page;
?>