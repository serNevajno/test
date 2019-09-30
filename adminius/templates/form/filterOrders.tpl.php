<form role="form" method="GET" action="/adminius/index.php?code=orders">
  <input name="code" type="hidden" value="orders">
  <div class="form-body">
    <div class="col-md-12">
      <div class="form-group col-md-3">
        <label>Номер заказа</label>
        <input type="text" name="num_order" class="form-control" placeholder="Введите номер заказа"
               value="<?= $_GET["num_order"] ?>">
      </div>

      <!--<div class="form-group">
          ИЛИ
      </div>-->
      <div class="form-group col-md-3">
        <div style="display: inline-table;">
          <label>Выберите дату</label>
          <div class="input-group date-picker input-daterange" data-date="10/11/2012"
               data-date-format="yyyy-mm-dd">
            <input type="text" class="form-control" name="from" value="<?= $_GET['from'] ?>"
                   placeholder="дата с">
            <span class="input-group-addon"> по </span>
            <input type="text" class="form-control" name="to" value="<?= $_GET['to'] ?>"
                   placeholder="дата по">
          </div>
          <!-- /input-group -->
        </div>
      </div>

      <div class="form-group col-md-3">
        <label>Телефон</label>
        <input type="text" name="phone" class="form-control" placeholder="Введите телефон"
               value="<?= $_GET["phone"] ?>" id="phonemasksearch">
      </div>

      <div class="form-group col-md-3">
        <label>Статус</label>
        <select class="form-control" name="status">
          <option value="all">Выберите статус</option>
          <? foreach (selectStatus() as $item) { ?>
            <option
              value="<?= $item['id'] ?>" <? if ($_GET['status'] == $item['id']) echo "selected='selected'"; ?>><?= $item['name'] ?></option>
          <? } ?>
        </select>
      </div>
    </div>

    <div class="col-md-12">
      <div class="form-group col-md-3">
        <label>Тип оплаты</label>
        <select class="form-control" name="typePay">
          <option value="">Выберите тип оплаты</option>
          <option value="0" <? if ($_GET['typePay'] == '0') echo "selected='selected'"; ?>>Нал
          </option>
          <option value="1" <? if ($_GET['typePay'] == '1') echo "selected='selected'"; ?>>Безнал
          </option>
        </select>
      </div>

      <div class="form-group col-md-3">
        <label>Менеджер</label>
        <select class="form-control" name="manager">
          <option value="">Выберите менеджера</option>
          <? foreach (selectManager() as $itemMan) { ?>
            <option
              value="<?= $itemMan['id'] ?>" <? if ($_GET['manager'] == $itemMan['id']) echo "selected='selected'"; ?>><?= $itemMan['name'] ?></option>
          <? } ?>
        </select>
      </div>

      <div class="form-group col-md-3">
        <label>Регион</label>
        <select class="form-control" name="region">
          <option value="">Выберите регион</option>
          <? foreach (selectRegion() as $itemReg) { ?>
            <option
              value="<?= $itemReg['id'] ?>" <? if ($_GET['region'] == $itemReg['id']) echo "selected='selected'"; ?>><?= $itemReg['region'] ?></option>
          <? } ?>
        </select>
      </div>

      <div class="form-group col-md-3">
        Касса:&nbsp; <input type="checkbox" value="1" id="kassa"
                            name="kassa" <? if ($_GET["kassa"] == '1') echo "checked"; ?>>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group col-md-3">
        <label>Поставщик</label>
        <select class="form-control" name="provider">
          <option value="">Выберите поставщика</option>
          <? foreach (selectProvider() as $sProvider) { ?>
            <option
              value="<?= $sProvider['id'] ?>" <? if ($_GET['provider'] == $sProvider['id']) echo "selected='selected'"; ?>><?= $sProvider['name'] ?></option>
          <? } ?>
        </select>
      </div>
      <div class="form-group col-md-3">
        <label>Предоплата</label>
        <select class="form-control" name="prepayment">
          <option value="">Выберите предоплату</option>
          <option value="2" <? if ($_GET['prepayment'] == "2") echo "selected='selected'"; ?>>
            Предоплата есть
          </option>
          <option value="1" <? if ($_GET['prepayment'] == "1") echo "selected='selected'"; ?>>
            Предоплаты нет
          </option>
        </select>
      </div>
    </div>
  </div>
  <div class="form-actions col-md-12">
    <button type="submit" class="btn blue">Поиск</button>
    <a href="/adminius/index.php?code=orders" class="btn btn-info">Сбросить фильтр</a>
  </div>
</form>
<form action="/adminius/inc/exportUserPhone.inc.php" method="post" enctype="multipart/form-data">
  <input name="from" type="hidden" value="<?= $_GET["from"] ?>">
  <input name="to" type="hidden" value="<?= $_GET["to"] ?>">
    <div class="col-md-12">
      <div class="form-group input-group" style="margin: 15px !important;">
        <select class="form-control  input-medium" name="typeUser" id="typeUser" style="float: left;">
          <option value="">Выберите тип пользователя</option>
          <? for ($i=1; $i<=3; $i++) {
            switch ($i){
              case '1': $na = 'Физ лицо'; break;
              case '2': $na = 'ИП'; break;
              case '3': $na = 'Юр лицо'; break;
            }?>
            <option value="<?= $i ?>" ><?= $na ?></option>
          <? } ?>
        </select>
        <button class="btn yellow" type="submit"><i class="fa fa-cloud-download"></i> Выгрузить телефоны в xlsx</button>
      </div>
      <i class="fa fa-info"></i> - если без типа то выгрузка всей базы. Чтобы загрузить с определенной даты, сперва отфильтруйте по дате потом укажите тип.
    </div>
</form>