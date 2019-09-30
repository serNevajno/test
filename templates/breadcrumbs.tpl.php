<div class="hidden-xs">
  <div class="row">
    <div class="col-lg-12">
      <ul class="ht-breadcrumb pull-left">
        <li class="home-act"><a href="/"><i class="fa fa-home"></i></a></li>
        <?if($_GET["code"] AND $_GET["code"] != "news"){?>
          <li class="active"><?=$meta_item["name"]?></li>
        <?}elseif($_GET["code"] == "news"){?>
          <li class="home-act"><a href="/news.html">Новости</a></li>
          <?if(isset($_GET["id_news"])){?>
            <li class="active"><?=$meta_item["name"]?></li>
          <?}?>
        <?}elseif($_GET["categories_code"]){?>
          <?if(isset($_GET["id"])){?>
            <?=recusiveBreadcrumbs($meta_item["categories"]);?>
            <li class="home-act"><a href="" style="cursor: context-menu;"><?=$meta_item["name"]?></a></li>
          <?}elseif(isset($_GET["product_code"])){?>
            <?=recusiveBreadcrumbs($meta_item["categories"]);?>
            <li class="active"><?=$meta_item["name"]?></li>
          <?}else{?>
            <?=recusiveBreadcrumbs($meta_item["section"]);?>
            <li class="home-act"><a href="/<?=$meta_item["code"]?>/"><?=$meta_item["name"]?></a></li>
          <?}?>
        <?}?>
      </ul>
    </div>
  </div>
</div>