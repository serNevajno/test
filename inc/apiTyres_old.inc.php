<?php
//ini_set("display_errors", "off");
//error_reporting(0);
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
    include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
    include ($_SERVER['DOCUMENT_ROOT'].'/inc/apiFunc.inc.php');

    if($_POST["width"] == "Ширина" OR $_POST["width"] == ""){
        $width_min = 0;
        $width_max = 355;
    }else{
        $width_min = $_POST["width"];
        $width_max = $_POST["width"];
    }

    if($_POST["height"] == "Высота" OR $_POST["height"] == ""){
        $height_min = 25;
        $height_max = 85;
    }else{
        $height_min = $_POST["height"];
        $height_max = $_POST["height"];
    }

    if($_POST["diametr"] == "Диаметр" OR $_POST["diametr"] == ""){
        $diameter_min = 12;
        $diameter_max = 23;
    }else{
        $diametr = str_replace("R", "", $_POST["diametr"]);
        $pos = strripos($_POST["diametr"], "C");
        if ($pos !== FALSE){
            $reinforced = 1;
            $diametr = str_replace("C", "" ,$diametr);
        }else{
            $reinforced = 0;
        }
        $diameter_min = $diametr;
        $diameter_max = $diametr;
    }
    $brand = array();
    if($_POST["brand"] != "Бренд" AND $_POST["brand"] != "Все"){
        $brand[] = $_POST["brand"];
    }
    if($_POST["width"] > 0 OR $_POST["height"] > 0 OR $diametr > 0 OR !empty($brand)){
        $client = new SoapClient(SOAP_CLIENT);
        $season = array();

        if($_POST["season_w"] == '1'){
            $season[] ="w";
        }
        if($_POST["season_s"] == '1'){
            $season[] = "s";
        }
        if($_POST["season_u"] == '1'){
            $season[] = "u";
        }

        /*if($_POST["thorn_w"] == '1' AND $_POST["thorn_n"] != '1'){
            $thorn = TRUE;
        }else{
            $thorn = "";
        }*/
        try {
            if($_POST["thorn_w"] == '1' AND $_POST["thorn_n"] != '1'){
                $params =  array
                (
                    'login' => SOAP_LOGIN,
                    'password' => SOAP_PASS,
                    'filter' => array(
                        'type_list' => array(0 => "car", 1 => "cartruck", 2 => "vned"),
                        'season_list' => $season,
                        'width_min' => $width_min,
                        'width_max' => $width_max,
                        'height_min' => $height_min,
                        'height_max' => $height_max,
                        'diameter_min' => $diameter_min,
                        'diameter_max' => $diameter_max,
                        'thorn' => 1,
                        'brand_list' => $brand,
                        'reinforced' => $reinforced,
                    ),
                    'page' => $_POST["page"],
                );
            }else{
                $params =  array
                (
                    'login' => SOAP_LOGIN,
                    'password' => SOAP_PASS,
                    'filter' => array(
                        'type_list' => array(0 => "car", 1 => "cartruck", 2 => "vned"),
                        'season_list' => $season,
                        'width_min' => $width_min,
                        'width_max' => $width_max,
                        'height_min' => $height_min,
                        'height_max' => $height_max,
                        'diameter_min' => $diameter_min,
                        'diameter_max' => $diameter_max,
                        'brand_list' => $brand,
                        'reinforced' => $reinforced,
                    ),
                    'page' => $_POST["page"],
                );
            }
            $answer = $client->GetFindTyre($params);
            /*echo "<pre>";
            print_r($params);
            echo "</pre>";
            echo "<pre>";
            print_r($answer);
            echo "</pre>";*/
        } catch (Exception $exc) {
            $error = 'Ошибка. Товар либо сервис недоступны.';
        }
        $res = '<div class="clearfix"></div>';
        if(!empty($answer->GetFindTyreResult->price_rest_list->TyrePriceRest)){
            if(count($answer->GetFindTyreResult->price_rest_list->TyrePriceRest)== 1){
                $pr[] = $answer->GetFindTyreResult->price_rest_list->TyrePriceRest;
                $arrProduct = arrProduct($pr, $answer->GetFindTyreResult->warehouseLogistics->WarehouseLogistic);
            }else{
                $arrProduct = arrProduct($answer->GetFindTyreResult->price_rest_list->TyrePriceRest, $answer->GetFindTyreResult->warehouseLogistics->WarehouseLogistic);
            }
            $n=1;

            foreach($arrProduct as $IProd){
                $res.= templatesTyres($IProd["code"], $IProd["count"], $IProd["img"], $IProd["name"], $IProd["season_icon"], $IProd["thorn"], $IProd["rest"], $IProd["kol"], $IProd["price"], $n, $IProd["dayLog"]);
                $n++;
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
        if($answer->GetFindTyreResult->totalPages>1){
            $p = $_POST["page"]+1;
            $res.='<nav aria-label="Page navigation"><ul class="pagination ht-pagination">';
            if($p>1){
                $res.='<li><a aria-label="Previous" onClick="searchTyres('.($p-1).')"><span aria-hidden="true"><i class="fa fa-chevron-left"></i></span></a></li>';
            }
            for ($i = 1; $i <= $answer->GetFindTyreResult->totalPages; $i++) {
                if($i == $p){
                    $res.='<li class="active"><a onClick="searchTyres('.$i.')">'.$i.'</a></li>';
                }else{
                    $res.='<li><a onClick="searchTyres('.$i.')">'.$i.'</a></li>';
                }
            }
            if($p != $answer->GetFindTyreResult->totalPages){
                $res.='<li><a onClick="searchTyres('.($p+1).')" aria-label="Next"><span aria-hidden="true"><i class="fa fa-chevron-right"></i></span></a></li>';
            }
            $res.='</ul></nav>';
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