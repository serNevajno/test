<?if($_SERVER["REQUEST_METHOD"]=="POST"){
    session_start();
    //////Подключение к базе
    include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
    /////Подключение библиотеки
    include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
    // Фильтруем полученные данные

    $id = clearData($_POST['id']);
    $code = clearData($_POST['code']);
    $sort = clearData($_POST['sort']);
    $price = clearData($_POST['price']);
    $page = clearData($_POST['page'], "i");
    $showmore = clearData($_POST['showmore'], "i");
    $res = array();

    $arrId = explode(',', $id);
    $n = 0;
    $idRes = '';
    foreach ($arrId as $iArrId){
      if($iArrId) {
        if ($n > 0) $idRes .= ",";
        $idRes .= $iArrId;
        $n++;
      }
    }
    $product = selectProduct($idRes, $code, $sort, $price, $page);
    //$res['sql'] = selectProductTest($idRes, $code, $sort, $price, $page);
    $parCat = parentCategories($product[0]["cat_id"]);
    if($parCat == 1){  $pCat = 'tyres'; }else if($parCat == 2){  $pCat = 'disk'; }

    //echo "<pre>";
    ///print_r($_POST);
    //echo "</pre>";
    if($product) {
        if ($parCat == 1 OR $parCat == 2) {
            if($page == '1') {
                $res["product"] .= '<div class="row m-lg-0 overl bor-r">
                                      <div class="col-sm-5 col-md-5 col-lg-5 cart-item" style="height: 60px;">
                                          <div class="row">
                                              <div class="col-sm-12 col-md-12 col-lg-12">
                                                  <div class="product-name">
                                                      <h5 style="font-size: 12px;text-transform: unset;">
                                                          <b>Название</b>
                                                      </h5>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-sm-2 col-md-2 col-lg-2 cart-item" style="padding: 0px;height: 60px;">
                                          <h5 style="font-size: 12px;text-transform: unset;">
                                              <b>Код</b>
                                          </h5>
                                      </div>
                                      <div class="col-sm-1 col-md-1 col-lg-1 cart-item" style="padding: 0px;height: 60px;">
                                          <p style="font-size: 12px;line-height: 50px;font-weight: 500;"><b>Наличие</b></p>
                                      </div>
                                      <div class="col-sm-2 col-md-2 col-lg-2 cart-item" style="height: 60px;">
                                          <p class="product-price color-red" style="font-size: 12px;line-height: 50px;font-weight: 500;"><b>Цена</b></p>
                                      </div>
                                      <div class="col-sm-1 col-md-1 col-lg-1 cart-item" style="height: 60px;padding: 0px">
                                          <h5 style="font-size: 12px;text-transform: unset;"><b>Кол-во</b></h5>
                                      </div>
                                      <div class="col-sm-1 col-md-1 col-lg-1 cart-item" style="height: 60px;padding: 0px;">
                                          <h5 style="font-size: 12px;text-transform: unset;"><b>Купить</b></h5>
                                      </div>
                                  </div>';
            }
            foreach ($product as $iProd) {
                $addBasket = "addBasket('" . $iProd["id"] . "', '" . $pCat . "', '" . $iProd["id"] . "')";
                if ($iProd['sale']) {
                    $sale = '<span class="car-sale" style="float: right;margin-right: 5px;">Скидка ' . $iProd['sale'] . '%</span>';
                }
                if (!$iProd['sale']) {
                    $price = $iProd["price"] . ' руб</span>';
                } else {
                    $price = '<span class="product-price">' . $iProd['price'] * (1 - $iProd['sale'] / 100) . ' <span style="text-transform:initial;" class="color-red">руб</span>
			</span><br><span class="price-sale-line">' . $iProd['price'] . ' <span style="text-transform:initial;" class="color-red">руб</span></span>';
                }
                $date = date('d.m.Y', strtotime('+' . $iProd["logistic"] . ' days'));
                if ($iProd[availability] < 4) {
                    $quant = $iProd[availability];
                } else {
                    $quant = '4';
                }
                if($iProd[availability] > 0){$availability = $iProd['availability'];}else{$availability = '<span style="font-size: 12px; display: block; color: #cb1010;">Нет в <br>наличии</span>';}
                $buy ='';
                if($iProd[availability] > 0){$buy = '<a onClick="' . $addBasket . '"
               class="ht-btn ht-btn-default"
               data-toggle="modal" data-target="#addBasket" style="text-transform:unset;border-radius: 5px;font-size: 12px;padding: 5px;">Купить</a>';}
                $res["product"] .= '
        <div class="row m-lg-0 overl bor-r">
          <div class="col-sm-5 col-md-5 col-lg-5 cart-item" style="height: 60px;">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="product-name">
                  <h5 style="font-size: 12px;text-transform: unset;">
                    <a href="/' . $pCat . '/' . $iProd["code"] . '-' . $iProd["id"] . '.html">
                      ' . $iProd["name"] . '
                    </a>
                  </h5>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-2 col-md-2 col-lg-2 cart-item" style="padding: 0px;height: 60px;">
            <h5 style="font-size: 12px;text-transform: unset;">
              Код: S' . $iProd["provider"] . '-' . $iProd["article"] . '
            </h5>
          </div>
          <div class="col-sm-1 col-md-1 col-lg-1 cart-item" style="padding: 0px;height: 60px;">
            <p style="font-size: 12px;line-height: 50px;font-weight: 500;" id="availability' . $iProd["id"] . '">' . $availability . '</p>
          </div>
          <div class="col-sm-2 col-md-2 col-lg-2 cart-item" style="height: 60px;">
            <p class="product-price color-red" style="font-size: 12px;line-height: 50px;font-weight: 500;">' . $price . '</p>
          </div>
          <div class="col-sm-1 col-md-1 col-lg-1 cart-item" style="height: 60px;padding: 0px">
            <input id="valInput'.$iProd["id"].'" onchange="checkAvailability('.$iProd["id"].')" type="text" value="' . $quant . '" class="form-item form-qtl" style="height: unset; margin-top: 10px;width: 30px;padding: 5px;">
          </div>
          <div class="col-sm-1 col-md-1 col-lg-1 cart-item" style="height: 60px;padding: 0px;">
            '.$buy.'
          </div>
        </div>
      ';
            }
        } else {

            foreach ($product as $iProd) {
                $addBasket = "addBasket('" . $iProd["id"] . "', '" . $pCat . "', '" . $iProd["id"] . "')";

                if ($parCat == '1' OR $parCat == '2') {
                    $img = '<img src="/images/categories_cover/' . $iProd["cat_img"] . '" alt="' . $meta_item["title"] . '">';
                } else {
                    if (!$iProd['img']) {
                        $img = '<img src="http://placehold.it/680x449?text=no image" alt="' . $meta_item["title"] . '">';
                    } else {
                        $img = '<img src="http://' . $_SERVER["SERVER_NAME"] . '/scripts/phpThumb/phpThumb.php?src=/images/product_cover/' . $iProd["img"] . '&w=252&h=188&far=1&bg=ffffff&f=jpg" alt="image">';
                    }
                }
                if ($parCat == '1') {
                    $cat_code = "tyres";
                } elseif ($parCat == '2') {
                    $cat_code = "disk";
                } else {
                    $cat_code = $iProd["cat_code"];
                }
                if ($iProd['attention'] > 0) {
                    switch ($iProd['attention']) {
                        case 1:
                            $attention = "Новинка";
                            break;
                        case 2:
                            $attention = "Лидер продаж";
                            break;
                    }
                    $att = '<br><span class="car-status" style="float: right;">' . $attention . '</span>';
                }
                if ($iProd['sale']) {
                    $sale = '<span class="car-sale" style="float: right;margin-right: 5px;">Скидка ' . $iProd['sale'] . '%</span>';
                }
                if (!$iProd['sale']) {
                    $price = '<span class="product-price">' . $iProd["price"] . ' руб.</span>';
                } else {
                    $price = '<span class="product-price">' . $iProd['price'] * (1 - $iProd['sale'] / 100) . ' <span style="text-transform:initial;" class="color-red">руб</span>
			</span><br><span class="price-sale-line">' . $iProd['price'] . ' <span style="text-transform:initial;" class="color-red">руб</span></span>';
                }
                $date = date('d.m.Y', strtotime('+' . $iProd["logistic"] . ' days'));
                $res["product"] .= '<div class="product-item hover-img">
										<div class="row">
											<div class="col-sm-6 col-md-5 col-lg-4">
												<a href="/' . $cat_code . '/' . $iProd["code"] . '-' . $iProd["id"] . '.html" class="product-img">
													' . $img . '
												</a>
											</div>
											<div class="col-sm-6 col-md-7 col-lg-8 static-position">
												<div class="product-caption">
													<h4 class="product-name"><a href="/' . $cat_code . '/' . $iProd["code"] . '-' . $iProd["id"] . '.html">' . $iProd["name"] . ' | Код: S'.$iProd["provider"].'-'.$iProd["article"].'</a></h4>
													<ul class="rating">
														' . ratingEcho($iProd["avg"]) . $att . $sale . '
													</ul>
													<div class="product-price-group" style="float: left; margin-top: 1%;">
														' . $price . '
													</div>
													<div class="col-sm-12 col-md-4 col-lg-4" style="text-align: center;margin-top:1%;">
                            <div class="form-group dop">
                              <!--<div>
                                <b >В наличии: Много</b>
                              </div>-->
                              <i class="fa fa-plus mPlus" onclick="valPlus(' . $iProd["id"] . ', ' . $iProd["availability"] . ')"></i>
                              <input id="valInput' . $iProd["id"] . '" type="text" value="4" class="form-control form-item fInput">
                              <i class="fa fa-minus mMinus" onclick="valMinus(' . $iProd["id"] . ', ' . $iProd["availability"] . ')"></i>
                            </div>
                          </div>
													<div class="col-sm-12 col-md-5 col-lg-5">
													<a onClick="' . $addBasket . '" class="ht-btn ht-btn-default" data-toggle="modal" data-target="#addBasket">В корзину</a>
													</div>
													<div class="row" style="font-size:12px;margin-top:10px;color:#928f8;float: right;margin-right: 25px;"><i class="fa fa-truck"></i> Получение: самовывоз или доставка (' . $date . ')</div>
												</div>
											</div>
										</div>
									</div>';
            }
        }
    }else{
      $res["product"] = '<div class="col-md-12" style="margin-bottom:50px;">
							<div class="bs-callout bs-callout-warning">
								<h4><i class="fa fa-info"></i> 
                  По Вашему запросу ничего не найдено
                </h4>
							</div>
						</div>';
    }
    $res["total"] = $total;
    if($total>1) {
      $res["pagination"] = '<nav aria-label="Page navigation">
			<ul class="pagination ht-pagination">
				' . $pervpage . $page5left . $page4left . $page3left . $page2left . $page1left . '
				<li class="active"><a>' . $page . '</a></li>
				' . $page1right . $page2right . $page3right . $page4right . $page5righ . $nextpage . '	
			</ul>
		</nav>';
    }else{
      $res["pagination"] = '';
    }
    echo json_encode($res);
}?>