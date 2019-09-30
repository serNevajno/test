<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
  include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
  /////Подключение библиотеки
  include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/function.inc.php');

  $subcat = clearData($_POST['subcat']);

  $res = db2array("SELECT `name`, `id` FROM categories WHERE section = '$subcat' ORDER BY `name` ASC", 2);

  foreach ($res as $item){
    $option.="<option value='".$item["id"]."'>".$item['name']."</option>";
  }
  echo $option;
}