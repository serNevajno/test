<?
ini_set('date.timezone', 'Asia/Yekaterinburg');
define("DB_HOST", "dobrayash.mysql");
define("DB_LOGIN", "dobrayash_new");
define("DB_PASSWORD", "4EFqcm:Q");
define("DB_NAME", "dobrayash_new");

$db = @mysql_connect(DB_HOST, DB_LOGIN, DB_PASSWORD) or die("Ошибка соединения с сервером баз данных");
mysql_query('SET NAMES utf8');

function db2array($sql, $m = 1)
{
    $result = mysql_query($sql);
    switch ($m) {
        case 1:
            $arr = mysql_fetch_assoc($result);
            return $arr;
        case 2:
            $arr = array();
            while ($row = @mysql_fetch_assoc($result)) {
                $arr[] = $row;
            }
            return $arr;
    }
}

$temp = db2array("SELECT id, comments, expectation_hours, date_expectation FROM orders WHERE id_status='11' AND date_expectation!='0000-00-00 00:00:00'", 2);
if($temp) {
    $date_now = date('Y-m-d H:i:s');
    foreach ($temp as $item) {
        $date_end = date('Y-m-d H:i:s', strtotime($item[date_expectation] . '+' . $item[expectation_hours] . ' hours'));
        if ($date_end < $date_now) {
            $comments = $item[comments] . " Заказ отменен автоматически по истечению срока внесения предоплаты";
            mysql_query("UPDATE orders SET id_status='3', comments='$comments', date_comm='$date_now' WHERE id='$item[id]'");
        }
    }
}
?>