<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
  if (!isset($_POST['id'])){
    //echo "<pre>".print_r($_POST, true)."</pre>";

    $address = clearData($_POST['address']);
    $email = clearData($_POST['email']);
    $phone = clearData($_POST['phone']);
    $time_work = clearData($_POST['time_work']);
    $maps = clearData($_POST['maps']);
    $region = clearData($_POST['region']);
    $summ_delivery = clearData($_POST['summ_delivery']);

    //================Настройки============= //
    $foto_light_name = time()."_".basename($_FILES['img']['name']); // Имя файла исключая путь

    // Текст ошибок
    $error_by_file = "<span style=\"font: bold 15px tahoma; color: red;\">Невозможно загрузить файл в директорию. Возможно её не существует</span>";

    // Начало
    if(isset($_FILES["img"])) {
      $myfile_size = $_FILES["img"]["size"];
      $error_flag = $_FILES["img"]["error"];
      // Если ошибок не было
      if($error_flag == 0) {
        $DOCUMENT_ROOT = $_SERVER['DOCMENT_ROOT'];
        $upfile = getcwd()."//../images/slider//" . time()."_".basename($_FILES["img"]["name"]);

        if ($_FILES['img']['tmp_name']) {
          //Если не удалось загрузить файл
          if (!move_uploaded_file($_FILES['img']['tmp_name'], $upfile)) {
            echo "$error_by_file";
            exit;
          }
        } else {
          echo 'Проблема: возможна атака через загрузку файла. ';
          echo $_FILES['img']['name'];
          exit;
        }
      } elseif ($myfile_size == 0) {
        echo "Пустая форма!";
      }
      // Если ошибок не было
    }

    // Заносим в базу
    mysql_query("INSERT INTO office_contact (address, email, phone, time_work, maps, region, summ_delivery, img) VALUES ('$address', '$email', '$phone', '$time_work', '$maps', '$region', '$summ_delivery', '$foto_light_name')") or die(mysql_error());
    $id_element = mysql_insert_id();
    addLogs(selectWhatUser(), 6, $id_element, "office");

    header('Location: index.php?code=office&action=edit&id='.$id_element);
    exit();

  }elseif(isset($_POST["id"]) and isset($_POST['address'])){

    $id = clearData($_POST['id'], "i");
    $address = clearData($_POST['address']);
    $email = clearData($_POST['email']);
    $phone = clearData($_POST['phone']);
    $time_work = clearData($_POST['time_work']);
    $maps = clearData($_POST['maps']);
    $region = clearData($_POST['region']);
    $summ_delivery = clearData($_POST['summ_delivery']);
    $img_s = clearData($_POST['img_s']);


    //================Настройки============= //

    // Текст ошибок
    $error_by_file = "<span style=\"font: bold 15px tahoma; color: red;\">Невозможно загрузить файл в директорию. Возможно её не существует</span>";

    // Начало
    if(isset($_FILES["img"])) {
      $myfile_size = $_FILES["img"]["size"];
      $error_flag = $_FILES["img"]["error"];


      // Если ошибок не было
      if($myfile_size != 0) {
        $foto_light_name = time()."_".basename($_FILES['img']['name']); // Имя файла исключая путь
        $upfile = getcwd()."//../images/slider//" . time()."_".basename($_FILES["img"]["name"]);
        if ($_FILES['img']['tmp_name']) {
          if(!empty($img_s)) {
            if (file_exists("../images/slider/".$img_s)){
              if(!unlink("../images/slider/".$img_s)) {echo("Ошибка удаления файла"); exit;}
            }else{
              echo("Файл не найден http://".$_SERVER['SERVER_NAME']."/images/slider/".$img_s);
            }
          }
          //Если не удалось загрузить файл
          if (!move_uploaded_file($_FILES['img']['tmp_name'], $upfile)) {
            echo "$error_by_file";
            exit;
          }
        }else{
          echo 'Проблема: возможна атака через загрузку файла. ';
          echo $_FILES['img']['name'];
          exit;
        }
      } else {
        $foto_light_name = $img_s;
      }
      // Если ошибок не было
    }



    // Заносим в базу
    mysql_query("UPDATE office_contact SET address='$address', email='$email', phone='$phone', time_work='$time_work', maps='$maps', region='$region', summ_delivery='$summ_delivery', img='$foto_light_name' WHERE id='$id'") or die(mysql_error());

    addLogs(selectWhatUser(), 7, $id, "office");

    if(isset($_POST['submit'])):
      header('Location: /adminius/index.php?code=office');
    elseif(isset($_POST['submit1'])):
      header('Location: /adminius/index.php?code=office&action=edit&id='.$id);
    endif;
    exit;

  }elseif(!isset($_POST['address'])){

    // Фильтруем полученные данные
    $id = (int)$_POST['id'];
    // Заносим в базу
    mysql_query("DELETE FROM office_contact WHERE id='$id'") or die(mysql_error());
    addLogs(selectWhatUser(), 8, $id, "office");
    header('Location: index.php?code=office');
    exit;

  }
}
?>