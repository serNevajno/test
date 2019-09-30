<div class="modal fade" id="newOrderWorkPlace" tabindex="-1" role="dialog" aria-hidden="true" style="top:20px;left:unset; width: unset; margin-left:unset;">
  <div class="modal-dialog" style="margin: unset; width: unset; ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Новый заказ</h4>
      </div>
      <div class="modal-body">
        <form id="modalOrders" action="" method="POST">
          <input name="func" type="hidden" value="addOrdersModal">
          <input type="hidden" value="" name="id_prod" id="modalIdProd">
          <input type="hidden" value="" name="id_provider" id="modalIdProvider">
          <div class="row" style="margin-bottom: 25px;">
            <div class="col-md-12">
              <div class="col-md-12">
                <div class="col-md-4">
                  <input type="text" placeholder="Имя" name="fio" value="" class="form-control" style="margin-bottom: 10px" required>
                </div>
                <div class="col-md-4">
                  <input type="text" placeholder="Адрес" id="ord_address" name="address" value="" class="form-control">
                </div>
                <div class="col-md-4">
                  <input type="text" placeholder="Телефон" class="form-control" name="phone" id="phonemasksearch" value="" style="margin-bottom: 10px" required>
                </div>
              </div>
              <div class="col-md-12">
                <div class="col-md-6">
                  <select class="form-control" name="region" required>
                    <option>Выберите регион</option>
                    <?
                    foreach (selectRegion() as $reg) { ?>
                      <option value="<?= $reg['id'] ?>"><?= $reg['region'] ?></option>
                      <?
                    } ?>
                  </select>
                </div>
                <div class="col-md-6">
                  <select class="form-control" name="delivery" id="delivery_add" required>
                    <option>Выберите тип доставки</option>
                    <option value="1">Самовывоз</option>
                    <option value="2">Доставка</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <table class="table table-bordered table-striped table-condensed flip-content">
                <thead class="flip-content">
                <tr>
                  <th> Название </th>
                  <th> Поставщик </th>
                  <th> Цена </th>
                  <th> Кол-во </th>
                  <th> Сумма </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td><input id="modalName" type="text" readonly value="" class="form-control"></td>
                  <td><input id="modalProvider" type="text" readonly value="" class="form-control"></td>
                  <td><input id="modalPrice" type="text" readonly value="" class="form-control"></td>
                  <td>
                    <div class="input-group">
                      <input type="text" id="modalQuantity" data-availability="" name="modalQuantity" class="spinner-input form-control" maxlength="6"
                             value="4" readonly="">
                      <div class="spinner-buttons input-group-btn btn-group-vertical">
                        <a onClick="modalSummProduct('plus')"
                           class="btn spinner-up btn-xs blue">
                          <i class="fa fa-angle-up"></i>
                        </a>
                        <a onClick="modalSummProduct('minus')"
                           class="btn spinner-down btn-xs blue">
                          <i class="fa fa-angle-down"></i>
                        </a>
                      </div>
                    </div>
                  </td>
                  <td id="modalSumm"></td>
                </tr>
                </tbody>
              </table>
            </div>
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