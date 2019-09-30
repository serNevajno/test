<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    session_start();
    include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
    /////Подключение библиотеки
    include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/function.inc.php');
    include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/lock.inc.php');

    $id = clearData($_POST['id'], "i");

    mysql_query("UPDATE prepayment SET status='1' WHERE id='$id'") or die(mysql_error());
}
?>