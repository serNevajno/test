<?
    if (!empty($_COOKIE['sid'])) {
      session_id($_COOKIE['sid']);
    }
    session_start();
    include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
    include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/function.inc.php');
    include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/uploadProduct/upFunc.inc.php');
    /////Замок
    include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/lock.inc.php');

	 @mysql_query('set character_set_client="utf8"');
	 @mysql_query('set character_set_results="utf8"');
	 @mysql_query('set collation_connection="utf8_general_ci"');

    $nameFile = "uploadFile.csv";

    if(!setlocale(LC_ALL, 'ru_RU.utf8')) setlocale(LC_ALL, 'en_US.utf8'); // Определяем параметры локали
    if(setlocale(LC_ALL, 0) == 'C') die('Локали не поддерживаются сервером. Возможно некорректное отображение кириллицы.');

    $file = fopen('php://memory', 'w+');
    fwrite($file, iconv('CP1251','UTF-8', file_get_contents($_SERVER["DOCUMENT_ROOT"]."/price_provider/".$nameFile)));
    rewind($file);
	$date = date("Y-m-d H:i:s");
    $r = 1;
    $cStart = $_POST["count"];
    $filter= $_POST["filter"];
    $cat = $_POST["cat"];
    $cEnd = $cStart + 100;
    $qFilter = "";
    $arrFilter = array();
while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
    if($r == '1'){
        for ($i = 0; $i < count($data); $i++) {
           if($i>6){
               $fil = explode("-id:", $data[$i]);
               if($i == 8) $qf = " OR ";
               $qFilter.= $qf."id='".$fil[1]."'";
               $arrFilter[$i] = $fil[1];
           }
        }

      $temp = db2array("SELECT categories FROM filter WHERE ".$qFilter." GROUP BY categories");
    }elseif ($r > $cStart AND $r<$cEnd) {
        if(!empty($data[0])) {
            $data[0] = mysql_escape_string($data[0]);
            $data[1] = mysql_escape_string($data[1]);
            $data[2] = mysql_escape_string($data[2]);
            $data[3] = mysql_escape_string($data[3]);
            $data[4] = mysql_escape_string($data[4]);
            $data[5] = mysql_escape_string($data[5]);
            $data[6] = mysql_escape_string($data[6]);
            $prd = db2array("SELECT id, categories FROM product WHERE article='$data[0]'");
            if($filter!='1') {
                if (selectFilterCat($prd["categories"]) == $temp["categories"]) {
                    foreach ($arrFilter as $key => $value) {
                        $elementId = selectFilterElementByValue(str_replace(",", ".", $data[$key]), $value);
                        if ($elementId > 0) {
                            mysql_query("UPDATE filter_value SET element_value='$elementId' WHERE id_product='$prd[id]' AND id_filter='$value'");
                        }
                    }
                }
            }
            $idProd = chekcArticleProduct($data[0]);
            if($idProd) {
                $sql = "UPDATE product SET name='$data[1]', price='$data[2]', sale='$data[3]', availability='$data[4]', logistic='$data[5]' WHERE article='" . $data[0] . "';";
                mysql_unbuffered_query($sql) or die(mysql_error());
            }else{
                $code = greateLink($data[1]);
                //mysql_query("INSERT INTO `product`(`title`, `h1`, `name`, `sale`, `categories`, `availability`, `active`, `date`, `code`, `price`, `logistic`, `article`) VALUES ('$data[1]', '$data[1]', '$data[1]', '$data[3]', '$cat', '$data[4]', '1', '$date', '$code', '$data[2]', '$data[4]', '$data[0]')");
            }
        }
	}
	$r++;
}

    fclose($file);
echo $cEnd;
?>