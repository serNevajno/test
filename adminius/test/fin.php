<?
session_start();
header("Content-Type: text/html; charset=UTF-8");
//////Подключение к базе
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');

$temp = db2array("SELECT date, balance FROM `encashment` WHERE region='3' ORDER BY date DESC LIMIT 1, 1");
$sumT = db2array("SELECT t2.id, t2.in_card, t2.prepayment, t2.summ, t2.beznal FROM orders as t2 WHERE t2.id_status='1' AND t2.date_end>='2018-10-09 20:43:44' AND t2.region='3'", 2);

$sum = 0;
foreach($sumT as $item) {
    if($item["beznal"] == 0) {
        if ($item["summ"] > 0) {
            $sum += $item["summ"];
        } else {
            $sumTO = db2array("SELECT t1.price, t1.quantity FROM order_product as t1 WHERE t1.id_order='$item[id]'", 2);
            foreach ($sumTO as $it) {
                $sum += $it["price"] * $it["quantity"];
            }
        }
        if ($item['in_card'] == '1') {
            $sum -= $item['prepayment'];
        }
    }
}
echo $temp["balance"];
echo "<br>";
echo $sum;
echo "<br>";
echo $temp["balance"]+$sum;
?>