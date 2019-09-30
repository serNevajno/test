<?php
$categories = $_POST["categories"];
$article = $_POST["article"];
$name = $_POST["name"];
$type = $_POST["type"];
$region = $_POST["region"];

mysql_query('SET NAMES cp1251');
$query_search = "";
if(!empty($name)) {
    $query_search.=" AND (t2.name LIKE '%".$name."%')";
}

if(!empty($categories))  {
    $arrCat = recusiveCatSection($categories);
    $query_search.=" AND t2.categories IN (";
    $n = 1;
    foreach ($arrCat as $iCat){
        if($n>1) $query_search.=", ";
        $query_search.= $iCat;
        $n++;
    }
    $query_search.= ")";
}
if(!empty($article))  {
    $query_search.=" AND t2.article='$article'";
}
if($type == "1"){
    $result =  db2array("SELECT t2.id, t2.name, t1.price, t1.price_clear, t1.quantity, t2.article, t3.order_phone, t1.id_order FROM order_product as t1 LEFT JOIN product as t2 on(t1.product_id=t2.id) LEFT JOIN orders as t3 on(t1.id_order=t3.id) WHERE t3.region='$region' AND t1.in_storage='1' AND t3.id_status!='1' AND t3.id_status!='3'$query_search ORDER BY t3.date DESC", 2);
    $arr = array();
    $i = 0;

    $arr+= array($i => array(
        "name" => "Название товара",
        "article" => "Артикул",
        "quantity" => "Кол-во",
        "price" => "Цена",
        "price_clear" => "Цена закупа",
        "order" => "Номер заказа"
    ));
    foreach ($arr[0] as $key => $string) {
        $arr[0][$key] = iconv("utf-8", "cp1251", $string);
    }
    $i = 1;
    foreach($result as $row){
        $arr += array($i => array(
            "name" => $row["name"],
            "article" => $row["article"],
            "quantity" => $row["quantity"],
            "price" => $row["price"],
            "price_clear" => $row["price_clear"],
            "order" => $row["order_phone"].$row["id_order"]
        ));
        $i++;
    }
}else{
    if($region == '1'){
        $id_provider = "7";
    }elseif($region == '2'){
        $id_provider = "8";
    }elseif($region == '3'){
        $id_provider = "11";
    }
    $result = db2array("SELECT t2.id, t2.name, t1.price, t1.price_clear, t1.availability, t2.article  FROM price_provider as t1 LEFT JOIN product as t2 on(t1.id_product=t2.id) WHERE t1.id_provider='$id_provider'$query_search ORDER BY t1.date DESC", 2);

    $arr = array();
    $i = 0;

    $arr+= array($i => array(
        "name" => "Название товара",
        "article" => "Артикул",
        "quantity" => "Кол-во",
        "price" => "Цена",
        "price_clear" => "Цена закупа"
    ));
    foreach ($arr[0] as $key => $string) {
        $arr[0][$key] = iconv("utf-8", "cp1251", $string);
    }
    $i = 1;
    foreach($result as $row){
        $arr += array($i => array(
            "name" => $row["name"],
            "article" => $row["article"],
            "quantity" => $row["availability"],
            "price" => $row["price"],
            "price_clear" => $row["price_clear"]
        ));
        $i++;
    }
}
$f = fopen($_SERVER['DOCUMENT_ROOT'].'/price_provider/storage.csv', 'w');
foreach ($arr as $item) {
    fputcsv($f, $item, ';');
}
fclose($f);

$filename = "storage.csv";
// нужен для Internet Explorer, иначе Content-Disposition игнорируется
if(ini_get('zlib.output_compression'))
    ini_set('zlib.output_compression', 'Off');

$file_extension = strtolower(substr(strrchr($filename,"."),1));
if( $filename == "" )
{
    echo "ОШИБКА: не указано имя файла.";
    exit;
} elseif ( ! file_exists( $_SERVER['DOCUMENT_ROOT'].'/price_provider/'.$filename ) ) // проверяем существует ли указанный файл
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
?>