<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
  <div class="page-sidebar navbar-collapse collapse">
    <!-- BEGIN SIDEBAR MENU -->
    <ul class="page-sidebar-menu">
      <li class="sidebar-toggler-wrapper">
        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        <div class="sidebar-toggler hidden-phone">
        </div>
        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        <br>
      </li>
      <li class="<? if (!isset($_GET["code"])) echo "start active "; ?>">
        <a href="/adminius/index.php">
          <i class="fa fa-home"></i>
          <span class="title">
							Главная
						</span>
          <span class="selected">
						</span>
        </a>
      </li>
      <? if ($access["admin"] == 1) { ?>
        <li class="<? if ($_GET["code"] == "adminUser" or $_GET["code"] == "group") echo "active "; ?>">
          <a href="index.php?code=adminUser">
            <i class="fa fa-user"></i>
            <span class="title">
								Администраторы
							</span>
            <span class="selected">
							</span>
          </a>
        </li>
      <? } ?>
      <? if ($access["users"] == 1) { ?>
        <li class="<? if ($_GET["code"] == "users") echo "active "; ?>">
          <a href="index.php?code=users">
            <i class="fa fa-user"></i>
            <span class="title">
								Пользователи
							</span>
            <span class="selected">
							</span>
          </a>
        </li>
      <? } ?>
      <? if ($access["sections"] == 1) { ?>
        <li class="<? if ($_GET["code"] == "sections") echo "active "; ?>">
          <a href="index.php?code=sections">
            <i class="fa fa-sitemap"></i>
            <span class="title">
								Страницы
							</span>
            <span class="selected">
							</span>
          </a>
        </li>
      <? } ?>
      <? if ($access["slider"] == 1) { ?>
        <li class="<? if ($_GET["code"] == "slider") echo "active "; ?>">
          <a href="index.php?code=slider">
            <i class="fa fa-picture-o"></i>
            <span class="title">
								Слайдер | Баннера
							</span>
            <span class="selected">
							</span>
          </a>
        </li>
      <? } ?>
      <? if ($access["product"] == 1) { ?>
        <li class="<? if ($_GET["code"] == "categories" or $_GET["code"] == "product" or $_GET["code"] == "filter" or $_GET["code"] == "elementfilter") echo "active "; ?>">
          <a href="index.php?code=categories">
            <i class="fa fa-gift"></i>
            <span class="title">
								Товары
							</span>
            <span class="selected">
							</span>
          </a>
        </li>
      <? } ?>
      <? if ($access["orders"] == 1) { ?>
        <li class="<? if ($_GET["code"] == "orders") echo "active "; ?>">
          <a href="index.php?code=orders">
            <i class="fa fa-shopping-cart"></i>
            <span class="title">
								Заказы
							</span>
            <span class="selected">
							</span>
          </a>
        </li>
      <? } ?>
      <? if ($access["orders"] == 1) { ?>
        <li class="<? if ($_GET["code"] == "log_shipments") echo "active "; ?>">
          <a href="index.php?code=log_shipments">
            <i class="fa fa-shopping-cart"></i>
            <span class="title"> Журнал отправок </span>
            <span class="selected"> </span>
          </a>
        </li>
      <? } ?>

      <? if ($access["extra_charge"] == 1) { ?>
        <li class="<? if ($_GET["code"] == "extra_charge_disk" or $_GET["code"] == "extra_charge_tyres" or $_GET["code"] == "provider_extra_charge") echo "active "; ?>">
          <a href="#">
            <i class="fa fa-money"></i>
            <span class="title">
								Наценка
							</span>
            <span
                class="arrow <? if ($_GET["code"] == "extra_charge_disk" or $_GET["code"] == "extra_charge_tyres" or $_GET["code"] == "provider_extra_charge") echo "open "; ?>"></span>
            <span class="selected">
							</span>
          </a>
          <ul class="sub-menu"
              style="display: <? if ($_GET["code"] == "extra_charge_disk" or $_GET["code"] == "extra_charge_tyres") echo "block "; ?>">
            <li class="<? if ($_GET["code"] == "extra_charge_tyres") echo "active "; ?>"><a
                  href="index.php?code=extra_charge_tyres"><i class="fa fa-circle-o"></i> Шины</a></li>
            <li class="<? if ($_GET["code"] == "extra_charge_disk") echo "active "; ?>"><a
                  href="index.php?code=extra_charge_disk"> <i class="fa fa-dot-circle-o "></i> Диски</a></li>
            <li class="<? if ($_GET["code"] == "provider_extra_charge") echo "active "; ?>"><a
                  href="index.php?code=provider_extra_charge"> <i class="fa fa-male"></i> Стоимость доставки единицы
                                                                                          товаров</a></li>
          </ul>
        </li>
      <? } ?>

      <? if ($access["extra_charge"] == 1) { ?>
        <li class="<? if ($_GET["code"] == "gift_provider") echo "active "; ?>">
          <a href="index.php?code=gift_provider">
            <i class="fa fa-money"></i>
            <span class="title"> Акционные указания </span>
            <span class="selected"> </span>
          </a>
        </li>
      <? } ?>

      <? if ($access["xml"] == 1 OR  $access["xmlAUTORU"] == 1 OR $access["xmlClient"] == 1) { ?>
        <li class="<? if ($_GET["code"] == "xml" or $_GET["code"] == "xmlAUTORU" or $_GET["code"] == "xmlClient") echo "active "; ?>">
          <a href="#">
            <i class="fa fa-list-alt"></i>
            <span class="title"> Прайсы </span>
            <span class="arrow <? if ($_GET["code"] == "xml" or $_GET["code"] == "xmlAUTORU" or $_GET["code"] == "xmlClient") echo "open "; ?>"></span>
            <span class="selected"> </span>
          </a>
          <ul class="sub-menu"
              style="display: <? if ($_GET["code"] == "extra_charge_disk" or $_GET["code"] == "extra_charge_tyres") echo "block "; ?>">
            <li class="<? if ($_GET["code"] == "xml") echo "active "; ?>"><a
                  href="index.php?code=xml"><i class="fa fa-list-alt"></i> Прайс для ЯМ</a></li>
            <li class="<? if ($_GET["code"] == "xmlAUTORU") echo "active "; ?>"><a
                  href="index.php?code=xmlAUTORU"> <i class="fa fa-list-alt "></i> Прайс для AUTORU</a></li>
            <li class="<? if ($_GET["code"] == "xmlClient") echo "active "; ?>"><a
                  href="index.php?code=xmlClient"> <i class="fa fa-list-alt"></i> Прайс для клиента</a></li>
          </ul>
        </li>
      <? } ?>

      <?/* if ($access["xml"] == 1) { ?>
        <li class="<? if ($_GET["code"] == "xml") echo "active "; ?>">
          <a href="index.php?code=xml">
            <i class="fa fa-list-alt"></i>
            <span class="title">
								Прайс для ЯМ
							</span>
            <span class="selected">
							</span>
          </a>
        </li>
      <? } ?>
      <? if ($access["xmlAUTORU"] == 1) { ?>
        <li class="<? if ($_GET["code"] == "xmlAUTORU") echo "active "; ?>">
          <a href="index.php?code=xmlAUTORU">
            <i class="fa fa-list-alt"></i>
            <span class="title">  Прайс для AUTORU </span>
            <span class="selected"> </span>
          </a>
        </li>
      <? } ?>
      <? if ($access["xmlClient"] == 1) { ?>
        <li class="<? if ($_GET["code"] == "xmlClient") echo "active "; ?>">
          <a href="index.php?code=xmlClient">
            <i class="fa fa-list-alt"></i>
            <span class="title"> Прайс для клиента </span>
            <span class="selected"> </span>
          </a>
        </li>
      <? } */?>

      <? if ($access["goods_movement"] == 1) { ?>
        <li class="<? if ($_GET["code"] == "goods_movement") echo "active "; ?>">
          <a href="index.php?code=goods_movement">
            <i class="fa fa-random"></i>
            <span class="title"> Движение товара </span>
            <span class="selected"> </span>
          </a>
        </li>
      <? } ?>
        <? if ($access["invoice"] == 1) { ?>
            <li class="<? if ($_GET["code"] == "invoice" or $_GET["code"] == "prepayment" or $_GET["code"] == "cashless") echo "active "; ?>">
                <a href="#">
                    <i class="fa fa-list"></i>
                    <span class="title">
								Реестр
							</span>
                    <span
                            class="arrow <? if ($_GET["code"] == "invoice" or $_GET["code"] == "prepayment" or $_GET["code"] == "cashless") echo "open "; ?>"></span>
                    <span class="selected">
							</span>
                </a>
                <ul class="sub-menu"
                    style="display: <? if ($_GET["code"] == "invoice" or $_GET["code"] == "prepayment" or $_GET["code"] == "cashless") echo "block "; ?>">
                    <li class="<? if ($_GET["code"] == "invoice") echo "active "; ?>"><a
                                href="index.php?code=invoice"><i class="fa fa-list"></i> Накладные</a></li>
                    <li class="<? if ($_GET["code"] == "prepayment") echo "active "; ?>"><a
                                href="index.php?code=prepayment"> <i class="fa fa-list"></i> Предоплата</a></li>
                    <li class="<?if ($_GET["code"] == "cashless") echo "active "; ?>"><a
                                href="index.php?code=cashless"> <i class="fa fa-list"></i> Безнал</a></li>
                </ul>
            </li>
        <? } ?>
      <? /*if($access["message_admin"] == 1){?>
						<li class="<?if ($_GET["code"] == "message_admin" or $_GET["code"] == "message") echo "active ";?>">
							<a href="index.php?code=message_admin">
							<i class="fa fa-phone"></i>
							<span class="title">
								Заявки на запчасти
							</span>
							<span class="selected">
							</span>
							</a>
						</li>
					<?}*/ ?>
      <? if ($access["blog"] == 1) { ?>
        <li class="<? if ($_GET["code"] == "news") echo "active "; ?>">
          <a href="index.php?code=news">
            <i class="fa fa-file-text"></i>
            <span class="title">
								Новости
							</span>
            <span class="selected">
							</span>
          </a>
        </li>
      <? } ?>
      <? if ($access["finance"] == 1) { ?>
        <li class="<? if ($_GET["code"] == "finance") echo "active "; ?>">
          <a href="index.php?code=finance">
            <i class="fa fa-file-text"></i>
            <span class="title">
                                    Финансы
                                </span>
            <span class="selected">
                                </span>
          </a>
        </li>
      <? } ?>
      <? if ($access["blog"] == 1) { ?>
        <li class="<? if ($_GET["code"] == "stock") echo "active "; ?>">
          <a href="index.php?code=stock">
            <i class="fa fa-file-text"></i>
            <span class="title">
                                        Акции
                                    </span>
            <span class="selected">
                                    </span>
          </a>
        </li>
      <? } ?>
      <? /*if($access["banner"] == 1){?>
						<li class="<?if ($_GET["code"] == "banner") echo "active ";?>">
							<a href="index.php?code=banner">
							<i class="fa fa-picture-o"></i>
							<span class="title">
								Баннера
							</span>
							<span class="selected">
							</span>
							</a>
						</li>
					<?}*/ ?>
      <? /*if($access["logs"] == 1){?>
						<li class="<?if ($_GET["code"] == "logs") echo "active ";?>">
							<a href="index.php?code=logs">
							<i class="fa fa-info-circle"></i>
							<span class="title">
								Логи
							</span>
							<span class="selected">
							</span>
							</a>
						</li>
					<?}*/ ?>
      <? if ($access["basket"] == 1) { ?>
        <li class="<? if ($_GET["code"] == "basket") echo "active "; ?>">
          <a href="index.php?code=basket">
            <i class="fa fa-shopping-cart"></i>
            <span class="title"> Корзина покупателей </span>
            <span class="selected"> </span>
          </a>
        </li>
      <? } ?>
      <? if ($access["settings"] == 1) { ?>
        <li class="<? if ($_GET["code"] == "settings") echo "active "; ?>">
          <a href="index.php?code=settings">
            <i class="fa fa-cogs"></i>
            <span class="title">
								Настройки
							</span>
            <span class="selected">
							</span>
          </a>
        </li>
      <? } ?>
    </ul>
    <!-- END SIDEBAR MENU -->
  </div>
</div>
<!-- END SIDEBAR -->