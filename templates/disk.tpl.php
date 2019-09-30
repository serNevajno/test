<div id="wrap-body" class="p-t-lg-30">
	<div class="container">
		<div class="wrap-body-inner">
			<!-- Breadcrumb-->
			<?include($_SERVER['DOCUMENT_ROOT'].'/templates/breadcrumbs.tpl.php');?>
			<!-- Product grid -->
			<?include($_SERVER['DOCUMENT_ROOT'].'/templates/form/mainFilter.tpl.php');///filterDisk.tpl.php?>
			<div id="recTyres" style="display:none;" class="col-md-12"></div>
			<section class="m-t-lg-30 m-t-xs-0">
				<div class="row">
					<?//include($_SERVER['DOCUMENT_ROOT'].'/templates/right_col.tyres_old.tpl.php');?>
					<div class="col-sm-12 col-md-12 col-lg-12">
						<div class="product product-grid">
							<div class="clearfix"></div>
							<div class="row" id="resDisk">
                                <?/*<div class="row">
                                    <?foreach(selectCatBrendTyres(2) as $item){?>
                                        <div class="col-md-2">
                                            <a href="/<?=$item['code']?>/">
                                                <?if(!$item['img']){?>
                                                    <img src="//via.placeholder.com/200x150&text=<?=$item['name']?>" alt="<?=$item['name']?>">
                                                <?}else{?>
                                                    <img src="/images/categories_cover/<?=$item['img']?>" alt="<?=$item['name']?>">
                                                <?}?>
                                                <div style="text-align: center;"> <?=$item['name']?> </div>
                                            </a>
                                        </div>
                                    <?}?>
                                </div>
                                <div class="clearfix"></div>*/?>
							</div>
						</div>
						<div id="loadDisk"></div>
						<div id="pageDisk" style="text-align: center;"></div>
						<?include($_SERVER['DOCUMENT_ROOT'].'/templates/form/modalAddBasket.tpl.php');?>

					</div>
				</div>
			</section>
		</div>
	</div>
</div>