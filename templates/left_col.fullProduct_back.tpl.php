<div class="col-sm-4 col-md-3 col-lg-3">
	<!-- Caterory -->
	<div class="category  m-b-lg-25">
		<div class="heading">
			<h3 class="p-l-lg-20" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
				<i class="fa fa-bars"></i>Категории
			</h3>
		</div>
		<ul class="collapse in contMenu" id="collapseExample">
			<?foreach(selectCategoriesOnMenu($meta_item["section"]) as $iCatMenu){?>
				<li <?if($_GET['categories_code'] == $iCatMenu["code"]){echo 'class="active"';}?>>
					<a href="/<?=$iCatMenu["code"]?>/">
						<?=$iCatMenu["name"]?> <i class="fa fa-chevron-right pull-right"></i>
					</a>
				</li>
			<?}?>
		</ul>
    <a class="btn btn-defoult btnShow" data-val="1">Развернуть</a>
	</div>
	<?if(!isset($_GET["id"]) AND !isset($_GET["product_code"]) AND $sec == 1){?>
		<div class="search-option m-b-lg-50 p-lg-20" id="filter">			
			<div class="m-b-lg-15">
			<input type="hidden" value="<?=$_GET["categories_code"]?>" id="categoriesCode">
			<?$n=0;foreach(selectFilter($_GET["categories_code"]) as $iFilter){?>
				<div class="filterCat" style="<?if($n!=0){echo 'margin-top:35px;';}?>"><?=$iFilter["name"]?></div>
				<div class="hiddenFilter" id="filter<?=$iFilter["id"]?>">
					<?$kEl = 1;?>
					<?foreach(selectElementFilter($iFilter["id"], $iFilter["categories"]) as $iElement){?>
						<div class="checkbox" style="color:#fff;">
							<input type="checkbox" value="<?=$iElement["id"]?>" id="check<?=$iElement["id"]?>">
							<label for="check<?=$iElement["id"]?>" class="fa fa-check"></label>
							<?=$iElement["value"]?> (<?=$iElement["count_el"]?>)
						</div>
					<?$kEl++;}?>
				</div>
				<?if($kEl>5){?>
					<a id="moreFilter<?=$iFilter["id"]?>" onClick="showMore('<?=$iFilter["id"]?>');" class="buttonMore">Еще</a>
				<?}?>
			<?$n++;}?>
			</div>
			
			<input type="text" disabled="" class="slider_amount m-t-lg-10" name="price" id="priceProduct" value="0 - <?=maxPrice($_GET["categories_code"])?>">
			<div class="slider-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content">
				<div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 28.2051%; width: 35.8974%;"></div>
				<span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 28.2051%;"></span>
				<span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 64.1026%;">
				</span>
			</div>
			<button type="button" class="ht-btn ht-btn-default m-t-lg-30" id="buttonFilter"><i class="fa fa-search"></i>Поиск</button>
		</div>
	<?}?>
	<?/*<div class="blog blog-list blog-sm m-b-lg-30">
		<div class="heading-1">
			<h3>Популярные новости</h3>
		</div>
		<?foreach(selectNewsRightCol() as $item){?>
		<div class="blog-item">
			<div class="row">
				<div class="col-sm-4 col-md-4 p-r-lg-0">
					<a href="/news/<?=$item["code"]?>-<?=$item["id"]?>.html" class="hover-img"><img src="/scripts/phpThumb/phpThumb.php?src=/images/news/<?=$item["img"]?>&w=108&h=71&far=1&bg=ffffff&f=jpg" alt="image"></a>
				</div>
				<div class="col-sm-8 col-md-8 p-r-lg-0">
					<ul class="blog-date blog-date-left">
						<li><a><i class="fa fa-calendar"></i> <?=dateformat($item["date"])?></a></li>
					</ul>
					<div class="blog-caption">
						<h4 class="heading-3 blog-heading"><a href="/news/<?=$item["code"]?>-<?=$item["id"]?>.html"><?=$item["name"]?></a></h4>
					</div>
				</div>
			</div>
			</div>
		<?}?>
	</div>*/?>
	
	<?include($_SERVER['DOCUMENT_ROOT'].'/templates/banner.tpl.php');?>
</div>