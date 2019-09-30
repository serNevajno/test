<? if ($access["orders"] == 1) { ?>
  <? if (isset($_GET["action"])) { ?>
    <? if ($_GET["action"] == "edit") {?>
    <? } elseif ($_GET['action'] == 'update') { ?>
    <? } elseif ($_GET['action'] == 'add') { ?>
    <? }?>
  <?} else { ?>

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
    $sGoodsMovement = sGoodsMovement($page, $num, $_GET["region"], $_GET['provider'], $_GET['vc']);
    ?>
    <style>
      .goods_movement td{
        padding: 3px !important;
      }
    </style>
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
                          onchange='location.href="index.php?code=goods_movement<?
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
                  <?include_once $_SERVER['DOCUMENT_ROOT']."/adminius/templates/form/filterGoodsMovement.tpl.php"?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <!--<pre><?/*=print_r($sGoodsMovement, true)*/?></pre>-->
        <? if ($sGoodsMovement){ ?>
          <div class="table-responsive">
            <form method="POST" name="goods_movement" id="goods_movement">
              <input name="func" type="hidden" value="<?=$_GET['code']?>">
                <div class="form-group col-md-2">
                  <div style="display: inline-table;">
                    <div class="input-group date-picker input-daterange" data-date="10/11/2012" data-date-format="yyyy-mm-dd">
                      <input type="text" class="form-control" name="date_invoice" value="" placeholder="дата" required>
                      <span class="input-group-btn">
                        <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                      </span>
                    </div>
                    <!-- /input-group -->
                  </div>
                </div>
                <div class="form-group col-md-2">
                  <input type="text" class="form-control" name="num_invoice" placeholder="Номер накладной" value="" required>
                </div>
                <div class="form-group col-md-3">
                      <select class="form-control" name="region" required>
                          <? foreach (selectRegionUser() as $sRegion) { ?>
                              <option value="<?= $sRegion['id'] ?>"><?= $sRegion['region'] ?></option>
                          <? } ?>
                      </select>
                </div>
                <div class="col-md-1">
                  <button type="submit" class="btn blue">Сохранить <i class="fa fa-save"></i></button>
                </div>


              <table class="table table-striped table-bordered table-hover goods_movement" id="sample_1">
                <thead>
                <tr>
                  <th title="Номер заказа" style="width: 80px;">№</th>
                  <th title="Тип заказа">Т. з.</th>
                  <th>Номенклатура</th>
                  <th>Кол.</th>
                  <th>Сумма закупа</th>
                  <th>Цена закупа</th>
                  <?/*<th>Стоимость</th>*/?>
                  <th>Действия</th>
                </tr>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                <? foreach ($sGoodsMovement as $item) { ?>
                  <tr class="odd">
                    <input type="hidden" value="<?=$item['id_order_prod']?>" id="id_order_prod">
                    <td class=" sorting_1">
                      <?if($item['in_storage'] == 0){?>
                        <input type="checkbox" name="arr_id_order_prod[]" value="<?=$item["id_order_prod"] ?>" class="checkbox">
                      <?}else{?>
                          <span style="font-size: 12px; color: green;">Оприходован</span>
                      <?}?>
                      <?= $item["order_phone"] ?><?= $item["id"] ?>
                    </td>
                    <td class="">
                      <?
                        switch($item['delivery']){
                          case "1": $delivery = "<i class='fa fa-home'></i>"; break;
                          case "2": $delivery = "<i class='fa fa-male'></i>"; break;
                          case "3": $delivery = "<i class='fa fa-truck'></i>"; break;
                        }
                        echo $delivery;
                      ?>
                    </td>
                    <td class="">
                      <?= $item['name_prod'] ?>
                    </td>
                    <td class="">
                      <input type="text" value="<?=$item['quantity']?>" id="quantityGoodsMove<?=$item['id_order_prod']?>" style="width:  50px;">
                    </td>
                    <td class="">
                      <input type="text" value="<?=$item['quantity']*$item['price_clear']?>" id="summPriceClearGoodsMove<?=$item['id_order_prod']?>" style="width:  90px;">
                    </td>
                    <td class="">
                      <?/*<a onclick="questionClearPrice(<?=$item['id_order_prod']?>)">*/?>
                      <span id="price_clear"><?=$item['price_clear']?></span> за шт.
                      <?/*</a>*/?>
                    </td>
                    <?/*<td class="">
                      <span id="summ"><?=$item['quantity']*$item['price']?></span> руб
                    </td>*/?>
                    <td style="width: 350px;">

                      <div class="btn-group btn-group btn-group-justified">
                        <?/*
                         <div class="btn-group">
                         <button id="btnGroupVerticalDrop7<?=$item['id_order_prod']?>" type="button" class="btn purple dropdown-toggle" data-toggle="dropdown" title="<?if($item['in_storage'] != 0){?>Оприходован в <?=sRegionById($item['in_storage'])['region']?><?}?>">
                            <?if($item['in_storage'] == 0){?>
                              Оприходовать <i class="fa fa-angle-down"> </i>
                            <?}else{?>
                              Оприходован
                            <?}?>
                          </button>
                          <?if($item['in_storage'] == 0){?>
                          <ul class="dropdown-menu" role="menu" aria-labelledby="btnGroupVerticalDrop7" id="ulGroupVerticalDrop7<?=$item['id_order_prod']?>">
                              <? foreach (selectRegionUser() as $itemReg) { ?>
                              <li><a onclick="changeProvider(<?=$item['id_order_prod']?>, <?= $itemReg['id']?>, <?=$item['id']?>)" style="cursor: pointer;"><?= $itemReg['region']?></a></li>
                              <?} ?>
                          </ul>
                          <?}?>
                      </div>
                        */?>

                        <a class="btn blue" data-container="body" data-toggle="popoverGoodsMovement" data-placement="bottom" data-content='<? if ($item["id_user"] > 0 AND $item["order_phone"] != "T") { ?><?= $item["name_user"] ?> <br> <?=$item["phone"]?><? } else { echo $item["name_order"]."<br>".$item["phone"];} ?>' style="cursor:pointer; padding: 3px 14px;">Клиент</a>

                        <a <?/*onclick="modalOrder(<?=$item['id']?>)"*/?> href="/adminius/index.php?code=orders&action=edit&id=<?=$item['id']?>" target="_blank" class="btn green" style="cursor: pointer; padding: 3px 14px;">открыть заказ</a>
                      </div>
                    </td>
                  </tr>
                <? } ?>
                </tbody>
              </table>
            </form>
          </div>
          <div id="resModal"></div>
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