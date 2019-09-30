<?if($access["message_admin"] == 1){?>
		<?
		$num = 10;

		if (isset($_GET["page"])) {
			$page = clearData($_GET["page"], "i");
		}else{
			$page = 1;
		}
		?>
			<!-- BEGIN EXAMPLE TABLE PORTLET-->
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="tools">
					</div>
				</div>
				<div class="portlet-body form">
					<form role="form" method="GET" action="" id="formDatas">
						<input name="code" type="hidden" value="message_admin">
						<div class="form-body">
							<div class="form-group">
								<div id="sample_1_length" class="dataTables_length">
									<label >Выберите дату:</label>
										<div class="col-md-4" style="width: auto;">
											<div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="yyyy-mm-dd">
												<input type="text" class="form-control" name="from" value="<?=$_GET["from"]?>">
												<span class="input-group-addon">
													по
												</span>
												<input type="text" class="form-control" name="to" value="<?=$_GET["to"]?>">
											</div>
											<!-- /input-group -->
										</div>
								</div>
								<button type="submit" class="btn blue">Поиск</button>
							</div>
						</div>
					</form>
				</div>
				<div class="portlet-body">
					<div class="table-toolbar">
						<div class="btn-group">
							
						</div>
					</div>
					<form action="" enctype="multipart/form-data" method="POST" name="adminMessage" id="adminMessage">
					<input name="func" type="hidden" value="order_services">
					<div class="table-scrollable">
						<table class="table table-striped table-bordered table-hover" id="sample_1">
							<thead>
								<tr>
									<th>№</th>
									<th>От кого</th>
									<th>Услуга</th>
									<th>Сообщение</th>
									<th>Дата</th>
									<?/*<th>Действия</th>*/?>
									<th>Удалить</th>
								</tr>
							</thead>
							<tbody role="alert" aria-live="polite" aria-relevant="all">
	
								<?
								$n=1;
								foreach (selectOrderServices($page, $num, $_GET["to"], $_GET["from"]) as $item){?>
									<tr class="odd">
										<td>
											<?=$n?> 
										</td>
										<td class="">
											Имя: <?=$item['name']?><br>
											e-mail: <?=$item['email']?><br>
											телефон: <?=$item['phone']?>

										</td>
										<td class=""><a href="/<?=$item["code"]?>/"><?=$item["name_section"]?></a></td>
										<td style="white-space: normal;"><?=$item["message"]?></td>
										<td class=""><?=$item["date"]?></td>
										
										<td> 
											<input type="checkbox" name="del_message[]" value="<?=$item["id"]?>" title="Удалить">
										</td>
										
									</tr>
								<?$n++;}?>
							</tbody>
						</table>
					</div>
					</form>
					<div class="form-actions">
						<button form="adminMessage" type="submit" class="btn green" name="submit">Удалить отмеченное</button>
						<?/*<button type="button" class="btn red" onClick='location.href="/adminius/"'>Выйти</button>*/?>
					</div>
					<?include($_SERVER['DOCUMENT_ROOT'].'/adminius/templates/pagenav.tpl.php');?>
				</div>
			</div>
			
			<!-- END EXAMPLE TABLE PORTLET-->
<?}else{?>
	<h3>Отказано в доступе, недостаточно прав.<h3>
<?}?>