<? if ($access["orders"] == 1) { ?>
  <? if (isset($_GET["action"])) { ?>
    <? if ($_GET["action"] == "edit") {
      $item = selectOrderById($_GET["id"]);
      $select_order = selectOrderProductById($_GET["id"]);?>
      <!-- BEGIN EXAMPLE TABLE PORTLET-->
      <? include($_SERVER['DOCUMENT_ROOT'] . '/adminius/templates/modals/addShipment.tpl.php'); ?>
      <? include($_SERVER['DOCUMENT_ROOT'] . '/adminius/templates/modals/addShipmentInternal.tpl.php'); ?>
      <div class="tabbable tabbable-custom" id="modalFrameOrder">
        <ul class="nav nav-tabs">
          <li class="active">
            <a href="#tab_0" data-toggle="tab">Все о заказе</a>
          </li>
          <li>
            <a href="#tab_1" data-toggle="tab">История и отправка СМС</a>
          </li>
        </ul>

        <div class="tab-content">
          <div class="tab-pane active fontawesome-demo" id="tab_0">
            <div class="portlet-body">
              <div class="row">
                <div class="col-md-2" style="text-align: center;">
                  <h2 style="margin: 0px;"><?= $item["order_phone"] ?><?= $_GET["id"] ?></h2>
                  <div class="form-group">
                    <a href="<?= $_COOKIE["back_url"]; ?>" class="btn blue" >Назад</a>
                  </div>
                </div>
                <div class="col-md-10">
                  <table class="table table-bordered table-striped table-condensed flip-content">
                    <thead class="flip-content">
                    </thead>
                    <tbody>
                    <tr>
                      <td>
                        <b>
                          <? switch ($item['typeUser']) {
                            case 1; $typeUser = 'Имя фамилия:'; break;
                            case 2; $typeUser = 'Название ИП:'; break;
                            case 3; $typeUser = 'Название юр.лица:';  break;
                            default: $typeUser = 'Имя фамилия:'; break;
                          } echo $typeUser; ?>
                        </b>
                        <a href="#" id="username" data-type="text" data-pk="<?= $_GET["id"] ?>"
                           data-original-title="Имя фамилия:"><?= $item["name"]; ?></a>
                        <?if($item["name_сontact"]){?>
                          <br>
                          <b>Имя контакта: </b> <?= $item["name_сontact"]; ?>
                        <?}?>
                      </td>
                      <td>
                        <b>Регион:</b>
                        <a href="#" id="region_id_add" data-type="select" data-pk="<?= $_GET["id"] ?>" data-value=""
                           data-original-title="Регион:"><?= $item['name_region'] ?>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <? if ($item['jur_address']) { ?>
                        <td>
                          <b>Юр.адрес:</b> <?= $item['jur_address'] ?>
                        </td>
                      <? } ?>
                      <? if ($item['INN'] OR $item['KPP']) { ?>
                        <td>
                          <b>ИНН:</b> <?= $item['INN'] ?>
                          <br>
                          <b>КПП:</b> <?= $item['KPP'] ?>
                        </td>
                      <? } ?>
                    </tr>
                    <tr>
                      <td>
                        <b>Телефон:</b>
                        <a href="#" id="phone" data-type="text" data-pk="<?= $_GET["id"] ?>"
                           data-original-title="Телефон:">
                          <? if (!$item["phone_user"]) {
                            $phoneOrd = $item["phone"];
                          } else {
                            $phoneOrd = $item["phone_user"];
                          } ?>
                          <?= $phoneOrd ?>
                          <? foreach (sPhoneByOrderId($_GET["id"]) as $ph) { ?>
                            <p><b><?= $ph['phone'] ?></b></p>
                          <? } ?>
                          <p><?= $item['commPhone'] ?></p>
                        </a>
                      </td>
                      <td>
                        <b>Адрес:</b>
                        <a href="#" id="address" data-type="text" data-pk="<?= $_GET["id"] ?>"
                           data-original-title="Адрес:">
                          <?= $item["city"] ?><? if (!$item["address_user"]) {
                            echo $item["address"];
                          } else {
                            echo $item["address_user"];
                          } ?>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <b>E-mail:</b>
                        <? if ($item["email"]) { ?>
                          <?= $item["email"] ?>
                        <? } else { ?>
                          <?= $item["email_order"]; ?>
                        <? } ?>
                      </td>
                      <td>
                        <b>Доставка:</b>
                        <a href="#" id="delivery" data-type="select" data-pk="<?= $_GET["id"] ?>" data-value=""
                           data-original-title="Доставка:">
                          <? if ($item["delivery"] == 1) {
                            echo "Cамовывоз";
                          } elseif ($item["delivery"] == 2) {
                            echo "Доставка силами нашего магазина ";
                          } elseif ($item["delivery"] == 3) {
                            echo "Доставка транспортной компанией";
                          } ?>
                        </a>
                        <p><?= $item['trans_company'] ?></p>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <b>Дата заказа:</b>
                        <?= $item["date"] ?>
                      </td>
                      <td>
                        <b>Тип оплаты:</b>
                        <? if ($item['pay_name']) {
                          echo $item['pay_name'];
                        } else {
                          echo 'не выбрано';
                        } ?>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <b>Сумма заказа:</b>
                        <a onclick="questionCause(<?= $_GET['id'] ?>)">
                          <? if (!$item['summ']) {
                            echo selectSummOrderById($_GET["id"]);
                          } else {
                            echo $item['summ'];
                          } ?>
                        </a> руб
                        <? if ($item['cause']) {
                          echo '<br> Причина: "' . $item['cause'] . '" - ';
                        } ?>
                        <? $sale = (selectSummOrderById($_GET["id"]) - $item['summ']);
                        if ($item['summ'] AND $sale > 0) {
                          echo " скидка: " . $sale . " руб. ";
                        } ?>
                      </td>
                      <td>
                        <a class="btn btn yellow btn-removable" style="margin-bottom: 5px;" data-toggle="modal"
                           data-target="#addShipment">Отправить заказ клиенту</a>
                        <? if (checkLogShipment($_GET["id"], '0') > 0) { ?>
                          <a class="btn blue" style="margin-bottom: 5px;"
                             href="/adminius/templates/printMarking2.tpl.php?id=<?= $_GET["id"] ?>&internal=0">
                            <i class="fa fa-print"></i> Распечатать маркировку
                          </a>
                        <? } ?>
                        <a class="btn btn yellow btn-removable" style="margin-bottom: 5px;" data-toggle="modal"
                           data-target="#addShipmentInternal">Переместить товар</a>
                        <? if (checkLogShipment($_GET["id"], '1') > 0) { ?>
                          <a class="btn blue" style="margin-bottom: 5px;"
                             href="/adminius/templates/printMarking2.tpl.php?id=<?= $_GET["id"] ?>&internal=1">
                            <i class="fa fa-print"></i> Распечатать маркировку
                          </a>
                        <? } ?>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <b>Закуп:</b> <?= selectClearSummOrderById($_GET["id"]) ?> руб
                      </td>
                      <td>
                        <b>Дата ПДЗЗ:</b>
                        <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="yyyy-mm-dd">
                          <input type="text" class="form-control" readonly="" name="from" value="<? if ($item["pdzz"] != "2017-00-00 00:00:00" AND $item["pdzz"] != "0000-00-00 00:00:00") { echo date("Y-m-d", strtotime($item["pdzz"])); } ?>" placeholder="Введите дату" id="pdzz" onchange="uploadPDZZ('<?= $_GET["id"] ?>');">
                          <span class="input-group-btn">
                          <span class="btn default date-set"><i class="fa fa-calendar"></i></span>
                        </span>
                        </div>
                      </td>
                    </tr>

                    </tbody>
                  </table>
                </div>
              </div>

              <hr style="margin: 5px 0;">
              <div class="row">
                <div class="col-md-3">
                  <b>Статус заказа:</b>
                  <div class="input-group input-medium">
                    <form action="index.php" method="POST" name="refform">
                      <input name="func" type="hidden" value="upStatus">
                      <input name="id" type="hidden" value="<?= $_GET["id"] ?>">
                      <input name="sms" type="hidden" value="" id="sms">
                      <select id="iStatus" name="status" class="form-control input-small" style="float: left; height: 25px; padding: 0;">
                        <option value="">Выберите вариант</option>
                        <? foreach (selectStatus() as $iStatus) { ?>
                          <option
                            <? if ($iStatus['id'] == '1') {
                              echo "id='statOk'";
                            } ?>
                            value="<?= $iStatus['id'] ?>"
                            <? if ($iStatus['id'] == $item['id_status']) {
                              echo "selected";
                            } ?>
                            <? if (checkStorage($_GET["id"]) == '1' AND $iStatus['id'] == '1') {
                              echo "disabled";
                            } ?>
                          ><?= $iStatus['name'] ?></option>
                        <? } ?>
                      </select>
                      <input type="text" name="expectation" class="form-control input-small" id="expectation" style="float: left; height: 25px; padding: 0; width: 50px !important; padding-left: 10px; margin-left: 10px;<? if ($item['id_status'] != "11") echo "display:none;"; ?>" placeholder="Время ожидания" value="<?= $item['expectation_hours'] ?>" title="Время ожидания в часах">
                    </form>
                    <? if ($item['id_status'] != "3" AND $item['id_status'] != "1") { ?>
                      <a class="btn btn-xs blue btn-editable" data-id="1"
                         onclick="changeStatus();" style="height: 25px; margin-left: 5px; padding: 4px;"><i class="fa fa-refresh"></i><?/*if (confirm('Отправить SMS?')) {$('#sms').val(1);refform.submit();} else {$('#sms').val(0);refform.submit();}*/?>
                      </a>
                    <? } ?>
                  </div>
                </div>
                <div class="col-md-3">
                  <b>Предоплата:</b>
                  <div class="input-group input-medium">
                    <form action="index.php" method="POST" name="prepaymentForm">
                      <input name="func" type="hidden" value="savePrepayment">
                      <input name="id" type="hidden" value="<?= $_GET["id"] ?>">
                      <input name="sms" type="hidden" value="" id="smsPrepayment">
                      <input name="status" type="hidden" value="<?= $item['id_status'] ?>">
                      <input type="text" class="form-control " placeholder="Предоплата" id="prepayment" name="prepayment" value="<?= $item['prepayment']; ?>">
                      На карту - <input type="checkbox" name="card" value="1" <? if ($item['in_card'] == '1') echo "checked"; ?>>
                    </form>
                    <span class="input-group-btn" style="vertical-align: top;">
                      <a class="btn blue" data-id="1" onclick="if (confirm('Статус заказа будет автоматически изменен на (в обработке). Отправить SMS покупателю?')) {$('#smsPrepayment').val(1);prepaymentForm.submit()} else {$('#smsPrepayment').val(0);prepaymentForm.submit()}" id="savePrepayment"><i class="fa fa-save"></i> </a>
                    </span>
                  </div>
                  <? if ($item['prepayment'] > 0) {
                    if ($item['summ'] > 0) {
                      $rSumm = (int)$item['summ'] - (int)$item['prepayment'];
                    } else {
                      $rSumm = (int)selectSummOrderById($_GET["id"]) - (int)$item['prepayment'];
                    } ?>
                    <label class="control-label col-md-12"><b>Осталось оплатить - <?= $rSumm; ?></b></label>
                    <label class="control-label col-md-12"><b>Дата предоплаты - <?= $item['prepayment_date']; ?></b></label>
                  <? } ?>
                </div>
                <div class="col-md-3" style="padding-top: 20px;">
                  <div class="form-group">
                    <b>Безнал: </b>
                    <input type="checkbox" value="1" data-id="<?= $_GET['id'] ?>" id="beznal" name="beznal" <? if ($item["beznal"] == 1) echo "checked"; ?> onclick="checkBeznal()">
                    &nbsp;
                    <b>УПД подписан: </b>
                    <input type="checkbox" value="1" data-id="<?= $_GET['id'] ?>" data-title="upd" id="upd" name="upd" <? if ($item["upd"] == 1) echo "checked"; ?> onclick="javascript:if(confirm('Вы уверены что хотите подписать УПД?')){checkUpd()}">
                  </div>
                   <?if(selectCashlessById($_GET['id'])){?>
                    <span><?=selectCashlessById($_GET['id'])?></span>
                   <?}?>
                </div>

              </div>

              <hr style="margin: 5px 0;">
              <div class="row">
                <div class="col-md-12">
                  <b>Заказчик:</b>
                  <?= $item['comment']; ?>
                </div>
              </div>

              <? if (sLast2OrderByPhoneOrName($item["phone"], $item["name"], $_GET['id'])) { ?>
                <br>
                <div class="row">
                  <div class="col-md-6">
                    <div class="portlet-body">
                      <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                          <thead>
                          <tr>
                            <th> Заказ #</th>
                            <th> Статус</th>
                            <th> Комментарий менеджера</th>
                          </tr>
                          </thead>
                          <tbody>
                          <? foreach (sLast2OrderByPhoneOrName($item["phone"], $item["name"], $_GET['id']) as $lastOrder) { ?>
                            <tr>
                              <td><a href="/adminius/index.php?code=orders&action=edit&id=<?= $lastOrder['id'] ?>"><?= $lastOrder['id'] ?> </a>
                              </td>
                              <td>
                              <span class="label label-sm label-<?= $lastOrder['code'] ?>">
                                <?= $lastOrder['name_status'] ?>
                              </span>
                              </td>
                              <td> <?= lastCommentsOrder($lastOrder['comments']); ?> </td>
                            </tr>
                          <? } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              <? } else { ?>
                <div class="row">
                  <div class="col-md-6">
                    <div class="bs-callout-small bs-callout-info">
                      <h4>Данный пользовотель впервые совершает покупку!</h4>
                    </div>
                  </div>
                </div>
              <? } ?>

              <!--/row-->
              <a class="btn btn-success" data-toggle="modal" href="#responsive"><i class="fa fa-plus"></i> Добавить позициию</a>
              <script>
                function sendPrint(a, pre) {
                  var cl = "";
                  var che = "<?=checkStorage($_GET["id"]);?>";
                  var prepayment = $('#prepayment').val();

                  if ($("#closeOrder").attr("checked") == 'checked') { cl = "&close=1"; }
                  if (pre == 'none') { pre = "&prepayment=none"; } else { pre = ""; }

                  if (che == "1") {
                    if (prepayment > 0 && cl == "") {
                      window.open('/adminius/index.php?code=orders&action=edit&id=<?= $_GET["id"] ?>&print=' + a + cl + pre, '_blank');
                    } else {
                      alert("Товара нет в наличии! Оприходуйте товар");
                    }
                  } else {
                    window.open('/adminius/index.php?code=orders&action=edit&id=<?= $_GET["id"] ?>&print=' + a + cl + pre, '_blank');
                  }
                }
              </script>
              <? if ($item['id_status'] != "3") { ?>
                <div class="btn-group">
                  <button class="btn blue dropdown-toggle" type="button" data-toggle="dropdown">
                    <i class="fa fa-print"></i> Распечатать чек <i class="fa fa-angle-down"></i>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li>
                      <a id="print" onClick="sendPrint('print');" style="cursor: pointer;">С предоплатой</a>
                    </li>
                    <li>
                      <a id="print" onClick="sendPrint('print', 'none');" style="cursor: pointer;">Без предоплаты</a>
                    </li>
                  </ul>
                </div>

                <div class="btn-group">
                  <button class="btn blue dropdown-toggle" type="button" data-toggle="dropdown">
                    <i class="fa fa-print"></i> Распечатать чек A4 <i class="fa fa-angle-down"></i>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li>
                      <a id="print" onClick="sendPrint('printA4');" style="cursor: pointer;">С предоплатой</a>
                    </li>
                    <li>
                      <a id="print" onClick="sendPrint('printA4', 'none');" style="cursor: pointer;">Без предоплаты</a>
                    </li>
                  </ul>
                </div>
                <? if ($item["delivery"] == 3) { ?>
                  <div class="btn-group">
                    <button class="btn blue" onclick="window.open('/adminius/templates/printMarking.tpl.php?id=<?= $_GET["id"] ?>','_blank')" type="button">
                      <i class="fa fa-print"></i> Распечатать маркировку
                    </button>
                  </div>
                <? } ?>
                <? /*<a class="btn btn-info" id="print" onClick="sendPrint('print');"><i
                      class="fa fa-print"></i> Распечатать чек</a>
                <a class="btn btn-info" id="print" onClick="sendPrint('printA4');"><i
                      class="fa fa-print"></i> Распечатать чек A4</a>*/ ?>
                <? if ($item['prepayment'] > 0) { ?>
                  Закрыть <input type="checkbox" name="close" value="1" id="closeOrder">
                <? } ?>
                <? if ($item['id_status'] == "1") { ?>
                  <a class="btn yellow" onclick="returnOrder(<?= $_GET["id"] ?>);">
                    <i class="fa fa-repeat"></i> Возврат
                  </a>
                <? } ?>
                <div class="btn-group">
                  <?
                  foreach ($select_order as $item_order) {
                    $sWeigth = selectWeigth($item_order["product_id"]);
                    $weight += $sWeigth["weight_1"] * $item_order["quantity"];
                    $scope += $sWeigth["scope_1"] * $item_order["quantity"];
                  }?>
                  Общий вес: <span id="weight"><?= $weight ?></span> кг, общий объем: <span id="scope"><?= $scope ?></span> м3
                  <br>
                  <a onclick="sRegionKladr();" style="cursor:pointer;">Просчитать стоимость доставки</a>
                  <br>
                  <div id="pec_to" style="display: none;" class="row col-md-6"></div>
                </div>
              <? } ?>

              <h3><?= selectGiftProviderByOrder($_GET["id"]) ?></h3>
              <hr>
              <div class=" ">
                <table class="table table-striped table-bordered table-hover" id="sample_1">
                  <thead>
                  <tr>
                    <th>№</th>
                    <th>Название</th>
                    <th>Цена</th>
                    <th>Сумма</th>
                    <th>Кол.</th>
                    <th>Вес / объем</th>
                    <th>Скидка</th>
                    <th>Поставщик</th>
                    <th>Д.л.</th>
                    <th>Код товара</th>
                    <th>НЗСП</th>
                    <th>Склад</th>
                    <th>Действия</th>
                  </tr>
                  </thead>
                  <tbody role="alert" aria-live="polite" aria-relevant="all">
                  <? $n = 1 + $start;
                  foreach ($select_order as $item_order):?>
                    <tr class="odd">
                      <td class=" sorting_1"><?= $n ?></td>
                      <td class=""><a href="<? if ($item_order["product_id"] > 0) {
                          echo "http://" . $_SERVER['SERVER_NAME'] . "/" . $item_order["code_cat"] . "/" . $item_order["code_simv"] . "-" . $item_order["product_id"] . ".html";
                        } else {
                          echo "http://" . $_SERVER['SERVER_NAME'] . "/" . $item_order["categories"] . "/" . $item_order["code"] . ".html";
                        } ?>" target="_blank"><?= $item_order["name"] ?></a></td>
                      <td class=""><?= $item_order["price"] ?>.00 руб</td>
                      <td class=""><?= $item_order["price"] * $item_order["quantity"] ?>.00 руб</td>
                      <td class=""><?= $item_order["quantity"] ?> ед.</td>
                      <td class=""><?= $sWeigth["weight_1"] * $item_order["quantity"] ?>
                        / <?= $sWeigth["scope_1"] * $item_order["quantity"] ?></td>
                      <td class=""><?= $item_order["sale"] ?> %</td>
                      <td class=""><?= $item_order["provider"] ?></td>
                      <td class=""><?= $item_order["day"] ?></td>
                      <td class=""><? if (!$item_order["code"]) {
                          echo $item_order["article"];
                        } else {
                          echo $item_order["code"];
                        } ?></td>
                      <td class="">
                        <? if ($item_order["nzsp"]) { ?>
                          <?= $item_order["nzsp"] ?>
                          <? if ($item_order["id_provider"] == "1") { ?>
                            <br><a onclick="chechStatusFortochki('<?= $item_order["nzsp"] ?>');" style="cursor:pointer;">Проверить статус</a>
                          <? } ?>
                          <? if ($item_order["id_provider"] == "2") { ?>
                            <br><a onclick="checkStatusKD('<?= $item_order["nzsp"] ?>');" style="cursor:pointer;">Проверить статус</a>
                          <? } ?>
                        <? } else { ?>
                          <? if ($item_order["id_provider"] == "1") { ?>
                            <form action="index.php" method="POST" name="orderFortocki<?= $item_order['id'] ?>" style="display:none;">
                              <input name="func" type="hidden" value="orderFortocki">
                              <input name="productOrder_id" type="hidden" value="<?= $item_order['id'] ?>">
                              <input name="article" type="hidden" value="<?= $item_order['article'] ?>">
                              <input name="quantity" type="hidden" value="<?= $item_order['quantity'] ?>">
                              <input name="id" type="hidden" value="<?= $_GET["id"] ?>">
                            </form>
                            <a class="btn btn-xs yellow btn-removable" data-id="1" href="javascript:if(confirm('Вы уверены?')){orderFortocki<?= $item_order['id'] ?>.submit();}">Отправить заказ</a>
                            <? if ($_GET["error_text"] AND $_GET["error_code"] == $item_order['article']) { ?>
                              <br><span><?= $_GET["error_text"] . "; " . $_GET["error_prod"] ?></span>
                            <? } ?>
                          <? } ?>
                          <? if ($item_order["id_provider"] == "2") { ?>
                            <button class="btn btn-xs yellow" data-toggle="modal" data-target="#addOrder" id="btn-modal" onclick="addOrderKolesaDarom(<?= $item_order['id'] ?>)">Создать заказ </button>
                            <? if ($_GET["error"] AND $_GET["error_code"] == $item_order['article']) { ?>
                              <br><span><?= $_GET["error"] ?></span>
                            <? } ?>
                          <? } ?>
                        <? } ?>
                      </td>
                      <td class="">
                        <? if ($item_order["in_storage"] > "0") { ?>
                          На складе <?= $item_order["region_storage"] ?>
                        <? } else { ?>
                          <!-- <form action="index.php" method="POST" name="inStorage<? /*= $item_order['id'] */ ?>"
                              style="display:none;">
                          <input name="func" type="hidden" value="inStorage">
                          <input name="productOrder_id" type="hidden" value="<? /*= $item_order['id'] */ ?>">
                          <input name="id" type="hidden" value="<? /*= $_GET["id"] */ ?>">
                        </form>
                        <a class="btn btn-xs yellow btn-removable" data-id="1"
                           href="javascript:if(confirm('Вы уверены?')){inStorage<? /*= $item_order['id'] */ ?>.submit();}">Оприходовать товар</a>-->
                          <a class="btn btn-xs yellow btn-removable" data-toggle="modal" data-target="#modalStorage"
                             onClick="changeStorage('<?= $item_order['id'] ?>', '<?= $item["region_id"] ?>')">Оприходовать </a>
                        <? } ?>
                      </td>
                      <td class="">
                        <a class="btn btn-xs blue btn-editable" data-id="1"
                           href="/adminius/index.php?code=orders&action=update&id=<?= $item_order['id'] ?>"><i
                            class="fa fa-pencil"></i> Edit</a>
                        <form action="index.php" method="POST" name="delform<?= $item_order['id'] ?>"
                              style="display:none;">
                          <input name="func" type="hidden" value="delProdOrder">
                          <input name="productOrder_id" type="hidden" value="<?= $item_order['id'] ?>">
                          <input name="id" type="hidden" value="<?= $_GET["id"] ?>">
                        </form>
                        <a class="btn btn-xs red btn-removable" data-id="1"
                           href="javascript:if(confirm('Вы уверены?')){delform<?= $item_order['id'] ?>.submit();}"><i
                            class="fa fa-times"></i> Delete</a>
                      </td>
                    </tr>
                    <? $n++; ?>
                  <? endforeach; ?>
                  </tbody>
                </table>
              </div>
              <? include $_SERVER['DOCUMENT_ROOT'] . "/adminius/templates/modals/changeStorage.tpl.php" ?>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label col-md-2"><b>Коментарий менеджера:</b><br>
                      <? if ($item['date_comm'] != '0000-00-00 00:00:00') { ?>
                        <span style="font-size:10px;">Дата комментария: <?= date("d-m-Y H:i:s", strtotime($item['date_comm'])) ?></span>
                        <span style="font-size:10px;">Кто оставил: <?= $item['name_admin_comm'] ?></span>
                      <? } ?>
                    </label>
                    <div class="col-md-10">
                      <? if ($item['comments']) { ?>
                        <div class="portlet-body">
                          <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                              <thead>
                              <tr>
                                <th> Дата</th>
                                <th> Менеджер</th>
                                <th> Комментарий</th>
                              </tr>
                              </thead>
                              <tbody>
                              <? $arrComm = explode('^', $item['comments']);
                              $arrComm = array_filter($arrComm);
                              foreach ($arrComm as $lastComm) {
                                $comm = explode(';', $lastComm); ?>
                                <tr>
                                  <td> <?= $comm['1'] ?> </td>
                                  <td> <?= $comm['0'] ?> </td>
                                  <td> <?= $comm['2'] ?></td>
                                </tr>
                              <? } ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      <? } ?>

                      <p class="form-control-static">
                      <form action="index.php" method="POST" name="comments">
                        <input name="func" type="hidden" value="saveComments">
                        <input name="id" type="hidden" value="<?= $_GET["id"] ?>">
                        <span style="font-size: 10px; color: red; font-weight: 900;">символы ( ; и ^ ) в комментарии НЕ ИСПОЛЬЗОВАТЬ</span>
                        <textarea rows="2" style="width:100%" name="comments" id="commManager"> </textarea>
                        <?/*<script type="text/javascript">
                          CKEDITOR.replace( 'commManager', {
                            toolbar : 'Basic'
                          });
                        </script>*/?>
                      </form>
                      </p>
                      <a class="btn btn-xs blue btn-editable" data-id="1" href="javascript:comments.submit();" style="height: 25px;margin-top: 15px;padding: 4px;float: right;"><i class="fa fa-save"></i> Сохранить </a>
                    </div>
                  </div>
                </div>
              </div>
              <!--/row-->

            </div>
          </div>

          <div class="tab-pane fontawesome-demo" id="tab_1">
            <div style="margin: 15px 0;">
              <select class="form-control input-medium" onchange="tempSms()" id="tempSms" style="margin-bottom:10px;">
                <option selected>Выберете шаблон</option>
                <? foreach (selectTemplatesSMS() as $iTempSms) { ?>
                  <option><?= $iTempSms["text"] ?></option>
                <? } ?>
              </select>
              <form method="POST">
                <input type="hidden" value="addSms" name="func">
                <input type="hidden" value="<?= $_GET["id"] ?>" name="id_order">
                <input type="hidden" value="<?= $phoneOrd ?>" name="phone">
                <textarea class="form-control" name="text" rows="3" id="tempSmsText"></textarea>
                <button class="btn green" type="submit" style="width: 100%;">Отправить СМС</button>
              </form>
            </div>
            <? $sSms = selectSmsByOrder($_GET["id"]);
            if ($sSms) {
              ?>
              <div class="portlet-body flip-scroll">
                <table class="table table-bordered table-striped table-condensed flip-content">
                  <thead class="flip-content">
                  <tr>
                    <th>
                      Текст
                    </th>
                    <th>
                      Дата
                    </th>
                  </tr>
                  </thead>
                  <tbody>
                  <? foreach ($sSms as $iSms) {
                    ?>
                    <tr>
                      <td><?= $iSms["text"] ?></td>
                      <td><?= $iSms["date"] ?></td>
                    </tr>
                  <? } ?>

                  </tbody>
                </table>
              </div>
            <? } ?>
          </div>

        </div>
      </div>

      <!-- END EXAMPLE TABLE PORTLET-->
      <!-- responsive -->
      <div id="responsive" class="modal fade" tabindex="-1" data-width="760">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
          <h4 class="modal-title">Добавление позиции к заказу</h4>
        </div>
        <form action="index.php" method="POST" name="addproduct">
          <div class="modal-body">
            <div class="row">
              <input name="func" type="hidden" value="saveProduct">
              <input name="id" type="hidden" value="<?= $_GET["id"] ?>">
              <div class="col-md-12">
                <div class="form-group">
                  <select name="type" class="form-control" required>
                    <option value="">Укажите тип продукта</option>
                    <option value="tyres">Шины</option>
                    <option value="disk">Диски</option>
                    <option value="product">Другие товары</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <h4>Укажите код товара</h4>
                <p>
                  <input name="code" class="form-control" type="text" placeholder="Укажите код товара" required>
                </p>
              </div>
              <div class="col-md-6">
                <h4>Укажите кол-во</h4>
                <p>
                  <input name="quantity" class="form-control" type="text" placeholder="Укажите кол-во" required>
                </p>
              </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-default">Отмена</button>
            <button class="btn blue" type="submit">Сохранить</button>
          </div>
        </form>
      </div>
      <? include($_SERVER['DOCUMENT_ROOT'] . '/adminius/templates/modals/addOrder.tpl.php'); ?>
    <? } elseif ($_GET['action'] == 'update') { ?>

      <? $rProd = selectProductByOrder($_GET['id']); ?>
      <div class="portlet box blue">
        <div class="portlet-title">
          <div class="tools">
          </div>
        </div>
        <div class="portlet-body">
          <h2 class="margin-bottom-20">Код товара:
            <?= $rProd['article'] ?> /
            <? if (!$rProd['code']) {
              echo str_pad($rProd['product_id'], 6, '0', STR_PAD_LEFT);
            } else {
              echo str_pad($rProd['code'], 6, '0', STR_PAD_LEFT);
            } ?></h2>
          <h3 class="form-section">Данные товара</h3>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3"><b>Название:</b></label>
                <div class="col-md-9" style="width: 88%;">
                  <p class="form-control-static">
                    <?= $rProd['name'] ?>
                  </p>
                </div>
              </div>
            </div>
            <!--/span-->
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3"><b>Номер заказа:</b></label>
                <div class="col-md-9" style="width: 80%;">
                  <p class="form-control-static">
                    <?= $rProd['id_order'] ?>
                  </p>
                </div>
              </div>
            </div>
            <!--/span-->
          </div>
          <!--/row-->
          <div class="form-section"></div>
          <form role="form" action="index.php" enctype="multipart/form-data" method="POST" name="form" id="myForm">
            <div class="row">
              <? if (selectPriceProviderAll($rProd['product_id'])) { ?>
                <div class="col-md-12" style="margin-top: 10px;">
                  <table class="table table-bordered table-striped table-condensed flip-content">
                    <thead class="flip-content">
                    <tr>
                      <th> Поставщик</th>
                      <th class="numeric"> Цена</th>
                      <th class="numeric"> Чистая цена</th>
                      <th> Кол-во</th>
                      <th> Дни поставки</th>
                      <th> Дата обновления</th>
                    </tr>
                    </thead>
                    <tbody>

                    <? foreach (selectPriceProviderAll($rProd['product_id']) as $priceProd) {
                      if ($priceProd['id_provider'] == $rProd['provider']) {
                        $style = "style='color: #cb1010; font-weight: 600;'";
                        echo '<input type="hidden" id="chProvider" value="' . $rProd['provider'] . '">';
                      } else {
                        $style = "";
                      } ?>
                      <tr <?= $style ?> id="trProvider<?= $priceProd['id_provider'] ?>">
                        <td>
                          <label class="radio-inline">
                            <input type="radio"
                                   onclick="changePosOrder(<?= $rProd['id'] ?>, <?= $priceProd['price'] ?>, <?= $priceProd['price_clear'] ?>, <?= $priceProd['logistic'] ?>, <?= $priceProd['id_provider'] ?>, <?= $rProd['product_id'] ?>, <?= $rProd['region'] ?>)"
                                   name="provider[<?= $rProd['id'] ?>]" value="<?= $priceProd['id_provider'] ?>"
                              <? if ($priceProd['id_provider'] == $rProd['provider']) {
                                echo "checked";
                              } ?>> <?= $priceProd['name'] ?>
                          </label>
                        </td>
                        <td class="numeric"> <?= $priceProd['price'] ?> </td>
                        <td class="numeric"> <?= $priceProd['price_clear'] ?> </td>
                        <td id="ctn<?= $priceProd['id_provider'] ?>"> <?= $priceProd['availability'] ?> </td>
                        <td> <?= $priceProd['logistic'] ?> </td>
                        <td> <?= $priceProd['date'] ?></td>
                      </tr>
                    <? } ?>
                    <? if ($rProd['provider'] == 12) {
                      $style = "style='color: #cb1010; font-weight: 600;'";
                    } else {
                      $style = "";
                    } ?>
                    <tr <?= $style ?> id="trProvider12">
                      <? $sPriceProvider12 = sPriceProvider12($rProd['id']); ?>
                      <td>
                      </td>
                      <td>
                        <input type="text" name="price" id="price" value="<?= $rProd['price'] ?>"
                               placeholder="Введите цену" class="form-control">
                      </td>
                      <td>
                        <input type="text" name="price_clear" id="price_clear" value="<?= $rProd['price_clear'] ?>"
                               placeholder="Введите чистую цену" class="form-control">
                      </td>
                      <td></td>
                      <td>
                        <input type="text" name="logistic" id="logistic" value="<?= $rProd['day'] ?>"
                               placeholder="Введите дни доставки" class="form-control">
                      </td>
                      <td><a class="btn blue btn-sm" onclick="changeOtherProvider(<?= $rProd['id'] ?>)"
                             style="cursor: pointer;">сохранить</a></td>
                    </tr>
                    </tbody>
                  </table>
                </div>
              <? } ?>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group col-md-3">
                  <label><b>НЗСП:</b> </label>
                  <input type="text" class="form-control input-medium" name="nzsp" placeholder="Введите НЗСП"
                         value="<?= $rProd['nzsp'] ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">

                <input name="func" type="hidden" value="upProdOrder">
                <input name="id" type="hidden" value="<?= $_GET['id'] ?>">
                <input name="id_order" type="hidden" value="<?= $rProd['id_order'] ?>
								<? /* <div class="form-group">
									<label><b>Цена:</b></label>
									<div class="input-group input-medium">
										<span class="input-group-addon">
											UAH
										</span>
										<input type="text" class="form-control" id="price" name="price" placeholder="Введите цену" value="<?=$item["price"]?>">
									</div>
								</div> */ ?>
								<div class="form-group">
                <label class="control-label col-md-3"><b>Количество</b></label>
                <div class="col-md-9" style="width: 85%;">
                  <div id="spinner1">
                    <div class="input-group input-small">
                      <input type="text" name="quantity" id="quantity" class="spinner-input form-control" maxlength="3"
                             value="<?= $rProd["quantity"] ?>" readonly>
                      <div class="spinner-buttons input-group-btn btn-group-vertical">
                        <button type="button" class="btn spinner-up btn-xs blue">
                          <i class="fa fa-angle-up"></i>
                        </button>
                        <button type="button" class="btn spinner-down btn-xs blue">
                          <i class="fa fa-angle-down"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                  <span class="help-block">

										</span>
                </div>
              </div>

              <br/>

              <div class="form-group" style="margin-left:35px;margin-top:55px;">
                <? if ($_GET["error"] == "1") { ?>
                  <div style="color:#cb1010;">На складе нету такого количества.</div>
                <? } ?>
                <button type="submit" class="btn blue" name="submit">Сохранить</button>
                <button type="button" class="btn default"
                        onClick='location.href="/adminius/index.php?code=orders&id=<?= $rProd['id_order'] ?>"'>Отмена
                </button>
              </div>
          </form>
        </div>
      </div>
      <!--/row-->
      </div>
      </div>

    <? } elseif ($_GET['action'] == 'add') { ?>
      <h2>Оформление заказа</h2>
      <br>
      <div class="row">
        <form role="form" method="POST">
          <input name="func" type="hidden" value="addOrder">

          <div class="col-md-12" style="margin-bottom: 65px">

            <h4>Данные клиента</h4>
            <div class="row" style="margin-bottom: 25px;">
              <div class="col-md-12">
                <div class="col-md-12">
                  <div class="col-md-4">
                    <input type="text" placeholder="Имя" name="fio" value="" class="form-control"
                           style="margin-bottom: 10px" required>
                  </div>
                  <div class="col-md-4">
                    <input type="text" placeholder="Адрес" id="ord_address" name="address" value=""
                           class="form-control">
                  </div>
                  <div class="col-md-4">
                    <input type="text" placeholder="Телефон" class="form-control" name="phone" id="phonemasksearch"
                           value="" style="margin-bottom: 10px" required>
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
                    <select class="form-control" name="delivery" id="delivery_add">
                      <option value="">Выберите тип доставки</option>
                      <option value="1">Самовывоз</option>
                      <option value="2">Доставка</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <h4>По артикулу или названию</h4>
            <div class="form-group">
              <div class="radio-list">
                <label class="radio-inline">
                  <div class="radio">
                    <span class="checked"><input type="radio" name="sezon" value="Летняя " id="leto"
                                                 onclick="checkSeason()"></span>
                  </div>
                  Лето
                </label>
                <label class="radio-inline">
                  <div class="radio">
                    <span><input type="radio" name="sezon" value="Зимняя " id="zema" onclick="checkSeason()"></span>
                  </div>
                  Зима </label>
                <label class="radio-inline">
                  <div class="radio">
                    <span><input type="radio" name="sezon" value="Всесезонная " id="vse" onclick="checkSeason()"></span>
                  </div>
                  Всесезонная
                </label>
              </div>
            </div>
            <input type="text" placeholder="Начните писать код товара или название" class="form-control" name="code"  id="input-search" autocomplete="off">

            <div id="block-search-result" style="display: none;">
              <ul id="result_search">

              </ul>
            </div>

          </div>

          <hr/>
          <div class="col-md-12">
            <div class="block-res-prod">
              <div class="res-prod">
                <? $n = 0;
                foreach (selectBasket() as $item) {
                  $season = selectElementValueFilter($item['product_id'], '23');
                  if ($season == "156") {
                    $season_icon = '<li style="display: inline;
    margin-right: 10px;"><i class="fa fa-asterisk" style="color:#489fdf;"></i> Зимние</li>';
                  } elseif ($season == "155") {
                    $season_icon = '<li style="display: inline;
    margin-right: 10px;"><i class="fa fa-sun-o" style="color:#f0ad4e;"></i> Летние</li>';
                  } elseif ($season == "157") {
                    $season_icon = '<li style="display: inline;
    margin-right: 10px;"><i class="fa fa-sun-o" style="color:#f0ad4e;"></i> <i class="fa fa-snowflake-o" style="color:#489fdf;"></i> Всесезонные</li>';
                  }
                  $thorn = selectElementValueFilter($item['product_id'], '24');
                  if ($thorn == "158") {
                    $thornn_icon = '<li style="display: inline;
    margin-right: 10px;"><i class="fa fa-dot-circle-o"></i> Шипованные</li>';
                  } else {
                    $thornn_icon = '<li style="display: inline;
    margin-right: 10px;"><i class="fa fa-circle-o"></i> Нешипованные</li>';
                  }
                  $totalPrice = $item['price'] * $item['quantity'];
                  $sProdId = selectProductById($item['product_id']);
                  $dateLog = date('d.m.Y', strtotime('+' . $sProdId["logistic"] . ' days')); ?>
                  <div class="row">
                    <div class="col-sm-12 col-md-2 col-lg-2" style="text-align:center;">
                      <a href="<?= $item[url] ?>" class="product-img">
                        <img src="<?= $item[img] ?>" alt="image" style="max-width:120px">
                      </a>
                    </div>
                    <div class="col-sm-12 col-md-5 col-lg-5">
                      <div class="product-caption">
                        <h4 class="product-name" style="padding-top:0px;margin-top:0px;">
                          <a href="<?= $item[url] ?>" class="f-18"><?= $item[name] ?> ( <?= $item[article] ?> )</a>
                        </h4>
                      </div>
                      <ul class="static-caption m-t-lg-20" style="list-style: none; padding: 0px">
                        <?= $season_icon ?><? if ($season != '155') {
                          echo $thornn_icon;
                        } ?>
                      </ul>
                      <div class="col-md-12" style="padding: 0px;">
                        <i class="fa fa-truck"></i> Получение: самовывоз или доставка (<?= $dateLog ?>)
                      </div>
                      <? if (selectPriceProvider($item['product_id'])) {
                        ?>
                        <div class="col-md-12" style="margin-top: 10px;">
                          <table class="table table-bordered table-striped table-condensed flip-content">
                            <thead class="flip-content">
                            <tr>
                              <th> Поставщик</th>
                              <th class="numeric"> Цена</th>
                              <th class="numeric"> Чистая цена</th>
                              <th> Кол-во</th>
                              <th> Дни поставки</th>
                              <th> Дата обновления</th>
                            </tr>
                            </thead>
                            <tbody>

                            <? foreach (selectPriceProvider($item['product_id']) as $priceProd) {
                              if ($priceProd['id_provider'] == $item['provider']) {
                                $style = "style='color: #cb1010; font-weight: 600;'";
                              } else {
                                $style = "";
                              } ?>
                              <tr <?= $style ?>>
                                <td>
                                  <label class="radio-inline">
                                    <input type="radio"
                                           onclick="changePosBascket(<?= $item['id'] ?>, <?= $priceProd['price'] ?>, <?= $priceProd['price_clear'] ?>, <?= $priceProd['logistic'] ?>, <?= $priceProd['id_provider'] ?>, <?= $n ?>)"
                                           name="provider[<?= $item['id'] ?>]"
                                           value="<?= $priceProd['id_provider'] ?>" <? if ($priceProd['id_provider'] == $item['provider']) {
                                      echo "checked";
                                    } ?>> <?= $priceProd['name'] ?>
                                  </label>
                                </td>
                                <td class="numeric"> <?= $priceProd['price'] ?> </td>
                                <td class="numeric"> <?= $priceProd['price_clear'] ?> </td>
                                <td> <?= $priceProd['availability'] ?> </td>
                                <td> <?= $priceProd['logistic'] ?> </td>
                                <td> <?= $priceProd['date'] ?></td>
                              </tr>
                            <? } ?>
                            </tbody>
                          </table>
                        </div>
                      <? } ?>
                    </div>
                    <div class="col-sm-12 col-md-5 col-lg-5" style="padding:0px;">
                      <div class="col-sm-12 col-md-4 col-lg-4" style="text-align: center;margin-top:2%;">
                        <div class="form-group dop">
                          <div>
                            <b class="product-price">В наличии:
                              <? if ($sProdId['availability'] > 4) {
                                ?>Много<? } ?>
                              <? if ($sProdId['availability'] == 4) {
                                ?>4<? } ?>
                              <? if ($sProdId['availability'] < 4) {
                                echo $sProdId['availability'];
                              } ?>
                            </b>
                          </div>

                          <div>
                            <div class="input-group">
                              <input type="text" id="valInput<?= $n ?>" class="spinner-input form-control" maxlength="6"
                                     value="<?= $item['quantity'] ?>" readonly="">
                              <div class="spinner-buttons input-group-btn btn-group-vertical">
                                <a onClick="summProduct(<?= $item['id'] ?>, 'plus', <?= $n ?>)"
                                   class="btn spinner-up btn-xs blue">
                                  <i class="fa fa-angle-up"></i>
                                </a>
                                <a onClick="summProduct(<?= $item['id'] ?>, 'minus', <?= $n ?>)"
                                   class="btn spinner-down btn-xs blue">
                                  <i class="fa fa-angle-down"></i>
                                </a>
                              </div>
                            </div>
                          </div>

                        </div>
                      </div>
                      <div class="col-sm-12 col-md-3 col-lg-3"
                           style="padding: 1em 0; text-align: center;padding-left:15px;">
                        <div style="font-weight: 500;">Цена 1шт:</div>
                        <b class="product-price" id="product-price<?= $n ?>" style="font-size:18px;"><?= $item[price] ?>
                          руб</b>
                      </div>
                      <div class="col-sm-12 col-md-5 col-lg-5" style="text-align: center;">
                        <b class="product-price color-red" style="font-size: 18px"><span
                            id="summProduct<?= $n ?>"><?= $totalPrice ?> руб</span></b>
                        <div class="form-group">
                          <a class="btn red" style="margin:0px; cursor:pointer;"
                             onclick="delPosBasket(<?= $item['id'] ?>)">Удалить</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <? $n++;
                } ?>


                <div class="col-md-12" style="font-weight: 700; text-align: right; font-size: 18px;">
                  Сумма заказа: <span id="total"><?= sumBasket() ?> руб</span>
                </div>
                <hr/>

              </div>
            </div>
          </div>

          <div class="col-md-12" style="text-align: center;">
            <button class="btn green">Сформировать заказ</button>
          </div>
        </form>
      </div>
      <hr/>

    <? }
  } else { ?>

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
    $select_order = selectOrder($page, $num, $_GET["num_order"], $_GET["from"], $_GET["to"], $_GET['status'], $_GET['phone'], $_GET['typePay'], $_GET['kassa'], $_GET['manager'], $_GET["region"], $_GET['provider'], $_GET['prepayment']);
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
                          onchange='location.href="index.php?code=orders<?
                          if ($_GET['status']) echo '&status=' . $_GET['status'];
                          if ($_GET['phone']) echo '&phone=' . $_GET['phone'];
                          if ($_GET['to']) echo '&to=' . $_GET['to'];
                          if ($_GET['from']) echo '&from=' . $_GET['from'];
                          if ($_GET['typePay']) echo '&typePay=' . $_GET['typePay']; ?>&limit="+this.value'>
                    <option value="10" <? if ($num == 10) echo "selected='selected'"; ?>>10</option>
                    <option value="25" <? if ($num == 25) echo "selected='selected'"; ?>>25</option>
                    <option value="50" <? if ($num == 50) echo "selected='selected'"; ?>>50</option>
                    <option value="100" <? if ($num == 100) echo "selected='selected'"; ?>>100</option>
                    <option value="0" <? if ($num == 0) echo "selected='selected'"; ?>>All</option>
                  </select>
                </label>
              </div>
              <div class="col-sm-12 col-md-10 col-lg-11">
                <a href="/adminius/index.php?code=orders&action=add" class="btn green">Добавить заказ</a>
                <a href="/adminius/index.php?code=statusOrderAPI" class="btn btn-info">Пров. статусов заказа по пост.</a>
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
                  <a class="accordion-toggle<? if (!isset($_GET["num_order"])) echo " collapsed"; ?>"
                     data-toggle="collapse" data-parent="#accordion1"
                     href="#collapse_1">
                    ФИЛЬТР </a>
                </h4>
              </div>
              <div id="collapse_1" class="panel-collapse in <? /*if(isset($_GET["num_order"])) echo " in";*/ ?>"
                   style="<? if (isset($_GET["num_order"])) {
                     echo "height: auto;";
                   } else {
                     echo "height: 0px;";
                   } ?>">
                <div class="portlet-body form">
                  <? include_once $_SERVER['DOCUMENT_ROOT'] . "/adminius/templates/form/filterOrders.tpl.php" ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <? if ($select_order){ ?>
          <? if ($_GET['from'] and $_GET['to'] and $_GET['kassa'] == 1) {
            $sSummSale = sSummSaleOrderByDate($_GET['from'], $_GET['to'], $_GET["manager"], $_GET["region"]);
            $sSummSaleReturn = sSummSaleOrderByDateReturn($_GET['from'], $_GET['to'], $_GET["manager"], $_GET["region"]);
            $sSummOrder = sSummOrderByDate($_GET['from'], $_GET['to'], $_GET["manager"], $_GET["region"]);
            $sSummOrderReturn = sSummOrderByDateReturn($_GET['from'], $_GET['to'], $_GET["manager"], $_GET["region"]);
            if ($sSummSale > 0) {
              $saleOrder = $sSummOrder - $summOrder;
            }
            $summOrder = $sSummOrder;

            if ($sSummSaleReturn > 0) {
              $summOrderReturn = $sSummOrderReturn - $sSummSaleReturn;
              $saleOrderReturn = $sSummOrderReturn - $summOrderReturn;
            } else {
              $summOrderReturn = $sSummOrderReturn;
            }
            $beznalSum = sSumBezNal($_GET['from'], $_GET['to'], $_GET["manager"], $_GET["region"]);
            $beznalSumReturn = sSumBezNalReturn($_GET['from'], $_GET['to'], $_GET["manager"], $_GET["region"]);
            $nalSum = sSumNal($_GET['from'], $_GET['to'], $_GET["manager"], $_GET["region"]);
            $nalSumReturn = sSumNalReturn($_GET['from'], $_GET['to'], $_GET["manager"], $_GET["region"]);
            $inCardSum = sSumInCard($_GET['from'], $_GET['to'], $_GET["manager"], $_GET["region"]);
            $inCardSumReturn = sSumInCardReturn($_GET['from'], $_GET['to'], $_GET["manager"], $_GET["region"]);
            $nalSum = $nalSum - $inCardSum;
            $nalSumReturn = $nalSumReturn - $inCardSumReturn;
            ?>
            <h4>
              <span style="margin-right:20px;">Сумма: <?= number_format($summOrder - $summOrderReturn, 2) ?> </span>

              <? if ($sSummSale > 0) { ?>
                <span style="margin-right:20px;">Скидка: <?= number_format($sSummSale - $saleOrderReturn, 2) ?></span>
              <? } ?>
              <? if ($beznalSum) { ?>
                <span style="margin-right:20px;">Безнал: <?= number_format($beznalSum - $beznalSumReturn, 2) ?></span>
              <? } ?>
              <? if ($nalSum) { ?>
                <span style="margin-right:20px;">Нал: <?= number_format($nalSum - $nalSumReturn, 2) ?></span>
              <? } ?>
              <? if ($inCardSum) { ?>
                <span style="margin-right:20px;">На карте: <?= number_format($inCardSum - $inCardSumReturn, 2) ?></span>
              <? } ?>
            </h4>
            <form action="index.php" method="post" enctype="multipart/form-data" style="padding-bottom: 10px;">
              <input name="func" type="hidden" value="exports_orders">
              <input name="from" type="hidden" value="<?= $_GET["from"] ?>">
              <input name="to" type="hidden" value="<?= $_GET["to"] ?>">
              <input name="manager" type="hidden" value="<?= $_GET["manager"] ?>">
              <input name="region" type="hidden" value="<?= $_GET["region"] ?>">
              <button class="btn yellow" type="submit"><i class="fa fa-check"></i> Скачать CSV</button>
            </form>
          <? } ?>
          <? if ($_GET['from'] and $_GET['to']) { ?>
            <form action="index.php" method="post" enctype="multipart/form-data" style="padding-bottom: 10px;">
              <input name="func" type="hidden" value="exports_orders_full">
              <input name="from" type="hidden" value="<?= $_GET["from"] ?>">
              <input name="to" type="hidden" value="<?= $_GET["to"] ?>">
              <input name="manager" type="hidden" value="<?= $_GET["manager"] ?>">
              <input name="region" type="hidden" value="<?= $_GET["region"] ?>">
              <button class="btn yellow" type="submit"><i class="fa fa-check"></i> Скачать все заказы CSV</button>
            </form>
          <? } ?>
          <? if ($_GET['manager']) { ?>
            <h4>
              <span
                style="margin-right:20px;">Сумма единиц: <?= sumQuantityOrderByManager($_GET['from'], $_GET['to'], $_GET["manager"]); ?> </span>
              <span
                style="margin-right:20px;">Маржинальность: <?= selectMarginalityOrder($_GET['from'], $_GET['to'], $_GET["manager"]) ?></span>
              <span style="margin-right:20px;">Средний чек: <?= $summOrder / $posts; ?></span>
            </h4>
          <? } ?>
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="sample_1">
              <thead>
              <tr>
                <th title="Номер заказа">№</th>
                <th>Дата продажи</th>
                <th>Статус</th>
                <th>Сумма</th>
                <th>Кол.</th>
                <th>Клиент</th>
                <th>Регион</th>
                <th>Коментарий</th>
                <th>Дата заказа</th>
                <th>Действия</th>
              </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
              <? foreach ($select_order as $item) { ?>
                <tr class="odd">
                  <td class=" sorting_1"><?= $item["order_phone"] ?><?= $item["id"] ?></td>
                  <td class=""><? if ($item['date_end'] != '0000-00-00 00:00:00') {
                      echo $item['date_end'];
                    } ?></td>
                  <td class="">
                    <span class="label label-sm label-<?= $item['code'] ?>"><?= $item['name_status'] ?></span>
                  </td>
                  <td class=""><? if ($item['summ'] > 0) {
                      echo $item['summ'];
                    } else {
                      echo selectSummOrderById($item["id"]);
                    } ?> руб
                  </td>
                  <td class=""><?= sumQuantityOrder($item["id"]) ?> ед.</td>
                  <td class=""><? if ($item["id_user"] > 0 AND $item["order_phone"] != "T") {
                      ?><a href="/adminius/index.php?code=users&action=detail&id=<?= $item["id_user"] ?>"><?= $item["name_user"] ?></a><? } else {
                      echo $item["name_order"];
                    } ?></td>
                  <td class=""><?= $item["name_region"] ?></td>
                  <td class="" style="min-width: 250px !important;white-space:unset;">
                    <?= lastCommentsOrder($item['comments']); ?> |
                    <?= lastCommentsDateOrder($item['comments']); ?>
                  </td>
                  <td class=""><?= $item["date"] ?></td>
                  <td class="">
                    <a class="btn btn-xs blue btn-editable" data-id="1"
                       href="/adminius/index.php?code=orders&action=edit&id=<?= $item["id"] ?>"><i
                        class="fa fa-pencil"></i>
                      Детально</a>
                    <a href="javascript:if(confirm('Вы уверены?')){createDoubleOrders(<?= $item['id'] ?>);}"
                       class="btn btn-xs yellow"><i class="fa fa-copy"></i> </a>
                  </td>
                </tr>
              <? } ?>
              <? if ($_GET["status"] > 0) { ?>
                <tr>
                  <td style="border: 0px;"></td>
                  <td style="border: 0px;"></td>
                  <td style="border: 0px;"></td>
                  <td style="border: 0px;"><?= sumByStatus($_GET["status"], $_GET["region"]) ?> руб</td>
                  <td style="border: 0px;"></td>
                  <td style="border: 0px;"></td>
                  <td style="border: 0px;"></td>
                  <td style="border: 0px;"></td>
                  <td style="border: 0px;"></td>
                  <td style="border: 0px;"></td>
                </tr>
              <? } ?>
              </tbody>
            </table>
          </div>
          <? include($_SERVER['DOCUMENT_ROOT'] . '/adminius/templates/pagenav.tpl.php'); ?>
        <? }else{ ?>
        <h3> По Вашему запросу ничего не найдено.<h3>
            <? } ?>
      </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
  <? } ?>
<? } else { ?>
  <h3>Отказано в доступе, недостаточно прав.<h3>
<? } ?>