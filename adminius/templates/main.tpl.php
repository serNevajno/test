<div class="row">
  <?if($access['message_admin'] == '1'){?>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="dashboard-stat blue">
        <div class="visual">
          <i class="fa fa-comments"></i>
        </div>
        <div class="details">
          <div class="number">
            <?=selectMessagesMain()?>
          </div>
          <div class="desc">
            Всего запросов запчастей
          </div>
        </div>
        <a class="more" href="/adminius/index.php?code=message_admin">
          Смотреть все заявки <i class="m-icon-swapright m-icon-white"></i>
        </a>
      </div>
    </div>
  <?}?>
  <?if($access['orders'] == '1'){?>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="dashboard-stat green">
        <div class="visual">
          <i class="fa fa-shopping-cart"></i>
        </div>
        <div class="details">
          <div class="number">
            <?=selectCountOreders()?>
          </div>
          <div class="desc">
            Новых заказов
          </div>
        </div>
        <a class="more" href="/adminius/index.php?code=orders">
          Смотреть все заказы <i class="m-icon-swapright m-icon-white"></i>
        </a>
      </div>
    </div>
  <?}?>
  <?if($access['finance'] == '1'){?>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="dashboard-stat yellow">
        <div class="visual">
          <i class="fa fa-bar-chart-o"></i>
        </div>
        <div class="details">
          <div class="number">
            <?=selectSummOrderMain()?>.00 <span style="font-size:14px;">руб</span>
          </div>
          <div class="desc">
            Товаров продано на сумму
          </div>
        </div>
        <a class="more" href="/adminius/index.php?code=orders">
          Смотреть все продажи <i class="m-icon-swapright m-icon-white"></i>
        </a>
      </div>
    </div>
  <?}?>
  <?if($access['users'] == '1'){?>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="dashboard-stat purple">
        <div class="visual">
          <i class="fa fa-globe"></i>
        </div>
        <div class="details">
          <div class="number">
            <?=selectCountUserMain()?>
          </div>
          <div class="desc">
            Всего пользователей
          </div>
        </div>
        <a class="more" href="/adminius/index.php?code=users">
          Смотрерть всех пользователей <i class="m-icon-swapright m-icon-white"></i>
        </a>
      </div>
    </div>
  <?}?>

  <div class="col-md-12">
    <!-- BEGIN SAMPLE TABLE PORTLET-->
    <div class="portlet box green">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-cogs"></i>Рабочий стол
        </div>
        <div class="tools">
          <a href="javascript:;" class="collapse"></a>
        </div>
      </div>
        <div class="portlet-body flip-scroll">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab_0" data-toggle="tab">Шины</a>
                </li>
                <li>
                    <a href="#tab_1" data-toggle="tab">Диски</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active fontawesome-demo" id="tab_0">
                  <?include $_SERVER['DOCUMENT_ROOT']."/adminius/templates/form/workplace.tpl.php"?>
                </div>
                <div class="tab-pane glyphicons-demo" id="tab_1">
                    <div class="row">
                        <div class="col-md-12">

                            <form method="post" action="" onsubmit="return sProdWorkPlaceDisk(this);">
                                <div class="form-body">

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="articul_disk" placeholder="введите артикул">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="razmer_disk" placeholder="введите размерность диска">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <select class="form-control" name="brand" id="brand_disk">
                                                <option value="">Выберите бренд</option>
                                                <?foreach (selectDiskBrand() as $brand){?>
                                                    <option value="<?=$brand['id']?>"><?=$brand['name']?></option>
                                                <?}?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <button  type="submit" class="btn green" onclick="sProdWorkPlaceDisk()" >Поиск</button>
                                    </div>


                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?include $_SERVER['DOCUMENT_ROOT']."/adminius/templates/modals/modalKladr.tpl.php"?>
            <table class="table table-bordered table-striped table-condensed flip-content">
                <thead class="flip-content">
                <tr>
                    <th>
                        Артикул
                    </th>
                    <th>
                        Название
                    </th>
                    <th >
                        Поставщики
                    </th>
                </tr>
                </thead>
                <tbody id="resSearchProductWorkPlace">

                </tbody>
            </table>
        </div>
    </div>
    <!-- END SAMPLE TABLE PORTLET-->
    <?include $_SERVER['DOCUMENT_ROOT']."/adminius/templates/modals/newOrderWorkPlace.tpl.php"?>
		<?include $_SERVER['DOCUMENT_ROOT']."/adminius/templates/modals/combineProd.tpl.php"?>
  </div>

  <?  $id_admin = selectIdUserAdminSession();
  if((!$_COOKIE['startWorkTime'] OR $_COOKIE['startWorkTime'] == '') AND sLastUserAdmin($id_admin) == '0'){?>
    <script>
      window.onload = function(){
        $('#workTime').modal('show');
      }
    </script>
    <?include $_SERVER['DOCUMENT_ROOT']."/adminius/templates/modals/workTime.tpl.php"?>
  <?}?>
</div>