<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if (!isset($_POST["id"])) {
        $date_active = date('Y-m-d H:i:s');

        // Фильтруем полученные данные
        $trans_company = clearData($_POST['trans_company']);
        $otherCompany = clearData($_POST['otherCompany']);
        if($otherCompany){
            $trans_company = $otherCompany;
        }
        $sender = clearData($_POST['sender']);
        $summ = "";
        $recipient = clearData($_POST['recipient']);
        $number = clearData($_POST['number']);
        $id_order = clearData($_POST['id_order']);
        $delivery = clearData($_POST['delivery']);
        $id_user = selectWhatUser();
        $internal = clearData($_POST['internal']);

        foreach ($_POST["product"] as $iprod){
            $temp = db2array("SELECT quantity, price FROM order_product WHERE id='$iprod'");
            $summ+=$temp["price"]*$temp["quantity"];
        }
        mysql_query("INSERT INTO `log_shipments`(`date_ship`, `trans_company`, `sender`, `summ`, `recipient`, `number`, `manager`, `id_order`, `delivery`, `internal`) VALUES ('$date_active', '$trans_company', '$sender', '$summ', '$recipient', '$number', '$id_user', '$id_order', '$delivery', '$internal')") or die(mysql_error());
        $id_element = mysql_insert_id();

        foreach ($_POST["product"] as $item){
            mysql_query("INSERT INTO `log_shipments_product`(`id_log`, `id_product`) VALUES ('$id_element', '$item')") or die(mysql_error());
            mysql_query("UPDATE `order_product` SET `in_storage`='0' WHERE id='$item'") or die(mysql_error());
        }

        header('Location: /adminius/index.php?code=orders&action=edit&id='.$id_order);
        exit;
    }elseif(isset($_POST["id"]) and isset($_POST['trans_company']) and isset($_POST['recipient'])){
        $date = DateTime::createFromFormat('d F Y - H:i', $_POST['date_active']);
        $date_active = $date->format('Y-m-d H:i:s');
        $trans_company = clearData($_POST['trans_company']);
        $otherCompany = clearData($_POST['otherCompany']);
        if($otherCompany){
            $trans_company = $otherCompany;
        }
        $sender = clearData($_POST['sender']);
        $summ = clearData($_POST['summ']);
        $recipient = clearData($_POST['recipient']);
        $number = clearData($_POST['number']);
        $id_order = clearData($_POST['id_order']);
        $delivery = clearData($_POST['delivery']);

        // Заносим в базу
        $id = clearData($_POST['id'], "i");

        mysql_query("UPDATE log_shipments SET date_ship='$date_active', trans_company='$trans_company', sender='$sender', summ='$summ', recipient='$recipient', number='$number', id_order='$id_order', delivery='$delivery' WHERE id='$id'") or die(mysql_error());


        //addLogs(selectWhatUser(), 10, $id, "blog");
        header("Location: index.php?code=log_shipments");
        exit;
    }elseif(!isset($_POST['recipient']) and !isset($_POST['trans_company']) and !isset($_POST['summ']) and isset($_POST['id'])){
        // Фильтруем полученные данные
        $id = (int)$_POST['id'];

        // Заносим в базу
        //mysql_query("DELETE FROM log_shipments WHERE id='$id'") or die(mysql_error());

        ///addLogs(selectWhatUser(), 11, $id_element, "blog");
        header('Location: index.php?code=log_shipments');
        exit;
    }
}
?>