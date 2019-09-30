<?
$arr = simplexml_load_file("http://www.shinservice.ru/xml/shinservice-b2b.xml");
echo $mess = count($arr->wheels->wheel);
?>