<? if ($access["settings"] == 1) { ?>
  <? if (isset($_GET["action"])) { ?>
    <? if ($_GET["action"] == "add") { ?>
      <!-- BEGIN PAGE CONTENT-->
      <div class="row">
        <div class="col-md-12">
          <div class="tabbable tabbable-custom">
            <h2>Добавление доп оффиса</h2>
            <br>
            <form action="" enctype="multipart/form-data" method="POST" name="form" id="myForm">
              <input name="func" type="hidden" value="office">
              <div class="tab-content">
                <div class="tab-pane active fontawesome-demo" id="tab_0">
                  <div class="form-body">

                    <div class="form-group">
                      <div class="thumbnail" style="width: 310px;">
                        <img src="http://www.placehold.it/310x170/EFEFEF/AAAAAA&amp;text=no+image" alt="">
                      </div>
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
													<input type="file" class="default" id="img" name="img" required/>
												</span>
                          <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Удалить</a>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Адрес компании</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-cogs"></i>
                        </span>
                        <input type="text" placeholder="Адрес компании" name="address" id="address" class="form-control" value="" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Email компании</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-cogs"></i>
                        </span>
                        <input type="email" placeholder="email компании" name="email" id="email" class="form-control" value="" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Телефон компании</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-cogs"></i>
                        </span>
                        <input type="text" placeholder="Телефон компании" name="phone" id="phone" class="form-control" value="" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Время работы компании</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-cogs"></i>
                        </span>
                        <input type="text" placeholder="Время работы компании" name="time_work" id="time_work" class="form-control" value="" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Карта</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-map-marker"></i>
                        </span>
                        <textarea type="text" placeholder="Карта" name="maps" id="maps" class="form-control"> </textarea>
                      </div>
                    </div>
                    <div class="form-group">
                          <label>Регион</label>
                          <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-cogs"></i>
                        </span>
                              <input type="text" placeholder="Регион" name="region" class="form-control" value="<?=$item['region']?>" required>
                          </div>
                    </div>
                    <div class="form-group">
                      <label>Сумма доставки</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-cogs"></i>
                        </span>
                        <input type="text" placeholder="Сумма доставки" name="summ_delivery" class="form-control" value="" required>
                      </div>
                    </div>
                    <!--<div class="form-group">
                      <label>Текст доставки</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-code"></i>
                        </span>
                        <textarea type="text" placeholder="Текст доставки" name="text_delivery" id="text_delivery"  class="form-control"> </textarea>
                        <script type="text/javascript">
                          CKEDITOR.replace( 'text_delivery', {
                            toolbar : 'Basic'
                          } );
                        </script>
                      </div>
                    </div>-->
                  </div>
                </div>
              </div>
              <div class="form-actions">
                <button type="submit" class="btn blue" name="submit">Сохранить</button>
                <button type="button" class="btn red" onClick='location.href="/adminius/index.php?code=slider"'>Отмена
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    <? } elseif ($_GET["action"] == "edit") { ?>
      <!-- BEGIN PAGE CONTENT-->
      <? $item = selectOffice($_GET["id"]); ?>
      <div class="row">
        <div class="col-md-12">
          <div class="tabbable tabbable-custom">
            <h2>Редактирование контактов доп оффиса</h2>
            <br>
            <form action="" enctype="multipart/form-data" method="POST" name="form" id="myForm">
              <input name="func" type="hidden" value="<?=$_GET['code']?>">
              <input name="id" type="hidden" value="<?= $_GET["id"] ?>">
              <input name="img_s" type="hidden" value="<?=$item["img"]?>">
              <div class="tab-content">
                <div class="tab-pane active fontawesome-demo" id="tab_0">
                  <div class="form-body">

                    <div class="form-group">
                      <div class="thumbnail" style="width: 310px;">
                        <?if ($item["img"]):?>
                          <img src="/images/slider/<?=$item["img"]?>" alt="<?=$item["title"]?>">
                        <?else:?>
                          <img src="http://placehold.it/310x200" alt="Нет картинки" title="Нет картинки">
                        <?endif;?>
                      </div>
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
													<input type="file" class="default" id="img" name="img"/>
												</span>
                          <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Удалить</a>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Адрес компании</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-cogs"></i>
                        </span>
                        <input type="text" placeholder="Адрес компании" name="address" id="address" class="form-control" value="<?=$item['address']?>" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Email компании</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-cogs"></i>
                        </span>
                        <input type="email" placeholder="email компании" name="email" id="email" class="form-control" value="<?=$item['email']?>" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Телефон компании</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-cogs"></i>
                        </span>
                        <input type="text" placeholder="Телефон компании" name="phone" id="phone" class="form-control" value="<?=$item['phone']?>" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Время работы компании</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-cogs"></i>
                        </span>
                        <input type="text" placeholder="Время работы компании" name="time_work" id="time_work" class="form-control" value="<?=$item['time_work']?>" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Карта</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-map-marker"></i>
                        </span>
                        <textarea type="text" placeholder="Карта" name="maps" id="maps" class="form-control"><?=$item['maps']?></textarea>
                      </div>
                    </div>
                      <div class="form-group">
                          <label>Регион</label>
                          <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-cogs"></i>
                        </span>
                              <input type="text" placeholder="Регион" name="region" class="form-control" value="<?=$item['region']?>" required>
                          </div>
                      </div>
                    <div class="form-group">
                      <label>Сумма доставки</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-cogs"></i>
                        </span>
                        <input type="text" placeholder="Сумма доставки" name="summ_delivery" class="form-control" value="<?=$item['summ_delivery']?>" required>
                      </div>
                    </div>
                    <!--<div class="form-group">
                      <label>Текст доставки</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-code"></i>
                        </span>
                        <textarea type="text" placeholder="Текст доставки" name="text_delivery" id="text_delivery"  class="form-control"><?/*=$item['text_delivery']*/?> </textarea>
                        <script type="text/javascript">
                          CKEDITOR.replace( 'text_delivery', {
                            toolbar : 'Basic'
                          } );
                        </script>
                      </div>
                    </div>-->
                  </div>
                </div>
              </div>
              <div class="form-actions">
                <button type="submit" class="btn green" name="submit">Сохранить</button>
                <button type="submit" class="btn blue" name="submit1">Обновить</button>
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
    }
    if (isset($_GET["page"])) {
      $page = clearData($_GET["page"], "i");
    } else {
      $page = 1;
    }
    if (isset($_GET["search"])) {
      $search = $_GET["search"];
    } else {
      $search = "";
    } ?>
    <!-- BEGIN SAMPLE TABLE PORTLET-->
    <div class="portlet box purple">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-cogs"></i>Управление доп офисами
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
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <div id="sample_1_length" class="dataTables_length">
              <label>
                <select size="1" name="limit" aria-controls="sample_1" class="form-control input-small"
                        onchange='location.href="index.php?code=<?= $_GET['code'] ?><? if ($_GET['search']) { ?>&search=<?= $_GET['search'] ?><? } ?><? if ($_GET['page']) { ?>&page=<?= $_GET['page'] ?><? } ?>&limit="+this.value'>
                  <option value="10" <? if ($num == 10) echo "selected='selected'"; ?>>10</option>
                  <option value="25" <? if ($num == 25) echo "selected='selected'"; ?>>25</option>
                  <option value="50" <? if ($num == 50) echo "selected='selected'"; ?>>50</option>
                  <option value="100" <? if ($num == 100) echo "selected='selected'"; ?>>100</option>
                  <option value="0" <? if ($num == 0) echo "selected='selected'"; ?>>All</option>
                </select>
              </label>
            </div>
          </div>
          <div style="float:right;">
            <div class="dataTables_filter" id="sample_1_filter">
              <div class="col-md-6">
                <div class="input-group input-medium">
                  <form action="/adminius/index.php" method="GET" style=" display: inline-table;"><input name="code"
                                                                                                         type="hidden"
                                                                                                         value="slider"/>
                    <input type="text" class="form-control" placeholder="поиск" name="search">
                    <span class="input-group-btn">
											<button class="btn blue" type="sumbit"><font><font>Поиск</font></font></button>
										</span>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <? $sOffice = selectAllOffice($page, $num, $search);
        if ($sOffice){?>
          <div class="table-scrollable">
            <table class="table table-striped table-bordered table-hover">
              <thead>
              <tr>
                <th>ID</th>
                <th>Адрес</th>
                <th>телефон</th>
                <th>email</th>
                <th>время работы</th>
                <th>Действия</th>
              </tr>
              </thead>
              <tbody>
              <? $n = 1 + $start;
              foreach ($sOffice as $item) { ?>
                <tr>
                  <td><?= $n ?></td>
                  <td><a href="/adminius/index.php?code=<?=$_GET['code']?>&action=edit&id=<?= $item["id"] ?>"><?= $item['address'] ?></a></td>
                  <td> <?= $item['phone'] ?> </td>
                  <td> <?= $item['email'] ?> </td>
                  <td> <?= $item["time_work"] ?></td>
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
          <? include($_SERVER['DOCUMENT_ROOT'] . '/adminius/templates/pagenav.tpl.php'); ?>
        <? }else{ ?>
        <h3> К сожалению но оффисов нет :(<h3>
        <? } ?>
      </div>
    </div>
    <!-- END SAMPLE TABLE PORTLET-->

  <? } ?>
<? } else { ?>
  <h3>Отказано в доступе, недостаточно прав.<h3>
<? } ?>