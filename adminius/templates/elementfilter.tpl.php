<?if($access["product"] == 1){?>
	<?if (isset($_GET["action"])):?>
		<?if($_GET["action"] == "add"):?>
				<script type="text/javascript">
					function checkForm() {
						var name = document.getElementById("name");

						if (!name.value) {
							alert('Введите значение елемента');
							return false;
						}

					}
					window.onload = function () {
						var form = document.getElementById("myForm");
						form.onsubmit = checkForm
					}
				</script>
			<!-- BEGIN PAGE CONTENT-->
						<div class="row">
							<div class="col-md-12">
								<div class="tabbable tabbable-custom boxless">
								<form role="form" action="index.php" enctype="multipart/form-data" method="POST" name="form" id="myForm">
									<input name="func" type="hidden" value="elementfilter">
									<input name="idcat" type="hidden" value="<?=$_GET["idcat"]?>">
									<input name="filter" type="hidden" value="<?=$_GET["filter"]?>">
									<div class="tab-content">
										<div class="tab-pane active" id="tab_0">
											<!-- BEGIN SAMPLE FORM PORTLET-->
															<div class="form-body">
																<div class="form-group">
																	<label>Введите значение елемента</label>
																	<div class="input-group">
																		<span class="input-group-addon">
																			<i class="fa fa-reorder"></i>
																		</span>
																	<input type="text" class="form-control input-medium" id="name" name="name">
																	</div>
																</div>
															</div>
											<!-- END SAMPLE FORM PORTLET-->
										</div>
										
									</div>
									<div class="form-actions">
										<button type="submit" class="btn blue" name="submit">Добавить</button>
										<button type="button" class="btn default" onClick='location.href="/adminius/index.php?code=elementfilter&filter=<?=$_GET["filter"]?>&idcat=<?=$_GET["idcat"]?>"'>Отмена</button>
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
								alert('Введите значение елемента');
								return false;
							}

						}
						window.onload = function () {
							var form = document.getElementById("myForm");
							form.onsubmit = checkForm
						}
					</script>
				<?$select_elment = selectElementFilterById($_GET["id"]);?>
				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">
						<div class="tabbable tabbable-custom boxless">
						<form role="form" action="index.php" enctype="multipart/form-data" method="POST" name="form" id="myForm">
							<input name="func" type="hidden" value="elementfilter">
							<input name="idcat" type="hidden" value="<?=$_GET["idcat"]?>">
							<input name="id" type="hidden" value="<?=$_GET["id"]?>">
							<input name="filter" type="hidden" value="<?=$select_elment["id_filter"]?>">
							<div class="tab-content">
								<div class="tab-pane active" id="tab_0">
									<!-- BEGIN SAMPLE FORM PORTLET-->
													<div class="form-body">
														<div class="form-group">
															<label>Введите значение елемента</label>
															<div class="input-group">
																<span class="input-group-addon">
																	<i class="fa fa-reorder"></i>
																</span>
															<input type="text" class="form-control input-medium" id="name" name="name" value="<?=$select_elment["value"]?>">
															</div>
														</div>
													</div>
									<!-- END SAMPLE FORM PORTLET-->
								</div>
								
							</div>
							<div class="form-actions">
								<button type="submit" class="btn blue" name="submit">Добавить</button>
								<button type="button" class="btn default" onClick='location.href="/adminius/index.php?code=elementfilter&filter=<?=$select_elment["id_filter"]?>"'>Отмена</button>
							</div>
						</form>
						</div>
					</div>
				</div>
		<?endif;?>
	<?else:?>
	<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">
						<h2>Елементы фильтра</h2>
						<br>
						<div class="tabbable tabbable-custom boxless">
										<?$select_element = selectElementByFilter($_GET["filter"]);?>
										<?if ($select_element):?>
											<table class="table table-striped table-bordered table-hover" id="sample_1" style="width:auto;">
												<thead>
													<tr>
														<th>№</th>
														<th>Имя</th>
														<th>Действия</th>
													</tr>
												</thead>
												<tbody role="alert" aria-live="polite" aria-relevant="all">
													<?$n=1;
													foreach ($select_element as $item):?>
														<tr class="odd">
															<td class=" sorting_1"><?=$n?></td>
															<td class=""><?=$item["value"]?></td>
															<td class="">
																<a class="btn btn-xs blue btn-editable" data-id="1" href="/adminius/index.php?code=elementfilter&action=edit&id=<?=$item["id"]?>&idcat=<?=$_GET["idcat"]?>"><i class="fa fa-pencil"></i> Edit</a> 
																	<?if($access["del"] == 1){?>
																		<form action="index.php" method="POST" name="delform<?=$item['id']?>" style="display:none;">
																			<input name="func" type="hidden" value="elementfilter">
																			<input name="filter" type="hidden" value="<?=$_GET["filter"]?>">
																			<input name="id" type="hidden" value="<?=$item['id']?>">
																			<input name="idcat" type="hidden" value="<?=$_GET['idcat']?>">
																		</form>
																		<a class="btn btn-xs red btn-removable" data-id="1" href="javascript:if(confirm('Вы уверены?')){delform<?=$item['id']?>.submit();}"><i class="fa fa-times"></i> Delete</a>
																	<?}?>
															</td>
														</tr>
														<?$n++;?>
													<?endforeach;?>
												</tbody>
											</table>
										<?else:?>
											<div>В данном фильтре нету елементов</div>
										<?endif;?>
										<button type="button" class="btn blue"onClick='location.href="/adminius/index.php?code=elementfilter&action=add&filter=<?=$_GET["filter"]?>&idcat=<?=$_GET["idcat"]?>"'>Добавить елемент</button>
								
							<div class="form-actions">
								<button type="button" class="btn blue" onClick='location.href="/adminius/index.php?code=categories&action=edit&id=<?=selectCategoiesByFilter($_GET["filter"]);?>#tab_2"'>Назад</button>
							</div>
						
						</div>
					</div>
				</div>
	<?endif;?>
<?}else{?>
	<h3>Отказано в доступе, недостаточно прав.<h3>
<?}?>		