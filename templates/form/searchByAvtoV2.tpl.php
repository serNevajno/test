<div class="col-sm-12 col-md-6 col-lg-6" style="padding:0px;" id="formDiskByAvtoFirst1">
  <input id="groupMod" type="hidden">
  <div class="col-sm-6 col-md-6 col-lg-6 m-b-lg-15">
    <div class="select-wrapper">
      <div class="dropdown">
        <button class="dropdown-toggle form-item arrow_menu" type="button" id="buttonMarka" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><?if($_GET["marka"]){echo $_GET["marka"];}else{ echo "Марка";}?></button>
        <ul class="dropdown-menu filtr-scroll" aria-labelledby="dropdownMenu2" id="listMarka">
          <?foreach(selectListMarkaAutoV2() as $iMarka){?>
            <li value="<?=$iMarka['vendor']?>"><?=$iMarka['vendor']?></li>
          <?}?>
        </ul>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-md-6 col-lg-6 m-b-lg-15">
    <div class="select-wrapper">
      <div class="dropdown">
        <button class="dropdown-toggle form-item arrow_menu" type="button" id="buttonModel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><?if($_GET["model"]){echo $_GET["model"];}else{ echo "Модель";}?></button>
        <ul class="dropdown-menu filtr-scroll" aria-labelledby="dropdownMenu2" name="model" id="listModel">
        </ul>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-md-6 col-lg-6 m-b-lg-15">
    <div class="select-wrapper">
      <div class="dropdown">
        <button class="dropdown-toggle form-item arrow_menu" type="button" id="buttonYear" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><?if($_GET["year"]){echo $_GET["year"];}else{ echo "Год";}?></button>
        <ul class="dropdown-menu filtr-scroll" aria-labelledby="dropdownMenu2" name="year" id="listYear">

        </ul>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-md-6 col-lg-6 m-b-lg-15">
    <div class="select-wrapper">
      <div class="dropdown">
        <button class="dropdown-toggle form-item arrow_menu" type="button" id="buttonModification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><?if($_GET["modification"]){echo $_GET["modification"];}else{ echo "Модификация";}?></button>
        <ul class="dropdown-menu filtr-scroll" aria-labelledby="dropdownMenu2" name="modification" id="listModification">

        </ul>
      </div>
    </div>
  </div>
  <br>
  <div class="col-sm-12 col-md-12 col-lg-12" id="noMod" style="display: none;">
    <span style="color: #fff;font-size: 14px;">Эти параметры используются для всех модификаций этой модели</span>
  </div>
  <div class="col-sm-12 col-md-12 col-lg-12">
    <button type="button" class="ht-btn ht-btn-default  pull-right pull-left-xs" style="width: 100%;" id="" value="<?=$_GET["categories_code"]?>" onclick="sAutoTyresDiskV2()">
      <i class="fa fa-search"></i> Подобрать по авто
    </button>
  </div>

</div>