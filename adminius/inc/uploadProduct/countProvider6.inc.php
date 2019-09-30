<?
$arr = file_get_contents($_POST["url"]);
$res = json_decode($arr);
echo count($res);
?>