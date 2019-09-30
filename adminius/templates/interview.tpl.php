<?if($access["interview"] == 1){?>
	<?if (isset($_GET["action"])):?>
		<?if($_GET["action"] == "add"):?>
			<script type="text/javascript">
				function checkForm() {
					var name = document.getElementById("name");
					if (!name.value) {
						alert('Введите название');
						return false;
					}
				}
				window.onload = function () {
					var form = document.getElementById("myForm");
					form.submit = checkForm;
				}
			</script>
		<!-- BEGIN PAGE CONTENT-->
					<div class="row">
						<div class="col-md-12">
							<h2>Добавление опроса</h2>
							<br>
							<div class="tabbable tabbable-custom boxless">
							<form role="form" action="index.php" enctype="multipart/form-data" method="POST" name="form" id="myForm">
								<input name="func" type="hidden" value="interview">									
									<div class="tab-content">
											<div class="form-body">
												<div class="form-group">
													Активность:&nbsp;  <input type="checkbox" value="1" id="active" name="active">
												</div>
												<div class="form-group">
													<label>Введите название <font color="red">*</font></label>
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-reorder"></i>
														</span>
														<input type="text" class="form-control" id="name" name="name" placeholder="Название">
													</div>
												</div>
											</div>
									</div>
								<div class="form-actions">
									<button type="submit" class="btn blue" name="submit">Сохранить</button>
									<button type="button" class="btn default" onClick='location.href="/adminius/index.php?code=interview"'>Отмена</button>
								</div>
							</form>
							</div>
						</div>
					</div>
			<?elseif($_GET["action"] == "edit"):?>
				<script type="text/javascript">
				function checkForm() {
					var name = document.getElementById("name");
					
					if (!name.value) {
						alert('Введите название');
						return false;
					}
				}
				window.onload = function () {
					var form = document.getElementById("myForm");
					form.submit = checkForm;
				}
			</script>
		<?$item = selectInterviewById($_GET["id"]);?>
		<!-- BEGIN PAGE CONTENT-->
					<div class="row">
						<div class="col-md-12">
							<h2>Редактирование опроса</h2>
							<br>
							<div class="tabbable tabbable-custom boxless">
							<form role="form" action="index.php" enctype="multipart/form-data" method="POST" name="form" id="myForm">
									<input name="func" type="hidden" value="interview">
									<input name="id" type="hidden" value="<?=$_GET["id"]?>">
									
									<div class="tab-content">
											<div class="form-body">
												<div class="form-group">
													Активность:&nbsp;  <input type="checkbox" value="1" id="active" name="active" <?if($item["active"] == "1") echo "checked";?>>
												</div>
												<div class="form-group">
													<label>Введите название <font color="red">*</font></label>
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-reorder"></i>
														</span>
														<input type="text" class="form-control" id="name" name="name" placeholder="Название"  value="<?=$item["name"]?>">
													</div>
												</div>
												
												<h2>Варианты ответов</h2>
												<?$n =0;
												foreach (selectInterviewQuestion($_GET["id"]) as $item_q){?>
														<div class="form-group">
															<div class="input-group">
																<div class="col-md-8">
																	<label>Введите вариант <font color="red">*</font></label>
																	<div class="input-group">
																		<span class="input-group-addon">
																			<i class="fa fa-reorder"></i>
																		</span>
																		<input type="text" class="form-control" name="questions[<?=$item_q["id"]?>]" placeholder="Вариант"  value="<?=$item_q["name"]?>">
																	</div>
																</div>
																<div class="col-md-4">
																	<label>Выберите цвет<font color="red">*</font></label>
																	<div class="input-group color colorpicker-default" data-color="<?=$item_q["color"]?>" data-color-format="rgba">
																		<input type="text" class="form-control" value="<?=$item_q["color"]?>" name="color[<?=$item_q["id"]?>]" readonly>
																		<span class="input-group-btn">
																			<button class="btn default" type="button"><i style=""></i>&nbsp;</button>
																		</span>
																	</div>
																	<!-- /input-group -->
																</div>
															</div>
														</div>
												<?$n++;}?>
														<?for($x=$n; $x<10; $x++){?>
															<div class="form-group">
																<div class="input-group">
																	<div class="col-md-8">
																		<label>Введите вариант <font color="red">*</font></label>
																		<div class="input-group">
																			<span class="input-group-addon">
																				<i class="fa fa-reorder"></i>
																			</span>
																			<input type="text" class="form-control" name="questions[]" placeholder="Вариант">
																		</div>
																	</div>
																	<div class="col-md-4">
																		<label>Выберите цвет<font color="red">*</font></label>
																		<div class="input-group color colorpicker-default" data-color="" data-color-format="rgba">
																			<input type="text" class="form-control" name="color[]" value="" readonly>
																			<span class="input-group-btn">
																				<button class="btn default" type="button"><i style=""></i>&nbsp;</button>
																			</span>
																		</div>
																		<!-- /input-group -->
																	</div>
																</div>
															</div>
														<?}?>

											</div>	
									</div>
									<div class="form-actions">
										<button type="submit" class="btn blue" name="submit">Добавить</button>
										<button type="button" class="btn default" onClick='location.href="/adminius/index.php?code=interview"'>Отмена</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<script>
						function clone(){
							$("#clone_input").clone().appendTo("#clone_result");
						}
					</script>
			<?endif;?>
	<?else:?>
		<?
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
							<div class="portlet-body">
								<div class="table-toolbar">
									<div class="btn-group">
										<button id="sample_editable_1_new" class="btn green" onClick='location.href="/adminius/index.php?code=interview&action=add"'>
										Добавить <i class="fa fa-plus"></i>
										</button>
									</div>
								</div>
								<div class="table-scrollable">
								<table class="table table-striped table-bordered table-hover" id="sample_1">
									<thead>
										<tr>
											<th>№</th>
											<th>Имя</th>
											<th>Приоритет</th>
											<th>Действия</th>
										</tr>
									</thead>
									<tbody role="alert" aria-live="polite" aria-relevant="all">
										<?$select_interview = selectInterview($page);
										$n=1;
										foreach ($select_interview as $item){
											if ($item["active"] == 1) {
												$class ="success";
												$act = "Активный";
											}else{
												$class = "danger";
												$act = "Не активный";
											}?>
											<tr class="odd">
												<td class=" sorting_1"><?=$n?></td>
												<td class=""><a href="/adminius/index.php?code=interview&action=edit&id=<?=$item["id"]?>"><?=$item["name"]?></a></td>
												<td class=""><span class="label label-sm label-<?=$class?>"><?=$act?><?$item["active"]?></span></td>
												<td class="">
													<a class="btn btn-xs blue btn-editable" data-id="1" href="/adminius/index.php?code=interview&action=edit&id=<?=$item["id"]?>"><i class="fa fa-pencil"></i> Edit</a> 
													<?if($access["del"] == 1){?>
														<form action="index.php" method="POST" name="delform<?=$item['id']?>" style="display:none;">
															<input name="func" type="hidden" value="interview">
															<input name="id" type="hidden" value="<?=$item['id']?>">
														</form>
														<a class="btn btn-xs red btn-removable" data-id="1" href="javascript:if(confirm('Вы уверены?')){delform<?=$item['id']?>.submit();}"><i class="fa fa-times"></i> Delete</a>
													<?}?>
												</td>
											</tr>
											<?$n++;?>
										<?}?>
									</tbody>
								</table>
								</div>
								<?include($_SERVER['DOCUMENT_ROOT'].'/adminius/templates/pagenav.tpl.php');?>
							</div>
						</div>
						<!-- END EXAMPLE TABLE PORTLET-->
	<?endif;?>
<?}else{?>
	<h3>Отказано в доступе, недостаточно прав.<h3>
<?}?>