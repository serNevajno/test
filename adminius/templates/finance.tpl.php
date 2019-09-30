<? if ($access["finance"] == 1) { ?>
<?
if (isset($_GET["limit"])) {
    $num = clearData($_GET["limit"], "i");
} else {
    $num = 50;
}
if (isset($_GET["page"])) {
    $page = clearData($_GET["page"], "i");
} else {
    $page = 1;
}
if (isset($_GET["search"])) {
    $search = $_GET["search"];
} else {
    $search = "";
}
?>
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box blue">
    <div class="portlet-title">
        <div class="tools">
        </div>
    </div>
    <div class="portlet-body">
        <div class="row">
            <div class="col-md-9 col-sm-12">
                <div id="sample_1_length" class="dataTables_length">
                    <div class="col-sm-12 col-md-2 col-lg-1">
                        <label>
                            <select size="1" name="limit" aria-controls="sample_1" class="form-control "
                                    onchange='location.href="index.php?code=finance<?
                                    if ($_GET['to']) echo '&to=' . $_GET['to'];
                                    if ($_GET['from']) echo '&from=' . $_GET['from'];?>&limit="+this.value'>
                                <option value="10" <? if ($num == 10) echo "selected='selected'"; ?>>10</option>
                                <option value="25" <? if ($num == 25) echo "selected='selected'"; ?>>25</option>
                                <option value="50" <? if ($num == 50) echo "selected='selected'"; ?>>50</option>
                                <option value="100" <? if ($num == 100) echo "selected='selected'"; ?>>100</option>
                                <option value="0" <? if ($num == 0) echo "selected='selected'"; ?>>All</option>
                            </select>
                        </label>
                    </div>
                </div>
            </div>

        </div>
        <br>
        <div class="portlet-body">
            <div class="panel-group accordion" id="accordion1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1"
                               href="#collapse_1">
                                ФИЛЬТР </a>
                        </h4>
                    </div>
                    <div id="collapse_1" class="panel-collapse collapse" style="height: 0px;">
                        <div class="portlet-body form">
                            <form role="form" method="GET" action="/adminius/index.php?code=finance">
                                <input name="code" type="hidden" value="finance">
                                <div class="form-body">
                                    <div class="form-group">
                                        <div style="display: inline-table;">
                                            <label>Выберете дату</label>
                                            <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="yyyy-mm-dd">
                                                <input type="text" class="form-control" name="from" value="<?= $_GET['from'] ?>" placeholder="дата с">
                                                <span class="input-group-addon"> по </span>
                                                <input type="text" class="form-control" name="to" value="<?= $_GET['to'] ?>" placeholder="дата по">
                                            </div>
                                            <!-- /input-group -->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Регион: </label>
                                        <select class="form-control input-small" name="region">
                                            <option value="0" selected>Все</option>
                                            <?foreach(selectRegion() as $iRegion){?>
                                                <option value="<?=$iRegion["id"]?>"><?=$iRegion["region"]?></option>
                                            <?}?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn blue">Поиск</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-9" style="padding-bottom: 15px;">
                <form method="POST">
                    <input name="func" type="hidden" value="encashment">
                    <div class="form-group">
                        <div class="col-md-3">
                            <label><b>Введите сумму:</b> </label>
                            <input type="text" class="form-control input-small" name="sum">
                        </div>
                        <div class="col-md-4">
                            <label><b>Введите комментарий:</b> </label>
                            <input type="text" class="form-control input-medium" name="comment">
                        </div>
                        <div class="col-md-3">
                            <label><b>Регион:</b> </label>
                            <select class="form-control input-small" name="region">
                                <?foreach(selectRegion() as $iRegion){?>
                                    <option value="<?=$iRegion["id"]?>"><?=$iRegion["region"]?></option>
                                <?}?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <button type="submit" class="btn blue" style="margin-top: 5px;">Инкассировать</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-3" style="padding-bottom: 15px;">
                <?foreach(selectRegion() as $iRegion){
                  if($iRegion['id'] != 4 AND $iRegion['id'] != 5){?>
                 В кассе <?=$iRegion["region"]?>: <?=cashbox($iRegion["id"]);?> - <?=cashboxReturn($iRegion["id"]);?><br>
                <?}}?>
            </div>
        </div>
        <table class="table table-striped table-bordered table-hover" id="sample_1">
            <thead>
            <tr>
                <th>№</th>
                <th>Остаток</th>
                <th>Сумма</th>
                <th>Комментарий</th>
                <th>Регион</th>
                <th>Дата инкассации</th>
            </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">
            <? $select_order = selectEncashment($page, $num, $_GET["from"], $_GET["to"], $_GET["region"]);
            //echo "<pre>".print_r($select_order, true)."</pre>";
            foreach ($select_order as $item) {
                ?>
                <tr class="odd">
                    <td class=" sorting_1"><?= $item["id"] ?></td>
                    <td class=""><?= $item["balance"] ?></td>
                    <td class=""><?= $item["sum"] ?></td>
                    <td class=""><?= $item["comment"] ?></td>
                    <td class=""><?= $item["region"] ?></td>
                    <td class=""><?= $item["date"] ?></td>
                </tr>
            <? } ?>
            </tbody>
        </table>
        <? include($_SERVER['DOCUMENT_ROOT'] . '/adminius/templates/pagenav.tpl.php'); ?>
    </div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->
<? } else { ?>
    <h3>Отказано в доступе, недостаточно прав.<h3>
<? } ?>