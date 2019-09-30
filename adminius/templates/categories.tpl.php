<?if($access["product"] == 1){?>
	<?if (isset($_GET["action"])):?>
		<?if($_GET["action"] == "add"):?>
			<script type="text/javascript">
				function checkForm() {
					var name = document.getElementById("name");
					var title = document.getElementById("title");
					var meta_d = document.getElementById("meta_d");
					var meta_k = document.getElementById("meta_k");
					if (!name.value) {
						alert('Введите имя');
						return false;
					}
					if (!title.value) {
						alert('Введите заголовок');
						return false;
					}
					if (!meta_d.value) {
						alert('Введите описание');
						return false;
					}
					if (!meta_k.value) {
						alert('Введите ключевые слова');
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
							<h2>Добавление категории</h2>
							<br>
							<div class="tabbable tabbable-custom boxless">
							<form role="form" action="index.php" enctype="multipart/form-data" method="POST" name="form" id="myForm">
								<input name="func" type="hidden" value="categories">

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
															<div class="form-group">
																<div class="checkbox-list">
																	<b>Активность:</b>&nbsp;  <input type="checkbox" value="1" name="active">
																</div>
															</div>
                                                            <div class="form-group">
                                                                <div class="checkbox-list">
                                                                    <b>Добавить в ЯМ:</b>&nbsp;  <input type="checkbox" value="1" name="in_xml">
                                                                </div>
                                                            </div>
															<div class="form-group">
																<label>Родительский раздел: <font color="red">*</font></label>	
																<select name="section" class="form-control input-medium">
																	<option value="0">Верхний уровень</option>
																	<?recusiveCategories(0, 0);?>
																</select>
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
																<label>Введите заголовок <font color="red">*</font></label>
																<div class="input-group">
																	<span class="input-group-addon">
																		<i class="fa fa-cogs"></i>
																	</span>
																<input type="text" class="form-control" id="title" name="title" placeholder="Заголовок">
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
										</div>
									</div>
								<div class="form-actions">
									<button type="submit" class="btn blue" name="submit">Сохранить</button>
									<button type="button" class="btn default" onClick='location.href="/adminius/index.php?code=categories"'>Отмена</button>
								</div>
							</form>
							</div>
						</div>
					</div>
			<?elseif($_GET["action"] == "edit"):?>
				<script type="text/javascript">
				function checkForm() {
					var name = document.getElementById("name");
					var title = document.getElementById("title");
					var meta_d = document.getElementById("meta_d");
					var meta_k = document.getElementById("meta_k");
					var code = document.getElementById("code");
					var form = document.getElementById("myForm");
					if (!name.value) {
						alert('Введите имя');
						return false;
					}
					if (!title.value) {
						alert('Введите заголовок');
						return false;
					}
					if (!meta_d.value) {
						alert('Введите описание');
						return false;
					}
					if (!meta_k.value) {
						alert('Введите ключевые слова');
						return false;
					}
					if (!code.value) {
						alert('Введите символьный код');
						return false;
					}
				}
				window.onload = function () {
					var form = document.getElementById("myForm");
					form.submit = checkForm;
				}
			</script>
		<?$item = selectCategoriesById($_GET["id"]);?>
		<!-- BEGIN PAGE CONTENT-->
					<div class="row">
						<div class="col-md-12">
							<h2>Редактирование категории</h2>
							<br>
							<div class="tabbable tabbable-custom boxless">
							<form role="form" action="index.php" enctype="multipart/form-data" method="POST" name="form" id="myForm">
									<input name="func" type="hidden" value="categories">
									<input name="id" type="hidden" value="<?=$_GET["id"]?>">
									<input name="section" type="hidden" value="<?=$item["section"]?>">
									<ul class="nav nav-tabs">
										<li class="active">
											<a href="#tab_0" data-toggle="tab">Страница</a>
										</li>
										<li>
											<a href="#tab_1" data-toggle="tab">Дополнительно</a>
										</li>
										<li>
											<a href="#tab_2" data-toggle="tab">Фильтр</a>
										</li>
									</ul>
									
									<div class="tab-content">
										<div class="tab-pane active fontawesome-demo" id="tab_0">
											<div class="form-body">
															<?/*<div class="form-group">
																<select name="section" class="form-control input-medium">
																	<option value="0">Верхний уровень</option>
																	<?$select_cat = selectCategoriesBySection();
																	foreach ($select_cat as $items):
																		if ($_GET["id"] != $items["id"]):?>
																			<option value="<?=$items["id"]?>" <?if ($item["section"] == $items["id"]) echo "selected";?>><?=$items["name"]?></option>
																			<?$select_cat_down = selectCategoriesBySection($items["id"]);
																			if ($select_cat_down): 
																				foreach($select_cat_down as $item_down):?>
																					<option value="<?=$item_down["id"]?>" <?if ($item["section"] == $item_down["id"]) echo "selected";?>>-<?=$item_down["name"]?></option>
																				<?endforeach;?>
																			<?endif;?>
																		<?endif;?>
																	<?endforeach;?>
																</select>
															</div>*/?>
															<div class="form-group">
																<div class="checkbox-list">
																	<b>Активность:</b>&nbsp;  <input type="checkbox" value="1" name="active" <?if ($item["active"] == 1) echo "checked";?>>
																</div>
															</div>
                                                            <div class="form-group">
                                                                <div class="checkbox-list">
                                                                    <b>Добавить в ЯМ:</b>&nbsp;  <input type="checkbox" value="1" name="in_xml" <?if ($item["in_xml"] == 1) echo "checked";?>>
                                                                </div>
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
															<div class="form-group">
																<label>Введите заголовок <font color="red">*</font></label>
																<div class="input-group">
																	<span class="input-group-addon">
																		<i class="fa fa-cogs"></i>
																	</span>
																<input type="text" class="form-control" id="title" name="title" placeholder="Заголовок"  value="<?=$item["title"]?>">
																</div>
															</div>
															<div class="form-group">
																<label>Введите описание <font color="red">*</font></label>
																<div class="input-group">
																	<span class="input-group-addon">
																		<i class="fa fa-cogs"></i>
																	</span>
																	<input type="text" class="form-control" placeholder="Описание" id="meta_d" name="meta_d"  value="<?=$item["meta_d"]?>">
																</div>
															</div>
															<div class="form-group">
																<label>Введите ключевые слова через запятую <font color="red">*</font></label>
																<div class="input-group">
																	<span class="input-group-addon">
																		<i class="fa fa-cogs"></i>
																	</span>
																	<input type="text" class="form-control" placeholder="Ключевые слова" id="meta_k" name="meta_k"  value="<?=$item["meta_k"]?>">
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
											<div class="form-actions">
												<button type="submit" class="btn blue" name="submit">Добавить</button>
												<button type="button" class="btn default" onClick='location.href="/adminius/index.php?code=categories"'>Отмена</button>
											</div>
										</div>
										<div class="tab-pane glyphicons-demo" id="tab_1">
											<div class="form-group">
												<div class="form-group">
													<div class="thumbnail" style="width: 310px;">
														<?if(empty($item["img"])):?>
															<img src="http://www.placehold.it/310x170/EFEFEF/AAAAAA&amp;text=no+image" alt="">
														<?else:?>
															<img src="/images/categories_cover/<?=$item["img"]?>" alt="">
														<?endif;?>
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
												<label>Введите текст</label>
												<textarea class="form-control" rows="5" name="descriptions" id="descriptions"><?=$item["descriptions"]?></textarea>
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
											<div class="form-actions">
												<button type="submit" class="btn blue" name="submit">Добавить</button>
												<button type="button" class="btn default" onClick='location.href="/adminius/index.php?code=categories"'>Отмена</button>
											</div>
							</form>
										</div>
										
										<div class="tab-pane glyphicons-demo" id="tab_2">
											<?$select_filter = selectFilterByCategories($_GET["id"]);?>
											<?if ($select_filter):?>
												<table class="table table-striped table-bordered table-hover" id="sample_1" style="width:auto;">
													<thead>
														<tr>
															<th>№</th>
															<th>Имя</th>
															<th>Тип</th>
															<th>Приоритет</th>
															<th>Действия</th>
														</tr>
													</thead>
													<tbody role="alert" aria-live="polite" aria-relevant="all">
														<?$n=1;
														foreach ($select_filter as $item):?>
															<tr class="odd">
																<td class=" sorting_1"><?=$n?></td>
																<td class="">
																	<?if ($item["type"] == 1):?>
																		<a href="/adminius/index.php?code=elementfilter&filter=<?=$item["id"]?>&idcat=<?=$_GET["id"]?>"><?=$item["name"]?></a>
																	<?else:?>
																		<?=$item["name"]?>
																	<?endif;?>
																</td>
																<td class=""><?if ($item["type"] == 1){ echo "Список";}else{echo "Значение";}?></td>
																<td class=""><?=$item["priority"]?></td>
																<td class="">
																	<a class="btn btn-xs blue btn-editable" data-id="1" href="/adminius/index.php?code=filter&action=edit&id=<?=$item["id"]?>"><i class="fa fa-pencil"></i> Edit</a> 
																		<?if(!selectElementByFilter($item['id'])):?>
																			<form action="index.php" method="POST" name="delform<?=$item['id']?>" id="delform<?=$item['id']?>" style="display:none;">
																				<input name="func" type="hidden" value="filter">
																				<input name="cat" type="hidden" value="<?=$_GET["id"]?>">
																				<input name="id" type="hidden" value="<?=$item['id']?>">
																			</form>
																	
																			<a class="btn btn-xs red btn-removable" data-id="1" href="javascript:if(confirm('Вы уверены?')){delform<?=$item['id']?>.submit();}"><i class="fa fa-times"></i> Delete</a>
																		<?endif;?>
																	</td>
																</tr>
																<?$n++;?>
															<?endforeach;?>
														</tbody>
													</table>
												<?else:?>
													<div>В данной категории нету фильтров</div>
												<?endif;?>
											<button type="button" class="btn blue" onClick='location.href="/adminius/index.php?code=filter&action=add&cat=<?=$_GET["id"]?>"'>Добавить фильтр</button>
										</div>
									</div>
						
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
										<button id="sample_editable_1_new" class="btn green" onClick='location.href="/adminius/index.php?code=categories&action=add"'>
										Добавить <i class="fa fa-plus"></i>
										</button>
                                        <button style="margin-left:10px;" class="btn blue" onClick='location.href="/adminius/index.php?code=product&action=upload"'>
                                            Загрузить <i class="fa fa-upload"></i>
                                        </button>
                                        <button class="btn blue" style="margin-left:10px;" onClick='location.href="/adminius/index.php?code=product&action=search"'><font>Поиск</font></button>

                    
                    <? foreach (selectRegion() as $iRegion) {
                      if($iRegion['id'] != 4 AND $iRegion['id'] != 5){?>
										  <button class="btn blue" style="margin-left:10px;" onClick='location.href="/adminius/index.php?code=product&action=storage&region=<?=$iRegion[id]?>"'><font>Наш склад <?= $iRegion["region"] ?></font>
										  </button>
										<? } }?>
									</div>
								</div>
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
										<?$select_categories = selectCategoriesBySection($_GET["section"]);
										$n=1;
										foreach ($select_categories as $item):?>
											<tr class="odd">
												<td class=" sorting_1"><span class="label label-sm label-<?=$item["active"] == 1 ? "success" : "danger";?>"><?=$n?></span></td>
												<td class="">
													<?if (checkSection($item["id"]) > 0){?>
														<a href="/adminius/index.php?code=categories&section=<?=$item["id"]?>"><?=$item["name"]?></a>
													<?}else{?>
														<a href="/adminius/index.php?code=product&cat=<?=$item["id"]?>"><?=$item["name"]?></a>
													<?}?>
												</td>
												<td class=""><?=$item["code"]?></td>
												<td class=""><?=$item["priority"]?></td>
												<td class="">
													<a class="btn btn-xs blue btn-editable" data-id="1" href="/adminius/index.php?code=categories&action=edit&id=<?=$item["id"]?>"><i class="fa fa-pencil"></i> Edit</a> 
														<?if($access["product"] == 1){
														  if(checkSectionCat($item["id"]) == 0){?>
															<form action="index.php" method="POST" name="delform<?=$item['id']?>" style="display:none;">
																<input name="func" type="hidden" value="categories">
																<input name="id" type="hidden" value="<?=$item['id']?>">
                                                                <input name="section" type="hidden" value="<?=$_GET["section"]?>">
															</form>
															<a class="btn btn-xs red btn-removable" data-id="1" href="javascript:if(confirm('Вы уверены?')){delform<?=$item['id']?>.submit();}"><i class="fa fa-times"></i> Delete</a>
														<?}}?>
												</td>
											</tr>
											<?$n++;?>
										<?endforeach;?>
									</tbody>
								</table>
							</div>
						</div>
						<!-- END EXAMPLE TABLE PORTLET-->
	<?endif;?>
<?}else{?>
	<h3>Отказано в доступе, недостаточно прав.<h3>
<?}?>		