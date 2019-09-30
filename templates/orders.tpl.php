<?if(isset($_GET["id"])){
$sOrById = selectOrderById($_GET["id"]);
if($iUser['id'] == $sOrById['id_user']){?>

<div id="wrap-body" class="p-t-lg-30">
	<div class="container">
		<div class="wrap-body-inner">
			<!-- Breadcrumb-->
			<?include($_SERVER['DOCUMENT_ROOT']).'/templates/breadcrumbs.tpl.php';?>
			<!-- Car detail -->
			<section class="m-t-lg-30 m-t-xs-0">
				<!-- Car description tabs -->
				<div class="row m-t-lg-30 m-b-lg-50">
					<?include($_SERVER['DOCUMENT_ROOT']).'/templates/left_col.account.tpl.php';?>
					<div class="col-md-9">
						<!-- Technical Specifications -->
						<div class="m-b-lg-0">
							<div class="heading-1"><h3><?=$meta_item["name"]?></h3></div>
							<div class="bg-gray-fa bg1-gray-2 p-lg-30 p-xs-15">
								<input type="hidden" value="<?=$sUser['id']?>" id="id_user">
								<div class="col-md-4">
									<h4>Номер заказа: <?=$_GET["id"]?> </h4>
								</div>
								<div class="col-md-4">
									<h6>дата заказа:<br> <?=$sOrById['date']?></h6>
								</div>
								<div class="col-md-4">
									<h6>статус заказа:<br> <span class="label label-sm label-<?=$sOrById['code']?> label-mini"><?=$sOrById['status_name']?></span></h6>
								</div>
								<table class="table table-striped table-bordered table-advance table-hover">
									<thead>
										<tr style="background:#d0e9c6";>
											<th>Название </th>
											<th class="hidden-xs"> Код </th>
											<th> Кол-во </th>
											<th> Цена </th>
										</tr>
									</thead>
									<tbody>
										<?foreach(selectOrderProductById($_GET["id"]) as $sOrders){?>
										<tr style="background:#fff;">
											<td> <a href="<?=$sOrders['url']?>" target="_blank"><?=$sOrders['name']?></a> </td>
											<td class="hidden-xs"> <?=$sOrders['code']?> </td>
											<td> <?=$sOrders['quantity']?> </td>
											<td> <?=$sOrders['price']?>.00 руб<?if($sOrders['sale'] >0){?><span class="color-red"> (-<?=$sOrders['sale']?> %)</span><?}?></td>
										</tr>
										<?}?>
									</tbody>
								</table>
								<div style="float:right;"><span style="font-size:20px; font-weight:700;">Сумма заказа: <?=selectSummOrderById($_GET['id'])?>.00 руб </span></div>
							</div>
						</div>
					</div>
					
				</div>	
			</section>
		</div>
	</div>
</div>
<?}else{
echo '<script>window.location.href="/orders.html";</script>';
}?>
<?}else{
	if (isset($_GET["page"])) {
		$page = clearData($_GET["page"], "i");
		}else{
		$page = 1;
	}
	$sOrders = selectOrders($page);
?>
<div id="wrap-body" class="p-t-lg-30">
	<div class="container">
		<div class="wrap-body-inner">
			<!-- Breadcrumb-->
			<?include($_SERVER['DOCUMENT_ROOT']).'/templates/breadcrumbs.tpl.php';?>
			<!-- Car detail -->
			<section class="m-t-lg-30 m-t-xs-0">
				<!-- Car description tabs -->
				<div class="row m-t-lg-30 m-b-lg-50">
					<?include($_SERVER['DOCUMENT_ROOT']).'/templates/left_col.account.tpl.php';?>
					<div class="col-md-9">
						<!-- Technical Specifications -->
						<div class="m-b-lg-0">
							<div class="heading-1"><h3><?=$meta_item["name"]?></h3></div>
							<div class="bg-gray-fa bg1-gray-2 p-lg-30 p-xs-15" id="sOrders">
								<?if($sOrders){?>
									<table class="table table-striped table-bordered table-advance table-hover">
										<thead>
											<tr style="background:#d0e9c6";>
												<th> № Заказа </th>
												<th class="hidden-xs"> <i class="fa fa-calendar"></i> Дата заказа </th>
												<th> <i class="fa fa-money"></i> Сумма заказа </th>
												<th> <i class="fa  fa-check"></i> Статус </th>
												<th> </th>
											</tr>
										</thead>
										<tbody>
											<?foreach($sOrders as $iOrders){?>
											<tr style="background:#fff;">
												<td> <a href="/<?=$_GET['code']?>-<?=$iOrders['id']?>.html"><?=$iOrders['id']?></a> </td>
												<td class="hidden-xs"> <?=$iOrders['date']?> </td>
												<td> <?=selectSummOrderById($iOrders['id'])?>.00 руб </td>
												<td> <span class="label label-sm label-<?=$iOrders['code']?> label-mini"><?=$iOrders['name']?></span> </td>
												<td> <a href="/<?=$_GET['code']?>-<?=$iOrders['id']?>.html" style="border-left: 3px solid #cb1010;background: #f3eded;padding: 5px;font-size: 12px;">Просмотреть</a> </td>
											</tr>
											<?}?>
										</tbody>
									</table>
									<?include($_SERVER['DOCUMENT_ROOT'].'/templates/pagination.tpl.php');?>
								<?}else{?>
										<div class="col-md-12" style="margin-bottom:50px;">
											<div class="bs-callout bs-callout-warning">
												<h4><i class="fa fa-info"></i>У Вас нет заказов.</h4>
											</div>
										</div>
								<?}?>
							</div>
						</div>
					</div>
					
				</div>	
			</section>
		</div>
	</div>
</div>
<?}?>