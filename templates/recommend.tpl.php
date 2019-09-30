<?/* <pre><?print_r(selectRecommendProd($meta_item['related']))?></pre> */?>
	<?if(selectRecommendProd($meta_item['related'])){?>
	<div class="heading">
		<h3>Сопутствующие товары</h3>
	</div>
	<div class="row">
	<?foreach(selectRecommendProd($meta_item['related']) as $item){?>
	<div class="col-sm-6 col-md-4 col-lg-4">
		<!-- Product item -->
		<div class="product-item hover-img">
			<a href="/<?=$item["cat_code"]?>/<?=$item["code"]?>-<?=$item["id"]?>.html" class="product-img">
				<?if(!$item['img']){?>
					<img src="//placehold.it/336x222?text=no image" alt="<?=$item['title']?>">
				<?}else{?>
					<img src="/scripts/phpThumb/phpThumb.php?src=/images/product_cover/<?=$item["img"]?>&w=336&h=222&far=1&bg=ffffff&f=jpg" alt="<?=$item['title']?>">
				<?}?>
			</a>
			<div class="product-caption">
				<h4 class="product-name"><a href="/<?=$item["cat_code"]?>/<?=$item["code"]?>-<?=$item["id"]?>.html"><?=$item['name']?></a></h4>
				<ul class="rating">
					<?=ratingEcho($item["avg"]);?>
				</ul>
				<div class="product-price-group">
					<span class="product-price">
						<?if(!$item['sale']){?>
							<?=$item["price"]?>.00 руб
						<?}else{?>
								<?=$item['price'] * (1 - $item['sale'] / 100)?>.00 руб
						<?}?>
					</span>
				</div>
				<a href="/<?=$item["cat_code"]?>/<?=$item["code"]?>-<?=$item["id"]?>.html" class="ht-btn ht-btn-default">Подробнее</a>
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
	</div>
	<?}?>
	</div>
	<?}elseif(selectProductPopular()){?>
	<div class="heading">
		<h3>Популярные</h3>
	</div>
	<div class="row">
	<?foreach(selectProductPopular() as $item){?>
		<div class="col-sm-6 col-md-4 col-lg-4">
      <?$finCat = parentCategories($item['categories']);
        if($finCat == "1"){
          $finCat = "tyres";
        }elseif($finCat = "2"){
          $finCat = "disk";
        }else{
          $finCat = $item["cat_code"];
        }
      ?>
			<!-- Product item -->
			<div class="product-item hover-img">
				<a href="/<?=$finCat?>/<?=$item["code"]?>-<?=$item["id"]?>.html" class="product-img">
          <?if($item['img_cat']){?>
            <img src="/scripts/phpThumb/phpThumb.php?src=/images/categories_cover/<?=$item["img_cat"]?>&w=336&h=222&far=1&bg=ffffff&f=jpg" alt="<?=$item['title']?>">
					<?}elseif($item['img']){?>
            <img src="/scripts/phpThumb/phpThumb.php?src=/images/product_cover/<?=$item["img"]?>&w=336&h=222&far=1&bg=ffffff&f=jpg" alt="<?=$item['title']?>">
						<!--<img src="http://placehold.it/336x222?text=no image" alt="<?/*=$item['title']*/?>">-->
					<?}else{?>
            <img src="//placehold.it/336x222?text=no image" alt="<?=$item['title']?>">
					<?}?>
				</a>
				<div class="product-caption">
					<h4 class="product-name"><a href="/<?=$finCat?>/<?=$item["code"]?>-<?=$item["id"]?>.html"><?=$item['name']?></a></h4>
					<ul class="rating">
						<?=ratingEcho($item["avg"]);?>
					</ul>
					<div class="product-price-group">
						<span class="product-price">
							<?if(!$item['sale']){?>
								<?=$item["price"]?>.00 руб
							<?}else{?>
									<?=$item['price'] * (1 - $item['sale'] / 100)?>.00 руб
							<?}?>
						</span>
					</div>
					<a href="/<?=$finCat?>/<?=$item["code"]?>-<?=$item["id"]?>.html" class="ht-btn ht-btn-default">Подробнее</a>
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
		</div>
	<?}?>
	</div>
	<?}?>