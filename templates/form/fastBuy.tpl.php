<? $sDataUser = selectDataUser();
//$sRegionUfa = selectOfficeByid(1);?>
<div class="p-lg-30 p-xs-15 bg-gray-f5 bg1-gray-15" id="regOk">
  <form>
    <p class="m-b-lg-15">Воспользуйстесь формой быстрой покупки!</p>
    <?if($_GET['product_code']){?>
      <div class="bs-callout bs-callout-danger">
        <p><strong>Внимание!</strong> Может потребоваться предоплата. О необходимости и размере предоплаты сообщит менеджер магазина.</p>
      </div>
    <?}?>
    <div class="form-group">
      <input id="fio" type="text" class="form-control form-item" placeholder="ФИО" value="<?= $sDataUser["name"] ?>">
    </div>
    <div class="form-group">
      <input id="phone" type="text" class="form-control form-item" placeholder="Телефон"
             value="<?= $sDataUser["phone"] ?>">
    </div>
    <div class="form-group">
				<span style="margin-right:20px;">
					<input type="radio" name="delivery" value="1" checked onClick="checkDelivery(1);" id="samovuvoz"> Самовывоз
				</span>
      <span style="margin-right:20px;">
					<input type="radio" name="delivery" value="2" onClick="checkDelivery(2);"> Доставка
				</span>
    </div>
    <div class="form-group">
      <select name="region" class="form-control form-item" id="region" onchange="checkRegion();">
        <? foreach (selectRegion() as $iRegion) { ?>
          <option value="<?= $iRegion["id"] ?>" <? if ($_COOKIE['region'] == $iRegion["id"]){ ?>selected<? } ?>><?= $iRegion["region"] ?></option>
        <? } ?>
        <option value="1">Другой регион</option>
      </select>
    </div>

    <div id="resDeliv"></div>

    <br>
    <div class="form-group">
      <input id="address" type="text" class="form-control form-item" placeholder="Адрес доставки" value="<?= $sDataUser["address"] ?>">
    </div>
    <div class="form-group">
      <textarea id="comment" class="form-control form-item" placeholder="Коментарий"></textarea>
    </div>
    <div class="form-group" id="polKonfDiv">
          <input type="checkbox" value="1" id="polKonf" style="display: unset; width: unset;">
          я согласен на обработку <a href="/politika-konfidentsialnosti.html" target="_blank" style="text-decoration: underline;">персональных данных</a><span style="color: #cb1010;">*</span>
    </div>
    <a onClick="<? if ($_GET['categories_code'] == "tyres" OR $_GET['categories_code'] == "disk") {
      echo "checkOutFast('" . $meta_item["id"] . "', '', '0')";
    } elseif (($_GET['categories_code'] != "tyres" OR $_GET['categories_code'] != "disk") AND isset($_GET['categories_code'])) {
      echo "checkOutFast('" . $meta_item["id"] . "', '', '0')";
    } else {
      echo "checkOut()";
    } ?>" class="ht-btn ht-btn-default" style="width:100%; text-align: center;cursor:pointer;">Заказать</a>
  </form>
</div>