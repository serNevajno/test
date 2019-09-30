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
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div id="sample_1_length" class="dataTables_length">
										<label>
											<select size="1" name="limit" aria-controls="sample_1"  class="form-control input-small" onchange='location.href="index.php?code=logs&limit="+this.value'>
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
													<input name="code" type="hidden" value="logs"/>
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
							<div class="table-scrollable">
							<table class="table table-striped table-bordered table-hover" id="sample_1">
								<thead>
									<tr>
										<th>№</th>
										<th>Действие</th>
										<th>Название</th>
										<th>Дата изменения</th>
										<th>Кем изменено</th>
										<th>IP</th>
									</tr>
								</thead>
								<tbody role="alert" aria-live="polite" aria-relevant="all">
									<?$select_logs = selectLogs($page, $num, $search);
									$n=1+$start;
									foreach ($select_logs as $item):?>
										<tr class="odd">
											<td class=" sorting_1"><?=$n?></td>
											<td class=""><?=$item["actions_log"]?></td>
											<td class=""><?=selectLogName($item["element_id"], $item["db"])?></td>
											<td class=""><?=$item["date"]?></td>
											<td class=""><?=$item["login"]?></td>
											<td class=""><?=$item["ip"]?></td>
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