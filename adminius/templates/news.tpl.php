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
							<input name="func" type="hidden" value="news">
							<ul class="nav nav-tabs">
								<li class="active">
									<a href="#tab_0" data-toggle="tab">Элемент</a>
								</li>
								<li>
									<a href="#tab_1" data-toggle="tab">Анонс</a>
								</li>
								<li>
									<a href="#tab_2" data-toggle="tab">Подробно</a>
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
													<div class="form-group">
														<label>Введите TITLE <font color="red">*</font></label>
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-cogs"></i>
															</span>
														<input type="text" class="form-control" id="title" name="title" placeholder="Заголовок">
														</div>
													</div>
													<div class="form-group">
														<label>Введите H1 <font color="red">*</font></label>
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-cogs"></i>
															</span>
														<input type="text" class="form-control" id="h1" name="h1" placeholder="Заголовок">
														</div>
													</div>
													<div class="form-group">
														<label>Введите описание <font color="red">*</font></label>
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-cogs"></i>
															</span>
															<input type="text" class="form-control" placeholder="Описание" id="meta_d" name="meta_d">
														</div>
													</div>
													<div class="form-group">
														<label>Введите ключевые слова через запятую <font color="red">*</font></label>
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-cogs"></i>
															</span>
															<input type="text" class="form-control" placeholder="Ключевые слова" id="meta_k" name="meta_k">
														</div>
													</div>
													<div class="form-group">
														<label>Введите символьный код ссылки (оставте пустым и он будет сгенерирован автоматически)</label>
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-cogs"></i>
															</span>
															<input type="text" class="form-control" placeholder="Введите символьный код ссылки (оставте пустым и он будет сгенерирован автоматически)" id="code" name="code">
														</div>
													</div>
									</div>
								</div>
								<div class="tab-pane glyphicons-demo" id="tab_1">
										<textarea class="form-control" rows="5" name="descriptions"></textarea>
								</div>
								<div class="tab-pane glyphicons-demo" id="tab_2">
									<div class="form-group">
											<div class="thumbnail" style="width: 310px;">
															<img src="http://www.placehold.it/310x170/EFEFEF/AAAAAA&amp;text=no+image" alt="">
											</div>
											<div class="margin-top-10 fileupload fileupload-new" data-provides="fileupload">
												<div class="input-group input-group-fixed">
													<span class="input-group-btn">
														<span class="uneditable-input">
															<i class="fa fa-file fileupload-exists"></i>
															<span class="fileupload-preview"></span>
														</span>
													</span>
													<span class="btn default btn-file">
														<span class="fileupload-new">
															<i class="fa fa-paper-clip"></i>Выберите файл
														</span>
														<span class="fileupload-exists">
															<i class="fa fa-undo"></i> Заменить
														</span>
														<input type="file" class="default" name="img"/>
													</span>
													<a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Удалить</a>
												</div>
											</div>	
										</div>
									<textarea class="form-control" rows="5" name="article" id="article"></textarea>
									<script type="text/javascript">
										CKEDITOR.replace( 'article' );
									</script>
								</div>
							</div>
							<div class="form-actions">
								<button type="submit" class="btn blue" name="submit">Сохранить</button>
								<button type="button" class="btn red" onClick='location.href="/adminius/index.php?code=news"'>Отмена</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		<?}elseif($_GET["action"] == "edit"){?>
			<?$itemBlog = selectBlogById($_GET["id"]);?>
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<div class="tabbable tabbable-custom">
						<h2>Добавление материала..</h2>
						<br>
						<form role="form" action="" enctype="multipart/form-data" method="POST" name="form" id="myForm">
							<input name="func" type="hidden" value="news">
							<input name="id" type="hidden" value="<?=$_GET["id"]?>">
							<input name="img_old" type="hidden" value="<?=$itemBlog["img"]?>">
							<ul class="nav nav-tabs">
								<li class="active">
									<a href="#tab_0" data-toggle="tab">Элемент</a>
								</li>
								<li>
									<a href="#tab_1" data-toggle="tab">Анонс</a>
								</li>
								<li>
									<a href="#tab_2" data-toggle="tab">Подробно</a>
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
																<input size="16" readonly="" class="form-control" type="text" name="date_active" value="<?=date("d F Y - H:i", strtotime($itemBlog["date_active"]))?>">
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
													<div class="form-group">
														<label>Введите TITLE <font color="red">*</font></label>
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-cogs"></i>
															</span>
														<input type="text" class="form-control" id="title" name="title" placeholder="Заголовок" value="<?=$itemBlog["title"]?>">
														</div>
													</div>
													<div class="form-group">
														<label>Введите H1 <font color="red">*</font></label>
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-cogs"></i>
															</span>
														<input type="text" class="form-control" id="h1" name="h1" placeholder="Заголовок" value="<?=$itemBlog["h1"]?>">
														</div>
													</div>
													<div class="form-group">
														<label>Введите описание <font color="red">*</font></label>
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-cogs"></i>
															</span>
															<input type="text" class="form-control" placeholder="Описание" id="meta_d" name="meta_d" value="<?=$itemBlog["meta_d"]?>">
														</div>
													</div>
													<div class="form-group">
														<label>Введите ключевые слова через запятую <font color="red">*</font></label>
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-cogs"></i>
															</span>
															<input type="text" class="form-control" placeholder="Ключевые слова" id="meta_k" name="meta_k" value="<?=$itemBlog["meta_k"]?>">
														</div>
													</div>
													<div class="form-group">
														<label>Введите символьный код ссылки (оставте пустым и он будет сгенерирован автоматически)</label>
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-cogs"></i>
															</span>
															<input type="text" class="form-control" placeholder="Введите символьный код ссылки (оставте пустым и он будет сгенерирован автоматически)" id="code" name="code" value="<?=$itemBlog["code"]?>">
														</div>
													</div>
									</div>
								</div>
								<div class="tab-pane glyphicons-demo" id="tab_1">
										<textarea class="form-control" rows="5" name="descriptions"><?=$itemBlog["description"]?></textarea>
								</div>
								<div class="tab-pane glyphicons-demo" id="tab_2">
									<div class="form-group">
											<div class="thumbnail" style="width: 310px;">
														<?if(empty($itemBlog["img"])){?>
															<img src="http://www.placehold.it/310x170/EFEFEF/AAAAAA&amp;text=no+image" alt="">
														<?}else{?>
															<img src="/images/news/<?=$itemBlog["img"]?>" alt="">
														<?}?>
											</div>
											<div class="margin-top-10 fileupload fileupload-new" data-provides="fileupload">
												<div class="input-group input-group-fixed">
													<span class="input-group-btn">
														<span class="uneditable-input">
															<i class="fa fa-file fileupload-exists"></i>
															<span class="fileupload-preview"></span>
														</span>
													</span>
													<span class="btn default btn-file">
														<span class="fileupload-new">
															<i class="fa fa-paper-clip"></i>Выберите файл
														</span>
														<span class="fileupload-exists">
															<i class="fa fa-undo"></i> Заменить
														</span>
														<input type="file" class="default" name="img"/>
													</span>
													<a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Удалить</a>
												</div>
											</div>	
										</div>
									<textarea class="form-control" rows="5" name="article" id="article"><?=$itemBlog["text"]?></textarea>
									<script type="text/javascript">
										CKEDITOR.replace( 'article' );
									</script>
								</div>
							</div>
							<div class="form-actions">
								<button type="submit" class="btn blue" name="submit">Сохранить</button>
								<button type="button" class="btn red" onClick='location.href="/adminius/index.php?code=news"'>Отмена</button>
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
						<button id="sample_editable_1_new" class="btn green" onClick='location.href="/adminius/index.php?code=news&action=add"'>
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
					<div style="float:right;">
						<div class="dataTables_filter" id="sample_1_filter">
							<div class="col-md-6">
								<div class="input-group input-medium">
									<form action="/adminius/index.php" method="GET" style=" display: inline-table;"><input name="code" type="hidden" value="news"/>
										<input type="text" class="form-control" placeholder="поиск" name="search">
										<span class="input-group-btn">
											<button class="btn blue" type="sumbit"><font><font>Поиск</font></font></button>
										</span>
									</form>
								</div>		
							</div>
						</div>
					</div>
				</div>
				<?$select_blog = selectAllBlog($page, $num, 1, $search);
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
									<td><a href="/adminius/index.php?code=news&action=edit&id=<?=$item["id"]?>"><?=$item['name']?></a></td>
									<td><span class="label label-sm label-<?=$class?>"><?=$act?><?$item["active"]?></span></td>
									<td><?=$item['date']?></td>
									<td>
										<a class="btn btn-xs blue btn-editable" data-id="1" href="/adminius/index.php?code=news&action=edit&id=<?=$item["id"]?>"><i class="fa fa-pencil"></i> Edit</a> 
										<?if($access["del"] == 1){?>
											<form action="index.php" method="POST" name="delform<?=$item['id']?>" style="display:none;">
												<input name="func" type="hidden" value="news">
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
					<h3> К сожалению но новостей нет :(<h3>
				<?endif;?>
			</div>
		</div>
		<!-- END SAMPLE TABLE PORTLET-->
	
	<?}?>
<?}else{?>
	<h3>Отказано в доступе, недостаточно прав.<h3>
<?}?>