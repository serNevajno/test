<?/*
header("Content-Type: text/html; charset=UTF-8");
//////Подключение к базе
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
/////Подключение библиотеки
include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/function.inc.php');

@mysql_query('set character_set_client="utf8"');
@mysql_query('set character_set_results="utf8"');
@mysql_query('set collation_connection="utf8_general_ci"');
if(!setlocale(LC_ALL, 'ru_RU.utf8')) setlocale(LC_ALL, 'en_US.utf8');

$file = fopen('php://memory', 'w+');
fwrite($file, iconv('CP1251','UTF-8', file_get_contents($_SERVER['DOCUMENT_ROOT']."/price_provider/moto.csv")));
rewind($file);
$r = 1;

while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
  if($r>6) {
    ///echo "<pre>".print_r($data)."</pre>";
    $title = mysql_escape_string($data[1]);
    $price = mysql_escape_string($data[19]);
    $price_clear = mysql_escape_string($data[20]);
    $availability = mysql_escape_string($data[18]);
    $article = mysql_escape_string($data[11]);
    $code = greateLink($title);
    $date = date("Y-m-d H:i:s");
    $sql = "INSERT INTO product (active, main, title, meta_k, meta_d, name, related, description, price, price_clear, sale, categories, priority, availability, img, date, user_id, provider, warranty, attention, gift, code, youtube_url, logistic, article) VALUES ('1', '0', '$title', '', '$title', '$title', '', '', '$price', '$price_clear', '0', '17583', '0', '$availability', '', '$date', '2', '0', '0', '0', '0', '$code', '', '1', '$article')";
    mysql_query($sql) or die(mysql_error());;
    $id_product = mysql_insert_id();

    $brand = mysql_escape_string($data[3]);
    $brand_id = db2array("SELECT id FROM `element_filter` WHERE `value`='$brand' AND `id_filter`='44'");
    if($brand_id) {
      mysql_query("INSERT INTO `filter_value`(`id_filter`, `element_value`, `id_product`, `id_model`) VALUES ('44', '$brand_id[id]', '$id_product', '0')");
    }else{
      echo "Нету бренда ".$brand;
    }

    $width = str_replace(",", ".", mysql_escape_string($data[9]));
    $seWidth = strripos($width, ".");
    if($seWidth === false){

    }else{
      $width= number_format($width, 2, '.', '');
    }
    $height = mysql_escape_string($data[10]);
    $diametr = str_replace(",", ".", mysql_escape_string($data[8]));
    ////////////////////////
    $width_id = db2array("SELECT id FROM `element_filter` WHERE `value`='$width' AND `id_filter`='45'");
    if($width_id) {
      mysql_query("INSERT INTO `filter_value`(`id_filter`, `element_value`, `id_product`, `id_model`) VALUES ('45', '$width_id[id]', '$id_product', '0')");
    }else{
      echo "Нету ширины ".$width."<br>";
    }
    ////////////////////////
    $height_id = db2array("SELECT id FROM `element_filter` WHERE `value`='$height' AND `id_filter`='46'");
    if($height_id) {
      mysql_query("INSERT INTO `filter_value`(`id_filter`, `element_value`, `id_product`, `id_model`) VALUES ('46', '$height_id[id]', '$id_product', '0')");
    }else{
      echo "Нету высоты ".$height."<br>";
    }
    /////////////////////////
    $diametr_id = db2array("SELECT id FROM `element_filter` WHERE `value`='$diametr' AND `id_filter`='47'");
    if($diametr_id) {
      mysql_query("INSERT INTO `filter_value`(`id_filter`, `element_value`, `id_product`, `id_model`) VALUES ('47', '$diametr_id[id]', '$id_product', '0')");
    }else{
      echo "Нету диаметра ".$diametr."<br>";
    }
    /////////////////////////
    $os = str_replace(" ","", mysql_escape_string($data[5]));
    $os_id = db2array("SELECT id FROM `element_filter` WHERE `value`='$os' AND `id_filter`='48'");
    if($os_id) {
      mysql_query("INSERT INTO `filter_value`(`id_filter`, `element_value`, `id_product`, `id_model`) VALUES ('48', '$os_id[id]', '$id_product', '0')");
    }else{
      echo "Нету оси ".$os."<br>";
    }
    /////////////////////////
    $primenyaemost = mysql_escape_string($data[6]);
    $primenyaemost_id = db2array("SELECT id FROM `element_filter` WHERE `value`='$primenyaemost' AND `id_filter`='49'");
    if($primenyaemost_id) {
      mysql_query("INSERT INTO `filter_value`(`id_filter`, `element_value`, `id_product`, `id_model`) VALUES ('49', '$primenyaemost_id[id]', '$id_product', '0')");
    }else{
      echo "Нету применяемости ".$primenyaemost."<br>";
    }
    /////////////////////////
    $sezon = mysql_escape_string($data[7]);
    $sezon_id = db2array("SELECT id FROM `element_filter` WHERE `value`='$sezon' AND `id_filter`='50'");
    if($sezon_id) {
      mysql_query("INSERT INTO `filter_value`(`id_filter`, `element_value`, `id_product`, `id_model`) VALUES ('50', '$sezon_id[id]', '$id_product', '0')");
    }else{
      echo "Нету применяемости ".$sezon."<br>";
    }
    /////////////////////////
    //echo "<br>";
  }
  $r++;
}
fclose($file);
*/?>