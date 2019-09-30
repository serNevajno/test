<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>ITdevelopers | Админ панель</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <meta name="MobileOptimized" content="320">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
    <link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2_metro.css"/>
    <link rel="stylesheet" href="assets/plugins/data-tables/DT_bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-fileupload/bootstrap-fileupload.css"/>
    <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-colorpicker/css/colorpicker.css"/>
    <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css"/>
    <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css"/>
    <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-datepicker/css/datepicker.css"/>
    <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-timepicker/compiled/timepicker.css"/>
    <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-editable/inputs-ext/address/address.css"/>
    <link href="assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL PLUGIN STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link href="assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/pages/tasks.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/pages/timeline.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>
    <script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="/css/style-modal.css" />
</head>
<!-- END HEAD --><!-- BEGIN BODY -->
<body class="page-header-fixed">
<!-- BEGIN HEADER -->
<div class="header navbar navbar-inverse navbar-fixed-top">
    <!-- BEGIN TOP NAVIGATION BAR -->
    <div class="header-inner">
        <!-- BEGIN LOGO -->
        <a class="navbar-brand" href="/adminius/">
            <img src="assets/img/logo.png" alt="logo" class="img-responsive"/>
        </a>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <img src="assets/img/menu-toggler.png" alt=""/>
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <ul class="nav navbar-nav pull-right">
            <!-- BEGIN INBOX DROPDOWN -->
            <li class="dropdown" id="header_inbox_bar">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <i class="fa fa-tasks"></i>
                    <span class="badge">
							1						</span>
                </a>
                <ul class="dropdown-menu extended notification">

                    <li>
                        <p>
                            У Вас 1 новых заказов.
                        </p>
                    </li>
                    <li class="external">
                        <a href="/adminius/index.php?code=orders">Показать все заказы <i class="m-icon-swapright"></i></a>
                    </li>
                </ul>
            </li>
            <!-- END INBOX DROPDOWN -->
            <!-- BEGIN INBOX DROPDOWN -->
            <li class="dropdown" id="header_inbox_bar">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <i class="fa fa-envelope"></i>
                </a>
                <ul class="dropdown-menu extended notification">
                    <li>
                        <p>
                            У Вас 0 заявки на обратный звонок.
                        </p>
                    </li>
                    <li class="external">
                        <a href="/adminius/index.php?code=message_admin">Показать все заявки <i class="m-icon-swapright"></i></a>
                    </li>
                </ul>
            </li>
            <!-- END INBOX DROPDOWN -->
            <!-- BEGIN USER LOGIN DROPDOWN -->
            <li class="dropdown user">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
	<span class="username">
		serg	</span>
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="/adminius/index.php?code=adminUser"><i class="fa fa-user"></i> Администраторы</a>
                    </li>
                    <li>
                        <a onclick="logout()" style="cursor: pointer;"><i class="fa fa-key"></i> Выйти</a>
                    </li>
                </ul>
            </li>
            <!-- END USER LOGIN DROPDOWN -->		</ul>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER --><div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
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
                <li class="">
                    <a href="/adminius/index.php">
                        <i class="fa fa-home"></i>
                        <span class="title">
							Главная
						</span>
                        <span class="selected">
						</span>
                    </a>
                </li>
                <li class="">
                    <a href="index.php?code=adminUser">
                        <i class="fa fa-user"></i>
                        <span class="title">
								Администраторы
							</span>
                        <span class="selected">
							</span>
                    </a>
                </li>
                <li class="">
                    <a href="index.php?code=users">
                        <i class="fa fa-user"></i>
                        <span class="title">
								Пользователи
							</span>
                        <span class="selected">
							</span>
                    </a>
                </li>
                <li class="">
                    <a href="index.php?code=sections">
                        <i class="fa fa-sitemap"></i>
                        <span class="title">
								Страницы
							</span>
                        <span class="selected">
							</span>
                    </a>
                </li>
                <li class="">
                    <a href="index.php?code=slider">
                        <i class="fa fa-picture-o"></i>
                        <span class="title">
								Слайдер | Баннера
							</span>
                        <span class="selected">
							</span>
                    </a>
                </li>
                <li class="">
                    <a href="index.php?code=categories">
                        <i class="fa fa-gift"></i>
                        <span class="title">
								Товары
							</span>
                        <span class="selected">
							</span>
                    </a>
                </li>
                <li class="active ">
                    <a href="index.php?code=orders">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="title">
								Заказы
							</span>
                        <span class="selected">
							</span>
                    </a>
                </li>
                <li class="">
                    <a href="#">
                        <i class="fa fa-money"></i>
                        <span class="title">
								Наценка
							</span>
                        <span class="arrow "></span>
                        <span class="selected">
							</span>
                    </a>
                    <ul class="sub-menu" style="display: ">
                        <li class=""><a href="index.php?code=extra_charge_tyres"><i class="fa fa-circle-o"></i> Шины</a></li>
                        <li class=""><a href="index.php?code=extra_charge_disk"> <i class="fa fa-dot-circle-o "></i> Диски</a></li>
                        <li class=""><a href="index.php?code=provider_extra_charge"> <i class="fa fa-male"></i> Стоимость доставки единицы товаров</a></li>
                    </ul>
                </li>
                <li class="">
                    <a href="index.php?code=xml">
                        <i class="fa fa-list-alt"></i>
                        <span class="title">
								Прайс для ЯМ
							</span>
                        <span class="selected">
							</span>
                    </a>
                </li>
                <li class="">
                    <a href="index.php?code=xmlAUTORU">
                        <i class="fa fa-list-alt"></i>
                        <span class="title">
                                            Прайс для AUTORU
                                        </span>
                        <span class="selected">
                                        </span>
                    </a>
                </li>
                <li class="">
                    <a href="index.php?code=xmlClient">
                        <i class="fa fa-list-alt"></i>
                        <span class="title">
                                    Прайс для клиента
                                </span>
                        <span class="selected">
                                </span>
                    </a>
                </li>
                <li class="">
                    <a href="index.php?code=message_admin">
                        <i class="fa fa-phone"></i>
                        <span class="title">
								Заявки на запчасти
							</span>
                        <span class="selected">
							</span>
                    </a>
                </li>
                <li class="">
                    <a href="index.php?code=news">
                        <i class="fa fa-file-text"></i>
                        <span class="title">
								Новости
							</span>
                        <span class="selected">
							</span>
                    </a>
                </li>
                <li class="">
                    <a href="index.php?code=finance">
                        <i class="fa fa-file-text"></i>
                        <span class="title">
                                    Финансы
                                </span>
                        <span class="selected">
                                </span>
                    </a>
                </li>
                <li class="">
                    <a href="index.php?code=stock">
                        <i class="fa fa-file-text"></i>
                        <span class="title">
                                        Акции
                                    </span>
                        <span class="selected">
                                    </span>
                    </a>
                </li>
                <li class="">
                    <a href="index.php?code=settings">
                        <i class="fa fa-cogs"></i>
                        <span class="title">
								Настройки
							</span>
                        <span class="selected">
							</span>
                    </a>
                </li>
            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
    </div>
    <!-- END SIDEBAR -->	<!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
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
                            <a href="/adminius/">Главная</a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            <a href="index.php?code=orders">
                                Заказы					</a>
                        </li>
                    </ul>
                    <!-- END PAGE TITLE & BREADCRUMB-->
                </div>
            </div>
            <!-- END PAGE HEADER-->							            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <div class="tabbable tabbable-custom">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab_0" data-toggle="tab">Все о заказе</a>
                    </li>
                    <li>
                        <a href="#tab_1" data-toggle="tab">История и отправка СМС</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active fontawesome-demo" id="tab_0">
                        <div class="portlet-body">
                            <h2 class="margin-bottom-20">Номер заказа: 3923</h2>
                            <h3 class="form-section">Данные заказчика</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row col-md-12 form-group">
                                        <label class="control-label col-md-3">
                                            <b>
                                                Имя фамилия:                      </b>
                                        </label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">
                                                <a href="#" id="username" data-type="text" data-pk="3923"
                                                   data-original-title="Имя фамилия:">Бадретдинов Роман Назифович</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="row col-md-12 form-group">
                                    </div>

                                    <div class="row col-md-12 form-group">
                                        <label class="control-label col-md-3"><b>Регион:</b></label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">
                                                <a href="#" id="region_id_add" data-type="select" data-pk="3923" data-value=""
                                                   data-original-title="Регион:">Челябинск                        </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><b>Телефон:</b></label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">
                                                <a href="#" id="phone" data-type="text" data-pk="3923"
                                                   data-original-title="Телефон:">
                                                    +7 (922) 150-24-91                        </a>
                                            </p>
                                            <p></p>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><b>Адрес:</b></label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">
                                                <a href="#" id="address" data-type="text" data-pk="3923"
                                                   data-original-title="Адрес:">
                                                    3                        </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><b>E-mail:</b></label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="row col-md-12 form-group">
                                        <label class="control-label col-md-3"><b>Доставка:</b></label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">
                                                <a href="#" id="delivery" data-type="select" data-pk="3923" data-value=""
                                                   data-original-title="Доставка:">
                                                    Cамовывоз                        </a>
                                            </p>
                                            <p></p>
                                        </div>
                                    </div>

                                    <div class="row col-md-12 form-group">
                                        <label class="control-label col-md-3"><b>Тип оплаты:</b></label>
                                        <div class="col-md-9">Наличными при получении </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="bs-callout-small bs-callout-info">
                                        <h4>Данный пользовотель впервые совершает покупку!</h4>
                                    </div>
                                </div>
                            </div>

                            <!--/row-->
                            <h3 class="form-section">Данные заказа</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><b>Дата заказа:</b></label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">
                                                2018-06-12 01:06:40                      </p>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><b>Сумма заказа:</b></label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">
                                                <a onclick="questionCause(3923)">
                                                    11480                        </a> руб                                               </p>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><b>Дата ПДЗЗ:</b></label>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012"
                                                     data-date-format="yyyy-mm-dd">
                                                    <input type="text" class="form-control" readonly="" name="from"
                                                           value="" placeholder="Введите дату" id="pdzz"
                                                           onchange="uploadPDZZ('3923');">
                                                    <span class="input-group-btn">
                                                 <span class="btn default date-set"><i
                                                         class="fa fa-calendar"></i></span>
                                              </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"></label>
                                        <div class="col-md-9">

                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><b>Статус заказа:</b></label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">
                                            <form action="index.php" method="POST" name="refform">
                                                <input name="func" type="hidden" value="upStatus">
                                                <input name="id" type="hidden" value="3923">
                                                <input name="sms" type="hidden" value="" id="sms">
                                                <select id="iStatus" name="status" class="form-control input-small"
                                                        style="float: left; height: 25px; padding: 0;">
                                                    <option value="">Выберите вариант</option>
                                                    <option
                                                        id='statOk'                                value="1"
                                                        disabled                            >Выполнен</option>
                                                    <option
                                                        value="2"
                                                    >В обработке</option>
                                                    <option
                                                        value="3"
                                                    >Отменен</option>
                                                    <option
                                                        value="4"
                                                    >Возврат</option>
                                                    <option
                                                        value="5"
                                                    >Новый</option>
                                                    <option
                                                        value="6"
                                                    >Уточнить у покупателя</option>
                                                    <option
                                                        value="7"
                                                    >Недозвон</option>
                                                    <option
                                                        value="8"
                                                    >В офисе</option>
                                                    <option
                                                        value="9"
                                                    >Доставка Челябинск</option>
                                                    <option
                                                        value="10"
                                                    >ЗабранЧастично</option>
                                                    <option
                                                        value="11"
                                                        selected                                                          >Ожидается оплата</option>
                                                    <option
                                                        value="12"
                                                    >Доставка ТК</option>
                                                    <option
                                                        value="13"
                                                    >Доставка Екат</option>
                                                    <option
                                                        value="14"
                                                    >Доставка Уфа</option>
                                                    <option
                                                        value="15"
                                                    >На перемещении</option>
                                                </select>
                                                <input type="text" name="expectation" class="form-control input-small" id="expectation"
                                                       style="float: left; height: 25px; padding: 0; width: 50px !important; padding-left: 10px; margin-left: 10px;"
                                                       placeholder="Время ожидания" value="120"
                                                       title="Время ожидания в часах">
                                            </form>
                                            <a class="btn btn-xs blue btn-editable" data-id="1"
                                               onclick="if (confirm('Отправить SMS?')) {$('#sms').val(1);refform.submit();} else {$('#sms').val(0);refform.submit();}"
                                               style="height: 25px; margin-left: 5px; padding: 4px;"><i class="fa fa-refresh"></i> Обновить</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><b>Сумма без наценки:</b></label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">
                                                11082 руб
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><b>Предоплата:</b></label>
                                        <div class="col-md-9">
                                            <div class="input-group input-medium">
                                                <form action="index.php" method="POST" name="prepaymentForm">
                                                    <input name="func" type="hidden" value="savePrepayment">
                                                    <input name="id" type="hidden" value="3923">
                                                    <input type="text" class="form-control" placeholder="Предоплата" id="prepayment"
                                                           name="prepayment"
                                                           value="">
                                                    На карту - <input type="checkbox" name="card"
                                                                      value="1" >
                                                </form>
                                                <span class="input-group-btn" style="vertical-align: top;">
                        <a class="btn blue" data-id="1" href="javascript:prepaymentForm.submit();"
                           id="savePrepayment"><i
                                class="fa fa-save"></i> </a>
                      </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><b>Безнал</b>:</br></label>
                                        <div class="checkbox-list">
                                            <input type="checkbox" value="1" data-id="3923" id="beznal"
                                                   name="beznal"  onclick="checkBeznal()">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><b>УПД подписан</b>:</b></label>
                                        <div class="checkbox-list">
                                            <input type="checkbox" value="1" data-id="3923" data-title="upd" id="upd"
                                                   name="upd"                              onclick="javascript:if(confirm('Вы уверены что хотите подписать УПД?')){checkUpd()}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!--/span-->
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><b>Коментарий менеджера:</b><br>
                                        </label>
                                        <div class="col-md-9">

                                            <div class="portlet-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th> Дата</th>
                                                            <th> Менеджер</th>
                                                            <th> Комментарий</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td> 2018-06-13 09:48:56 </td>
                                                            <td> Фархад Ибрагимов </td>
                                                            <td> нас приветствует автоответчик</td>
                                                        </tr>
                                                        <tr>
                                                            <td> 2018-06-13 09:53:00 </td>
                                                            <td>
                                                                Антон Стенников </td>
                                                            <td> Скинул Сбер</td>
                                                        </tr>
                                                        <tr>
                                                            <td> 2018-06-13 09:53:41 </td>
                                                            <td>
                                                                Антон Стенников </td>
                                                            <td> Скинул Сбер ЕКатеринбург</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <p class="form-control-static">
                                            <form action="index.php" method="POST" name="comments">
                                                <input name="func" type="hidden" value="saveComments">
                                                <input name="id" type="hidden" value="3923">
                                                <span style="font-size: 10px; color: red; font-weight: 900;">символы ( ; и ^ ) в комментарии НЕ ИСПОЛЬЗОВАТЬ</span>
                                                <textarea rows="2" style="width:100%" name="comments"> </textarea>
                                            </form>
                                            </p>
                                            <a class="btn btn-xs blue btn-editable" data-id="1" href="javascript:comments.submit();"
                                               style="height: 25px;margin-top: 15px;padding: 4px;float: right;"><i class="fa fa-save"></i>
                                                Сохранить</a>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><b>Коментарий заказчика:</b></label>
                                        <div class="col-md-9">
                                            <p class="form-control-static"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/row-->

                            <h3 class="form-section">Товары</h3>
                            <a class="btn btn-success" data-toggle="modal" href="#responsive"><i class="fa fa-plus"></i> Добавить
                                позициию</a>

                            <script>
                                function sendPrint(a, pre) {
                                    var cl = "";
                                    var che = "1";
                                    var prepayment = $('#prepayment').val();

                                    if ($("#closeOrder").attr("checked") == 'checked') {
                                        cl = "&close=1";
                                    }
                                    if (pre == 'none') {
                                        pre = "&prepayment=none";
                                    } else {
                                        pre = "";
                                    }

                                    if (che == "1") {
                                        if (prepayment > 0 && cl == "") {
                                            window.open('/adminius/index.php?code=orders&action=edit&id=3923&print=' + a + cl + pre, '_blank');
                                        } else {
                                            alert("Товара нет в наличии! Оприходуйте товар");
                                        }
                                    } else {
                                        window.open('/adminius/index.php?code=orders&action=edit&id=3923&print=' + a + cl + pre, '_blank');
                                    }
                                }
                            </script>


                            <div class="btn-group">
                                <button class="btn blue dropdown-toggle" type="button" data-toggle="dropdown">
                                    <i class="fa fa-print"></i> Распечатать чек <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a id="print" onClick="sendPrint('print');" style="cursor: pointer;">С предоплатой</a>
                                    </li>
                                    <li>
                                        <a id="print" onClick="sendPrint('print', 'none');" style="cursor: pointer;">Без предоплаты</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="btn-group">
                                <button class="btn blue dropdown-toggle" type="button" data-toggle="dropdown">
                                    <i class="fa fa-print"></i> Распечатать чек A4 <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a id="print" onClick="sendPrint('printA4');" style="cursor: pointer;">С предоплатой</a>
                                    </li>
                                    <li>
                                        <a id="print" onClick="sendPrint('printA4', 'none');" style="cursor: pointer;">Без предоплаты</a>
                                    </li>
                                </ul>
                            </div>


                            <hr>
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Название</th>
                                    <th>Цена</th>
                                    <th>Сумма</th>
                                    <th>Количество</th>
                                    <th>Скидка</th>
                                    <th>Поставщик</th>
                                    <th>Дни логистики</th>
                                    <th>Код товара</th>
                                    <th>НЗСП</th>
                                    <th>Склад</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody role="alert" aria-live="polite" aria-relevant="all">
                                <tr class="odd">
                                    <td class=" sorting_1">1</td>
                                    <td class=""><a href="http://dobrayashina.ru/tyres/letnyaya-shina-pirelli-20555r16-91v-cinturato-p1-verde-tl-245.html" target="_blank">Летняя шина Pirelli 205/55R16 91V Cinturato P1 Verde TL</a></td>
                                    <td class="">2870.00 руб</td>
                                    <td class="">11480.00 руб</td>
                                    <td class="">4 ед.</td>
                                    <td class="">0 %</td>
                                    <td class="">Форточки</td>
                                    <td class="">3</td>
                                    <td class="">2329500</td>
                                    <td class="">
                                        <form action="index.php" method="POST" name="orderFortocki6696"
                                              style="display:none;">
                                            <input name="func" type="hidden" value="orderFortocki">
                                            <input name="productOrder_id" type="hidden" value="6696">
                                            <input name="article" type="hidden" value="2329500">
                                            <input name="quantity" type="hidden" value="4">
                                            <input name="id" type="hidden" value="3923">
                                        </form>
                                        <a class="btn btn-xs yellow btn-removable" data-id="1"
                                           href="javascript:if(confirm('Вы уверены?')){orderFortocki6696.submit();}">Отправить
                                            заказ</a>
                                    </td>
                                    <td class="">
                                        <form action="index.php" method="POST" name="inStorage6696"
                                              style="display:none;">
                                            <input name="func" type="hidden" value="inStorage">
                                            <input name="productOrder_id" type="hidden" value="6696">
                                            <input name="id" type="hidden" value="3923">
                                        </form>
                                        <a class="btn btn-xs yellow btn-removable" data-id="1"
                                           href="javascript:if(confirm('Вы уверены?')){inStorage6696.submit();}">Оприходовать
                                            товар</a>
                                    </td>
                                    <td class="">
                                        <a class="btn btn-xs blue btn-editable" data-id="1"
                                           href="/adminius/index.php?code=orders&action=update&id=6696"><i
                                                class="fa fa-pencil"></i> Edit</a>
                                        <form action="index.php" method="POST" name="delform6696"
                                              style="display:none;">
                                            <input name="func" type="hidden" value="delProdOrder">
                                            <input name="productOrder_id" type="hidden" value="6696">
                                            <input name="id" type="hidden" value="3923">
                                        </form>
                                        <a class="btn btn-xs red btn-removable" data-id="1"
                                           href="javascript:if(confirm('Вы уверены?')){delform6696.submit();}"><i
                                                class="fa fa-times"></i> Delete</a>
                                    </td>
                                </tr>
                                <tr class="odd">
                                    <td class=" sorting_1">2</td>
                                    <td class=""><a href="http://dobrayashina.ru//paket-dlya-shin-51842.html" target="_blank">Пакет для шин</a></td>
                                    <td class="">0.00 руб</td>
                                    <td class="">0.00 руб</td>
                                    <td class="">4 ед.</td>
                                    <td class="">0 %</td>
                                    <td class=""></td>
                                    <td class="">0</td>
                                    <td class="">101</td>
                                    <td class="">
                                    </td>
                                    <td class="">
                                        <form action="index.php" method="POST" name="inStorage6697"
                                              style="display:none;">
                                            <input name="func" type="hidden" value="inStorage">
                                            <input name="productOrder_id" type="hidden" value="6697">
                                            <input name="id" type="hidden" value="3923">
                                        </form>
                                        <a class="btn btn-xs yellow btn-removable" data-id="1"
                                           href="javascript:if(confirm('Вы уверены?')){inStorage6697.submit();}">Оприходовать
                                            товар</a>
                                    </td>
                                    <td class="">
                                        <a class="btn btn-xs blue btn-editable" data-id="1"
                                           href="/adminius/index.php?code=orders&action=update&id=6697"><i
                                                class="fa fa-pencil"></i> Edit</a>
                                        <form action="index.php" method="POST" name="delform6697"
                                              style="display:none;">
                                            <input name="func" type="hidden" value="delProdOrder">
                                            <input name="productOrder_id" type="hidden" value="6697">
                                            <input name="id" type="hidden" value="3923">
                                        </form>
                                        <a class="btn btn-xs red btn-removable" data-id="1"
                                           href="javascript:if(confirm('Вы уверены?')){delform6697.submit();}"><i
                                                class="fa fa-times"></i> Delete</a>
                                    </td>
                                </tr>
                                <tr class="odd">
                                    <td class=" sorting_1">3</td>
                                    <td class=""><a href="http://dobrayashina.ru//aromatizator-gelevyj-quotdobraya-shinaquot-76364.html" target="_blank">Ароматизатор гелевый &quot;Добрая Шина&quot;</a></td>
                                    <td class="">0.00 руб</td>
                                    <td class="">0.00 руб</td>
                                    <td class="">1 ед.</td>
                                    <td class="">0 %</td>
                                    <td class=""></td>
                                    <td class="">0</td>
                                    <td class="">102</td>
                                    <td class="">
                                    </td>
                                    <td class="">
                                        <form action="index.php" method="POST" name="inStorage6698"
                                              style="display:none;">
                                            <input name="func" type="hidden" value="inStorage">
                                            <input name="productOrder_id" type="hidden" value="6698">
                                            <input name="id" type="hidden" value="3923">
                                        </form>
                                        <a class="btn btn-xs yellow btn-removable" data-id="1"
                                           href="javascript:if(confirm('Вы уверены?')){inStorage6698.submit();}">Оприходовать
                                            товар</a>
                                    </td>
                                    <td class="">
                                        <a class="btn btn-xs blue btn-editable" data-id="1"
                                           href="/adminius/index.php?code=orders&action=update&id=6698"><i
                                                class="fa fa-pencil"></i> Edit</a>
                                        <form action="index.php" method="POST" name="delform6698"
                                              style="display:none;">
                                            <input name="func" type="hidden" value="delProdOrder">
                                            <input name="productOrder_id" type="hidden" value="6698">
                                            <input name="id" type="hidden" value="3923">
                                        </form>
                                        <a class="btn btn-xs red btn-removable" data-id="1"
                                           href="javascript:if(confirm('Вы уверены?')){delform6698.submit();}"><i
                                                class="fa fa-times"></i> Delete</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <hr>
                            <div class="row">
                                <div class="form-group">
                                    <a href="" class="btn blue"
                                       style="float:right;margin-right: 25px;">Назад</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fontawesome-demo" id="tab_1">
                        <div style="margin: 15px 0;">
                            <select class="form-control input-medium" onchange="tempSms()" id="tempSms" style="margin-bottom:10px;">
                                <option selected>Выберете шаблон</option>
                                <option>Карта сбербанка 4276 7202 4693 8775 получатель: Любовь Владимировна П. В комментарии к переводу обязательно указать ТОЛЬКО ЦИФРЫ НОМЕРА ЗАКАЗА, например &quot;3002&quot;, что бы мы знали, что это оплата именно от Вас. С уважением, Ваша Добрая Шина</option>
                                <option>Адрес нашего магазина г. Уфа, ул Ульяновых 65/10 (БЦ «Аргамак»)</option>
                                <option>Адрес нашего магазина г. Екатеринбург, ул Шофёров 11е (с торца здания)</option>
                                <option>Адрес нашего магазина г. Челябинск, ул Марата 9</option>
                            </select>
                            <form method="POST">
                                <input type="hidden" value="addSms" name="func">
                                <input type="hidden" value="3923" name="id_order">
                                <input type="hidden" value="+7 (922) 150-24-91" name="phone">
                                <textarea class="form-control" name="text" rows="3" id="tempSmsText"></textarea>
                                <button class="btn green" type="submit" style="width: 100%;">Отправить СМС</button>
                            </form>
                        </div>
                        <div class="portlet-body flip-scroll">
                            <table class="table table-bordered table-striped table-condensed flip-content">
                                <thead class="flip-content">
                                <tr>
                                    <th>
                                        Текст
                                    </th>
                                    <th>
                                        Дата
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td></td>
                                    <td>2018-06-13 10:01:36</td>
                                </tr>
                                <tr>
                                    <td>Карта сбербанка 4276 7202 4693 8775 получатель: Любовь Владимировна П. В комментарии к переводу обязательно указать ТОЛЬКО ЦИФРЫ НОМЕРА ЗАКАЗА, &quot;3923&quot;, что бы мы знали, что это оплата именно от Вас. С уважением, Ваша Добрая Шина</td>
                                    <td>2018-06-13 09:52:48</td>
                                </tr>
                                <tr>
                                    <td>Ув. Покупатель, по вашему заказу № 3923 до Вас не смогли дозвониться.</td>
                                    <td>2018-06-13 09:45:21</td>
                                </tr>
                                <tr>
                                    <td>Ув. Покупатель, по вашему заказу № 3923 до Вас не смогли дозвониться.</td>
                                    <td>2018-06-13 09:45:11</td>
                                </tr>
                                <tr>
                                    <td>Заказ № 3923 на сумму 11480 принят. Ожидайте звонка менеджера</td>
                                    <td>2018-06-12 01:06:40</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

            <!-- END EXAMPLE TABLE PORTLET-->
            <!-- responsive -->
            <div id="responsive" class="modal fade" tabindex="-1" data-width="760">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Добавление позиции к заказу</h4>
                </div>
                <form action="index.php" method="POST" name="addproduct">
                    <div class="modal-body">
                        <div class="row">
                            <input name="func" type="hidden" value="saveProduct">
                            <input name="id" type="hidden" value="3923">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select name="type" class="form-control" required>
                                        <option value="">Укажите тип продукта</option>
                                        <option value="tyres">Шины</option>
                                        <option value="disk">Диски</option>
                                        <option value="product">Другие товары</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4>Укажите код товара</h4>
                                <p>
                                    <input name="code" class="form-control" type="text" placeholder="Укажите код товара" required>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h4>Укажите кол-во</h4>
                                <p>
                                    <input name="quantity" class="form-control" type="text" placeholder="Укажите кол-во" required>
                                </p>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default">Отмена</button>
                        <button class="btn blue" type="submit">Сохранить</button>
                    </div>
                </form>
            </div>
            <div class="modal fade" id="addOrder" tabindex="-1" role="dialog" aria-hidden="true" style="top:20px;left:unset; width: unset; margin-left:unset;">
                <div class="modal-dialog" style="margin: unset; width: unset; ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Новый заказ</h4>
                        </div>
                        <div class="modal-body">
                            <form id="modalOrders" action="" method="POST">
                                <input name="func" type="hidden" value="addOrderKD">
                                <input type="hidden" value="" name="id" id="modalIKDid">
                                <div class="row" style="margin-bottom: 25px;">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <label class="control-label"><b>Выберите тип доставки:</b></label>
                                            <select class="form-control" name="delivery" id="deliveryKD" onchange="sAddressKD()" required>
                                                <option>Выберите тип доставки</option>
                                                <option value="0">Самовывоз</option>
                                                <option value="1">Доставка</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6" id="resKD">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <label class="control-label"><b>Выберите резерв:</b></label>
                                            <select class="form-control" name="reserve" required>
                                                <option value="0">В работу</option>
                                                <option value="1">Резерв на 3 дня</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer" style="text-align: center;">
                            <button type="button" class="btn default" data-dismiss="modal">Отмена</button>
                            <button type="submit" class="btn green" form="modalOrders">Сформировать заказ</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>    					</div>
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER --><!-- BEGIN FOOTER -->
<div class="footer">
    <div class="footer-inner">
        2018 &copy; ITdevelopers.
    </div>
    <div class="footer-tools">
		<span class="go-top">
			<i class="fa fa-angle-up"></i>
		</span>
    </div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="assets/plugins/respond.min.js"></script>
