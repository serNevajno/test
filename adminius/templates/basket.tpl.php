<?if($access[$_GET['code']] == 1){?>
  <?if (isset($_GET["action"])){?>

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
    }
    if (isset($_GET["search"])) {
      $search = $_GET["search"];
    }else{
      $search = "";
    }?>
    <!-- BEGIN SAMPLE TABLE PORTLET-->
    <div class="portlet box purple">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-cogs"></i>Корзина покупателей
        </div>
        <div class="tools">
          <a href="javascript:;" class="collapse"></a>
          <a href="javascript:;" class="reload"></a>
        </div>
      </div>
      <div class="portlet-body">
        <div class="row">
          <div class="col-md-6 col-sm-12">
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
          <div style="float:right;">
            <div class="dataTables_filter" id="sample_1_filter">
              <div class="col-md-6">
                <div class="input-group input-medium">
                  <form action="/adminius/index.php" method="GET" style=" display: inline-table;">
                    <input name="code" type="hidden" value="<?=$_GET['code']?>"/>
                    <input type="text" class="form-control" placeholder="поиск по покупателям" name="search" value="<?=$_GET['search']?>">
                    <span class="input-group-btn">
											<button class="btn blue" type="sumbit"><font><font>Поиск</font></font></button>
										</span>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?$sBasket = selectAllProductBasket($page, $num, $search);
        if (!empty($sBasket)):?>
          <div class="table-scrollable">
            <table class="table table-striped table-bordered table-hover">
              <thead>
              <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Количество</th>
                <th>Покупатель</th>
                <th>Дата</th>
              </tr>
              </thead>
              <tbody>
              <?$n=1+$start;
              foreach ($sBasket as $item){
                ?>
                <tr>
                  <td><?=$n?></td>
                  <td><a href="/adminius/index.php?code=product&action=edit&id=<?=$item['product_id']?>"><?=$item['name_prod']?></a></td>
                  <td><?=$item['quantity']?></td>
                  <td><?=($item['name_user'])? '<a href="/adminius/index.php?code=users&action=detail&id='.$item[user_id].'">'.$item['name_user'].'</a>' : "Незарегистрированный пользователь"; ?></td>
                  <td><?=$item['date']?></td>
                </tr>
                <?$n++;?>
              <?}?>
              </tbody>
            </table>
          </div>
          <?include($_SERVER['DOCUMENT_ROOT'].'/adminius/templates/pagenav.tpl.php');?>
        <?else:?>
        <h3> К сожалению но товар не найден :(<h3>
            <?endif;?>
      </div>
    </div>
    <!-- END SAMPLE TABLE PORTLET-->

  <?}?>
<?}else{?>
  <h3>Отказано в доступе, недостаточно прав.<h3>
<?}?>