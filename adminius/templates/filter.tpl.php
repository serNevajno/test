<?if($access["product"] == 1){?>
	<?if (isset($_GET["action"])):?>
		<?if($_GET["action"] == "add"):?>
		<script type="text/javascript">
			function checkForm() {
				var name = document.getElementById("name");

				if (!name.value) {
					alert('Введите имя');
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
							<input name="func" type="hidden" value="filter">
							<input name="cat" type="hidden" value="<?=$_GET["cat"]?>">
							<div class="tab-content">
								<div class="tab-pane active" id="tab_0">
									<!-- BEGIN SAMPLE FORM PORTLET-->
													<div class="form-body">
														<div class="form-group">
															<label>Введите название фильтра</label>
															<div class="input-group">
																<span class="input-group-addon">
																	<i class="fa fa-user"></i>
																</span>
															<input type="text" class="form-control input-medium" id="name" name="name" placeholder="Имя">
															</div>
														</div>
														<div class="form-group">
															<label>Тип фильтра</label>
															<select class="form-control input-medium" name="type">	
																<option value="1">Список</option>
																<option value="2">Значение</option>
															</select>
														</div>
														<div class="form-group">
															<label>Введите приоритет фильтра</label>
															<div class="input-group">
																<span class="input-group-addon">
																	<i class="fa fa-user"></i>
																</span>
															<input type="text" class="form-control input-medium" name="priority" placeholder="Приоритет">
															</div>
														</div>
													</div>
									<!-- END SAMPLE FORM PORTLET-->
								</div>
								
							</div>
							<div class="form-actions">
								<button type="submit" class="btn blue" name="submit">Добавить</button>
								<button type="button" class="btn default" onClick='location.href="/adminius/index.php?code=categories&action=edit&id=<?=$_GET["cat"]?>"'>Отмена</button>
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
								alert('Введите имя');
								return false;
							}

						}
						window.onload = function () {
							var form = document.getElementById("myForm");
							form.onsubmit = checkForm
						}
					</script>
					<?$select_filter = selectFilterById($_GET["id"]);?>
				<!-- BEGIN PAGE CONTENT-->
							<div class="row">
								<div class="col-md-12">
									<div class="tabbable tabbable-custom boxless">
									<form role="form" action="index.php" enctype="multipart/form-data" method="POST" name="form" id="myForm">
										<input name="func" type="hidden" value="filter">
										<input name="id" type="hidden" value="<?=$_GET["id"]?>">
										<input name="cat" type="hidden" value="<?=$select_filter["categories"]?>">
										<div class="tab-content">
											<div class="tab-pane active" id="tab_0">
												<!-- BEGIN SAMPLE FORM PORTLET-->
																<div class="form-body">
																	<div class="form-group">
																		<label>Введите название фильтра</label>
																		<div class="input-group">
																			<span class="input-group-addon">
																				<i class="fa fa-user"></i>
																			</span>
																		<input type="text" class="form-control input-medium" id="name" name="name" value="<?=$select_filter["name"]?>">
																		</div>
																	</div>
																	<div class="form-group">
																		<label>Тип фильтра</label>
																		<select class="form-control input-medium" name="type">	
																			<option value="1" <?if ($select_filter["type"] == 1){echo "selected";}?>>Список</option>
																			<option value="2" <?if ($select_filter["type"] == 2){echo "selected";}?>>Значение</option>
																		</select>
																	</div>
																	<div class="form-group">
																		<label>Введите приоритет фильтра</label>
																		<div class="input-group">
																			<span class="input-group-addon">
																				<i class="fa fa-user"></i>
																			</span>
																		<input type="text" class="form-control input-medium" name="priority" placeholder="Приоритет" value="<?=$select_filter["priority"]?>">
																		</div>
																	</div>
																</div>
												<!-- END SAMPLE FORM PORTLET-->
											</div>
											
										</div>
										<div class="form-actions">
											<button type="submit" class="btn blue" name="submit">Редактировать</button>
											<button type="button" class="btn default" onClick='location.href="/adminius/index.php?code=categories&action=edit&id=<?=$select_filter["categories"]?>#tab_2"'>Отмена</button>
										</div>
									</form>
									</div>
								</div>
							</div>
		<?endif;?>
	<?endif;?>
<?}else{?>
	<h3>Отказано в доступе, недостаточно прав.<h3>
<?}?>	