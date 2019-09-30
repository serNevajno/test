<?if ($_SERVER["REQUEST_METHOD"] == "POST") {
    error_reporting(0);
    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php');
    /////Подключение библиотеки
    include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/function.inc.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/uploadProduct/upFunc.inc.php');

    /////Замок
    include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/lock.inc.php');
    $aRes = array();
    /*$arr = file_get_contents("http://online.shininvest.ru/Online8/robot.php?type=tires&login=13828&pwd=82EEEC044FDBEDF4D0E4C42CB6B06C73");
    $res = json_decode($arr, TRUE);*/

    $cStart = $_POST["count"];
    $res = db2array("SELECT * FROM bufer_shs WHERE `type`='2' LIMIT $cStart, 50", 2);

    /* echo "<pre>";
     print_r($res);
     echo "</pre>";*/

    $cEnd = $cStart + 50;
    foreach ($res as $item){
              $id_provider = '9';
              $itemPr = selectProductByArtiсleForCSV($item["code"], 2);
              if ($itemPr) {
                  $price = getPriceProvide("2", $itemPr["brand"], $itemPr["diameter"], "", $item["price"], $id_provider); ///Розничная цена
                  $availability = $item["quantity"]; ///Итого
                  $logistic = 1;

                  addProduct($id_provider, "2", $item["code"], $price, $item["price"], $logistic, $availability, "", "", "", "", "");
              }else{
                  $aRes["article"].=$article."<br>";
              }
    }
    //$aRes["count"] = $cEnd;
    //echo json_encode($aRes);
    echo $cEnd;
}?>