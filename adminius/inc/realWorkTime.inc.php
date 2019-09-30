<?php
if($_SERVER["REQUEST_METHOD"]=="POST") {
  session_start();
  include($_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php');
  /////Подключение библиотеки
  include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/function.inc.php');

  $id_admin = selectIdUserAdminSession();
  $date_start = strtotime(sTimeUserAdmin($id_admin));
  $date_real = strtotime(date("Y-m-d H:i:s"));
  $sec = $date_real - $date_start;

  $arr['sec'] = $sec;

  echo json_encode($arr);
}