<div id="wrap-body" class="p-t-lg-30">
	<div class="container">
		<div class="wrap-body-inner">
			<!-- Breadcrumb-->
			<?include($_SERVER['DOCUMENT_ROOT']).'/templates/breadcrumbs.tpl.php';?>
			<!-- Product cart -->
			<section class="block-cart m-b-lg-50 m-t-lg-30 m-t-xs-0">
				<div>
					<div class="heading">
						<h3><?=$meta_item['name']?></h3>
					</div>
					<div class="display-inline-block width-100" id="resCart">

						<!-- Cart item -->
						<?if($sBasket ){$n=0;
						foreach($sBasket as $item){
							if($day < $item["day"]){
								$day = $item["day"];
							}
							?>
							<div class="row m-lg-0 overl bor-r">
								<div class="col-sm-5 col-md-5 col-lg-5 cart-item">
									<div class="row">
										<div class="col-sm-3 col-md-3 col-lg-3">
											<a href="<?=$item['url']?>" class="cart-img-prev">
												<img src="<?=$item['img']?>" alt="<?=$item['name']?>">
											</a>
										</div>
										<div class="col-sm-9 col-md-9 col-lg-9 p-lg-0">	
											<div class="product-name">
												<h5><a href="<?=$item['url']?>"><?=$item['name']?></a></h5>
                                                <?$sWeight = selectWeigth($item["product_id"]);
                                                if($sWeight){?>
                                                    <span style="color: #999;">Вес кг.: <?=$sWeight["weight_1"]*$item['quantity']?>, объем м3.:  <?=$sWeight["scope_1"]*$item['quantity']?></span>
                                                <?}?>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-2 col-md-2 col-lg-2 cart-item">
									<p class="color-green"><span class="price"><?=$item['price']?> руб.</span><?if($item['sale'] >0){?><span class="color-red">(-<?=$item['sale']?> %)</span><?}?></p>
								</div>
								<div class="col-sm-2 col-md-2 col-lg-2 cart-item">
									<div class="form-group dop">
									<div class="col-md-2" style="padding: 2.5em 0;">
										<i class="fa fa-minus mMinus" onClick="summProduct(<?=$item['id']?>, 'minus', <?=$n?>)"></i>
									</div>
									<div class="col-md-8" style="padding:0px; margin:0px;">
										<input id="valInput<?=$n?>" type="text" value="<?=$item['quantity']?>" class="form-control form-item fInput" style=" width: 100%; margin: 0px; text-align: center; margin-top: 20%;" readonly>
									</div>
									<div class="col-md-2" style="padding: 2.5em 0;">
										<i class="fa fa-plus mPlus" onClick="summProduct(<?=$item['id']?>, 'plus', <?=$n?>)"></i>
									</div>
									</div>
								</div>
								<div class="col-sm-2 col-md-2 col-lg-2 cart-item">
									<p><strong><span id="summProduct<?=$n?>"><?=($item['price'] * $item["quantity"])?> руб</span></strong></p>
								</div>
								<div class="col-sm-1 col-md-1 col-lg-1 cart-item">
									<i class="fa fa-remove cart-remove-btn" onClick="delBasket('<?=$item["id"]?>')"></i>
								</div>
								
							</div>
						<?$n++;}?>
                            <div id="resGift">
                            </div>
              <div class="bs-callout bs-callout-danger">
                <h4>Внимание!</h4>
                <p>Может потребоваться предоплата. О необходимости и размере предоплаты сообщит менеджер магазина.</p>
              </div>
						<div class="clearfix"></div>
						<!-- Total -->
						<div class="cart-total">Итого : <strong><span id="total" style="font-size:22px;"><?=sumBasket()?> руб</span></strong><div class="row" style="font-size:12px;margin-top:10px;color:##928f8f;"><i class="fa fa-truck"></i> Получение: самовывоз или доставка (<?=date('d.m.Y', strtotime('+'.$day.' days'));?>)</div></div>
						<div class="clearfix"></div>
						<a href="/checkout.html" class="ht-btn ht-btn-default pull-right">Оформить заказ</a>
						<?}else{?>
							<div class="cart-total" style="text-align:center;">
								<i class="fa fa-shopping-cart"></i> Корзина пуста!
							</div>
						<?}?>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>