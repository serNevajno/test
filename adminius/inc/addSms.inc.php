<?
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_order = clearData($_POST['id_order'], "i");
    $text = clearData($_POST['text']);
    $phone = clearData($_POST['phone']);

    //$text = str_replace("#name#", $name, $text);
    $text = str_replace("#nomer#", $id_order, $text);
    $text = str_replace("#sum#", sumOrderReal($id_order), $text);

    sendSMS($phone, $text, $id_order);

    header('Location: /adminius/index.php?code=orders&action=edit&id='.$id_order.'#tab_1');
    exit;

} ?>