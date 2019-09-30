<?
if($_SERVER["REQUEST_METHOD"]=="POST"){
    // Фильтруем полученные данные
    $id = (int)$_POST['id'];
    $id_prod = (int)$_POST['productOrder_id'];
    $storage = (int)$_POST['storage'];
    // Заносим в базу
    mysql_query("UPDATE order_product SET in_storage='$storage' WHERE id='$id_prod'");

    header('Location: /adminius/index.php?code=orders&action=edit&id='.$id);
    exit;
}
?>