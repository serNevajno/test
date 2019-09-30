<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    mysql_query('SET NAMES cp1251');
    if(!empty($_POST[manager])){
        $man_query = " AND t1.id_admin='$_POST[manager]'";
    }
    if (!empty($_POST["region"])) {
        $man_query .= " AND t1.region='".$_POST["region"]."' ";
    }
    $result = db2array("SELECT t1.id, t1.date, t1.date_end, t1.id_user, t1.summ, t2.code, t2.name as name_status, t3.name as name_user, t1.order_phone, t1.name as name_order, t1.comments, t1.comment, t1.prepayment, t1.prepayment_date, t1.beznal, t0.name as name_product, t0.quantity, t0.price, t0.price_clear, t3.email, t4.region, t1.address, t1.delivery, t1.pdzz, t1.upd, t1.typeUser, t5.name as name_delivery FROM order_product as t0
            LEFT JOIN orders as t1 on(t0.id_order=t1.id)
			LEFT JOIN status as t2 on(t1.id_status = t2.id) 
			LEFT JOIN users as t3 on(t1.id_user = t3.id) 
			LEFT JOIN region as t4 on(t1.region=t4.id)
			LEFT JOIN delivery as t5 on(t1.delivery=t5.id)
			WHERE t1.date_end>='$_POST[from] 00:00:00' AND t1.date_end<='$_POST[to] 23:59:59'$man_query ORDER BY t1.date DESC", 2);

    $arr = array();
    $i = 0;
    if($_POST[from] == $_POST[to]){
        $date = $_POST[from];
    }else{
        $date = $_POST[from]." - ".$_POST[to];
    }


    $sSummSale = sSummSaleOrderByDate($_POST['from'], $_POST['to'], $_POST["manager"], $_POST["region"]);
    $sSummOrder = sSummOrderByDate($_POST['from'], $_POST['to'], $_POST["manager"], $_POST["region"]);
    if($sSummSale > 0){
        $summOrder = $sSummOrder - $sSummSale;
        $saleOrder = $sSummOrder - $summOrder;
    }else{
        $summOrder = $sSummOrder;
    }
    $beznalSum = sSumBezNal($_POST['from'], $_POST['to'], $_POST["manager"], $_POST["region"]);
    $nalSum = sSumNal($_POST['from'], $_POST['to'], $_POST["manager"], $_POST["region"]);
    $inCardSum = sSumInCard($_POST['from'], $_POST['to'], $_POST["manager"], $_POST["region"]);


    $sum = "Сумма:".$summOrder;
    if($sSummSale > 0){
        $sum.= " Скидка: ".$saleOrder;
    }
    if($beznalSum){
        $sum.= " Безнал: ".$beznalSum;
    }
    if($nalSum){
        $sum.= " Нал: ".$nalSum;
    }
    if($inCardSum){
        $sum.= " На карте: ".$inCardSum;
    }

    $arr += array($i => array(
        "nomer" => $date,
        "product" => $sum,
        "quantity" => "",
        "price_clear" => "",
        "sum_price_clear" => "",
        "price" => "",
        "sum" => "",
        "sale" => "",
        "val" => "",
        "marg" => "",
        "prepayment" => "",
        "client" => "",
        "type" => "",
        "date" => "",
        "date_end" => ""
    ));
    foreach ($arr[0] as $key => $string) {
        $arr[0][$key] = iconv("utf-8", "cp1251", $string);
    }
    $i = 1;
    $arr += array($i => array(
        "nomer" => "Номер заказа",
        "product" => "Товар",
        "quantity" => "Количество",
        "price_clear" => "Закуп",
        "sum_price_clear" => "Сумма закупа",
        "price" => "Цена продажи",
        "sum" => "Сумма продажи",
        "sale" => "Скидка",
        "val" => "Вал",
        "marg" => "Маржинальность",
        "prepayment" => "Предоплата",
        "client" => "Клиент",
        "phone" => "Телефон",
        "email" => "E-mail",
        "region" => "Регион",
        "address" => "Адрес",
        "delivery" => "Доставка",
        "date_pdzz" => "Дата ПДЗЗ",
        "status" => "Статус заказа",
        "com_men" => "Коментарий менеджера",
        "com_zak" => "Коментарий заказчика",
        "upd" => "УПД подписан",
        "type" => "Тип оплаты",
        "date" => "Дата заказа",
        "date_end" => "Дата закрытия"
    ));

    foreach ($arr[1] as $key => $string) {
        $arr[1][$key] = iconv("utf-8", "cp1251", $string);
    }
    $i = 2;
    /*   echo "<pre>";
       print_r($result);
       echo "</pre>";*/
    foreach($result as $row){
        $nomer = $row["order_phone"].$row["id"];
        if($row["summ"]>0) {
            $sale = selectSummOrderById($row["id"]) - $row["summ"];
            $col = db2array("SELECT COUNT(*) FROM order_product WHERE id_order='$row[id]'");
            $sale = $sale / $col["COUNT(*)"];
        }else{
            $sale = 0;
        }
        if($row["id_user"]>0 AND $row["order_phone"] != 'T'){
            $name = $row["name_user"];
        }else{
            $name = $row["name_order"];
        }
        if($row["beznal"] == '1'){
            $type = "beznal";
        }else{
            $type = "nal";
        }
        if($row["prepayment"]>0) {
            $prepayment = $row["prepayment"] . "p - " . $row["prepayment_date"];
        }else{
            $prepayment = "";
        }
        $val = ($row["price"]*$row["quantity"]) - ($row["price_clear"]*$row["quantity"]);
        if($row["price_clear"]>0){
            $marj = number_format(($row["price"]*$row["quantity"])/($row["price_clear"]*$row["quantity"]), 5, '.', '');
        }else{
            $marj = number_format(0, 5, '.', '');
        }

        if($row["upd"] == "1"){
            $upd = "Da";
        }else{
            $upd = "Net";
        }
        $arr += array($i => array(
            "nomer" => $nomer,
            "product" => $row["name_product"],
            "quantity" => $row["quantity"],
            "price_clear" => $row["price_clear"],
            "sum_price_clear" => $row["price_clear"]*$row["quantity"],
            "price" => $row["price"],
            "sum" => $row["price"]*$row["quantity"],
            "sale" => $sale,
            "val" => $val,
            "marg" => $marj,
            "prepayment" => $prepayment,
            "client" => $name,
            "phone" => $row["order_phone"],
            "email" => $row["email"],
            "region" => $row["region"],
            "address" => $row["address"],
            "delivery" => $row["name_delivery"],
            "date_pdzz" => $row["pdzz"],
            "status" => $row["name_status"],
            "com_men" => $row["comments"],
            "com_zak" => $row["comment"],
            "upd" => $upd,
            "type" => $type,
            "date" => $row["date"],
            "date_end" => $row["date_end"]
        ));
        $i++;
    }
    $f = fopen($_SERVER['DOCUMENT_ROOT'].'/price_provider/orders.csv', 'w');
    foreach ($arr as $item) {
        fputcsv($f, $item, ';');
    }
    fclose($f);

    $filename = "orders.csv";
    // нужен для Internet Explorer, иначе Content-Disposition игнорируется
    if(ini_get('zlib.output_compression'))
        ini_set('zlib.output_compression', 'Off');

    $file_extension = strtolower(substr(strrchr($filename,"."),1));
    if( $filename == "" )
    {
        echo "ОШИБКА: не указано имя файла.";
        exit;
    } elseif ( ! file_exists($_SERVER['DOCUMENT_ROOT'].'/price_provider/'.$filename ) ) // проверяем существует ли указанный файл
    {
        echo "ОШИБКА: данного файла не существует.";
        exit;
    };
    switch( $file_extension )

    { 		//case "csv": $ctype="csv"; break;
        case "html": $ctype="application/html"; break;
        default: $ctype="application/force-download";
    }
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false); // нужен для некоторых браузеров
    header("Content-Type: $ctype");
    header("Content-Disposition: attachment; filename=\"".basename($filename)."\";" );
    header("Content-Transfer-Encoding: binary");
//header("Content-Length: ".filesize($filename)); // необходимо доделать подсчет размера файла по абсолютному пути
    readfile($_SERVER['DOCUMENT_ROOT'].'/price_provider/'.$filename);
    exit();

}
?>