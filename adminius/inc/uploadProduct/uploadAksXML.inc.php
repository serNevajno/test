<?
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  session_start();
  include($_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php');
  /////Подключение библиотеки
  include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/function.inc.php');

  mysql_query("TRUNCATE TABLE `aksioma`");
  $name = explode(".", $_FILES["aks"]["name"]);
  if ($name[1] == "xml") {
    $nameFile = "aksioma.xml";

    if (copy($_FILES["aks"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/price_provider/" . $nameFile)) {
      $cont = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/price_provider/" . $nameFile);
      $arrRow = explode('<Row', $cont);

      $resCell = array();
      $arrCell = array();
      $result = array();

      $n = 0;

      foreach ($arrRow as $val) {
        $arrCell = explode('<Cell', $val);
        if($n == 1){
          $arrResCheck = explode('>', $arrCell[1]);
          $resCheck = str_replace("</Data","",$arrResCheck[2]);
          if($resCheck == "disk5"){
            $check = 1;
          }
        }
        foreach ($arrCell as $k => $v) {
          if ($k != 0) {
            $arrRes = explode('>', $v);
            $text = str_replace("</Data", "", $arrRes[2]);
            $text = str_replace("</Cell", "", $text);

            if (!empty($arrRes[2])) {
              switch ($k) {
                case '1':
                  $result[$n]['code'] = (int)trim($text);
                  break;
                case '2':
                  $result[$n]['code_p'] = trim($text);
                  break;
                case '3':
                  $result[$n]['brend'] = trim($text);
                  break;
                case '4':
                  $result[$n]['name'] = trim($text);
                  $r_img = explode('"', $arrRes[0]);
                  $result[$n]['img'] = $r_img[3];
                  break;
                case '5':
                  $result[$n]['model_wheel'] = trim($text);
                  break;
                case '6':
                  $result[$n]['deametr_wheel'] = trim($text);
                  break;
                case '7':
                  $result[$n]['rim_width'] = trim($text);
                  break;
                case '8':
                  $result[$n]['et'] = trim($text);
                  break;
                case '9':
                  $result[$n]['pcd'] = trim($text);
                  break;
                case '10':
                  $result[$n]['dia'] = trim($text);
                  break;
                case '11':
                  $result[$n]['color'] = trim($text);
                  break;
                case '12':
                  $result[$n]['applicability'] = trim($text);
                  break;
                case '13':
                  $result[$n]['hit_or_new'] = trim($text);
                  break;
                case '14':
                  $result[$n]['sklad1'] = trim($text);
                  break;
                case '15':
                  $result[$n]['sklad2'] = trim($text);
                  break;
                case '16':
                  $result[$n]['sklad3'] = trim($text);
                  break;
                case '17':
                  $result[$n]['sklad4'] = trim($text);
                  break;
                case '18':
                  $result[$n]['price_prepayment'] = trim($text);
                  break;
                case '19':
                  $result[$n]['price_postponement'] = trim($text);
                  break;
                case '20':
                  $result[$n]['rrc'] = trim($text);
                  break;
              }
            }
          }
        }
        $n++;
      }
      if($check == 1) {
        foreach ($result as $item) {
          if ($item['code'] != 0 AND !empty($item['img'])) {
            mysql_query("INSERT INTO `aksioma`(`code`, `code_p`, `brend`, `name`, `img`, `model_wheel`, `deametr_wheel`, `rim_width`, `et`, `pcd`, `dia`, `color`, `applicability`, `hit_or_new`, `sklad1`, `sklad2`, `sklad3`, `sklad4`, `price_prepayment`, `price_postponement`, `rrc`) VALUES ('$item[code]','$item[code_p]','$item[brend]','$item[name]','$item[img]','$item[model_wheel]','$item[deametr_wheel]','$item[rim_width]','$item[et]','$item[pcd]','$item[dia]','$item[color]','$item[applicability]','$item[hit_or_new]','$item[sklad1]','$item[sklad2]','$item[sklad3]','$item[sklad4]','$item[price_prepayment]','$item[price_postponement]','$item[rrc]')");
            $mess++;
          }
        }
      }else{
        $mess = "error";
      }
    } else {
      $mess = 0;
    }
  }
  echo $mess;
}
?>