<?php
// запуск сессии
$session = selectSession();
if(!$session)
  {
  	Header('Location: ../adminius/login.php');
    exit();
  }
?>