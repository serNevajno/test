<? if ($access["product"] == 1){ ?>
  <? if (isset($_GET["action"])): ?>
    <? if ($_GET["action"] == "add"): ?>
      <!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
      <!-- BEGIN PAGE CONTENT-->
      <div class="row">
        <div class="col-md-12">
          <div class="tabbable tabbable-custom">
            <h2>Добавление товара</h2>
            <br>
            <form role="form" action="index.php" enctype="multipart/form-data" method="POST" name="form" id="myForm">
              <input name="func" type="hidden" value="product">
              <input name="categories" type="hidden" value="<?= $_GET["cat"] ?>">
              <ul class="nav nav-tabs">
                <li class="active">
                  <a href="#tab_0" data-toggle="tab">Элемент</a>
                </li>
                <li>
                  <a href="#tab_3" data-toggle="tab">Мета</a>
                </li>
                <li>
                  <a href="#tab_1" data-toggle="tab">Подробно</a>
                </li>
                <li>
                  <a href="#tab_2" data-toggle="tab">Галерея</a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active fontawesome-demo" id="tab_0">
                  <div class="form-body">
                    <div class="form-group">
                      <div class="checkbox-list">
                        <b>Активность:</b>&nbsp; <input type="checkbox" value="1" name="active">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="checkbox-list">
                        <b>На главной:</b>&nbsp; <input type="checkbox" value="1" name="main">
                      </div>
                    </div>
                    <div class="form-group">
                      <label><b>Сортировка:</b> </label>
                      <input type="text" class="form-control input-medium" id="priority" name="priority"
                             placeholder="Введите приоритет">
                    </div>
                    <div class="form-group">
                      <label><b>Название товара</b></label>
                      <br>
                      <input type="text" class="form-control" id="name" name="name"
                             placeholder="Введите название товара" required>
                    </div>
                    <div class="form-group">
                      <label><b>Артикул:</b></label>
                      <div class="input-group input-medium">
													<span class="input-group-addon">
														№
													</span>
                        <input type="text" class="form-control" id="article" name="article"
                               placeholder="Введите артикул" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label><b>Цена:</b></label>
                      <div class="input-group input-medium">
													<span class="input-group-addon">
														$
													</span>
                        <input type="text" class="form-control" id="price" name="price" placeholder="Введите цену"
                               required>
                      </div>
                    </div>
                    <div class="form-group">
                          <label><b>Цена закупа:</b></label>
                          <div class="input-group input-medium">
													<span class="input-group-addon">
														$
													</span>
                              <input type="text" class="form-control" id="price_clear" name="price_clear" placeholder="Введите цену"
                                     required>
                          </div>
                    </div>
                    <div class="form-group">
                      <label><b>Скидка:</b></label>
                      <div class="input-group input-medium">
													<span class="input-group-addon">
														%
													</span>
                        <input type="text" class="form-control" id="sale" name="sale" placeholder="Введите скидку">
                      </div>
                    </div>
                    <div class="form-group">
                      <label><b>Наличие:</b></label>
                      <div class="input-group input-medium">
													<span class="input-group-addon">
														
													</span>
                        <input type="text" class="form-control" name="availability" placeholder="Введите количество">
                      </div>
                    </div>
                    <div class="form-group">
                      <label><b>Доставка(дней):</b></label>
                      <div class="input-group input-medium">
													<span class="input-group-addon">
														<i class="fa fa-truck"></i>
													</span>
                        <input type="text" class="form-control" name="logistic" placeholder="Введите срок доставки">
                      </div>
                    </div>
                    <div class="form-group">
                      <label style="padding-top:10px;"><b>Внимание:</b> </label>
                      <select name="attention" class="form-control input-medium">
                        <option value="0" selected="">Нет</option>
                        <option value="1">Новинка</option>
                        <option value="2">Лидер продаж</option>
                      </select>
                    </div>
                    <div class="form-group">
                        <label><b>Дополнительные артикулы:</b></label>
                        <br>
                         <input type="text" class="form-control" name="dop_articles" placeholder="Введите артикулы товаров через запятую">
                    </div>
                    <div class="form-group">
                      <label><b>Cопутствующие товары:</b></label>
                      <br>
                      <input type="text" class="form-control" id="related" name="related"
                             placeholder="Введите номера товаров через запятую">
                    </div>
                  </div>
                </div>
                <div class="tab-pane glyphicons-demo" id="tab_3">
                  <div class="form-body">
                    <div class="form-group">
                      <label><b>Meta заголовок:</b> </label>
                      <br>
                      <input type="text" class="form-control" id="title" name="title" placeholder="Введите title">
                    </div>
                    <div class="form-group">
                      <label><b>Metа ключевые слова:</b> </label>
                      <br>
                      <input type="text" class="form-control" id="meta_k" name="meta_k"
                             placeholder="Введите ключевые слова">
                    </div>
                    <div class="form-group">
                      <label><b>Meta описание:</b> </label>
                      <br>
                      <input type="text" class="form-control" id="meta_d" name="meta_d" placeholder="Введите описание">
                    </div>
                    <div class="form-group">
                      <label><b>Символьный код:</b> </label>
                      <br>
                      <input type="text" class="form-control" id="code" name="code"
                             placeholder="Введите символьный код">
                    </div>
                  </div>
                </div>
                <div class="tab-pane glyphicons-demo" id="tab_1">
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
															<input type="file" class="default" name="img"/>
														</span>
                          <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i
                                class="fa fa-trash-o"></i> Удалить</a>
                        </div>
                      </div>
                    </div>
                    <label><b>Описание товара: </b></label>
                    <br>
                    <textarea class="form-control" rows="5" name="description" id="description"></textarea>
                    <script type="text/javascript">
                      CKEDITOR.replace('description');
                    </script>
                    <div class="form-group">
                      <label><b>Видео (Youtube):</b></label>
                      <br>
                      <input type="text" class="form-control" name="video"
                             placeholder="Введите ссылку на видео с Youtube">
                    </div>
                  </div>
                </div>
                <div class="tab-pane glyphicons-demo" id="tab_2">
                  <div class="form-group">
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
															<input type="file" class="default" name="photo[0]"/>
														</span>
                        <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i
                              class="fa fa-trash-o"></i> Удалить</a>
                      </div>
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
															<input type="file" class="default" name="photo[1]"/>
														</span>
                        <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i
                              class="fa fa-trash-o"></i> Удалить</a>
                      </div>
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
															<input type="file" class="default" name="photo[2]"/>
														</span>
                        <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i
                              class="fa fa-trash-o"></i> Удалить</a>
                      </div>
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
															<input type="file" class="default" name="photo[3]"/>
														</span>
                        <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i
                              class="fa fa-trash-o"></i> Удалить</a>
                      </div>
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
															<input type="file" class="default" name="photo[4]"/>
														</span>
                        <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i
                              class="fa fa-trash-o"></i> Удалить</a>
                      </div>
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
															<input type="file" class="default" name="photo[5]"/>
														</span>
                        <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i
                              class="fa fa-trash-o"></i> Удалить</a>
                      </div>
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
															<input type="file" class="default" name="photo[6]"/>
														</span>
                        <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i
                              class="fa fa-trash-o"></i> Удалить</a>
                      </div>
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
															<input type="file" class="default" name="photo[7]"/>
														</span>
                        <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i
                              class="fa fa-trash-o"></i> Удалить</a>
                      </div>
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
															<input type="file" class="default" name="photo[8]"/>
														</span>
                        <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i
                              class="fa fa-trash-o"></i> Удалить</a>
                      </div>
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
															<input type="file" class="default" name="photo[9]"/>
														</span>
                        <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i
                              class="fa fa-trash-o"></i> Удалить</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-actions">
                <button type="submit" class="btn blue" name="submit">Сохранить</button>
                <button type="button" class="btn default"
                        onClick='location.href="/adminius/index.php?code=product&cat=<?= $_GET["cat"] ?>"'>Отмена
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
    <? elseif ($_GET["action"] == "edit"): ?>
      <? $item_product = selectProductById($_GET["id"]); ?>
      <!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
      <!-- BEGIN PAGE CONTENT-->
      <div class="row">
        <div class="col-md-12">
          <div class="tabbable tabbable-custom">
            <h2>Редактирование товара</h2>
            <br>
            <form role="form" action="index.php" enctype="multipart/form-data" method="POST" name="form" id="myForm">
              <input name="func" type="hidden" value="product">
              <input name="id" type="hidden" value="<?= $_GET["id"] ?>">
              <input name="cat_old" type="hidden" value="<?= $item_product["categories"] ?>">
              <input name="categories" type="hidden" value="<?= $item_product["categories"] ?>">
              <ul class="nav nav-tabs">
                <li class="active">
                  <a href="#tab_0" data-toggle="tab">Элемент</a>
                </li>
                <li>
                  <a href="#tab_1" data-toggle="tab">Мета</a>
                </li>
                <li>
                  <a href="#tab_2" data-toggle="tab">Подробно</a>
                </li>
                <li>
                  <a href="#tab_3" data-toggle="tab">Фильтр</a>
                </li>
                <li>
                  <a href="#tab_5" data-toggle="tab">Галерея</a>
                </li>
                <?/*<li>
                  <a href="#tab_6" data-toggle="tab">Раздел</a>
                </li>*/?>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active fontawesome-demo" id="tab_0">
                  <div class="form-body">
                    <div class="form-group">
                      <div class="checkbox-list">
                        <b>Активность:</b>&nbsp; <input type="checkbox" value="1"
                                                        name="active" <? if ($item_product["active"] == 1) echo "checked"; ?>>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="checkbox-list">
                        <b>На главной:</b>&nbsp; <input type="checkbox" value="1"
                                                        name="main" <? if ($item_product["main"] == 1) echo "checked"; ?>>
                      </div>
                    </div>
                    <div class="form-group">
                      <label><b>Сортировка:</b> </label>
                      <input type="text" class="form-control input-medium" id="priority" name="priority"
                             placeholder="Введите приоритет" value="<?= $item_product["priority"] ?>">
                    </div>
                    <div class="form-group">
                      <label><b>Название товара</b></label>
                      <br>
                      <input type="text" class="form-control" id="name" name="name"
                             placeholder="Введите название товара" value="<?= $item_product["name"] ?>">
                    </div>
                    <div class="form-group">
                      <label><b>Артикул:</b></label>
                      <div class="input-group input-medium">
													<span class="input-group-addon">
														№
													</span>
                        <input type="text" class="form-control" id="article" name="article"
                               placeholder="Введите артикул" value="<?= $item_product["article"] ?>" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label><b>Цена:</b></label>
                      <div class="input-group input-medium">
													<span class="input-group-addon">
														$
													</span>
                        <input type="text" class="form-control" id="price" name="price" placeholder="Введите скидку"
                               value="<?= $item_product["price"] ?>">
                      </div>
                    </div>
                    <div class="form-group">
                          <label><b>Цена закупа:</b></label>
                          <div class="input-group input-medium">
													<span class="input-group-addon">
														$
													</span>
                              <input type="text" class="form-control" id="price_clear" name="price_clear" placeholder="Введите цену" value="<?= $item_product["price_clear"] ?>" required>
                          </div>
                    </div>
                    <div class="form-group">
                      <label><b>Скидка:</b></label>
                      <div class="input-group input-medium">
													<span class="input-group-addon">
														%
													</span>
                        <input type="text" class="form-control" id="sale" name="sale" placeholder="Введите скидку"
                               value="<?= $item_product["sale"] ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label><b>Наличие:</b></label>
                      <div class="input-group input-medium">
													<span class="input-group-addon">
														
													</span>
                        <input type="text" class="form-control" name="availability" placeholder="Введите количество"
                               value="<?= $item_product["availability"] ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label><b>Доставка(дней):</b></label>
                      <div class="input-group input-medium">
													<span class="input-group-addon">
														<i class="fa fa-truck"></i>
													</span>
                        <input type="text" class="form-control" name="logistic" placeholder="Введите срок доставки"
                               value="<?= $item_product["logistic"] ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label style="padding-top:10px;"><b>Внимание:</b> </label>
                      <select name="attention" class="form-control input-medium">
                        <option value="0" <? if ($item_product["attention"] == 0) echo "selected"; ?>>Нет</option>
                        <option value="1" <? if ($item_product["attention"] == 1) echo "selected"; ?>>Новинка</option>
                        <option value="2" <? if ($item_product["attention"] == 2) echo "selected"; ?>>Лидер продаж
                        </option>
                      </select>
                    </div>
                    <div class="form-group">
                          <label><b>Дополнительные артикулы:</b></label>
                          <br>
                          <input type="text" class="form-control" name="dop_articles" placeholder="Введите артикулы товаров через запятую" value="<?=selectDopArticles($_GET["id"])?>">
                    </div>
                    <div class="form-group">
                      <label><b>Cопутствующие товары:</b> </label>
                      <br>
                      <input type="text" class="form-control" id="related" name="related"
                             placeholder="Введите номера товаров через запятую" value="<?= $item_product["related"] ?>">
                    </div>
                  </div>
                </div>
                <div class="tab-pane glyphicons-demo" id="tab_1">
                  <div class="form-body">
                    <div class="form-group">
                      <label><b>Meta заголовок:</b> </label>
                      <br>
                      <input type="text" class="form-control" id="title" name="title" placeholder="Введите title"
                             value="<?= $item_product["title"] ?>">
                    </div>
                    <div class="form-group">
                      <label><b>Metа ключевые слова:</b> </label>
                      <br>
                      <input type="text" class="form-control" id="meta_k" name="meta_k"
                             placeholder="Введите ключевые слова" value="<?= $item_product["meta_k"] ?>">
                    </div>
                    <div class="form-group">
                      <label><b>Meta описание:</b> </label>
                      <br>
                      <input type="text" class="form-control" id="meta_d" name="meta_d" placeholder="Введите описание"
                             value="<?= $item_product["meta_d"] ?>">
                    </div>
                    <div class="form-group">
                      <label><b>Символьный код:</b> </label>
                      <br>
                      <input type="text" class="form-control" id="code" name="code" placeholder="Введите символьный код"
                             value="<?= $item_product["code"] ?>">
                    </div>
                  </div>
                </div>
                <div class="tab-pane glyphicons-demo" id="tab_2">
                  <div class="form-body">
                    <div class="form-group">
                      <div class="thumbnail" style="width: 310px;">
                        <? if (empty($item_product["img"])): ?>
                          <img src="http://www.placehold.it/310x170/EFEFEF/AAAAAA&amp;text=no+image" alt="">
                        <? else: ?>
                          <img src="/images/product_cover/<?= $item_product["img"] ?>" alt="">
                        <? endif; ?>
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
															<input type="file" class="default" name="img"/>
														</span>
                          <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i
                                class="fa fa-trash-o"></i> Удалить</a>
                        </div>
                      </div>
                    </div>
                    <label><b>Описание товара: </b></label>
                    <br>
                    <textarea class="form-control" rows="5" name="description"
                              id="description"><?= $item_product["description"] ?></textarea>
                    <script type="text/javascript">
                      CKEDITOR.replace('description');
                    </script>
                    <div class="form-group">
                      <label><b>Видео (Youtube):</b></label>
                      <br>
                      <input type="text" class="form-control" name="video"
                             placeholder="Введите ссылку на видео с Youtube"
                             value="<?= $item_product["youtube_url"] ?>">
                    </div>
                  </div>
                </div>
                <div class="tab-pane glyphicons-demo" id="tab_3">
                  <div class="form-group">
                    <div class="form-body">
                      <? $select_filter = selectFilter($item_product["categories"]); ?>
                      <? if ($select_filter): ?>
                        <? foreach ($select_filter as $item_fil): ?>
                          <? if ($item_fil["type"] == 1): ?>
                            <div class="form-group">
                              <label style="padding-top:10px;"><b><?= $item_fil["name"] ?>:</b> </label>
                              <select name="fil_element[<?= $item_fil["id"] ?>]" class="form-control input-medium">
                                <option value="0" selected="">Не выбрано</option>
                                <? $select_filter_element = selectFilterElement($item_fil["id"]);
                                foreach ($select_filter_element as $item_fil_elem):?>
                                  <option
                                      value="<?= $item_fil_elem["id"] ?>" <? if (selectElementValue($_GET["id"], $item_fil["id"]) == $item_fil_elem["id"]) echo "selected"; ?>><?= $item_fil_elem["value"] ?></option>
                                <? endforeach; ?>
                              </select>
                            </div>
                          <? else: ?>
                            <div class="form-group">
                              <label><b><?= $item_fil["name"] ?></b> </label>
                              <br>
                              <input type="text" class="form-control input-medium"
                                     name="fil_element[<?= $item_fil["id"] ?>]" placeholder="Введите значение:"
                                     value="<?= selectElementValue($_GET["id"], $item_fil["id"]); ?>">
                            </div>
                          <? endif; ?>
                        <? endforeach; ?>
                      <? endif; ?>
                    </div>
                  </div>
                </div>
                <div class="tab-pane glyphicons-demo" id="tab_5">
                  <div class="form-group">
                    <? $select_gallery = selectGallery($_GET["id"]);
                    $n = 0;
                    foreach ($select_gallery as $item_gallery):?>
                      <div class="thumbnail" style="margin-bottom: 0; margin-top: 20px; width: 310px;">
                        <img src="/images/product_gallery/<?= $item_gallery["img"] ?>" alt="">
                      </div>
                      <div class="checkbox-list">
                        <input type="checkbox" name="del_photo[<?= $n ?>]" value="1">Удалить
                      </div>
                      <input name="id_photo[<?= $n ?>]" type="hidden" value="<?= $item_gallery["id"] ?>">
                      <? $n++; ?>
                    <? endforeach; ?>
                    <input name="n" type="hidden" value="<?= $n ?>">
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
															<input type="file" class="default" name="photo[0]"/>
														</span>
                        <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i
                              class="fa fa-trash-o"></i> Удалить</a>
                      </div>
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
															<input type="file" class="default" name="photo[1]"/>
														</span>
                        <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i
                              class="fa fa-trash-o"></i> Удалить</a>
                      </div>
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
															<input type="file" class="default" name="photo[2]"/>
														</span>
                        <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i
                              class="fa fa-trash-o"></i> Удалить</a>
                      </div>
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
															<input type="file" class="default" name="photo[3]"/>
														</span>
                        <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i
                              class="fa fa-trash-o"></i> Удалить</a>
                      </div>
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
															<input type="file" class="default" name="photo[4]"/>
														</span>
                        <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i
                              class="fa fa-trash-o"></i> Удалить</a>
                      </div>
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
															<input type="file" class="default" name="photo[5]"/>
														</span>
                        <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i
                              class="fa fa-trash-o"></i> Удалить</a>
                      </div>
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
															<input type="file" class="default" name="photo[6]"/>
														</span>
                        <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i
                              class="fa fa-trash-o"></i> Удалить</a>
                      </div>
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
															<input type="file" class="default" name="photo[7]"/>
														</span>
                        <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i
                              class="fa fa-trash-o"></i> Удалить</a>
                      </div>
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
															<input type="file" class="default" name="photo[8]"/>
														</span>
                        <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i
                              class="fa fa-trash-o"></i> Удалить</a>
                      </div>
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
															<input type="file" class="default" name="photo[9]"/>
														</span>
                        <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i
                              class="fa fa-trash-o"></i> Удалить</a>
                      </div>
                    </div>
                  </div>
                </div>
                  <?/*<div class="tab-pane glyphicons-demo" id="tab_6">
                  <div class="form-group">
                    <div class="form-group">
                      <div class="note note-warning">
                        <p>
                          При смене категории данного товара фильтры будут удалены
                        </p>
                      </div>
                      <label><b>Категория:</b> </label>
                      <br>
                      <select name="categories" class="form-control input-medium">
                        <? recusiveCategories(0, "", $item_product["categories"]); ?>
                      </select>
                    </div>
                  </div>
                </div>*/?>
              </div>
              <div class="form-actions">
                <button type="submit" class="btn blue" name="submit">Сохранить</button>
                <button type="button" class="btn default"
                        onClick='location.href="/adminius/index.php?code=product&cat=<?= $item_product["categories"] ?>"'>
                  Отмена
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
    <? elseif ($_GET["action"] == "search"): ?>
      <!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
      <?
      if (isset($_GET["limit"])) {
        $num = clearData($_GET["limit"], "i");
      } else {
        $num = 10;
      }
      if (isset($_GET["page"])) {
        $page = clearData($_GET["page"], "i");
      } else {
        $page = 1;
      }
      ?>
            <script>
                function uploadFile() {
                    var formData = new FormData(document.getElementById('formUpFile'));

                    $.ajax({
                        url: '/adminius/inc/uploadFileCSV.inc.php',
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
                    $("#blockButton").hide();
                    $("#progressBarDiv").show();
                    var proc = '0';

                    $.ajax({
                        type: "POST",
                        url: "/adminius/inc/upload_price.inc.php",
                        dataType: "html",
                        data: "count="+countPr,
                        success: function (msg) {
                            if(total>100) {
                                if (+total >= +msg) {
                                    proc = msg / (total / 100);
                                    $("#progressBar").outerWidth(proc + "%");
                                    uploadProductCSV(msg, total);
                                } else {
                                    $("#resText").show();
                                }
                            }else{
                                $("#progressBar").outerWidth("100%");
                                $("#resText").show();
                            }
                        }
                    });
                }
            </script>
      <!-- BEGIN EXAMPLE TABLE PORTLET-->
      <div class="portlet box blue">
        <div class="portlet-title">
          <div class="caption">
            <i class="fa fa-reorder"></i> Форма поиска
          </div>
        </div>
        <div class="portlet-body form">
          <form role="form" method="GET" action="/adminius/index.php?code=product&action=search">
            <input name="code" type="hidden" value="product">
            <input name="action" type="hidden" value="search">
            <div class="form-body">
              <div class="form-group">
                <label>Артикул</label>
                <input type="text" name="article" class="form-control" placeholder="Введите артикул"
                       value="<?= $_GET["article"] ?>">
              </div>
              <div class="form-group">
                ИЛИ
              </div>
              <div class="form-group">
                <label class="">Активность</label>
                <div class="radio-list">
                  <label class="radio-inline">
                    <input type="radio" name="active" value="0" <? if ($_GET["active"] == 0) echo "checked"; ?>> Все
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="active" value="1" <? if ($_GET["active"] == 1) echo "checked"; ?>>
                    Активные </label>
                  <label class="radio-inline">
                    <input type="radio" name="active" value="2" <? if ($_GET["active"] == 2) echo "checked"; ?>> Не
                                                                                                                 активные
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label>Название</label>
                <input type="text" name="name" class="form-control" placeholder="Введите название"
                       value="<?= $_GET["name"] ?>">
              </div>


              <div class="form-group">
                <label>Внимание</label>
                <select class="form-control" name="attention">
                  <option value="0" <? if ($_GET["attention"] == 0) echo "selected"; ?>>Нет</option>
                  <option value="1" <? if ($_GET["attention"] == 1) echo "selected"; ?>>Новинка</option>
                  <option value="2" <? if ($_GET["attention"] == 2) echo "selected"; ?>>Лидер продаж</option>
                </select>
              </div>
              <div class="form-group">
                <label>Категория</label>
                <select class="form-control" name="categories">
                  <option value="">Все</option>
                  <? recusiveCategories(0, "0", $_GET["categories"]) ?>
                </select>
              </div>
            </div>
            <div class="form-actions">
              <button type="submit" class="btn blue">Поиск</button>
            </div>
          </form>

        </div>

        <div class="portlet box blue">
          <div class="portlet-body">
            <div class="table-toolbar">
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
              <div class="fileupload fileupload-new" data-provides="fileupload"
                   style="display: inline; margin-bottom: 0; margin-left: 10px;" id="blockButton">

                <form style="display: inline;" id="formUpFile">
                  <span class="btn default btn-file">
																		<span class="fileupload-new">
																			<i class="fa fa-paper-clip"></i> Загрузить CVS
																		</span>
																		<span class="fileupload-exists">
																			<i class="fa fa-undo"></i> Заменить
																		</span>
																		<input type="file" class="default" name="product"/>
														</span>
                  <span class="fileupload-preview" style="margin-left:5px;">
														</span>
                  <a href="#" class="close fileupload-exists" data-dismiss="fileupload"
                     style="float: none; margin-left:5px;"></a>
                  <a class="btn purple" onClick="uploadFile();"><i class="fa fa-check"></i> Отправить</a>
                </form>
                <form action="index.php" method="post" enctype="multipart/form-data" style="display: inline;">
                  <input name="func" type="hidden" value="exports_product">
                  <input name="categories" type="hidden" value="<?= $_GET["categories"] ?>">
                  <input name="article" type="hidden" value="<?= $_GET["article"] ?>">
                  <input name="active" type="hidden" value="<?= $_GET["active"] ?>">
                  <input name="name" type="hidden" value="<?= $_GET["name"] ?>">
                  <input name="attention" type="hidden" value="<?= $_GET["attention"] ?>">
                  <button class="btn yellow" type="submit"><i class="fa fa-check"></i> Скачать CSV</button>
                </form>
                  <form action="index.php" method="post" enctype="multipart/form-data" style="display: inline;">
                      <input name="func" type="hidden" value="exports_product_simp">
                      <input name="categories" type="hidden" value="<?= $_GET["categories"] ?>">
                      <input name="article" type="hidden" value="<?= $_GET["article"] ?>">
                      <input name="active" type="hidden" value="<?= $_GET["active"] ?>">
                      <input name="name" type="hidden" value="<?= $_GET["name"] ?>">
                      <input name="attention" type="hidden" value="<?= $_GET["attention"] ?>">
                      <button class="btn yellow" type="submit"><i class="fa fa-check"></i> Скачать упрощенный CSV</button>
                  </form>
              </div>
            </div>
          </div>
        </div>
        <div class="portlet-body">
          <? $select_product = selectSearchProduct($page, $num, $_GET["active"], $_GET["name"], $_GET["article"], $_GET["provider"], $_GET["brand"], $_GET["attention"], $_GET["categories"]);
          if ($select_product){
            ?>
            <table class="table table-striped table-bordered table-hover" id="sample_1">
              <thead>
              <tr>
                <th>№</th>
                <th>Название</th>
                <th>Действия</th>
              </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
              <? $n = 1 + $start;
              foreach ($select_product as $item):
                ?>
                <tr class="odd">
                  <td class=" sorting_1"><span
                      <? if (isset($item["active"])): ?>class="label label-sm label-<?= $item["active"] == 1 ? "success" : "danger"; ?>"<? endif;
                    ?>><?= $n ?></span></td>
                  <td class=""><?= $item["name"] ?></td>
                  <td class="">
                    <a class="btn btn-xs blue btn-editable" data-id="1"
                       href="/adminius/index.php?code=product&action=edit&id=<?= $item["id"] ?>"><i
                          class="fa fa-pencil"></i></a>
                  </td>
                </tr>
                <? $n++; ?>
              <? endforeach; ?>
              </tbody>
            </table>
            <? include($_SERVER['DOCUMENT_ROOT'] . '/adminius/templates/pagenav.tpl.php'); ?>
          <? }else{
          ?>
          <h3> По Вашему запросу ничего не найдено!<h3>
              <? } ?>
        </div>
      </div>
      <!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
    <? elseif ($_GET["action"] == "upload"): ?>
      <? include($_SERVER['DOCUMENT_ROOT'] . '/adminius/templates/upload.product.tpl.php'); ?>
    <? elseif ($_GET["action"] == "storage"): ?>
      <? include($_SERVER['DOCUMENT_ROOT'] . '/adminius/templates/storage.product.tpl.php'); ?>
    <? endif; ?>
  <? else: ?>
    <!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
    <?
    if (isset($_GET["limit"])) {
      $num = clearData($_GET["limit"], "i");
    } else {
      $num = 100;
    }
    if (isset($_GET["page"])) {
      $page = clearData($_GET["page"], "i");
    } else {
      $page = 1;
    }
    ?>
        <script>
            function uploadFile() {
                var formData = new FormData(document.getElementById('formUpFile'));

                $.ajax({
                    url: '/adminius/inc/uploadFileCSV.inc.php',
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
                $("#blockButton").hide();
                $("#progressBarDiv").show();
                var proc = '0';

                $.ajax({
                    type: "POST",
                    url: "/adminius/inc/upload_price.inc.php",
                    dataType: "html",
                    data: "count="+countPr+"&filter=1&cat=<?= $_GET["cat"] ?>",
                    success: function (msg) {
                        if(total>100) {
                            if (+total >= +msg) {
                                proc = msg / (total / 100);
                                $("#progressBar").outerWidth(proc + "%");
                                uploadProductCSV(msg, total);
                            } else {
                                $("#resText").show();
                            }
                        }else{
                            $("#progressBar").outerWidth("100%");
                            $("#resText").show();
                        }
                    }
                });
            }
        </script>
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet box blue">
      <div class="portlet-title">
        <div class="tools">
        </div>
      </div>
      <div class="portlet-body">
        <div class="table-toolbar">
          <div class="col-md-8">
              <button id="sample_editable_1_new" class="btn green"
                      onClick='location.href="/adminius/index.php?code=product&action=add&cat=<?= $_GET["cat"] ?>"'>
                Добавить <i class="fa fa-plus"></i>
              </button>
              <button class="btn blue" onClick='location.href="/adminius/index.php?code=product&action=search"'>
                <font>Поиск</font></button>
          </div>
          <div class="col-md-2">
                <label style="float:right;">
                    <select size="1" name="limit" aria-controls="sample_1" class="form-control input-medium" onchange='location.href="index.php?code=product<?= getUrlSort() ?>&sort="+this.value'>
                        <option value="2" <? if ($_GET["sort"] == 2) echo "selected='selected'"; ?>>По названию</option>
                        <option value="1" <? if ($_GET["sort"] == 1) echo "selected='selected'"; ?>>По дате</option>
                        <option value="3" <? if ($_GET["sort"] == 3) echo "selected='selected'"; ?>>От дешевых</option>
                        <option value="4" <? if ($_GET["sort"] == 4) echo "selected='selected'"; ?>>От дорогих</option>
                    </select>
                </label>
          </div>
          <div class="col-md-2">
              <label style="float:right;">
                <select size="1" name="limit" aria-controls="sample_1" class="form-control input-small"
                        onchange='location.href="index.php?code=product<?=getUrlLimit()?>&limit="+this.value'>
                  <option value="10" <? if ($num == 10) echo "selected='selected'"; ?>>10</option>
                  <option value="25" <? if ($num == 25) echo "selected='selected'"; ?>>25</option>
                  <option value="50" <? if ($num == 50) echo "selected='selected'"; ?>>50</option>
                  <option value="100" <? if ($num == 100) echo "selected='selected'"; ?>>100</option>
                    <option value="500" <? if ($num == 500) echo "selected='selected'"; ?>>500</option>
                </select>
              </label>
          </div>
        </div>
        <? $select_product = selectProduct($page, $num, $_GET["cat"], $_GET["sort"]); ?>
        <? if ($select_product){ ?>
          <form method="POST" name="product" id="product">
            <input name="func" type="hidden" value="product">
            <input name="cat" type="hidden" value="<?= $_GET["cat"]; ?>">
          <table class="table table-striped table-bordered table-hover" id="sample_1">
            <thead>
            <tr>
              <th>№ <input type="checkbox" name="total" id="check_all"></th>
              <th>Название</th>
              <th>Действия</th>
            </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">
            <? $n = 1 + $start;
            foreach ($select_product as $item):
              ?>
              <tr class="odd">
                <td class=" sorting_1"><span
                      class="ch label label-sm label-<?= $item["active"] == 1 ? "success" : "danger"; ?>"><input type="checkbox" name="product[]" value="<?= $item["id"] ?>" class="checkbox"> <?= $n ?></span>
                </td>
              </form>
                <td class=""><?= $item["name"] ?></td>
                <td class="">
                  <a class="btn btn-xs blue btn-editable" data-id="1"
                     href="/adminius/index.php?code=product&action=edit&id=<?= $item["id"] ?>"><i
                        class="fa fa-pencil"></i></a>
                  <? if ($access["del"] == 1) {
                    ?>
                    <form action="index.php" method="POST" name="delform<?= $item['id'] ?>" style="display:none;">
                      <input name="func" type="hidden" value="product">
                      <input name="id" type="hidden" value="<?= $item['id'] ?>">
                      <input name="cat" type="hidden" value="<?= $_GET["cat"]; ?>">
                    </form>
                    <a class="btn btn-xs red btn-removable" data-id="1"
                       href="javascript:if(confirm('Вы уверены?')){delform<?= $item['id'] ?>.submit();}"><i
                          class="fa fa-times"></i></a>
                  <? } ?>
                </td>
              </tr>
              <? $n++; ?>
            <? endforeach; ?>
            </tbody>
          </table>

          <input type="hidden" value="<?=$_GET['cat']?>" id="getCat">
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <span>С отмеченными: </span>
                <select class="form-control input-medium" name="categories" id="Cat">
                  <option value="">Выберете категорию</option>
                  <? recusiveCategories(0, "0", $_GET["categories"]) ?>
                </select>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <span>.</span>
                <select class="form-control input-medium" name="subCat" id="subCat">

                </select>
              </div>
            </div>
            <div class="col-md-1">
              <a class="btn blue btn-removable" style="margin-top: 19px;" data-id="1"
                 href="javascript:if(confirm('Вы уверены?')){actionProduct();}">Перенести</a>
            </div>
            <div class="col-md-1">
              <? if ($access["del"] == 1) { ?>
                <a class="btn red btn-removable" style="margin-top: 19px;" data-id="1"
                   href="javascript:if(confirm('Вы уверены?')){product.submit();}">Удалить</a>
              <? } ?>
            </div>
          </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
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
                        <div class="fileupload fileupload-new" data-provides="fileupload"
                             style="display: inline; margin-bottom: 0; margin-left: 10px;" id="blockButton">

                            <form style="display: inline;" id="formUpFile">
                  <span class="btn default btn-file">
																		<span class="fileupload-new">
																			<i class="fa fa-paper-clip"></i> Загрузить CVS
																		</span>
																		<span class="fileupload-exists">
																			<i class="fa fa-undo"></i> Заменить
																		</span>
																		<input type="file" class="default" name="product"/>
														</span>
                                <span class="fileupload-preview" style="margin-left:5px;">
														</span>
                                <a href="#" class="close fileupload-exists" data-dismiss="fileupload"
                                   style="float: none; margin-left:5px;"></a>
                                <a class="btn purple" onClick="uploadFile();"><i class="fa fa-check"></i> Отправить</a>
                            </form>
                            <form action="index.php" method="post" enctype="multipart/form-data" style="display: inline;">
                                <input name="func" type="hidden" value="exports_product">
                                <input name="categories" type="hidden" value="<?= $_GET["cat"] ?>">
                                <button class="btn yellow" type="submit"><i class="fa fa-check"></i> Скачать CSV</button>
                            </form>
                        </div>
                    </div>
                </div>
          <? include($_SERVER['DOCUMENT_ROOT'] . '/adminius/templates/pagenav.tpl.php'); ?>
        <?}else{?>
            <h3> К сожалению но товаров нет :(<h3>
        <?}?>
      </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
    <!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
  <? endif; ?>
<? }else{ ?>
<h3>Отказано в доступе, недостаточно прав.<h3>
    <? } ?>