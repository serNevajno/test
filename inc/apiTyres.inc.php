 <?php
	//ini_set("display_errors", "off");
//error_reporting(0);
 if($_SERVER["REQUEST_METHOD"]=="POST"){
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');

     $arrId = array();

     $page = $_POST["page"];
     if($_POST["width"] > 0){
         $arrId[] = $_POST["width"];
     }
     if($_POST["height"] > 0){
         $arrId[] = $_POST["height"];
     }
     if($_POST["diametr"] > 0){
         $arrId[] = $_POST["diametr"];
     }
     if($_POST["season_w"] == '1'){
         $arrId[] = '156';
     }
     if($_POST["season_s"] == '1'){
         $arrId[] = '155';
     }
     if($_POST["season_u"] == '1'){
         $arrId[] = '157';
     }
     if($_POST["thorn_w"] == '1'){
         $arrId[] = '158';
     }
     if($_POST["thorn_n"] == '1'){
         $arrId[] = '159';
     }
     if($_POST["brand"] > 0){
         $brand = selectCategorieCodeById($_POST["brand"]);
     }else{
         $brand ='tyres';
     }

     $id="";
     $in=0;
     foreach ($arrId as $item){
        if($in>0) $id.=',';
        $id.=$item;
        $in++;
     }
				if($_POST["width"] > 0 OR $_POST["height"] > 0 OR $diametr > 0 OR !empty($brand)){

                    /*echo "<pre>";
                    print_r($_POST);
                    echo "</pre>";
                    /*echo "<pre>";
                    print_r($answer);
                    echo "</pre>";*/

					$res = '<div class="clearfix"></div>';
                    $arrProduct = selectProductTyres($id, $brand, $page);

					if($arrProduct){

						$n=1;
						
						foreach($arrProduct as $IProd) {
                            if ($IProd["availability"] >= 4 OR $_POST["only4"] == '0') {
                                if ($IProd["availability"] > 12) {
                                    $kol = "Много";
                                    $count = 4;
                                } elseif ($IProd["availability"] > 4) {
                                    $kol = $IProd["availability"];
                                    $count = 4;
                                } else {
                                    $kol = $IProd["availability"];
                                    $count = $IProd["availability"];
                                }

                                $season = selectElementValueFilter($IProd["id"], '23');
                                if ($season == "156") {
                                    $season_icon = '<li class="f-13"><i class="fa fa-snowflake-o" style="color:#489fdf;"></i> Зимние</li>';
                                } elseif ($season == "155") {
                                    $season_icon = '<li class="f-13"><i class="fa fa-sun-o" style="color:#f0ad4e;"></i> Летние</li>';
                                } elseif ($season == "157") {
                                    $season_icon = '<li class="f-13"><i class="fa fa-sun-o" style="color:#f0ad4e;"></i> <i class="fa fa-snowflake-o" style="color:#489fdf;"></i> Всесезонные</li>';
                                }

                                $thorn = selectElementValueFilter($IProd["id"], '24');
                                if ($thorn == "158") {
                                    $thornn_icon = '<li class="f-13"><i class="fa fa-dot-circle-o"></i> Шипованные</li>';
                                } else {
                                    $thornn_icon = '<li class="f-13"><i class="fa fa-circle-o"></i> Нешипованные</li>';
                                }

                                $res .= templatesTyresSite($IProd["code"], $count, $IProd["cat_img"], $IProd["name"], $season_icon, $thornn_icon, $kol, $IProd["availability"], $IProd["price"], $n, $IProd["logistic"], $IProd["id"], $IProd["article"], $IProd['provider']);
                                $n++;
                            }
						}
					}else{
						$res.='<div class="col-md-12" style="margin-bottom:50px;">
							<div class="bs-callout bs-callout-warning">
								<h4><i class="fa fa-info"></i> ';
								if($error){
									$res.= $error;
								}else{
									$res.= 'По Вашему запросу ничего не найдено.';
								}
								$res.='</h4>
							</div>
						</div>';
					}
					if($total>1){
						$res.='<nav aria-label="Page navigation">
                            <ul class="pagination ht-pagination">
                                '.$pervpage.$page5left.$page4left.$page3left.$page2left.$page1left.'
                                <li class="active"><a>'.$page.'</a></li>
                                '.$page1right.$page2right.$page3right.$page4right.$page5righ.$nextpage.'	
                            </ul>
                        </nav>';
					}
				}else{
					$res = '<div class="col-md-12" style="margin-bottom:50px;">
							<div class="bs-callout bs-callout-warning">
								<h4><i class="fa fa-info"></i> Выберете хоть один параметр.</h4>
							</div>
						</div>';
				}

				echo $res;
}
?>