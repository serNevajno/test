<!-- Footer-->
<footer id="wrap-footer" class="bg-gray-1 color-inher">
  <!-- Footer top -->
  <div class="footer-top">
    <div class="container">
      <div class="bg-gray-1 p-l-r">
        <div class="row">
          <!-- Company info -->
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="heading-1">
              <h3>Наши контакты</h3>
						</div>
            <ul class="list-default" id="footerAddress">
              <?if($sRegion){?>
                <li><i class="fa fa-home"></i>  <?=$sRegion["address"]?></li>
                <li><i class="fa fa-phone"></i> <?=$sRegion["phone"]?></li>
                <li><i class="fa fa-envelope-o"></i> dobroshina@yandex.ru</li>
                <li><i class="fa fa-clock-o"></i> <?=$sRegion["time_work"]?></li>
              <?}else{?>
                <li><i class="fa fa-home"></i> <?=$settings['addres']?></li>
                <li><i class="fa fa-phone"></i> <?=$settings['phone']?></li>
                <li><i class="fa fa-envelope-o"></i> <?=$settings['email']?></li>
                <li><i class="fa fa-clock-o"></i> <?=$settings['time_work']?></li>
              <?}?>
						</ul>
					</div>
          <!-- Newsletter -->
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="newsletter text-left">
              <div class="heading-1">
                <h3>Мы вКонтакте</h3>
							</div>
              <?/* <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod temp incidunt ut </p> */?>
              <!-- VK Start -->
							<script type="text/javascript" src="//vk.com/js/api/openapi.js?115"></script>
							<div id="vk_groups" style="margin-top:15px; margin-bottom:25px;"></div>
							<script type="text/javascript">
								if (window.innerWidth >= 1069){
									VK.Widgets.Group("vk_groups", {mode: 0, width: "330", color1: 'FFFFFF', color2: '0E0E0E', color3: '4864b4'}, 143139237);
								}else if (window.innerWidth <= 1068 && window.innerWidth >= 768){
									VK.Widgets.Group("vk_groups", {mode: 0, width: "230", color1: 'FFFFFF', color2: '0E0E0E', color3: '4864b4'}, 143139237);
								}else if (window.innerWidth <= 767 && window.innerWidth >= 480){
									VK.Widgets.Group("vk_groups", {mode: 0, width: "460", color1: 'FFFFFF', color2: '0E0E0E', color3: '4864b4'}, 143139237);
								}else if (window.innerWidth <= 479){
									VK.Widgets.Group("vk_groups", {mode: 0, width: "300", color1: 'FFFFFF', color2: '0E0E0E', color3: '4864b4'}, 143139237);
								}
							</script>
							<!-- VK End -->
						</div>
					</div>
          <!-- Quick link -->
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="heading-1">
              <h3>Навигация</h3>
						</div>
            <ul class="list-default">
							<?foreach(selectCategoriesOnMenu() as $iCatMenu){?>
								<li><a href="/<?=$iCatMenu["code"]?>/"><i class="fa fa-angle-right"></i> <?=$iCatMenu["name"]?></a></li>
							<?}?>
							<?foreach(selectSectionOnMenu(0) as $itemSecMenu){?>
								<li><a href="/<?=$itemSecMenu["code"]?>.html"><i class="fa fa-angle-right"></i> <?=$itemSecMenu["name"]?></a></li>
							<?}?>
                            <li><a href="/politika-konfidentsialnosti.html"><i class="fa fa-angle-right"></i> Политика конфиденциальности</a></li>
                            <li><a href="/uvedomlenie-o-cookie-fajlah.html"><i class="fa fa-angle-right"></i> Уведомление о cookie-файлах </a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
  <!-- Footer bottom -->
  <div class="footer-bt color-inher">
    <div class="container">
      <div class="bg-gray-0c p-l-r">
        <div class="row">
					<div class="col-md-12" style="font-size:12px;">
					Материалы сайта допускается использовать для опубликования на других интернет-ресурсах только при условии размещения активной ссылки на сайт http://ДобраяШина.рф
					На странице, где размещается материал, ссылка должна быть такой: Источник: Интернет магазин Добрая Шина

					Информация, размещенная на данном сайте, носит исключительно информационный характер и не может являться публичной офертой, определяемой положениями
					Статьи 437 (2) ГК РФ
					</div>
          <div class="col-md-6">
            <p>© <?=date('Y')?> 
							<a href="https://vplaton.pro/" style="text-decoration:none;font-size:12px;text-transform: none;" target="_blank" title="vplaton.pro">
								<span style="color:#fff;">Разработка и дизайн сайта: vplaton.pro</span>
							</a>
						</p>
					</div>
          <div class="col-md-6">
            <ul class="social-icon list-inline pull-right">
						<?if($sSocial){
							foreach($sSocial as $item){?>
								<li><a href="<?=$item['url_social']?>" target="_blank"><i class="fa fa-<?=$item['name_social']?>" style="font-size: 18px;"></i></a></li>
						<?}}?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<?
	//$rTime = explode('  ', $settings["time_pop"]);
	$rT = explode(' - ', $settings["time_pop"]);
	if(date('H:i') < $rT[0] OR date('H:i') > $rT[1] OR $settings["time_pop"] == 0){?>
    <?/*<div style="width: 990px;margin: 0 auto;">
      <div class="workTime">
        <b><i class="fa fa-info-circle"></i> <?=$settings["work_text"]?></b>
      </div>
    </div>*/?>
    <div id="cookiesBar">
      <a href="javascript:void(0);" class="cookiesBarClose abs close" data-icon="close"></a>
      <p class="normal cfff"> <i class="fa fa-info-circle cfff"></i> <?=$settings["work_text"]?> </p>
    </div>
  <?}?>
