<?if($access["settings"] == 1){?>
	<?
		$sSett = selectSettings();
		$sSoc = selectSocialNet();
	?>
	<script type="text/javascript">
		function checkForm() {
			//var phone = document.getElementById("phone");
			var email = document.getElementById("email");
			//if (!phone.value) {alert('Введите телефон');return false;}
			if (!email.value) {alert('Введите email');return false;}			
		}
		window.onload = function () {
			var form = document.getElementById("myForm");
			form.onsubmit = checkForm
		}
	</script>
	<!-- BEGIN PAGE CONTENT-->
	<div class="row">
		<div class="col-md-12">
			<div class="tabbable tabbable-custom boxless">
				<h2>Настройки сайта</h2>
        <div class="table-toolbar">
          <div class="btn-group">
            <button id="sample_editable_1_new" class="btn green" onClick='location.href="/adminius/index.php?code=office"'> Доп офисы <i class="fa fa-plus"></i>
            </button>
			 <button id="sample_editable_1_new" class="btn green" onClick='location.href="/adminius/index.php?code=textStatus"' style="margin-left: 10px;"> Тексты статусов <i class="fa fa-plus"></i>
              </button>
              <button id="sample_editable_1_new" class="btn green" onClick='location.href="/adminius/index.php?code=templatesSms"' style="margin-left: 10px;"> Шаблоны смс <i class="fa fa-plus"></i>
              </button>
          </div>
        </div>
				<br />
				<form role="form" action="index.php" enctype="multipart/form-data" method="POST" name="form" id="myForm">
					<input name="func" type="hidden" value="settings">
					<div class="tab-content">
						<div class="col-md-12">
							<div class="make-switch switch-large has-switch">
								<label>Вкл / Выкл</label>
								<div class="switch-on switch-animate">
									<input type="checkbox" class="toggle" name="active" value="1" <?if ($sSett["active"] == 1){?>checked<?}?>>
								</div>
							</div>
						</div>
						<br />
						<div class="col-md-6">
							<div class="form-group">
								<label>Введите телефон<font color="red">*</font></label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-reorder"></i>
									</span>
									<input type="text" placeholder="Телефон" name="phone" id="phone" class="form-control"  value="<?=$sSett["phone"]?>">
								</div>
							</div>
							<div class="form-group">
								<label>email администрации<font color="red">*</font></label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-reorder"></i>
									</span>
									<input type="text" placeholder="email администрации" name="email" id="email" class="form-control"  value="<?=$sSett["email"]?>">
								</div>
							</div>
							<div class="form-group">
								<label>email заказа деталей<font color="red">*</font></label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-reorder"></i>
									</span>
									<input type="text" placeholder="email заказа деталей" name="emailTwo" id="emailTwo" class="form-control"  value="<?=$sSett["emailTwo"]?>">
								</div>
							</div>
							<div class="form-group">
								<label>Адрес компании</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-cogs"></i>
									</span>
									<input type="text" placeholder="Адрес компании" name="addres" id="addres" class="form-control"  value="<?=$sSett["addres"]?>">
								</div>
							</div>
							<div class="form-group">
								<label>Время работы компании</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-cogs"></i>
									</span>
									<input type="text" placeholder="Время работы компании" name="time_work" id="time_work" class="form-control"  value="<?=$sSett["time_work"]?>">
								</div>
							</div>
                            <div class="form-group">
                                <label>Время отображения текста(09:00 - 20:00, 0-круглосуточно)</label>
                                <div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-cogs"></i>
									</span>
                                    <input type="text" placeholder="Время работы компании" name="time_pop" id="time_pop" class="form-control"  value="<?=$sSett["time_pop"]?>">
                                </div>
                            </div>
							<div class="form-group">
								<label>Текст после рабочего времени</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-cogs"></i>
									</span>
									<input type="text" placeholder="Время работы компании" name="work_text" id="work_text" class="form-control"  value="<?=$sSett["work_text"]?>">
								</div>
							</div>
							<div class="form-group">
								<label>Карта</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-map-marker"></i>
									</span>
									<textarea type="text" placeholder="Карта" name="maps" id="maps" class="form-control"><?=$sSett["maps"]?></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<h3>Социльные сети</h3>
							<div class="form-group" id="photo">
								<?foreach ($sSoc as $items){?>
									<div class="row">
										<div class="col-md-5">
											<label>Введите название соц.сети (пример: facebook)</label>
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-reorder"></i>
												</span>
												<input type="text" placeholder="Введите название соц.сети (пример: facebook)" name="name_social[]" id="name_social" class="form-control"  value="<?=$items['name_social'];?>">
											</div>
										</div>
										<div class="col-md-5">
											<label>Введите сслыку на вашу страницу в соц.сети</label>
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-reorder"></i>
												</span>
												<input type="text" placeholder="Введите сслыку на вашу страницу в соц.сети" name="url_social[]" id="url_social" class="form-control"  value="<?=$items['url_social'];?>">
											</div>
										</div>
										<div class="col-md-2">
											<label>Удалить соц.сеть</label>
											<input type="checkbox" name="del_social[]" value="<?=$items['id'];?>" title="Удалить">
										</div>
										<input type="hidden" name="id_social[]" value="<?=$items['id'];?>" >
									</div>
								<?}?>
								<script>
									var i=1;
									function addInput() {
										var div = document.getElementById('photo');
										var inputnamesocial=document.createElement('input');
										var inputurlsocial=document.createElement('input');
										var div1=document.createElement('div');
										var div2=document.createElement('div');
										var div3=document.createElement('div');
										var div4=document.createElement('div');
										var span=document.createElement('span');
										var span2=document.createElement('span');
										var i1 = document.createElement('i');
										var i2 = document.createElement('i');
										var label=document.createElement('label');
										var label2=document.createElement('label');
										var text2=document.createTextNode('Введите название соц.сети (пример: facebook)');
										var text3=document.createTextNode('Введите сслыку на вашу страницу в соц.сети');
										var br=document.createElement('br');
										var br2=document.createElement('br');
										var br3=document.createElement('br');
										var br4=document.createElement('br');
										var br5=document.createElement('br');
										
										
										div1.className = 'col-md-6';
										div2.className = 'col-md-6';
										div3.className = 'input-group';
										div4.className = 'input-group';
										i1.className = 'fa fa-reorder'
										i2.className = 'fa fa-reorder'
										span.className = 'input-group-addon'
										span2.className = 'input-group-addon'
										
										inputnamesocial.type = 'text';
										inputnamesocial.name = 'new_name_social['+i+']';
										inputnamesocial.className = 'form-control';
										
										inputurlsocial.type = 'text';
										inputurlsocial.name = 'new_url_social['+i+']';
										inputurlsocial.className = 'form-control';
										
										div.appendChild(div1);
										div1.appendChild(label);
										div1.appendChild(div3);
										div.appendChild(div2);
										div2.appendChild(label2);
										div2.appendChild(div4);
										
										
										label.appendChild(br2);
										label.appendChild(text2);
										label.appendChild(br3);
										div3.appendChild(span);
										span.appendChild(i1);
										div3.appendChild(inputnamesocial);
										
										label2.appendChild(br4);
										label2.appendChild(text3);
										label2.appendChild(br5);
										div4.appendChild(span2);
										span2.appendChild(i2);
										div4.appendChild(inputurlsocial);
										i++;
									}
								</script>
							</div>
							<button type="button" class="btn red" onClick="javascript:addInput()" style="clear: left;float: left; margin-left: 15px;margin-top:25px;">Добавить соц сеть</button>
							
						</div>
						<div class="col-md-12">
							<div class="form-actions">
								<button type="submit" class="btn blue" name="submit">Сохранить</button>
								<button type="button" class="btn red" onClick='location.href="/adminius/"'>Отмена</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?}else{?>
	<h3>Отказано в доступе, недостаточно прав.<h3>
	<?}?>	