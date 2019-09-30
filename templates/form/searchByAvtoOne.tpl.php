<div class="col-sm-12 col-md-6 col-lg-6" style="padding:0px;">
	<div class="row" style="padding-left: 30px;padding-right: 15px;">
		<?
			if(isset($_GET["categories_code"])){
				include($_SERVER['DOCUMENT_ROOT'].'/inc/apiAvto.inc.php');
				$resAuto = $client->GetMarkaAvto($params);
			}
		?>
		<div class="col-sm-6 col-md-6 col-lg-6 m-b-lg-15 p-r-lg-0 p-r-xs-15">
			<div class="select-wrapper">
				<div class="dropdown">
					<button class="dropdown-toggle form-item arrow_menu" type="button" id="buttonMarka1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Марка</button>
					<ul class="dropdown-menu filtr-scroll" aria-labelledby="dropdownMenu2" id="listMarka1">
						<?foreach($resAuto->GetMarkaAvtoResult->marka_list->string as $iMarka){?>
							<li value="<?=$iMarka?>"><?=$iMarka?></li>
						<?}?>
					</ul>
				</div>
			</div>
		</div>
		
		<div class="col-sm-6 col-md-6 col-lg-6 m-b-lg-15 p-r-lg-0 p-r-xs-15">
			<div class="select-wrapper">
				<div class="dropdown">
					<button class="dropdown-toggle form-item arrow_menu" type="button" id="buttonModel1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Модель</button>
					<ul class="dropdown-menu filtr-scroll" aria-labelledby="dropdownMenu2" name="model" id="listModel1">
					</ul>
				</div>
			</div>
		</div>
		
		<div class="col-sm-6 col-md-6 col-lg-6 m-b-lg-15 p-r-lg-0 p-r-xs-15">
			<div class="select-wrapper">
				<div class="dropdown">
					<button class="dropdown-toggle form-item arrow_menu" type="button" id="buttonYear1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Год</button>
					<ul class="dropdown-menu filtr-scroll" aria-labelledby="dropdownMenu2" name="year" id="listYear1">
						
					</ul>
				</div>
			</div>
		</div>
		
		<div class="col-sm-6 col-md-6 col-lg-6 m-b-lg-15 p-r-lg-0 p-r-xs-15">
			<div class="select-wrapper">
				<div class="dropdown">
					<button class="dropdown-toggle form-item arrow_menu" type="button" id="buttonModification1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Модификация</button>
					<ul class="dropdown-menu filtr-scroll" aria-labelledby="dropdownMenu2" name="modification" id="listModification1">
						
					</ul>
				</div>
			</div>
		</div>
		<br>
		<div class="col-md-12 p-r-lg-0">
			<button type="button" class="ht-btn ht-btn-default  m-t-sm-5 m-t-xs-20 pull-right pull-left-xs" style="width: 100%;" id="<?if($_GET["categories_code"] == "tyres"){echo "buttonTyresByAvto1";}else{echo "buttonDiskByAvto1";}?>">
				<i class="fa fa-search"></i> Подобрать по авто
			</button>
		</div>
		
	</div>
</div>