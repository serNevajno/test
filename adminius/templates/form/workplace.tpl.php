
<div class="row">
  <div class="col-md-12">

    <form method="post" action="" onsubmit="return sProdWorkPlace(this);">
      <div class="form-body">

        <div class="col-md-2">
          <div class="form-group">
            <input type="text" class="form-control" id="articul" placeholder="введите артикул">
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <input type="text" class="form-control" id="razmer" placeholder="введите размерность шин">
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <select class="form-control" name="brend" id="brend">
              <option value="">Выберите бренд</option>
              <?foreach (selectTyresBrand() as $brend){?>
                <option value="<?=$brend['name']?>"><?=$brend['name']?></option>
              <?}?>
            </select>
            <!--<input type="text" class="form-control" id="brend" placeholder="введите бренд">-->
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <select class="form-control" name="sezon" id="sezon">
              <option value="">Выберите сезон</option>
              <option value="1">Летняя</option>
              <option value="2">Зимняя</option>
              <option value="3">Всесезонная</option>
            </select>
          </div>
        </div>
        <div class="col-md-2" id="rShip">
          <div class="form-group">
            <select class="form-control" name="ship" id="rShip">
              <option value="0">Все</option>
              <option value="1">Шип</option>
              <option value="2">Не шип</option>
            </select>
            <?/*<label for="ship">Шип</label>
            <input type="checkbox" value="1" id="ship" name="ship">*/?>
          </div>
        </div>
        <div class="col-md-2">
          <button  type="submit" class="btn green" onclick="sProdWorkPlace()" >Поиск</button>
        </div>

        
      </div>
    </form>
  </div>
</div>                   

<!--<div class="right_button" id="r_button">
  <a data-toggle="modal" data-target="#modalKladr"><i class="fa fa-truck"></i></a>
</div>
<?/*require_once $_SERVER['DOCUMENT_ROOT']."/adminius/templates/modals/modalKladr.tpl.php";*/?>
<style>
.right_button {position:fixed; right:0; top:40%; width:50px; height:50px; background: #852b99;display: none;}
.right_button i {margin-left: 30%;margin-top: 30%;color: #fff;}
.right_button a {cursor: pointer;}
</style>-->
