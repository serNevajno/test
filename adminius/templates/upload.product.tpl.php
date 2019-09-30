<?if(isset($_GET["id"])){?>
    <?include($_SERVER['DOCUMENT_ROOT'].'/adminius/templates/upProduct/'.$_GET["id"].'.tpl.php');?>
<?}else{?>
    <div class="row">
        <div class="col-md-12">
            <div class="tabbable tabbable-custom boxless">
                <h2>Загрузка товаров по поставщикам.</h2>
                <br />
                <div class="note note-warning">
                    <p>
                        Выберите поставщика
                    </p>
                </div>
                <?//$arrProvider = array(1, 2, 3, 4, 5, 6, 9, 10, 19, 20, 21, 22, 23);?>
                <?$arrProvider = array(1, 2, 5, 9, 10, 20, 24, 25);?>
                <?foreach(selectProvider() as $iProvider){?>
                  <?if(in_array($iProvider["id"], $arrProvider)){?>
                    <button onClick="location.href='/adminius/index.php?code=product&action=upload&id=<?=$iProvider["id"]?>'" class="btn blue" name="submit"><?=$iProvider["name"]?></button>
                  <?}?>
                <?}?>
            </div>
        </div>
    </div>
    <?include($_SERVER['DOCUMENT_ROOT'].'/adminius/templates/upProduct/all.tpl.php');?>
    <?$cErrorPrice = selectCountErroPrice();?>
    <?if($cErrorPrice>0){?>
        <div class="row">
            <div class="col-md-12">
                <div class="tabbable tabbable-custom boxless">
                    <div class="note note-danger">
                        <p>
                            <?=$cErrorPrice?> товаров с неправильной ценой!
                            <form method="post">
                                <input name="func" value="errorPrice" type="hidden">
                                <button type="submit" class="btn blue" name="submit">Исправить</button>
                            </form>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    <?}?>
  <?$sCountDubl = selectCountDublFil();
  if($sCountDubl>0){?>
    <div class="row">
      <div class="col-md-12">
        <div class="tabbable tabbable-custom boxless">
          <div class="note note-danger">
            <p>
              <?=$sCountDubl?> товаров с неправильным фильтром!
            </p>
          </div>
        </div>
      </div>
    </div>
  <?}?>
    <?$cPriceBufer = selectCountPriceBufer();?>
    <?if($cPriceBufer>0){?>
        <script>
            function checkPriceBufer(){
                $.ajax({
                    type: "POST",
                    url: "/adminius/inc/uploadProduct/checkPriceBufer.inc.php",
                    dataType: "html",
                    success: function (msg) {
                        if(msg == "ok"){
                            priceBufer('1', '<?=$cPriceBufer?>');
                        }
                    }
                });
            }
            function clearPriceBufer(){
                $.ajax({
                    type: "POST",
                    url: "/adminius/inc/uploadProduct/clearPriceBufer.inc.php",
                    dataType: "html",
                });
            }
            function priceBufer(countPr, total){
                $("#priceForm").hide();
                $("#progressbar").show();
                var proc = '0';

                $.ajax({
                    type: "POST",
                    url: "/adminius/inc/uploadProduct/priceBufer.inc.php",
                    dataType: "html",
                    data: "count="+countPr,
                    success: function (msg) {
                        if(+total>=+msg){
                            proc = msg / (total / 100);
                            $("#progressBarPrice").outerWidth(proc+"%");
                            priceBufer(msg, total);
                        }else{
                            clearPriceBufer();
                            $("#progressBarPrice").outerWidth("100%");
                            $("#resText").show();
                        }
                    }
                });
            }
        </script>
        <div class="row" id="priceForm">
            <div class="col-md-12">
                <div class="tabbable tabbable-custom boxless">
                    <div class="note note-danger">
                        <p>
                            <?=$cPriceBufer?> загруженых цен товаров!
                            <button onClick="checkPriceBufer();" class="btn blue">Применить</button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tabbable tabbable-custom boxless">
                    <div id="progressbar" style="display:none;">
                        <h3>Загрузка цен.</h3>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%" id="progressBarPrice">
                                  <span class="sr-only"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="note note-default" id="resText" style="display:none;">
                        <p>
                            Загрузка цен завершена.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    <?}?>
<?}?>
