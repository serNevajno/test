<? if ($_GET["categories_code"] == "tyres" OR $_GET["categories_code"] == "disk") {
  if ($meta_item["availability"] > 12) {
    $kol = "Много";
    $count = 4;
  } elseif ($meta_item["availability"] > 4) {
    $kol = $meta_item["availability"];
    $count = 4;
  } else {
    $kol = $meta_item["availability"];
    $count = $meta_item["availability"];
  }
} else {
  $count = 1;
  $kol = $meta_item["availability"];
}
$code_type = $_GET["categories_code"];
?>

  <div id="wrap-body" class="p-t-lg-30">
    <div class="container">
      <div class="wrap-body-inner">
        <!-- Breadcrumb-->
        <? include ($_SERVER['DOCUMENT_ROOT']) . '/templates/breadcrumbs.tpl.php'; ?>
        <!-- Product details -->
        <section class="m-t-lg-30 m-t-xs-0">
          <div class="row">

            <? include ($_SERVER['DOCUMENT_ROOT']) . '/templates/left_col.fullProduct.tpl.php'; ?>

            <div class="col-sm-8 col-md-9 col-lg-9">
              <div class="product-list product_detail p-lg-30 p-xs-15 bg-gray-fa bg1-gray-15">
                <div class="row">
                  <!-- Image Large -->
                  <div class="image-zoom col-md-12 col-lg-4">
                    <div class="product-img-lg p-lg-10 m-b-xs-30 text-center">
                      <div class="product-img-lg bg-gray-f5 bg1-gray-15">
                        <div class="image-zoom row m-t-lg-5 m-l-lg-ab-5 m-r-lg-ab-5">
                          <div class="col-md-12 col-lg-12 p-lg-5">
                              <? if ($meta_item['img']) { ?>
                                <?if(file_exists($_SERVER['DOCUMENT_ROOT'].'/images/product_cover/'.$meta_item[img])){?>
                                    <a href="/images/product_cover/<?= $meta_item['img'] ?>">
                                      <img src="/scripts/phpThumb/phpThumb.php?src=/images/product_cover/<?= $meta_item['img'] ?>&w=680&h=449&far=1&bg=ffffff&f=jpg" alt="<?= $meta_item['title'] ?>">
                                    </a>
                                <?}else{?>
                                  <img src="/images/noimg400.png" alt="<?= $meta_item['title'] ?>">
                                <?}?>
                              <? } else { ?>
                                <? if ($meta_item['cat_images'] AND file_exists($_SERVER['DOCUMENT_ROOT'].'/images/categories_cover/'.$meta_item['cat_images']) AND $_GET["categories_code"] != "disk") { ?>
                                  <img src="/images/categories_cover/<?= $meta_item['cat_images'] ?>"
                                       alt="<?= $meta_item['title'] ?>">
                                <? } else { ?>
                                  <img src="/images/noimg400.png" alt="<?= $meta_item['title'] ?>">
                                <? } ?>
                              <? } ?>
                          </div>
                          <? if (selectGalleryImgById($_GET['id'])) {
                            foreach (selectGalleryImgById($_GET['id']) as $sGallery) {
                              ?>
                              <div class="col-sm-3 col-md-3 col-lg-3 p-lg-5">
                                <a href="/images/product_gallery/<?= $sGallery['img'] ?>">
                                  <img src="/scripts/phpThumb/phpThumb.php?src=/images/product_gallery/<?= $sGallery['img'] ?>&w=163&h=107&far=1&bg=ffffff&f=jpg" alt="<?= $meta_item['title'] ?>">
                                </a>
                              </div>
                            <? }
                          } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 col-lg-8">
                    <!-- Product description -->
                    <ul class="rating" style="margin:0px; padding: 5px 0 0px 5px;float:right;" id="rRatingId">
                      <?=ratingEchoFullProduct($meta_item["avg"], $meta_item["id"]); ?>
                    </ul>
                    <h1 class="product-name">
                      <?= $meta_item['name'] ?>
                      <? if ($meta_item['attention'] > 0) {
                        switch ($meta_item['attention']) {
                          case 1:
                            $attention = "Новинка";
                            break;
                          case 2:
                            $attention = "Лидер продаж";
                            break;
                        } ?>
                        <br><span class="car-status"><?= $attention ?></span>
                      <? } ?>
                      <? if ($meta_item['sale']) { ?>
                        <span class="car-sale">Скидка <?= $meta_item['sale'] ?>%</span>
                      <? } ?>
                    </h1>
                    <div class="product_para">
                      <?if($meta_item["availability"]>0){?>
                        <? if (!$meta_item['sale']) { ?>
                          <div style="margin-bottom:15px;text-align: center;">
                          <span class="price-prod">
                            <?= $meta_item['price'] ?>.00 <span style="text-transform:initial;"
                                                                class="color-red">руб</span>
                          </span>
                          </div>
                        <? } else { ?>
                          <div style="margin-bottom:15px;text-align: center;">
                          <span class="color-red price-sale">
                            <?= $meta_item['price'] * (1 - $meta_item['sale'] / 100) ?>.00 <span
                                style="text-transform:initial;" class="color-red">руб</span>
                          </span>
                            <br>
                            <span class="price-sale-line"><?= $meta_item['price'] ?>.00 <span
                                  style="text-transform:initial;" class="color-red">руб</span></span>
                          </div>
                        <? } ?>
                      <? }else{?>
                        <div style="margin-bottom:15px;text-align: center;">
                          <span class="price-prod">
                             <span style="text-transform:initial;" class="color-red">Нет в наличии</span>
                          </span>
                        </div>
                      <? } ?>
                      <hr>
                      <div class="row">
                        <div class="col-md-6 col-lg-6 param">
                      <p><span style="width:inherit;font-weight:bold;">Код товара:</span>
                        &nbspS<?= $meta_item['provider'] ?>-<?= str_pad($meta_item["article"], 6, '0', STR_PAD_LEFT) ?>
                      </p>
                      <? foreach (selectFilterValById($_GET['id']) as $sFilter) { ?>
                        <p><span style="width:inherit;font-weight:bold;"><?= $sFilter['name'] ?>:</span>
                          &nbsp; <?= $sFilter['value'] ?></p>
                      <? }?>
                      <? $sWeight = selectWeigth($_GET['id']);
                      if ($sWeight) {
                        ?>
                        <p><span style="width:inherit;font-weight:bold;">Вес кг.:</span> <?= $sWeight["weight_1"] ?></p>
                        <p><span
                              style="width:inherit;font-weight:bold;">Вес комплекта кг.:</span> <?= $sWeight["weight_4"] ?>
                        </p>
                        <p><span style="width:inherit;font-weight:bold;">Объем м3.:</span> <?= $sWeight["scope_1"] ?>
                        </p>
                        <p><span
                              style="width:inherit;font-weight:bold;">Объем комплекта м3.:</span> <?= $sWeight["scope_4"] ?>
                        </p>
                      <? } ?>
                      <p><span style="width:inherit;font-weight:bold;">Остаток:</span> <?= $kol ?></p>
                      <p><span style="width:inherit;font-weight:bold;">Получение:</span> &nbsp;самовывоз или доставка
                                                                                         (<?= $date = date('d.m.Y', strtotime('+' . countingDay($meta_item["logistic"]) . ' days')); ?>
                                                                                         )</p>
                        </div>
                        <div class="col-md-6 col-lg-6">
                          <a class="ht-btn ht-btn-default" onclick="show_pec_goods()" id="btn_pec_goods" style="background-color: #3cb868;">Рассчитать доставку Транспортными компаниями(для регионов кроме Челябинск, Екатеринбург,Уфа) </a>
                          <script>
                            function show_pec_goods() {
                              $('#pec_goods').show();
                              $('#btn_pec_goods').hide();
                            }
                          </script>
                          <div id="pec_goods" style="display: none;">
                          <script>
                              var pec_goods = [],
                                pec_informer_size = "horizontal", // тип информера
                                pec_from = "-455", // город отправки
                                pec_to = "<?=selectPEKID();?>", // город доставки
                                pec_insurance = "", // сумма для страхования
                                pec_packing = ""; // тип упаковки
                              pec_goods[0] = "0/0/0/<?= $sWeight["scope_4"]?>/<?= $sWeight["weight_4"] ?>"; // габариты, объем, вес
                            </script>
                           <script src="https://pecom.ru/business/developers/js_informer/get_informer.js" charset="utf-8"></script>
                          </div>
                        </div>
                      </div>
                        <hr>
                      <div class="col-md-2" style="padding:0px; margin-top: 30px;">
                        <b class="m-r-lg-5">Кол-во : </b>
                      </div>
                      <div class="col-sm-12 col-md-2 col-lg-2" style="text-align: center;padding:0px;">
                        <div class="form-group dop">
                          <i class="fa fa-plus" onClick="valPlus(0, <?= $meta_item["availability"] ?>)"></i>
                          <input id="valInput0" type="text" value="<?= $count ?>" class="form-control form-item"
                                 readonly>
                          <i class="fa fa-minus" onClick="valMinus(0, <?= $meta_item["availability"] ?>)"></i>
                        </div>
                      </div>
                      <?if($meta_item["price"]>0){?>
                          <div class="col-md-8" style="padding:0px;margin-top: 25px;">
                            <a onClick="addBasket('<?= $meta_item["id"] ?>', '<?= $code_type ?>', '0')"
                               class="ht-btn ht-btn-default" style="padding:8px;cursor: pointer;" data-toggle="modal"
                               data-target="#addBasket">В корзину</a>
                            <a data-toggle="modal" class="ht-btn ht-btn-default"
                               style="padding:8px;padding: 6px;font-size: 12px;cursor: pointer;background: #3cb868;" data-target="#fastBuy">Купить в 1 клик</a>
                          </div>
                      <?}?>
                      <div class="modal fade" id="fastBuy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                           aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-body">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <? include ($_SERVER['DOCUMENT_ROOT']) . '/templates/form/fastBuy.tpl.php'; ?>
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>

              <!-- Product realted -->
              <div class="product product-grid car m-b-lg-15">
                <div class="m-b-lg-30">
                  <div class="heading-1" style="margin-bottom:10px"><h2 style="font-size:20px;padding-bottom: 0px;">
                      Описание товара <?= $meta_item['name'] ?></h2></div>
                  <div class="m-b-lg-30 bg-gray-fa bg1-gray-2 p-lg-30 p-xs-15">
                    <p class="color1-9">
                      <? if ($meta_item['description']) {
                        echo $meta_item['description'];
                      } else {
                        echo $meta_item['descriptions'];
                      } ?>
                    </p>
                  </div>
                </div>
                <? if ($meta_item['youtube_url']) { ?>
                  <!-- Features & Options -->
                  <div class="m-b-lg-30">
                    <div class="heading-1" style="margin-bottom:10px"><h2 style="font-size:20px;padding-bottom: 0px;">
                        Видео обзор <?= $meta_item['name'] ?></h2></div>
                    <div class="bg-gray-fa bg1-gray-2 p-lg-30 p-xs-15">
                      <div class="embed-responsive embed-responsive-16by9">
                        <iframe width="560" height="315" src="<?= $meta_item['youtube_url'] ?>" frameborder="0"
                                allowfullscreen class="embed-responsive-item"></iframe>
                      </div>
                    </div>
                  </div>
                <? } ?>

                <? include ($_SERVER['DOCUMENT_ROOT']) . '/templates/recommend.tpl.php'; ?>

              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
<? include($_SERVER['DOCUMENT_ROOT'] . '/templates/form/modalAddBasket.tpl.php'); ?>