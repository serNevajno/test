<div id="wrap-body" class="p-t-lg-30">
	<div class="container">
		<div class="wrap-body-inner">
			<!-- Breadcrumb-->
			<?include($_SERVER['DOCUMENT_ROOT']).'/templates/breadcrumbs.tpl.php';?>
			<!-- Blog details -->
			<section class="blog-detail-page m-t-lg-30 m-t-xs-0 p-b-lg-45 ">
				<div class="">
					<div class="row">
						<div class="col-sm-8 col-md-9">
							<div class="blog blog-grid blog-lg">
								<!-- Blog item -->
								<div class="blog-item  no-bg p-lg-0">
									<div class="blog-caption text-left">
										<h1 class="blog-heading"><?=$meta_item["name"]?></h1>
									</div>
									<?if($meta_item["img"]){?>
										<img class="img-responsive" src="http://<?=$_SERVER['SERVER_NAME']?>/scripts/phpThumb/phpThumb.php?src=/images/section/<?=$meta_item["img"]?>&w=710&h=328&far=1&bg=ffffff&f=jpg" alt="<?=$meta_item["title"]?>">
									<?}?>
									<div class="blog-caption text-left">
										<?=$meta_item["descriptions"]?>
									</div>
								</div>
							</div>	
						</div>
						<?include($_SERVER['DOCUMENT_ROOT']).'/templates/right_col.news.tpl.php';?>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>