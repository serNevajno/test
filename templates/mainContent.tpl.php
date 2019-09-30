<!-- Main content-->
<div id="wrap-body" class="p-t-lg-0">
  <div class="container">
    <div class="wrap-body-inner">
			<?include($_SERVER['DOCUMENT_ROOT'].'/templates/mainSlider.tpl.php');?>
			
      <!-- Recent cars -->
			<?$productMain = selectProductMain();
			if($productMain){?>
				<div class="product product-grid product-grid-2 car m-t-lg-20 p-t-sm-35 m-b-lg-20">
					<div class="heading">
						<h3>Лучшие предложения</h3>
					</div>
					<div class="row">
						<div class="owl" data-items="3" data-itemsDesktop="2" data-itemsDesktopSmall="2" data-itemsTablet="2" data-itemsMobile="1" data-pag="false" data-buttons="true">
							<?foreach($productMain as $item){?>
								<div class="col-lg-12">
									<!-- Product item -->
									<div class="product-item hover-img">
										<a href="/<?=$item["cat_code"]?>/<?=$item["code"]?>-<?=$item["id"]?>.html" class="product-img">
											<?if(!$item['img']){?>
												<img src="http://placehold.it/336x222?text=no image" alt="<?=$item['title']?>">
											<?}else{?>
												<img src="http://<?=$_SERVER['SERVER_NAME']?>/scripts/phpThumb/phpThumb.php?src=/images/product_cover/<?=$item["img"]?>&w=336&h=222&far=1&bg=ffffff&f=jpg" alt="<?=$item['title']?>">
											<?}?>
										</a>
										<div class="product-caption">
											<h4 class="product-name">
												<a href="/<?=$item["cat_code"]?>/<?=$item["code"]?>-<?=$item["id"]?>.html"><?=$item['name']?></a>
												<span class="f-18" style="padding: 15px 5px;font-size:14px !important;">
													<?if(!$item['sale']){?>
														<?=$item["price"]?>.00 руб
													<?}else{?>
															<?=$item['price'] * (1 - $item['sale'] / 100)?>.00 руб
													<?}?>
												</span>
											</h4>
										</div>
										<ul class="absolute-caption">
											<?if($item['attention'] > 0){
												switch($item['attention']){
													case 1: $attention = "Новинка" ; break;
												case 2: $attention = "Лидер продаж"; break;}?>
												<li><i class="fa fa-clock" style="width:100%;"><?=$attention?></i></li>
											<?}?>
											<?if($item['sale']){?>
												<li><i class="fa fa-clock" style="width:100%;"> Скидка <?=$item['sale']?>%</i></li>
											<?}?>
										</ul>
									</div>
								</div>
							<?}?>
						</div>
					</div>
				</div>
			<?}?>
			
      <!-- Banner -->
      <?/*<div class="banner-item banner-2x banner-bg-9 color-inher m-b-lg-50">
        <h3 class="f-weight-300">Закажите запчасти на свой автомобиль</h3>
        <p>воспользуйтесь формой обратной связи и наши специалисты помогут вам</p>
        <a href="#" class="ht-btn ht-btn-default" data-toggle="modal" data-target=".bs-example-modal-md">Оставить заявку</a>
      </div>*/?>

      <?//include($_SERVER['DOCUMENT_ROOT'].'/templates/form/callBack.tpl.php');?>
			<?=$meta_item["descriptions"]?>
    </div>
  </div>
</div>
