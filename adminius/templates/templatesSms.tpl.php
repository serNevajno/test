<? if ($access["settings"] == 1) { ?>
    <? if (isset($_GET["action"])) { ?>
        <? if ($_GET["action"] == "add") { ?>
            <!-- BEGIN PAGE CONTENT-->
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable tabbable-custom">
                        <h2>Добавление шаблона</h2>
                        <br>
                        <form action="" enctype="multipart/form-data" method="POST" name="form" id="myForm">
                            <input name="func" type="hidden" value="templatesSms">
                            <div class="tab-content">
                                <div class="tab-pane active fontawesome-demo" id="tab_0">
                                    <div class="form-body">

                                        <div class="form-group">
                                            <label>Текст</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                  <i class="fa fa-pencil-square-o"></i>
                                                </span>
                                                <textarea type="text" placeholder="Карта" name="text" class="form-control"> </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn blue" name="submit">Сохранить</button>
                                <button type="button" class="btn red" onClick='location.href="/adminius/index.php?code=<?=$_GET['code']?>"'>Отмена
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <? } elseif ($_GET["action"] == "edit") { ?>
            <!-- BEGIN PAGE CONTENT-->
            <? $item = selectTemplatesSMSById($_GET["id"]); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable tabbable-custom">
                        <h2>Редактирование контактов доп оффиса</h2>
                        <br>
                        <form action="" enctype="multipart/form-data" method="POST" name="form" id="myForm">
                            <input name="func" type="hidden" value="<?=$_GET['code']?>">
                            <input name="id" type="hidden" value="<?= $_GET["id"] ?>">
                            <div class="tab-content">
                                <div class="tab-pane active fontawesome-demo" id="tab_0">
                                    <div class="form-body">

                                        <div class="form-group">
                                            <label>Текст</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                  <i class="fa fa-pencil-square-o"></i>
                                                </span>
                                                <textarea type="text" name="text" class="form-control"> <?=$item["text"]?></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn green" name="submit">Сохранить</button>
                                <button type="button" class="btn red" onClick='location.href="/adminius/index.php?code=<?=$_GET['code']?>"'>Отмена
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <? } ?>
    <? } else { ?>

        <? if (isset($_GET["limit"])) {
            $num = clearData($_GET["limit"], "i");
        } else {
            $num = 10;
        }?>
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet box purple">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Управление доп шаблонами
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                    <a href="javascript:;" class="reload"></a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="btn-group">
                        <button id="sample_editable_1_new" class="btn green"
                                onClick='location.href="/adminius/index.php?code=<?= $_GET['code'] ?>&action=add"'>
                            Добавить <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <? $sTemplatesSMS = selectTemplatesSMS();
                if ($sTemplatesSMS){?>
                    <div class="table-scrollable">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Текст</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <? $n = 1;
                            foreach ($sTemplatesSMS as $item) { ?>
                                <tr>
                                    <td><?= $n ?></td>
                                    <td><a href="/adminius/index.php?code=<?=$_GET['code']?>&action=edit&id=<?= $item["id"] ?>"><?= $item['text'] ?></a></td>
                                    <td>
                                        <a class="btn btn-xs blue btn-editable" data-id="1"
                                           href="/adminius/index.php?code=<?=$_GET['code']?>&action=edit&id=<?= $item["id"] ?>"><i
                                                class="fa fa-pencil"></i> Edit</a>
                                        <? if ($access["del"] == 1) { ?>
                                            <form action="index.php" method="POST" name="delform<?= $item['id'] ?>" style="display:none;">
                                                <input name="func" type="hidden" value="<?=$_GET['code']?>">
                                                <input name="id" type="hidden" value="<?= $item['id'] ?>">
                                            </form>
                                            <a class="btn btn-xs red btn-removable" data-id="1" href="javascript:if(confirm('Вы уверены?')){delform<?= $item['id'] ?>.submit();}"><i class="fa fa-times"></i> Delete</a>
                                        <? } ?>
                                    </td>
                                </tr>
                                <? $n++; ?>
                            <? } ?>
                            </tbody>
                        </table>
                    </div>
                <?}else{?>
                    <h3> К сожалению но шаблонов нет :(<h3>
                <?}?>
            </div>
        </div>
        <!-- END SAMPLE TABLE PORTLET-->

    <? } ?>
<? } else { ?>
    <h3>Отказано в доступе, недостаточно прав.<h3>
<? } ?>