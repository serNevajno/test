<script>
    function uploadProduct(){
        var proc;
        $("#progressbar").show();
        $.ajax({
            type: "POST",
            url: "/adminius/test/test.php",
            dataType: "html",
            success: function (msg) {
                if(msg>0){
                    $("#buttonUpload").show();
                    $("#resText").show();
                    $("#resText").html(msg);
                    uploadProduct();
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
                <button onClick="uploadProduct();" class="btn blue" name="submit">Обновить товар</button>
                <button type="button" class="btn red" onClick='location.href="/adminius/"'>Отмена</button>
            </div>
        </div>
    </div>
</div>