<?
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    error_reporting(0);

    include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/uploadProduct/apiKolesaDarom.php');

    $id = clearData($_POST["id"], "i");
    $delivery = clearData($_POST["delivery"], "i");
    $address = clearData($_POST["address"], "i");
    $comment = clearData($_POST["comment"]);
    $reserve = clearData($_POST["reserve"]);
    $temp = db2array("SELECT t1.product_id, t1.id_order, t1.quantity, t1.price, t2.article, t1.price_clear FROM order_product as t1 LEFT JOIN product as t2 on(t1.product_id=t2.id) WHERE t1.id='$id' AND nzsp=''");
    if($temp) {
        $result_prod = kd::search("qqQSLo8byljcAPH6mJ7lc0KgFtL9NoFP", array("kod_proizvoditelya" => array(0 => $temp["article"])));
        $result_prod = json_decode($result_prod, true);

        $result = kd::order("qqQSLo8byljcAPH6mJ7lc0KgFtL9NoFP", array(
            "test" => "0",
            "return_on_success" => "1",
            "generate_reference" => "1",
            "shipping" => $delivery,
            "user_location" => $address,
            "comment" => $temp["id_order"],
            "reserve" => $reserve,
            "orderPositions" => array(0 => array(
                "goods_id" => $result_prod[0][goods_id],
                "price" => $temp["price_clear"],
                "quantity" => $temp["quantity"]
            ))

        ));

        $result = json_decode($result, true);

        if ($result["status"] == "Success") {
            $nzsp = $result[orders][0][order_id];
            mysql_query("UPDATE `order_product` SET `nzsp`='$nzsp' WHERE id='$id'");
            header("Location: /adminius/index.php?code=orders&action=edit&id=" . $temp["id_order"]);
            exit();
        } elseif ($result["status"] == "Error") {
            foreach ($result["orderPositions"][0]["errorMessage"] as $key => $item) {
                $res = $key . ": " . $item;
            }
            header("Location: /adminius/index.php?code=orders&action=edit&id=" . $temp["id_order"] . "&error=" . $res . "&error_code=" . $temp["article"]);
            exit();
        }
    }

}
?>