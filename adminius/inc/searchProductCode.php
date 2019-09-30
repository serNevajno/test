<?if($_SERVER["REQUEST_METHOD"]=="POST"){
  include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
  /////Подключение библиотеки
  include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/function.inc.php');
  $search ="";

  $searchR = clearData($_POST["search"]);
  $res = explode(" ", $searchR);

  $n=1;
  foreach ($res as $item){
    if($n > 1){
      $j = " AND";
    }
    $se .=  $j." name LIKE'%$item%'";
    $n++;
  }

  $sNameWorkSearch = db2array("SELECT id, name, code, price FROM product WHERE availability>0 AND (article LIKE '%$searchR%' OR ($se)) ORDER BY price ASC", 2);
  if (count($sNameWorkSearch) > 0){
    foreach ($sNameWorkSearch as $item) {
      $search.="<li data-id='".$item["id"]."'><div class='block-title'>".$item['name']." - <b>".$item['price']." руб</b></div></li>";
    }
    echo $search;
  }else{
    $search .="<span id='search-noresult' >Ничего не найдено!</span>";
    echo $search;
  }
}
?>