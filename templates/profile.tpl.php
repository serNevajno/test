<?$sUser = selectUserID();?>
<div id="wrap-body" class="p-t-lg-30">
	<div class="container">
		<div class="wrap-body-inner">
			<!-- Breadcrumb-->
			<?include($_SERVER['DOCUMENT_ROOT']).'/templates/breadcrumbs.tpl.php';?>
			<!-- Car detail -->
			<section class="m-t-lg-30 m-t-xs-0">
				<!-- Car description tabs -->
				<div class="row m-t-lg-30 m-b-lg-50">
					<?include($_SERVER['DOCUMENT_ROOT']).'/templates/left_col.account.tpl.php';?>
					<div class="col-md-9">
						<!-- Technical Specifications -->
						<div class="m-b-lg-0">
							<div class="heading-1"><h3><?=$meta_item["name"]?> - <?=$sUser['name']?></h3></div>
							<div class="bg-gray-fa bg1-gray-2 p-lg-30 p-xs-15">
								<input type="hidden" value="<?=$sUser['id']?>" id="id_user">
								<ul class="product_para-1">
									<li>
										<span>Имя :</span>
										<input id="name" type="text" value="<?=$sUser['name']?>" class="form-control form-item" style="width:50%;" placeholder="Имя">
									</li>
									<?/*?><li>
										<span>Дата рождения :</span>
										<input id="date_birth" type="text" value="<?=$sUser['date_birth']?>" class="form-control form-item" style="width:50%;" placeholder="Дата рождения">
									</li>
									<li>
										<span>Пол :</span>
										<select class="form-control form-item" style="width:50%;" id="sex">
										 <option value='0'>Выбирите пол</option>
										 <option value='1' <?if ($sUser["sex"] == 1){?>selected<?}?>>Мужчина</option>
										 <option value='2' <?if ($sUser["sex"] == 2){?>selected<?}?>>Женщина</option>
										</select>
									</li><?*/?>
									<li>
										<span>Телефон :</span>
										<input id="phone" type="text" value="<?=$sUser['phone']?>" class="form-control form-item" style="width:50%;" placeholder="Телефон">
									</li>
									<li>
										<span>Email :</span>
										<input id="email" type="text" value="<?=$sUser['email']?>" class="form-control form-item" style="width:50%;" placeholder="Email">
									</li>
									<?/*?><li>
										<span>Страна :</span>
											<select class="form-control form-item" style="width:50%;" id="country">
												<option value="0">Выбирите страну</option>
												<?foreach(selectCountry() as $iCountry){?>
													<option value="<?=$iCountry['id']?>" <?if($sUser['id_country'] == $iCountry['id']){echo "selected";}?>><?=$iCountry['country']?></option>
												<?}?>
											</select>
									</li>
									<li>
										<span>Город :</span>
										<input id="city" type="text" value="<?=$sUser['city']?>" class="form-control form-item" style="width:50%;" placeholder="Город">
									</li>
									<li>
										<span>Адрес :</span>
										<input id="address" type="text" value="<?=$sUser['address']?>" class="form-control form-item" style="width:50%;" placeholder="Адрес">
									</li><?*/?>
									<li>
										<span style="width:50%;">Хочу получать информацию об акциях и скидках </span>
										<input id="info" type="checkbox" value="1" class="form-control form-item" style="width:10%; height: 15px;" <?if($sUser['info'] == '1') echo "checked";?>>
									</li>
									<li>
										<div id="error_pass"></div>
										<span>Пароль :<br>
											<p style="font-size:10px;"> <i class="fa fa-info"></i> Если вы желаете изменить пароль заполните поле </p>
										</span>
										<input id="password" type="text" value="" class="form-control form-item" style="width:50%;" placeholder="Если вы желаете изменить пароль заполните поле">
									</li>
								</ul>
								<a onClick="userEdit()" class="ht-btn ht-btn-default" style="width:100%; text-align: center;cursor:pointer;">Сохранить</a>
							</div>
							<?include($_SERVER['DOCUMENT_ROOT']).'/templates/form/modalUpdateUser.tpl.php';?>
						</div>
					</div>
					
				</div>	
			</section>
		</div>
	</div>
</div>