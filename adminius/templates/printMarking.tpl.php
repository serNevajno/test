<?php include($_SERVER['DOCUMENT_ROOT'].'/templates/head.tpl.php');
include($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
include($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/function.inc.php');
$date = date('Y-m-d H:i:s');
$id = clearData($_GET["id"], "i");
//echo "<pre>".print_r(selectOrderById($id), true)."</pre>";
$item = selectOrderById($id);
$prod = sOrderProductById($id);
?>
<style>
    p {
        margin:0px;
    }
    hr {
        margin-top: 5px;
        margin-bottom: 5px;
    }
</style>
<?for($i=0;$i<5;$i++){?>
<div style="font-size: 16px;text-align: left;margin-left: 15px;font-weight: 700;">
  <p><?=$item['trans_company']?></p>
  <p>Номер заказа <?=$id?></p>
  <p>Отправитель ООО «ЭГО 174»</p>
  <p>ИНН 7451376873</p>
  <p>Получатель <?=$item['name']?></p>
  <p>Адрес доставки: <?=$item['address']?></p>
  <?if($item['INN']){?>
        <p>ИНН: <?=$item['INN']?></p>
  <?}?>
  <p>Телефон: <?=$item['phone']?></p>

  <div >
    Товар:
    <?foreach ($prod as $val){?>
      <p style="margin-left: 15px;"><?=$val['name']?> - <?=$val['quantity']?> ед</p>
    <?}?>
  </div>
  <p>Стоимость: <?
    //setlocale(LC_MONETARY, 'it_IT');
    echo money_format('%.2n', selectSummOrderById($id)) . " р. \n";
    ?></p>
</div>
  <hr>
<?}?>
<script>
    window.onload(print());
</script>
