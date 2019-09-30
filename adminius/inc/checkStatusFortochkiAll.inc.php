<?php
if($_SERVER["REQUEST_METHOD"]=="POST") {
  include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
  include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
  include ($_SERVER['DOCUMENT_ROOT'].'/inc/apiFunc.inc.php');
  include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/uploadProduct/apiKolesaDarom.php');

  $provider = clearData($_POST['provider'], 'i');
  $canceled = clearData($_POST['canceled'], 'i');
  $fulfilled = clearData($_POST['fulfilled'], 'i');
  $from = clearData($_POST['from']);
  $to = clearData($_POST['to']);
  $arr = array();

  function sOrderProductByIdProv($provider, $from, $to, $canceled, $fulfilled){
    /*global $posts;
    global $start;*/

    if ($from and $to) {
      $query_search .= "AND t2.date>='$from 00:00:00' AND t2.date<='$to 23:59:59' ";
    }

    /*if($fulfilled == '1'){
      $query_search .= "AND t2.id_status !='1' ";
    }

    if($canceled == '1'){
      $query_search .= "AND t2.id_status !='3' ";
    }*/

    /*$temp = db2array("SELECT COUNT(DISTINCT t1.id) as kol FROM order_product as t1  WHERE t1.provider='$provider' AND t1.nzsp != '' $query_search");
    $posts = $temp["kol"];
    $start = strNav($page, $num, $posts);*/

    return db2array("SELECT t1.id_order, t2.date, t1.name, t1.nzsp FROM order_product as t1 LEFT JOIN orders as t2 on (t1.id_order = t2.id) WHERE t1.provider='$provider' AND t1.nzsp != '' AND t2.id_status IN (5, 11, 2, 6, 7) $query_search ORDER BY t1.id_order ASC", 2);
  }

  if($provider == 1) {
    $client = new SoapClient(SOAP_CLIENT);
  }
  $tr = '';
  foreach (sOrderProductByIdProv($provider, $from, $to, $canceled, $fulfilled) as $item) {
    //$order = clearData($_POST["order"]);
    //$order = 'F051473';
    if($provider == 1) {
      $params = array
      (
        'login' => SOAP_LOGIN,
        'password' => SOAP_PASS,
        'orderNumber' => $item['nzsp'],
      );

      $answer = $client->GetOrderInfo($params);
      /*echo "<pre>";
      print_r($answer->GetOrderInfoResult->goods->Goods->wrh);
      echo "</pre>";*/
      $nomer = $answer->GetOrderInfoResult->goods->Goods->wrh;
      if ($answer->GetOrderInfoResult->statusName) {
        $statusName = $answer->GetOrderInfoResult->statusName . ". Склад: " . $nomer;
      }
    }elseif ($provider == 2){
      $result = kd::motion("qqQSLo8byljcAPH6mJ7lc0KgFtL9NoFP", array(
        "order_id" => $item['nzsp']
      ));
      $result = json_decode($result, true);
      $statusName = $result[0]["statusTxt"];
    }

    $tr .= '
      <tr>
        <td>'.$item[date].'</td>
        <td><a href="https://dobrayashina.ru/adminius/index.php?code=orders&action=edit&id='.$item[id_order].'" target="_blank">'.$item[id_order].'</a></td>
        <td>'.$item[name].'</td>
        <td>'.$statusName.'</td>
      </tr>
    ';
  }

  if($tr != ''){
    $arr['tr'] = $tr;
  }else{
    $arr['tr'] = 'no result!';
  }
  echo json_encode($arr);
}