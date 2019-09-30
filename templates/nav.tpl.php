<nav class="navbar navbar-default menu">
  <div class="container1-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
              data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <?/*?><li><a href="/">Главная</a></li><?*/?>
        <?foreach(selectCategoriesOnMenu() as $iCatMenu){?>
            <li><a href="/<?=$iCatMenu["code"]?>/"><?=$iCatMenu["name"]?></a></li>
        <?}?>
        <?/*foreach(selectSectionOnMenu() as $iSecMenu){?>
          <li><a href="/<?=$iSecMenu["code"]?>.html"><?=$iSecMenu["name"]?></a></li>
        <?}*/?>
      </ul>
    </div>
  </div>
</nav>