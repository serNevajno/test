<?
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    error_reporting(0);
    session_start();
    include($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
    /////Подключение библиотеки
    include($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/function.inc.php');
    include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/uploadProduct/upFunc.inc.php');
    include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/uploadProduct/apiKolesaDarom.php');


    $delivery = clearData($_POST["delivery"], "i");

    $res = '<label class="control-label"><b>Адрес доставки:</b></label><select class="form-control" name="address" required>';

    if($delivery == "0"){
        $result = kd::stores("qqQSLo8byljcAPH6mJ7lc0KgFtL9NoFP");
        $result = json_decode($result, true);

        foreach ($result as $item){
            $res.= '<option value="'.$item[id].'">'.$item[address].'</option>';
        }

    }elseif($delivery == "1") {
        $result = kd::addresses("qqQSLo8byljcAPH6mJ7lc0KgFtL9NoFP");
        $result = json_decode($result, true);
        foreach ($result as $item) {
            $res .= '<option value="' . $item[id] . '">' . $item[address] . '</option>';
        }
    }
    echo $res.= '</select>';
}
?>