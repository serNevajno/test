<?
$nameFile = "uploadFile.csv";
@mysql_query('set character_set_client="utf8"');
@mysql_query('set character_set_results="utf8"');
@mysql_query('set collation_connection="utf8_general_ci"');

if (copy($_FILES["product"]["tmp_name"], $_SERVER["DOCUMENT_ROOT"]."/price_provider/".$nameFile)) {
    if(!setlocale(LC_ALL, 'ru_RU.utf8')) setlocale(LC_ALL, 'en_US.utf8');
    $file = fopen('php://memory', 'w+');
    fwrite($file, iconv('CP1251','UTF-8', file_get_contents($_SERVER["DOCUMENT_ROOT"]."/price_provider/".$nameFile)));
    rewind($file);
    $r = 1;

    while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
        $r++;
    }
    fclose($file);
    $mess = $r;
} else {
    $mess = 0;
}
echo $mess;
?>