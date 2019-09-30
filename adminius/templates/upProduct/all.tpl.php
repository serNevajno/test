<script>
  function uploadFile(a) {
    var formData = new FormData(document.getElementById('form_' + a));
    var type = formData.get("type");

    $.ajax({
      url: '/adminius/inc/uploadProduct/uploadFileCSV.inc.php',
      data: formData,
      processData: false,
      contentType: false,
      type: 'POST',
      success: function (data) {
        if (data > 0) {
          $("#progressBarDiv").show();
          uploadProductCSV('1', type, data);
        }
      }
    });
  }

  function uploadProductCSV(countPr, type, total) {
    $("#formUp").hide();
    $("#progressBarDiv").show();
    var proc = '0';

    $.ajax({
      type: "POST",
      url: "/adminius/inc/uploadProduct/upProductCSV.inc.php",
      dataType: "html",
      data: "type=" + type + "&count=" + countPr,
      success: function (msg) {
        if (+total >= +msg) {
          proc = msg / (total / 100);
          $("#progressBar").outerWidth(proc + "%");
          uploadProductCSV(msg, type, total);
        } else {
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
      <h2>Загрузка товаров.</h2>
      <br/>
      <div class="note note-warning">
        <p>
          Загрузка товаров может занять продолжительное время, не закрывайте страницу до окончание процедуры. Прайс
          должен быть в формате CSV(разделитель запятые), а также иметь в первой ячейке индификатор: для шин allTyres, для
          дисков allDisk. Для шиповыных шин в колонке должна стоять буква (ш). Сезонность обозначаеться (Зима, Лето, Всесезон).
        </p>
      </div>
      <div class="portlet-body">
        <div class="panel-group accordion" id="accordion1">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1"
                   href="#collapse_1">
                  Шаблон загрузки CVS. Шины </a>
              </h4>
            </div>
            <div id="collapse_1" class="panel-collapse collapse" style="height: auto;">
              <div class="panel-body">
                <ul>
                  <li> 1.Сезон</li>
                  <li> 2.Артикул</li>
                  <li> 3.Наименование</li>
                  <li> 4.Бренд</li>
                  <li> 5.Общ. Модель</li>
                  <li> 6.Шины Диаметр</li>
                  <li> 7.Шины Ширина</li>
                  <li> 8.Шины Профиль</li>
                  <li> 9.Шиповка</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?/*<div class="portlet-body">
        <div class="panel-group accordion" id="accordion2">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2"
                   href="#collapse_2">
                  Шаблон загрузки CVS. Диски </a>
              </h4>
            </div>
            <div id="collapse_2" class="panel-collapse collapse" style="height: auto;">
              <div class="panel-body">
                <ul>
                  <li> 3. Артикул</li>
                  <li> 4. Наименование</li>
                  <li> 6. Бренд</li>
                  <li> 7. Модель</li>
                  <li> 8. Диски Диаметр</li>
                  <li> 9. Диски PCD</li>
                  <li> 10.Диски ЦО</li>
                  <li> 11.Диски Вылет</li>
                  <li> 12.Ширина</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>*/?>
      <div id="formUp">
        <div class="form-group">
          <h3>Добавление шин</h3>
          <form method="post" enctype="multipart/form-data" id="form_tyres">
            <input type="hidden" name="type" value="all1">
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
                <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i>
                  Удалить</a>
                <button type="button" class="btn red" onClick="uploadFile('tyres')">Загрузить</button>
              </div>
            </div>
          </form>
        </div>
        <?/*<div class="form-group">
          <h3>Добавление дисков</h3>
          <form method="post" enctype="multipart/form-data" id="form_disk">
            <input type="hidden" name="type" value="all2">
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
                <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i>
                  Удалить</a>
                <button type="button" class="btn red" onClick="uploadFile('disk')">Загрузить</button>
              </div>
            </div>
          </form>
        </div>*/?>
      </div>
      <div id="ress">
      </div>
      <div id="progressBarDiv" style="display:none;">
        <h3>Загрузка товара</h3>
        <div class="progress">
          <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow=\"40\" aria-valuemin="0" aria-valuemax="100" style="width: 0%" id="progressBar">
            <span class="sr-only"> </span>
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
      <?/*<div class="form-actions">
        <button type="button" class="btn red" onClick='location.href="/adminius/index.php?code=product&action=upload"'>
          Отмена
        </button>
      </div>*/?>
    </div>
  </div>
</div>