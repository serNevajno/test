<?
if (isset($_GET["limit"])) {
    $num = clearData($_GET["limit"], "i");
} else {
    $num = 10;
}
if (isset($_GET["page"])) {
    $page = clearData($_GET["page"], "i");
} else {
    $page = 1;
}
$sumStorageFree = sumStorageFree($_GET["region"]);
$sumStorageInWork = sumStorageInWork($_GET["region"]);
$sumStorage = $sumStorageFree + $sumStorageInWork;
?>
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<h4>
    <span style="margin-right:20px;">Всего на складе: <?=$sumStorage;?> ед.</span>
    <span style="margin-right:20px;">Свободно: <?=$sumStorageFree;?> ед.</span>
    <span style="margin-right:20px;">В работе: <?=$sumStorageInWork;?> ед.</span>
</h4>
<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-reorder"></i> Форма поиска
        </div>
    </div>
    <div class="portlet-body form">
        <form role="form" method="GET" action="/adminius/index.php?code=product&action=storage">
            <input name="code" type="hidden" value="product">
            <input name="action" type="hidden" value="storage">
            <div class="form-body">
                <div class="form-group">
                    <label>Артикул</label>
                    <input type="text" name="article" class="form-control" placeholder="Введите артикул" value="<?= $_GET["article"] ?>">
                </div>
                <div class="form-group">
                    ИЛИ
                </div>
                <div class="form-group">
                    <label>Название</label>
                    <input type="text" name="name" class="form-control" placeholder="Введите название" value="<?= $_GET["name"] ?>">
                </div>

                <div class="form-group">
                    <label>Категория</label>
                    <select class="form-control" name="categories">
                        <option value="">Все</option>
                        <? recusiveCategories(0, "0", $_GET["categories"]) ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Регион</label>
                    <select class="form-control" name="region">
                        <?foreach(selectRegion() as $iRegion){?>
                          <option value="<?=$iRegion["id"]?>" <?if($_GET["region"] == $iRegion["id"]) echo "selected";?>><?=$iRegion["region"]?></option>
                        <?}?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="">Активность</label>
                    <div class="radio-list">
                        <label class="radio-inline">
                            <input type="radio" name="type" value="0" <? if ($_GET["type"] == 0) echo "checked"; ?>> Свободн
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="type" value="1" <? if ($_GET["type"] == 1) echo "checked"; ?>>
                            В работе
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn blue">Поиск</button>
            </div>
        </form>
    </div>
    <div class="portlet box blue">
        <div class="portlet-body">
            <div class="table-toolbar">
                <div id="ress">
                </div>
                <div class="fileupload fileupload-new" data-provides="fileupload" style="display: inline; margin-bottom: 0; margin-left: 10px;" id="blockButton">
                    <form action="index.php" method="post" enctype="multipart/form-data" style="display: inline;">
                        <input name="func" type="hidden" value="exports_storage">
                        <input name="categories" type="hidden" value="<?= $_GET["categories"] ?>">
                        <input name="article" type="hidden" value="<?= $_GET["article"] ?>">
                        <input name="name" type="hidden" value="<?= $_GET["name"] ?>">
                        <input name="type" type="hidden" value="<?= $_GET["type"] ?>">
                        <input name="region" type="hidden" value="<?= $_GET["region"] ?>">
                        <button class="btn yellow" type="submit"><i class="fa fa-check"></i> Скачать CSV</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="portlet-body">
        <?if($_GET["type"] == "1"){?>
            <? $select_product = selectProductStorageInWork($page, $num, $_GET["name"], $_GET["article"], $_GET["categories"], $_GET["region"]);
            if ($select_product){?>
                <table class="table table-striped table-bordered table-hover" id="sample_1">
                    <thead>
                    <tr>
                        <th>№</th>
                        <th>Название</th>
                        <th>Артикул</th>
                        <th>Кол-во</th>
                        <th>Цена</th>
                        <th>Цена закупа</th>
                        <th>Номер заказа</th>
                    </tr>
                    </thead>
                    <tbody role="alert" aria-live="polite" aria-relevant="all">
                    <? $n = 1 + $start;
                    foreach ($select_product as $item):
                        ?>
                        <tr class="odd">
                            <td class=" sorting_1"><span
                                    <? if (isset($item["active"])): ?>class="label label-sm label-<?= $item["active"] == 1 ? "success" : "danger"; ?>"<? endif;
                                ?>><?= $n ?></span></td>
                            <td class=""><?= $item["name"] ?></td>
                            <td class=""><?if($item["code"]){ echo $item["code"];}else{echo $item["article"];} ?></td>
                            <td class=""><?= $item["quantity"] ?></td>
                            <td class=""><?= $item["price"] ?></td>
                            <td class=""><?= $item["price_clear"] ?></td>
                            <td class=""><a href="/adminius/index.php?code=orders&action=edit&id=<?=$item["id_order"]?>"><?=$item["order_phone"]?><?= $item["id_order"]?></td>
                        </tr>
                        <? $n++; ?>
                    <? endforeach; ?>
                    </tbody>
                </table>
                <? include($_SERVER['DOCUMENT_ROOT'] . '/adminius/templates/pagenav.tpl.php'); ?>
            <? }else{?>
                <h3> По Вашему запросу ничего не найдено!<h3>
            <? } ?>
        <?}else{?>
            <? $select_product = selectProductStorage($page, $num, $_GET["name"], $_GET["article"], $_GET["categories"], $_GET["region"]);
            if ($select_product){?>
                <table class="table table-striped table-bordered table-hover" id="sample_1">
                    <thead>
                    <tr>
                        <th>№</th>
                        <th>Название</th>
                        <th>Артикул</th>
                        <th>Кол-во</th>
                        <th>Цена</th>
                        <th>Цена закупа</th>
                    </tr>
                    </thead>
                    <tbody role="alert" aria-live="polite" aria-relevant="all">
                    <? $n = 1 + $start;
                    foreach ($select_product as $item):
                        ?>
                        <tr class="odd">
                            <td class=" sorting_1"><span
                                    <? if (isset($item["active"])): ?>class="label label-sm label-<?= $item["active"] == 1 ? "success" : "danger"; ?>"<? endif;
                                ?>><?= $n ?></span></td>
                            <td class=""><?= $item["name"] ?></td>
                            <td class=""><?= $item["article"] ?></td>
                            <td class=""><?= $item["availability"] ?></td>
                            <td class=""><?= $item["price"] ?></td>
                            <td class=""><?= $item["price_clear"] ?></td>
                        </tr>
                        <? $n++; ?>
                    <? endforeach; ?>
                    </tbody>
                </table>
                <? include($_SERVER['DOCUMENT_ROOT'] . '/adminius/templates/pagenav.tpl.php'); ?>
            <? }else{?>
                <h3> По Вашему запросу ничего не найдено!<h3>
            <? } ?>
        <? } ?>
    </div>
</div>
<!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////-->