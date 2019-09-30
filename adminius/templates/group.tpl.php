<?if($access["admin"] == 1){?>
	<?if(isset($_GET["action"])){?>
		<?if($_GET["action"] == "add"){?>
			<div class="row">
					<div class="col-md-12">
						<div class="tabbable tabbable-custom">
							<h2>Добавление группы...</h2>
							<br>
							<form role="form" action="" enctype="multipart/form-data" method="POST" name="formAdmin" id="formAdmin">
								<input name="func" type="hidden" value="group">
								
								<div class="form-body">
									<div class="form-group">
										<label>Название группы <font color="red">*</font></label>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-user"></i>
											</span>
											<input type="text" class="form-control" name="name" placeholder="Название группы"  value="">
										</div>
									</div>

                  <div class="row">
                    <?foreach (selectAdminGroupById(1) as $key => $val ){
                      switch ($key){
                        case "admin": $nameSection = 'Управление администраторами'; break;
                        case "banner": $nameSection = 'Управление баннерами'; break;
                        case "users": $nameSection = 'Управление пользователями'; break;
                        case "sections": $nameSection = 'Управление страницами'; break;
                        case "product": $nameSection = 'Управление товарами'; break;
                        case "extra_charge": $nameSection = 'Управление наценками'; break;
                        case "orders": $nameSection = 'Управление заказами'; break;
                        case "message_admin": $nameSection = 'Управление заявками на запчасти'; break;
                        case "settings": $nameSection = 'Управление настройками'; break;
                        case "blog": $nameSection = 'Управление блогом'; break;
                        case "slider": $nameSection = 'Управление слайдером'; break;
                        case "del": $nameSection = 'Удаление'; break;
                        case "finance": $nameSection = 'Управление финансами'; break;
                        case "xml": $nameSection = 'Прайс для ЯМ'; break;
                        case "xmlAUTORU": $nameSection = 'Прайс для AUTORU'; break;
                        case "xmlClient": $nameSection = 'Прайс для клиента'; break;
                        case "goods_movement": $nameSection = 'Движение товара'; break;
                        default: $nameSection = 'No name section'; break;
                      }
                      if($key != 'id' AND $key != 'name' AND $key != 'logs' AND $key != 'banner'){?>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label><b><?=$nameSection?></b></label>
                            <select class="form-control" name="<?=$key?>" id="<?=$key?>">
                              <option value="0" >Закрыт</option>
                              <option value="1" >Открыт</option>
                            </select>
                          </div>
                        </div>
                      <?}}?>
                  </div>

													<!--<div class="form-group">
														<label><b>Управление администраторами</b></label>
														<select class="form-control" name="admin" id="admin">
																<option value="0">Закрыт</option>
																<option value="1">Открыт</option>
														</select>
													</div>
													<div class="form-group">
														<label>Баннер</label>
														<select class="form-control" name="banner">
																<option value="0">Закрыт</option>
																<option value="1">Открыт</option>
														</select>
													</div>
													<div class="form-group">
														<label>Пользователи</label>
														<select class="form-control" name="users">
																<option value="0">Закрыт</option>
																<option value="1">Открыт</option>
														</select>
													</div>
													<div class="form-group">
														<label>Страницы</label>
														<select class="form-control" name="sections">
																<option value="0">Закрыт</option>
																<option value="1">Открыт</option>
														</select>
													</div>
													<div class="form-group">
														<label>Товары</label>
														<select class="form-control" name="product">
																<option value="0">Закрыт</option>
																<option value="1">Открыт</option>
														</select>
													</div>
													<div class="form-group">
														<label>Наценка</label>
														<select class="form-control" name="extra_charge">
																<option value="0">Закрыт</option>
																<option value="1">Открыт</option>
														</select>
													</div>
													<div class="form-group">
														<label>Заказы</label>
														<select class="form-control" name="orders">
																<option value="0">Закрыт</option>
																<option value="1">Открыт</option>
														</select>
													</div>
													<div class="form-group">
														<label>Cообщение администрации</label>
														<select class="form-control" name="message_admin">
																<option value="0">Закрыт</option>
																<option value="1">Открыт</option>
														</select>
													</div>
													<div class="form-group">
														<label>Настройки</label>
														<select class="form-control" name="settings">
																<option value="0">Закрыт</option>
																<option value="1">Открыт</option>
														</select>
													</div>
													<div class="form-group">
														<label>Блог</label>
														<select class="form-control" name="blog">
																<option value="0">Закрыт</option>
																<option value="1">Открыт</option>
														</select>
													</div>
													<div class="form-group">
														<label>Слайдер</label>
														<select class="form-control" name="slider">
																<option value="0">Закрыт</option>
																<option value="1">Открыт</option>
														</select>
													</div>
													<div class="form-group">
														<label>Удаление</label>
														<select class="form-control" name="del">
																<option value="0">Запрещено</option>
																<option value="1">Разрешено</option>
														</select>
													</div>-->


								</div>
								
								<div class="form-actions">
									<button form="formAdmin" type="submit" class="btn green" name="submit">Сохранить</button>
								</div>
							</form>
						</div>
					</div>
			</div>
		<?}elseif($_GET["action"] == "edit"){
			$item_admin = selectAdminGroupById($_GET["id"]);?>
			<div class="row">
					<div class="col-md-12">
						<div class="tabbable tabbable-custom">
							<h2>Добавление группы...</h2>
							<br>
							<form role="form" action="" enctype="multipart/form-data" method="POST" name="formAdmin" id="formAdmin">
								<input name="func" type="hidden" value="group">
								<input name="id" type="hidden" value="<?=$_GET["id"]?>">
								<div class="form-body">
									<div class="form-group">
										<label>Название группы <font color="red">*</font></label>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-user"></i>
											</span>
											<input type="text" class="form-control" name="name" placeholder="Название группы"  value="<?=$item_admin["name"]?>">
										</div>
									</div>

                  <div class="row">
                    <?foreach ($item_admin as $key => $val ){
                      switch ($key){
                        case "admin": $nameSection = 'Управление администраторами'; break;
                        case "banner": $nameSection = 'Управление баннерами'; break;
                        case "users": $nameSection = 'Управление пользователями'; break;
                        case "sections": $nameSection = 'Управление страницами'; break;
                        case "product": $nameSection = 'Управление товарами'; break;
                        case "extra_charge": $nameSection = 'Управление наценками'; break;
                        case "orders": $nameSection = 'Управление заказами'; break;
                        case "message_admin": $nameSection = 'Управление заявками на запчасти'; break;
                        case "settings": $nameSection = 'Управление настройками'; break;
                        case "blog": $nameSection = 'Управление блогом'; break;
                        case "slider": $nameSection = 'Управление слайдером'; break;
                        case "del": $nameSection = 'Удаление'; break;
                        case "finance": $nameSection = 'Управление финансами'; break;
                        case "xml": $nameSection = 'Прайс для ЯМ'; break;
                        case "xmlAUTORU": $nameSection = 'Прайс для AUTORU'; break;
                        case "xmlClient": $nameSection = 'Прайс для клиента'; break;
                        case "goods_movement": $nameSection = 'Движение товара'; break;
                        default: $nameSection = 'No name section'; break;
                      }
                      if($key != 'id' AND $key != 'name' AND $key != 'logs' AND $key != 'banner'){?>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label><b><?=$nameSection?></b></label>
                          <select class="form-control" name="<?=$key?>" id="<?=$key?>">
                            <option value="0" <?if($val == 0) echo "selected";?>>Закрыт</option>
                            <option value="1" <?if($val == 1) echo "selected";?>>Открыт</option>
                          </select>
                        </div>
                      </div>
                    <?}}?>
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
						<button id="sample_editable_1_new" class="btn green" onClick='location.href="/adminius/index.php?code=group&action=add"'>
						Добавить группу <i class="fa fa-plus"></i>
						</button>
					</div>
				</div>	
				<?$sGroupAdmin = selectGroupAdmin();
				if (!empty($sGroupAdmin)):?>
					<div class="table-scrollable">
						<table class="table table-striped table-bordered table-hover">
						<thead>
						<tr>
							<th>№</th>
							<th>Логин</th>
							<th>Действия</th>
						</tr>
						</thead>
						<tbody>
						<?$n=1+$start;
							foreach ($sGroupAdmin as $item){?>
								<tr>
									<td><?=$n?></td>
									<td><?=$item['name']?></td>
									<td>		
										<a class="btn btn-xs blue btn-editable" data-id="1" href="/adminius/index.php?code=group&action=edit&id=<?=$item["id"]?>"><i class="fa fa-pencil"></i> Edit</a> 
											<?if($item['id'] != 1 AND $access["del"] == 1){?>
												<form action="" method="POST" name="delform<?=$item['id']?>" style="display:none;">
													<input name="func" type="hidden" value="group">
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
				<?else:?>
					<h3> К сожалению но групп нет :(<h3>
				<?endif;?>
				
			</div>
		</div>
	<?}?>
<?}else{?>
	<h3>Отказано в доступе, недостаточно прав.<h3>
<?}?>