 <?php
 if($_SERVER["REQUEST_METHOD"]=="POST"){
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/apiFunc.inc.php');
	if($_POST["marka"] == "Марка"){
		$marka = "";
	}else{
		$marka = $_POST["marka"];
	}
				
	if($_POST["model"] == "Модел"){
		$model = "";
	}else{
		$model = $_POST["model"];
	}
				
	if($_POST["year"] == "Год"){
		$year = "";
	}else{
		$year = explode("-", $_POST["year"]);
		if(count($year)>1){
			$year_beg = $year[0];
			$year_end = $year[1];
		}else{
			$year_beg = "0";
			$year_end = $year[0];
		}
	}
				
	if($_POST["modification"] == "Модификация"){
		$modification = "";
	}else{
		$modification = $_POST["modification"];
	}
	
	if(!empty($marka) AND !empty($model) AND !empty($year) AND !empty($modification)){
			
					$client = new SoapClient(SOAP_CLIENT);
					try {
						$params =  array
							(
									'login' => SOAP_LOGIN,
									'password' => SOAP_PASS,
									'filter' => array(
											'marka' => $marka,
											'model' => $model,
											'modification' => $modification,
											'year_beg' => $year_beg,
											'year_end' => $year_end,
											'podbor_type' => array(0 => 1),
											'type' => array(0 => 'disk'),
									),        
							);
						$answer = $client->GetGoodsByCar($params);        
					} catch (Exception $exc) { 
						$error = 'Ошибка. Товар либо сервис недоступны.';
					}
					//echo "<pre>";
					//print_r($answer);
					//echo "</pre>";
					
					$res = '<div class="clearfix"></div><div class="row">';
					if(!empty($answer->GetGoodsByCarResult->price_rest_list->goods_price_rest)){
						if(count($answer->GetGoodsByCarResult->price_rest_list->goods_price_rest)== 1){
							$pr[] = $answer->GetGoodsByCarResult->price_rest_list->goods_price_rest;
							$arrProduct = arrProductDisk($pr, $answer->GetGoodsByCarResult->warehouseLogistics->WarehouseLogistic);
						}else{
							$arrProduct = arrProductDisk($answer->GetGoodsByCarResult->price_rest_list->goods_price_rest, $answer->GetGoodsByCarResult->warehouseLogistics->WarehouseLogistic);
						}
						
						foreach($arrProduct as $IProd){
							$res.= templatesDisk($IProd["code"], $IProd["count"], $IProd["img"], $IProd["name"], $IProd["rest"], $IProd["kol"], $IProd["price"], $n, $IProd["dayLog"]);
							$n++;
						}
					}else{
						$res.='<div class="col-md-12" style="margin-bottom:50px;">
							<div class="bs-callout bs-callout-warning">
								<h4><i class="fa fa-info"></i> ';
								if($error){
									$res.= $error;
								}else{
									$res.= 'По Вашему запросу ничего не найдено.';
								}
								$res.='</h4>
							</div>
						</div>';
					}
					$res.='</div>';
					if($answer->GetGoodsByCarResult->totalPages>1){
						$p = $_POST["page"]+1;
						$res.='<nav aria-label="Page navigation"><ul class="pagination ht-pagination">';
						if($p>1){
							$res.='<li><a aria-label="Previous" onClick="searchDiskByAvto('.($p-1).')"><span aria-hidden="true"><i class="fa fa-chevron-left"></i></span></a></li>';
						}
						for ($i = 1; $i <= $answer->GetGoodsByCarResult->totalPages; $i++) {
							if($i == $p){
								$res.='<li class="active"><a onClick="searchDiskByAvto('.$i.')">'.$i.'</a></li>';
							}else{
								$res.='<li><a onClick="searchDiskByAvto('.$i.')">'.$i.'</a></li>';
							}
						}
						if($p != $answer->GetGoodsByCarResult->totalPages){
							$res.='<li><a onClick="searchDiskByAvto('.($p+1).')" aria-label="Next"><span aria-hidden="true"><i class="fa fa-chevron-right"></i></span></a></li>';
						}
						$res.='</ul></nav>';
					}
				}else{
					$res = '<div class="col-md-12" style="margin-bottom:50px;">
							<div class="bs-callout bs-callout-warning">
								<h4><i class="fa fa-info"></i> Выберете марку, модель, год и модификацию.</h4>
							</div>
						</div>';
				}
        echo $res;
}
?>