<?php
session_start();
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');

$arr = array();
function sProductWorkPlace($s='', $b='', $r='', $a='', $sh=''){
  /*global $posts;
  global $start;*/

  $query = '';
  if(!empty($s)){
    if (!empty($query)) $query .= " AND";
    $query .= " t1.name LIKE '$s%'";
  }
  if(!empty($b)){
    if (!empty($query)) $query .= " AND";
    $query .= " t1.name LIKE '%$b%'";
  }
  if(!empty($r)){
    if (!empty($query)) $query .= " AND";
    $res = explode("R", $r);
    $query .= " (t1.name LIKE '%$res[0]R$res[1]%' OR t1.name LIKE '%$res[0] R$res[1]%' OR t1.name LIKE '%$res[0]ZR$res[1]%' OR t1.name LIKE '%R$res[1] $res[0]%')";
  }

  if(!empty($a)){
    if (!empty($query)) $query .= " AND";
    $query .= " t1.article = '$a' AND t4.section='1'";
  }

  if(!empty($sh)){
    if (!empty($query)) $query .= " AND";
    if($sh == '1') {
      $query .= " t2.element_value = '158' AND t2.id_filter = '24'";
    }elseif ($sh == '2'){
      $query .= " t2.element_value = '159' AND t2.id_filter = '24'";
    }
  }

  if(!empty($query)){
    $query = "WHERE".$query." AND t1.availability > 0 AND t1.active = 1";
  }

  /*$posts = selectCount("product as t1 LEFT JOIN filter_value as t2 on (t1.id = t2.id_product) $query");
  $start = strNav($page, $num, $posts);*/
  /*echo "SELECT t1.name, t1.id, t1.article FROM product as t1 LEFT JOIN filter_value as t2 on (t1.id = t2.id_product) $query GROUP BY t1.id ORDER BY price ASC";*/

  return db2array("SELECT t1.name, t1.id, t1.article 
                  FROM product as t1 
                  LEFT JOIN filter_value as t2 on (t1.id = t2.id_product) 
                  LEFT JOIN categories as t3 on(t1.categories=t3.id)
                  LEFT JOIN categories as t4 on(t3.section=t4.id)
                  $query GROUP BY t1.id ORDER BY price ASC", 2);
}

function sProviderById($id){
  return db2array("SELECT t1.price, t1.price_clear, t1.logistic, t1.id_provider, t1.availability, t2.name as name_provider FROM price_provider as t1 LEFT JOIN provider as t2 on (t1.id_provider = t2.id) WHERE t1.id_product = '$id' AND t1.availability > 0 ORDER BY t1.price ASC", 2);
}

$sezon = clearData($_POST['sezon'], "i");
$brend = clearData($_POST['brend']);
$razmer = clearData($_POST['razmer']);
$articul = clearData($_POST['articul']);
$ship = clearData($_POST['ship'], "i");

switch ($sezon){
  case 1: $s = 'Летняя шина'; break;
  case 2: $s = 'Зимняя шина'; break;
  case 3: $s = 'Всесезонная шина'; break;
}

$shirina = substr($razmer, 0, 3);
$visota = substr($razmer, 3, 2);
$radius = substr($razmer, -2);



$sWeightTyres = selectWeightTyres($shirina, $visota, $radius);
$arr['weight'] = $sWeightTyres["weight_4"];
$arr['scope'] = $sWeightTyres["scope_4"];

/*$get_url = "https://dobrayashina.ru/adminius/test/kladr.php?weight=".$arr['weight']."&scope=".$arr['scope'];
$arr['modal'] = file_get_contents($get_url);*/

/*$arr['modal'] = '
<div class="modal fade" id="modalKladr" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="margin: unset; width: unset; ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
      </div>
      <div class="modal-body">
        <script>
          var pec_goods = [],
            pec_informer_size = "horizontal", // тип информера
            pec_from = "-455", // город отправки
            pec_to = "auto", // город доставки
            pec_insurance = "", // сумма для страхования
            pec_packing = ""; // тип упаковки
            pec_goods[0] = "0/0/0/'.$arr['scope'].'/'.$arr['weight'] .'";  // габариты, объем, вес
        </script>

      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
';*/

if($shirina and $visota and $radius) {
  $r = $shirina . "/" . $visota . "R" . $radius;
}

$sProd = sProductWorkPlace($s, $brend, $r, $articul, $ship);


foreach ($sProd as $item){
  $provider = '
              <table class="table table-bordered table-striped table-condensed flip-content">
                <thead class="flip-content">
                <tr>
                  <th> Поставщик </th>
                  <th> Цена </th>
                  <th> За 4 шт.</th>
                  <th > Закуп </th>
                  <th > Доставка </th>
                  <th > Кол-во </th>
                  <th > Действие </th>
                </tr>
                </thead>
                <tbody>
   ';
  foreach (sProviderById($item['id']) as $items){
    $provider .= '
              <tr>
                <td >'.$items['name_provider'].'</td>
                <td >'.$items['price'].'</td>
                <td >'.($items['price']*4).'</td>
                <td >'.$items['price_clear'].'</td>
                <td >'.$date = date('d.m.Y', strtotime('+' . countingDay($items["logistic"]) . ' days')).'</td>
                <td >'.$items['availability'].'</td>
                <td > <button class="btn btn-xs yellow" data-toggle="modal" data-target="#newOrderWorkPlace" onclick="addBasketWorkPlace('.$item[id].', '.$items[id_provider].')" id="btn-modal">Создать заказ</button></td>
              </tr>
    ';
  }
  $provider .= '</tbody>
      </table>';
  $arr['res'] .= '
    <tr>
      <td>
        '.$item['article'].'<br>
        <button class="btn btn-xs blue" data-toggle="modal" data-target="#combineProd" onclick="combineProdModal('.$item[id].')" id="btn-modal">Объединить</button>
      </td>
      <td>
        '.$item['name'].'
        <br>
        <a data-toggle="modal" data-target="#modalKladr" style="cursor: pointer;">Просчитать стоимость доставки</a>
      </td>
      <td>
        '.$provider.'
      </td>
    </tr>
  ';

}

echo json_encode($arr);