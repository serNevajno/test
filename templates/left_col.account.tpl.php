<!-- Dealer Infomation -->
<div class="col-sm-12 col-md-3 col-lg-3">
	<div class="category  m-b-lg-25">
		<ul class="collapse in" id="collapseExample">
			<li <?if($_GET['code'] == 'profile'){?>class="active"<?}?>> <a href="/profile.html"> Профиль <i class="fa fa-chevron-right pull-right"></i> </a> </li>
			<li <?if($_GET['code'] == 'orders'){?>class="active"<?}?>> <a href="/orders.html"> Мои заказы <i class="fa fa-chevron-right pull-right"></i> </a> </li>
		</ul>
	</div>
</div>