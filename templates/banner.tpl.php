<?$sBanner = selectBanner();
	if($sBanner){?>
		<!-- Banner -->
  <a href="<?=$sBanner['url']?>">
		<div class="banner-item banner-1x color-inher" style="background-image: url('/images/slider/<?=$sBanner['img']?>');">
			<?/* <h5>Lorem ipsum dolor</h5> */?>
			<h3 class="f-weight-300"><?=$sBanner['title']?></h3>
			<p><?=$sBanner['descriptions']?></p>
			<?/*<a href="<?=$sBanner['url']?>" class="ht-btn ht-btn-default">Купить</a>*/?>
		</div>
  </a>
<?}?>