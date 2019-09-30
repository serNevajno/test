<?
$name = explode(".",$_FILES["tires"]["name"]);
if($name[1] == "csv") {
    if ($_POST["type"] == "1") {
        $nameFile = "provider3tyres.csv";
    } elseif ($_POST["type"] == "2") {
        $nameFile = "provider3disk.csv";
    } elseif ($_POST["type"] == "3") {
        $nameFile = "provider4tyres.csv";
    } elseif ($_POST["type"] == "4") {
        $nameFile = "provider4disk.csv";
    } elseif ($_POST["type"] == "5") {
        $nameFile = "provider5tyres.csv";
    } elseif ($_POST["type"] == "6") {
        $nameFile = "provider5disk.csv";
    } elseif ($_POST["type"] == "7") {
        $nameFile = "provider5TolDisk.csv";
    } elseif ($_POST["type"] == "8") {
        $nameFile = "provider7Tyres.csv";
    } elseif ($_POST["type"] == "9") {
        $nameFile = "provider7Disk.csv";
    } elseif ($_POST["type"] == "10") {
        $nameFile = "provider8Tyres.csv";
    } elseif ($_POST["type"] == "11") {
        $nameFile = "provider8Disk.csv";
    } elseif ($_POST["type"] == "all1") {
      $nameFile = "AllTyres.csv";
    } elseif ($_POST["type"] == "all2") {
      $nameFile = "AllDisk.csv";
    }

    @mysql_query('set character_set_client="utf8"');
    @mysql_query('set character_set_results="utf8"');
    @mysql_query('set collation_connection="utf8_general_ci"');

    if (copy($_FILES["tires"]["tmp_name"], $_SERVER['DOCUMENT_ROOT']."/price_provider/" . $nameFile)) {
        if (!setlocale(LC_ALL, 'ru_RU.utf8')) setlocale(LC_ALL, 'en_US.utf8');
        $file = fopen('php://memory', 'w+');
        fwrite($file, iconv('CP1251', 'UTF-8', file_get_contents($_SERVER['DOCUMENT_ROOT']."/price_provider/".$nameFile)));
        rewind($file);
        $r = 1;
        $data = fgetcsv($file, 1000, ";");

        if (($_POST["type"] == "1" AND $data[0] == "tyres3") OR ($_POST["type"] == "2" AND $data[0] == "disk3") OR ($_POST["type"] == "3" AND $data[0] == "tyres4") OR ($_POST["type"] == "4" AND $data[0] == "disk4") OR ($_POST["type"] == "5" AND $data[0] == "tyres5") OR ($_POST["type"] == "6" AND $data[0] == "disk5") OR ($_POST["type"] == "7" AND $data[0] == "disk5tol") OR ($_POST["type"] == "8" AND $data[0] == "tyres7") OR ($_POST["type"] == "9" AND $data[0] == "disk7") OR ($_POST["type"] == "10" AND $data[0] == "tyres8") OR ($_POST["type"] == "11" AND $data[0] == "disk8") OR ($_POST["type"] == "all1" AND $data[0] == "allTyres") OR ($_POST["type"] == "all2" AND $data[0] == "allDisk")) {
            while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
                $r++;
            }
            fclose($file);
            $mess = $r;
        }
    } else {
        $mess = 0;
    }
}
echo $mess;
?>