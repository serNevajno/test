<script>
    function uploadProduct(page, total){
        var proc;
        $.ajax({
            type: "POST",
            url: "/adminius/inc/uploadProduct/upProvider19.inc.php",
            dataType: "html",
            data: "count="+page+"&skl=1",
            success: function (msg) {
                console.log(msg);
                if(+total>=+msg){
                    proc = msg / (total / 100);
                    $("#progressBar").outerWidth(proc+"%");
                    uploadProduct(msg, total);
                }else{
                    $("#progressBar").outerWidth("100%");
                    $("#buttonUpload").show();
                    $("#resText").show();
                }
            }
        });
    }

    function countProduct(){
        $("#buttonUpload").hide();
        $.ajax({
            type: "POST",
            url: "/adminius/inc/uploadProduct/countProvider19.inc.php",
            dataType: "html",
            data: 'skl=1',
            success: function (msg) {
                console.log(msg);
                if(msg){
                    $("#progressbar").show();
                    uploadProduct(0, msg);
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
            <div id="progressbar" style="display:none;">
                <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%" id="progressBar">
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
                <button onClick="countProduct();" class="btn blue" name="submit">Обновить товар</button>
                <button type="button" class="btn red" onClick='location.href="/adminius/"'>Отмена</button>
            </div>
        </div>
    </div>
</div>