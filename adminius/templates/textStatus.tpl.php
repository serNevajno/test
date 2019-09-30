<?if($access["product"] == 1){?>
    <?if (isset($_GET["action"])):?>
        <?if($_GET["action"] == "edit"){?>
            <?$item = selectStatusById($_GET["id"]);?>
            <!-- BEGIN PAGE CONTENT-->
            <div class="row">
                <div class="col-md-12">
                    <h2>Редактирование текста</h2>
                    <br>
                    <div class="tabbable tabbable-custom boxless">
                        <form role="form" action="index.php" enctype="multipart/form-data" method="POST" name="form" id="myForm">
                            <input name="func" type="hidden" value="textStatus">
                            <input name="id" type="hidden" value="<?=$_GET["id"]?>">
                            <div class="form-group">
                                <label>Введите текст смс</label>
                                <textarea class="form-control" rows="5" name="sms_text"><?=$item["sms_text"]?></textarea>
                            </div>
                            <div class="form-group">
                                  <label>Введите текст емейла</label>
                                  <textarea class="form-control" rows="5" name="email_text" id="descriptions"><?=$item["email_text"]?></textarea>
                                  <script type="text/javascript">
                                            CKEDITOR.replace( 'descriptions' );
                                  </script>
                            </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn blue" name="submit">Добавить</button>
                                        <button type="button" class="btn default" onClick='location.href="/adminius/index.php?code=textStatus"'>Отмена</button>
                                    </div>

                        </form>
                    </div>

                </div>

            </div>
        <?}?>
    <?else:?>
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="tools">
                </div>
            </div>
            <div class="portlet-body">
                #name# - имя клиента, #nomer# - номер заказа, #sum# - сумма заказа
                <table class="table table-striped table-bordered table-hover" id="sample_1">
                    <thead>
                    <tr>
                        <th>№</th>
                        <th>Статус</th>
                        <th>Текст смс</th>
                        <th>Текст емеил</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody role="alert" aria-live="polite" aria-relevant="all">
                    <?$select_status = selectStatus();
                    $n=1;
                    foreach ($select_status as $item){?>
                        <tr class="odd">
                            <td class=" sorting_1"><span class="label label-sm label-success"><?=$n?></span></td>
                            <td class=""><?=$item["name"]?></td>
                            <td class=""><?=$item["sms_text"]?></td>
                            <td class=""><?=$item["email_text"]?></td>
                            <td class="">
                                <a class="btn btn-xs blue btn-editable" data-id="1" href="/adminius/index.php?code=textStatus&action=edit&id=<?=$item["id"]?>"><i class="fa fa-pencil"></i> Edit</a>
                            </td>
                        </tr>
                        <?$n++;?>
                    <?}?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    <?endif;?>
<?}else{?>
<h3>Отказано в доступе, недостаточно прав.<h3>
        <?}?>