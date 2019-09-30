<?php $sBasket = selectBasket();
$sRegionUfa = selectOfficeByid(1);?>
<!DOCTYPE html>
<html lang="ru">
<?include($_SERVER['DOCUMENT_ROOT'].'/templates/head.tpl.php');?>
<body class="bg-3">
<?
//$ipUfa = '95.110.113.109';
//$ip = '195.19.132.64';
$ipUfa = $_SERVER['REMOTE_ADDR'];
include($_SERVER['DOCUMENT_ROOT']."/api/SxGeo.php");
$SxGeo = new SxGeo($_SERVER['DOCUMENT_ROOT'].'/api/SxGeoCity.dat');
//echo "<pre>".print_r($SxGeo->getCityFull($ip), true)."</pre>";
if(!$_COOKIE['region']){
  if($SxGeo->getCityFull($ip)[city][name_ru] == 'Уфа' OR $SxGeo->getCityFull($ip)[city][name_ru] == 'Екатеринбург'){
    switch ($SxGeo->getCityFull($ip)[city][name_ru]){
      case "Уфа": $id_region = 2; $name_region = 'Уфе'; break;
      case "Екатеринбург": $id_region = 3; $name_region = 'Екатеринбурге'; break;
    }
    $sRegion = selectOfficeByid($id_region);
    include($_SERVER['DOCUMENT_ROOT'].'/templates/form/modalRegion.tpl.php');
    unset($id_region, $name_region);
  }
}
$sRegion = selectOfficeByid($_COOKIE['region']);
?>
<div id="wrap" class="color1-inher">
  <!-- Header-->
  <header id="wrap-header" class="color-inher">
    <div class="top-header">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-md-6 col-lg-6 hidden-xs">
            <p class="f-14"><i class="fa fa-map-marker m-r-lg-5"></i><strong>Добрая шина</strong> -  <?if($_COOKIE['region'] == 2){echo $sRegionUfa["address"];}else{echo $settings['addres'];}?></p>
          </div>
          <div class="col-sm-5 col-md-5 col-lg-5">
            <ul class="pull-right" id="loginForm">
							<?if(!$session){?>
								<li><a href="/registration.html" class="icon-1"><span>Регистрация</span></a></li>
								<li><a href="#" class="icon-1" data-toggle="modal" data-target="#loginModal"><span>Вход</span></a></li>
								<?include($_SERVER['DOCUMENT_ROOT'].'/templates/form/modalLogin.tpl.php');?>							
							<?}else{?>
								<li><a href="/orders.html" class="icon-1"><i class="fa fa-user"></i><span>Мои заказы</span></a></li>
								<li><a href="/profile.html" class="icon-1"><i class="fa fa-user"></i><span>Профиль</span></a></li>
								<li><a href="/logout.php" class="icon-1"><i class="fa fa-power-off"></i><span>Выход</span></a></li>
							<?}?>
						</ul>
					</div>
					<div class="col-sm-1 col-md-1 col-lg-1">
						<ul class="pull-right">
              <li class="cart-icon" id="resBasket">
                <a href="/basket.html">
                  <i class="fa fa-shopping-cart" style="font-size: 20px;"></i>
                  <span class="badge"><?=count($sBasket);?></span>
                </a>
                <ul class="cart-dropdown">
                  <li class="bg-white bg1-gray-15 color-inher">
                    <!-- Product item -->
										<?if($sBasket){
											foreach($sBasket as $iBasket){?>
												<div class="product-item">
													<div class="row m-lg-0">
														<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 p-l-lg-0">
															<a href="<?=$iBasket["url"]?>" class="product-img"><img src="<?=$iBasket["img"]?>" alt="image"></a>
														</div>
														<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 p-lg-0">
															<div class="product-caption text-left">
																<h4 class="product-name p-lg-0">
																	<a href="<?=$iBasket["url"]?>"><?=$iBasket["name"]?></a>
																</h4>
																<p><?=$iBasket["quantity"]?> x <strong><?=$iBasket["price"]?> руб</strong></p>
															</div>
														</div>
														<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 p-lg-0">
															<i class="fa fa-remove remove-cart-item" onClick="delBasket('<?=$iBasket["id"]?>')"></i>
														</div>
													</div>
												</div>
											<?}?>
											<div class="p-t-lg-15 p-b-lg-10">Итог : <strong class="pull-right price"><?=sumBasket()?> руб</strong></div>
											<div class="clearfix"></div>
										<?}else{?>
											<div class="cart-total" style="text-align:center;padding: 10px 10px;font-size:16px;">
												<i class="fa fa-shopping-cart"></i> Корзина пуста!
											</div>
										<?}?>
                    <a href="/basket.html" class="ht-btn pull-right" style="width:100%;text-align:center;">Перейти в корзину</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- Menu -->
    <div class="menu-bg">
      <div class="container">
        <div class="row">
          <!-- Logo -->
          <div class="col-md-3 col-lg-3">
						<div class="podLogo">
							<a href="/" class="logo"><img src="/images/logo-small.png" alt="logo"></a>
						</div>
          </div>
          <div class="col-md-9 col-lg-9">
            <div class="hotline">
              <span class="m-r-lg-10">Мы готовы помочь, звоните нам</span>
              <i class="fa fa-phone"></i>
							<? $phone = explode(',', $settings['phone']);
								echo $phone[0];
							?>
            </div>
            <div class="clearfix"></div>
            <!-- Menu -->
            <div class="main-menu">
              <div class="container1">
								<?include($_SERVER['DOCUMENT_ROOT'].'/templates/nav.tpl.php');?>
                <!-- Search -->
                <?/*<div class="search-box">
                  <i class="fa fa-search"></i>
                  <form>
                    <input type="text" name="search-txt" placeholder="Поиск..." class="search-txt form-item">
                    <button type="submit" name="submit" class="search-btn btn-1"><i class="fa fa-search"></i></button>
                  </form>
                </div>*/?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>