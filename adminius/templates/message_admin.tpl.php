<? if ($access[$_GET['code']] == 1) { ?>
  <? if ($_GET["action"] == "detail") { ?>
    <? if (isset($_GET["email"])) { ?>
      <!-- BEGIN EXAMPLE TABLE PORTLET-->
      <style>
        .form-control-static {
				padding-top: 0px;
        }
			</style>
      <div class="portlet box blue">
        <div class="portlet-title">
          <div class="tools">
					</div>
				</div>
				
        <div class="portlet-body">
          <div class="table-scrollable">
            <table class="table table-striped table-bordered table-hover" id="sample_1">
              <thead>
								<tr>
									<th>№</th>
									<th>Email</th>
									<th>Телефон</th>
									<th>Сообщение</th>
									<th>Дата</th>
								</tr>
							</thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
								<? $n = 1;
									foreach (selectMessageAdminByEmail($_GET["email"]) as $item) {
									?>
									<tr class="odd">
										<td>
											<?= $n ?>
										</td>
										<td class="">
											<? if ($item["id_user"] == 1) {
											?>
                      Администратор
											<? } else {
											?>
                      <?= $item["email"] ?>
											<? } ?>
										</td>
										<td style="white-space: normal;"><?= $item["phone"] ?></td>
										<td style="white-space: normal;"><?= $item["message"] ?></td>
										<td class=""><?= $item["date"] ?></td>
									</tr>
									<? $n++;
									} ?>
							</tbody>
						</table>
					</div>
          <div class="form-actions">
            <form action="" enctype="multipart/form-data" method="POST" name="adminMessage" id="adminMessage">
              <input name="func" type="hidden" value="message_admin">
              <input name="email" type="hidden" value="<?= $_GET["email"] ?>">
              <textarea class="form-control" rows="5" name="message"></textarea>
						</form>
            <br>
            <button class="btn red" onclick="location='<?= $_SERVER['HTTP_REFERER'] ?>'">Назад</button>
            <button form="adminMessage" type="submit" class="btn green" name="submit">Ответить</button>
					</div>
				</div>
			</div>
      <!-- END EXAMPLE TABLE PORTLET-->
			<? } else { ?>
      <?
				upReadMessageByUser($_GET["id"]);
				$num = 10;
				
				if (isset($_GET["page"])) {
					$page = clearData($_GET["page"], "i");
					} else {
					$page = 1;
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
            <div class="btn-group">
              <a href="/adminius/index.php?code=users&action=detail&id=<?= $_GET["id"] ?>">Пользователь
							№<?= $_GET["id"] ?></a>
						</div>
					</div>
          <div class="table-scrollable">
            <table class="table table-striped table-bordered table-hover" id="sample_1">
              <thead>
								<tr>
									<th>№</th>
									<th>От кого</th>
									<th>Сообщение</th>
									<th>Дата</th>
								</tr>
							</thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
								<?
									$n = 1;
									foreach (selectMessageAdminByUser($page, $num, $_GET["id"]) as $item) {
									?>
									<tr class="odd">
										<td>
											<?= $n ?>
										</td>
										<td class="">
											<?= $item["name"] ?> <?= $item["last_name"] ?>
										</td>
										<td style="white-space: normal;"><?= $item["message"] ?></td>
										<td class=""><?= $item["date"] ?></td>
									</tr>
									<? $n++;
									} ?>
							</tbody>
						</table>
					</div>
          <div class="form-actions">
            <form action="" enctype="multipart/form-data" method="POST" name="adminMessage" id="adminMessage">
              <input name="func" type="hidden" value="message_admin">
              <input name="id" type="hidden" value="<?= $_GET["id"] ?>">
              <textarea class="form-control" rows="5" name="message"></textarea>
              <br>
						</form>
            <button class="btn red" onclick="location='<?= $_SERVER['HTTP_REFERER'] ?>'">Назад</button>
            <button form="adminMessage" type="submit" class="btn green" name="submit">Ответить</button>
					</div>
          <? include($_SERVER['DOCUMENT_ROOT'] . '/adminius/templates/pagenav.tpl.php'); ?>
				</div>
			</div>
      <!-- END EXAMPLE TABLE PORTLET-->
		<? } ?>
		<? } else { ?>
    <?
			upMessages();
			$num = 10;
			
			if (isset($_GET["page"])) {
				$page = clearData($_GET["page"], "i");
				} else {
				$page = 1;
			}
		?>
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet box blue">
      <div class="portlet-title">
        <div class="tools">
				</div>
			</div>
      <div class="portlet-body form">
        <form role="form" method="GET" action="" id="formDatas">
          <input name="code" type="hidden" value="message_admin">
          <div class="form-body">
            <div class="form-group">
              <div id="sample_1_length" class="dataTables_length">
                <label>Выберите дату:</label>
                <div class="col-md-4" style="width: auto;">
                  <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012"
									data-date-format="yyyy-mm-dd">
                    <input type="text" class="form-control" name="from" value="<?= $_GET["from"] ?>">
                    <span class="input-group-addon">
											по
										</span>
                    <input type="text" class="form-control" name="to" value="<?= $_GET["to"] ?>">
									</div>
                  <!-- /input-group -->
								</div>
							</div>
              <button type="submit" class="btn blue">Поиск</button>
						</div>
					</div>
				</form>
			</div>
      <div class="portlet-body">
        <div class="table-toolbar">
          <div class="btn-group">
						
					</div>
				</div>
        <form action="" enctype="multipart/form-data" method="POST" name="adminMessage" id="adminMessage">
          <input name="func" type="hidden" value="message_admin">
          <div class="table-scrollable">
            <table class="table table-striped table-bordered table-hover" id="sample_1">
              <thead>
								<tr>
									<th>№</th>
									<th>От кого</th>
									<th>Сообщение</th>
									<th>Дата</th>
									<? /*<th>Действия</th>*/ ?>
									<th>Удалить</th>
								</tr>
							</thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
								
								<?
									$n = 1;
									foreach (selectMessage($page, $num, $_GET["to"], $_GET["from"]) as $item) {
									?>
									<tr class="odd">
										<td>
											<?= $n ?>
										</td>
										<td class="">
											Имя: <?= $item['name'] ?><br>
											телефон: <?= $item['phone'] ?><br>
											email: <?= $item['email'] ?>
											
										</td>
										<td style="white-space: normal;">
											<p>
												<b>VIN-код:</b> 
												<?=$item['vin']?>
											</p>
											<p>
												<b>Автомобиль:</b> 
												<?=$item['marka']?> | <?=$item['model']?> | <?=$item['year']?> | <?=$item['modifay']?>
											</p>
											<b>Сообщение:</b> 
											<?= $item["message"] ?>
										</td>
										<td class=""><?= $item["date"] ?></td>
										
										<td>
											<input type="checkbox" name="del_message[]" value="<?= $item["id"] ?>" title="Удалить">
										</td>
										
									</tr>
									<? $n++;
									} ?>
							</tbody>
						</table>
					</div>
				</form>
        <div class="form-actions">
          <button form="adminMessage" type="submit" class="btn green" name="submit">Удалить отмеченное</button>
          <? /*<button type="button" class="btn red" onClick='location.href="/adminius/"'>Выйти</button>*/ ?>
				</div>
        <? include($_SERVER['DOCUMENT_ROOT'] . '/adminius/templates/pagenav.tpl.php'); ?>
			</div>
		</div>
		
    <!-- END EXAMPLE TABLE PORTLET-->
	<? } ?>
	<? } else { ?>
  <h3>Отказано в доступе, недостаточно прав.<h3>
	<? } ?>	