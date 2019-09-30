<script>alert('Не забудь выдать плюшки клиенту!!!')</script>
<style>
  table {
    width: 100%;
  }

  th {
    background: #ccc;
    padding: 5px;
    text-align: left;
    border: 1px solid #000;
  }

  td {
    padding: 5px;
    border: 1px solid #000;
  }
</style>
<?for($i=1; $i <= 2; $i++){?>
<div style="margin: 15px;">
  <div style="text-align: center;">
    <div style="text-align: right; padding-right: 20px;">
      ИП ПУРИЧАМИАШВИЛИ Л.В.<br>
      ОГРН 318745600188829<br>
    </div>
    <h2>Интернет-магазин "ДобраяШина"</h2>
  </div>
  <hr style="color: #000;">
  <div style="text-align: center;">
    <h3>Товарный чек № <?= $_GET["id"] ?> от <?= date('d.m.Y H:i') ?></h3>

    <table>
      <thead>
      <tr style="background: #ccc;">
        <th>#</th>
        <th>Наименование</th>
        <th>Цена</th>
        <th>Кол-во</th>
        <th>Стоимость</th>
      </tr>
      </thead>
      <tbody>
      <? $select_order = selectOrderProductById($_GET["id"]);
      $n = 1;
      foreach ($select_order as $item) {
        ?>
        <tr>
          <td><?= $n ?></td>
          <td><?= $item["name"] ?></td>
          <td> <?= $item["price"] ?> р</td>
          <td> <?= $item["quantity"] ?> шт</td>
          <td> <?= $item["price"] * $item["quantity"] ?> р</td>
        </tr>
        <? $n++;
      } ?>
      </tbody>
    </table>
    <table>
      <tr>
        <td style="border: none;">
          <div >Продавец <div style="width: 150px; height: 20px; border-bottom: 1px solid #000; margin-top: 5px;"></div></div>
          <br>
          <div >Покупатель <div style="width: 150px; height: 20px; border-bottom: 1px solid #000;"></div></div>
        </td>
        <td style="border: none;text-align: right;">
          <h3>ИТОГО <?if($item['summ'] > 0){echo $item['summ'];}else{echo selectSummOrderById($_GET["id"]);} ?> p</h3>
          <?if($item['summ']){echo "<h4>Скидка: ". $sale = (selectSummOrderById($_GET["id"])-$item['summ']). " р </h4>";}?>
          <?if($_GET['prepayment'] != 'none'){
          if($item['prepayment']){?>
            <h4>Предоплата <?=$item['prepayment']?> p</h4>
            <h4>Осталось оплатить <?=selectSummOrderById($_GET["id"]) - $item['prepayment']?> p</h4>
          <?}}?>
        </td>
      </tr>
    </table>
  </div>
</div>
<?}?>
<?
if(!$item['prepayment']) {
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
