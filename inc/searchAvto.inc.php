<?
if($_SERVER["REQUEST_METHOD"]=="POST"){
  include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
  include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
  function sGroupModification($marka, $model){
    $temp = db2array("SELECT id FROM `search_by_vehicle` WHERE vendor='$marka' AND `car`='$model' GROUP BY `param_pcd`, `param_dia`, `tyres_factory`, `tyres_replace`, `wheels_factory`, `wheels_replace`", 2);
    return count($temp);
  }
  /*if($_SERVER['REMOTE_ADDR'] == '92.244.120.145') {*/
    if (!empty($_POST["marka"]) AND empty($_POST["model"]) AND empty($_POST["year"])) {
      $sListModelAuto = selectListModelAutoV2($_POST["marka"]);
      if ($sListModelAuto) {
        $res = '';
        foreach ($sListModelAuto as $iModel) {
          $res .= ' <li value="' . $iModel['car'] . '">' . $iModel['car'] . '</li>';
        }
      }
    } elseif (!empty($_POST["marka"]) AND !empty($_POST["model"]) AND empty($_POST["year"])) {
      $sCount = sGroupModification($_POST["marka"], $_POST["model"]);
      if($sCount == "1") {
        $res = 'groupMod';
      }else{
        $sListYearAuto = selectListYearAutoV2($_POST["marka"], $_POST["model"]);
        if ($sListYearAuto) {
          $res = '';
          foreach ($sListYearAuto as $item) {
            $res .= ' <li value="' . $item['year'] . '">' . $item['year'] . '</li>';
          }
        }
      }
    } elseif (!empty($_POST["marka"]) AND !empty($_POST["model"]) AND !empty($_POST["year"])) {
      $sListModificationAuto = selectListModificationAutoV2($_POST["marka"], $_POST["model"], $_POST["year"]);
      if ($sListModificationAuto) {
        $res = '';
        foreach ($sListModificationAuto as $item) {
          $res .= ' <li value="' . $item['modification'] . '">' . $item['modification'] . '</li>';
        }
      }
    }
/*  }else{
    if (!empty($_POST["marka"]) AND empty($_POST["model"]) AND empty($_POST["year"])) {
      if (selectListModelAuto($_POST["marka"])) {
        $res = '';
        foreach (selectListModelAuto($_POST["marka"]) as $iModel) {
          $res .= ' <li value="' . $iModel['model'] . '">' . $iModel['model'] . '</li>';
        }
      }
    } elseif (!empty($_POST["marka"]) AND !empty($_POST["model"]) AND empty($_POST["year"])) {
      if (selectListYearAuto($_POST["marka"], $_POST["model"])) {
        $res = '';
        foreach (selectListYearAuto($_POST["marka"], $_POST["model"]) as $item) {
          $res .= ' <li value="' . $item['year'] . '">' . $item['year'] . '</li>';
        }
      }
    } elseif (!empty($_POST["marka"]) AND !empty($_POST["model"]) AND !empty($_POST["year"])) {
      if (selectListModificationAuto($_POST["marka"], $_POST["model"], $_POST["year"])) {
        $res = '';
        foreach (selectListModificationAuto($_POST["marka"], $_POST["model"], $_POST["year"]) as $item) {
          $res .= ' <li value="' . $item['modification'] . '">' . $item['modification'] . '</li>';
        }
      }
    }
  }*/
  echo $res;
}
?>