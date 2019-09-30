<? if ($access["prepayment"] == 1) { ?>
    <?if (isset($_GET["action"])){?>
    <?}else{?>
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
                                            onchange='location.href="index.php?code=prepayment<?
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
                                    <form role="form" method="GET" action="/adminius/index.php?code=prepayment">
                                        <input name="code" type="hidden" value="prepayment">
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
                                                <div class="checkbox-list">
                                                    <b>Все:</b>&nbsp; <input type="checkbox" value="1" name="status" <?if($_GET['status'] == "1") echo "checked";?>>
                                                </div>
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
                <table class="table table-striped table-bordered table-hover" id="sample_1">
                    <thead>
                    <tr>
                        <th>№</th>
                        <th>Дата</th>
                        <th>Регион</th>
                        <th>Заказ</th>
                        <th>Сумма</th>
                        <th>Статус</th>
                    </tr>
                    </thead>
                    <tbody role="alert" aria-live="polite" aria-relevant="all">
                    <? $select_order = selectPrepayment($page, $num, $_GET["from"], $_GET["to"], $_GET["status"]);
                    //echo "<pre>".print_r($select_order, true)."</pre>";
                    foreach ($select_order as $item) {?>
                        <tr class="odd">
                            <td class=" sorting_1"><?= $item["id"] ?></td>
                            <td class=""><?= $item["date"] ?></td>
                            <td class=""><?= $item["region"] ?></td>
                            <td class=""><a href="/adminius/index.php?code=orders&action=edit&id=<?= $item["order_id"] ?>" target="_blank"><?= $item["order_id"] ?></a></td>
                            <td class=""><?= $item["summ"] ?></td>
                            <td class="" id="btnConfirmPrepayment<?= $item["id"] ?>">
                                <?if($item["status"] == "1"){?>
                                    Утвержден
                                <?}else{?>
                                    <?if($access["prepayment_confirm"] == 1){?>
                                        <a class="btn btn-xs blue btn-editable" data-id="1" onClick="confirmPrepayment('<?= $item["id"] ?>')"></i> Утвердить</a>
                                    <?}?>
                                <?}?>
                            </td>
                        </tr>
                    <? } ?>
                    </tbody>
                </table>
                <? include($_SERVER['DOCUMENT_ROOT'] . '/adminius/templates/pagenav.tpl.php'); ?>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    <?}?>
<? } else { ?>
    <h3>Отказано в доступе, недостаточно прав.<h3>
<? } ?>