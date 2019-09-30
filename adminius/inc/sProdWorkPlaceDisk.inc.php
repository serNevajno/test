<?php
session_start();
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');


function sProviderById($id){
  return db2array("SELECT t1.price, t1.price_clear, t1.logistic, t1.id_provider, t1.availability, t2.name as name_provider FROM price_provider as t1 LEFT JOIN provider as t2 on (t1.id_provider = t2.id) WHERE t1.id_product = '$id' AND t1.availability > 0 ORDER BY t1.price ASC", 2);
}
function selectFilId($id_filter, $value){
  $temp = db2array("SELECT id FROM `element_filter` WHERE `id_filter`='$id_filter' AND value='$value'");
  return $temp["id"];
}
$brand = clearData($_POST['brand']);
$razmer = clearData($_POST['razmer']);
$articul = clearData($_POST['articul']);

$diametr = substr($razmer, 0, 2);
$bolt = substr($razmer, 2, 1);

if(strlen($razmer) == "7"){
  $width_bolt = substr($razmer, 3, 5);
  $width_bolt_end= substr($width_bolt, 0, 3).".".substr($width_bolt, 3, 1);
}else{
  $width_bolt_end = substr($razmer, 3, 3);
}
$arr = array();
$pcd = $bolt."x".$width_bolt_end;
$idDiametr = selectFilId("25", $diametr);
$idPcd = selectFilId("27", $pcd);
$sWeightDisk = selectWeightDisk($diametr);
$arr['weight'] = $sWeightDisk["weight_4"];
$arr['scope'] = $sWeightDisk["scope_4"];


$query = '';

if(!empty($idDiametr)){
  if (!empty($query)) $query .= " AND";
  $query .= " t2.element_value = '".$idDiametr."'";
}
if(!empty($idPcd)){
  if (!empty($query)) $query .= " AND";
  $query .= " t3.element_value = '".$idPcd."'";
}
if(!empty($articul)){
  if (!empty($query)) $query .= " AND";
  $query .= " t1.article = '$articul' AND t5.section='2'";
}
if(!empty($brand)){
  if (!empty($query)) $query .= " AND";
  $query .= " t4.section = '$brand'";
}
if(!empty($query)){
  $query = "WHERE".$query." AND t1.availability > 0";
}

$sProd = db2array("SELECT t1.name, t1.id, t1.article 
                      FROM product as t1 
                      LEFT JOIN filter_value as t2 on (t1.id = t2.id_product) 
                      LEFT JOIN filter_value as t3 on (t1.id = t3.id_product) 
                      LEFT JOIN categories as t4 on(t1.categories=t4.id) 
                      LEFT JOIN categories as t5 on(t4.section=t5.id)
                      $query 
                      GROUP BY t1.id ORDER BY (SELECT element_value FROM `filter_value` WHERE `id_filter`='28' AND `id_product`=t1.id) ASC LIMIT 100", 2);

foreach ($sProd as $item){
  $provider = '
              <table class="table table-bordered table-striped table-condensed flip-content">
                <thead class="flip-content">
                <tr>
                  <th> Поставщик </th>
                  <th> Цена </th>
                  <th> За 4 шт.</th>
                  <th> Закуп </th>
                  <th> Доставка </th>
                  <th> Кол-во </th>
                  <th> Действие </th>
                </tr>
                </thead>
                <tbody>
   ';
  foreach (sProviderById($item['id']) as $items){
    $provider .= '
              <tr>
                <td>'.$items['name_provider'].'</td>
                <td>'.$items['price'].'</td>
                <td>'.($items['price']*4).'</td>
                <td>'.$items['price_clear'].'</td>
                <td>'.$date = date('d.m.Y', strtotime('+' . countingDay($items["logistic"]) . ' days')).'</td>
                <td>'.$items['availability'].'</td>
                <td> <button class="btn btn-xs yellow" data-toggle="modal" data-target="#newOrderWorkPlace" onclick="addBasketWorkPlace('.$item[id].', '.$items[id_provider].')" id="btn-modal">Создать заказ</button></td>
              </tr>
    ';
  }
  $provider .= '</tbody>
      </table>';
  $arr["res"] .= '
    <tr>
            <td>
              '.$item['article'].'
              <button class="btn btn-xs blue" data-toggle="modal" data-target="#combineProd" onclick="combineProdModalDisk('.$item[id].')" id="btn-modal">Объединить</button>
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