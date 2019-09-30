<?if($access["admin"] == 1){?>
	<?if(isset($_GET["action"])){?>
		<?if($_GET["action"] == "add"){?>
			<div class="row">
					<div class="col-md-12">
						<div class="tabbable tabbable-custom">
							<h2>Карточка администратора...</h2>
							<br>
							<form role="form" action="" enctype="multipart/form-data" method="POST" name="formAdmin" id="formAdmin">
								<input name="func" type="hidden" value="userAdmin">
								
								<div class="form-body">
									<div class="form-group">
										<label>Логин администратора <font color="red">*</font></label>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-user"></i>
											</span>
											<input type="text" class="form-control" id="login" name="login" placeholder="Логин администратора"  value="">
										</div>
									</div>

                  <div class="form-group">
                    <label>Введите имя <font color="red">*</font></label>
                    <div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-user"></i>
											</span>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Введите имя"  value="">
                    </div>
                  </div>
									
									<div class="form-group">
										<label>Пароль администратора <font color="red">*</font></label>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-lock"></i>
											</span>
											<input type="password" class="form-control" id="pass" name="pass" placeholder="Пароль администратора"  value="">
										</div>
									</div>
									<div class="form-group">
												<label>Выберите группу</label>
												<select class="form-control" name="group">
													<?foreach(selectAdminGroup() as $item_group){?>
														<option value="<?=$item_group["id"]?>"><?=$item_group["name"]?></option>
													<?}?>
												</select>
									</div>
                                    <div class="form-group">
                                        <label>Выберите регион</label>
                                        <select class="form-control" name="region[]" multiple>
                                            <?foreach(selectRegion() as $item_region){?>
                                                <option value="<?=$item_region["id"]?>"><?=$item_region["region"]?></option>
                                            <?}?>
                                        </select>
                                    </div>
								</div>
								
								<div class="form-actions">
									<button form="formAdmin" type="submit" class="btn green" name="submit">Сохранить</button>
								</div>
							</form>
						</div>
					</div>
			</div>
		<?}elseif($_GET["action"] == "edit"){
			$item_admin = selectAdminById($_GET["id"]);?>
			<div class="row">
					<div class="col-md-12">
						<div class="tabbable tabbable-custom">
							<h2>Карточка администратора...</h2>
							<br>
							<form role="form" action="" enctype="multipart/form-data" method="POST" name="formAdmin" id="formAdmin">
								<input name="func" type="hidden" value="userAdmin">
								<input name="id" type="hidden" value="<?=$_GET["id"]?>">
								<div class="form-body">
									<div class="form-group">
										<label>Логин администратора <font color="red">*</font></label>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-user"></i>
											</span>
											<input type="text" class="form-control" id="login" name="login" placeholder="Логин администратора"  value="<?=$item_admin["login"]?>">
										</div>
									</div>

                  <div class="form-group">
                    <label>Введите имя <font color="red">*</font></label>
                    <div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-user"></i>
											</span>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Введите имя"  value="<?=$item_admin["name"]?>">
                    </div>
                  </div>
									
									<div class="form-group">
										<label>Пароль администратора <font color="red">*</font></label>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-lock"></i>
											</span>
											<input type="password" class="form-control" id="pass" name="pass" placeholder="Пароль администратора"  value="">
										</div>
									</div>
									<div class="form-group">
												<label>Выберите группу</label>
												<select class="form-control" name="group">
													<?foreach(selectAdminGroup() as $items_group){?>
														<option value="<?=$items_group["id"]?>" <?if($items_group["id"] == $item_admin["id_group"]) echo "selected";?>><?=$items_group["name"]?></option>
													<?}?>
												</select>
									</div>
                                    <div class="form-group">
                                        <label>Выберите регион</label>
                                        <select class="form-control" name="region[]" multiple>
                                            <?foreach(selectRegion() as $item_region){?>
                                                <option value="<?=$item_region["id"]?>" <?if(in_array($item_region["id"], selectIdRegionUser($_GET["id"]))) echo "selected";?>><?=$item_region["region"]?></option>
                                            <?}?>
                                        </select>
                                    </div>
								</div>
								
								<div class="form-actions">
									<button form="formAdmin" type="submit" class="btn green" name="submit">Сохранить</button>
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
		
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>Управление администраторами
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse"></a>
					<a href="javascript:;" class="reload"></a>
				</div>
			</div>
			
			<div class="portlet-body">
				<div class="table-toolbar">
					<div class="btn-group">
						<button id="sample_editable_1_new" class="btn green" onClick='location.href="/adminius/index.php?code=adminUser&action=add"'>
						Добавить администратора <i class="fa fa-plus"></i>
						</button>
					</div>
				
					<div class="btn-group">
						<button id="sample_editable_1_new" class="btn green" onClick='location.href="/adminius/index.php?code=group"'>
						Управление группами <i class="fa fa-plus"></i>
						</button>
					</div>
          <div class="btn-group">
            <button id="sample_editable_1_new" class="btn green" onClick='location.href="/adminius/index.php?code=userWorkTime"'>
              Учет рабочего времени <i class="fa fa-clock-o"></i>
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
									<form action="/adminius/index.php" method="GET" style=" display: inline-table;">
										<input name="code" type="hidden" value="adminUser"/>
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
				
				<?$sAllAdministrator = selectAllAdministrator($page, $num, $search);
				if (!empty($sAllAdministrator)):?>
					<div class="table-scrollable">
						<table class="table table-striped table-bordered table-hover">
						<thead>
						<tr>
							<th>№</th>
							<th>Логин</th>
							<th>Имя</th>
							<th>Действия</th>
						</tr>
						</thead>
						<tbody>
						<?$n=1+$start;
							foreach ($sAllAdministrator as $item){?>
								<tr>
									<td><?=$n?></td>
									<td><?=$item['login']?></td>
									<td><?=$item['name']?></td>
									<td>
										<a class="btn btn-xs blue btn-editable" data-id="1" href="/adminius/index.php?code=adminUser&action=edit&id=<?=$item["id"]?>"><i class="fa fa-pencil"></i> Edit</a> 
											<?if($access["del"] == 1){?>
												<form action="" method="POST" name="delform<?=$item['id']?>" style="display:none;">
													<input name="func" type="hidden" value="userAdmin">
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
				<?else:?>
					<h3> К сожалению но слайдов нет :(<h3>
				<?endif;?>
				
			</div>
		</div>
	<?}?>
<?}else{?>
	<h3>Отказано в доступе, недостаточно прав.<h3>
<?}?>