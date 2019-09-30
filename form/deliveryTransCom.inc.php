<?php
session_start();
//////Подключение к базе
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
/////Подключение библиотеки
include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
// Фильтруем полученные данные

$type = clearData($_POST['type'], "i");

$resText = "
                <div class='form-group'>
                  <select id='country' onchange='checkCountry();' class='form-control form-item'>
                      <option value='1'>Российская Федерация</option>
                      <option value='2'>Казахстан</option>
                  </select>
                </div>
                <div class='form-group'>
                  <input type='hidden' id='regionId'>
                  Область: <input type='text' id='region' placeholder='Область' autocomplete='off'>
                </div>
                <div class='form-group'>
                  <input type='hidden' id='cityId'>
                  Населенный пункт: <input type='text' id='city' placeholder=' Населенный пункт' disabled>
                </div>
                ";

if($type == "2"){
    $resText.= "
                <div class='form-group'>
                  Улица: <input type='text' id='addressDev' placeholder='Улица' disabled>
                </div>
                <div class='form-group'>
                  Номер дома: <input type='text' id='dom' placeholder='дом' disabled>
                </div>
                <div class='form-group'>
                  Квартира(офис): <input type='text' id='kv' placeholder='Квартира(офис)' disabled>
                </div>
                ";
}

echo $resText;