</div>
<!-- jQuery -->
<script src="/js/jquery-2.2.4.min.js"></script>
<!-- JqueryUI -->
<script src="/js/jquery-ui.js"></script>
<script src="/js/custom.js"></script>
<?if($_GET["width"] AND $_GET["height"] AND $_GET["diametr"] AND $_GET["marka"] == "Марка"){?>
	<script>
		$(document).ready(function(){
			searchTyres(1);
		});
	</script>
<?}elseif($_GET["width"] AND $_GET["pcd"] AND $_GET["diametr"] AND $_GET["marka"] == "Марка"){?>
	<script>
		$(document).ready(function(){
			searchDisk(1);
		});
	</script>
<?}elseif($_GET["categories_code"] == "tyres" AND $_GET["marka"] AND $_GET["model"] AND $_GET["year"]){?>
    <script>
        $(document).ready(function(){
            sModel();
            setTimeout(function (){
              sAutoTyresDiskV2();
            }, 1000);
            searchTyres(1);
        });
    </script>
<?}elseif($_GET["categories_code"] == "disk" AND $_GET["marka"] AND $_GET["model"] AND $_GET["year"]){?>
    <script>
        $(document).ready(function(){
            sModel();
            setTimeout(function (){
              sAutoTyresDiskV2();
            }, 1000);
            searchDisk(1);
        });
    </script>
<?}?>
<?if($_GET["categories_code"] == "tyres" AND !isset($_GET["product_code"]) AND !isset($_GET["width"])){?>
	<script>
		$(document).ready(function(){
				selectTyresFromCookie();
		});
	</script>
<?}?>
<?if($_GET["categories_code"] == "disk" AND !isset($_GET["product_code"]) AND !isset($_GET["diametr"])){?>
    <script>
        $(document).ready(function(){
            selectDiskFromCookie();
        });
    </script>
<?}?>
<?if($_GET["categories_code"] == "disk" AND isset($_GET["et"]) AND isset($_GET["dia"])){?>
    <script>
        setTimeout(function() {
            $('#et').val('<?=$_GET["et"]?>');
            $('#dia').val('<?=$_GET["dia"]?>');
        }, 1000);
    </script>
<?}?>
<!-- Bootstrap -->
<script src="/js/bootstrap.min.js"></script>
<!--magnific popup-->
<script src="/js/jquery.magnific-popup.min.js"></script>
<!-- Jquery.counterup -->
<script src="/js/waypoints.min.js"></script>
<script src="/js/jquery.counterup.min.js"></script>
<!-- Owl-coursel -->
<script src="/js/owl.carousel.js"></script>
<!-- Script -->
<script src="/js/script.js"></script>
<script src="/js/mini.filtr.cat.list.js"></script>
<?/*if($_GET['code'] == 'checkout'){
    <script src="http://bootstrap-ru.com/204/assets/js/jquery.js"></script>
    <script src="/js/tooltip.js"></script>
    <script src="/js/popover.js"></script>
    <script src="http://bootstrap-ru.com/204/assets/js/application.js"></script>
}*/?>
<script src="/js/jquery.maskedinput.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="/js/easing.js" type="text/javascript"></script>
<script src="/js/jquery.ui.totop.js" type="text/javascript"></script>
<script src="/js/index.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		/*
		var defaults = {
				containerID: 'toTop', // fading element id
			containerHoverID: 'toTopHover', // fading element hover id
			scrollSpeed: 1200,
			easingType: 'linear' 
		};
		*/
		$().UItoTop({ easingType: 'easeOutQuart' });
    $(function(){
      $('.cookiesBarClose').click(function () {
        $('#cookiesBar').hide();
      })
    });
	});
</script>
<?/* <!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = 'NHV34YO6ib';var d=document;var w=window;function l(){
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
<!-- {/literal} END JIVOSITE CODE -->
<script data-skip-moving="true">
(function(w,d,u,b){
s=d.createElement('script');r=(Date.now()/1000|0);s.async=1;s.src=u+'?'+r;
h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
})(window,document,'https://cdn.bitrix24.ru/b3893495/crm/site_button/loader_2_kopror.js');
</script>*/?>
<!-- BEGIN JIVOSITE CODE {literal} --><script type='text/javascript'>(function(){ var widget_id = 'NHV34YO6ib';var d=document;var w=window;function l(){var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true;s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script><!-- {/literal} END JIVOSITE CODE -->
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-96543895-1', 'auto');
ga('send', 'pageview');
</script>
<!-- Yandex.Metrika counter -->
<?if(!$_COOKIE['id_city_kladr']){?>
<script>
  $(document).ready(function(){
    $('#regionModal').modal('show');
  });
</script>
<?}?>
<script type="text/javascript">
  (function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
      try {
        w.yaCounter44075489 = new Ya.Metrika({
          id:44075489,
          clickmap:true,
          trackLinks:true,
          accurateTrackBounce:true,
          webvisor:true,
          trackHash:true
        });
      } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
      s = d.createElement("script"),
      f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = "https://mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
      d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
  })(document, window, "yandex_metrika_callbacks");
</script>
<!-- /Yandex.Metrika counter -->
</body>
</html>
