<?
session_start();
//////Подключение к базе
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
/////Подключение библиотеки
include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');

$query = clearData($_POST['query']);
$type = clearData($_POST['type']);
$parent = clearData($_POST['parent']);
$id = clearData($_POST['id']);
$search = "";

if($query) {
    $wr = "";
    if($type == "city"){
        $wr = "&regionId=".$id;
    }elseif($type == "street"){
        $wr = "&cityId=".$id;
    }
    if($parent == "1"){
        $wr.= "&withParent=1";
    }

    $result = file_get_contents("http://kladr-api.ru/api.php?query=".$query."&contentType=".$type.$wr);
    $res = json_decode($result);
    if ($res) {
        foreach ($res->result as $item) {
            $obl = '';
            $rn = "";
            $data_rn = "";
            if($parent == "1"){
                if($item->parents[1]->name) {
                    $rn = ", " . $item->parents[1]->typeShort . "." . $item->parents[1]->name;
                    $data_rn = " data-rn='".$item->parents[1]->name."'";
                }
                $obl = " (".$item->parents[0]->typeShort.".".$item->parents[0]->name.$rn.")";
            }
            $search.="<li data-id='".$item->id."' data-type='".$type."'".$data_rn."><div class='block-title row'>".$item->typeShort.". ".$item->name.$obl."</div></li>";
        }
    }
}
echo $search;
?>