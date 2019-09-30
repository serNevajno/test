
<?php
error_reporting(0);
session_start();
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/function.inc.php');
//include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/uploadProduct/upFunc.inc.php');
include ($_SERVER['DOCUMENT_ROOT'].'/inc/apiFunc.inc.php');

/*$temp = db2array("SELECT t3.id, t1.name as model, t2.name as marka, t3.year_begin, t3.year_end FROM searchYearAvto as t3 LEFT JOIN searchModelAvto as t1 on(t3.model=t1.id) LEFT JOIN searchMarkaAvto as t2 on(t1.marka=t2.id)", 2);
foreach ($temp as $items) {
    $client = new SoapClient(SOAP_CLIENT);
    $params = array
    (
        'login' => SOAP_LOGIN,
        'password' => SOAP_PASS,
        'marka' => $items[marka],
        'model' => $items[model],
        'year_beg' => $items[year_begin],
        'year_end' => $items[year_end]
    );
    $answer = $client->GetModificationAvto($params);

    $mod = $answer->GetModificationAvtoResult->modification_list->string;

    if(count($mod)=='1'){
        mysql_query("INSERT INTO `searchModificationAvto`(`name`, `year_id`) VALUES ('$mod', '$items[id]')");
    }else{
        foreach ($mod as $item) {
            mysql_query("INSERT INTO `searchModificationAvto`(`name`, `year_id`) VALUES ('$item', '$items[id]')");
        }
    }
}*/
$client = new SoapClient(SOAP_CLIENT);
$params =  array
(
    'login' => SOAP_LOGIN,
    'password' => SOAP_PASS,
    'filter' => array(
        'marka' => 'УАЗ',
        'model' => 'Patriot',
        'modification' => '2.3',
        'year_beg' => '2014',
        'year_end' => '0',
        'podbor_type' => array(0 => 1, 1 => 2, 2 => 3),
        'type' => array(0 => 'tire', 1 => 'disk'),
    ),
);
$answer = $client->GetGoodsByCar($params);

echo "<pre>";
print_r($answer);
echo "</pre>";
?>