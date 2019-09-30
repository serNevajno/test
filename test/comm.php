<?php
session_start();
//////Подключение к базе
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
/////Подключение библиотеки
include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
// Фильтруем полученные данные

/*function sAllComm(){
  return db2array("SELECT t1.id, t1.comments, t2.name as name_admin, t1.date_comm FROM `orders` as t1 LEFT JOIN admin_user as t2 on (t1.id_admin_comm = t2.id) WHERE t1.date_comm !='0000-00-00 00:00:00'", 2);
}
function selectWeightTyres($width, $heigth, $diametr){
    if($width<40){
        $size = $width."x".$heigth."R".$diametr;
    }else{
        $size = $width."/".$heigth."R".$diametr;
    }
   return db2array("SELECT `scope_1`, `weight_1`, `scope_4`, `weight_4` FROM `weight_tyres` WHERE size='$size'");
}
function selectWeightDisk($diametr){
    return db2array("SELECT `scope_1`, `weight_1`, `scope_4`, `weight_4` FROM `weight_disk` WHERE size='$diametr'");
}

function selectWeigth($id){
    $tepm =  db2array("SELECT t1.id_filter, t3.value FROM filter_value as t1 
			LEFT JOIN filter as t2 on (t1.id_filter=t2.id) 
			LEFT JOIN element_filter as t3 on (t1.element_value=t3.id) 
		WHERE id_product='$id' ORDER BY t2.priority DESC", 2);

    foreach ($tepm as $item){
        if($item["id_filter"] == '19') $tWidth = $item["value"];
        if($item["id_filter"] == '20') $tDia = $item["value"];
        if($item["id_filter"] == '21') $tHeigth = $item["value"];
        if($item["id_filter"] == '25') $dDia = $item["value"];
    }

    if($tWidth AND $tDia AND $tHeigth) {
        return selectWeightTyres($tWidth, $tHeigth, $tDia);
    }elseif ($dDia>0){
        return selectWeightDisk($dDia);
    }

}
echo "<pre>".print_r(selectWeigth('112702'), true)."</pre>";*/
//echo "<pre>".print_r(sAllComm(), true)."</pre>";

/*foreach (sAllComm() as $item){
  //$lastComm = sLastCommetnsAdminByOrderId($item['id'])['comments'];
  if($lastComm){
    $lastComm = $lastComm."\r\n";
  }
  $comm = $lastComm.$item['name_admin'].";".$item['date_comm'].";".clearData($item['comments'])."^";

  //echo "UPDATE `orders` SET `comments` = '".$comm."' WHERE id = '".$item['id']."'<br>";

  //mysql_query("UPDATE `orders` SET `comments`='$comm' WHERE id='$item[id]'") or die(mysql_error());
}*/

/*$subject = '=?utf-8?B?'.base64_encode("test").'?='; // теме письма
$message = "test2"; // Само сообщение
$headers = 'MIME-Version: 1.0' . "\r\n"; // Что бы отправлять HTML, устанавливаем Content-type заголовки
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";  // тут установить ту кодировку с которой вы работатете
$headers .= 'From: =?UTF-8?B?' . base64_encode('ыыыыы') . '?= <dobrayashina@yandex.ru>\r\n';
// Отправляем
mail("s.s@bigmir.net", $subject, $message, $headers);*/?>
<?//$_SERVER['DOCUMENT_ROOT'].'/images/product_cover/1532612273_111.jpg';?>
<?if(file_exists('/images/product_cover/1532612273_111.jpg')){?>
    <a href="/images/product_cover/<?= $meta_item['img'] ?>">
        <img src="/scripts/phpThumb/phpThumb.php?src=/images/product_cover/<?= $meta_item['img'] ?>&w=680&h=449&far=1&bg=ffffff&f=jpg" alt="<?= $meta_item['title'] ?>">
    </a>
<?}else{?>
    <img src="//placehold.it/680x449?text=no image" alt="<?= $meta_item['img'] ?>">
<?}?>
