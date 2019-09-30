			<script type="text/javascript">
					function checkForm() {
						var title = document.getElementById("title");
						var meta_d = document.getElementById("meta_d");
						var meta_k = document.getElementById("meta_k");
						var date = document.getElementById("date");
						if (!title.value) {
							alert('Введите заголовок');
							return false;
						}
						if (!meta_d.value) {
							alert('Введите краткое описание');
							return false;
						}
						if (!meta_k.value) {
							alert('Введите ключевые слова');
							return false;
						}
						if (!date.value) {
							alert('Введите дату');
							return false;
						}
					}
					window.onload = function () {
						var form = document.getElementById("myForm");
						form.onsubmit = checkForm
					}
				</script>
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<div class="tabbable tabbable-custom">
						<h2>Редактирование галереи...</h2>
						<br>
						<form role="form" action="" enctype="multipart/form-data" method="POST" name="form" id="myForm">
							<input name="func" type="hidden" value="gallery">
							
									<div class="form-group" id="photo">
										<?$sPhoto = selectPhoto(0);
										$n = 0;?>
										<?foreach ($sPhoto as $item):?>
										<div class="col-md-4 col-sm-6 mix category_1" style="margin-bottom:15px;">
											<div class="mix-inner">
												<img class="img-responsive" src="http://<?=$_SERVER['SERVER_NAME']?>/phpScripts/phpThumb/phpThumb.php?src=/images/photogallery/<?=$item["img"]?>&w=331&h=220&far=1&bg=ffffff&f=jpg">
												<input name="img[<?=$n?>]" type="hidden" value="<?=$item["img"]?>">
												
												<div class="mix-details" style="margin-bottom:15px;">
													<label>Текст фото:</label>
													<input name="text_photo[<?=$n?>]" type="text" value="<?=$item["text"]?>" class="form-control" placeholder="Текста фото нет">
													
													<label>Приоритет фото:</label>
													<br><input name="priority_photo[<?=$n?>]" type="text" class="form-control" placeholder="Сортировка фото" value="<?=$item["priority"]?>">
													
													<br>
													<input type="checkbox" name="del_photo[<?=$n?>]" value="1">Удалить
													<br>
													
													<input name="id_photo[<?=$n?>]" type="hidden" value="<?=$item["id"]?>">
												</div>
											</div>
										</div>
											<?$n++;?>
										<?endforeach;?>
										<input name="n" type="hidden" value="<?=$n?>">
									</div>
									
									<div class="form-group" id="photo">
									<script>
										var i=0;
										function addInput() {
											var div = document.getElementById('photo');
											var input=document.createElement('input');
											var inputtext=document.createElement('input');
											var inputpriority=document.createElement('input');
											var p=document.createElement('p');
											var label=document.createElement('label');
											var text=document.createTextNode('Фото:');
											var text2=document.createTextNode('Описание фото:');
											var text3=document.createTextNode('Приоритет фото:');
											var br=document.createElement('br');
											var br2=document.createElement('br');
											var br3=document.createElement('br');
											var br4=document.createElement('br');
											var br5=document.createElement('br');
											
											p.id = 'noleft';
											
											input.type = 'file';
											input.name = 'photo['+i+']';
											
											inputtext.type = 'text';
											inputtext.name = 'new_text_photo['+i+']';
											inputtext.className = 'form-control';
											
											inputpriority.type = 'text';
											inputpriority.name = 'new_priority_photo['+i+']';
											inputpriority.className = 'form-control';
											
											div.appendChild(p);
											p.appendChild(label);
											label.appendChild(text);
											label.appendChild(br);
											label.appendChild(input);
											label.appendChild(br2);
											label.appendChild(text2);
											label.appendChild(br3);
											label.appendChild(inputtext);
											label.appendChild(br4);
											label.appendChild(text3);
											label.appendChild(br5);
											label.appendChild(inputpriority);
											i++;
										}
									</script>
									</div>
									<button type="button" class="btn red" onClick="javascript:addInput()" style="clear: left;float: left; margin-left: 15px;">Добавить фото +1</button>
					</div>
							<br>
							<div class="form-actions">
								<button type="submit" class="btn green" name="submit">Сохранить</button>
							</div>
						</form>
					</div>
				</div>