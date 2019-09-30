<script>
  function uploadFileShin() {
    var formData = new FormData(document.getElementById('shininvest'));
    $('#shininvest').hide();
    $.ajax({
      url: '/adminius/inc/uploadProduct/uploadExel.inc.php',
      data: formData,
      processData: false,
      contentType: false,
      type: 'POST',
      success: function (data) {
        if(data == "error") {
          alert("Неправильный идентификатор");
          location.reload();
        }else{
          if (data > 0) {
            $("#progressBarDiv").show();
            uploadProductCSV('0', data);
          }
        }
      }
    });
  }
  function uploadProductCSV(countPr, total){
    $("#formUp").hide();
    $("#progressBarDiv").show();
    var proc = '0';

    $.ajax({
      type: "POST",
      url: "/adminius/inc/uploadProduct/upProductExel.inc.php",
      dataType: "html",
      data: "count="+countPr,
      success: function (msg) {
        if(+total>=+msg){
          proc = msg / (total / 100);
          $("#progressBar").outerWidth(proc+"%");
          uploadProductCSV(msg, total);
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
          Загрузка товаров может занять продолжительное время, не закрывайте страницу до окончание процедуры. Прайс должен быть в формате XLSX, а также иметь в первой ячейке индификатор: disk9.
        </p>
      </div>
      <div id="formUp">
        <div class="form-group">
          <h3>Добавление дисков</h3>
          <form method="post" enctype="multipart/form-data" id="shininvest">
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
                                            <input type="file" class="default" name="file_exel" id="uploadimage"/>
                                        </span>
                <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Удалить</a>
                <button type="button" class="btn red" onClick="uploadFileShin()">Загрузить</button>
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
        <button type="button" class="btn red" onClick='location.href="/adminius/index.php?code=product&action=upload"'>Отмена</button>
      </div>
    </div>
  </div>
</div>