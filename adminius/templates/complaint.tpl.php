<?if($access["complaint"] == 1){?>
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
								<form role="form" method="GET" action="/adminius/index.php">
									<input name="code" type="hidden" value="complaint">
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
										<th>На кого</th>
										<th>Дата</th>
										<th style="width: 260px;">Действия</th>
									</tr>
								</thead>
								<tbody role="alert" aria-live="polite" aria-relevant="all">
									<?
									$n=1;
									foreach (selectComplaint($page, $num, $_GET["to"], $_GET["from"]) as $item):
										if($item["type"] == "1") {
											$code = "users";
											$code_name = "Пользователь";
										}elseif($item["type"] == "2"){
											$code = "tender";
											$code_name = "Тендер";
										}
									?>
										<tr class="odd">
											<td class=" sorting_1"><?=$n?></td>
											<td class=""><a href="/adminius/index.php?code=users&action=detail&id=<?=$item["id_user"]?>">Пользователь №<?=$item["id_user"]?></a></td>
											<td style="max-width: 500px; white-space: pre-line;"><?=$item["message"]?></td>
											<td class=""><a href="/adminius/index.php?code=<?=$code?>&action=detail&id=<?=$item["id_element"]?>"><?=$code_name;?> №<?=$item["id_element"]?></td>
											<td class=""><?=$item["date"]?></td>
											<td class="">
													<form action="index.php" method="POST" name="upform<?=$item['id']?>" style="float:left;">
														<input name="func" type="hidden" value="complaint">
														<input name="id" type="hidden" value="<?=$item['id']?>">
														<label>
															<select size="1" name="status" aria-controls="sample_1"  class="form-control input" >
																<option value="0" <?if ($item['status'] == "0") echo "selected='selected'";?>>На рассмотрении</option>
																<option value="1" <?if ($item['status'] == "1") echo "selected='selected'";?>>Рассмотрено</option>
																</select>
															</label>
													</form>
													<a class="btn btn-xs blue btn-removable" data-id="1"  style="margin-left:5px; padding:8px;" href="javascript:upform<?=$item['id']?>.submit();" title="Обновить"><i class="fa fa-refresh"></i></a>
													<?if($access["del"] == 1){?>
														<form action="index.php" method="POST" name="delform<?=$item['id']?>" style="float:left;">
															<input name="func" type="hidden" value="complaint">
															<input name="id" type="hidden" value="<?=$item['id']?>">
														</form>
														<a class="btn btn-xs red btn-removable" data-id="1"  style="margin-left:5px; padding:8px;" href="javascript:if(confirm('Вы уверены?')){delform<?=$item['id']?>.submit();}" title="Удалить"><i class="fa fa-times"></i></a>
													<?}?>
											</td>
										</tr>
										<?$n++;?>
									<?endforeach;?>
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