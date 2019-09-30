<?php
session_start();
//////Подключение к базе
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
/////Подключение библиотеки
include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
// Фильтруем полученные данные

$reg = clearData($_POST['region'], 'i');
$deli = clearData($_POST['delivery'], "i");


function sSummTextDelivery($reg){
  return db2array("SELECT summ_delivery, region, address, time_work FROM office_contact WHERE id='$reg'");
}

$res = sSummTextDelivery($reg);

$address = explode('г.', $res['address']);

if($deli == '1') {
  if ($reg == '1') {
    $resText = '<i class="fa fa-info-circle"></i> Самовывоз - бесплатно. г. Челябинск улица Марата 9/1. Режим работы - Пн-Вс 09:00 - 20:00';
  } else {
    $resText = '<i class="fa fa-info-circle"></i> Самовывоз - бесплатно. г.' . $address['1'] . ' Режим работы  - ' . $res['time_work'];
  }
}elseif ($deli == '2'){
  if($reg == '1'){
    $resText = '<i class="fa fa-info-circle"></i> Доставка - 300 руб по г.Челябинску (оплачивается отдельно курьеру). Срок и стоимость доставки в другие регионы по тарифам транспортных компаний <a href="http://tk-kit.ru/" style="color:red;" target="_blank">ТК КИТ</a>, <a href="https://pecom.ru/" style="color:red;" target="_blank">ПЭК</a>, <a href="http://тк-луч.рф/" style="color:red;" target="_blank">ЛУЧ</a>.';
  }else{
    /*$resText = '<i class="fa fa-info-circle"></i> Доставка - '.$res['summ_delivery'].' руб в г.'.$res['region'].' (оплачивается отдельно курьеру). Срок и стоимость доставки в другие регионы по тарифам транспортных компаний <a href="http://tk-kit.ru/" style="color:red;" target="_blank">ТК КИТ</a>, <a href="https://pecom.ru/" style="color:red;" target="_blank">ПЭК</a>, <a href="http://тк-луч.рф/" style="color:red;" target="_blank">ЛУЧ</a>.';*/
    $resText = '<i class="fa fa-info-circle"></i> Доставка - временно не будет производится.';
  }
}


echo $resText;