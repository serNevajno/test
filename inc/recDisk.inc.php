<?php
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
	
	if($_POST["marka"] == "Марка"){
		$marka = "";
	}else{
		$marka = clearData($_POST['marka']);
	}
				
	if($_POST["model"] == "Модел"){
		$model = "";
	}else{
		$model = clearData($_POST['model']);
	}
	
	if($_POST["modification"] == "Модификация"){
		$modification = "";
	}else{	
		$modification = clearData($_POST['modification']);
	}
	if($_POST["year"] == "Год"){
		$year_beg = "";
	}else{
		$rYear = explode('-', clearData($_POST['year']));
		$year_beg = $rYear[0];
	}
	if(!empty($marka) AND !empty($model) AND !empty($year_beg) AND !empty($modification)){
	
		function selectRecommendedTyres($marka, $model, $year_beg, $modification){
			return  db2array("SELECT t1.front_width, t1.front_et, t1.front_diameter, t3.description, t2.pcd, t2.dia, t2.lz FROM tx_wheelspecifications as t1 LEFT JOIN tx_carmodels as t2 on(t2.id=t1.carmodel) LEFT JOIN tx_specificationtype as t3 on (t1.spectype=t3.spec_type) WHERE t2.vendor='$marka' and t2.model='$model' and t2.year='$year_beg' and t2.modification='$modification'",2);
		}
		
		$sRT = selectRecommendedTyres($marka, $model, $year_beg, $modification);
		$res = array();
		$res["content"]='<div class="col-md-12" style="color:#FFF;text-align:center;">
							
								<h5><i class="fa fa-info" style="color:#FFF;"></i> Выберите размерность</h5>
							
						</div><div class="col-md-6"><h5 style="color:#fff"> Штатные </h5><ul>';
			if($sRT){
				$n = 1;
				foreach($sRT as $item){
					$rDiameter = explode('.', $item['front_diameter']);
					$rEt = explode('.', $item['front_et']);
					if($item['description'] == 'заводской'){
                        $diametrId = selectFilterElementByValue($rDiameter[0], '25');
                        $widthId = selectFilterElementByValue((float)$item["front_width"], '26');
                        $pcdId = selectFilterElementByValue($item["lz"]."x".(float)$item["pcd"], '27');
						if($n == '1'){
							$res["width"]=$item["front_width"];
							$res["pcd"]=$item["lz"]."x".(float)$item["pcd"];
							$res["diametr"]=$rDiameter[0];
							$res["et"]=$rEt[0]." - ".$rEt[0];
							$res["dia"]=(float)$item["dia"]." - ".(float)$item["dia"];
                            $res["widthId"] = $widthId;
                            $res["diametrId"] = $diametrId;
                            $res["pcdId"] = $pcdId;
							$checked = 'checked=""';
						}else{
							$checked = "";
						}
						$func = "checkSizeDisk('".(float)$item["front_width"]."', '".$rDiameter[0]."', '".$item["lz"]."x".(float)$item["pcd"]."', '".$rEt[0]." - ".$rEt[0]."', '".(float)$item["dia"]." - ".(float)$item["dia"]."', '".$widthId."', '".$diametrId."', '".$pcdId."')";
						$res["content"].= '
								<li style="display: inline;margin-right: 10px;">
									<label style="color:#fff;cursor:pointer;">
										<input type="radio" name="radioTyres" onClick="'.$func.'" '.$checked.'>
									'.(float)$item["front_width"].'x'.$rDiameter[0].'/'.$item["lz"].'x'.(float)$item["pcd"].' ET: '.$rEt[0].' D:'.(float)$item["dia"].'
									</label>
								</li>
								';
						$n++;
					}
				}
			}else{
				$res["content"].= '<span style="color:#fff;"><i class="fa fa-caret-right"></i> Не найдено</span>';
			}
		$res["content"].='</div><div class="col-md-6"><h5 style="color:#fff"> Нештатные </h5><ul>';
			if($sRT){
				foreach($sRT as $item){
					$rDiameter = explode('.', $item['front_diameter']);
					$rEt = explode('.', $item['front_et']);
					if($item['description'] == 'замена'){
                        $diametrId = selectFilterElementByValue($rDiameter[0], '25');
                        $widthId = selectFilterElementByValue((float)$item["front_width"], '26');
                        $pcdId = selectFilterElementByValue($item["lz"]."x".(float)$item["pcd"], '27');
					$func = "checkSizeDisk('".(float)$item["front_width"]."', '".$rDiameter[0]."', '".$item["lz"]."x".(float)$item["pcd"]."', '".$rEt[0]." - ".$rEt[0]."', '".(float)$item["dia"]." - ".(float)$item["dia"]."', '".$widthId."', '".$diametrId."', '".$pcdId."')";
						$res["content"].= '
								<li style="display: inline;margin-right: 10px;">
									<label style="color:#fff;cursor:pointer;">
										<input type="radio" name="radioTyres" onClick="'.$func.'">
									'.(float)$item["front_width"].'x'.$rDiameter[0].'/'.$item["lz"].'x'.(float)$item["pcd"].' ET: '.$rEt[0].' D:'.(float)$item["dia"].'
									</label>
								</li>
								';
					}
				}
			}else{
				$res["content"].= '<span style="color:#fff;"><i class="fa fa-caret-right"></i> Не найдено</span>';
			}
		$res["content"].='</ul></div>';
	}else{
		$res["error"]= '<div class="col-md-12" style="margin-bottom:50px;">
							<div class="bs-callout bs-callout-warning">
								<h4><i class="fa fa-info"></i> Выберете марку, модель, год и модификацию.</h4>
							</div>
						</div>';
	}
	echo json_encode($res);
?>