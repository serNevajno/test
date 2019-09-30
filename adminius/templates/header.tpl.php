<?include($_SERVER['DOCUMENT_ROOT'].'/adminius/templates/head.tpl.php');?>
<!-- BEGIN BODY -->
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
      <?if(sLastUserAdmin(selectIdUserAdminSession()) > 0){?>
        <li>
          <div id="workRealTime" style="color: #fff;margin: 11px;"></div>
        </li>
      <?}?>
			<?if ($access["orders"] == 1){?>
				<!-- BEGIN INBOX DROPDOWN -->
				<li class="dropdown" id="header_inbox_bar">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="fa fa-tasks"></i>
					<?$countOreders = selectCountOreders();?>
						<?if($countOreders>0){?>
						<span class="badge">
							<?=$countOreders?>
						</span>
					<?}?>
					</a>
					<ul class="dropdown-menu extended notification">

						<li>
							<p>
								У Вас <?=$countOreders?> новых заказов.
							</p>
						</li>
						<li class="external">
							<a href="/adminius/index.php?code=orders">Показать все заказы <i class="m-icon-swapright"></i></a>
						</li>
					</ul>
				</li>
				<!-- END INBOX DROPDOWN -->
			<?}?>
			<?if ($access["message_admin"] == 1){?>
				<!-- BEGIN INBOX DROPDOWN -->
				<li class="dropdown" id="header_inbox_bar">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="fa fa-envelope"></i>
					<?$countMess = selectMessages();?>
						<?if($countMess>0){?>
						<span class="badge">
							<?=$countMess?>
						</span>
					<?}?>
					</a>
					<ul class="dropdown-menu extended notification">
						<li>
							<p>
								У Вас <?=$countMess?> заявки на обратный звонок.
							</p>
						</li>
						<li class="external">
							<a href="/adminius/index.php?code=message_admin">Показать все заявки <i class="m-icon-swapright"></i></a>
						</li>
					</ul>
				</li>
				<!-- END INBOX DROPDOWN -->
			<?}?>
			<?include($_SERVER['DOCUMENT_ROOT'].'/adminius/templates/userLogin.tpl.php');?>
		</ul>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->