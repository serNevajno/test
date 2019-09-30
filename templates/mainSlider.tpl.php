<?$ctn = count(slideMain());?>
<div id="myCarousel" class="carousel slide" data-ride="carousel" style="border:none; margin:15px 0 15px 0;">
	<?if($ctn > 1){?>
  <!-- Indicators -->
  <ol class="carousel-indicators">
		<?for($i=0; $i < $ctn; $i++){?>
    <li data-target="#myCarousel" data-slide-to="<?=$i?>" <?if($i == 0){?>class="active"<?}?>></li>
		<?}?>
  </ol>
	<?}?>
  <!-- Wrapper for slides -->
  <div class="carousel-inner">
		<?$n = 0;
		foreach(slideMain() as $item){?>
    <div class="item <?if($n == 0){?>active<?}?>" >
      <a href="<?=$item['url']?>">
      <img src="/scripts/phpThumb/phpThumb.php?src=/images/slider/<?=$item['img']?>&w=1140&h=300&far=1&bg=ffffff&f=jpg" alt="<?=$item['title']?>">
      </a>
      <?/*<img src="/images/slider/<?=$item['img']?>" alt="<?=$item['title']?>">*/?>
      <div class="carousel-caption">
        <h3><?=$item['title']?></h3>
        <p style="color:<?=$item['color']?>;"><?=$item['descriptions']?></p>
      </div>
    </div>
		<?$n++;}?>
  </div>
	<?if($ctn > 1){?>
  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" style="color:#cb1010;"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" style="color:#cb1010;"></span>
    <span class="sr-only">Next</span>
  </a>
	<?}?>
</div>