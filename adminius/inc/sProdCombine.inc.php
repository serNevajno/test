<?php
session_start();
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');

function sProductWorkPlace($s='', $b='', $r='', $a='', $sh='', $id){
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
    $query .= " (t1.name LIKE '%$res[0]R$res[1]%' OR t1.name LIKE '%$res[0] R$res[1]%' OR t1.name LIKE '%$res[0]ZR$res[1]%')";
  }

  if(!empty($a)){
    if (!empty($query)) $query .= " AND";
    $query .= " t1.article = '$a'";
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
    $query = "WHERE".$query." AND t1.availability > 0 AND t1.active = 1 AND t1.id !='$id'";
  }

  return db2array("SELECT t1.name, t1.id, t1.article FROM product as t1 LEFT JOIN filter_value as t2 on (t1.id = t2.id_product) $query GROUP BY t1.id ORDER BY t1.name ASC", 2);
}

$arr = array();
$id = clearData($_POST['id'], "i");
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

if($shirina and $visota and $radius) {
  $r = $shirina . "/" . $visota . "R" . $radius;
}

$sProd = sProductWorkPlace($s, $brend, $r, $articul, $ship, $id);
$sProdById = selectProductById($id);

$arr['combineName'] = $sProdById['name'].' | артикул:'.$sProdById['article'];
foreach ($sProd as $item){
  $arr['res'] .= '
    <tr>
      <td>
        '.$item['article'].'
      </td>
      <td>
        '.$item['name'].'
      </td>
      <td id="actionCombine'.$item['id'].'">
        <a onclick="combineProd('.$id.', '.$item['id'].')" class="btn btn-xs blue">Объединить</a>
      </td>
    </tr>
  ';
}

echo json_encode($arr);