<?if (isset($_GET["limit"])) {
  $num = clearData($_GET["limit"], "i");
}else{
  $num = 10;
}
if (isset($_GET["page"])) {
  $page = clearData($_GET["page"], "i");
}else{
  $page = 1;
}
if (isset($_GET["search"])) {
  $search = $_GET["search"];
}else{
  $search = "";
}
$sWorkTime = sUserWorkTime($page, $num, $_GET["from"], $_GET["to"], $_GET['manager']);?>
<div class="row">
  <div class="col-md-12">

    <div class="portlet box green">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-cogs"></i>Учет рабочего времени
        </div>
        <div class="tools">
          <a href="javascript:;" class="collapse"></a>
        </div>
      </div>

      <div class="portlet-body">
        <div class="panel-group accordion" id="accordion1">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle<? if (!isset($_GET["num_order"])) echo " collapsed"; ?>"
                   data-toggle="collapse" data-parent="#accordion1"
                   href="#collapse_1">
                  ФИЛЬТР </a>
              </h4>
            </div>
            <div id="collapse_1" class="panel-collapse in"
                 style="<? if (isset($_GET["num_order"])) {
                   echo "height: auto;";
                 } else {
                   echo "height: 0px;";
                 } ?>">
              <div class="portlet-body form">
                <form role="form" method="GET" action="/adminius/index.php?code=userWorkTime">
                  <input name="code" type="hidden" value="userWorkTime">
                  <div class="form-body">
                    <div class="col-md-12">
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
                        <label>Менеджер</label>
                        <select class="form-control" name="manager">
                          <option value="">Выберите менеджера</option>
                          <? foreach (selectManager() as $itemMan) { ?>
                            <option
                                    value="<?= $itemMan['id'] ?>" <? if ($_GET['manager'] == $itemMan['id']) echo "selected='selected'"; ?>><?= $itemMan['name'] ?></option>
                          <? } ?>
                        </select>
                      </div>
                    </div>

                  </div>
                  <div class="form-actions col-md-12">
                    <button type="submit" class="btn blue">Поиск</button>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="portlet-body flip-scroll">
        <table class="table table-bordered table-striped table-condensed flip-content">
          <thead class="flip-content">
            <tr>
              <th> Имя </th>
              <th> Группа </th>
              <th class="numeric"> Начало работы </th>
              <th class="numeric"> Конец работы </th>
              <th class="numeric"> Отработано часов </th>
            </tr>
          </thead>
          <tbody>
          <?foreach ($sWorkTime as $item){?>
            <tr>
              <td> <?=$item['name']?> </td>
              <td> <?=$item['name_group']?> </td>
              <td class="numeric"> <?=$item['date_start']?></td>
              <td class="numeric"> <?=$item['date_end']?> <?if($item['robot'] == '1'){?>закрыт роботом<?}?></td>
              <td class="numeric">
                <?if($item['date_end'] != '0000-00-00 00:00:00'){
                  echo date("H:i:s", mktime(0, 0, strtotime($item['date_end']) - strtotime($item['date_start'])));
                  $time += strtotime($item['date_end']) - strtotime($item['date_start']);
                }?>
              </td>
            </tr>
          <?}?>
          </tbody>
        </table>
      </div>

    </div>
    <h3>Всего отработано часов <?echo $h = floor($time/3600)." : "; echo $m = floor(($time-($h*3600))/60); ?></h3>
    <?include($_SERVER['DOCUMENT_ROOT'].'/adminius/templates/pagenav.tpl.php');?>
  </div>
</div>