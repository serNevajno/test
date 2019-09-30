<?php
if($_SERVER["REQUEST_METHOD"]=="POST") {
  session_start();
  //////Подключение к базе
  include($_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php');
  /////Подключение библиотеки
  include($_SERVER['DOCUMENT_ROOT'] . '/inc/function.inc.php');

  $arr = array();
  $id_city_kladr = clearData($_POST['id_city_kladr']);

  setcookie ("id_city_kladr", $id_city_kladr, time()+604800, "/", $_SERVER['SERVER_NAME']);

  $rOffice = sOfficeByidCityKladr($id_city_kladr);
  $settings = settingsSite();
  $arr['f14'] = '';
  $sCityKladr = sCityKladr($id_city_kladr);

  if($sCityKladr){
    $arr['f14'] .= '<i class="fa fa-map-marker m-r-lg-5"></i> <strong>Ваш регион</strong> -  <a href="#" data-toggle="modal" data-target="#regionModal" style="color: #fff;border-bottom:1px dashed #fff;cursor: pointer;">'.$sCityKladr[city].'</a> ';
  }

  if($rOffice) {
    //$arr['f14'] .= '<span style="color: #fff;"><strong> Отд.:</strong> - ' . $rOffice['address'].'</span>';
    $arr['footerAddress'] = '<li><i class="fa fa-home"></i> ' . $rOffice['address'] . '</li><li><i class="fa fa-phone"></i> ' . $rOffice['phone'] . '</li><li><i class="fa fa-envelope-o"></i> dobroshina@yandex.ru</li><li><i class="fa fa-clock-o"></i>' . $rOffice['time_work'] . '</li> ';
  }else{
    //$arr['f14'] .= '<span style="color: #fff;"><strong>  Отд.:</strong> - ' . $settings['addres'].'</span>';
    $arr['footerAddress'] .= '<li><i class="fa fa-home"></i> ' . $settings['addres'] . '</li><li><i class="fa fa-phone"></i> ' . $settings['phone'] . '</li><li><i class="fa fa-envelope-o"></i> dobroshina@yandex.ru</li><li><i class="fa fa-clock-o"></i>' . $settings['time_work'] . '</li> ';
  }

  echo json_encode($arr);
}