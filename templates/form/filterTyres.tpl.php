<?
if($_GET["width"]) {
    $widthValue = selectFilterElementByValue($_GET["width"], '19');
}
if($_GET["height"]) {
    $heightValue = selectFilterElementByValue($_GET["height"], '21');
}
if($_GET["diametr"]) {
    $dim = str_replace("R", "", $_GET["diametr"]);
    //$dim = str_replace("C", "", $dim);
    $diametrValue = selectFilterElementByValue($dim, '20');
}
if($_GET["brand"]){
    $brand = selectnNameCategoriesByCode($_GET["brand"]);
}
?>
<div class="search-option p-b-lg-5 p-b-sm-30 p-xs-15 row">
    <div class="col-md-12" style="color: #fff;padding: 0px; margin-bottom:10px; text-align: center;font-size: 22px;"> Выберите автошины </div>
    <div class="col-md-12">
        <!--<div class="col-sm-12 col-md-12 col-lg-12">-->
        <!--<div class="col-md-6" style="color: #fff;padding: 5px 0 5px 0;text-align: center;font-size: 18px;"> По параметрам</div>-->
        <?/*<div class="col-md-6" style="color: #fff;padding: 5px 0 5px 0;text-align: center;font-size: 18px;"> По автомобилю</div>*/?>
        <!--</div>-->
        <div class="col-sm-12 col-md-12 col-lg-12" style="padding: 0px;">

            <div class="col-sm-12 col-md-12 col-lg-12" style="padding: 0px;">

                <div class="col-sm-6 col-md-6 col-lg-3" style="margin: 10px 0px;">
                    <div class="select-wrapper">
                        <div class="dropdown">
                            <button class="dropdown-toggle form-item arrow_menu" type="button" id="widthTyres" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" data-value="<?=$widthValue;?>"><?if($_GET["width"]){echo $_GET["width"];}else{ echo "Ширина";}?></button>
                            <ul class="dropdown-menu filtr-scroll" aria-labelledby="dropdownMenu2" name="width" id="listWidthTyres">
                                <li value="">Все</li>
                                <?foreach(selectValueFilter('19') as $iTyresWidth){?>
                                    <li value="<?=$iTyresWidth["id"]?>"><?=$iTyresWidth["value"]?></li>
                                <?}?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-6 col-lg-3" style="margin: 10px 0px;">
                    <div class="select-wrapper">
                        <div class="dropdown">
                            <button class="dropdown-toggle form-item arrow_menu" type="button" id="heightTyres" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" data-value="<?=$heightValue;?>"><?if($_GET["height"]){echo $_GET["height"];}else{ echo "Высота";}?></button>
                            <ul class="dropdown-menu filtr-scroll" aria-labelledby="dropdownMenu2" name="height" id="listHeightTyres">
                                <li value="">Все</li>
                                <?foreach(selectValueFilter('21') as $iTyresHeight){?>
                                    <li value="<?=$iTyresHeight["id"]?>"><?=$iTyresHeight["value"]?></li>
                                <?}?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-6 col-lg-3" style="margin: 10px 0px;">
                    <div class="select-wrapper">
                        <div class="dropdown">
                            <button class="dropdown-toggle form-item arrow_menu" type="button" id="diametrTyres" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" data-value="<?=$diametrValue;?>"><?if($_GET["diametr"]){echo $_GET["diametr"];}else{ echo "Диаметр";}?></button>
                            <ul class="dropdown-menu filtr-scroll" aria-labelledby="dropdownMenu2" name="diameter" id="listDiametrTyres">
                                <li value="">Все</li>
                                <?foreach(selectValueFilter('20') as $iTyresDiameter){?>
                                    <li value="<?=$iTyresDiameter["id"]?>"><?if($iTyresDiameter["name"] != "&nbsp") echo "R";?><?=$iTyresDiameter["value"]?></li>
                                <?}?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-6 col-lg-3" style="margin: 10px 0px;">
                    <div class="select-wrapper">
                        <div class="dropdown">
                            <button class="dropdown-toggle form-item arrow_menu" type="button" id="brandTyres" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" data-value="<?=$_GET["brand"]?>"><?if($_GET["brand"]){echo $brand;}else{ echo "Бренд";}?></button>
                            <ul class="dropdown-menu filtr-scroll" aria-labelledby="dropdownMenu2" name="brand" id="listBrandTyres">
                                <li value="Все">Все</li>
                                <?foreach(selectTyresBrand() as $iTyresBrand){?>
                                    <li value="<?=$iTyresBrand["id"]?>"><?=$iTyresBrand["name"]?></li>
                                <?}?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <?//include($_SERVER['DOCUMENT_ROOT'].'/templates/form/searchByAvto.tpl.php');?>

        <div class="col-sm-12 col-md-12 col-lg-12" style="color: #fff;padding: 5px 0 5px 0;text-align: center;font-size: 18px;"> Выберите сезонность </div>
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="row main-filter">
                <div class="col-md-4"></div>
                <div class="col-md-2">
                    <div class="col-lg-12 text-left p-l-md-0 p-r-md-0">
                        <div class="checkbox">
                            <input type="checkbox" value="1" id="season_s" <?if($_GET["season_s"] == "1"){echo "checked";}?>>
                            <label for="season_s" class="fa fa-check"></label>Летние</div>
                    </div>
                    <div class="col-lg-12 text-left p-l-md-0 p-r-md-0">
                        <div class="checkbox">
                            <input type="checkbox" value="1" id="season_w" <?if($_GET["season_w"] == "1"){echo "checked";}?>>
                            <label for="season_w" class="fa fa-check"></label>Зимние</div>
                    </div>
                    <div class="col-lg-12 text-left p-l-md-0 p-r-md-0">
                        <div class="checkbox">
                            <input type="checkbox" value="1" id="season_u" <?if($_GET["season_u"] == "1"){echo "checked";}?>>
                            <label for="season_u" class="fa fa-check"></label>Всесезонные</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="col-lg-12 text-left p-l-md-0 p-r-md-0">
                        <div class="checkbox">
                            <input type="checkbox" value="1" id="thorn_w" <?if($_GET["thorn_w"] == "1"){echo "checked";}?>>
                            <label for="thorn_w" class="fa fa-check"></label>Шипованные</div>
                    </div>
                    <div class="col-lg-12 text-left p-l-md-0 p-r-md-0">
                        <div class="checkbox">
                            <input type="checkbox" value="1" id="thorn_n" <?if($_GET["thorn_n"] == "1"){echo "checked";}?>>
                            <label for="thorn_n" class="fa fa-check"></label>Нешипованные</div>
                    </div>
                    <div class="col-lg-12 text-left p-l-md-0 p-r-md-0">
                        <div class="checkbox">
                            <input type="checkbox" value="1" id="only4" <?if($_GET["only4"] != "0"){echo "checked";}?>>
                            <label for="only4" class="fa fa-check"></label>Не отображать остаток менее 4 шт.</div>
                    </div>
                    <?/*<div class="col-lg-12 text-left p-l-md-0 p-r-md-0">
								<div class="checkbox">
									<input type="checkbox" value="1" id="season_w" <?if($_GET["season_w"] == "1"){echo "checked";}?>>
								<label for="season_w" class="fa fa-check"></label>Зимние</div>
							</div>

							<div class="col-lg-12 text-left p-l-md-0 p-r-md-0">
								<div class="checkbox">
									<input type="checkbox" value="1" id="thorn_n" <?if($_GET["thorn_n"] == "1"){echo "checked";}?>>
								<label for="thorn_n" class="fa fa-check"></label>Нешипованые</div>
							</div>*/?>
                </div>
                <div class="col-md-4"></div>
                <?/*<div class="col-md-4">
							<div class="col-lg-12 text-left p-l-md-0 p-r-md-0">
								<div class="checkbox">
									<input type="checkbox" value="1" id="season_u" <?if($_GET["season_u"] == "1"){echo "checked";}?>>
								<label for="season_u" class="fa fa-check"></label>Всесезонные</div>
							</div>
						</div>*/?>
            </div>

        </div>

        <div class="col-sm-12 col-md-12 col-lg-12" style="padding: 0px;">
            <div class="col-md-6 col-xs-12">
                <button type="button" <?if(isset($_GET["categories_code"])){echo 'id="buttonTyres"';}else{echo 'id="buttonTyresMain"';}?> class="ht-btn" style="width: 100%;">
                    <i class="fa fa-search"></i> Подобрать
                </button>
            </div>
            <div class="col-md-6 col-xs-12">
                <button type="button" class="ht-btn" style="width: 100%;" onClick="delCookie('tyres');">
                    <i class="fa fa-search"></i> Сбросить фильтр
                </button>
            </div>
        </div>
    </div>
</div>
