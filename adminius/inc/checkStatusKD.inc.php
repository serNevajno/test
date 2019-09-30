<?php
if($_SERVER["REQUEST_METHOD"]=="POST") {
    include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
    include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
    include ($_SERVER['DOCUMENT_ROOT'].'/inc/apiFunc.inc.php');
    include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/uploadProduct/apiKolesaDarom.php');

    $order = clearData($_POST["order"]);
    //$order = 'F635931';

    $result = kd::motion("qqQSLo8byljcAPH6mJ7lc0KgFtL9NoFP", array(
        "order_id" => $order
    ));
    $result = json_decode($result, true);
    echo $result[0]["statusTxt"];
}
?>