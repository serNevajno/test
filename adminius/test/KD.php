<?
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
    //error_reporting(1);
    session_start();

    include($_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php');
    /////Подключение библиотеки
    include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/function.inc.php');
    include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/uploadProduct/upFunc.inc.php');
    include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/uploadProduct/apiKolesaDarom.php');
    /////Замок
 echo "ok3";
    $article = array();
    $arrNewProd = array();
    $article[] = "TS31879";

    $result = kd::search("qqQSLo8byljcAPH6mJ7lc0KgFtL9NoFP", array("kod_proizvoditelya" => $article));
    $result = json_decode($result, true);
    print_r($result);

    $arrSklad = array("Челябинск, Свердловский тракт, 3/2(Самовывоз)", "Склад НЧ", "Склад ЕМЖ");
    echo "<pre>".print_r($result, true)."</pre>";
    echo "ok3";
    foreach($result as $item){
        foreach($item['quantity_in_stock'] as $akk){
            if (in_array($akk['stockName'], $arrSklad)) {
              echo $akk['stockName'] . "<br>";
            }
        }
    }
?>