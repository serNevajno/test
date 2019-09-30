<?
if ($_GET["width"]) {
  $widthValue = selectFilterElementByValue($_GET["width"], '26');
}
if ($_GET["pcd"]) {
  $pcd = selectFilterElementByValue($_GET["pcd"], '27');
}
if ($_GET["diametr"]) {
  $dim = str_replace("R", "", $_GET["diametr"]);
  $dim = str_replace("C", "", $dim);
  $diametrValue = selectFilterElementByValue($dim, '25');
}
if ($_GET["brand"]) {
  $brand = selectnNameCategoriesByCode($_GET["brand"]);
}
?>
<div class="search-option p-b-lg-15 p-b-sm-30 p-xs-15 row">
  <div class="col-md-12" style="color: #fff;padding: 0px; margin-bottom:10px; text-align: center;font-size: 22px;">
    Выберите автодиски
  </div>
  <div class="col-md-12">
    <?/*<div class="col-sm-12 col-md-12 col-lg-12">
        <div class="col-md-6" style="color: #fff;padding: 5px 0 5px 0;text-align: center;font-size: 18px;"> По параметрам</div>
        <div class="col-md-6" style="color: #fff;padding: 5px 0 5px 0;text-align: center;font-size: 18px;"> По автомобилю</div>
    </div>*/?>
    <div class="col-sm-12 col-md-12 col-lg-12" style="padding: 0px;">

      <div class="col-sm-12 col-md-12 col-lg-12" style="padding: 0px;">

        <div class="col-sm-6 col-md-6 col-lg-2" style="margin: 10px 0px;">
          <div class="select-wrapper">
            <div class="dropdown">
              <button class="dropdown-toggle form-item arrow_menu" type="button" id="diametrDisk" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" data-value="<?= $diametrValue ?>">
                <? if ($_GET["diametr"]) {
                  echo $_GET["diametr"];
                } else {
                  echo "Диаметр";
                } ?></button>
              <ul class="dropdown-menu filtr-scroll" aria-labelledby="dropdownMenu2" name="diametr"
                  id="listDiametrDisk">
                <li value="">Все</li>
                <? foreach (selectValueFilter('25') as $iTyresDiameter) { ?>
                  <li value="<?= $iTyresDiameter["id"] ?>">R<?= $iTyresDiameter["value"] ?></li>
                <? } ?>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-2" style="margin: 10px 0px;">
          <div class="select-wrapper">
            <div class="dropdown">
              <button class="dropdown-toggle form-item arrow_menu" type="button" id="widthDisk" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" data-value="<?= $widthValue ?>">
                <? if ($_GET["width"]) {
                  echo $_GET["width"];
                } else {
                  echo "Ширина";
                } ?></button>
              <ul class="dropdown-menu filtr-scroll" aria-labelledby="dropdownMenu2" name="width" id="listWidthDisk">
                <li value="">Все</li>
                <? foreach (selectValueFilter('26') as $iDiskWidth) { ?>
                  <li value="<?= $iDiskWidth["id"] ?>"><?= $iDiskWidth["value"] ?></li>
                <? } ?>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-2" style="margin: 10px 0px;">
          <div class="select-wrapper">
            <div class="dropdown">
              <button class="dropdown-toggle form-item arrow_menu" type="button" id="pcdDisk" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="true" data-value="<?= $pcd ?>">
                <? if ($_GET["pcd"]) {
                  echo $_GET["pcd"];
                } else {
                  echo "Сверловка";
                } ?></button>
              <ul class="dropdown-menu filtr-scroll" aria-labelledby="dropdownMenu2" name="pcd" id="listPcdDisk">
                <li value="">Все</li>
                <? foreach (selectValueFilter('27') as $iPcd) { ?>
                  <li value="<?= $iPcd["id"] ?>"><?= $iPcd["value"] ?></li>
                <? } ?>
              </ul>
            </div>
          </div>
        </div>


        <div class="col-sm-6 col-md-6 col-lg-2" style="margin: 10px 0px;">
          <div class="select-wrapper">
            <div class="dropdown">
              <button class="dropdown-toggle form-item arrow_menu" type="button" id="etDisk" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" data-value="<?= $_GET["et"] ?>">
                <? if ($_GET["et"]) {
                  echo $_GET["et"];
                } else {
                  echo "Вылет";
                } ?>
              </button>
              <ul class="dropdown-menu filtr-scroll" aria-labelledby="dropdownMenu2" name="et" id="listEtDisk">
                <li value="">Все</li>
                <? foreach (selectFilterValue('28') as $iEt) { ?>
                  <li value="<?= $iEt["element_value"] ?>"><?= $iEt["element_value"] ?></li>
                <? } ?>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-2" style="margin: 10px 0px;">
          <div class="select-wrapper">
            <div class="dropdown">
              <button class="dropdown-toggle form-item arrow_menu" type="button" id="diaDisk" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" data-value="<?= $_GET["dia"] ?>">
                <? if ($_GET["dia"]) {
                  echo $_GET["dia"];
                } else {
                  echo "Ступица";
                } ?>
              </button>
              <ul class="dropdown-menu filtr-scroll" aria-labelledby="dropdownMenu2" name="dia" id="listDiaDisk">
                <li value="">Все</li>
                <? foreach (selectFilterValue('29') as $iDIA) { ?>
                  <li value="<?= $iDIA["element_value"] ?>"><?= $iDIA["element_value"] ?></li>
                <? } ?>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-2" style="margin: 10px 0px;">
          <div class="select-wrapper">
            <div class="dropdown">
              <button class="dropdown-toggle form-item arrow_menu" type="button" id="brandDisk" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" data-value="<?= $_GET["brand"] ?>">
                <? if ($_GET["brand"]) {
                  echo $brand;
                } else {
                  echo "Бренд";
                } ?></button>
              <ul class="dropdown-menu filtr-scroll" aria-labelledby="dropdownMenu2" name="brand" id="listBrandDisk">
                <li value="Все">Все</li>
                <? foreach (selectDiskBrand() as $iDiskBrand) { ?>
                  <li value="<?= $iDiskBrand["id"] ?>"><?= $iDiskBrand["name"] ?></li>
                <? } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>


      <?/*<div class="col-sm-12 col-md-12 col-lg-12" style="padding: 0px;">
        <div class="col-sm-6 col-md-6 col-lg-6">
          <span style="color:#fff; font-weight:bold;"> Вылет <i class="fa fa-info-circle" style="color:#fff;" data-toggle="tooltip" data-placement="top" title="Вылет (ET) - расстояние между продольной плоскостью симметрии диска и крепежной плоскостью колеса."></i></span>
          <input type="text" disabled="" class="slider_amount1 m-t-lg-10" name="et" id="et" value="<? if ($_GET["et"]) {
            echo $_GET["et"];
          } else {
            echo "-16 - 115";
          } ?>">
          <div class="slider-range1 ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
               style="margin: 0px 8px;">
            <div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 28.2051%; width: 35.8974%;"></div>
            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 28.2051%;"></span>
            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 64.1026%;">
							</span>
          </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6">
          <span style="color:#fff; font-weight:bold;"> Ступица <i class="fa fa-info-circle" style="color:#fff;" data-toggle="tooltip" data-placement="top" title="DIA - диаметр центрального отверстия под ступицу."></i></span>
          <input type="text" disabled="" class="slider_amount2 m-t-lg-10" name="dia" id="dia" value="<? if ($_GET["dia"]) {
                   echo $_GET["dia"];
                 } else {
                   echo "54 - 160";
                 } ?>">
          <div class="slider-range2 ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
               style="margin: 0px 8px;">
            <div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 28.2051%; width: 35.8974%;"></div>
            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 28.2051%;"></span>
            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 64.1026%;">
							</span>
          </div>
        </div>
      </div>*/?>

    </div>
    <? if (isset($_GET["categories_code"])) {
      //include($_SERVER['DOCUMENT_ROOT'].'/templates/form/searchByAvto.tpl.php');?>
    <? } else { ?>
      <!--<div class="col-sm-12 col-md-6 col-lg-6" style="padding:0px;" id="formDiskByAvtoSecond">
      </div>-->
    <? } ?>
    <? /*<div class="col-sm-12 col-md-12 col-lg-12" style="color: #fff;padding: 5px 0 5px 0;text-align: center;font-size: 18px;"> Выберите параметры </div>
				<div class="col-sm-12 col-md-12 col-lg-12 m-b-lg-15 p-r-lg-0 p-r-sm-15 p-r-xs-15">
					<div class="col-sm-6 col-md-6 col-lg-6 m-b-lg-15 p-r-lg-0 p-r-xs-15">
						<span style="color:#fff; font-weight:bold;"> Вылет <i class="fa fa-info-circle" style="color:#fff;" data-toggle="tooltip" data-placement="top" title="Вылет (ET) - расстояние между продольной плоскостью симметрии диска и крепежной плоскостью колеса."></i></span>
						<input type="text" disabled="" class="slider_amount1 m-t-lg-10" name="et" id="et" value="-16 - 115">
						<div class="slider-range1 ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" style="margin: 0px 8px;">
							<div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 28.2051%; width: 35.8974%;"></div>
							<span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 28.2051%;"></span>
							<span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 64.1026%;">
							</span>
						</div>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-6 m-b-lg-15 p-r-lg-0 p-r-xs-15">
						<span style="color:#fff; font-weight:bold;"> Ступица <i class="fa fa-info-circle" style="color:#fff;" data-toggle="tooltip" data-placement="top" title="DIA - диаметр центрального отверстия под ступицу."></i></span>
						<input type="text" disabled="" class="slider_amount2 m-t-lg-10" name="dia" id="dia" value="54 - 160">
						<div class="slider-range2 ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" style="margin: 0px 8px;">
							<div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 28.2051%; width: 35.8974%;"></div>
							<span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 28.2051%;"></span>
							<span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 64.1026%;">
							</span>
						</div>
					</div>
				</div>*/ ?>
    <div class="col-sm-12 col-md-12 col-lg-12" style="margin-top: 15px; padding:0px;">
      <div class="col-md-6 col-xs-12">
        <button type="button" <? if (isset($_GET["categories_code"])) {
          echo 'id="buttonDisk"';
        } else {
          echo 'id="buttonDiskMain"';
        } ?> class="ht-btn" style="width: 100%;">
          <i class="fa fa-search"></i> Подобрать
        </button>
      </div>
      <div class="col-md-6 col-xs-12">
        <button type="button" class="ht-btn" style="width: 100%;" onClick="delCookie('disk');">
          <i class="fa fa-search"></i> Сбросить фильтр
        </button>
      </div>
    </div>
  </div>
</div>
