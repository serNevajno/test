<div class="col-md-12 miniFiltr" id="filterTyres">
  <input type="hidden" id="categories_code" value="<?=$_GET["categories_code"]?>">
  <div class="col-md-4">
    <label>
      <span>Ширина:</span>
      <select id="optionstWidthTyres">
        <option value="">Все</option>
        <?foreach(selectValueFilter('19') as $iTyresWidth){?>
          <option value="<?=$iTyresWidth["id"]?>"><?=$iTyresWidth["value"]?></>
        <?}?>
      </select>
    </label>
  </div>
  <div class="col-md-4">
    <label>
      <span>Высота:</span>
      <select id="optionstHeightTyres">
        <option value="">Все</option>
        <?foreach(selectValueFilter('21') as $iTyresWidth){?>
          <option value="<?=$iTyresWidth["id"]?>"><?=$iTyresWidth["value"]?></>
        <?}?>
      </select>
    </label>
  </div>
  <div class="col-md-4">
    <label>
      <span>Диаметр:</span>
      <select id="optionstDiametrTyres">
        <option value="">Все</option>
        <?foreach(selectValueFilter('20') as $iTyresWidth){?>
          <option value="<?=$iTyresWidth["id"]?>"><?=$iTyresWidth["value"]?></>
        <?}?>
      </select>
    </label>
  </div>
</div>

<div class="clearfix"> </div>