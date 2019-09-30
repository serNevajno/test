<?php
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
function sGroupModification($marka, $model){
  $temp = db2array("SELECT year, modification FROM `search_by_vehicle` WHERE vendor='$marka' AND `car`='$model' GROUP BY `param_pcd`, `param_dia`, `tyres_factory`, `tyres_replace`, `wheels_factory`, `wheels_replace`", 2);
  if(count($temp) == "1"){
    return $temp[0];
  }
}
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
if($_POST["group"] == "1") {
  $my = sGroupModification($marka, $model);
  $modification = $my["modification"];
  $year_beg = $my["year"];
}else{
  if ($_POST["modification"] == "Модификация") {
    $modification = "";
  } else {
    $modification = clearData($_POST['modification']);
  }

  if ($_POST["year"] == "Год") {
    $year_beg = "";
  } else {
    $rYear = explode('-', clearData($_POST['year']));
    $year_beg = $rYear[0];
  }
}
/*$marka = 'VAZ';
$model = '2110';
$year_beg = '1999';
$modification = '1.5i';*/
if(!empty($marka) AND !empty($model) AND !empty($year_beg) AND !empty($modification)){
  function selectRecommendedTyres($marka, $model, $year_beg, $modification){
    $res = array();
    $temp = db2array("SELECT t1.tyres_factory, t1.tyres_replace FROM search_by_vehicle as t1 WHERE t1.vendor='$marka' and t1.car='$model' and t1.year='$year_beg' and t1.modification='$modification'");
    if($temp["tyres_factory"]) {
      $tyres_factory = explode("|", str_replace(" ", "", $temp["tyres_factory"]));
    }
    if($temp["tyres_replace"]) {
      $tyres_replace = explode("|", str_replace(" ", "", $temp["tyres_replace"]));
    }
    foreach ($tyres_factory as $iFactory){
      $different_axes = explode(",",  $iFactory);
      if(count($different_axes) == 2) {
        ///передняя ось
        $r = explode("/", $different_axes[0]);
        $p = explode("R", $r[1]);
        $res["factory"][] = array(
            "width" => $r[0],
            "heigth" => $p[0],
            "diameter" => $p[1],
            "axis" => 1
        );
        ///задняя ось
        $r = explode("/", $different_axes[1]);
        $p = explode("R", $r[1]);
        $res["factory"][] = array(
            "width" => $r[0],
            "heigth" => $p[0],
            "diameter" => $p[1],
            "axis" => 2
        );
      }else{
        $r = explode("/", $iFactory);
        $p = explode("R", $r[1]);
        $res["factory"][] = array(
            "width" => $r[0],
            "heigth" => $p[0],
            "diameter" => $p[1]
        );
      }
    }
    foreach ($tyres_replace as $iReplace){
      $different_axes = explode(",",  $iReplace);
      if(count($different_axes) == 2) {
        ///передняя ось
        $r = explode("/", $different_axes[0]);
        $p = explode("R", $r[1]);
        $res["replace"][] = array(
            "width" => $r[0],
            "heigth" => $p[0],
            "diameter" => $p[1],
            "axis" => 1
        );
        ///задняя ось
        $r = explode("/", $different_axes[1]);
        $p = explode("R", $r[1]);
        $res["replace"][] = array(
            "width" => $r[0],
            "heigth" => $p[0],
            "diameter" => $p[1],
            "axis" => 2
        );
      }else{
        $r = explode("/", $iReplace);
        $p = explode("R", $r[1]);
        $res["replace"][] = array(
            "width" => $r[0],
            "heigth" => $p[0],
            "diameter" => $p[1]
        );
      }
    }
    return $res;
  }

  function selectRecommendedDisk($marka, $model, $year_beg, $modification){
    $res = array();
    $temp = db2array("SELECT t1.wheels_factory, t1.wheels_replace, t1.param_pcd, t1.param_dia, t1.param_nut, t1.param_bolt FROM search_by_vehicle as t1 WHERE t1.vendor='$marka' and t1.car='$model' and t1.year='$year_beg' and t1.modification='$modification'");

    if($temp["wheels_factory"]) {
      $wheels_factory = explode("|", str_replace(" ", "", $temp["wheels_factory"]));
    }
    if($temp["wheels_replace"]) {
      $wheels_replace = explode("|", str_replace(" ", "", $temp["wheels_replace"]));
    }
    foreach ($wheels_factory as $iFactory){
      $different_axes = explode(",",  $iFactory);
      if(count($different_axes) == 2) {
        ///передняя ось
        $r = explode("x", $different_axes[0]);
        $p = explode("ET", $r[1]);
        $pcd = str_replace("*", "x", $temp['param_pcd']);
        $res["factory"][] = array(
            "width" => $r[0],
            "diameter" => $p[0],
            "et" => $p[1],
            "pcd" => $pcd,
            "dia" => $temp['param_dia'],
            "nut" => $temp['param_nut'],
            "bolt" => $temp['param_bolt'],
            "axis" => 1
        );
        ///задняя ось
        $r = explode("x", $different_axes[1]);
        $p = explode("ET", $r[1]);
        $pcd = str_replace("*", "x", $temp['param_pcd']);
        $res["factory"][] = array(
            "width" => $r[0],
            "diameter" => $p[0],
            "et" => $p[1],
            "pcd" => $pcd,
            "dia" => $temp['param_dia'],
            "nut" => $temp['param_nut'],
            "bolt" => $temp['param_bolt'],
            "axis" => 2
        );
      }else{
        $r = explode("x", $iFactory);
        $p = explode("ET", $r[1]);
        $pcd = str_replace("*", "x", $temp['param_pcd']);
        $res["factory"][] = array(
            "width" => $r[0],
            "diameter" => $p[0],
            "et" => $p[1],
            "pcd" => $pcd,
            "dia" => $temp['param_dia'],
            "nut" => $temp['param_nut'],
            "bolt" => $temp['param_bolt'],
        );
      }
    }

    foreach ($wheels_replace as $iReplace){
      $different_axes = explode(",",  $iReplace);
      if(count($different_axes) == 2) {
        ///передняя ось
        $r = explode("x", $different_axes[0]);
        $p = explode("ET", $r[1]);
        $pcd = str_replace("*", "x", $temp['param_pcd']);
        $res["replace"][] = array(
            "width" => $r[0],
            "diameter" => $p[0],
            "et" => $p[1],
            "pcd" => $pcd,
            "dia" => $temp['param_dia'],
            "nut" => $temp['param_nut'],
            "bolt" => $temp['param_bolt'],
            "axis" => 1
        );
        ///задняя ось
        $r = explode("x", $different_axes[1]);
        $p = explode("ET", $r[1]);
        $pcd = str_replace("*", "x", $temp['param_pcd']);
        $res["replace"][] = array(
            "width" => $r[0],
            "diameter" => $p[0],
            "et" => $p[1],
            "pcd" => $pcd,
            "dia" => $temp['param_dia'],
            "nut" => $temp['param_nut'],
            "bolt" => $temp['param_bolt'],
            "axis" => 2
        );
      }else{
        $r = explode("x", $iReplace);
        $p = explode("ET", $r[1]);
        $pcd = str_replace("*", "x", $temp['param_pcd']);
        $res["replace"][] = array(
            "width" => $r[0],
            "diameter" => $p[0],
            "et" => $p[1],
            "pcd" => $pcd,
            "dia" => $temp['param_dia'],
            "nut" => $temp['param_nut'],
            "bolt" => $temp['param_bolt'],
        );
      }
    }
    return $res;
  }

  $sRT = selectRecommendedTyres($marka, $model, $year_beg, $modification);
  $res['test'] = $sRT['factory'];
  //echo "<pre>".print_r($sRT, true)."</pre>";

  $res['cont'] .= '
    <div class="col-md-5">
        <h6 style="color: #fff;padding: 0px;">Шины</h6>
  ';
  if($sRT) {
    $n = 1;
    $res["cont"].='<div class="row" style="margin: 5px 0;"><span style="color: #fff;font-size: 14px;">Штатные</span><ul>';
    foreach($sRT['factory'] as $item){
        //$res['test'] = $item["width"];
        $widthId = selectFilterElementByValue($item["width"], '19');
        $heigthId = selectFilterElementByValue($item["heigth"], '21');
        $diametrId = selectFilterElementByValue($item["diameter"], '20');

        if($n == '1'){
          $res["width"]=$item["width"];
          $res["profile"]=$item["heigth"];
          $res["diameter"]=$item["diameter"];
          $res["widthId"] = $widthId;
          $res["heigthId"] = $heigthId;
          $res["diametrId"] = $diametrId;
        }else{ }

        if($_POST["cat"] == "tyres"){
          $url = 'onClick="checkSizeTyres('.$item["width"].', '.$item["heigth"].', '.$item["diameter"].' ,'.$widthId.', '.$heigthId.', '.$diametrId.')"';
        }else{
          $url = 'href="/tyres/?width='.$item["width"].'&height='.$item["heigth"].'&diametr='.$item["diameter"].'&brand=&season_s=&season_w=&season_u=&thorn_w=&thorn_n=&marka='.$_POST["marka"].'&model='.$_POST["model"].'&year='.$_POST["year"].'&modification='.$_POST["modification"].'"';
        }
        if($item["axis"] == '1'){
          $axis = '(передняя ось)';
        }elseif($item["axis"] == '2'){
          $axis = '(задняя ось)';
        }else{
          $axis ='';
        }
        $res["cont"].= '<li name="radioTyres" style="float: left; margin-right: 10px;cursor: pointer;"><a '.$url.' style="font-size: 12px; color:#fff;">'.$item["width"].'/'.$item["heigth"].' R'.$item["diameter"].$axis.'</a></li>';
        $n++;

    }
    $res["cont"].='</ul></div>';
  }else{
    //$res["cont"].= '<span style="color:#fff;"> Не найдено </span>';
  }

  if($sRT) {
    $n = 1;
    $res["cont"].='<div class="row" style="margin: 15px 0 5px 0;"><span style="color: #fff;font-size: 14px;">Нештатные</span><ul>';
    foreach($sRT['replace'] as $item){
        $widthId = selectFilterElementByValue($item["width"], '19');
        $heigthId = selectFilterElementByValue($item["heigth"], '21');
        $diametrId = selectFilterElementByValue($item["diameter"], '20');

        if($n == '1'){
          $res["width"]=$item["width"];
          $res["profile"]=$item["heigth"];
          $res["diameter"]=$item["diameter"];
          $res["widthId"] = $widthId;
          $res["heigthId"] = $heigthId;
          $res["diametrId"] = $diametrId;
        }else{ }

        if($_POST["cat"] == "tyres"){
          $url = 'onClick="checkSizeTyres('.$item["width"].', '.$item["heigth"].', '.$item["diameter"].' ,'.$widthId.', '.$heigthId.', '.$diametrId.')"';
        }else{
          $url = 'href="/tyres/?width='.$item["width"].'&height='.$item["heigth"].'&diametr='.$item["diameter"].'&brand=&season_s=&season_w=&season_u=&thorn_w=&thorn_n=&marka='.$_POST["marka"].'&model='.$_POST["model"].'&year='.$_POST["year"].'&modification='.$_POST["modification"].'"';
        }
        if($item["axis"] == '1'){
          $axis = '(передняя ось)';
        }elseif($item["axis"] == '2'){
          $axis = '(задняя ось)';
        }else{
          $axis ='';
        }
        $res["cont"].= '<li name="radioTyres" style="float: left; margin-right: 10px;"><a '.$url.' style="font-size: 12px; color:#fff; cursor: pointer;">'.$item["width"].'/'.$item["heigth"].' R'.$item["diameter"].$axis.'</a></li>';
        $n++;
    }
    $res["cont"].='</ul></div>';
  }else{
    //$res["cont"].= '<span style="color:#fff;"> Не найдено </span>';
  }
  $res['cont'] .= '
    </div>
  ';


  $sRD = selectRecommendedDisk($marka, $model, $year_beg, $modification);

  $res['cont'] .= '
    <div class="col-md-7">
        <h6 style="color: #fff;padding: 0px;">Диски</h6>
  ';

  if($sRD) {
    $n = 1;
    $res["cont"].='<div class="row" style="margin: 5px 0;"><span style="color: #fff;font-size: 14px;">Штатные</span><ul>';
    foreach($sRD['factory'] as $item){
        $rDiameter = explode('.', $item['diameter']);
        $diametrId = selectFilterElementByValue($rDiameter[0], '25');
        $widthId = selectFilterElementByValue($item["width"], '26');
        $pcdId = selectFilterElementByValue($item["pcd"], '27');

        if($n == '1'){
          $res["width"]=$item["width"];
          $res["pcd"]=$item["pcd"];
          $res["diametr"]=$rDiameter[0];
          $res["et"]=$item["et"];
          $res["dia"]=$item["dia"];
          $res["widthId"] = $widthId;
          $res["diametrId"] = $diametrId;
          $res["pcdId"] = $pcdId;
        }else{ }

        if($_POST["cat"] == "disk"){
          $funcUrl = "checkSizeDisk('".$item["width"]."', '".$rDiameter[0]."', '".$item[pcd]."', '".$item["et"]."', '".$item[dia]."', '".$widthId."', '".$diametrId."', '".$pcdId."')";
          $url = 'onClick="'.$funcUrl.'"';
        }else{
          $url = 'href="/disk/?width='.$item["width"].'&diametr=R'.$rDiameter[0].'&pcd='.$item["pcd"].'&et='.$item["et"].'&dia='.$item[dia].'&brand=&marka='.$_POST["marka"].'&model='.$_POST["model"].'&year='.$_POST["year"].'&modification='.$_POST["modification"].'"';
        }
        if($item["axis"] == '1'){
          $axis = '(передняя ось)';
        }elseif($item["axis"] == '2'){
          $axis = '(задняя ось)';
        }else{
          $axis ='';
        }
        $res["cont"].= '<li name="radioTyres" style="float: left; margin-right: 10px;"><a '.$url.' style="font-size: 12px; color:#fff; cursor: pointer;">'.$item["width"].'x'.$rDiameter[0].'/'.$item["pcd"].' ET: '.$item['et'].' D:'.$item["dia"].$axis.'</a></li>';
        $n++;
    }
    $res["cont"].='</ul></div>';
  }else{
    //$res["cont"].= '<span style="color:#fff;"> Не найдено </span>';
  }

  if($sRD['replace']) {
    $n = 1;
    $res["cont"].='<div class="row" style="margin: 15px 0 5px 0;"><span style="color: #fff;font-size: 14px;">Нештатные</span><ul>';
    foreach($sRD['replace'] as $item){
        $rDiameter = explode('.', $item['diameter']);
        $diametrId = selectFilterElementByValue($rDiameter[0], '25');
        $widthId = selectFilterElementByValue($item["width"], '26');
        $pcdId = selectFilterElementByValue($item["pcd"], '27');

        if($n == '1'){
          $res["width"]=$item["width"];
          $res["pcd"]=$item["pcd"];
          $res["diametr"]=$rDiameter[0];
          $res["et"]=$item["et"];
          $res["dia"]=$item["dia"];
          $res["widthId"] = $widthId;
          $res["diametrId"] = $diametrId;
          $res["pcdId"] = $pcdId;
        }else{ }

        if($_POST["cat"] == "disk"){
          $funcUrl = "checkSizeDisk('".$item["width"]."', '".$rDiameter[0]."', '".$item[pcd]."', '".$item['et']."', '".$item[dia]."', '".$widthId."', '".$diametrId."', '".$pcdId."')";
          $url = 'onClick="'.$funcUrl.'"';
        }else{
          $url = 'href="/disk/?width='.$item["width"].'&diametr=R'.$rDiameter[0].'&pcd='.$item["pcd"].'&et='.$item['et'].'&dia='.$item[dia].'&brand=&marka='.$_POST["marka"].'&model='.$_POST["model"].'&year='.$_POST["year"].'&modification='.$_POST["modification"].'"';
        }
        if($item["axis"] == '1'){
          $axis = '(передняя ось)';
        }elseif($item["axis"] == '2'){
          $axis = '(задняя ось)';
        }else{
          $axis ='';
        }
        $res["cont"].= '<li name="radioTyres" style="float: left; margin-right: 10px;"><a '.$url.' style="font-size: 12px; color:#fff; cursor: pointer;">'.$item["width"].'x'.$rDiameter[0].'/'.$item["pcd"].' ET: '.$item['et'].' D:'.$item["dia"].$axis.'</a></li>';
        $n++;
    }
    $res["cont"].='</ul></div>';
  }else{
    ///$res["cont"].= '<span style="color:#fff;"> Не найдено </span>';
  }

  $res['cont'] .= '</div>';
  if($item["nut"] OR $item["bolt"]) {
    $res['cont'] .= '<div class="col-md-12">
        <h6 style="color: #fff;padding: 0px;">Крепеж</h6>
        <div class="row" style="margin: 5px 0;">';
    if ($item["nut"]) {
      $res['cont'] .= '<span style="color: #fff;font-size: 14px;">Гайка: ' . $item["nut"] . '</span>';
    }
    if ($item["bolt"]) {
      $res['cont'] .= '<span style="color: #fff;font-size: 14px;">Болт: ' . $item["bolt"] . '</span>';
    }
    $res['cont'] .= '</div></div>';
  }
}else{
  $res["error"]= '<div class="col-md-12" style="margin-bottom:50px;">
							<div class="bs-callout bs-callout-warning">
								<h4><i class="fa fa-info"></i> Выберете марку, модель, год и модификацию.</h4>
							</div>
						</div>';
}
echo json_encode($res);
