<?if($access["xml"] == 1){?>
    <?if (isset($_GET["action"])){?>
        <?if($_GET["action"] == "add"){?>
            <!-- BEGIN PAGE CONTENT-->
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable tabbable-custom">
                        <h2>Добавление подарка..</h2>
                        <br>
                        <form role="form" action="" enctype="multipart/form-data" method="POST" name="form" id="myForm">
                            <input name="func" type="hidden" value="xml_gift">
                            <input name="type" type="hidden" value="2">
                            <div class="form-body">
                                <div class="form-group">
                                    <div class="checkbox-list">
                                        <b>Активность:</b>&nbsp; <input type="checkbox" value="1" name="active">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Название акции <font color="red">*</font></label>
                                    <div class="input-group">
																<span class="input-group-addon">
																	<i class="fa fa-reorder"></i>
																</span>
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Бренд: <font color="red">*</font></label>
                                    <select name="brand[]" class="form-control input-medium" required multiple>
                                        <?foreach (selectTyresBrand() as $iBrand){?>
                                            <option value="<?=$iBrand["id"]?>"><?=$iBrand["name"]?></option>
                                        <?}?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Диаметр: <font color="red">*</font></label>
                                    <select name="diameter[]" class="form-control input-medium" required multiple>
                                        <option value="0">Все</option>
                                        <?foreach (selectValueFilter('20') as $iDiameter){?>
                                            <option value="<?=$iDiameter["id"]?>">R<?=$iDiameter["value"]?></option>
                                        <?}?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Введите товар  <font color="red">*</font></label>
                                    <div class="input-group">
																<span class="input-group-addon">
																	<i class="fa fa-reorder"></i>
																</span>
                                        <input type="text" class="form-control" name="product" placeholder="Через запятую" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn blue" name="submit">Сохранить</button>
                                <button type="button" class="btn red" onClick='location.href="/adminius/index.php?code=xml_gift_disk"'>Отмена</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?}elseif($_GET["action"] == "edit"){?>
            <?$sExtraCharge = selectXMLGiftById($_GET["id"]);
            $arrBrand = explode(",", $sExtraCharge["brand"]);
            $arrDiameter = explode(",", $sExtraCharge["diameter"]);?>
            <!-- BEGIN PAGE CONTENT-->
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable tabbable-custom">
                        <h2>Редактирование наценки..</h2>
                        <br>
                        <form role="form" action="" enctype="multipart/form-data" method="POST" name="form" id="myForm">
                            <input name="func" type="hidden" value="xml_gift">
                            <input name="type" type="hidden" value="2">
                            <input name="id" type="hidden" value="<?=$_GET["id"]?>">
                            <div class="form-body">
                                <div class="form-group">
                                    <div class="checkbox-list">
                                        <b>Активность:</b>&nbsp; <input type="checkbox" value="1" name="active" <?if($sExtraCharge["active"]) echo "checked"?>>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Название акции <font color="red">*</font></label>
                                    <div class="input-group">
																<span class="input-group-addon">
																	<i class="fa fa-reorder"></i>
																</span>
                                        <input type="text" class="form-control" name="name" value="<?=$sExtraCharge["name"]?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Бренд: <font color="red">*</font></label>
                                    <select name="brand[]" class="form-control input-medium" required multiple>
                                        <?foreach (selectTyresBrand() as $iBrand){?>
                                            <option value="<?=$iBrand["id"]?>" <?if(in_array($iBrand["id"], $arrBrand)) echo 'selected="selected"';?>><?=$iBrand["name"]?></option>
                                        <?}?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Диаметр: <font color="red">*</font></label>
                                    <select name="diameter[]" class="form-control input-medium" required multiple>
                                        <option value="0" <?if(empty($sExtraCharge["diameter"])) echo 'selected="selected"';?>>Все</option>
                                        <?foreach (selectValueFilter('20') as $iDiameter){?>
                                            <option value="<?=$iDiameter["id"]?>" <?if(in_array($iDiameter["id"], $arrDiameter)) echo 'selected="selected"';?>>R<?=$iDiameter["value"]?></option>
                                        <?}?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Введите товар  <font color="red">*</font></label>
                                    <div class="input-group">
																<span class="input-group-addon">
																	<i class="fa fa-reorder"></i>
																</span>
                                        <input type="text" class="form-control" name="product" placeholder="Через запятую" value="<?=$sExtraCharge["product"]?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn blue" name="submit">Сохранить</button>
                                <button type="button" class="btn red" onClick='location.href="/adminius/index.php?code=xml_gift_disk"'>Отмена</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?}?>
    <?}else{?>

        <?if (isset($_GET["limit"])) {
            $num = clearData($_GET["limit"], "i");
        }else{
            $num = 10;
        }
        if (isset($_GET["page"])) {
            $page = clearData($_GET["page"], "i");
        }else{
            $page = 1;
        }?>
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet box purple">
            <div class="portlet-title">
            </div>
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="btn-group">
                        <button id="sample_editable_1_new" class="btn green" onClick='location.href="/adminius/index.php?code=xml_gift_disk&action=add"'>
                            Добавить <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-sm-12">
                        <div id="sample_1_length" class="dataTables_length">
                            <label>
                                <select size="1" name="limit" aria-controls="sample_1"  class="form-control input-small" onchange='location.href="index.php?code=<?=$_GET['code']?><?if($_GET['search']){?>&search=<?=$_GET['search']?><?}?><?if($_GET['page']){?>&page=<?=$_GET['page']?><?}?>&limit="+this.value'>
                                    <option value="10" <?if ($num == 10) echo "selected='selected'";?>>10</option>
                                    <option value="25" <?if ($num == 25) echo "selected='selected'";?>>25</option>
                                    <option value="50" <?if ($num == 50) echo "selected='selected'";?>>50</option>
                                    <option value="100" <?if ($num == 100) echo "selected='selected'";?>>100</option>
                                    <option value="0" <?if ($num == 0) echo "selected='selected'";?>>All</option>
                                </select>
                            </label>
                        </div>
                    </div>

                </div>
                <?$sExtraCharge = selectXMLGift($page, $num, "2");
                if (!empty($sExtraCharge)):?>
                    <div class="table-scrollable">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>№</th>
                                <th>Название</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?$n=1+$start;
                            foreach ($sExtraCharge as $item){?>
                                <tr>
                                    <td><?=$n?></td>
                                    <td><a href="/adminius/index.php?code=xml_gift_disk&action=edit&id=<?=$item["id"]?>"><?=$item['name']?></a></td>
                                    <td>
                                        <a class="btn btn-xs blue btn-editable" data-id="1" href="/adminius/index.php?code=xml_gift_disk&action=edit&id=<?=$item["id"]?>"><i class="fa fa-pencil"></i> Edit</a>
                                        <?if($access["del"] == 1){?>
                                            <form action="index.php" method="POST" name="delform<?=$item['id']?>" style="display:none;">
                                                <input name="func" type="hidden" value="xml_gift">
                                                <input name="id" type="hidden" value="<?=$item['id']?>">
                                                <input name="type" type="hidden" value="2">
                                            </form>
                                            <a class="btn btn-xs red btn-removable" data-id="1" href="javascript:if(confirm('Вы уверены?')){delform<?=$item['id']?>.submit();}"><i class="fa fa-times"></i> Delete</a>
                                        <?}?>
                                    </td>
                                </tr>
                                <?$n++;?>
                            <?}?>
                            </tbody>
                        </table>
                    </div>
                    <?include($_SERVER['DOCUMENT_ROOT'].'/adminius/templates/pagenav.tpl.php');?>
                <?else:?>
                <h3> К сожалению но акций нет :(<h3>
                        <?endif;?>
            </div>
        </div>
        <!-- END SAMPLE TABLE PORTLET-->
    <?}?>
<?}else{?>
    <h3>Отказано в доступе, недостаточно прав.<h3>
<?}?>