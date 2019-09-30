<div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <form id="formCallBack">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h6 class="modal-title" id="mySmallModalLabel" style="padding: 0px">Запрос на подбор и поиск запчастей по вин коду автомобиля
          </h6>
        </div>
        <div id="modal-body">
          <div class="row modal-body">
						<div class="col-md-12" id="text_error" style="display:none;"></div>
            <div class="col-md-12" style="margin-bottom: 15px;">
              <input class="form-control form-item" type="text" id="vin" name="vin" placeholder="Введите vin код" maxlength="17" required>
            </div>
            <div class="col-md-6" style="margin-bottom: 15px;">
              <select class="form-control form-item" id="listMarka2" name="listMarka2" required>
								<option value="">Выберите марку</option>
                <?foreach(selectListMarkaAuto() as $iMarka){?>
                   <option value="<?=$iMarka['vendor']?>"><?=$iMarka['vendor']?></option>
                <?}?>
              </select>
            </div>
            <div class="col-md-6" style="margin-bottom: 15px;">
              <select class="form-control form-item" id="listModel2" name="listModel2" required> </select>
            </div>
            <div class="col-md-6" style="margin-bottom: 15px;">
              <select class="form-control form-item" id="listYear2" name="listYear2" required> </select>
            </div>
            <div class="col-md-6" style="margin-bottom: 15px;">
              <select class="form-control form-item" id="listModification2" name="listModification2" required> </select>
            </div>

            <div class="col-md-12">
              <textarea style="margin-bottom: 15px;" class="form-control form-item" col="5" rows="5" placeholder="Опишите подробно, какие запчасти Вы ищете. Необходимо подобрать оригинальную запчасть или аналог. Подбор будет выполнен специалистом, стоимость и срок поставки Вам сообщат по указанной контактной информации." name="message" id="message" required></textarea>
            </div>

            <div class="col-md-6" style="margin-bottom: 15px;">
              <input class="form-control form-item" type="text" id="name" name="name" placeholder="Введите ваше ФИО" required>
            </div>

            <div class="col-md-6" style="margin-bottom: 15px;">
              <input class="form-control form-item" type="text" id="phone" name="phone" placeholder="Введите ваш телефон" required>
            </div>

            <div class="col-md-12" style="margin-bottom: 15px;">
              <input class="form-control form-item" type="email" id="email" name="email" placeholder="Ввудите ваш email" required>
            </div>

          </div>
          <div class="modal-footer" style="padding-top: 0px;">
            <span style="float: left;margin-top: 15px;"><i class="fa fa-info"></i> Все поля обязательны для заполнения</span>
            <a onClick="sendCallBack()" class="ht-btn ht-btn-default" style="cursor: pointer;">Оставить заявку</a>
          </div>
        </div>
      </form>
      <div id="textOk">  </div>
    </div>
  </div>
</div>
