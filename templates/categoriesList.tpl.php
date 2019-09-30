			<!-- Main content -->
			<div id="wrap-body" class="p-t-lg-30">
				<div class="container">
					<div class="wrap-body-inner">
					<!-- Breadcrumb-->
					<?include($_SERVER['DOCUMENT_ROOT']).'/templates/breadcrumbs.tpl.php';?>
					<!-- Product grid -->
					<section class="m-t-lg-30 m-t-xs-0">
							<div class="row">
								<?include($_SERVER['DOCUMENT_ROOT']).'/templates/left_col.fullProduct.tpl.php';?>
								<div class="col-sm-8 col-md-9 col-lg-9">
									<div class="product product-grid">
										<div class="heading heading-2 m-b-lg-0">
											<h3 class="p-l-lg-20"><?=$meta_item["name"]?> </h3>
										</div>
										<!-- Product filter -->
										<div class="product-filter p-t-xs-20 p-l-xs-20">
											<div class="pull-right">
												<div class="m-b-xs-10 m-r-lg-20 pull-left">
												</div>
												<div class="pull-left">
												</div>
											</div>
										</div>

                    <div class="clearfix"></div>
                    <?if($meta_item['section'] == 1) {
                      include_once $_SERVER['DOCUMENT_ROOT'].'/templates/form/miniFilter.tpl.php';
                    }?>
										<div class="row" id="res_categories_code">
                     <?
                       $sCBC2 = selectCategoriesByCode($_GET["categories_code"]);
                       if($meta_item['section'] == 1) {
                         $sCBC2 = selectCategoriesByCode2($_GET["categories_code"]);
                         $sCBC2 = sort_nested_arrays($sCBC2, array('id_seeson' => 'ASC'));
                       }
                     ?>
											<?foreach($sCBC2 as $iSection){
                        if(($iSection['id_seeson'] == 156 and $w == 0) OR ($iSection['id_seeson'] == 155 and $s == 0) OR ($iSection['id_seeson'] == 157 and $ws == 0)){
                          switch ($iSection['id_seeson']){
                            case 155: $s = 1; break;
                            case 156: $w = 1; break;
                            case 157: $ws = 1; break;
                          }
                          echo "<div class='col-md-12'><div class='product-filter p-t-xs-20 p-l-xs-20'>
                                  <div class='pull-left'>
                                    <h5>".$iSection['seeson_name']."</h5>
                                  </div>
                                </div></div>";
                        }
                      ?>
												<div class="col-sm-6 col-md-3 col-lg-2" style="min-height: 210px !important;">
													<!-- Product item -->
													<div class="product-item hover-img" style="padding:unset;">
														<a href="/<?=$iSection["code"]?>/" class="product-img">
															<?if(!$iSection['img']){?>
																<img src="/images/noimg150.png" alt="<?=$meta_item['title']?>">
															<?}else{?>
                                <?if(file_exists($_SERVER['DOCUMENT_ROOT'].'/images/categories_cover/'.$iSection["img"])){?>
																  <img src="/scripts/phpThumb/phpThumb.php?src=/images/categories_cover/<?=$iSection["img"]?>&w=150&h=150&far=1&bg=ffffff&f=jpg" alt="<?=$iSection["name"]?>">
                                <?}else{?>
                                  <img src="/images/noimg150.png" alt="<?=$meta_item['title']?>">
                                <?}?>
															<?}?>
														</a>
														<div class="product-caption">
															<h4 class="product-name title-product-name" style="font-size:12px;margin-top:unset;font-weight:unset;">
                                <a href="/<?=$iSection["code"]?>/" title="<?=$iSection["name"]?>"><?=$iSection["name"]?></a>
                              </h4>
														</div>
													</div>
												</div>
											<?}?>
										</div>
									</div>
									<div class="seoText"><?=$meta_item["descriptions"]?></div>
								</div>
							</div>
						</section>
					</div>
				</div>
			</div>