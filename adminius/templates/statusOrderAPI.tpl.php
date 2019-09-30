<?/*if($access[$_GET['code']] == 1){*/?>
<div class="portlet box purple">
  <div class="portlet-title">
    <div class="caption">
      <i class="fa fa-cogs"></i>status order api
    </div>
    <div class="tools">
      <a href="javascript:;" class="collapse"></a>
      <a href="javascript:;" class="reload"></a>
    </div>
  </div>
  <div class="portlet-body">

    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="col-md-3">
          <div id="sample_1_length" class="dataTables_length" style="margin-right: 15px;">
            <label>
              <select size="1" name="provider" id="provider" aria-controls="sample_1"  class="form-control input-medium">
                <option value="">Поставщик</option>
                <option value="1">Форточки</option>
                <option value="2">КолесаДаром</option>
              </select>
            </label>
          </div>
        </div>

        <div class="col-md-4">
          <div class="input-group date-picker input-daterange" data-date="10/11/2012" data-date-format="yyyy-mm-dd">
            <input type="text" class="form-control" name="from" id="from" value="<?=date('Y-m-d')?>" placeholder="дата с">
            <span class="input-group-addon"> по </span>
            <input type="text" class="form-control" name="to" id="to" value="<?=date('Y-m-d')?>" placeholder="дата по">
          </div>
        </div>

        <?/*<div class="col-md-3">
          <div class="form-group">
            <div class="checkbox-list">
              Не показывать выполненные:&nbsp; <input type="checkbox" value="1" id="fulfilled" name="fulfilled" checked>
              <br>
              Не показывать отмененные:&nbsp;  <input type="checkbox" value="1" id="canceled" name="canceled" checked>
            </div>
          </div>
        </div>*/?>

        <div class="col-md-2">
          <span class="input-group-btn">
            <a class="btn blue" onclick="checkStatusAPI()">Поиск</a>
          </span>
        </div>

      </div>
    </div>
    <div id="resCountryStat"></div>
    <div class="table-scrollable">
      <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
          <th>Дата</th>
          <th>№ заказа</th>
          <th>Название</th>
          <th>Статус</th>
        </tr>
        </thead>
        <tbody id="resTr">
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>
</div>
<?/*}else{?>
<h3>Отказано в доступе, недостаточно прав.<h3>
<?}*/?>
