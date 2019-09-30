<?/*
$arr = simplexml_load_file($_SERVER["DOCUMENT_ROOT"] . "/provider10tyres.xml");

echo "<pre>";
print_r($arr->offers);
echo "</pre>";
foreach ($arr->offers->offer as $item){
    echo $item["id"];
    echo $item->vendor;
    echo $item->param[0];
    echo "<pre>";
    print_r($item);
    echo "</pre>";
}
*/?>
<script>
    function uploadFile() {
        var formData = new FormData(document.getElementById('form_tyres'));

        $.ajax({
            url: '/adminius/inc/uploadProduct/uploadFileXML.inc.php',
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
                if(data>0) {
                    $("#progressBarDiv").show();
                    uploadProductCSV('1', data);
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
            url: "/adminius/inc/uploadProduct/upProductXML.inc.php",
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

            <div id="formUp">
                <div class="form-group">
                    <h3>Добавление шин</h3>
                    <form method="post" enctype="multipart/form-data" id="form_tyres">
                        <input type="hidden" name="type" value="3">
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
                                <button type="button" class="btn red" onClick="uploadFile()">Загрузить</button>
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