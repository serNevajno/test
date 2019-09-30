<?
Echo "d";
/*session_start();
//////Подключение к базе
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
/////Подключение библиотеки
include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');

$alf = array('а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','ы','ь','э','ю','я');
foreach ($alf as $iAlf) {
    $result = file_get_contents("http://kladr-api.ru/api.php?query=".$iAlf."&contentType=region&withParent=1");
    $res = json_decode($result);

    if ($res) {
        foreach ($res->result as $item) {
            if($item->typeShort != "г") {
                $temp = db2array("SELECT COUNT(*) FROM region_kladr WHERE id_kladr='$item->id'");
                if ($temp["COUNT(*)"] == "0") {
                    mysql_query("INSERT INTO `region_kladr`(`id_kladr`, `name`, `type`) VALUES ('$item->id', '$item->name', '$item->typeShort')");
                }
            }
        }
    }
}
echo "ok2";*/
?>