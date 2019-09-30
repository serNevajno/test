<div class="modal fade" id="confirmCashlessModal" tabindex="-1" role="dialog" aria-hidden="true" style="top:20px;left:unset; width: 60%; margin-left:unset;">
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
                                <input name="func" type="hidden" value="cashless">
                                <input type="hidden" value="<?=$_GET["id"]?>" name="id_order" id="idOrderCashless">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label>Выберите дату:</label>
                                        <div style="width: 300px;">
                                            <div class="input-group date-picker input-daterange" data-date="10/11/2012" data-date-format="yyyy-mm-dd">
                                                <input type="text" class="form-control" name="date" value="" placeholder="дата" required>
                                                <span class="input-group-btn">
                                                    <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                                </span>
                                            </div>
                                            <!-- /input-group -->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Номер<font color="red">*</font></label>
                                        <div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-reorder"></i>
															</span>
                                            <input type="text" class="form-control" name="nomer">
                                        </div>
                                    </div>


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