<div class="modal fade" id="modalStorage" tabindex="-1" role="dialog" aria-hidden="true" style="top:20px;">
    <div class="modal-dialog" style="margin: unset; width: unset; ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4>Оприходовать товар: </h4>
            </div>
            <div class="modal-body" style="height: 350px;">
                <div>
                    <form action="index.php" method="POST" name="inStorage">
                        <input name="func" type="hidden" value="inStorage">
                        <input name="productOrder_id" type="hidden" id="storageProductOrder" value="">
                        <input name="id" type="hidden" value="<?= $_GET["id"] ?>">
                        <select name="storage" id="storageRegion" class="form-control">
                            <?foreach (selectRegionUser() as $iRegion){?>
                                <option value="<?=$iRegion["id"]?>"><?=$iRegion["region"]?></option>
                            <?}?>
                        </select>
                    </form>
                    <a class="btn btn-xs yellow btn-removable" data-id="1"
                       href="javascript:if(confirm('Вы уверены?')){inStorage.submit();}">Оприходовать</a>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>