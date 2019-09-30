<?if($_SERVER['REQUEST_METHOD'] == 'POST'){
    mysql_query("UPDATE xml_provider SET procent='$_POST[tyres]' WHERE id='1'") or die(mysql_error());
    mysql_query("UPDATE xml_provider SET procent='$_POST[disk]' WHERE id='2'") or die(mysql_error());
    header('Location: index.php?code=xmlClient');
    exit;
}?>