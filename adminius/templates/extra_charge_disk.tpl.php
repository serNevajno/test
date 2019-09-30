<?if($access["extra_charge"] == 1){?>
	<?if (isset($_GET["action"])){?>
		<?if($_GET["action"] == "add"){?>
			<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">
						<div class="tabbable tabbable-custom">
							<h2>Добавление наценки..</h2>
							<br>
							<form role="form" action="" enctype="multipart/form-data" method="POST" name="form" id="myForm">
								<input name="func" type="hidden" value="extra_charge">
								<input name="type" type="hidden" value="2">
										<div class="form-body">
														<div class="form-group">
																<label>Бренд: <font color="red">*</font></label>	
																<select name="brand" class="form-control input-medium" required>
																	<?foreach (selectDiskBrand() as $iBrand){?>
																		<option value="<?=$iBrand["id"]?>"><?=$iBrand["name"]?></option>
																	<?}?>
																</select>
														</div>
														<div class="form-group">
																<label>Диаметр: <font color="red">*</font></label>	
																<select name="diameter" class="form-control input-medium" required>
																	<option value="0">Все</option>
																	<?foreach (selectValueFilter('25') as $iDiameter){?>
																		<option value="<?=$iDiameter["id"]?>">R<?=$iDiameter["value"]?></option>
																	<?}?>
																</select>
														</div>									
														
														<div class="form-group">
															<label>Введите наценку <font color="red">*</font></label>
															<div class="input-group">
																<span class="input-group-addon">
																	<i class="fa fa-reorder"></i>
																</span>
																<input type="text" class="form-control input-small" name="percent" placeholder="%" required>
															</div>
														</div>
										</div>
								<div class="form-actions">
									<button type="submit" class="btn blue" name="submit">Сохранить</button>
									<button type="button" class="btn red" onClick='location.href="/adminius/index.php?code=extra_charge_disk"'>Отмена</button>
								</div>
							</form>
						</div>
					</div>
				</div>
		<?}elseif($_GET["action"] == "edit"){?>
			<?$sExtraCharge = selectExtraChargeById($_GET["id"]);?>
				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">
						<div class="tabbable tabbable-custom">
							<h2>Редактирование наценки..</h2>
							<br>
							<form role="form" action="" enctype="multipart/form-data" method="POST" name="form" id="myForm">
								<input name="func" type="hidden" value="extra_charge">
								<input name="type" type="hidden" value="2">
								<input name="id" type="hidden" value="<?=$_GET["id"]?>">
										<div class="form-body">
														<div class="form-group">
																<label>Бренд: <font color="red">*</font></label>	
																<select name="brand" class="form-control input-medium" required>
																	<?foreach (selectDiskBrand() as $iBrand){?>
																		<option value="<?=$iBrand["id"]?>" <?if($sExtraCharge["brand"] == $iBrand["id"]) echo "selected";?>><?=$iBrand["name"]?></option>
																	<?}?>
																</select>
														</div>
														<div class="form-group">
																<label>Диаметр: <font color="red">*</font></label>	
																<select name="diameter" class="form-control input-medium" required>
																	<option value="0">Все</option>
																	<?foreach (selectValueFilter('25') as $iDiameter){?>
																		<option value="<?=$iDiameter["id"]?>" <?if($sExtraCharge["diameter"] == $iDiameter["id"]) echo "selected";?>>R<?=$iDiameter["value"]?></option>
																	<?}?>
																</select>
														</div>
														
														<div class="form-group">
															<label>Введите наценку <font color="red">*</font></label>
															<div class="input-group">
																<span class="input-group-addon">
																	<i class="fa fa-reorder"></i>
																</span>
																<input type="text" class="form-control input-small" name="percent" placeholder="%" value="<?=$sExtraCharge["percent"]?>" required>
															</div>
														</div>
										</div>
								<div class="form-actions">
									<button type="submit" class="btn blue" name="submit">Сохранить</button>
									<button type="button" class="btn red" onClick='location.href="/adminius/index.php?code=extra_charge_disk"'>Отмена</button>
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
				</div>
				<div class="portlet-body">
					<div class="table-toolbar">
						<div class="btn-group">
							<button id="sample_editable_1_new" class="btn green" onClick='location.href="/adminius/index.php?code=extra_charge_disk&action=add"'>
							Добавить <i class="fa fa-plus"></i>
							</button>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2 col-sm-12">
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
						<div class="col-md-2 col-sm-12">
							<div id="sample_1_length" class="dataTables_length">
								<label>
									<select size="1" name="brand" aria-controls="sample_1"  class="form-control input-small" onchange='location.href="index.php?code=<?=$_GET['code']?><?if($_GET['diameter']){?>&diameter=<?=$_GET['diameter']?><?}?><?if($_GET['page']){?>&page=<?=$_GET['page']?><?}?>&brand="+this.value'>
										<option value="">Все</option>
										<?foreach (selectDiskBrand() as $iBrand){?>
											<option value="<?=$iBrand["id"]?>" <?if($iBrand["id"] == $_GET["brand"]) echo "selected='selected'";?>><?=$iBrand["name"]?></option>
										<?}?>
									</select>
								</label>
							</div>
						</div>
						<div class="col-md-2 col-sm-12">
							<div id="sample_1_length" class="dataTables_length">
								<label>
									<select size="1" name="diameter" aria-controls="sample_1"  class="form-control input-small" onchange='location.href="index.php?code=<?=$_GET['code']?><?if($_GET['brand']){?>&brand=<?=$_GET['brand']?><?}?><?if($_GET['page']){?>&page=<?=$_GET['page']?><?}?>&diameter="+this.value'>
										<option value="">Все</option>
											<?foreach (selectValueFilter('25') as $iDiameter){?>
											<option value="<?=$iDiameter["id"]?>" <?if($iDiameter["id"] == $_GET["diameter"]) echo "selected='selected'";?>>R<?=$iDiameter["value"]?></option>
										<?}?>
									</select>
								</label>
							</div>
						</div>
						<div class="col-md-4 col-sm-12">
							<form action="index.php" method="POST" name="basePercent">
								<input name="func" type="hidden" value="base_percent">
								<input name="type" type="hidden" value="2">
								<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Базовая наценка</span>
											<input type="text" class="form-control input-small" name="percent" placeholder="%" value="<?=selectBasePercent("2");?>">
											<a class="btn btn-xs blue btn-editable" href="javascript:basePercent.submit();"><i class="fa fa-upload"></i></a> 
										</div>
								</div>
							</form>
						</div>
					</div>
					<?$sExtraCharge = selectExtraChargeDisk($page, $num, $_GET["brand"], $_GET["diameter"]);
					if (!empty($sExtraCharge)):?>
						<div class="table-scrollable">
							<table class="table table-striped table-bordered table-hover">
							<thead>
							<tr>
								<th>№</th>
								<th>Бренд</th>
								<th>Диаметр</th>
								<th>Наценка</th>
								<th>Действия</th>
							</tr>
							</thead>
							<tbody>
							<?$n=1+$start;
								foreach ($sExtraCharge as $item){?>
									<tr>
										<td><?=$n?></td>
										<td><a href="/adminius/index.php?code=extra_charge_disk&action=edit&id=<?=$item["id"]?>"><?=$item['brand']?></a></td>
										<td><?if($item['diameter']>0){ echo $item['diameter']."R";}else{echo "Все";}?></td>
										<td><?=$item['percent']?>%</td>
										<td>
											<a class="btn btn-xs blue btn-editable" data-id="1" href="/adminius/index.php?code=extra_charge_disk&action=edit&id=<?=$item["id"]?>"><i class="fa fa-pencil"></i> Edit</a> 
											<?if($access["del"] == 1){?>
												<form action="index.php" method="POST" name="delform<?=$item['id']?>" style="display:none;">
													<input name="func" type="hidden" value="extra_charge">
													<input name="id" type="hidden" value="<?=$item['id']?>">
													<input name="type" type="hidden" value="2">
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
						<h3> К сожалению но наценок нет :(<h3>
					<?endif;?>
				</div>
			</div>
			<!-- END SAMPLE TABLE PORTLET-->
	<?}?>
<?}else{?>
	<h3>Отказано в доступе, недостаточно прав.<h3>
<?}?>		