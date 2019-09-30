<?if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  error_reporting(0);
    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php');
    /////Подключение библиотеки
    include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/function.inc.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/uploadProduct/upFunc.inc.php');

    /////Замок
    include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/lock.inc.php');

    $start = clearData($_POST['count'], "i");

    $sProduct = db2array("SELECT `code_p`, `brend`, `name`, `img`, `model_wheel`, `deametr_wheel`, `rim_width`, `et`, `pcd`, `dia`, `color`, `applicability`, `hit_or_new`, `sklad1`, `sklad2`, `sklad3`, `sklad4`, `rrc` FROM aksioma ORDER BY id DESC LIMIT $start, 100",2);

    $provider = '5';
    $cEnd = $start + 100;
    foreach ($sProduct as $item){
      $article = $item['code_p']; ///Номенклатура.Артикул
      $marka = $item['brend']; ////Номенклатура.Общ Производитель
      $name = $item['name'];
      $model = $item['model_wheel']; ////Номенклатура.Общ. Модель
      $diameter = $item['deametr_wheel'];
      $width = $item['rim_width'];
      $pcd = $item['pcd'];
      $pcd = str_replace(",",".", $pcd);
      $pcd = str_replace(".0","", $pcd);
      $dia = $item['dia'];
      $et = $item['et'];
      $price_clear = $item['rrc']; ///Цена B2B
      $price = getPriceProvide("2", $marka, $diameter, "", $price_clear, $provider); ///Розничная цена
      $availability = $item['sklad1']+$item['sklad2']+$item['sklad3']+$item['sklad4']; ///Итого
      $logistic = '1';
      $date = date("Y-m-d H:i:s");

      $filter = array();
      $filter["diameter"] = $diameter;
      $filter["width"] = str_replace(",",".", $width);
      $filter["pcd"] = $pcd;
      $filter["dia"] = str_replace(",",".", $dia);
      $filter["et"] = $et;
      addProduct($provider, "2", $article, $price, $price_clear, $logistic, $availability, $model, $marka, $name, $item['img'], $filter);
    }
    echo $cEnd;
}?>