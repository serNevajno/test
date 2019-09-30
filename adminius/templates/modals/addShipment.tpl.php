<div class="modal fade" id="addShipment" tabindex="-1" role="dialog" aria-hidden="true" style="top:20px;left:unset; width: 60%; margin-left:unset;">
    <div class="modal-dialog" style="margin: unset; width: unset; ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Новый заказ</h4>
            </div>
            <div class="modal-body">
                <!-- BEGIN PAGE CONTENT-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="tabbable tabbable-custom">
                            <h2>Добавление материала..</h2>
                            <br>
                            <form role="form" action="" enctype="multipart/form-data" method="POST" name="form" id="myForm">
                                <input name="func" type="hidden" value="log_shipments">
                                <input name="internal" type="hidden" value="0">
                                <input type="hidden" value="<?=$_GET["id"]?>" name="id_order">
                                <div class="form-body">
                                    <?/*<div class="form-group">
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
                                    </div>*/?>
                                    <div class="form-group">
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
                                    <?/*<div class="form-group">
                                        <label>Сумма заказа <font color="red">*</font></label>
                                        <div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-reorder"></i>
															</span>
                                            <input type="text" class="form-control" name="summ">
                                        </div>
                                    </div>*/?>
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
            </div>
            <div class="modal-footer" style="text-align: center;">
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>