<? $sProductList = selectProductList($_GET["categories_code"]);
$parCat = parentCategories($sProductList[0]["id_cat"]);
$arrCat = selectCategoriesByCodeV2($_GET["categories_code"]);
if ($parCat == 1) {
  $pCat = 'tyres';
} else if ($parCat == 2) {
  $pCat = 'disk';
}
?>
<!-- Main content -->
<div id="wrap-body" class="p-t-lg-30">
  <div class="container">
    <div class="wrap-body-inner">
      <!-- Breadcrumb-->
      <? include ($_SERVER['DOCUMENT_ROOT']) . '/templates/breadcrumbs.tpl.php'; ?>
      <!-- Product list -->
      <section class="block-product m-t-lg-30 m-t-xs-0">
        <div class="row">
          <? include ($_SERVER['DOCUMENT_ROOT']) . '/templates/left_col.fullProduct.tpl.php'; ?>
          <div class="col-sm-8 col-md-8 col-lg-9">
            <? if ($sProductList) { ?>
              <div class="product product-list">
                <div class="heading heading-2 m-b-lg-0">
                  <h3 class="p-l-lg-20"><?= $meta_item["name"] ?> </h3>
                </div>
                <!-- Product filter -->
                <div class="product-filter p-t-xs-20 p-l-xs-20">
                  <div class="pull-right">
                    <div class="m-b-xs-10 m-r-lg-20 pull-left">
                      <div class="select-wrapper">
                        <label><i class="fa fa-sort-alpha-asc"></i>Сортировать : </label>
                        <div class="dropdown pull-left">
                          <button class="dropdown-toggle form-item w-220" type="button" id="sortProduct" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">новые
                          </button>
                          <ul class="dropdown-menu" aria-labelledby="sortProduct" id="listSort">
                            <li>от дешевых к дорогим</li>
                            <li>от дорогих к дешевым</li>
                            <li>популярные</li>
                            <li>по рейтингу</li>
                            <li>новые</li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
                <? if ($parCat == 1) {
                  include_once $_SERVER['DOCUMENT_ROOT'].'/templates/form/miniFilter.tpl.php';
                }?>
                <!-- Product item -->
                <div>
                  <? if ($parCat == 1 OR $parCat == 2) { ?>
                    <div class="row">
                      <div class="col-md-3">
                        <? if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/images/categories_cover/' . $arrCat["img"]) AND $arrCat["img"]) { ?>
                          <img src="/scripts/phpThumb/phpThumb.php?src=/images/categories_cover/<?= $arrCat["img"] ?>&w=400&h=400&far=1&bg=ffffff&f=jpg" alt="<?= $arrCat['name'] ?>">
                        <? } else { ?>
                          <img src="/images/noimg400.png" alt="<?= $arrCat['name'] ?>">
                        <? } ?>
                      </div>
                      <div class="col-md-9">
                        <p><?= $arrCat['descriptions'] ?></p>
                      </div>
                      <div class="col-md-12" style="margin-top: 15px;" id="resProduct">
                        <div class="row m-lg-0 overl bor-r">
                          <div class="col-sm-5 col-md-5 col-lg-5 cart-item" style="height: 60px;">
                            <div class="row">
                              <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="product-name">
                                  <h5 style="font-size: 12px;text-transform: unset;">
                                    <b>Название</b>
                                  </h5>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-2 col-md-2 col-lg-2 cart-item" style="padding: 0px;height: 60px;">
                            <h5 style="font-size: 12px;text-transform: unset;">
                              <b>Код</b>
                            </h5>
                          </div>
                          <div class="col-sm-1 col-md-1 col-lg-1 cart-item" style="padding: 0px;height: 60px;">
                            <p style="font-size: 12px;line-height: 50px;font-weight: 500;"><b>Наличие</b></p>
                          </div>
                          <div class="col-sm-2 col-md-2 col-lg-2 cart-item" style="height: 60px;">
                            <p class="product-price color-red"
                               style="font-size: 12px;line-height: 50px;font-weight: 500;"><b>Цена</b></p>
                          </div>
                          <div class="col-sm-1 col-md-1 col-lg-1 cart-item" style="height: 60px;padding: 0px">
                            <h5 style="font-size: 12px;text-transform: unset;"><b>Кол-во</b></h5>
                          </div>
                          <div class="col-sm-1 col-md-1 col-lg-1 cart-item" style="height: 60px;padding: 0px;">
                            <h5 style="font-size: 12px;text-transform: unset;"><b>Купить</b></h5>
                          </div>
                        </div>
                        <? foreach ($sProductList as $iProd) {
                          if ($parCat == '1') {
                            $cat_code = "tyres";
                          } elseif ($parCat == '2') {
                            $cat_code = "disk";
                          }
                          if ($iProd[availability] < 4) {
                            $quant = $iProd['availability'];
                          } else {
                            $quant = '4';
                          }
                          if ($iProd[availability] > 0) {
                            $availability = $iProd['availability'];
                          } else {
                            $availability = '<span style="font-size: 12px; display: block; color: #cb1010;">Нет в <br>наличии</span>';
                          }
                          $date = date('d.m.Y', strtotime('+' . countingDay($iProd["logistic"]) . ' days')); ?>
                          <div class="row m-lg-0 overl bor-r">
                            <div class="col-sm-5 col-md-5 col-lg-5 cart-item" style="height: 60px;">
                              <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                  <div class="product-name">
                                    <h5 style="font-size: 12px;text-transform: unset;">
                                      <a href="/<?= $cat_code ?>/<?= $iProd["code"] ?>-<?= $iProd["id"] ?>.html">
                                        <?= $iProd["name"] ?>
                                      </a>
                                    </h5>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-2 col-md-2 col-lg-2 cart-item" style="padding: 0px;height: 60px;">
                              <h5 style="font-size: 12px;text-transform: unset;">
                                Код: S<?= $iProd['provider'] ?>-<?= $iProd["article"] ?>
                              </h5>
                            </div>
                            <div class="col-sm-1 col-md-1 col-lg-1 cart-item" style="padding: 0px;height: 60px;">
                              <p style="font-size: 12px;line-height: 50px;font-weight: 500;"
                                 id="availability<?= $iProd["id"] ?>"><?= $availability ?></p>
                            </div>
                            <div class="col-sm-2 col-md-2 col-lg-2 cart-item" style="height: 60px;">
                              <p class="product-price color-red"
                                 style="font-size: 12px;line-height: 50px;font-weight: 500;"><?= $iProd["price"] ?>
                                руб.</p>
                            </div>
                            <div class="col-sm-1 col-md-1 col-lg-1 cart-item" style="height: 60px;padding: 0px">
                              <input id="valInput<?= $iProd["id"] ?>" type="text" value="<?= $quant ?>"
                                     class="form-item form-qtl" onchange="checkAvailability(<?= $iProd["id"] ?>)"
                                     style="height: unset; margin-top: 10px;width: 30px;padding: 5px;">
                            </div>
                            <div class="col-sm-1 col-md-1 col-lg-1 cart-item" style="height: 60px;padding: 0px;">
                              <? if ($iProd['availability'] > 0) { ?>
                                <a onClick="addBasket('<?= $iProd["id"] ?>','<?= $pCat ?>','<?= $iProd["id"] ?>')"
                                   class="ht-btn ht-btn-default" data-toggle="modal" data-target="#addBasket"
                                   style="text-transform:unset;border-radius: 5px;font-size: 12px;padding: 5px;">Купить</a>
                              <? } ?>
                            </div>
                          </div>

                        <? } ?>
                      </div>
                    </div>
                  <? } else { ?>
                    <div id="resProduct">
                      <? foreach ($sProductList as $iProd) {
                        if ($parCat == '1') {
                          $cat_code = "tyres";
                        } elseif ($parCat == '2') {
                          $cat_code = "disk";
                        } else {
                          $cat_code = $iProd["cat_code"];
                        }

                        $date = date('d.m.Y', strtotime('+' . countingDay($iProd["logistic"]) . ' days')); ?>
                        <div class="product-item hover-img">
                          <div class="row">
                            <div class="col-sm-6 col-md-5 col-lg-4">
                              <a href="/<?= $cat_code ?>/<?= $iProd["code"] ?>-<?= $iProd["id"] ?>.html"
                                 class="product-img">
                                <? /* if ($parCat == '1') { */ ?>
                                <? if ($iProd['img']) { ?>
                                  <? if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/images/product_cover/' . $iProd["img"])) { ?>
                                    <img src="/scripts/phpThumb/phpThumb.php?src=/images/product_cover/<?= $iProd["img"] ?>&w=252&h=188&far=1&bg=ffffff&f=jpg" alt="<?= $meta_item['title'] ?>">
                                  <? } else { ?>
                                    <img src="/images/noimg255.png" alt="<?= $meta_item['title'] ?>">
                                  <? } ?>
                                <? } else { ?>
                                  <? if ($iProd['cat_img']) { ?>
                                    <? if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/images/categories_cover/' . $iProd["cat_img"])) { ?>
                                      <img src="/scripts/phpThumb/phpThumb.php?src=/images/categories_cover/<?= $iProd["cat_img"] ?>&w=252&h=252&far=1&bg=ffffff&f=jpg" alt="<?= $meta_item['title'] ?>">
                                    <? } else { ?>
                                      <img src="/images/noimg255.pnge" alt="<?= $meta_item['title'] ?>">
                                    <? } ?>
                                  <? } else { ?>
                                    <img src="/images/noimg255.png" alt="<?= $meta_item['title'] ?>">
                                  <? } ?>
                                <? } ?>
                                <? /* } else { ?>
                              <? if (!$iProd['img']) { ?>
                                <img src="//placehold.it/252x252?text=no image" alt="<?= $meta_item['title'] ?>">
                              <? } else { ?>
                                <?if(file_exists($_SERVER['DOCUMENT_ROOT'].'/images/product_cover/'.$iProd["img"])){?>
                                  <img src="/scripts/phpThumb/phpThumb.php?src=/images/product_cover/<?= $iProd["img"] ?>&w=253&h=253&far=1&bg=ffffff&f=jpg" alt="<?= $meta_item['title'] ?>">
                                <?}else{?>
                                  <img src="//placehold.it/253x253?text=no image" alt="<?= $meta_item['title'] ?>">
                                <?}?>
                              <? } ?>
                            <? }*/ ?>
                              </a>
                            </div>
                            <div class="col-sm-6 col-md-7 col-lg-8 static-position">
                              <div class="product-caption">
                                <h4 class="product-name"><a
                                      href="/<?= $cat_code ?>/<?= $iProd["code"] ?>-<?= $iProd["id"] ?>.html"><?= $iProd["name"] ?>
                                    | Код: S<?= $iProd['provider'] ?>-<?= $iProd["article"] ?></a>
                                </h4>
                                <ul class="rating">
                                  <?= ratingEcho($iProd["avg"]); ?>
                                  <? if ($iProd['attention'] > 0) {
                                    switch ($iProd['attention']) {
                                      case 1:
                                        $attention = "Новинка";
                                        break;
                                      case 2:
                                        $attention = "Лидер продаж";
                                        break;
                                    } ?>
                                    <br><span class="car-status" style="float: right;"><?= $attention ?></span>
                                  <? } ?>
                                  <? if ($iProd['sale']) { ?>
                                    <span class="car-sale"
                                          style="float: right;margin-right: 5px;">Скидка <?= $iProd['sale'] ?>%</span>
                                  <? } ?>
                                </ul>
                                <div class="product-price-group" style="float: left; margin-top: 1%;">
                                  <? if (!$iProd['sale']) { ?>
                                    <span class="product-price"><?= $iProd["price"] ?> руб.</span>
                                  <? } else { ?>
                                    <span class="product-price">
																	<?= $iProd['price'] * (1 - $iProd['sale'] / 100) ?>
                                      <span style="text-transform:initial;" class="color-red">руб</span>
																      </span>
                                    <br>
                                    <span class="price-sale-line"><?= $iProd['price'] ?>
                                      <span style="text-transform:initial;" class="color-red">руб</span>
                                    </span>
                                  <? } ?>
                                </div>
                                <? /* <p class="product-txt">Nunc facilisis sagittis ullamcorper. Proin lectus ipsum</p> */ ?>
                                <div class="col-sm-12 col-md-4 col-lg-4" style="text-align: center;margin-top:1%;">
                                  <div class="form-group dop">
                                    <!--<div>
                                      <b >В наличии: Много</b>
                                    </div>-->
                                    <i class="fa fa-plus mPlus"
                                       onclick="valPlus(<?= $iProd["id"] ?>, <?= $iProd['availability'] ?>)"></i>
                                    <input id="valInput<?= $iProd["id"] ?>" type="text" value="4" class="form-control form-item fInput" readonly>
                                    <i class="fa fa-minus mMinus" onclick="valMinus(<?= $iProd["id"] ?>, <?= $iProd['availability'] ?>)"></i>
                                  </div>
                                </div>
                                <div class="col-sm-12 col-md-5 col-lg-5">
                                  <a onClick="addBasket('<?= $iProd["id"] ?>','<?= $pCat ?>','<?= $iProd["id"] ?>')"
                                     class="ht-btn ht-btn-default"
                                     data-toggle="modal" data-target="#addBasket">В корзину</a>
                                </div>
                                <div class="row"
                                     style="font-size:12px;margin-top:10px;color:#928f8;float: right;margin-right: 25px;">
                                  <i class="fa fa-truck"></i> Получение: самовывоз или доставка (<?= $date ?>)
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      <? } ?>
                    </div>
                  <? } ?>
                  <? if ($parCat == 1 OR $parCat == 2) { ?>
                    <div id="resPagination" style="text-align: center;">
                      <? if ($total > 1) { ?>
                        <nav aria-label="Page navigation">
                          <ul class="pagination ht-pagination">
                            <li><a onclick="selectProductShowMore(2)" class="showMore" style="width:100%; height:100%;">Показать еще</a>
                            </li>
                          </ul>
                        </nav>
                      <? } ?>
                    </div>
                  <? } else { ?>
                    <? include ($_SERVER['DOCUMENT_ROOT']) . '/templates/pagination.tpl.php'; ?>
                  <? } ?>
                </div>
              </div>

            <? } else { ?>
              <div class="col-md-12" style="margin-bottom:50px;">
                <div class="bs-callout bs-callout-warning">
                  <h4><i class="fa fa-info"></i> Раздел в стадии наполнения.</h4>
                </div>
              </div>
            <? } ?>
            <? include($_SERVER['DOCUMENT_ROOT'] . '/templates/form/modalAddBasket.tpl.php'); ?>
            <? /*<div class="seoText"><?= $meta_item["descriptions"] ?></div>*/ ?>
          </div>
        </div>
      </section>


    </div>
  </div>
</div>