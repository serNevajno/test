<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
			Панель управления
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="/adminius/index.php">Главная</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<?php if ($_GET['code']){?>
				<li>
					<a href="index.php?code=<?=$_GET['code'];?>">
						<?
							switch ($_GET['code']) {
								case "users": echo "Пользователи"; break;
								case "slider": echo "Слайдер"; break;
								case "message_admin": echo "Cообщение администрации"; break;
								case "message": echo "Cообщение администрации"; break;
								case "settings": echo "Настройки сайта"; break;
								case "sections": echo "Категории/Страницы"; break;
								case "directory": echo "Каталог"; break;
								case "feedback": echo "Отзывы"; break;
								case "logs": echo "Логи"; break;
								case "group": echo "Группы администраторов"; break;
								case "adminUser": echo "Администраторы"; break;
								case "blog": echo "Блог"; break;
								case "gallery": echo "Галерея"; break;
								case "gallery_cat": echo "Галерея"; break;
								case "news": echo "Новости"; break;
								case "categories": echo "Категории"; break;
								case "filter": echo "Фильтер"; break;
								case "elementfilter": echo "Елементы фильтра"; break;
								case "product": echo "Товары"; break;
								case "extra_charge_tyres": echo "Наценка"; break;
								case "extra_charge_disk": echo "Товары"; break;
								case "orders": echo "Заказы"; break;
								case "xml": echo "Прайс для ЯМ"; break;
								case "provider_extra_charge": echo "Стоимость доставки единицы товаров"; break;
                                case "gift_provider": echo "Акционные указания"; break;
                                case "log_shipments": echo "Журнал отправок"; break;
                                case "goods_movement": echo "Движение товара"; break;
                                case "invoice": echo "Реестр накладных"; break;
                                case "prepayment": echo "Реестр предоплат"; break;
                                case "cashless": echo "Реестр безнала"; break;
							}
						?>
					</a>
				</li>
                <?if($_GET["code"] == "product" AND $_GET["action"] == "upload"){?>
                    <li>
                        <i class="fa fa-angle-right"></i>
                        <a href="index.php?code=product&action=upload">Загрузка товара</a>
                    </li>
                    <li>
                        <i class="fa fa-angle-right"></i>
                        <a href="#"><?=selectProviderNameById($_GET["id"]);?></a>
                    </li>
                <?}?>
				<?if($_GET["code"] == "categories"){?>
					<?=recusiveCategoriesBreadcrumbs($_GET["section"]);?>
				<?}elseif($_GET["code"] == "product"){?>
					<?=recusiveCategoriesBreadcrumbs($_GET["cat"]);?>
				<?}?>
			<?}?>
		</ul>
		<!-- END PAGE TITLE & BREADCRUMB-->
	</div>
</div>
<!-- END PAGE HEADER-->