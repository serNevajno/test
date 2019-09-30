<?
if($_SERVER["REQUEST_METHOD"]=="POST"){
  include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
  include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
  if(!empty($_POST["marka"]) AND empty($_POST["model"]) AND empty($_POST["year"])){
    if (selectListModelAuto($_POST["marka"])) {
      $res = '';
      foreach (selectListModelAuto($_POST["marka"]) as $iModel) {
        $res .= ' <li value="' . $iModel['model'] . '">' . $iModel['model'] . '</li>';
      }
    }
  }elseif(!empty($_POST["marka"]) AND !empty($_POST["model"]) AND empty($_POST["year"])){
    if (selectListYearAuto($_POST["marka"], $_POST["model"])) {
      $res = '';
      foreach (selectListYearAuto($_POST["marka"], $_POST["model"]) as $item){
        $res .= ' <li value="' . $item['year'] . '">' . $item['year'] . '</li>';
      }
    }
  }elseif(!empty($_POST["marka"]) AND !empty($_POST["model"]) AND !empty($_POST["year"])){
    if(selectListModificationAuto($_POST["marka"], $_POST["model"], $_POST["year"])){
      $res = '';
      foreach (selectListModificationAuto($_POST["marka"], $_POST["model"], $_POST["year"]) as $item){
        $res .= ' <li value="' . $item['modification'] . '">' . $item['modification'] . '</li>';
      }
    }
  }
  echo $res;
}
?>