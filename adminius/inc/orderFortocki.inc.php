<?
if($_SERVER["REQUEST_METHOD"]=="POST") {
    include($_SERVER['DOCUMENT_ROOT'] . '/inc/apiFunc.inc.php');

    function getWhId($code, $quantity, $id)
    {
        $client = new SoapClient(SOAP_CLIENT);
        $params = array
        (
            'login' => SOAP_LOGIN,
            'password' => SOAP_PASS,
            'filter' => array(
                'code_list' => array(0 => $code),
            ),
            'page' => 0,
        );
        $answer = $client->GetFindTyre($params);

        if($answer->GetFindTyreResult->price_rest_list->TyrePriceRest) {
            $sklad = array();
            foreach ($answer->GetFindTyreResult->price_rest_list->TyrePriceRest->whpr->wh_price_rest as $item) {
                if ($item->rest >= $quantity) {
                    $sklad[] = $item->wrh;
                }
            }

            $whId = 0;
            $minDay = 777;
            foreach ($answer->GetFindTyreResult->warehouseLogistics->WarehouseLogistic as $i_wr) {
                if (in_array($i_wr->whId, $sklad)) {
                    if ($minDay > $i_wr->logistDays) {
                        $minDay = $i_wr->logistDays;
                        $whId = $i_wr->whId;
                    }
                }
            }
            return $whId;
        }else{
            header("Location: /adminius/index.php?code=orders&action=edit&id=" . $id . "&error_text=Товар не найден в базе поставщика&error_prod=;&error_code=" . $code);
            exit();
        }
    }

    $article = clearData($_POST["article"]);
    ///$article = 0;
    $productOrder_id = clearData($_POST["productOrder_id"]);
    $quantity = clearData($_POST["quantity"]);
    $id = clearData($_POST["id"]);
    $whId = getWhId($article, $quantity, $id);
    if($whId>0) {
        $client = new SoapClient(SOAP_CLIENT);

        $orderProducts[0] = array(
            "code" => $article,
            "quantity" => $quantity,
            "wrh" => $whId
        );

        $params = array
        (
            'login' => SOAP_LOGIN,
            'password' => SOAP_PASS,
            'order' => $order = array
            (
                'product_list' => $orderProducts,
                'is_test' => "0",
                "comment" => $id . " Готов ждать"
            ),
        );
        $answer = $client->CreateOrder($params);
        $nzsp = $answer->CreateOrderResult->orderNumber;
        if ($answer->CreateOrderResult->success == "1") {
            mysql_query("UPDATE `order_product` SET `nzsp`='$nzsp' WHERE id='$productOrder_id'");
            header("Location: /adminius/index.php?code=orders&action=edit&id=" . $id);
            exit();
        } else {
            /*echo "<pre>";
            print_r($answer);
            echo "</pre>";*/
            $error_text = $answer->CreateOrderResult->error->comment;
            $error_prod = $answer->CreateOrderResult->error_product_list->OrderProductError->err;
            switch ($answer->CreateOrderResult->error_product_list->OrderProductError->err) {
                case 1:
                    $error_prod = "Отсутствует цена по товару на этом складе.";
                    break;
                case 2:
                    $error_prod = "Не найден товар с таким кодом САЕ.";
                    break;
                case 3:
                    $error_prod = "Указан недоступный склад.";
                    break;
                case 4:
                    $error_prod = "Количество заказываемого товара (order.product_list.quantity) должно быть больше 0.";
                    break;
            }
            header("Location: /adminius/index.php?code=orders&action=edit&id=" . $id . "&error_text=" . $error_text . "&error_prod=" . $error_prod . "&error_code=" . $answer->CreateOrderResult->error_product_list->OrderProductError->code);
            exit();
        }
    }else{
        header("Location: /adminius/index.php?code=orders&action=edit&id=" . $id . "&error_text=Недоступное количество&error_code=" . $article);
        exit();
    }
}
?>