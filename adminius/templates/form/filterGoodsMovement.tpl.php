<form role="form" method="GET" action="/adminius/index.php?code=<?=$_GET['code']?>">
  <input name="code" type="hidden" value="<?=$_GET['code']?>">
  <div class="form-body">
    <div class="col-md-12">
      <div class="form-group col-md-3">
        <label>Регион</label>
        <select class="form-control" name="region">
          <option value="">Выберите регион</option>
          <? foreach (selectRegion() as $itemReg) { ?>
            <option value="<?= $itemReg['id'] ?>" <? if ($_GET['region'] == $itemReg['id']) echo "selected='selected'"; ?>><?= $itemReg['region'] ?></option>
          <? } ?>
        </select>
      </div>

      <div class="form-group col-md-3">
        <label>Поставщик</label>
        <select class="form-control" name="provider">
          <option value="">Выберите поставщика</option>
          <? foreach (selectProvider() as $sProvider) { ?>
            <option value="<?= $sProvider['id'] ?>" <? if ($_GET['provider'] == $sProvider['id']) echo "selected='selected'"; ?>><?= $sProvider['name'] ?></option>
          <? } ?>
        </select>
      </div>
      <div class="form-group col-md-2">
          <label>Ожидается оплата</label>
          <input type="checkbox" name="vc" value="1" <?if($_GET['vc'] == "1") echo "checked";?>>
      </div>
      <!--<div class="form-group">
          ИЛИ
      </div>-->
      <?/*<div class="form-group col-md-3">
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
      </div>*/?>

    </div>

    <?/*<div class="col-md-12">
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


    </div>*/?>
    <?/*<div class="col-md-12">

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
    </div>*/?>

  </div>
  <div class="form-actions col-md-12">
    <button type="submit" class="btn blue">Поиск</button>
  </div>
</form>