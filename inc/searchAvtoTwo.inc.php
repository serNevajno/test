<?
if($_SERVER["REQUEST_METHOD"]=="POST"){
  include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
  include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
  if(!empty($_POST["marka"]) AND empty($_POST["model"]) AND empty($_POST["year"])){
    if (selectListModelAuto($_POST["marka"])) {
      $res = '<option value="">Выберите модель</option>';
      foreach (selectListModelAuto($_POST["marka"]) as $iModel) {
        $res .= ' <option value="' . $iModel['model'] . '">' . $iModel['model'] . '</option>';
      }
    }
  }elseif(!empty($_POST["marka"]) AND !empty($_POST["model"]) AND empty($_POST["year"])){
    if (selectListYearAuto($_POST["marka"], $_POST["model"])) {
      $res = '<option value="">Выберите год</option>';
      foreach (selectListYearAuto($_POST["marka"], $_POST["model"]) as $item){
        $res .= ' <option value="' . $item['year'] . '">' . $item['year'] . '</option>';
      }
    }
  }elseif(!empty($_POST["marka"]) AND !empty($_POST["model"]) AND !empty($_POST["year"])){
    if(selectListModificationAuto($_POST["marka"], $_POST["model"], $_POST["year"])){
      $res = '<option value="">Выберите модификацию</option>';
      foreach (selectListModificationAuto($_POST["marka"], $_POST["model"], $_POST["year"]) as $item){
        $res .= ' <option value="' . $item['modification'] . '">' . $item['modification'] . '</option>';
      }
    }
  }
  echo $res;
}
?>