<div id="wrap-body" class="p-t-lg-30">
	<div class="container">
		<div class="wrap-body-inner">
			<!-- Breadcrumb-->
			<?include($_SERVER['DOCUMENT_ROOT']).'/templates/breadcrumbs.tpl.php';?>
			<!-- Contact -->
			<section class="block-contact m-t-lg-30 m-t-xs-0 p-b-lg-50">
				<div class="">
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12 m-b-xs-30 m-t-xs-30" style="margin-bottom: 25px;">
							<?/* <iframe class="iframe02" src="<?=$settings['maps']?>"></iframe> */?>
							<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU&load=package.full" type="text/javascript"></script>
							<style type="text/css">
									#YMapsID {
											width: 100%;
											height: 300px;
									}
							</style>
							<?
							$api = file_get_contents('https://geocode-maps.yandex.ru/1.x/?format=json&geocode='.$settings['addres']);
							$count = json_decode($api);
							//echo"<pre>".print_r($count->response->GeoObjectCollection->featureMember)."</pre>";
							//echo $count->response->GeoObjectCollection->featureMember['0']->response->GeoObjectCollection->featureMember;
							foreach ($count->response->GeoObjectCollection->featureMember as $item){?>
								<?
									$r = $item->GeoObject->Point->pos;
									$r = explode(' ', $r);
								?>
							<?}?>
							<div id="YMapsID"></div>
							<script>
							ymaps.ready(function () {
									var myMap = new ymaps.Map('YMapsID', {
											center: [<?=$r[1]?>, <?=$r[0]?>],
											zoom: 16,
											controls: []
									});

									var myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
											balloonContentBody: [
													'<address>',
													'<strong>Офис Добрая Шина в Челябинске</strong>',
													'<br/>',
													'Адрес: <?=$settings['addres']?>',
													'<br/>',
													'</address>'
											].join('')
									}, {
											preset: 'islands#redDotIcon'
									});

									myMap.geoObjects.add(myPlacemark);
							});
							</script>
						</div>
						<!-- Contact info -->
						<div class="col-sm-6 col-md-6 col-lg-6 m-b-xs-30">
							<div class="heading">
								<h3>Контактная информация</h3>
							</div>
							<div class="contact-info p-lg-30 p-xs-15 bg-gray-fa bg1-gray-2">
								<div class="content">
									<p><?=$meta_item['descriptions']?></p>
									<ul class="list-default">
										<li><i class="fa fa-home"></i> <?=$settings['addres']?></li>
										<li><i class="fa fa-phone"></i> <?=$settings['phone']?></li>
										<li><i class="fa fa-envelope-o"></i> <?=$settings['email']?></li>
										<li><i class="fa fa-clock-o"></i> <?=$settings['time_work']?></li>
									</ul>
								</div>
							</div>
						</div>
						<!-- Contact form -->
						<div class="col-sm-6 col-md-6 col-lg-6">
							<div class="heading">
								<h3> Контактная форма</h3>
							</div>
							<div class="contact-form p-lg-30 p-xs-15 bg-gray-fa bg1-gray-2">
								<form>
									<div class="form-group col-md-6" style="padding:0px;">
										<input type="email" class="form-control form-item" placeholder="Email">
									</div>
									<div class="form-group col-md-6" style="padding:0px;">
										<input type="text" class="form-control form-item" placeholder="Телефон" id="phone">
									</div>
									<textarea class="form-control form-item h-200 m-b-lg-10" placeholder="Сообщение" rows="3"></textarea>
									<button type="submit" class="ht-btn ht-btn-default" style="width:100%;">Отправить</button>
								</form>
							</div>
						</div>

            <?if(selectOffice()){
              foreach (selectOffice() as $item){?>
            <div class="col-md-12" style=" margin-top: 20px; padding: 0px;">
              <div class="col-sm-6 col-md-6 col-lg-6 m-b-xs-30">
                <div class="heading">
                  <h3>Контактная информация офиса в Уфе</h3>
                </div>
                <div class="contact-info p-lg-30 p-xs-15 bg-gray-fa bg1-gray-2">
                  <div class="content">
                    <ul class="list-default">
                      <li><i class="fa fa-home"></i> <?=$item['address']?></li>
                      <li><i class="fa fa-phone"></i> <?=$item['phone']?></li>
                      <li><i class="fa fa-envelope-o"></i> <?=$item['email']?></li>
                      <li><i class="fa fa-clock-o"></i> <?=$item['time_work']?></li>
                    </ul>
                  </div>
                </div>
              </div>
              <!-- Contact form -->
              <div class="col-sm-6 col-md-6 col-lg-6">
                <div class="heading">
                  <h3> Карта</h3>
                </div>
                <div class="contact-form p-lg-30 p-xs-15 bg-gray-fa bg1-gray-2">
                  <iframe src="<?=$item['maps']?>" width="100%" height="100%" frameborder="0"></iframe>
                </div>
              </div>
            </div>
            <?}}?>

					</div>
				</div>
			</section>
		</div>
	</div>
</div>