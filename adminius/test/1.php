<?php
/*$get_url = 'https://dobrayashina.ru/adminius/test/kladr.php?weight='.$_POST[weight].'&scope='.$_POST[scope];
echo $modal = file_get_contents($get_url);*/

$arrResult = array();

$idCity = $_POST['region'];
$weight = $_POST['weight'];
$scope = $_POST['scope'];

/*$idCity = '-473';
$weight = '31.6';
$scope = '0.28';*/

$ch = curl_init();

$url = 'http://calc.pecom.ru/bitrix/components/pecom/calc/ajax.php';

$arr = [
  'places' => [
    [
      0, // Ширина
      0, // Длина
      0, // Высота
      $scope, // Объем
      $weight, // Вес
      0, // Признак негабаритности груза
      0 // Признак ЖУ
    ]
  ],
  'take' => [
    'town' => -455, // челяб от куда
    // 'tent' => 0,
    // 'gidro' => 0,
    // 'manip' => 0,
    // 'speed' => 0,
    // 'moscow' => 0
  ],
  'deliver' => [
    'town' => $idCity, // москва куда
    // 'tent' => 0,
    // 'gidro' => 0,
    // 'manip' => 0,
    // 'speed' => 0,
    // 'moscow' => 0
  ],
  // 'plombir' => 0,
  // 'strah' => 6800,
  // 'ashan' => 0,
  // 'night' => 0,
  // 'pal'  => 0,
  // 'pallets' => 0
];
$params = http_build_query($arr);
// echo $params;
curl_setopt_array($ch, array(
  CURLOPT_URL => $url.'?'.$params,
  CURLOPT_RETURNTRANSFER => true
));

$out = curl_exec($ch);
// print_r($out);
$res = json_decode($out, true);

/*echo "<pre>";
print_r($res);
echo "</pre>";*/

$arrResult['autonegabarit'] = $res['autonegabarit'][0]."<br>".$res['autonegabarit'][1]." - ".$res['autonegabarit'][2]." руб<br>";
$arrResult['deliver'] = $res['deliver'][0]." по городу ".$res['deliver'][1]." - ".$res['deliver'][2]." руб";

echo json_encode($arrResult);