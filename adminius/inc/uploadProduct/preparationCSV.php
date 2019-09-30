<?php
    $arr = array();
    $i = 0;

    $arr += array($i => array(
        "article" => "Код",
        "width" => "Ширина",
        "heigth" => "Высота",
        "diameter" => "Диаметр",
        "brand" => "Бренд",
        "model" => "Модель",
        "season" => "Сезон",
        "price" => "Цена",
        "stock_ch" => "Челябинск",
        "stock_vs" => "Всеволожск"
    ));
    foreach ($arr[0] as $key => $string) {
        $arr[0][$key] = iconv("utf-8", "cp1251", $string);
    }

    @mysql_query('set character_set_client="utf8"');
    @mysql_query('set character_set_results="utf8"');
    @mysql_query('set collation_connection="utf8_general_ci"');

    if (copy($_FILES["tires"]["tmp_name"], $_SERVER["DOCUMENT_ROOT"] . "/preCSV.csv")) {
        if (!setlocale(LC_ALL, 'ru_RU.utf8')) setlocale(LC_ALL, 'en_US.utf8');
        $file = fopen('php://memory', 'w+');
        fwrite($file, iconv('CP1251', 'UTF-8', file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/preCSV.csv")));
        rewind($file);
        $i = 1;
        $data = fgetcsv($file, 1000, ";");
        while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
            if($i>1) {
                    $article = mysql_escape_string($data[0]);
                    $ex = explode(" ", mysql_escape_string($data[1]));
                    $model = "";
                    for ($is = 5; $is <= count($ex); $is++) {
                        $model = $model . " " . $ex[$is];
                    }
                    $tr = explode("/", $ex[0]);

                    $arr += array($i => array(
                        "article" => $article,
                        "width" => $tr[0],
                        "heigth" => $tr[1],
                        "diameter" => $ex[2],
                        "brand" => $ex[4],
                        "model" => $model,
                        "season" => mysql_escape_string($data[2]),
                        "price" => mysql_escape_string($data[3]),
                        "stock_ch" => mysql_escape_string($data[4]),
                        "stock_vs" => mysql_escape_string($data[5])
                    ));
            }
            $i++;
        }
        fclose($file);
    }

$f = fopen('preCSVend.csv', 'w');
foreach ($arr as $item) {
    fputcsv($f, $item, ';');
}
fclose($f);

$filename = "preCSVend.csv";
// нужен для Internet Explorer, иначе Content-Disposition игнорируется
if(ini_get('zlib.output_compression'))
    ini_set('zlib.output_compression', 'Off');

$file_extension = strtolower(substr(strrchr($filename,"."),1));
if( $filename == "" )
{
    echo "ОШИБКА: не указано имя файла.";
    exit;
} elseif ( ! file_exists( $filename ) ) // проверяем существует ли указанный файл
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
readfile("$filename");
exit();
?>