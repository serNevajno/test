<?if($access[$_GET['code']] == 1){?>
	<?$sCountPage = selectCountTotalPage();?>
	<script>
		function countPageDisk(){
			var list = null, res = '';
			var disk = '';
			list = $('#categoriesXMl :checkbox:checked');
			list.each( function(ind) {
				res += $(this).val();
				if($(this).val() == '2'){
					disk = "1";
				}
				if (ind < list.length - 1) res +=','; // например через запятую
			});
			if(disk == "1"){
				$.ajax({
					type: "POST",
					url: "/adminius/inc/xml/countPageDisk.inc.php",
					dataType: "html",
					success: function (msg) {
							$("#totalXMLDisk").html(msg);
							selectDiskAll(1, msg);
					}
				});
			}else{
				selectProductAll(1, '<?=$sCountPage?>');
			}
		}
		function selectDiskAll(page, total){
			$.ajax({
				type: "POST",
				url: "/adminius/inc/xml/selectDiskAllAUTORU.inc.php",
				dataType: "html",
				data: "page="+page,
				success: function (msg) {
					if(+total>=+msg){
						proc = msg / (total / 100);
						$("#progressBarDisk").outerWidth(proc+"%");
						selectDiskAll(msg, total);
					}else{
						selectProductAll(1, '<?=$sCountPage?>');
					}
				}
			});
		}
		function selectTyresAll(page, total){
			var proc;
			$.ajax({
				type: "POST",
				url: "/adminius/inc/xml/selectTyresAllAUTORU.inc.php",
				dataType: "html",
				data: "page="+page,
				success: function (msg) {
					if(+total>=+msg){
						proc = msg / (total / 100);
						$("#progressBarTyres").outerWidth(proc+"%");
						selectTyresAll(msg, total);
					}else{
						countPageDisk();
					}
				}
			});
		}
		function selectProductAll(page, total){
            if(total>0) {
                var list = null, res = '';
                var tyres = '';
                list = $('#categoriesXMl :checkbox:checked');
                list.each( function(ind) {
                    res += $(this).val();
                    if (ind < list.length - 1) res +=','; // например через запятую
                });

                $.ajax({
                    type: "POST",
                    url: "/adminius/inc/xml/selectProductAllAUTORU.inc.php",
                    dataType: "html",
                    data: "page="+page+"&categories="+res,
                    success: function (msg) {
                        if(+total>=+msg){
                            proc = msg / (total / 100);
                            $("#progressBarProduct").outerWidth(proc+"%");
                            selectProductAll(msg, total);
                        }else{
                            endXML();
                        }
                    }
                });
            }else{
                endXML();
            }
		}
		function endXML(){
			$.ajax({
				type: "POST",
				url: "/adminius/inc/xml/endXMLAUTORU.inc.php",
				dataType: "html",
				success: function (msg) {
					if(msg == "ok"){
						$('#endMes').show();
					}
				}
			});
		}
		function createXML(){
			var list = null, res = '';
			var tyres = '';
			list = $('#categoriesXMl :checkbox:checked');
			list.each( function(ind) {
				res += $(this).val();
				if(res == 1){
					tyres = "1";
				}
				if (ind < list.length - 1) res +=','; // например через запятую
			});
			$("#buttonXml").hide();
			$.ajax({
				type: "POST",
				url: "/adminius/inc/xml/createXMLAUTORU.inc.php",
				dataType: "html",
				data: "categories="+res,
				success: function (msg) {
					if(msg){
						$("#progressbar").show();
						if(tyres == "1"){
							selectTyresAll(1, msg);
						}else{
							countPageDisk();
						}
					}
				}
			});
		}
		
	</script>
	<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">
						<div class="tabbable tabbable-custom boxless">
						<h2>Создание XML файла товаров.</h2>
						<br />
							<div class="tab-content">
								<div class="portlet-body">

                    <div class="row">
                        <div class="col-md-12" id="categoriesXMl">
                            <?foreach (selectCategoriesBySectionAct() as $item){?>
                              <div class="col-md-3">
                                <input type="checkbox" name="categories[]" class="checkbox" value="<?=$item['id']?>"/><?=$item['name']?>
                              </div>
                            <?}?>
                            </div>
                        </div>
                      </div>
                    </div>
							<div class="note note-warning">
								<p>
									 Создание XML файла может занять продолжительное время, не закрывайте страницу до окончание процедуры.
								</p>
							</div>
							<div class="note note-info">
								<p>
									<?$filename = $_SERVER['DOCUMENT_ROOT'].'/price/priceAUTORU.xml';
									if (file_exists($filename)) {
											echo "В последний раз файл http://".$_SERVER['SERVER_NAME']."/price/priceAUTORU.xml был создан: " . date ("F d Y H:i:s.", filemtime($filename));
									}else{echo 'файла нет';}?>
								</p>
							</div>
							<div id="progressbar" style="display:none;">
								<h3>Шины</h3>
								<div class="progress">
									<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%" id="progressBarTyres">
										<span class="sr-only">
										</span>
									</div>
								</div>
								<h3>Диски</h3>
								<div class="progress">
									<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%" id="progressBarDisk">
										<span class="sr-only">
										</span>
									</div>
								</div>
								<h3>Остальные категории</h3>
								<div class="progress">
									<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 0%" id="progressBarProduct">
										<span class="sr-only">
										</span>
									</div>
								</div>
							</div>
						<div class="note note-info" id="endMes" style="display:none;">
								<p>Файл успешно создан. И доступен по ссылке http://dobrayashina.ru/priceAUTORU.xml</p>
						</div>
						</div>
								<div class="col-md-12" id="buttonXml">
									<div class="form-actions">
										<button onClick="createXML();" class="btn blue" name="submit">Создать файл.</button>
										<button type="button" class="btn red" onClick='location.href="/adminius/"'>Отмена</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
<?}else{?>
	<h3>Отказано в доступе, недостаточно прав.<h3>
<?}?>