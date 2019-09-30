<?php
error_reporting(0);
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
		include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');

        $arrId = array();

        $page = $_POST["page"];
        if($_POST["width"] > 0){
            $arrId[] = $_POST["width"];
        }
        if($_POST["pcd"] > 0){
            $arrId[] = $_POST["pcd"];
        }
        if($_POST["diametr"] > 0){
            $arrId[] = $_POST["diametr"];
        }

        if($_POST["brand"] > 0){
            $brand = selectCategorieCodeById($_POST["brand"]);
        }else{
            $brand ='disk';
        }

        $id="";
        $in=0;
        foreach ($arrId as $item){
            if($in>0) $id.=',';
            $id.=$item;
            $in++;
        }

		if(!empty($_POST["width"]) OR !empty($_POST["pcd"]) OR !empty($_POST["diametr"]) OR !empty($_POST["brand"])){

      $res = array();

      $arrProduct = selectProductDisk($id, $brand, $_POST["et"], $_POST["dia"], $page);

      if(!empty($arrProduct)){

        $n = 1;
        foreach($arrProduct as $IProd){
          if($IProd["availability"]>=4){
            if($IProd["availability"]>12){
              $kol = "Много";
              $count = 4;
            }elseif($IProd["availability"]>4){
              $kol = $IProd["availability"];
              $count = 4;
            }else{
              $kol = $IProd["availability"];
              $count = $IProd["availability"];
            }
            $res["content"].= templatesDiskSite($IProd["code"], $count, $IProd["cat_img"], $IProd["name"], $kol, $IProd["availability"], $IProd["price"], $n, $IProd["logistic"], $IProd["id"], $IProd["article"], $IProd['provider']);
            $n++;
          }
        }
        /*if(!$res["content"]){
            $res["content"].='<div class="col-md-12" style="margin-bottom:50px;">
<div class="bs-callout bs-callout-warning">
<h4><i class="fa fa-info"></i> ';
            if($error){
                $res["content"].= $error;
            }else{
                $res["content"].= 'По Вашему запросу ничего не найдено.';
            }
            $res["content"].='</h4></div></div>';
        }*/
      }else{
        $res["content"].='<div class="col-md-12" style="margin-bottom:50px;">
				<div class="bs-callout bs-callout-warning">
				<h4><i class="fa fa-info"></i> ';
        if($error){
          $res["content"].= $error;
        }else{
          $res["content"].= 'По Вашему запросу ничего не найдено.';
        }
        $res["content"].='</h4>
				</div>
				</div>';
      }

      $p = $page+1;
      if($total>1 AND $total>$p){
        $res["page"].='<ul class="pagination ht-pagination"><li><a onClick="searchDisk('.$p.')" class="showMore" style="width:100%; height:100%;">Показать еще</a></li></ul>';
      }
      $res["total"] = $total;
      $res["kol"] = $n;

    }else{
			$res["content"] = '<div class="col-md-12" style="margin-bottom:50px;">
			<div class="bs-callout bs-callout-warning">
			<h4><i class="fa fa-info"></i> Выберете диаметр, ширину и сверловку.</h4>
			</div>
			</div>';
		}

		echo json_encode($res);
	}?>