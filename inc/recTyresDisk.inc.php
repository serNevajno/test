<?php
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');

$res = array();

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

/*$marka = 'VAZ';
$model = '2110';
$year_beg = '1999';
$modification = '1.5i';*/
if(!empty($marka) AND !empty($model) AND !empty($year_beg) AND !empty($modification)){
  function selectRecommendedTyres($marka, $model, $year_beg, $modification){
    return  db2array("SELECT t1.front_width, t1.front_profile, t1.front_diameter, t3.description FROM tx_tyrespecifications as t1 LEFT JOIN tx_carmodels as t2 on(t2.id=t1.carmodel) LEFT JOIN tx_specificationtype as t3 on (t1.spectype=t3.spec_type) WHERE t2.vendor='$marka' and t2.model='$model' and t2.year='$year_beg' and t2.modification='$modification'",2);
  }

  function selectRecommendedDisk($marka, $model, $year_beg, $modification){
    return  db2array("SELECT t1.front_width, t1.front_et, t1.front_diameter, t3.description, t2.pcd, t2.dia, t2.lz FROM tx_wheelspecifications as t1 LEFT JOIN tx_carmodels as t2 on(t2.id=t1.carmodel) LEFT JOIN tx_specificationtype as t3 on (t1.spectype=t3.spec_type) WHERE t2.vendor='$marka' and t2.model='$model' and t2.year='$year_beg' and t2.modification='$modification'",2);
  }

  //$res['sql'] = "SELECT t1.front_width, t1.front_profile, t1.front_diameter, t3.description FROM tx_tyrespecifications as t1 LEFT JOIN tx_carmodels as t2 on(t2.id=t1.carmodel) LEFT JOIN tx_specificationtype as t3 on (t1.spectype=t3.spec_type) WHERE t2.vendor='$marka' and t2.model='$model' and t2.year='$year_beg' and t2.modification='$modification'";

  $sRT = selectRecommendedTyres($marka, $model, $year_beg, $modification);

  //echo "<pre>".print_r($sRT, true)."</pre>";

  $res['cont'] .= '
    <div class="col-md-6">
        <h6 style="color: #fff;padding: 0px;">Шины</h6>
  ';
  if($sRT) {
    $n = 1;
    $res["cont"].='<div class="row" style="margin: 5px 0;"><span style="color: #fff;font-size: 14px;">Штатные</span><ul>';
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
        }else{ }

        if($_POST["cat"] == "tyres"){
            $url = 'onClick="checkSizeTyres('.$item["front_width"].', '.$item["front_profile"].', '.$item["front_diameter"].' ,'.$widthId.', '.$heigthId.', '.$diametrId.')"';
        }else{
            $url = 'href="/tyres/?width='.$item["front_width"].'&height='.$item["front_profile"].'&diametr='.$item["front_diameter"].'&brand=&season_s=&season_w=&season_u=&thorn_w=&thorn_n=&marka='.$_POST["marka"].'&model='.$_POST["model"].'&year='.$_POST["year"].'&modification='.$_POST["modification"].'"';
        }

        $res["cont"].= '<li name="radioTyres" style="float: left; margin-right: 10px;cursor: pointer;"><a '.$url.' style="font-size: 12px; color:#fff;">'.$item["front_width"].'/'.$item["front_profile"].' R'.$item["front_diameter"].'</a></li>';
        $n++;
      }

    }
    $res["cont"].='</ul></div>';
  }else{
    $res["cont"].= '<span style="color:#fff;"> Не найдено </span>';
  }

  if($sRT) {
    $n = 1;
    $res["cont"].='<div class="row" style="margin: 15px 0 5px 0;"><span style="color: #fff;font-size: 14px;">Нештатные</span><ul>';
    foreach($sRT as $item){
      if($item['description'] == 'замена'){
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
        }else{ }

          if($_POST["cat"] == "tyres"){
              $url = 'onClick="checkSizeTyres('.$item["front_width"].', '.$item["front_profile"].', '.$item["front_diameter"].' ,'.$widthId.', '.$heigthId.', '.$diametrId.')"';
          }else{
              $url = 'href="/tyres/?width='.$item["front_width"].'&height='.$item["front_profile"].'&diametr='.$item["front_diameter"].'&brand=&season_s=&season_w=&season_u=&thorn_w=&thorn_n=&marka='.$_POST["marka"].'&model='.$_POST["model"].'&year='.$_POST["year"].'&modification='.$_POST["modification"].'"';
          }

        $res["cont"].= '<li name="radioTyres" style="float: left; margin-right: 10px;"><a '.$url.' style="font-size: 12px; color:#fff; cursor: pointer;">'.$item["front_width"].'/'.$item["front_profile"].' R'.$item["front_diameter"].'</a></li>';
        $n++;
      }

    }
    $res["cont"].='</ul></div>';
  }else{
    $res["cont"].= '<span style="color:#fff;"> Не найдено </span>';
  }
  $res['cont'] .= '
    </div>
  ';


  $sRD = selectRecommendedDisk($marka, $model, $year_beg, $modification);

  $res['cont'] .= '
    <div class="col-md-6">
        <h6 style="color: #fff;padding: 0px;">Диски</h6>
  ';

  if($sRD) {
    $n = 1;
    $res["cont"].='<div class="row" style="margin: 5px 0;"><span style="color: #fff;font-size: 14px;">Штатные</span><ul>';
    foreach($sRD as $item){
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
        }else{ }

          if($_POST["cat"] == "disk"){
              $funcUrl = "checkSizeDisk('".(float)$item["front_width"]."', '".$rDiameter[0]."', '".$item[lz]."x".(float)$item[pcd]."', '".$rEt[0]." - ".$rEt[0]."', '".(float)$item[dia]." - ".(float)$item[dia]."', '".$widthId."', '".$diametrId."', '".$pcdId."')";
              $url = 'onClick="'.$funcUrl.'"';
          }else{
              $url = 'href="/disk/?width='.(float)$item["front_width"].'&diametr=R'.$rDiameter[0].'&pcd='.$item["lz"]."x".(float)$item["pcd"].'&et='.$rEt[0]." - ".$rEt[0].'&dia='.(float)$item[dia]." - ".(float)$item[dia].'&brand=&marka='.$_POST["marka"].'&model='.$_POST["model"].'&year='.$_POST["year"].'&modification='.$_POST["modification"].'"';
          }

        $res["cont"].= '<li name="radioTyres" style="float: left; margin-right: 10px;"><a '.$url.' style="font-size: 12px; color:#fff; cursor: pointer;">'.(float)$item["front_width"].'x'.$rDiameter[0].'/'.$item["lz"].'x'.(float)$item["pcd"].' ET: '.$rEt[0].' D:'.(float)$item["dia"].'</a></li>';
        $n++;
      }

    }
    $res["cont"].='</ul></div>';
  }else{
    $res["cont"].= '<span style="color:#fff;"> Не найдено </span>';
  }

  if($sRD) {
    $n = 1;
    $res["cont"].='<div class="row" style="margin: 15px 0 5px 0;"><span style="color: #fff;font-size: 14px;">Нештатные</span><ul>';
    foreach($sRD as $item){
      $rDiameter = explode('.', $item['front_diameter']);
      $rEt = explode('.', $item['front_et']);
      if($item['description'] == 'замена'){
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
        }else{ }

          if($_POST["cat"] == "disk"){
              $funcUrl = "checkSizeDisk('".(float)$item["front_width"]."', '".$rDiameter[0]."', '".$item[lz]."x".(float)$item[pcd]."', '".$rEt[0]." - ".$rEt[0]."', '".(float)$item[dia]." - ".(float)$item[dia]."', '".$widthId."', '".$diametrId."', '".$pcdId."')";
              $url = 'onClick="'.$funcUrl.'"';
          }else{
              $url = 'href="/disk/?width='.(float)$item["front_width"].'&diametr=R'.$rDiameter[0].'&pcd='.$item["lz"]."x".(float)$item["pcd"].'&et='.$rEt[0]." - ".$rEt[0].'&dia='.(float)$item[dia]." - ".(float)$item[dia].'&brand=&marka='.$_POST["marka"].'&model='.$_POST["model"].'&year='.$_POST["year"].'&modification='.$_POST["modification"].'"';
          }

        $res["cont"].= '<li name="radioTyres" style="float: left; margin-right: 10px;"><a '.$url.' style="font-size: 12px; color:#fff; cursor: pointer;">'.(float)$item["front_width"].'x'.$rDiameter[0].'/'.$item["lz"].'x'.(float)$item["pcd"].' ET: '.$rEt[0].' D:'.(float)$item["dia"].'</a></li>';
        $n++;
      }

    }
    $res["cont"].='</ul></div>';
  }else{
    $res["cont"].= '<span style="color:#fff;"> Не найдено </span>';
  }

  $res['cont'] .= '</div>';



  /*$res["content"]='<div class="col-md-12" style="color:#FFF;text-align:center;">
							
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
  $res["content"].='</ul></div>';*/
}else{
  $res["error"]= '<div class="col-md-12" style="margin-bottom:50px;">
							<div class="bs-callout bs-callout-warning">
								<h4><i class="fa fa-info"></i> Выберете марку, модель, год и модификацию.</h4>
							</div>
						</div>';
}
echo json_encode($res);
