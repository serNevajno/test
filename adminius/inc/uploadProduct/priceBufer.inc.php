<?if ($_SERVER["REQUEST_METHOD"] == "POST") {
	error_reporting(0);
    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php');
    /////Подключение библиотеки
    include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/function.inc.php');
    include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/uploadProduct/upFunc.inc.php');
    /////Замок
    include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/lock.inc.php');

    $cStart = clearData($_POST["count"], "i");

    $cEnd = $cStart + 1000;
    $date = date("Y-m-d H:i:s");

    $temp = db2array("SELECT id_product, price, price_clear, logistic, id_provider, availability FROM `price_provider_bufer` WHERE id>='$cStart' AND id<'$cEnd'", 2);

    foreach ($temp as $item){
        mysql_query("INSERT INTO `price_provider` (`price`, `price_clear`, `logistic`, `availability`, `id_product`, `id_provider`, `date`) VALUES ('$item[price]', '$item[price_clear]', '$item[logistic]', '$item[availability]', '$item[id_product]', '$item[id_provider]', '$date')");
        $googPrice = selectGoodPrice($item[id_product]);
        mysql_query("UPDATE `product` SET price='$googPrice[price]', price_clear='$googPrice[price_clear]', logistic='$googPrice[logistic]', provider='$googPrice[id_provider]', availability='$googPrice[availability]' WHERE id='$item[id_product]'");
    }

    echo $cEnd;
}
?>