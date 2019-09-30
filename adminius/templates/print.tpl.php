<?php include($_SERVER['DOCUMENT_ROOT'].'/templates/head.tpl.php');
$date = date('Y-m-d H:i:s');
?>
<script>alert('Не забудь выдать плюшки клиенту!!!')</script>
<style>
  .conteiner{
    width: 302px;
    /*border: 1px solid #000;*/
    padding: 0px 3px 0px 3px;
  }
  .headchek{
    text-align: center;
    font-size: 12px;
  }
  .datechek{
    text-align: left;
    font-weight: bold;
    font-size: 12px;
  }
  table {
    margin: 5px 0 5px 0;
  }
  table th {
    font-size: 12px;
  }
  table td {
    font-size: 12px;
  }
  .namechek{
    width: 100px;
    text-align: center;
  }
  td.namechek{
    padding: 2px;
  }
  .price{
    width: 60px;
    text-align: center;
  }
  td.price{
    padding: 2px;
  }
  .summ{
    width: 75px;
    text-align: center;
  }
  td.summ{
    padding: 2px;
  }
  span{
    float: right;
    font-size: 12px;
  }
</style>
<div class="conteiner">
  <div class="headchek"> ИП ПУРИЧАМИАШВИЛИ Л.В.</div>
  <div class="headchek"> ОГРН 318745600188829 </div>
  <div class="headchek"> Интернет-магазин "ДобраяШина" </div>
  <div class="datechek"> <?=date('d.m.Y H:i')?> </div>
  <div class="datechek"> Продажа <span> <?=$_GET["id"]?> </span></div>

  <table >
    <thead>
    <tr>
      <th class="namechek">Наименование</th>
      <th class="price">Цена</th>
      <th class="price">Кол-во</th>
      <th class="summ">Стоимость</th>
    </tr>
    </thead>
    <tbody>
    <?$select_order = selectOrderProductById($_GET["id"]);
    foreach ($select_order as $item){?>
    <tr>
      <td class="namechek"><?=$item["name"]?></td>
      <td class="price"> <?=$item["price"]?> </td>
      <td class="price"> <?=$item["quantity"]?> </td>
      <td class="summ"> <?=$item["price"]*$item["quantity"]?> </td>
    </tr>
    <?}?>
    </tbody>
  </table>
  <?if($_GET['prepayment'] != 'none'){
    if($item['prepayment'] > 0){?>
    <div style="font-size: 12px;margin-top: 8px;"> Предоплата <span> <?=$item['prepayment']?> </span></div>
    <div style="font-size: 12px;margin-top: 4px;"> Осталось оплатить <span> <?=selectSummOrderById($_GET["id"]) - $item['prepayment']?> </span></div>
  <?}}?>
  <?if($item['summ']){echo "<div style='font-size: 12px;margin-top: 4px;'>скидка: <span>". $sale = (selectSummOrderById($_GET["id"])-$item['summ']). "</span></div>";}?>
  <div style=" font-size: 16px; font-weight: bold;"> ИТОГО <span style="font-size: 16px;"><?if($item['summ'] > 0){echo $item['summ'];}else{echo selectSummOrderById($_GET["id"]);} ?></span></div>
  <div>Продавец <div style="width: 150px; height: 20px; border-bottom: 1px solid #000;float: right; margin-top: 5px;"></div></div>
  <br>
  <div>Покупатель <div style="width: 150px; height: 20px; border-bottom: 1px solid #000;float: right"></div></div>
</div>
<?
if(!$item['prepayment'] or $_GET["close"] == '1') {
// Заносим в базу
  $date = date("Y-m-d H:i:s");
  mysql_query("UPDATE orders SET id_status='1', `date_end`='$date' WHERE id='$_GET[id]' AND id_status!='1'") or die(mysql_error());
  //////отправка смс
  if(selectUserById(selectOrderById($_GET["id"])['id_user'])['name']){$name = selectUserById(selectOrderById($_GET["id"])['id_user'])['name'];}else{$name = 'Покупатель';}
  $status_text = db2array("SELECT sms_text, email_text FROM status WHERE id='1'");
  $temp = db2array("SELECT phone FROM `orders` WHERE id='$_GET[id]'");
  $text_sms = str_replace("#name#", $name, $status_text["sms_text"]);
  $text_sms = str_replace("#nomer#", $_GET["id"], $text_sms);
  $text_sms = str_replace("#sum#", sumOrderReal($_GET["id"]), $text_sms);
  sendSMS($temp["phone"], $text_sms, $_GET["id"]);
}
?>
<script>
  window.onload(print());
</script>