<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    session_start();
    //////Подключение к базе
    include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
    /////Подключение библиотеки
    include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');

    $id = clearData($_POST["id"], "i");

    mysql_query("DELETE FROM basket WHERE id='$id' AND customer='".session_id()."'") or die(mysql_error());
    $arr = array();
    $sBasket = selectBasket();
    $arr["head"] =' <a href="/basket.html">
										<i class="fa fa-shopping-basket"></i>
										<span class="badge">'.count($sBasket).'</span>
									</a>
									<ul class="cart-dropdown">
										<li class="bg-white bg1-gray-15 color-inher">';
    if($sBasket){
        $n=0;

        foreach($sBasket as $iBasket){
            if($day < $iBasket["day"]){
                $day = $iBasket["day"];
            }
            $sale="";
            if($iBasket['sale'] >0){
                $sale='<span class="color-red">(-'.$iBasket['sale'].' %)</span>';
            }
            $fSummM = "summProduct(".$iBasket['id'].", 'minus', ".$n.")";
            $fSummP = "summProduct(".$iBasket['id'].", 'plus', ".$n.")";
            $fDel = "delBasket('".$iBasket["id"]."')";
            $sWeight = selectWeigth($iBasket["product_id"]);
            $resWeight = '';
            if($sWeight){
                $resWeight = '<span style="color: #999;">Вес кг.: '.$sWeight["weight_1"]*$iBasket['quantity'].', объем м3.:  '.$sWeight["scope_1"]*$iBasket['quantity'].'</span>';
            }
            $arr["body"].= '<div class="row m-lg-0 overl bor-r">
								<div class="col-sm-5 col-md-5 col-lg-5 cart-item">
									<div class="row">
										<div class="col-sm-3 col-md-3 col-lg-3">
											<a href="'.$iBasket['url'].'" class="cart-img-prev">
												<img src="'.$iBasket['img'].'" alt="'.$iBasket['name'].'">
											</a>
										</div>
										<div class="col-sm-9 col-md-9 col-lg-9 p-lg-0">	
											<div class="product-name">
												<h5><a href="'.$iBasket['url'].'">'.$iBasket['name'].'</a></h5>'.$resWeight.'
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-2 col-md-2 col-lg-2 cart-item">
									<p class="color-green"><span class="price">'.$iBasket['price'].' руб.</span>'.$sale.'</p>
								</div>
								<div class="col-sm-2 col-md-2 col-lg-2 cart-item">
									<div class="form-group dop">
									<div class="col-md-2" style="padding: 2.5em 0;">
										<i class="fa fa-minus mMinus" onClick="'.$fSummM.'"></i>
									</div>
									<div class="col-md-8" style="padding:0px; margin:0px;">
										<input id="valInput'.$n.'" type="text" value="'.$iBasket['quantity'].'" class="form-control form-item fInput" style=" width: 100%; margin: 0px; text-align: center; margin-top: 20%;">
									</div>
									<div class="col-md-2" style="padding: 2.5em 0;">
										<i class="fa fa-plus mPlus" onClick="'.$fSummP.'"></i>
									</div>
									</div>
								</div>
								<div class="col-sm-2 col-md-2 col-lg-2 cart-item">
									<p><strong><span id="summProduct'.$n.'">'.($iBasket['price'] * $iBasket["quantity"]).' руб</span></strong></p>
								</div>
								<div class="col-sm-1 col-md-1 col-lg-1 cart-item">
									<i class="fa fa-remove cart-remove-btn" onClick="'.$fDel.'"></i>
								</div>
								
							</div>';
            $func = "delBasket('".$iBasket["id"]."')";
            $arr["head"].= '<div class="product-item">
													<div class="row m-lg-0">
														<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 p-l-lg-0">
															<a href="'.$iBasket["url"].'" class="product-img"><img src="'.$iBasket["img"].'" alt="image"></a>
														</div>
														<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 p-lg-0">
															<div class="product-caption text-left">
																<h4 class="product-name p-lg-0">
																	<a href="'.$iBasket["url"].'">'.$iBasket["name"].'</a>
																</h4>
																<p>'.$iBasket["quantity"].' x <strong>'.$iBasket["price"].' руб</strong></p>
															</div>
														</div>
														<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 p-lg-0">
															<i class="fa fa-remove remove-cart-item" onClick="'.$func.'"></i>
														</div>
													</div>
												</div>';
            $n++;
        }
        $date_dos = date('d.m.Y', strtotime('+'.$day.' days'));
        $arr["body"].='<div id="resGift">
                            </div><div class="bs-callout bs-callout-danger">
                            <h4>Внимание!</h4>
                            <p>Может потребоваться предоплата. О необходимости и размере предоплаты сообщит менеджер магазина.</p>
                          </div><div class="clearfix"></div>
							<!-- Total -->
							<div class="cart-total">Итого : <strong><span id="total" style="font-size:22px;">'.sumBasket().' руб</span></strong><div class="row" style="font-size:12px;margin-top:10px;color:##928f8f;"><i class="fa fa-truck"></i> Получение: самовывоз или доставка ('.$date_dos.')</div></div>
							<div class="clearfix"></div>
							<a href="/checkout.html" class="ht-btn ht-btn-default pull-right">Оформить заказ</a>';

    }else{
        $arr["body"].='<div class="cart-total" style="text-align:center;">
								<i class="fa fa-shopping-cart"></i> Корзина пуста!
							</div>';
    }
    if($sBasket){
        $arr["head"].='<div class="p-t-lg-15 p-b-lg-10">Итог : <strong class="pull-right price">'.sumBasket().' руб</strong></div>
											<div class="clearfix"></div>
											<a href="" class="ht-btn">Заказать</a>';
    }else{
        $arr["head"].='<div class="cart-total" style="text-align:center;padding: 10px 10px;font-size:16px;">
												<i class="fa fa-shopping-cart"></i> Корзина пуста!
											</div>';
    }
    $arr["head"].='<a href="/basket.html" class="ht-btn pull-right">В корзину</a></li>
									</ul>';
    echo json_encode($arr);
}
?>