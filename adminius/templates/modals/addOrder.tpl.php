<div class="modal fade" id="addOrder" tabindex="-1" role="dialog" aria-hidden="true" style="top:20px;left:unset; width: unset; margin-left:unset;">
    <div class="modal-dialog" style="margin: unset; width: unset; ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Новый заказ</h4>
            </div>
            <div class="modal-body">
                <form id="modalOrders" action="" method="POST">
                    <input name="func" type="hidden" value="addOrderKD">
                    <input type="hidden" value="" name="id" id="modalIKDid">
                    <div class="row" style="margin-bottom: 25px;">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <label class="control-label"><b>Выберите тип доставки:</b></label>
                                <select class="form-control" name="delivery" id="deliveryKD" onchange="sAddressKD()" required>
                                    <option>Выберите тип доставки</option>
                                    <option value="0">Самовывоз</option>
                                    <option value="1">Доставка</option>
                                </select>
                            </div>
                            <div class="col-md-6" id="resKD">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <label class="control-label"><b>Выберите резерв:</b></label>
                                <select class="form-control" name="reserve" required>
                                    <option value="0">В работу</option>
                                    <option value="1">Резерв на 3 дня</option>
                                </select>
                            </div>
                        </div>
                        <?/*<div class="col-md-12">
                            <div class="col-md-6">
                                <label class="control-label"><b>Коментарий:</b></label>
                                <textarea class="form-control" name="comment" rows="3"></textarea>
                            </div>
                        </div>*/?>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="text-align: center;">
                <button type="button" class="btn default" data-dismiss="modal">Отмена</button>
                <button type="submit" class="btn green" form="modalOrders">Сформировать заказ</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>