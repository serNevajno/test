<?if($access["message_admin"] == 1){?>
		<?
		upViewedMessage();
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
						<input name="code" type="hidden" value="message">
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
					<div class="table-scrollable">
						<table class="table table-striped table-bordered table-hover" id="sample_1">
							<thead>
								<tr>
									<th>№</th>
									<th>От кого</th>
									<th>Сообщение</th>
									<th>Дата</th>
									<th>Действия</th>
								</tr>
							</thead>
							<tbody role="alert" aria-live="polite" aria-relevant="all">
								<?
								$n=1;
								foreach (selectMessageAdminUser($page, $num, $_GET["to"], $_GET["from"]) as $item){?>
									<tr class="odd">
										<td>
											<?=$n?> 
										</td>
										<td class="">
											<a href="/adminius/index.php?code=users&action=detail&id=<?=$item["id"]?>">Пользователь №<?=$item["id"]?></a>
										</td>
										<td style="white-space: normal;"><?=$item["message"]?></td>
										<td class=""><?=$item["date"]?></td>
										<td class="">
											<a class="btn btn-xs <?if(selectReadMessageByUser($item["id"])>0){echo "yellow";}else{echo "blue";}?> btn-editable" data-id="1" href="/adminius/index.php?code=message_admin&action=detail&<?if($item["id"]>0){echo "id=".$item["id"];}else{echo "id_message=".$item["id"];}?>"><i class="fa fa-pencil"></i>Cообщения</a> 
										</td>
									</tr>
								<?$n++;}?>
							</tbody>
						</table>
					</div>
					<?include($_SERVER['DOCUMENT_ROOT'].'/adminius/templates/pagenav.tpl.php');?>
				</div>
			</div>
			<!-- END EXAMPLE TABLE PORTLET-->
<?}else{?>
	<h3>Отказано в доступе, недостаточно прав.<h3>
<?}?>