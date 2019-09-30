<?
include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
$type = clearData($_POST['type'], "i");
$typeUser = clearData($_POST['typeUser'], "i");

$res = "";
if($typeUser == "1") {
    if ($type != '3') {
    $res .= '<li>
                <div class="pic">
                    <i class="fa fa-money" style="font-size:26px;margin-right: 15px;"></i>
                </div>
                <input type="radio" name="pay" value="1" style="width: unset;">
                Наличными при получении
            </li>';
    }
    $res.='<li>
        <div class="pic">
            <img src="http://toplogos.ru/images/logo-sberbank-online.png" style="margin-right: 15px;max-height: 30px">
        </div>
        <input type="radio" name="pay" value="2" style="width: unset;">
        Оплата на карту Сбербанка через Сбербанк ОнЛ@йн по номеру карты - самый распространенный вид оплаты
    </li>';
}
$res.='<li>
    <div class="pic">
        <i class="fa fa-file-text" style="font-size:26px;margin-right: 15px;"></i>
    </div>
    <input type="radio" name="pay" value="3" onclick="" style="width: unset;">
    Оплата по счету для Физических лиц, ИП и Организаций. Все цены на товар указаны с учетем НДС
</li>';
echo $res;
?>