<div id="wrap-body" class="p-t-lg-30">
    <div class="container">
        <div class="wrap-body-inner">
            <!-- Breadcrumb-->
            <?include($_SERVER['DOCUMENT_ROOT'].'/templates/breadcrumbs.tpl.php');?>
            <!-- Product grid -->
            <?include($_SERVER['DOCUMENT_ROOT'].'/templates/form/filterTyres.tpl.php');?>
            <div id="recTyres" style="display:none;" class="col-md-12">

            </div>
            <section class="m-t-lg-30 m-t-xs-0">
                <div class="row">
                    <?//include($_SERVER['DOCUMENT_ROOT'].'/templates/right_col.tyres.tpl.php');?>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="product product-grid" id="resTyres">
                            <div class="row">
                                <?/*echo "<pre>".print_r(selectCatBrendTyres(1), true)."</pre>";*/?>
                                <?foreach(selectCatBrendTyres(1) as $item){?>
                                    <div class="col-md-2">
                                        <a href="/tyres/<?=$item['code']?>/">
                                            <?if(!$item['img']){?>
                                                <img src="http://via.placeholder.com/200x150&text=Нет фото" alt="<?=$item['name']?>">
                                            <?}else{?>
                                                <img src="/images/categories_cover/<?=$item['img']?>" alt="<?=$item['name']?>">
                                            <?}?>
                                            <div style="text-align: center;"> <?=$item['name']?> </div>
                                        </a>
                                    </div>
                                <?}?>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <?include($_SERVER['DOCUMENT_ROOT'].'/templates/form/modalAddBasket.tpl.php');?>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>