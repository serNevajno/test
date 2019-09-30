<div id="wrap-body" class="p-t-lg-30">
	<div class="container">
		<div class="wrap-body-inner">
			<!-- Breadcrumb-->
			<?include($_SERVER['DOCUMENT_ROOT']).'/templates/breadcrumbs.tpl.php';?>
			<!-- Product details -->
			<section class="m-t-lg-30 m-t-xs-0">
				<div class="row">
					
					<?include($_SERVER['DOCUMENT_ROOT']).'/templates/left_col.fullProduct.tpl.php';?>
					
					<div class="col-sm-8 col-md-9 col-lg-9">
						<div class="product-list product_detail p-lg-30 p-xs-15 bg-gray-fa bg1-gray-15 m-b-lg-50">
							<div class="row">
								<!-- Image Large -->
								<div class="image-zoom col-md-6 col-lg-6">
									<div class="product-img-lg p-lg-10 m-b-xs-30 text-center">
                                        <img src="/images/categories_cover/<?=$meta_item["cat_images"]?>"">

									</div>
								</div>
								<div class="col-md-6 col-lg-6">
									<!-- Product description -->
									<h3 class="product-name"><?=$meta_item["name"]?></h3>
									<div class="product_para">
										<p class="price p-t-lg-20 p-b-lg-10 f-30 f-bold color-red"><?=$meta_item["price"]?>.00 руб</p>
										<hr>
										<p><b>Код :</b> <?=$iProduct["code"]?></p>
										<?if($_GET['categories_code'] == 'tyres'){?>
											<p><b>Сезон :</b> <?=$iProduct["season_icon"]?>  <?if($iProduct["season"] != "s"){echo $iProduct["thorn"];}?></p>
										<?}?>
										<p><b>Бренд :</b> <?=$iProduct["marka"]?> </p>
										<p><b>Модель :</b> <?=$iProduct["model"]?> </p>
										<?if($_GET['categories_code'] == 'disk'){?>
											<p><b>Цвет :</b> <?=$iProduct["color"]?> </p>
										<?}?>
										<p><b>Размер :</b> <?=$iProduct["size"]?></p>
										<p><b>Остаток :</b> <?=$iProduct["rest"]?> </p>
										<p><b>Получение :</b> самовывоз или доставка <?=$date = date('d.m.Y', strtotime('+' . countingDay($iProduct["logistic"]) . ' days'));?></p>
										<hr>
										<div class="col-md-2" style="padding:0px; margin-top: 30px;">
											<b class="m-r-lg-5">Кол-во : </b> 
										</div>
										<div class="col-sm-12 col-md-2 col-lg-2" style="text-align: center;padding:0px;">
											<div class="form-group dop">
												<i class="fa fa-plus" onClick="valPlus(0, <?=$iProduct['kol']?>)"></i>
												<input id="valInput0" type="text" value="<?=$iProduct['count'];?>" class="form-control form-item">
												<i class="fa fa-minus" onClick="valMinus(0, <?=$iProduct['kol']?>)"></i>
											</div>
										</div>
										<div class="col-md-8" style="padding:0px;margin-top: 25px;">
											<a onClick="addBasket('<?=$iProduct["code"]?>', '<?=$_GET['categories_code']?>', '0')" class="ht-btn ht-btn-default" style="padding:8px;cursor: pointer;" data-toggle="modal" data-target="#addBasket">В корзину</a>
											<a data-toggle="modal" class="ht-btn ht-btn-default" style="padding:8px;padding: 6px;font-size: 12px;cursor: pointer;" data-target="#fastBuy">Купить в 1 клик</a>
										</div>
										
										<div class="modal fade" id="fastBuy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-body">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<?include($_SERVER['DOCUMENT_ROOT']).'/templates/form/fastBuy.tpl.php';?>
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
							<?include($_SERVER['DOCUMENT_ROOT']).'/templates/recommend.tpl.php';?>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<?include($_SERVER['DOCUMENT_ROOT'].'/templates/form/modalAddBasket.tpl.php');?>