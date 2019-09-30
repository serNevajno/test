<?if($access["journal"] == 1){?>
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
								<input name="func" type="hidden" value="journal">
									
									<div class="tab-content">
											<div class="form-body">
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
																<input type="file" class="default" id="img" name="img"/>
															</span>
															<a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Удалить</a>
														</div>
													</div>	
												</div>
												<div class="form-group">
													<label>PDF файл <font color="red">*</font></label>
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
																<input type="file" class="default" id="pdf" name="pdf"/>
															</span>
															<a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Удалить</a>
														</div>
													</div>	
												</div>
												<div class="form-group">
													<label>Введите текст</label>
													<textarea class="form-control" rows="5" name="content" id="content"></textarea>
														<script type="text/javascript">
															CKEDITOR.replace('content');
														</script>
												</div>
												<div class="form-group">
													<label>Выберите месяц</label>
													<select class="form-control" name="month">
														<option value="0" selected="">Не выбрано</option>
														<option value="01">1</option>
														<option value="02">2</option>
														<option value="03">3</option>
														<option value="04">4</option>
														<option value="05">5</option>
														<option value="06">6</option>
														<option value="07">7</option>
														<option value="08">8</option>
														<option value="09">9</option>
														<option value="10">10</option>
														<option value="11">11</option>
														<option value="12">12</option>
													</select>
												</div>
												<div class="form-group">
													<label>Выберите год</label>
													<select class="form-control" name="year">
														<option value="0" selected="">Не выбрано</option>
														<option value="2010">2010</option>
														<option value="2011">2011</option>
														<option value="2012">2012</option>
														<option value="2013">2013</option>
														<option value="2014">2014</option>
														<option value="2015">2015</option>
														<option value="2016">2016</option>
														<option value="2017">2017</option>
														<option value="2018">2018</option>
														<option value="2019">2019</option>
														<option value="2020">2020</option>
														<option value="2021">2021</option>
													</select>
												</div>
											</div>
									</div>
								<div class="form-actions">
									<button type="submit" class="btn blue" name="submit">Сохранить</button>
									<button type="button" class="btn default" onClick='location.href="/adminius/index.php?code=journal"'>Отмена</button>
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
					form.submit = checkForm;
				}
			</script>
		<?$item = selectJournalById($_GET["id"]);
		$d = explode("-", $item["date"]);
		?>
		<!-- BEGIN PAGE CONTENT-->
					<div class="row">
						<div class="col-md-12">
							<h2>Редактирование категории</h2>
							<br>
							<div class="tabbable tabbable-custom boxless">
							<form role="form" action="index.php" enctype="multipart/form-data" method="POST" name="form" id="myForm">
									<input name="func" type="hidden" value="journal">
									<input name="id" type="hidden" value="<?=$_GET["id"]?>">
									
									<div class="tab-content">
											<div class="form-body">
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
													<div class="thumbnail" style="width: 310px;">
														<?if ($item["img"]):?>
															<img src="/images/journal_img/<?=$item["img"]?>" alt="<?=$item["name"]?>">
														<?else:?>
															<img src="http://www.placehold.it/310x170/EFEFEF/AAAAAA&amp;text=no+image" alt="Нет картинки" title="Нет картинки">
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
																<input type="file" class="default" id="img" name="img"/>
																<input name="img_old" type="hidden" value="<?=$item["img"]?>" />
															</span>
															<a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Удалить</a>
														</div>
													</div>	
												</div>
												<div class="form-group">
													<label>PDF файл <font color="red">*</font></label><br>
													<?if(!empty($item["pdf"])){?>
														<a href="/images/journal_pdf/<?=$item["pdf"]?>" class="btn blue"><i class="fa fa-file-o"></i></a>
													<?}?>
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
																<input type="file" class="default" id="pdf" name="pdf"/>
																<input type="hidden" name="old_pdf" value="<?=$item["pdf"]?>"/>
															</span>
															<a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Удалить</a>
														</div>
													</div>	
												</div>
												<div class="form-group">
													<label>Введите текст</label>
													<textarea class="form-control" rows="5" name="content" id="content"><?=$item["content"]?></textarea>
														<script type="text/javascript">
															CKEDITOR.replace('content');
														</script>
												</div>
												<div class="form-group">
													<label>Выберите месяц</label>
													<select class="form-control" name="month">
														<option value="0" <?if($d[1] == "0") echo "selected";?>>Не выбрано</option>
														<option value="01" <?if($d[1] == "01") echo "selected";?>>1</option>
														<option value="02" <?if($d[1] == "02") echo "selected";?>>2</option>
														<option value="03" <?if($d[1] == "03") echo "selected";?>>3</option>
														<option value="04" <?if($d[1] == "04") echo "selected";?>>4</option>
														<option value="05" <?if($d[1] == "05") echo "selected";?>>5</option>
														<option value="06" <?if($d[1] == "06") echo "selected";?>>6</option>
														<option value="07" <?if($d[1] == "07") echo "selected";?>>7</option>
														<option value="08" <?if($d[1] == "08") echo "selected";?>>8</option>
														<option value="09" <?if($d[1] == "09") echo "selected";?>>9</option>
														<option value="10" <?if($d[1] == "10") echo "selected";?>>10</option>
														<option value="11" <?if($d[1] == "11") echo "selected";?>>11</option>
														<option value="12" <?if($d[1] == "12") echo "selected";?>>12</option>
													</select>
												</div>
												<div class="form-group">
													<label>Выберите год</label>
													<select class="form-control" name="year">
														<option value="0" <?if($d[0] == "0") echo "selected";?>>Не выбрано</option>
														<option value="2010" <?if($d[0] == "2010") echo "selected";?>>2010</option>
														<option value="2011" <?if($d[0] == "2011") echo "selected";?>>2011</option>
														<option value="2012" <?if($d[0] == "2012") echo "selected";?>>2012</option>
														<option value="2013" <?if($d[0] == "2013") echo "selected";?>>2013</option>
														<option value="2014" <?if($d[0] == "2014") echo "selected";?>>2014</option>
														<option value="2015" <?if($d[0] == "2015") echo "selected";?>>2015</option>
														<option value="2016" <?if($d[0] == "2016") echo "selected";?>>2016</option>
														<option value="2017" <?if($d[0] == "2017") echo "selected";?>>2017</option>
														<option value="2018" <?if($d[0] == "2018") echo "selected";?>>2018</option>
														<option value="2019" <?if($d[0] == "2019") echo "selected";?>>2019</option>
														<option value="2020" <?if($d[0] == "2020") echo "selected";?>>2020</option>
														<option value="2021" <?if($d[0] == "2021") echo "selected";?>>2021</option>
													</select>
												</div>
											</div>
									</div>
									<div class="form-actions">
										<button type="submit" class="btn blue" name="submit">Добавить</button>
										<button type="button" class="btn default" onClick='location.href="/adminius/index.php?code=journal"'>Отмена</button>
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
										<button id="sample_editable_1_new" class="btn green" onClick='location.href="/adminius/index.php?code=journal&action=add"'>
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
											<th>Действия</th>
										</tr>
									</thead>
									<tbody role="alert" aria-live="polite" aria-relevant="all">
										<?$select_journal = selectJournal($page);
										$n=1;
										foreach ($select_journal as $item):?>
											<tr class="odd">
												<td class=" sorting_1"><?=$n?></td>
												<td class=""><a href="/adminius/index.php?code=journal_article&journal=<?=$item["id"]?>"><?=$item["name"]?></a></td>
												<td class="">
													<a class="btn btn-xs blue btn-editable" data-id="1" href="/adminius/index.php?code=journal&action=edit&id=<?=$item["id"]?>"><i class="fa fa-pencil"></i> Edit</a> 
													<?if($access["del"] == 1){?>
														<form action="index.php" method="POST" name="delform<?=$item['id']?>" style="display:none;">
															<input name="func" type="hidden" value="journal">
															<input name="id" type="hidden" value="<?=$item['id']?>">
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
								<?include($_SERVER['DOCUMENT_ROOT'].'/adminius/templates/pagenav.tpl.php');?>
							</div>
						</div>
						<!-- END EXAMPLE TABLE PORTLET-->
	<?endif;?>
<?}else{?>
	<h3>Отказано в доступе, недостаточно прав.<h3>
<?}?>