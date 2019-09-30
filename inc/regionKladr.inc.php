<?
session_start();
//////Подключение к базе
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
/////Подключение библиотеки
include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');

$id = clearData($_POST['id']);
$search = '';
if($id) {
    $result = file_get_contents("http://kladr-api.ru/api.php?regionId=".$id."&contentType=city&typeCode=1&withParent=1");
    $res = json_decode($result);

    if ($res) {
        foreach ($res->result as $item) {
            $rn = "";
            $data_rn = "";
            if($item->parents[1]->name) {
                $rn = ", " . $item->parents[1]->typeShort . "." . $item->parents[1]->name;
                $data_rn = " data-rn='".$item->parents[1]->name."'";
            }
            $search.='<li style="cursor: pointer;" data-id="'.$item->id.'" '.$data_rn.'>'.$item->name.'</li>';
        }
    }
}
echo $search;
?>