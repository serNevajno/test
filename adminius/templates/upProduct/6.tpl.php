<script>
  function uploadFile(a) {
    var url = $("#url_"+a).val();
    $("#formUp").hide();
    $.ajax({
      url: '/adminius/inc/uploadProduct/countProvider6.inc.php',
      type: 'POST',
      dataType: "html",
      data: "url="+url,
      success: function (data) {
        if(data>0) {
          $("#progressBarDiv").show();
          uploadProductCSV('1', a, data, url);
        }
      }
    });
  }
  function uploadProductCSV(countPr, type, total, url){
    $("#formUp").hide();
    $("#progressBarDiv").show();
    var proc = '0';

    $.ajax({
      type: "POST",
      url: "/adminius/inc/uploadProduct/upProvider6.inc.php",
      dataType: "html",
      data: "type="+type+"&count="+countPr+"&url="+url,
      success: function (msg) {
        if(+total>=+msg){
          proc = msg / (total / 100);
          $("#progressBar").outerWidth(proc+"%");
          uploadProductCSV(msg, type, total, url);
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
          Загрузка товаров может занять продолжительное время, не закрывайте страницу до окончание процедуры.
        </p>
      </div>
      <div id="formUp">
        <div class="form-group">
          <h3>Добавление шин</h3>
          <form method="post" enctype="multipart/form-data" id="form_tyres">
            <div class="input-group input-large">
              <input class="form-control" type="text" name="url" id="url_tyres" placeholder="Введите ccылку на файл">
              <span class="input-group-btn">
											<button class="btn blue" type="button" onClick="uploadFile('tyres')">Загрузить</button>
									</span>
            </div>
          </form>
        </div>
        <div class="form-group">
          <h3>Добавление дисков</h3>
          <form method="post" enctype="multipart/form-data" id="form_disk">
            <div class="input-group input-large">
              <input class="form-control" type="text" name="url" id="url_disk" placeholder="Введите ccылку на файл">
              <span class="input-group-btn">
											<button class="btn blue" type="button" onClick="uploadFile('disk')">Загрузить</button>
									</span>
            </div>
            <!-- /input-group -->
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