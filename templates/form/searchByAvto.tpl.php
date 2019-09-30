<div class="col-sm-12 col-md-6 col-lg-6" style="padding:0px;" id="formDiskByAvtoFirst">
	<div class="row p-l-xs-15" style="padding-left: 30px;padding-right: 15px;">
		<?
			/*include($_SERVER['DOCUMENT_ROOT'].'/inc/apiAvto.inc.php');
			$resAuto = $client->GetMarkaAvto($params);*/
		?>
		<?/*<div class="col-sm-6 col-md-6 col-lg-6 m-b-lg-15 p-r-lg-0 p-r-xs-15">
			<div class="select-wrapper">
				<div class="dropdown">
					<button class="dropdown-toggle form-item" type="button" id="buttonMarka" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><?if($_GET["marka"]){echo $_GET["marka"];}else{ echo "Марка";}?></button>
					<ul class="dropdown-menu filtr-scroll" aria-labelledby="dropdownMenu2" id="listMarka">
						<?foreach($resAuto->GetMarkaAvtoResult->marka_list->string as $iMarka){?>
							<li value="<?=$iMarka?>"><?=$iMarka?></li>
						<?}?>
					</ul>
				</div>
			</div>
		</div>*/?>

    <div class="col-sm-6 col-md-6 col-lg-6 m-b-lg-15 p-r-lg-0 p-r-xs-15">
      <div class="select-wrapper">
        <div class="dropdown">
          <button class="dropdown-toggle form-item arrow_menu" type="button" id="buttonMarka" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><?if($_GET["marka"]){echo $_GET["marka"];}else{ echo "Марка";}?></button>
          <ul class="dropdown-menu filtr-scroll" aria-labelledby="dropdownMenu2" id="listMarka">
            <?foreach(selectListMarkaAuto() as $iMarka){?>
              <li value="<?=$iMarka['vendor']?>"><?=$iMarka['vendor']?></li>
            <?}?>
          </ul>
        </div>
      </div>
    </div>
		
		<div class="col-sm-6 col-md-6 col-lg-6 m-b-lg-15 p-r-lg-0 p-r-xs-15">
			<div class="select-wrapper">
				<div class="dropdown">
					<button class="dropdown-toggle form-item arrow_menu" type="button" id="buttonModel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><?if($_GET["model"]){echo $_GET["model"];}else{ echo "Модель";}?></button>
					<ul class="dropdown-menu filtr-scroll" aria-labelledby="dropdownMenu2" name="model" id="listModel">
					</ul>
				</div>
			</div>
		</div>
		
		<div class="col-sm-6 col-md-6 col-lg-6 m-b-lg-15 p-r-lg-0 p-r-xs-15">
			<div class="select-wrapper">
				<div class="dropdown">
					<button class="dropdown-toggle form-item arrow_menu" type="button" id="buttonYear" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><?if($_GET["year"]){echo $_GET["year"];}else{ echo "Год";}?></button>
					<ul class="dropdown-menu filtr-scroll" aria-labelledby="dropdownMenu2" name="year" id="listYear">
						
					</ul>
				</div>
			</div>
		</div>
		
		<div class="col-sm-6 col-md-6 col-lg-6 m-b-lg-15 p-r-lg-0 p-r-xs-15">
			<div class="select-wrapper">
				<div class="dropdown">
					<button class="dropdown-toggle form-item arrow_menu" type="button" id="buttonModification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><?if($_GET["modification"]){echo $_GET["modification"];}else{ echo "Модификация";}?></button>
					<ul class="dropdown-menu filtr-scroll" aria-labelledby="dropdownMenu2" name="modification" id="listModification">
						
					</ul>
				</div>
			</div>
		</div>
		<br>
		<?/*<div class="col-md-12 p-r-lg-0" id="AvtoSeason" style="display:none;">
					<div class="row main-filter">
						<div class="col-md-4">
							<div class="col-lg-12 text-left p-l-md-0 p-r-md-0">
								<div class="checkbox">
									<input type="checkbox" value="1" id="AvtoSeason_s">
								<label for="AvtoSeason_s" class="fa fa-check"></label>Летние</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="col-lg-12 text-left p-l-md-0 p-r-md-0">
								<div class="checkbox">
									<input type="checkbox" value="1" id="AvtoThorn_w">
								<label for="AvtoThorn_w" class="fa fa-check"></label>Шипованые</div>
							</div>																				
							<div class="col-lg-12 text-left p-l-md-0 p-r-md-0">
								<div class="checkbox">
									<input type="checkbox" value="1" id="AvtoSeason_w">
								<label for="AvtoSeason_w" class="fa fa-check"></label>Зимние</div>
							</div>
							
							<div class="col-lg-12 text-left p-l-md-0 p-r-md-0">
								<div class="checkbox">
									<input type="checkbox" value="1" id="AvtoThorn_n">
								<label for="AvtoThorn_n" class="fa fa-check"></label>Нешипованые</div>
							</div>
						</div>
						<div class="col-md-4">	
							<div class="col-lg-12 text-left p-l-md-0 p-r-md-0">
								<div class="checkbox">
									<input type="checkbox" value="1" id="AvtoSeason_u">
								<label for="AvtoSeason_u" class="fa fa-check"></label>Всесезонные</div>
							</div>
						</div>
					</div>
			
			
			
			
		</div>*/?>
		<div class="col-sm-12 col-md-12 col-lg-12 m-b-lg-15 p-r-lg-0 p-r-sm-15 p-r-xs-15">
			<button type="button" class="ht-btn ht-btn-default  pull-right pull-left-xs" style="width: 100%; display:none;" id="<?if($_GET["categories_code"] == "tyres"){echo "buttonTyresByAvto";}elseif($_GET["categories_code"] == "disk"){echo "buttonDiskByAvto";}else{echo "buttonByAvtoMain";}?>" value="<?=$_GET["categories_code"]?>">
				<i class="fa fa-search"></i> Подобрать по авто
			</button>
		</div>
		
	</div>
</div>