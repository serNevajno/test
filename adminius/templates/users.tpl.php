<?if($access["users"] == 1){?>
	<?if(isset($_GET["action"])):?>
		<?if($_GET["action"] == "edit"):?>
			<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">
						<div class="tabbable tabbable-custom boxless">
							<h2>Редактирование пользователя</h2>
							<br>
							<form role="form" action="index.php" enctype="multipart/form-data" method="POST" name="form" id="myForm">
								<input name="func" type="hidden" value="users">
								<input name="id" type="hidden" value="<?=$_GET["id"]?>">
								<?$item = selectUserById($_GET["id"]);?>
								<div class="tab-content">
									<div class="tab-pane active" id="tab_0">
										<!-- BEGIN SAMPLE FORM PORTLET-->
														<div class="form-body">
															<div class="form-group">
															<select name="active"  class="form-control input-small">
																<option value="1" <?if ($item["active"] == 1) echo "selected='selected'";?>>Активный</option>
																<option value="2" <?if ($item["active"] == 2) echo "selected='selected'";?>>Заблокирован</option>
															</select>
															</div>
															<div class="form-group">
																<label>Заметка</label>
																<textarea class="form-control" rows="5" name="note"><?=$item["note"]?></textarea>
															</div>
														</div>
										<!-- END SAMPLE FORM PORTLET-->
									</div>
									
								</div>
								<div class="form-actions">
									<button type="submit" class="btn blue" name="submit">Сохранить</button>
									<button type="button" class="btn default" onClick='location.href="<?=$_SERVER['HTTP_REFERER']?>"'>Отмена</button>
								</div>
							</form>
						</div>
					</div>
				</div>
		<?elseif($_GET["action"] == "detail"):?>
						<?$item = selectUserById($_GET["id"]);

						if (isset($_GET["limit"])) {
							$num = clearData($_GET["limit"], "i");
						}else{
							$num = 10;
						}
						if (isset($_GET["page"])) {
							$page = clearData($_GET["page"], "i");
						}else{
							$page = 1;
						}
						if (isset($_GET["search"])) {
								$search = $_GET["search"];
						}else{
								$search = "";
						}
					?>
					<style>
					.form-control-static {
						padding-top:0px;
					}
					</style>
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="tools">
								</div>
							</div>
							<div class="portlet-body">
													<h3 class="form-section">Данные пользователя</h3>
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3"><b>Имя фамилия:</b></label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		<?=$item["name"]?>
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-4"><b>Пол:</b></label>
																<div class="col-md-8">
																	<p class="form-control-static">
																		<? if ($item["sex"] == 1) {echo "Мужчина";}else{echo "Женщина";}?>
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
																		<?=$item["phone"]?>
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-4"><b>День рождения:</b></label>
																<div class="col-md-8">
																	<p class="form-control-static">
																		<?=$item["date_birth"]?>
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
																		<?=$item["email"]?>
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-4"><b>Дата регистрации:</b></label>
																<div class="col-md-8">
																	<p class="form-control-static">
																		<?=$item["date"]?>
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
													</div>
														<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3"><b>Страна, город:</b></label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		<?=$item["country"]?>, <?=$item["city"]?>
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-4"><b>Адрес:</b></label>
																<div class="col-md-8">
																	<p class="form-control-static">
																		<?=$item["address"]?>
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3"><b>Заметка</b></label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		<?=$item["note"]?>
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-4"><b>Статус</b></label>
																<div class="col-md-8">
																	<p class="form-control-static">
																		<span class="label label-sm label-<?=$item["active"] == 1 ? "success" : "danger";?>"><?=$item["active"] == 1 ? "Активный" : "Заблокирован";?></span>
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
													</div>
													<!--/row-->
								<a class="btn btn-xs blue btn-editable" data-id="1" href="/adminius/index.php?code=users&action=edit&id=<?=$_GET["id"]?>"><i class="fa fa-pencil"></i> Редактировать</a> 
								<h3 class="form-section">Заказы</h3>
								<?$select_order = selectOrders($_GET["id"], $page, $num);
									if($select_order){?>
										<div class="row">
										<div class="col-md-6 col-sm-12">
											<div id="sample_1_length" class="dataTables_length">
												<label>
													<select size="1" name="limit" aria-controls="sample_1"  class="form-control input-small" onchange='location.href="index.php?code=users&action=detail&id=<?=$_GET["id"]?>&limit="+this.value'>
														<option value="10" <?if ($num == 10) echo "selected='selected'";?>>10</option>
														<option value="25" <?if ($num == 25) echo "selected='selected'";?>>25</option>
														<option value="50" <?if ($num == 50) echo "selected='selected'";?>>50</option>
														<option value="100" <?if ($num == 100) echo "selected='selected'";?>>100</option>
														<option value="0" <?if ($num == 0) echo "selected='selected'";?>>All</option>
													</select>
												</label>
											</div>
										</div>
									</div>
									<table class="table table-striped table-bordered table-hover" id="sample_1">
										<thead>
											<tr>
												<th>№</th>
												<th>Номер заказа</th>
												<th>Статус</th>
												<th>Сумма</th>
												<th>Дата заказа</th>
												<th>Действия</th>
											</tr>
										</thead>
										<tbody role="alert" aria-live="polite" aria-relevant="all">
											<?$n=1+$start;
											foreach ($select_order as $item):
											?>
												<tr class="odd">
													<td class=" sorting_1"><?=$n?></td>
													<td class=" sorting_1"><?=str_pad($item["id"], 6, '0', STR_PAD_LEFT)?></td>
													<td class="">
														<span class="label label-sm label-<?=$item["code_status"]?>"><?=$item["status"]?></span>
													</td>
													<td class=""><?=selectSummOrderById($item["id"])?> руб</td>
													<td class=""><?=$item["date"]?></td>
													<td class="">
														<a class="btn btn-xs blue btn-editable" data-id="1" href="/adminius/index.php?code=orders&action=edit&id=<?=$item["id"]?>"><i class="fa fa-pencil"></i> Detail</a>
													</td>
												</tr>
												<?$n++;?>
											<?endforeach;?>
										</tbody>
									</table>
									<?include($_SERVER['DOCUMENT_ROOT'].'/adminius/templates/pagenav.tpl.php');?>
								<?}else{?>
										<div class="alert alert-danger">
												У пользователя еще нет заказов!
										</div>
								<?}?>
							</div>
						</div>
						<!-- END EXAMPLE TABLE PORTLET-->
		<?elseif($_GET["action"] == "search"):?>
			<?
				if (isset($_GET["limit"])) {
					$num = clearData($_GET["limit"], "i");
				}else{
					$num = 10;
				}
				if (isset($_GET["page"])) {
					$page = clearData($_GET["page"], "i");
				}else{
					$page = 1;
				}
			?>
			<!-- BEGIN EXAMPLE TABLE PORTLET-->
							<div class="portlet box blue">
								<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-reorder"></i> Форма поиска
										</div>
								</div>
								<div class="portlet-body form">
									<form role="form" method="GET" action="/adminius/index.php?code=users&action=search">
										<input name="code" type="hidden" value="users">
										<input name="action" type="hidden" value="search">
										<div class="form-body">
											<div class="form-group">
												<label>ID пользователя</label>
												<input type="text" name="id_user" class="form-control" placeholder="Введите ID" value="<?=$_GET["id_user"]?>">
											</div>
											<div class="form-group">
													ИЛИ
											</div>
											<div class="form-group">
												<label class="">Активность</label>
												<div class="radio-list">
													<label class="radio-inline">
													<input type="radio" name="active" value="0" <? if($_GET["active"] == 0) echo "checked";?>> Все </label>
													<label class="radio-inline">
													<input type="radio" name="active" value="1" <? if($_GET["active"] == 1) echo "checked";?>> Активные </label>
													<label class="radio-inline">
													<input type="radio" name="active" value="2" <? if($_GET["active"] == 2) echo "checked";?>> Не активные </label>
												</div>
											</div>
											<div class="form-group">
												<label>Емейл</label>
												<input type="text" name="email" class="form-control" placeholder="Введите E-mail" value="<?=$_GET["email"]?>">
											</div>
											<div class="form-group">
												<label>Телефон</label>
												<input type="text" name="phone" class="form-control" placeholder="Введите телефон" value="<?=$_GET["phone"]?>">
											</div>
										</div>
										<div class="form-actions">
											<button type="submit" class="btn blue">Поиск</button>
										</div>
									</form>
								</div>
								<?if($_GET["active"] OR $_GET["id_user"] OR $_GET["email"] OR $_GET["phone"]){
									$selectUsers = selectSearchUsers($page, $num, $_GET["active"], $_GET["id_user"], $_GET["email"], $_GET["phone"]);
									if($selectUsers){?>
										<div class="portlet-body">
											<table class="table table-striped table-bordered table-hover" id="sample_1">
												<thead>
													<tr>
														<th>№</th>
														<th>Название</th>
														<th>Действия</th>
													</tr>
												</thead>
												<tbody role="alert" aria-live="polite" aria-relevant="all">
													<?$n=1+$start;
													foreach ($selectUsers as $item):
														?>
														<tr class="odd">
															<td class=" sorting_1"><span <?if(isset($item["active"])):?>class="label label-sm label-<?=$item["active"] == 1 ? "success" : "danger";?>"<?endif;?>><?=$n?></span></td>
															<td class=""><?=$item["name"]?></td>
															<td class="">
																<a class="btn btn-xs blue btn-editable" data-id="1" href="/adminius/index.php?code=users&action=edit&id=<?=$item["id"]?>"><i class="fa fa-pencil"></i></a> 
															</td>
														</tr>
														<?$n++;?>
													<?endforeach;?>
												</tbody>
											</table>
											<?include($_SERVER['DOCUMENT_ROOT'].'/adminius/templates/pagenav.tpl.php');?>
										</div>
									<?}else{?>
										<div class="portlet-body">
											<div class="alert alert-danger">
												По Вашему запросу ничего не найдено!
											</div>
										</div>
									<?}?>
								<?}?>
							</div>
		<!--//////////////////////
		<?endif;?>
	<?else:?>
			<?
				if (isset($_GET["limit"])) {
					$num = clearData($_GET["limit"], "i");
				}else{
					$num = 10;
				}
				if (isset($_GET["page"])) {
					$page = clearData($_GET["page"], "i");
				}else{
					$page = 1;
				}
				if (isset($_GET["search"])) {
						$search = $_GET["search"];
				}else{
						$search = "";
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
									<button class="btn blue" onClick='location.href="/adminius/index.php?code=users&action=search"'><font>Поиск</font></button>
									<label style="float:right;">
										<select size="1" name="limit" aria-controls="sample_1"  class="form-control input-small" onchange='location.href="index.php?code=users<?=getUrlLimit()?>&limit="+this.value'>
											<option value="10" <?if ($num == 10) echo "selected='selected'";?>>10</option>
											<option value="25" <?if ($num == 25) echo "selected='selected'";?>>25</option>
											<option value="50" <?if ($num == 50) echo "selected='selected'";?>>50</option>
											<option value="100" <?if ($num == 100) echo "selected='selected'";?>>100</option>
										</select>
									</label>
								</div>
								<table class="table table-striped table-bordered table-hover" id="sample_1">
									<thead>
										<tr>
											<th>№</th>
											<th>Имя</th>
											<th>E-mail</th>
											<th>Телефон</th>
											<th>Дата</th>
										</tr>
									</thead>
									<tbody role="alert" aria-live="polite" aria-relevant="all">
										<?$select_user = selectUser($page, $num);
										$n=1+$start;
										foreach ($select_user as $item):?>
											<tr class="odd">
												<td class=" sorting_1"><span class="label label-sm label-<?=$item["active"] == 1 ? "success" : "danger";?>"><?=$n?></span></td>
												<td class=""><a href="/adminius/index.php?code=users&action=detail&id=<?=$item["id"]?>"><?=$item["name"]?></a></td>
												<td class=""><?=$item["email"]?></td>
												<td class=""><?=$item["phone"]?></td>
												<td class=""><?=$item["date"]?></td>

											</tr>
											<?$n++;?>
										<?endforeach;?>
									</tbody>
								</table>
								<?include($_SERVER['DOCUMENT_ROOT'].'/adminius/templates/pagenav.tpl.php');?>
							</div>
						</div>
						<!-- END EXAMPLE TABLE PORTLET-->
	<?endif;?>
<?}else{?>
	<h3>Отказано в доступе, недостаточно прав.<h3>
<?}?>		