<script src="assets/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>


<script src="assets/plugins/bootstrap/js/bootstrap2-typeahead.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="assets/plugins/flot/jquery.flot.js" type="text/javascript"></script>
<script src="assets/plugins/flot/jquery.flot.resize.js" type="text/javascript"></script>
<script src="assets/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script src="assets/plugins/gritter/js/jquery.gritter.js" type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<!--<script src="assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js" type="text/javascript"></script>-->
<script src="assets/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<script type="text/javascript" src="assets/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="assets/plugins/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/plugins/data-tables/DT_bootstrap.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>

<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/scripts/app.js" type="text/javascript"></script>
<script src="assets/scripts/index.js" type="text/javascript"></script>
<script src="assets/scripts/form-samples.js"></script>
<script src="assets/scripts/table-ajax.js"></script>
<script src="assets/scripts/form-components.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script src="/js/jquery.maskedinput.min.js"></script>
<script src="assets/scripts/myScript.js"></script>

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="assets/plugins/respond.min.js"></script>
<script src="assets/plugins/excanvas.min.js"></script>
<![endif]-->

<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="assets/plugins/fuelux/js/spinner.min.js"></script>
<script type="text/javascript" src="assets/plugins/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>
<script type="text/javascript" src="assets/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="assets/plugins/clockface/js/clockface.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script type="text/javascript" src="assets/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>
<script type="text/javascript" src="assets/plugins/jquery.input-ip-address-control-1.0.min.js"></script>
<script type="text/javascript" src="assets/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="assets/plugins/jquery-multi-select/js/jquery.quicksearch.js"></script>
<script src="assets/plugins/jquery.pwstrength.bootstrap/src/pwstrength.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-switch/static/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-tags-input/jquery.tagsinput.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-markdown/lib/markdown.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script>
<script type="text/javascript" src="assets/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.min.js"></script>
<script type="text/javascript" src="assets/plugins/jquery.mockjax.js"></script>
<script type="text/javascript" src="assets/plugins/moment.min.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap-editable/inputs-ext/address/address.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap-editable/inputs-ext/wysihtml5/wysihtml5.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/scripts/app.js"></script>
<script src="assets/scripts/form-components.js"></script>
<script src="assets/scripts/form-editable.js"></script>

