<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if (!isset($_POST['id'])){
        //echo "<pre>".print_r($_POST, true)."</pre>";

        $text = clearData($_POST['text']);

        // Заносим в базу
        mysql_query("INSERT INTO templatesSMS (text) VALUES ('$text')") or die(mysql_error());


        header('Location: index.php?code=templatesSms');
        exit();

    }elseif(isset($_POST["id"]) and isset($_POST['text'])){

        $id = clearData($_POST['id'], "i");
        $text = clearData($_POST['text']);

        // Заносим в базу
        mysql_query("UPDATE templatesSMS SET text='$text' WHERE id='$id'") or die(mysql_error());

        header('Location: /adminius/index.php?code=templatesSms');
        exit;
    }elseif(!isset($_POST['text'])){

        // Фильтруем полученные данные
        $id = (int)$_POST['id'];
        // Заносим в базу
        mysql_query("DELETE FROM templatesSMS WHERE id='$id'") or die(mysql_error());

        header('Location: index.php?code=templatesSms');
        exit;

    }
}
?>