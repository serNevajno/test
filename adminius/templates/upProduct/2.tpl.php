<script>
  function uploadProductTyres(page, total, total_posts, id_cat){
    var proc;
    $.ajax({
      type: "POST",
      url: "/adminius/inc/uploadProduct/uploadProductTyres.inc.php",
      dataType: "html",
      data: "page="+page+"&total_posts="+total_posts+"&id_cat="+id_cat,
      success: function (msg) {
        if(+total>=+msg){
          proc = msg / (total / 100);
          $("#progressBarTyres").outerWidth(proc+"%");
          uploadProductTyres(msg, total, total_posts, id_cat);
        }else{
          $("#progressBarTyres").outerWidth("100%");
          //countPageDisk();
          $("#buttonUpload").show();
          $("#resText").show();
        }
      }
    });
  }
  function uploadProductDisk(page, total, total_posts, id_cat){
    var proc;
    $.ajax({
      type: "POST",
      url: "/adminius/inc/uploadProduct/uploadProductDisk.inc.php",
      dataType: "html",
      data: "page="+page+"&total_posts="+total_posts+"&id_cat="+id_cat,
      success: function (msg) {
        if(+total>=+msg){
          proc = msg / (total / 100);
          $("#progressBarDisk").outerWidth(proc+"%");
          uploadProductDisk(msg, total, total_posts, id_cat);
        }else{
          $("#progressBarDisk").outerWidth("100%");
          $("#buttonUpload").show();
          $("#resText").show();
        }
      }
    });
  }
  function uploadProduct(){
    $("#buttonUpload").hide();
    $.ajax({
      type: "POST",
      url: "/adminius/inc/uploadProduct/countProductTyres.inc.php",
      dataType: "json",
      success: function (msg) {
        if(msg){
          $("#progressbar").show();
          uploadProductTyres(1, msg.total_page, msg.total_posts, msg.id_cat);
        }
      }
    });
  }
  function countPageDisk(){
    $.ajax({
      type: "POST",
      url: "/adminius/inc/uploadProduct/countProductDisk.inc.php",
      dataType: "json",
      success: function (msg) {
        uploadProductDisk(1, msg.total_page, msg.total_posts, msg.id_cat);
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
      </div>
    </div>
    <div class="col-md-12" id="buttonUpload">
      <div class="note note-default" id="resText" style="display:none;">
        <p>
          Загрузка товаров завершена.
        </p>
      </div>
      <div class="form-actions">
        <button onClick="uploadProduct();" class="btn blue" name="submit">Обновить товар</button>
        <button onClick="if(confirm('Вы уверены?')){clearPriceProduct(<?=$_GET["id"]?>);}" class="btn yellow" name="submit">Отчистить прайс</button>
        <button type="button" class="btn red" onClick='location.href="/adminius/"'>Отмена</button>
      </div>
    </div>
  </div>
</div>