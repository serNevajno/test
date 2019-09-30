<?if ($_SERVER["REQUEST_METHOD"] == "POST") {
  session_start();
  include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
  /////Подключение библиотеки
  include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/function.inc.php');

  $id = clearData($_POST["id"], "i");
  mysql_query("DELETE FROM basket WHERE id='$id' AND customer='".session_id()."'") or die(mysql_error());

  $arr = selectBasket();
  if($arr) {
    $n = 0;
    foreach ($arr as $item) {
      $season = selectElementValueFilter($item['product_id'], '23');
      if ($season == "156") {
        $season_icon = '<li style="display: inline;
    margin-right: 10px;"><i class="fa fa-asterisk" style="color:#489fdf;"></i> Зимние</li>';
      } elseif ($season == "155") {
        $season_icon = '<li style="display: inline;
    margin-right: 10px;"><i class="fa fa-sun-o" style="color:#f0ad4e;"></i> Летние</li>';
      } elseif ($season == "157") {
        $season_icon = '<li style="display: inline;
    margin-right: 10px;"><i class="fa fa-sun-o" style="color:#f0ad4e;"></i> <i class="fa fa-snowflake-o" style="color:#489fdf;"></i> Всесезонные</li>';
      }
      $thorn = selectElementValueFilter($item['product_id'], '24');
      if ($thorn == "158") {
        $thornn_icon = '<li style="display: inline;
    margin-right: 10px;"><i class="fa fa-dot-circle-o"></i> Шипованные</li>';
      } else {
        $thornn_icon = '<li style="display: inline;
    margin-right: 10px;"><i class="fa fa-circle-o"></i> Нешипованные</li>';
      }

      $totalPrice = $item['price'] * $item['quantity'];
      $sProdId = selectProductById($item['product_id']);
      if($sProdId['availability'] > 4){$avail = 'Много';}
      if($sProdId['availability'] == 4){$avail = '4';}
      if($sProdId['availability'] < 4){$avail = $sProdId['availability'];}
      $dateLog = date('d.m.Y', strtotime('+' . $sProdId["logistic"] . ' days'));

      if($season != '159'){$tIcon = $thornn_icon;}

      if(selectPriceProvider($item['product_id'])){
        $provider = '<div class="col-md-12" style="margin-top: 10px;">
          <table class="table table-bordered table-striped table-condensed flip-content">
            <thead class="flip-content">
            <tr>
              <th> Поставщик </th>
              <th class="numeric"> Цена </th>
              <th class="numeric"> Чистая цена </th>
              <th> Кол-во  </th>
              <th> Дни поставки  </th>
              <th> Дата обновления  </th>
            </tr>
            </thead>
            
            <tbody>';
            foreach (selectPriceProvider($item['product_id']) as $priceProd){
              if($priceProd['id_provider'] == $item['provider']){$style = "style='color: #cb1010; font-weight: 600;'";}else{$style ="";}
              if ($priceProd['id_provider'] == $item['provider']) {$check = "checked";}else{$check ="";}
              $provider .='  <tr '.$style.'>
                <td> 
                  <label class="radio-inline">
                    <input type="radio" name="provider['.$item[id].']" onclick="changePosBascket('.$item['id'].', '.$priceProd['price'].', '.$priceProd['price_clear'].', '.$priceProd['logistic'].', '.$priceProd['id_provider'].', '.$n.')" value="'.$priceProd[id_provider].'" '.$check.'> '.$priceProd[name].'
                  </label>
                </td>
                <td class="numeric"> '.$priceProd['price'].' </td>
                <td class="numeric"> '.$priceProd['price_clear'].' </td>
                <td> '.$priceProd['availability'].' </td>
                <td> '.$priceProd['logistic'].' </td>
                <td> '.$priceProd['date'].' </td>
              </tr>';
            }
            $provider .=' </tbody>
          </table>
        </div>';
      }

            $result .= '
                    <div class="row">
                      <div class="col-sm-12 col-md-2 col-lg-2" style="text-align:center;">
                        <a href="'.$item[url].'" class="product-img">
                          <img src="'.$item[img].'" alt="image" style="max-width:120px">
                        </a>
                      </div>
                      <div class="col-sm-12 col-md-5 col-lg-5">
                        <div class="product-caption">
                          <h4 class="product-name" style="padding-top:0px;margin-top:0px;">
                            <a href="'.$item[url].'" class="f-18">'.$item[name].' ('. $item[article] .')</a>
                          </h4>
                        </div>
                        <ul class="static-caption m-t-lg-20" style="list-style: none; padding: 0px">
                          '.$season_icon.' '.$tIcon.'
                        </ul>
                        <div class="col-md-12" style="padding: 0px;">
                          <i class="fa fa-truck"></i> Получение: самовывоз или доставка ('.$dateLog.')
                        </div>
                        '.$provider.'
                      </div>
                      <div class="col-sm-12 col-md-5 col-lg-5" style="padding:0px;">
                        <div class="col-sm-12 col-md-4 col-lg-4" style="text-align: center;margin-top:2%;">
                          <div class="form-group dop">
                            <div>
                              <b class="product-price">В наличии: '.$avail.'
                              </b>
                            </div>

                            <div>
                              <div class="input-group">
                                <input type="text" id="valInput'.$n.'" class="spinner-input form-control" maxlength="6" value="'.$item[quantity].'" readonly="">
                                <div class="spinner-buttons input-group-btn btn-group-vertical">
                                  <a  onClick="summProduct('.$item[id].', \'plus\', '.$n.')" class="btn spinner-up btn-xs blue">
                                    <i class="fa fa-angle-up"></i>
                                  </a>
                                  <a onClick="summProduct('.$item[id].', \'minus\', '.$n.')" class="btn spinner-down btn-xs blue">
                                    <i class="fa fa-angle-down"></i>
                                  </a>
                                </div>
                              </div>
                            </div>

                          </div>
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3" style="padding: 1em 0; text-align: center;padding-left:15px;">
                          <div style="font-weight: 500;">Цена 1шт: </div>
                          <b class="product-price" id="product-price'.$n.'" style="font-size:18px;">'.$item[price].' руб</b>
                        </div>
                        <div class="col-sm-12 col-md-5 col-lg-5" style="text-align: center;">
                          <b class="product-price color-red" style="font-size: 18px"><span id="summProduct'.$n.'">'.$totalPrice.' руб</span></b>
                          <div class="form-group">
                            <a class="btn red" style="margin:0px; cursor:pointer;" onclick="delPosBasket('.$item[id].')">Удалить</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <hr>
        ';
      $n++;
    }
    echo $result .='
        <div class="col-md-12" style="font-weight: 700; text-align: right; font-size: 18px;">
          Сумма заказа: <span id="total">'.sumBasket().' руб</span>
        </div>
        <hr />
      ';
  }
}?>