<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function() {
        // initiate layout and plugins
        App.init();
        FormComponents.init();
        FormEditable.init();
    });
</script>

<!-- BEGIN GOOGLE RECAPTCHA -->
<script type="text/javascript">
    var RecaptchaOptions = {
        theme : 'custom',
        custom_theme_widget: 'recaptcha_widget'
    };
</script>
<script type="text/javascript" src="https://www.google.com/recaptcha/api/challenge?k=6LcrK9cSAAAAALEcjG9gTRPbeA0yAVsKd8sBpFpR"></script>
<!-- END GOOGLE RECAPTCHA -->

<!-- END JAVASCRIPTS -->
<script src="/js/custom.js"></script>
<script type="text/javascript" src="/js/TextChange.js"></script>
<script>
    $(document).ready(function(){

        $('#input-search').bind('textchange', function () {
            searchProd();
        });
        $(document).on('click','#result_search li', function(){
            $('#block-search-result').hide();
            var id_prod = $(this).data("id");
            $.ajax({
                type: "POST",
                url: '/adminius/inc/addProductSearch.php', // именно в нем будут выполнять какие то действия при нажатии на кнопку
                dataType: 'html',
                data: 'id_prod='+id_prod, // передаваемые параметры
                success: function(data){
                    $('.res-prod').html(data);
                    $('.block-res-prod').show();
                }
            });
        });
    });
    function delPosBasket(id){
        $.ajax({
            type: "POST",
            url: "/adminius/inc/delPosBasket.php",
            dataType: "html",
            data: 'id='+id,
            success: function (data) {
                $('.res-prod').html(data);
                $('.block-res-prod').show();
            }
        });
    }
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>