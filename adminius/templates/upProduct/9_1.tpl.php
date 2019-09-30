<script>
    function uploadFile(a) {
        var formData = new FormData(document.getElementById('form_'+a));
        var type  = formData.get("type");

        $.ajax({
            url: '/adminius/inc/uploadProduct/uploadFileCSV.inc.php',
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
                if(data>0) {
                    $("#progressBarDiv").show();
                    uploadProductCSV('1', type, data);
                }
            }
        });
    }
    function uploadProductCSV(countPr, type, total){
        $("#formUp").hide();
        $("#progressBarDiv").show();
        var proc = '0';

        $.ajax({
            type: "POST",
            url: "/adminius/inc/uploadProduct/upProductCSV.inc.php",
            dataType: "html",
            data: "type="+type+"&count="+countPr,
            success: function (msg) {
                if(+total>=+msg){
                    proc = msg / (total / 100);
                    $("#progressBar").outerWidth(proc+"%");
                    uploadProductCSV(msg, type, total);
                }else{
                    $("#progressBar").outerWidth("100%");
                    $("#resText").show();
                }
            }
        });
    }
</script>
<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="col-md-12">
        <div class="tabbable tabbable-custom boxless">
            <h2>Загрузка товаров. <?=selectProviderNameById($_GET["id"]);?></h2>
            <br />
            <div class="note note-warning">
                <p>
                    Загрузка товаров может занять продолжительное время, не закрывайте страницу до окончание процедуры. Прайс должен быть в формате CSV(разделитель запятые), а также иметь в первой ячейке индификатор: для шин tyres5, для дисков disk5 и disk5tol для дисков Тольятти.
                </p>
            </div>
            <div class="portlet-body">
                <div class="panel-group accordion" id="accordion1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse_1">
                                    Шаблон загрузки CVS. Шины </a>
                            </h4>
                        </div>
                        <div id="collapse_1" class="panel-collapse collapse" style="height: auto;">
                            <div class="panel-body">
                                <ul>
                                    <li> 1.CAI </li>
                                    <li> 2.1с код </li>
                                    <li> 3.Марка </li>
                                    <li> 4.Модель </li>
                                    <li> 5.Описание </li>
                                    <li> 6.шип </li>
                                    <li> 7.Посадочный диаметр </li>
                                    <li> 8.Коммерческие </li>
                                    <li> 9.Высота </li>
                                    <li> 10.Ширина </li>
                                    <li> 11.ИН </li>
                                    <li> 12.ИС </li>
                                    <li> 13.Сезонность </li>
                                    <li> 14.Количество </li>
                                    <li> 15.Цена руб </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="formUp">
                <div class="form-group">
                    <h3>Подготовка прайса.</h3>
                    <form method="post" enctype="multipart/form-data" action="/adminius/inc/uploadProduct/preparationCSV.php">
                        <div class="margin-top-10 fileupload fileupload-new" data-provides="fileupload">
                            <div class="input-group input-group-fixed">
                                        <span class="input-group-btn">
                                           <span class="uneditable-input">
                                              <i class="fa fa-file fileupload-exists"></i>
                                                  <span class="fileupload-preview"></span>
                                          </span>
                                        </span>
                                <span class="btn default btn-file">
                                            <span class="fileupload-new">
                                                <i class="fa fa-paper-clip"></i>Выберите файл
                                            </span>
                                            <span class="fileupload-exists">
                                                <i class="fa fa-undo"></i> Заменить
                                            </span>
                                            <input type="file" class="default" name="tires"/>
                                        </span>
                                <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Удалить</a>
                                <button type="submit" class="btn red">Загрузить</button>
                            </div>
                        </div>
                    </form>
                    <h3>Добавление шин</h3>
                    <form method="post" enctype="multipart/form-data" id="form_tyres">
                        <input type="hidden" name="type" value="12">
                        <div class="margin-top-10 fileupload fileupload-new" data-provides="fileupload">
                            <div class="input-group input-group-fixed">
                                        <span class="input-group-btn">
                                           <span class="uneditable-input">
                                              <i class="fa fa-file fileupload-exists"></i>
                                                  <span class="fileupload-preview"></span>
                                          </span>
                                        </span>
                                <span class="btn default btn-file">
                                            <span class="fileupload-new">
                                                <i class="fa fa-paper-clip"></i>Выберите файл
                                            </span>
                                            <span class="fileupload-exists">
                                                <i class="fa fa-undo"></i> Заменить
                                            </span>
                                            <input type="file" class="default" name="tires" id="uploadimage"/>
                                        </span>
                                <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Удалить</a>
                                <button type="button" class="btn red" onClick="uploadFile('tyres')">Загрузить</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div id="ress">
            </div>
            <div id="progressBarDiv" style="display:none;">
                <h3>Загрузка товара</h3>
                <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow=\"40\" aria-valuemin="0" aria-valuemax="100" style="width: 0%" id="progressBar">
                                            <span class="sr-only">
                                            </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12" id="buttonUpload">
            <div class="note note-default" id="resText" style="display:none;">
                <p>
                    Загрузка товаров завершена.
                </p>
            </div>
            <div class="form-actions">
              <button onClick="if(confirm('Вы уверены?')){clearPriceProduct(<?=$_GET["id"]?>);}" class="btn yellow" name="submit">Отчистить прайс</button>
                <button type="button" class="btn red" onClick='location.href="/adminius/index.php?code=product&action=upload"'>Отмена</button>
            </div>
        </div>
    </div>
</div>