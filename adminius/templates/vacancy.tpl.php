<?if($access["blog"] == 1){?>
	<?if (isset($_GET["action"])){?>
		<?if($_GET["action"] == "add"){?>
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<div class="tabbable tabbable-custom">
						<h2>Добавление материала..</h2>
						<br>
						<form role="form" action="" enctype="multipart/form-data" method="POST" name="form" id="myForm">
							<input name="func" type="hidden" value="vacancy">
							<ul class="nav nav-tabs">
								<li class="active">
									<a href="#tab_0" data-toggle="tab">Элемент</a>
								</li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active fontawesome-demo" id="tab_0">
									<div class="form-body">
													<div class="form-group">
														<div class="checkbox-list">
															Активность:&nbsp;  <input type="checkbox" value="1" id="active" name="active" checked> 
														</div>
													</div>
													<div class="form-group">
														<label>Выберите дату:</label>
														<div class="col-md-4">
															<div class="input-group date form_datetime">
																<input size="16" readonly="" class="form-control" type="text" name="date_active">
																<span class="input-group-btn">
																	<button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
																</span>
															</div>
															<!-- /input-group -->
														</div>
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
													<textarea class="form-control" rows="5" name="article" id="article"></textarea>
													<script type="text/javascript">
														CKEDITOR.replace( 'article' );
													</script>
									</div>
								</div>
							</div>
							<div class="form-actions">
								<button type="submit" class="btn blue" name="submit">Сохранить</button>
								<button type="button" class="btn red" onClick='location.href="/adminius/index.php?code=vacancy"'>Отмена</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		<?}elseif($_GET["action"] == "edit"){?>
			<?$itemBlog = selectVacancyById($_GET["id"]);?>
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<div class="tabbable tabbable-custom">
						<h2>Добавление материала..</h2>
						<br>
						<form role="form" action="" enctype="multipart/form-data" method="POST" name="form" id="myForm">
							<input name="func" type="hidden" value="vacancy">
							<input name="id" type="hidden" value="<?=$_GET["id"]?>">
							<input name="img_old" type="hidden" value="<?=$itemBlog["img"]?>">
							<ul class="nav nav-tabs">
								<li class="active">
									<a href="#tab_0" data-toggle="tab">Элемент</a>
								</li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active fontawesome-demo" id="tab_0">
									<div class="form-body">
													<div class="form-group">
														<div class="checkbox-list">
															Активность:&nbsp;  <input type="checkbox" value="1" id="active" name="active" <?if($itemBlog["active"] == 1) echo "checked";?>> 
														</div>
													</div>
													<div class="form-group">
														<label>Выберите дату:</label>
														<div class="col-md-4">
															<div class="input-group date form_datetime">
																<input size="16" readonly="" class="form-control" type="text" name="date_active" value="<?=date("d F Y - H:i", strtotime($itemBlog["date"]))?>">
																<span class="input-group-btn">
																	<button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
																</span>
															</div>
															<!-- /input-group -->
														</div>
													</div>	
													<div class="form-group">
														<label>Введите название <font color="red">*</font></label>
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-reorder"></i>
															</span>
															<input type="text" class="form-control" id="name" name="name" placeholder="Название" value="<?=$itemBlog["name"]?>">
														</div>
													</div>
													<textarea class="form-control" rows="5" name="article" id="article"><?=$itemBlog["text"]?></textarea>
													<script type="text/javascript">
														CKEDITOR.replace( 'article' );
													</script>
									</div>
								</div>
							</div>
							<div class="form-actions">
								<button type="submit" class="btn blue" name="submit">Сохранить</button>
								<button type="button" class="btn red" onClick='location.href="/adminius/index.php?code=vacancy"'>Отмена</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		<?}?>
	<?}else{?>
	
	<?if (isset($_GET["limit"])) {
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
		}?>
		<!-- BEGIN SAMPLE TABLE PORTLET-->
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>Управление материалами блога
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse"></a>
					<a href="javascript:;" class="reload"></a>
				</div>
			</div>
			<div class="portlet-body">
				<div class="table-toolbar">
					<div class="btn-group">
						<button id="sample_editable_1_new" class="btn green" onClick='location.href="/adminius/index.php?code=vacancy&action=add"'>
						Добавить <i class="fa fa-plus"></i>
						</button>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div id="sample_1_length" class="dataTables_length">
							<label>
								<select size="1" name="limit" aria-controls="sample_1"  class="form-control input-small" onchange='location.href="index.php?code=<?=$_GET['code']?><?if($_GET['search']){?>&search=<?=$_GET['search']?><?}?><?if($_GET['page']){?>&page=<?=$_GET['page']?><?}?>&limit="+this.value'>
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
				<?$select_blog = selectVacancy($page, $num, $search);
				if (!empty($select_blog)):?>
					<div class="table-scrollable">
						<table class="table table-striped table-bordered table-hover">
						<thead>
						<tr>
							<th>ID</th>
							<th>Название</th>
							<th>Статус</th>
							<th>Дата</th>
							<th>Действия</th>
						</tr>
						</thead>
						<tbody>
						<?$n=1+$start;
							foreach ($select_blog as $item){
								if ($item["active"] == 1) {
									$class ="success";
									$act = "Активный";
								}else{
									$class = "danger";
									$act = "Не активный";
								}?>
								<tr>
									<td><?=$n?></td>
									<td><a href="/adminius/index.php?code=vacancy&action=edit&id=<?=$item["id"]?>"><?=$item['name']?></a></td>
									<td><span class="label label-sm label-<?=$class?>"><?=$act?><?$item["active"]?></span></td>
									<td><?=$item['date']?></td>
									<td>
										<a class="btn btn-xs blue btn-editable" data-id="1" href="/adminius/index.php?code=vacancy&action=edit&id=<?=$item["id"]?>"><i class="fa fa-pencil"></i> Edit</a> 
										<?if($access["del"] == 1){?>
											<form action="index.php" method="POST" name="delform<?=$item['id']?>" style="display:none;">
												<input name="func" type="hidden" value="vacancy">
												<input name="id" type="hidden" value="<?=$item['id']?>">
												<input name="img" type="hidden" value="<?=$item['img']?>">
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
				<?else:?>
					<h3> К сожалению но вакансий нет :(<h3>
				<?endif;?>
			</div>
		</div>
		<!-- END SAMPLE TABLE PORTLET-->
	
	<?}?>
<?}else{?>
	<h3>Отказано в доступе, недостаточно прав.<h3>
<?}?>