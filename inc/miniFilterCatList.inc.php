<?php
if($_SERVER["REQUEST_METHOD"]=="POST") {
  session_start();
  //////Подключение к базе
  include($_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php');
  /////Подключение библиотеки
  include($_SERVER['DOCUMENT_ROOT'] . '/inc/function.inc.php');
  // Фильтруем полученные данные

  $wi = clearData($_POST['wi']);
  $hei = clearData($_POST['hei']);
  $dia = clearData($_POST['dia']);
  $code = clearData($_POST['categories_code']);

  $res = array();


  /*function sSQL($code, $wi="", $hei="", $dia=""){
    $filter1 = '';
    $join1 = '';

    if(!empty($wi)){
      $join1 .= "LEFT JOIN filter_value as t6 on(t3.id = t6.id_product) \n";
      $filter1 .= "AND t6.element_value = '$wi'";
    }
    if(!empty($hei)){
      $join1 .= "LEFT JOIN filter_value as t7 on(t3.id = t7.id_product) \n";
      $filter1 .= "AND t7.element_value = '$hei'";
    }
    if(!empty($dia)){
      $join1 .= "LEFT JOIN filter_value as t8 on(t3.id = t8.id_product) \n";
      $filter1 .= "AND t8.element_value = '$dia'";
    }

    return "SELECT t1.id, t1.code, t1.name, t2.name as name_section, t1.img, t3.id as prod_id, t5.id as id_seeson, t5.value as seeson_name, t3.name as prod_name FROM categories as t1 
    LEFT JOIN categories as t2 on(t1.section=t2.id) 
    LEFT JOIN product as t3 on(t1.id = t3.categories) 
    LEFT JOIN filter_value as t4 on(t3.id = t4.id_product) 
    LEFT JOIN element_filter as t5 on(t5.id = t4.element_value) 
    $join1
  WHERE t2.code='$code' AND t4.id_filter = '23' AND t3.availability>0 $filter1 GROUP BY t1.id";
  }


  $res['sql'] = sSQL($code, $wi, $hei, $dia);*/
  //$res['arr'] = '<pre>'.print_r(selectCategoriesByCode2($code, $wi, $hei, $dia), true).'</pre>';

  $resArr = selectCategoriesByCode2($code, $wi, $hei, $dia);
  $resArr = sort_nested_arrays($resArr, array('id_seeson' => 'ASC'));

  $s = 0; $w = 0; $ws = 0;
  $txt = '';

  foreach ($resArr as $item){

    if(($item['id_seeson'] == 156 and $w == 0) OR ($item['id_seeson'] == 155 and $s == 0) OR ($item['id_seeson'] == 157 and $ws == 0)){
      switch ($item['id_seeson']){
        case 155: $s = 1; break;
        case 156: $w = 1; break;
        case 157: $ws = 1; break;
      }
      $txt .= "<div class='col-md-12'><div class='product-filter p-t-xs-20 p-l-xs-20'>
                  <div class='pull-left'>
                    <h5>".$item['seeson_name']."</h5>
                  </div>
                </div></div>";
    }

    if(!$item['img']){
      $img = '<img src="//placehold.it/150x150?text=no image" alt='.$meta_item['title'].'">';
    }else{
      if(file_exists($_SERVER['DOCUMENT_ROOT'].'/images/categories_cover/'.$item["img"])){
        $img = '<img src="/scripts/phpThumb/phpThumb.php?src=/images/categories_cover/'.$item["img"].'&w=150&h=150&far=1&bg=ffffff&f=jpg" alt="'.$item["name"].'">';
      }else{
        $img = '<img src="//placehold.it/150x150?text=no image" alt="'.$meta_item['title'].'">';
      }
    }

    $txt .= '<div class="col-sm-6 col-md-3 col-lg-2" style="min-height: 210px !important;">
              <!-- Product item -->
              <div class="product-item hover-img" style="padding:unset;">
                <a href="/'.$item["code"].'/" class="product-img">
                  '.$img.'
                </a>
                <div class="product-caption">
                  <h4 class="product-name title-product-name" style="font-size:12px;margin-top:unset;font-weight:unset;">
                    <a href="/'.$item["code"].'/" title="'.$item["name"].'">'.$item["name"].'</a>
                  </h4>
                </div>
              </div>
            </div>';
  }

  if(empty($txt)){
    $txt = '<div class="col-md-12" style="margin-bottom:50px;">
							<div class="bs-callout bs-callout-warning">
								<h4><i class="fa fa-info"></i> По Вашему запросу ничего не найдено.</h4>
							</div>
						</div>';
  }

  $res['txt'] = $txt;
  echo json_encode($res);
}
