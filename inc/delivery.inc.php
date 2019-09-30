<?php
session_start();
//////Подключение к базе
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
/////Подключение библиотеки
include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
// Фильтруем полученные данные

$type = clearData($_POST['type'], "i");


if($type == "1"){
    $Chel = settingsSite();

    $resText = "
                <div class='form-group'>
                  <select id='samovivoz' class='form-control form-item'>
                      <option value='0'>Выберите офис</option>
                      <option value='1'>Челябинск - ".$Chel["time_work"]."</option>
                      <option value='3'>Екатеринбург - ".selectOfficeByid(3)["time_work"]."</option>
                      <option value='2'>Уфа - ".selectOfficeByid(2)["time_work"]."</option>
                      <option value='4'>Пермь - ".selectOfficeByid(2)["time_work"]."</option>
                      <option value='5'>Тюмень - ".selectOfficeByid(2)["time_work"]."</option>
                  </select>
                </div>
                ";
}elseif($type == "2"){
    $resText = "г.Челябинск - <input type='text' id='addressDevFull' placeholder='Улица, дом, квартира'>";
}elseif($type == "3"){
    $resText = "
                <div class='form-group'>
                  <select id='sTransCom' onchange='otherTransCom();' class='form-control form-item'>
                      <option>Транспортная компания «ЛУЧ»</option>
                      <option selected>Транспортная компания «ПЭК»</option>
                      <option>Транспортная компания «КИТ»</option>
                      <option>Транспортная компания «ДПД»</option>
                      <option>Транспортная компания «Деловые линии»</option>
                      <option>Транспортная компания «Энергия»</option>
                      <option value='1'>Другая Транспортная компания</option>
                  </select>
                </div>
                
                <input type='text' style='display: none;' id='otherCompany'>
                <div class='form-group'>
                  <input type='radio' name='deliveryTransCom' value='1' onClick='checkDivTransCom(1);' style='width: unset;'> Доставка до терминала в моем населенном пункте
                </div>
                <div class='form-group'>
                  <input type='radio' name='deliveryTransCom' value='2' onClick='checkDivTransCom(2);' style='width: unset;'> Доставка до двери
                </div>
                ";
}

echo $resText;