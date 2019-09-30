<script>
    function uploadFile() {
        $.ajax({
            url: '/adminius/inc/uploadProduct/countProvider9.inc.php',
            type: 'POST',
            dataType: "html",
            success: function (data) {
                if(data>0) {
                    $("#progressBarDiv").show();
                    uploadProductCSV('0', data);
                }
            }
        });
    }
    function uploadProductCSV(countPr, total){
        $("#formUp").hide();
        $("#progressBarDiv").show();
        $("#noProd").show();
        var proc = '0';

        $.ajax({
            type: "POST",
            url: "/adminius/inc/uploadProduct/upProvider9.inc.php",
            dataType: "html",
            data: {count : countPr},
            success: function (msg) {
                alert(msg);
                if(+total>=+msg){
                    proc = msg / (total / 100);
                    $("#progressBar").outerWidth(proc+"%");
                    uploadProductCSV(msg, total);
                    /*$("#noProd").append(msg.article);*/
                }else{
                    $("#progressBar").outerWidth("100%");
                    $("#resText").show();
                    /*$("#noProd").append(msg.article);*/
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
                            <span class="input-group-btn">
											<button class="btn blue" type="button" onClick="uploadFile()">Загрузить</button>
									</span>
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
            <div class="note note-default" id="noProd" style="display:none;">

            </div>
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