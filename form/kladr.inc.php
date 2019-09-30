<?
session_start();
//////Подключение к базе
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
/////Подключение библиотеки
include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');

$query = clearData($_POST['query']);
$type = clearData($_POST['type']);
$id = clearData($_POST['id']);
$search = "";

if($query) {
    $wr = "";
    if($type == "city"){
        $wr = "&regionId=".$id;
    }elseif($type == "street"){
        $wr = "&cityId=".$id;
    }
    $result = file_get_contents("http://kladr-api.ru/api.php?query=".$query."&contentType=".$type.$wr);
    $res = json_decode($result);
    if ($res) {
        foreach ($res->result as $item) {
            $search.="<li data-id='".$item->id."' data-type='".$type."'><div class='block-title row'>".$item->typeShort.". ".$item->name."</div></li>";
        }
    }
}
echo $search;
?>