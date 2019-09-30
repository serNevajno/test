<?
if($_SERVER["REQUEST_METHOD"]=="POST") {
  session_start();
  //////Подключение к базе
  include($_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php');
  /////Подключение библиотеки
  include($_SERVER['DOCUMENT_ROOT'] . '/inc/function.inc.php');
  include($_SERVER['DOCUMENT_ROOT'] . '/inc/gift/function.php');



/*echo "<pre>";
print_r($resGift);
echo "</pre>";*/
$resGift = selectGift();
   // echo "<pre>".print_r($sProduct, true)."</pre>";
//if($item['sale'] >0){<span class="color-red">(-$item['sale'] %)</span>}
foreach ($resGift as $iResGift){
    $iProd = db2array("SELECT id, name, price, img, code FROM product WHERE id='$iResGift[id]'");
        if ($iProd['img']) {
            $img = "/images/product_cover/".$iProd['img'];
        }else{
            $img = "http://via.placeholder.com/200x150&text=Нет фото";
        }
        $r.='<div class="row m-lg-0 overl bor-r">
                                    <div class="col-sm-5 col-md-5 col-lg-5 cart-item">
                                        <div class="row">
                                            <div class="col-sm-3 col-md-3 col-lg-3">
                                                <a href="/soputstvyushie tovari/'.$iProd['code'].'-'.$iProd['id'].'.html" class="cart-img-prev">
                                                    <img src="'.$img.'" alt="'.$iProd['name'].'">
                                                </a>
                                            </div>
                                            <div class="col-sm-9 col-md-9 col-lg-9 p-lg-0">	
                                                <div class="product-name">
                                                    <h5><a href="">'.$iProd['name'].'</a></h5>
                    </div>
                    </div>
                    </div>
                    </div>
                    <div class="col-sm-2 col-md-2 col-lg-2 cart-item">
                        <p class="color-green"><span class="price">'.$iProd['price'].' руб.</span></p>
                    </div>
                    <div class="col-sm-2 col-md-2 col-lg-2 cart-item">
                        <div class="form-group dop">
                            <div class="col-md-2" style="padding: 2.5em 0;">
                              
                            </div>
                            <div class="col-md-8" style="padding:0px; margin:0px;">
                                <input type="text" value="'.$iResGift["quantity"].'" class="form-control form-item fInput" style=" width: 100%; margin: 0px; text-align: center; margin-top: 20%;" readonly>
                            </div>
                            <div class="col-md-2" style="padding: 2.5em 0;">
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3 cart-item">
                        <p style="line-height: 0px;top: 20px;position: inherit;"><strong><span ><s>'.($iProd['price'] * $iResGift["quantity"]).' руб</s> <br /> бесплатно</span></strong></p>
                    </div>
                
                    </div>';
    }


echo $r;
  //echo json_encode(sGift());

}
?>