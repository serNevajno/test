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
			return  db2array("SELECT t1.front_width, t1.front_profile, t1.front_diameter, t3.description FROM tx_tyrespecifications as t1 LEFT JOIN tx_carmodels as t2 on(t2.id=t1.carmodel) LEFT JOIN tx_specificationtype as t3 on (t1.spectype=t3.spec_type) WHERE t2.vendor='$marka' and t2.model='$model' and t2.year='$year_beg' and t2.modification='$modification'",2);
		}
		
	//	echo "SELECT t1.front_width, t1.front_profile, t1.front_diameter, t3.description FROM tx_tyrespecifications as t1 LEFT JOIN tx_carmodels as t2 on(t2.id=t1.carmodel) LEFT JOIN tx_specificationtype as t3 on (t1.spectype=t3.spec_type) WHERE t2.vendor='$marka' and t2.model='$model' and t2.year='$year_beg'";

		/* echo "<pre>";
		print_r(selectRecommendedTyres($marka, $model, $year_beg));
		echo "</pre>"; */
		$sRT = selectRecommendedTyres($marka, $model, $year_beg, $modification);
		$res = array();
		$res["content"]='<div class="col-md-12" style="color:#FFF;text-align:center;">
							
								<h5><i class="fa fa-info" style="color:#FFF;"></i> Выберите размерность</h5>
							
						</div><div class="col-md-6"><h5 style="color:#fff"> Штатные </h5><ul>';
			if($sRT){
				$n = 1;
				foreach($sRT as $item){
					if($item['description'] == 'заводской'){
                        $widthId = selectFilterElementByValue($item["front_width"], '19');
                        $heigthId = selectFilterElementByValue($item["front_profile"], '21');
                        $diametrId = selectFilterElementByValue($item["front_diameter"], '20');

						if($n == '1'){
							$res["width"]=$item["front_width"];
							$res["profile"]=$item["front_profile"];
							$res["diameter"]=$item["front_diameter"];
                            $res["widthId"] = $widthId;
                            $res["heigthId"] = $heigthId;
                            $res["diametrId"] = $diametrId;
							$checked = 'checked=""';
						}else{
							$checked = "";
						}

						$res["content"].= '
								<li style="display: inline;margin-right: 10px;">
									<label style="color:#fff;cursor:pointer;">
										<input type="radio" name="radioTyres" onClick="checkSizeTyres('.$item["front_width"].', '.$item["front_profile"].', '.$item["front_diameter"].' ,'.$widthId.', '.$heigthId.', '.$diametrId.')" '.$checked.'>
									'.$item["front_width"].'/'.$item["front_profile"].' R'.$item["front_diameter"].'
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
					if($item['description'] == 'замена'){
                        $widthId = selectFilterElementByValue($item["front_width"], '19');
                        $heigthId = selectFilterElementByValue($item["front_profile"], '21');
                        $diametrId = selectFilterElementByValue($item["front_diameter"], '20');
							$res["content"].= '
								<li style="display: inline;margin-right: 10px;">
									<label style="color:#fff;cursor:pointer;">
										<input type="radio" name="radioTyres" onClick="checkSizeTyres('.$item["front_width"].', '.$item["front_profile"].', '.$item["front_diameter"].' ,'.$widthId.', '.$heigthId.', '.$diametrId.')">
									'.$item["front_width"].'/'.$item["front_profile"].' R'.$item["front_diameter"].'
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