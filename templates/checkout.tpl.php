<div id="wrap-body" class="p-t-lg-30">
    <div class="container">
        <div class="wrap-body-inner">
            <!-- Breadcrumb-->
            <?include($_SERVER['DOCUMENT_ROOT']).'/templates/breadcrumbs.tpl.php';?>
            <!-- Product cart -->
            <section class="block-cart m-b-lg-0 m-t-lg-30 m-t-xs-0">
                <div>
                    <div class="heading">
                        <h3><?=$meta_item['name']?></h3>
                    </div>
                    <?/*<div class="display-inline-block width-100" id="resOrder">
                        <!-- Cart item -->
                        <?if($sBasket ){$n=0;
                            foreach($sBasket as $item){?>
                                <div class="row m-lg-0 overl bor-r">
                                    <div class="col-sm-7 col-md-7 col-lg-7 cart-item">
                                        <div class="row">
                                            <div class="col-sm-3 col-md-3 col-lg-3">
                                                <a href="<?=$item['url']?>" class="cart-img-prev">
                                                    <img src="<?=$item['img']?>" alt="<?=$item['name']?>">
                                                </a>
                                            </div>
                                            <div class="col-sm-9 col-md-9 col-lg-9 p-lg-0">
                                                <div class="product-name">
                                                    <h5><a href="<?=$item['url']?>"><?=$item['name']?></a></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 col-md-2 col-lg-2 cart-item">
                                        <p class="color-green"><span class="price"><?=$item['price']?> руб.</span></p>
                                    </div>
                                    <div class="col-sm-1 col-md-1 col-lg-1 cart-item">
                                        <p><strong><?=$item['quantity']?></strong></p>
                                    </div>
                                    <div class="col-sm-2 col-md-2 col-lg-2 cart-item">
                                        <p><strong><span id="summProduct<?=$n?>"><?=($item['price'] * $item["quantity"])?> руб</span></strong></p>
                                    </div>

                                </div>
                                <?$n++;}?>

                            <div id="resGift">
                            </div>
                            <div class="clearfix"></div>
                            <!-- Total -->
                            <div class="cart-total">Итого : <strong><span id="total" style="font-size:22px;"><?=sumBasket()?> руб</span></strong></div>
                            <div class="clearfix"></div>
                        <?}else{?>
                            <div class="cart-total" style="text-align:center;">
                                <i class="fa fa-shopping-cart"></i> Корзина пуста!
                            </div>
                        <?}?>
                    </div><?*/?>
                </div>
            </section>
            <?if($sBasket ){?>
                <section class="col-md-12 col-lg-12">
                    <div class="row">
                        <?include($_SERVER['DOCUMENT_ROOT']).'/templates/form/checkout.tpl.php';?>
                    </div>
                </section>
            <?}else{?>
                <div class="cart-total" style="text-align:center;">
                    <i class="fa fa-warning"></i> Вы не выбрали ни одного товара!
                </div>
            <?}?>
        </div>
    </div>
</div>