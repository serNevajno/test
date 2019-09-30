<?php
$categories = $_POST["categories"];
$article = $_POST["article"];
$active = $_POST["active"];
$name = $_POST["name"];
$attention = $_POST["attention"];
	
$query_search = "";
			if(!empty($active)) {
				if(!empty($query_search) AND $active!=0) $query_search.= "AND";
				if($active == 2) $active = 0;
				$query_search.=" active='$active' ";
			}
			if(!empty($name)) {
				if(!empty($query_search)) $query_search.= "AND";
				$query_search.=" (name LIKE '%".$name."%') ";
			 }
			 if(!empty($provider)) {
				if(!empty($query_search)) $query_search.= "AND";
				$query_search.=" provider='$provider' ";
			}
			if(!empty($brand)) {
				if(!empty($query_search)) $query_search.= "AND";
				$query_search.=" brand='$brand' ";
			}
			if(!empty($attention)) {
				if(!empty($query_search)) $query_search.= "AND";
				$query_search.=" attention='$attention' ";
			}
            if(!empty($categories))  {
                if(!empty($query_search)) $query_search.= "AND";
                $arrCat = recusiveCatSection($categories);
                $query_search.=" categories IN (";
                $n = 1;
                if($arrCat) {
                    foreach ($arrCat as $iCat) {
                        if ($n > 1) $query_search .= ", ";
                        $query_search .= $iCat;
                        $n++;
                    }
                }else{
                    $query_search .= $categories;
                }
                $query_search.= ")";
            }
			if(!empty($article))  {
				if(!empty($query_search)) $query_search.= "AND";
				$query_search.=" article='$article' ";
			}
			if(!empty($query_search)){
				$query_search = " WHERE".$query_search;
			}
mysql_query('SET NAMES cp1251');
$result = db2array("SELECT article, name, active, name, price, sale, availability, logistic, categories, id FROM product$query_search ORDER BY priority DESC, date DESC", 2);

$arr = array();
$i = 0;
$filter = selectFilter($categories);

$arr += array($i => array(
						"id" => "Артикул",  
						"name" => "Название товара", 
						"price" => "Цена", 
						"sale" => "Скидка", 
						"availability" => "Наличие", 
						"logistic" => "Доставка(дней)", 
						"categories" => "Категория"
					));
foreach ($arr[0] as $key => $string) {
         $arr[0][$key] = iconv("utf-8", "cp1251", $string);
}
foreach ($filter as $iFilter){
    $arr[0][$iFilter["id"]] = $iFilter["name"]."-id:".$iFilter["id"];
}
$i = 1;
foreach($result as $row){
	$categories = selectCategoriesById($row["categories"]);
	$arr += array($i => array(
							"id" => $row["article"],
							"name" => $row["name"], 
							"price" => $row["price"], 
							"sale" => $row["sale"], 
							"availability" => $row["availability"], 
							"logistic" => $row["logistic"], 
							"categories" => $categories["name"],
						));
    foreach ($filter as $iFilter){
        $arr[$i][$iFilter["id"]] = selectElementValueName($row["id"], $iFilter["id"]);
    }
	$i++;
}
$f = fopen($_SERVER['DOCUMENT_ROOT'].'/price_provider/product.csv', 'w');
foreach ($arr as $item) {
	fputcsv($f, $item, ';');
}
fclose($f);

$filename = "product.csv";
 // нужен для Internet Explorer, иначе Content-Disposition игнорируется
if(ini_get('zlib.output_compression'))
  ini_set('zlib.output_compression', 'Off');
 
$file_extension = strtolower(substr(strrchr($filename,"."),1));
if( $filename == "" )
{
          echo "ОШИБКА: не указано имя файла.";
          exit;
} elseif ( ! file_exists($_SERVER['DOCUMENT_ROOT'].'/price_provider/'. $filename ) ) // проверяем существует ли указанный файл
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