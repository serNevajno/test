<?php
if($_SERVER["REQUEST_METHOD"]=="POST") {
  session_start();
  //////Подключение к базе
  include($_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php');
  /////Подключение библиотеки
  include($_SERVER['DOCUMENT_ROOT'] . '/inc/function.inc.php');

  $id = clearData($_POST['id']);
  $city = clearData($_POST['name']);
  $rn = clearData($_POST['rn']);
  function sIdCityKladr($id){
    $temp = db2array("SELECT id FROM cityKladr WHERE id_city='$id'");
    return $temp['id'];
  }

  if($id) {
    setcookie ("id_city_kladr", $id, time()+604800, "/", $_SERVER['SERVER_NAME']);
    if (!sIdCityKladr($id)) {
      mysql_query("INSERT INTO `cityKladr`(`id_city`, `city`, `rn`) VALUES ('$id','$city', '$rn')");
    }
  }
  return $true = 'true';
}