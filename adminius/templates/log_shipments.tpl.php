<? if ($access["finance"] == 1) { ?>
    <?if (isset($_GET["action"])){?>
        <?if($_GET["action"] == "add"){?>
            <!-- BEGIN PAGE CONTENT-->
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable tabbable-custom">
                        <h2>Добавление материала..</h2>
                        <br>
                        <form role="form" action="" enctype="multipart/form-data" method="POST" name="form" id="myForm">
                            <input name="func" type="hidden" value="log_shipments">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label>Выберите дату:</label>
                                            <div style="width: 300px;">
                                                <div class="input-group date form_datetime">
                                                    <input size="16" readonly="" class="form-control" type="text" name="date_active">
                                                    <span class="input-group-btn">
														<button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
													</span>
                                                </div>
                                                <!-- /input-group -->
                                            </div>
                                        </div>
                                        <label>Транспортная компания <font color="red">*</font></label>
                                        <select id="sTransCom" name="trans_company" onchange="otherTransCom();" class="form-control form-item">
                                            <option>Транспортная компания «ЛУЧ»</option>
                                            <option>Транспортная компания «ПЭК»</option>
                                            <option>Транспортная компания «КИТ»</option>
                                            <option>Транспортная компания «ДПД»</option>
                                            <option>Транспортная компания «Деловые линии»</option>
                                            <option>Транспортная компания «Энергия»</option>
                                            <option>Доставка своими силами</option>
                                            <option value="1">Другая Транспортная компания</option>
                                        </select>
                                        <div class="input-group" id="otherCompany" style="display:none; margin-top: 10px;">
															<span class="input-group-addon">
																<i class="fa fa-reorder"></i>
															</span>
                                            <input type="text" class="form-control" name="otherCompany">
                                        </div>
                                        <div class="form-group">
                                            <label>Отправитель: <font color="red">*</font></label>
                                            <select name="sender" class="form-control input-medium" required>
                                                <option>Выбрать</option>
                                                <?foreach (selectSender() as $iSender){?>
                                                    <option value="<?=$iSender["id"]?>"><?=$iSender["name"]?></option>
                                                <?}?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Сумма заказа <font color="red">*</font></label>
                                            <div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-reorder"></i>
															</span>
                                                <input type="text" class="form-control" name="summ">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Получатель <font color="red">*</font></label>
                                            <div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-reorder"></i>
															</span>
                                                <input type="text" class="form-control" name="recipient">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Номер накладной <font color="red">*</font></label>
                                            <div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-reorder"></i>
															</span>
                                                <input type="text" class="form-control" name="number">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Номер заказа <font color="red">*</font></label>
                                            <div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-reorder"></i>
															</span>
                                                <input type="text" class="form-control" name="id_order">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Стоимость доставки <font color="red">*</font></label>
                                            <div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-reorder"></i>
															</span>
                                                <input type="text" class="form-control" name="delivery">
                                            </div>
                                        </div>
                                        <?/*<div class="form-group">
                                            <label>Диаметр: <font color="red">*</font></label>
                                            <select name="diameter" class="form-control input-medium" required>
                                                <option>Выбрать</option>
                                                <?foreach (selectValueFilter() as $iDiameter){?>
                                                    <option value="<?=$iDiameter["id"]?>">R<?=$iDiameter["value"]?></option>
                                                <?}?>
                                            </select>
                                        </div>*/?>
                                    </div>
                            <div class="form-actions">
                                <button type="submit" class="btn blue" name="submit">Сохранить</button>
                                <button type="button" class="btn red" onClick='location.href="/adminius/index.php?code=log_shipments"'>Отмена</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?}elseif($_GET["action"] == "edit"){?>
            <?$itemLogShipments = selectLogShipmentsById($_GET["id"]);?>
            <!-- BEGIN PAGE CONTENT-->
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable tabbable-custom">
                        <h2>Добавление материала..</h2>
                        <br>
                        <form role="form" action="" enctype="multipart/form-data" method="POST" name="form" id="myForm">
                            <input name="func" type="hidden" value="log_shipments">
                            <input name="id" type="hidden" value="<?=$_GET["id"]?>">
                            <div class="form-body">
                                <div class="form-group">
                                    <label>Выберите дату:</label>
                                    <div style="width: 300px;">
                                        <div class="input-group date form_datetime">
                                            <input size="16" readonly="" class="form-control" type="text" name="date_active" value="<?=date("d F Y - H:i", strtotime($itemLogShipments["date_ship"]))?>">
                                            <span class="input-group-btn">
														<button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
													</span>
                                        </div>
                                        <!-- /input-group -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Транспортная компания <font color="red">*</font></label>
                                    <div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-reorder"></i>
															</span>
                                        <input type="text" class="form-control" name="trans_company" value="<?=$itemLogShipments["trans_company"]?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Отправитель: <font color="red">*</font></label>
                                    <select name="sender" class="form-control input-medium" required>
                                        <option>Выбрать</option>
                                        <?foreach (selectSender() as $iSender){?>
                                            <option value="<?=$iSender["id"]?>" <?if($iSender["id"] == $itemLogShipments["sender"]) echo "selected";?>><?=$iSender["name"]?></option>
                                        <?}?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Сумма заказа <font color="red">*</font></label>
                                    <div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-reorder"></i>
															</span>
                                        <input type="text" class="form-control" name="summ" value="<?=$itemLogShipments["summ"]?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Получатель <font color="red">*</font></label>
                                    <div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-reorder"></i>
															</span>
                                        <input type="text" class="form-control" name="recipient" value="<?=$itemLogShipments["recipient"]?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Номер накладной <font color="red">*</font></label>
                                    <div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-reorder"></i>
															</span>
                                        <input type="text" class="form-control" name="number" value="<?=$itemLogShipments["number"]?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Номер заказа <font color="red">*</font></label>
                                    <div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-reorder"></i>
															</span>
                                        <input type="text" class="form-control" name="id_order" value="<?=$itemLogShipments["id_order"]?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Стоимость доставки <font color="red">*</font></label>
                                    <div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-reorder"></i>
															</span>
                                        <input type="text" class="form-control" name="delivery" value="<?=$itemLogShipments["delivery"]?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn blue" name="submit">Сохранить</button>
                                <button type="button" class="btn red" onClick='location.href="/adminius/index.php?code=news"'>Отмена</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?}?>
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
                <div class="table-toolbar">
                    <div class="btn-group">
                        <button id="sample_editable_1_new" class="btn green" onClick='location.href="/adminius/index.php?code=log_shipments&action=add"'>
                            Добавить <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9 col-sm-12">
                        <div id="sample_1_length" class="dataTables_length">
                            <div class="col-sm-12 col-md-2 col-lg-1">
                                <label>
                                    <select size="1" name="limit" aria-controls="sample_1" class="form-control "
                                            onchange='location.href="index.php?code=orders<?
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
                                    <form role="form" method="GET" action="/adminius/index.php?code=orders">
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
                        <th>Дата отправления</th>
                        <th>Транспортная компания</th>
                        <th>Отправитель</th>
                        <th>Сумма</th>
                        <th>Получатель</th>
                        <th>Номер накладной</th>
                        <th>Менеджер</th>
                        <th>Номер заказа</th>
                        <th>Стоимость доставки</th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody role="alert" aria-live="polite" aria-relevant="all">
                    <? $select_order = selectLogShipments($page, $num, $_GET["from"], $_GET["to"]);
                    //echo "<pre>".print_r($select_order, true)."</pre>";
                    foreach ($select_order as $item) {?>
                        <tr class="odd">
                            <td class=" sorting_1"><?= $item["id"] ?></td>
                            <td class=""><?= $item["date_ship"] ?></td>
                            <td class=""><?= $item["trans_company"] ?></td>
                            <td class=""><?= $item["sender"] ?></td>
                            <td class=""><?= $item["summ"] ?></td>
                            <td class=""><?= $item["recipient"] ?></td>
                            <td class=""><?= $item["number"] ?></td>
                            <td class=""><?= $item["manager"] ?></td>
                            <td class=""><span data-toggle="popoverGoodsMovement" data-content="<?=selectProdLogShipment($item["id"])?>"><?= $item["id_order"] ?></span></td>
                            <td class=""><?= $item["delivery"] ?></td>
                            <td class=""><a class="btn btn-xs blue btn-editable" data-id="1" href="/adminius/index.php?code=log_shipments&action=edit&id=<?=$item["id"]?>"><i class="fa fa-pencil"></i> Edit</a>
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