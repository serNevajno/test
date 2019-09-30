<?if(isset($_GET["id_news"])){?>
	<div id="wrap-body" class="p-t-lg-30">
		<div class="container">
			<div class="wrap-body-inner">
				<!-- Breadcrumb-->
				<?include($_SERVER['DOCUMENT_ROOT']).'/templates/breadcrumbs.tpl.php';?>
				<!-- Blog details -->
				<section class="blog-detail-page m-t-lg-30 m-t-xs-0 p-b-lg-45 ">
					<div class="">
						<div class="row">
							<div class="col-sm-12 col-md-12">
								<div class="blog blog-grid blog-lg">
									<!-- Blog item -->
									<div class="blog-item  no-bg p-lg-0">
										<?if($meta_item["img"]){?>
											<img class="img-responsive" src="/scripts/phpThumb/phpThumb.php?src=/images/news/<?=$meta_item["img"]?>&w=710&h=328&far=1&bg=ffffff&f=jpg" alt="<?=$meta_item["title"]?>">
										<?}?>
										<div class="blog-caption text-left">
											<ul class="blog-date blog-date-left">
												<li><a><i class="fa fa-calendar"></i> <?=dateformat($meta_item["date"])?></a></li>
												<li><a><i class="fa fa-eye"></i> Просмотров: <?=$meta_item["view"]?></a></li>
											</ul>
											<h1 class="blog-heading"><?=$meta_item["name"]?></h1>
											<?=$meta_item["description"]?>
											<br><br>
											<?=$meta_item["text"]?>
										</div>
									</div>
									<!-- Share post -->
									<div class="share-post">
										<div class="row">
											<div class="col-lg-12">
												<span>Понравилось? Поделись! :</span>
												<ul class="list-inline">
													<li><a href="http://www.facebook.com/share.php?u=http://<?=$_SERVER['SERVER_NAME']?>/news/<?=$meta_item["code"]?>-<?=$meta_item["id"]?>.html" target="_blank"><i class="fa fa-facebook"></i></a></li>
													<li><a href="https://plus.google.com/share?url=http://<?=$_SERVER['SERVER_NAME']?>/news/<?=$meta_item["code"]?>-<?=$meta_item["id"]?>.html" target="_blank"><i class="fa fa-google-plus"></i></a></li>
													<li><a href="http://twitter.com/timeline/home?status=<?=$meta_item["name"]?>%20http://<?=$_SERVER['SERVER_NAME']?>/news/<?=$meta_item["code"]?>-<?=$meta_item["id"]?>.html" target="_blank"><i class="fa fa-twitter"></i></a></li>
													<li><a href="https://vk.com/share.php?url=http://<?=$_SERVER['SERVER_NAME']?>/news/<?=$meta_item["code"]?>-<?=$meta_item["id"]?>.htmltitle=<?=$meta_item["name"]?>&image=http://<?=$_SERVER['SERVER_NAME']?>/images/news/<?=$meta_item["img"]?>" target="_blank"><i class="fa fa-vk"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
								</div>	
							</div>
							<?//include($_SERVER['DOCUMENT_ROOT']).'/templates/right_col.news.tpl.php';?>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
	<?}else{
		if (isset($_GET["page"])) {
			$page = clearData($_GET["page"], "i");
			}else{
			$page = 1;
		}
	?>
	<div id="wrap-body" class="p-t-lg-30">
		<div class="container">
			<div class="wrap-body-inner">
				<!-- Breadcrumb-->
				<?include($_SERVER['DOCUMENT_ROOT']).'/templates/breadcrumbs.tpl.php';?>
				<!-- Blog -->
				<section class="blog-page m-t-lg-30 m-t-xs-0 p-b-lg-45">
					<div class="">
						<div class="row">
							<div class="col-sm-8 col-md-9">
								<div class="blog blog-list blog-lg" id="sNews">
									<!-- Blog item -->
									<?foreach(selectBlog(1, $page) as $iNews){?>
										<div class="blog-item">
											<div class="row">
												<div class="col-sm-5 col-md-5">
													<a href="/news/<?=$iNews["code"]?>-<?=$iNews["id"]?>.html" class="hover-img">
                            <?if($iNews["img"] AND file_exists($_SERVER['DOCUMENT_ROOT'].'/images/news/'.$iNews["img"])){?>
                            <img src="/scripts/phpThumb/phpThumb.php?src=/images/news/<?=$iNews["img"]?>&w=304&h=201&far=1&bg=ffffff&f=jpg" alt="image">
                            <?}else{?>
                              <img src="http://placehold.jp/304x201.png?text=no image" alt="image">
                            <?}?>
                          </a>
												</div>
												<div class="col-sm-7 col-md-7">
													<div class="blog-caption">
														<ul class="blog-date blog-date-left p-t-lg-0">
															<li><a><i class="fa fa-calendar"></i> <?=dateformat($iNews["date"])?></a></li>
														</ul>
														<h2 class="blog-heading"><a href="/news/<?=$iNews["code"]?>-<?=$iNews["id"]?>.html"><?=$iNews["name"]?></a></h2>
														<p><?=cut_paragraph($iNews["description"], 125)?></p>
														<a href="/news/<?=$iNews["code"]?>-<?=$iNews["id"]?>.html" class="ht-btn ht-btn-default ">Читать больше</a>
													</div>
												</div>
											</div>
										</div>
									<?}?>							
									<?include($_SERVER['DOCUMENT_ROOT']).'/templates/pagination.tpl.php';?>
								</div>
							</div>
							
							<?include($_SERVER['DOCUMENT_ROOT']).'/templates/right_col.news.tpl.php';?>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
<?}?>