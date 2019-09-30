<?if($access["invitations"] == 1){?>
	<?if (isset($_GET["action"])):?>
			<?if($_GET["action"] == "search"):?>
		<!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
			<?
				$num = 10;
				
				if (isset($_GET["page"])) {
					$page = clearData($_GET["page"], "i");
				}else{
					$page = 1;
				}
			?>
			<!-- BEGIN EXAMPLE TABLE PORTLET-->
							<div class="portlet box blue">
								<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-reorder"></i> Форма поиска
										</div>
								</div>
								<div class="portlet-body form">
									<form role="form" method="GET" action="/adminius/index.php">
										<input name="code" type="hidden" value="invitations">
										<input name="action" type="hidden" value="search">
										<div class="form-body">
											<div class="form-group">
												<label>Введите Email</label>
												<input type="text" name="email" class="form-control" placeholder="Введите Email" value="<?=$_GET["email"]?>">
											</div>
											<div class="form-group">
													ИЛИ
											</div>
											<div class="form-group">
												<label class="">Показать:</label>
												<div class="radio-list" style="padding-left:20px">
													<label class="radio-inline"><input type="radio" name="reg" value="all" checked> Все </label>
													<label class="radio-inline"><input type="radio" name="reg" value="1" <?if($_GET["reg"] == 1) echo "checked";?>> Не зарегистрированы </label>
													<label class="radio-inline"><input type="radio" name="reg" value="2" <?if($_GET["reg"] == 2) echo "checked";?>> Зарегистрированы </label>
												</div>
											</div>
											<div class="form-group">
												<label class="">Тип:</label>
												<div class="radio-list" style="padding-left:20px">
													<label class="radio-inline"><input type="radio" name="type" value="all" checked> Все </label>
													<label class="radio-inline"><input type="radio" name="type" value="1" <?if($_GET["type"] == 1) echo "checked";?>> Заказчик </label>
													<label class="radio-inline"><input type="radio" name="type" value="2" <?if($_GET["type"] == 2) echo "checked";?>> Строитель </label>
												</div>
											</div>
										</div>
										<div class="form-actions">
											<button type="submit" class="btn blue">Поиск</button>
										</div>
									</form>
								</div>
								<div class="portlet-body">
									<table class="table table-striped table-bordered table-hover" id="sample_1">
										<thead>
											<tr>
												<th>№</th>
												<th>Email</th>
												<th>Дата</th>
												<th>Тип</th>
												<th>Зарегистрирован</th>
												<th>Текст</th>
												<th>Отправил</th>
												<th>Действия</th>
											</tr>
										</thead>
										<tbody role="alert" aria-live="polite" aria-relevant="all">
											<?$n=1+$start;
											foreach (selectInvitationsSearch($num, $page, $_GET["reg"], $_GET["email"], $_GET["type"]) as $itemSearch):
												?>
												<tr class="odd">
													<td class=" sorting_1"><?=$n?></td>
													<td class=""><?=$itemSearch["email"]?></td>
													<td class=""><?=$itemSearch["date"]?></td>
													<td class=""><?if($itemSearch["type"] == 1){?>Заказчик<?}elseif($itemSearch["type"] == 2){?>Строитель<?}?></td>
													<td class=""><?if($itemSearch["id_user"]>0){?><a href="/adminius/index.php?code=users&action=detail&id=<?=$itemSearch["id_user"]?>">Пользователь №<?=$itemSearch["id_user"]?></a><?}else{echo "Нет";}?></td>
													<td class=""><?=$itemSearch["text"]?></td>
													<td class=""><?=$itemSearch["login"]?></td>
													<td class="">
														<?if($access["del"] == 1){?>
															<form action="index.php" method="POST" name="delform<?=$itemSearch['id']?>" style="display:none;">
																<input name="func" type="hidden" value="invitations">
																<input name="id" type="hidden" value="<?=$itemSearch['id']?>">
															</form>
															<a class="btn btn-xs red btn-removable" data-id="1" href="javascript:if(confirm('Вы уверены?')){delform<?=$itemSearch['id']?>.submit();}"><i class="fa fa-times"></i> Delete</a>
														<?}?>
													</td>
												</tr>
												<?$n++;?>
											<?endforeach;?>
										</tbody>
									</table>
									<?include($_SERVER['DOCUMENT_ROOT'].'/adminius/templates/pagenav.tpl.php');?>
								</div>
							</div>
		<!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
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
									<button class="btn blue" onClick='location.href="/adminius/index.php?code=invitations&action=search"'><font>Все предложения</font></button>
								</div>
								<?=$mes;?>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
										<div class="tabbable tabbable-custom boxless">
											<form action="/adminius/index.php?code=invitations" method="POST">
												<input type="hidden" name="func" value="invitations">
												<div class="form-body">
													<div class="radio-list">
														<label class="radio-inline">
															Отправить рассылку заказчикам:&nbsp; <input type="radio" value="1" name="type">
														</label>
														<label class="radio-inline" style="padding-left: 0px; margin-left: 0px">
														 | 
														Отправить рассылку строителям:&nbsp;  <input type="radio" value="2" name="type">
														</label>
													</div>
													<div class="form-group">
															<label>Введите email</label>
															<textarea class="form-control" rows="5" name="email"></textarea>
													</div>
												</div>
												<button type="submit" class="btn blue" name="submit">Отправить</button>
											</form>
										</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
										<form action="" method="POST" id="mailMassege">
											<input type="hidden" name="func" value="invitations_text">
											<label>Текст письма для заказчиков: </label>
											<textarea name="text_message" id="text_message" cols="60" rows="10"><?=textInvitations("text");?></textarea>
											<script type="text/javascript">
												 CKEDITOR.replace( 'text_message',{
												toolbar : 'Basic'
											   });
											</script>
										</form>
										<br>
										<button form="mailMassege" type="submit" class="btn green" name="submit">Обновить текст письма</button>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
										<form action="" method="POST" id="mailMassegeStroy">
											<input type="hidden" name="func" value="invitations_text">
											<label>Текст письма для строителей: </label>
											<textarea name="text_message_stroy" id="text_message_stroy" cols="60" rows="10"><?=textInvitations("text_two");?></textarea>
											<script type="text/javascript">
												 CKEDITOR.replace( 'text_message_stroy',{
												toolbar : 'Basic'
											   });
											</script>
										</form>
										<br>
										<button form="mailMassegeStroy" type="submit" class="btn green" name="submit2">Обновить текст письма</button>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<form action="" method="POST" id="promoCode">
												<input type="hidden" name="func" value="promo_code">
												<label>Промокод: </label>
												<div class="input-group">
													<input type="text" name="promo_code"  class="form-control" value="<?=selectPromoCode();?>">
												</div>
											</form>
											<br>
											<button form="promoCode" type="submit" class="btn green" name="submit2">Обновить промокод</button>
										</div>
									</div>
								</div>	
							</div>
						</div>
						<!-- END EXAMPLE TABLE PORTLET-->
	<?endif;?>
<?}else{?>
	<h3>Отказано в доступе, недостаточно прав.<h3>
<?}?>