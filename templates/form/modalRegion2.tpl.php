<!-- Modal -->
<div class="modal fade bs-example-modal-lg" id="regionModal" tabindex="-1" role="document" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body" id="step-1" <?if($_COOKIE['id_city_kladr']){?>style="display: none;"<?}else{?>style="display: block;"<?}?>>
        <div class="p-lg-15 p-xs-15 bg-gray-f5 bg1-gray-15 but_reviews" style="text-align: center;">
          <p class="m-b-lg-15" style="font-weight: 900">Вы находитесь в <?=$name_city_ru?>(е)?</p>
          <?
            $rIDCityKladr = sIdCityKladrOffice($id_city)['id_city_kladr'];
            if(!$rIDCityKladr){$rIDCityKladr = '7400000100000';}
          ?>
          <a onclick="changeAddress(<?=$rIDCityKladr?>)" class="btn btn-success" >ДА</a>
          <a onClick="$('#step-1').hide();$('#step-2').show();" class="btn btn-warning">НЕТ</a>

        </div>
      </div>
      <div class="modal-body" id="step-2" <?if($_COOKIE['id_city_kladr']){?>style="display: block;"<?}else{?>style="display: none;"<?}?>>
        <div class="p-lg-15 p-xs-15 bg-gray-f5 bg1-gray-15 but_reviews" style="text-align: center;">
          <p class="m-b-lg-15" style="font-weight: 900">Укажите пожалуйста город в котором вы находитесь!</p>

          <div>
            <input type='text' id='cityUser' placeholder='Пример: Челябинск' autocomplete='off' class="form-control form-item">
            <div id='block-search-result' style="display: none;">
              <ul id='result_search_city'></ul>
            </div>
          </div>
            <div class="row" style="margin-top: 10px;">
              <script>
                window.onload = function () { selectCityByRegionKladr('<?=$id_region_kladr?>') }
              </script>
              <div class="col-md-4">
                <div class="layer">
                  <ul>
                    <?foreach (selectRegionKladr() as $iRegionKladr){?>
                        <li <?if($id_region_kladr == $iRegionKladr["id_kladr"]){?>class="selected"<?}?> id="<?=$iRegionKladr["id_kladr"]?>">
                          <a style="cursor: pointer;" onclick="selectCityByRegionKladr('<?=$iRegionKladr["id_kladr"]?>')"><?=$iRegionKladr["name"]?> <?=$iRegionKladr["type"]?></a>
                        </li>
                    <?}?>
                  </ul>
                </div>
              </div>
              <div class="col-md-8">
                <ul class="list-city" id="cityKladrReg"> </ul>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>