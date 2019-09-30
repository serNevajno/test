<?php
if (isset($_POST['id'])) {
    include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
    /////Подключение библиотеки
    include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/function.inc.php');

    // Фильтруем полученные данные
    $id = clearData($_POST['id']);
    $date = $_POST['date'];
    $pdzz = $date." 00:00:00";

    mysql_query("UPDATE `orders` SET `pdzz`='$pdzz' WHERE id='$id'");

}
?>