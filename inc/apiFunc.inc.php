<?
	define("SOAP_CLIENT", "http://api-b2b.pwrs.ru/WCF/ClientService.svc?wsdl");
	define("SOAP_LOGIN", "sa12340");
	define("SOAP_PASS", "ISglCuv71Y");
	
	function array_sort($array, $on, $order=SORT_ASC){
    $new_array = array();
    $sortable_array = array();
		
    if (count($array) > 0) {
			foreach ($array as $k => $v) {
				if (is_array($v)) {
					foreach ($v as $k2 => $v2) {
						if ($k2 == $on) {
							$sortable_array[$k] = $v2;
						}
					}
					} else {
					$sortable_array[$k] = $v;
				}
			}
			
			switch ($order) {
				case SORT_ASC:
				asort($sortable_array);
				break;
				case SORT_DESC:
				arsort($sortable_array);
				break;
			}
			
			foreach ($sortable_array as $k => $v) {
				$new_array[$k] = $array[$k];
			}
		}
		
    return $new_array;
	}
	
	function selectLogistDays($aLogistic, $wrh){
		foreach($aLogistic as $iLogist){
			if($iLogist->whId == $wrh){
				$dayMin = $iLogist->logistDays; 
			}
		}
		return $dayMin;
	}
	
	function getPrice($wh_price_rest, $WarehouseLogistic, $type, $brand, $diameter, $season=""){
		if(count($wh_price_rest) > 1){
			$dayMin=777;
			foreach($wh_price_rest as $iPrice){
				if($iPrice->rest>=4){
					$day = selectLogistDays($WarehouseLogistic, $iPrice->wrh);
					if($dayMin>$day){
						$arr = array(
						"dayMin" => $day,
						"price" => $iPrice->price,
						"price_clear" => "",
						"rest" => $iPrice->rest,
						"kol" => "",
						"count" => ""
						);
					}
					$dayMin = $day;
				}
			}
			if(empty($arr["price"])){
				foreach($wh_price_rest as $iPrice){
					$day = selectLogistDays($WarehouseLogistic, $iPrice->wrh);
					if($dayMin>$day AND $iPrice->rest>0){
						$arr = array(
						"dayMin" => $day,
						"price" => $iPrice->price,
						"price_clear" => "",
						"rest" => $iPrice->rest,
						"kol" => "",
						"count" => ""
						);
					}
					$dayMin = $day;
				}	
			}
		}else{
			$arr = array(
			"dayMin" => selectLogistDays($WarehouseLogistic, $wh_price_rest->wrh),
			"price" => $wh_price_rest->price,
			"price_clear" => "",
			"rest" => $wh_price_rest->rest,
			"kol" => "",
			"count" => ""
			);
		}
		
		$arr["price_clear"] = $arr["price"];
		
		if($arr["rest"]>12){
			$arr["kol"] = $arr["rest"];
			$arr["rest"] = "Много";
			$arr["count"] = 4;
		}elseif($arr["rest"]>4){
			$arr["kol"] = $arr["rest"];
			$arr["count"] = 4;
		}else{
			$arr["kol"] = $arr["rest"];
			$arr["count"] = $arr["rest"];
		}

		$arr["price"] = getPriceProvide($type, $brand, $diameter, $season, $arr["price"], "1");
		
		if(date("G") > 14){
			$arr["dayMin"] = $arr["dayMin"] +1;
		}
		
		return $arr;
	}
	
	function arrProduct($TyrePriceRest, $WarehouseLogistic){
		$arrProduct = array();
		foreach($TyrePriceRest as $item){
			if($item->season == "w"){
				$season = "Зимняя шина ";
				$season_icon = '<li><i class="fa fa-snowflake-o" style="color:#489fdf;"></i> Зимние</li>';
                $seasonId = 156;
			}elseif($item->season == "s"){
				$season = "Летняя шина ";
				$season_icon = '<li><i class="fa fa-sun-o" style="color:#f0ad4e;"></i> Летние</li>';
                $seasonId = 155;
			}elseif($item->season == "u"){
				$season = "Всесезонная шина";
				$season_icon = '<li><i class="fa fa-sun-o" style="color:#f0ad4e;"></i> <i class="fa fa-snowflake-o" style="color:#489fdf;"></i> Всесезонные</li>';
                $seasonId = 157;
			}
			if($item->thorn == "1"){
				$thorn = '<li><i class="fa fa-dot-circle-o"></i> Шипованные</li>';
                $thornId = 158;
            }else{
                $thornId = 159;
				if($item->season == "w"){
					$thorn = '<li><i class="fa fa-circle-o"></i> Нешипованные</li>';
				}else{
					$thorn = '';
				}
			}
			$d = explode(" ", $item->name);
			$diameter = explode("R", $d[0]);

            $wah = explode("/", $diameter[0]);

			$arrRrice = getPrice($item->whpr->wh_price_rest, $WarehouseLogistic, "1", $item->marka, $diameter[1], $item->season);

			if($arrRrice["dayMin"] == '1'){
               $dayMin = '2';
            }elseif($arrRrice["dayMin"] == '5'){
                $dayMin = '6';
            }else{
                $dayMin = $arrRrice["dayMin"];
            }


			$arrProduct[]= array(
			"img" => $item->img_small,
            "img_big" => $item->img_big_pish,
			"name" => $season.$item->marka." ".$item->name,
			"marka" => $item->marka,
			"model" => $item->model,
			"rest" => $arrRrice["rest"],
			"count" => $arrRrice["count"],
			"price" => $arrRrice["price"],
            "price_clear" => $arrRrice["price_clear"],
			"season_icon" => $season_icon,
			"thorn" => $thorn,
			"code" => $item->code,
			"kol" => $arrRrice["kol"],
			"dayLog" => $dayMin,
			"diameter" => $diameter[1],
            "width" => $wah[0],
            "heigth" => $wah[1],
            "seasonId" => $seasonId,
            "thornId" => $thornId,
			);
		}
		//echo "<pre>";
		//print_r($arrProduct);
		//echo "</pre>";
		return $arrProduct = array_sort($arrProduct, 'price', SORT_ASC);
		
	}
	
	function templatesTyres($code, $count, $img, $name, $season_icon, $thorn, $rest, $kol, $price, $n, $day){
		$func = "addBasket('".$code."', 'tyres', '".$n."')";
		$date = date('d.m.Y', strtotime('+'.$day.' days'));
		return '<div class="product-item hover-img" style="text-align:left;">
	<div class="row">
		<div class="col-sm-12 col-md-2 col-lg-2" style="text-align:center;">
			<a href="/tyres/'.$code.'.html" class="product-img">
				<img src="'.$img.'" alt="image" style="max-width:120px">
			</a>
		</div>
		<div class="col-sm-12 col-md-5 col-lg-5">
			<div class="product-caption">
				<h4 class="product-name" style="padding-top:0px;margin-top:0px;">
					<a href="/tyres/'.$code.'.html" class="f-18">'.$name.'</a>
				</h4>
			</div>
			<ul class="static-caption m-t-lg-20">
				'.$season_icon.$thorn.'
			</ul>
		</div>
		
		<div class="col-sm-12 col-md-5 col-lg-5" style="padding:0px;">
		<div class="col-sm-12 col-md-4 col-lg-4" style="text-align: center;margin-top:2%;">
			<div class="form-group dop">
				<div>
					<b class="product-price">В наличии: '.$rest.'</b>
				</div>
				<i class="fa fa-plus mPlus" onClick="valPlus('.$n.', '.$kol.')"></i>
				<input id="valInput'.$n.'" type="text" value="'.$count.'" class="form-control form-item fInput">
				<i class="fa fa-minus mMinus" onClick="valMinus('.$n.', '.$kol.')"></i>
			</div>
		</div>
		<div class="col-sm-12 col-md-3 col-lg-3" style="padding: 1em 0; text-align: center;padding-left:15px;">
			<div style="font-weight: 500;">Цена 1шт: </div>
			<b class="product-price" style="font-size:18px;">'.$price.' руб</b>
		</div>
		<div class="col-sm-12 col-md-5 col-lg-5" style="text-align: center;">
			<div style="color:#cb1010;">цена за коммплект: </div>
			<b class="product-price color-red">'.($price*4).' руб</b>
			<div class="form-group">
				<a onClick="'.$func.'" class="ht-btn ht-btn-default" style="margin:0px; cursor:pointer;" data-toggle="modal" data-target="#addBasket">Купить</a>
			</div>
		</div>
		<div class="col-md-12" style="font-size:16px;margin-top:10px;color:##928f8f;font-weight: 400;text-align:center;"><i class="fa fa-truck"></i> Получение: самовывоз или доставка ('.$date.')</div>
		</div>
		
	</div>
</div>';		
		
	}
	function templatesDisk($code, $count, $img, $name, $rest, $kol, $price, $n, $day){
		$func = "addBasket('".$code."', 'disk', '".$n."')";
		$date = date('d.m.Y', strtotime('+'.$day.' days'));
		if($img){$rImg = '/scripts/phpThumb/phpThumb.php?src='.$img.'&fltr[]=wmi|/images/watermark.png|85x200|100|170|120|0';}else{$rImg = '//placehold.it/310x310?text=no image';}
		if($kol>=4){
			return $res.= '<div class="col-sm-6 col-md-4 col-lg-4">
			<!-- Product item -->
			<div class="product-item hover-img">
			<a href="/disk/'.$code.'.html" class="product-img">
			<img src="'.$rImg.'" alt="'.$name.'">
			</a>
			<div class="product-caption">
			<h4 class="product-name" style="height:64px;"><a href="/disk/'.$code.'.html">'.$name.'</a></h4>
			<div class="col-sm-6" style="padding-right: 10px;padding-left: 10px;">
			<div style="padding-top:25px;">В наличии: '.$rest.'</div>
			<i class="fa fa-plus" onClick="valPlus('.$n.', '.$kol.')" style="cursor: pointer;"></i>
			<input id="valInput'.$n.'" class="form-item form-qtl" style="margin-top: 5px;" value="'.$count.'" type="text">
			<i class="fa fa-minus" onClick="valMinus('.$n.', '.$kol.')" style="cursor: pointer;"></i>
			</div>
			<div class="col-sm-6">
			<div class="product-price-group">
			<span class="product-price">'.$price.'.00 руб.</span>
			</div>
			<a onClick="'.$func.'" class="ht-btn ht-btn-default" style="cursor:pointer;" data-toggle="modal" data-target="#addBasket">Купить</a>
			<div class="row" style="font-size:12px;margin-top:10px;"><i class="fa fa-truck"></i> Получение: самовывоз или доставка ('.$date.')</div>
			</div>
			</div>
			</div>
			</div>';
		}
	}
	function arrProductDisk($DiskPriceRest, $WarehouseLogistic){
		$arrProduct = array();
		
		foreach($DiskPriceRest as $item){
			$d = explode("/", $item->name);
			$diameter = explode("x", $d[0]);
            $width = str_replace(",", ".", $diameter[0]);
            $pcd = explode(" ", $d[1]);

            $et = str_replace("ET", "", $pcd[1]);
            $dia = str_replace("D", "", $pcd[2]);

            $pcd = str_replace(",", ".", $pcd[0]);
            $dia = str_replace(",", ".", $dia);

			$arrRrice = getPrice($item->whpr->wh_price_rest, $WarehouseLogistic, "2", $item->marka, $diameter[1]);
			
			//$img = (!empty($item->img_big_pish)) ? $item->img_big_pish : "http://placehold.it/310x310?text=no image"; 
			$img = $item->img_big_pish;
			
			$arrProduct[]= array(
			"img" => $img,
			"name" => $item->marka." ".$item->name,
			"marka" => $item->marka,
			"model" => $item->model,
			"rest" => $arrRrice["rest"],
			"count" => $arrRrice["count"],
			"price" => $arrRrice["price"],
            "price_clear" => $arrRrice["price_clear"],
			"kol" => $arrRrice["kol"],
			"code" => $item->code,
			"dayLog" => $arrRrice["dayMin"],
            "diameter" => $diameter[1],
            "width" => $width,
            "pcd" => $pcd,
            "et" => $et,
            "dia" => $dia,
			);
		}
		
		return $arrProduct = array_sort($arrProduct, 'price', SORT_ASC);
	}
	
	function fullProductTyresApi($code){
			$client = new SoapClient(SOAP_CLIENT);
			$params =  array
			(
				'login' => SOAP_LOGIN,
				'password' => SOAP_PASS,
				'filter' => array(
					'code_list' => array(
						0 => $code
					),
				),
				'page' => 0,
			);
			
			$answer = $client->GetFindTyre($params);
			$res = $answer->GetFindTyreResult->price_rest_list->TyrePriceRest;
			$WarehouseLogistic = $answer->GetFindTyreResult->warehouseLogistics->WarehouseLogistic;
			
			$arrProduct = array();
			if(count($res)== 1){
				$res = "";
				$res[] = $answer->GetFindTyreResult->price_rest_list->TyrePriceRest;
			}
			if($res){
				foreach($res as $item){
					if($item->code == $code){
						if($item->season == "w"){
							$season = "Зимняя шина ";
							$season_icon = '<li><i class="fa fa-snowflake-o" style="color:#489fdf;"></i> Зимние</li>'; 
						}elseif($item->season == "s"){
							$season = "Летняя шина ";
							$season_icon = '<li><i class="fa fa-sun-o" style="color:#f0ad4e;"></i> Летние</li>'; 
						}elseif($item->season == "u"){
							$season = "Всесезонная ";
							$season_icon = '<li><i class="fa fa-sun-o" style="color:#f0ad4e;"></i> <i class="fa fa-snowflake-o" style="color:#489fdf;"></i> Всесезонные</li>'; 
						}
						if($item->thorn == "1"){
							$thorn = '<li><i class="fa fa-dot-circle-o"></i> Шипованные</li>';
						}else{
							if($item->season == "w"){
								$thorn = '<li><i class="fa fa-circle-o"></i> Нешипованные</li>';
							}else{
								$thorn = '';
							}
						}
						$d = explode(" ", $item->name);
						$diameter = explode("R", $d[0]);
						
						$arrRrice = getPrice($item->whpr->wh_price_rest, $WarehouseLogistic, "1", $item->marka, $diameter[1], $item->season);
						
						$arrProduct[]= array(
						"img" => $item->img_big_pish,
						"img_small" => $item->img_small,
						"name" => $season.$item->marka." ".$item->name,
						"marka" => $item->marka,
						"model" => $item->model,
						"rest" => $arrRrice["rest"],
						"count" => $arrRrice["count"],
						"size" => $d[0],
						"price" => $arrRrice["price"],
						"price_clear" => $arrRrice["price_clear"],
						"season_icon" => $season_icon,
						"season" => $item->season,
						"thorn" => $thorn,
						"code" => $item->code,
						"kol" => $arrRrice["kol"],
						"dayLog" => $arrRrice["dayMin"],
						);
					}
				}
			}
		return $arrProduct[0];
	}
	
	function fullProductDiskApi($code){
			$client = new SoapClient(SOAP_CLIENT);
			$params =  array
			(
				'login' => SOAP_LOGIN,
				'password' => SOAP_PASS,
				'filter' => array(
					'code_list' => array(
						0 => $code
					),
				),
				'page' => 0,
			);
			
			$answer = $client->GetFindDisk($params);
			
			$res = $answer->GetFindDiskResult->price_rest_list->DiskPriceRest;
			$WarehouseLogistic = $answer->GetFindDiskResult->warehouseLogistics->WarehouseLogistic;
			
			$arrProduct = array();
			if(count($res)== 1){
				$res = "";
				$res[] = $answer->GetFindDiskResult->price_rest_list->DiskPriceRest;
			}
			foreach($res as $item){
				if($item->code == $code){
					$d = explode("/", $item->name);
					$diameter = explode("x", $d[0]);
					
					$size = explode(" ", $item->name);

					$arrRrice = getPrice($item->whpr->wh_price_rest, $WarehouseLogistic, "2", $item->marka, $diameter[1], $item->season);
					
					$arrProduct[]= array(
					"img" => $item->img_big_pish,
					"img_small" => $item->img_small,
					"name" => $season.$item->marka." ".$item->name,
					"marka" => $item->marka,
					"model" => $item->model,
					"rest" => $arrRrice["rest"],
					"count" => $arrRrice["count"],
					"size" => $size[0],
					"color" => $item->color,
					"price" => $arrRrice["price"],
					"price_clear" => $arrRrice["price_clear"],
					"code" => $item->code,
					"kol" => $arrRrice["kol"],
					"dayLog" => $arrRrice["dayMin"],
					);
				}
			}
		return $arrProduct[0];
	}
?>