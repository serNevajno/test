<?if($access["sections"] == 1){
	#$sAddres = selectAddresa();?>
	<?if (isset($_GET["action"])):?>
	<?if($_GET["action"] == "add"):?>
	<!-- BEGIN PAGE CONTENT-->
	<div class="row">
		<div class="col-md-12">
			<h2>Добавление категории</h2>
			<br>
			<div class="tabbable tabbable-custom boxless">
				<form role="form" action="index.php" enctype="multipart/form-data" method="POST" name="form" id="myForm">
					<input name="func" type="hidden" value="sections">
					<?if(isset($_GET["id"])){?>
						<input name="section" type="hidden" value="<?=$_GET["id"]?>">
					<?}?>
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#tab_0" data-toggle="tab">Страница</a>
						</li>
						<li>
							<a href="#tab_1" data-toggle="tab">Дополнительно</a>
						</li>
					</ul>
					
					<div class="tab-content">
						<div class="tab-pane active fontawesome-demo" id="tab_0">
							<?if($item['section'] == '50'){?>
								<div class="form-group">
									<div class="checkbox-list">
										Выводить на главной:&nbsp;  <input type="checkbox" value="1" id="output_main" name="output_main"> 
									</div>
								</div>
							<?}?>
							<div class="form-body">
								<div class="form-group">
									<label>Введите название <font color="red">*</font></label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-reorder"></i>
										</span>
										<input type="text" class="form-control" id="name" name="name" placeholder="Название" required>
									</div>
								</div>
								<div class="form-group">
									<label>Введите Title <font color="red">*</font></label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-cogs"></i>
										</span>
										<input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
									</div>
								</div>
								<div class="form-group">
									<label>Введите H1 <font color="red">*</font></label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-cogs"></i>
										</span>
										<input type="text" class="form-control" id="h1" name="h1" placeholder="H1" required>
									</div>
								</div>
								<div class="form-group">
									<label>Введите описание <font color="red">*</font></label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-cogs"></i>
										</span>
										<input type="text" class="form-control" placeholder="Описание" id="meta_d" name="meta_d" required>
									</div>
								</div>
								<div class="form-group">
									<label>Введите ключевые слова через запятую <font color="red">*</font></label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-cogs"></i>
										</span>
										<input type="text" class="form-control" placeholder="Ключевые слова" id="meta_k" name="meta_k" required>
									</div>
								</div>
								<div class="form-group">
									<label>Введите символьный код</label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-cogs"></i>
										</span>
										<input type="text" class="form-control" placeholder="Символьный код" id="code" name="code">
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane glyphicons-demo" id="tab_1">
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
							<div class="form-group">
								<label>Введите текст</label>
								<textarea class="form-control" rows="5" name="descriptions" id="descriptions"></textarea>
								<script type="text/javascript">
									CKEDITOR.replace( 'descriptions' );
								</script>
							</div>
							<div class="form-group">
								<label>Введите приоритет</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-sort-amount-asc "></i>
									</span>
									<input type="text" class="form-control" placeholder="Приоритет" id="priority" name="priority">
								</div>
							</div>
							<div class="form-group">
								<label>Меню</label>
								<select class="form-control" name="menu" id="menu">
									<option value="0" selected="">Не публиковать</option>
									<option value="1">Публиковать</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn blue" name="submit">Сохранить</button>
						<button type="button" class="btn default" onClick='location.href="/adminius/index.php?code=sections<?if(isset($_GET["id"])) echo "&id=".$_GET["id"];?>"'>Отмена</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?elseif($_GET["action"] == "edit"):?>
	<?$item = selectSectionById($_GET["id"]);?>
	<!-- BEGIN PAGE CONTENT-->
	<div class="row">
		<div class="col-md-12">
			<h2>Редактирование категории</h2>
			<br>
			<div class="tabbable tabbable-custom boxless">
				<form role="form" action="index.php" enctype="multipart/form-data" method="POST" name="form" id="myForm">
					<input name="func" type="hidden" value="sections">
					<input name="id" type="hidden" value="<?=$_GET["id"]?>">
					<input name="section" type="hidden" value="<?=$item["section"]?>">
					
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#tab_0" data-toggle="tab">Страница</a>
						</li>
						<li>
							<a href="#tab_1" data-toggle="tab">Дополнительно</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active fontawesome-demo" id="tab_0">
							<div class="form-body">
							<?if($item['section'] == '50'){?>
								<div class="row">
									<div class="form-group col-md-2">
										<div class="checkbox-list">
											Выводить на главной:&nbsp;  <input type="checkbox" value="1" id="output_main" name="output_main" <?if($item["output_main"] == 1) echo "checked";?>> 
										</div>
									</div>
									
									<div class="form-group col-md-4">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-reorder"></i>
											</span>
											<input type="text" class="form-control" id="icon" name="icon" placeholder="Класс иконки"  value="<?=$item["icon"]?>">
										</div>
									</div>
								</div>
							<?}?>
								<div class="form-group">
									<label>Введите название <font color="red">*</font></label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-reorder"></i>
										</span>
										<input type="text" class="form-control" id="name" name="name" placeholder="Название"  value="<?=$item["name"]?>" required>
									</div>
								</div>
								<div class="form-group">
									<label>Введите Title<font color="red">*</font></label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-cogs"></i>
										</span>
										<input type="text" class="form-control" id="title" name="title" placeholder="Заголовок"  value="<?=$item["title"]?>" required>
									</div>
								</div>
								<div class="form-group">
									<label>Введите H1<font color="red">*</font></label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-cogs"></i>
										</span>
										<input type="text" class="form-control" id="h1" name="h1" placeholder="Заголовок"  value="<?=$item["h1"]?>" required>
									</div>
								</div>
								<div class="form-group">
									<label>Введите описание <font color="red">*</font></label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-cogs"></i>
										</span>
										<input type="text" class="form-control" placeholder="Описание" id="meta_d" name="meta_d"  value="<?=$item["meta_d"]?>" required>
									</div>
								</div>
								<div class="form-group">
									<label>Введите ключевые слова через запятую <font color="red">*</font></label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-cogs"></i>
										</span>
										<input type="text" class="form-control" placeholder="Ключевые слова" id="meta_k" name="meta_k"  value="<?=$item["meta_k"]?>" required>
									</div>
								</div>
								<div class="form-group">
									<label>Введите символьный код <font color="red">*</font></label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-cogs"></i>
										</span>
										<input type="text" class="form-control" placeholder="Символьный код" id="code" name="code"  value="<?=$item["code"]?>">
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane glyphicons-demo" id="tab_1">
							<div class="form-group">
								<div class="thumbnail" style="width: 310px;">
										<?if(empty($item["img"])){?>
											<img src="http://www.placehold.it/310x170/EFEFEF/AAAAAA&amp;text=no+image" alt="">
										<?}else{?>
											<img src="/images/section/<?=$item["img"]?>" alt="">
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
							<div class="form-group">
								<label>Введите текст</label>
								<textarea class="form-control" rows="10" name="descriptions" id="descriptions"><?=$item["descriptions"]?></textarea>
								<script type="text/javascript">
									CKEDITOR.replace( 'descriptions' );
								</script>
							</div>
							<div class="form-group">
								<label>Введите приоритет</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-sort-amount-asc "></i>
									</span>
									<input type="text" class="form-control" placeholder="Приоритет" id="priority" name="priority" value="<?=$item["priority"]?>">
								</div>
							</div>
							<div class="form-group">
								<label>Меню</label>
								<select class="form-control" name="menu" id="menu">
									<option value="0" <?if ($item["menu"] == 0) echo "selected";?>>Не публиковать</option>
									<option value="1" <?if ($item["menu"] == 1) echo "selected";?>>Публиковать</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn blue" name="submit">Добавить</button>
						<button type="button" class="btn default" onClick='location.href="/adminius/index.php?code=sections"'>Отмена</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?endif;?>
<?else:?>
	<!-- BEGIN EXAMPLE TABLE PORTLET-->
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="tools">
			</div>
		</div>
		<div class="portlet-body">
			<div class="table-toolbar">
				<div class="btn-group">
					<button id="sample_editable_1_new" class="btn green" onClick='location.href="/adminius/index.php?code=sections&action=add<?if(isset($_GET["id"])) echo "&id=".$_GET["id"];?>"'>
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
							<th>Символьный код</th>
							<th>Приоритет</th>
							<th>Действия</th>
						</tr>
					</thead>
					<tbody role="alert" aria-live="polite" aria-relevant="all">
						<?$select_section = selectSection($_GET["id"]);
							$n=1;
						foreach ($select_section as $item):?>
						<tr class="odd">
							<td class=" sorting_1"><?=$n?></td>
							<td class=""><a href="/adminius/index.php?code=sections&action=edit&id=<?=$item["id"]?>"><?=$item["name"]?></a></td>
							<td class=""><?=$item["code"]?></td>
							<td class=""><?=$item["priority"]?></td>
							<td class="">
								<a class="btn btn-xs blue btn-editable" data-id="1" href="/adminius/index.php?code=sections&action=edit&id=<?=$item["id"]?>"><i class="fa fa-pencil"></i> Edit</a> 
								<?if($access["del"] == 1){?>
									<form action="index.php" method="POST" name="delform<?=$item['id']?>" style="display:none;">
										<input name="func" type="hidden" value="sections">
										<input name="id" type="hidden" value="<?=$item['id']?>">
										<input name="id_sect" type="hidden" value="<?=$_GET['id']?>">
									</form>
									<a class="btn btn-xs red btn-removable" data-id="1" href="javascript:if(confirm('Вы уверены?')){delform<?=$item['id']?>.submit();}"><i class="fa fa-times"></i> Delete</a>
								<?}?>
							</td>
						</tr>
						<?$n++;?>
						<?endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- END EXAMPLE TABLE PORTLET-->
	<?endif;?>
<?}else{?>
	<h3>Отказано в доступе, недостаточно прав.<h3>
<?}?>	