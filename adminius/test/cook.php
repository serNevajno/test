<?
/*unset($_COOKIE['pcdDiskName']);
setcookie('pcdDiskName', null, -1, '/');
unset($_COOKIE['widthDiskName']);
setcookie('widthDiskName', null, -1, '/');
unset($_COOKIE['diametrDisk']);
setcookie('diametrDisk', null, -1, '/');
unset($_COOKIE['brandDiskName']);
setcookie('brandDiskName', null, -1, '/');
unset($_COOKIE['etDiskName']);
setcookie('etDiskName', null, -1, '/');
unset($_COOKIE['diaDiskName']);
setcookie('diaDiskName', null, -1, '/');*/
echo "<pre>";
print_r($_COOKIE);
echo "</pre>";
/*$code = "%u0412%u0441%u0435";
echo json_decode($code);*/

function unicode2win($s) {
  $s=strtr($s, array("%u0410"=>"А", "%u0430"=>"а", "%u0411"=>"Б", "%u0431"=>"б", "%u0412"=>"В",
      "%u0432"=>"в", "%u0413"=>"Г", "%u0433"=>"г", "%u0414"=>"Д", "%u0434"=>"д",
      "%u0415"=>"Е", "%u0435"=>"е", "%u0401"=>"Ё", "%u0451"=>"ё", "%u0416"=>"Ж",
      "%u0436"=>"ж", "%u0417"=>"З", "%u0437"=>"з", "%u0418"=>"И", "%u0438"=>"и",
      "%u0419"=>"Й", "%u0439"=>"й", "%u041A"=>"К", "%u043A"=>"к", "%u041B"=>"Л",
      "%u043B"=>"л", "%u041C"=>"М", "%u043C"=>"м", "%u041D"=>"Н", "%u043D"=>"н",
      "%u041E"=>"О", "%u043E"=>"о", "%u041F"=>"П", "%u043F"=>"п", "%u0420"=>"Р",
      "%u0440"=>"р", "%u0421"=>"С", "%u0441"=>"с", "%u0422"=>"Т", "%u0442"=>"т",
      "%u0423"=>"У", "%u0443"=>"у", "%u0424"=>"Ф", "%u0444"=>"ф", "%u0425"=>"Х",
      "%u0445"=>"х", "%u0426"=>"Ц", "%u0446"=>"ц", "%u0427"=>"Ч", "%u0447"=>"ч",
      "%u0428"=>"Ш", "%u0448"=>"ш", "%u0429"=>"Щ", "%u0449"=>"щ", "%u042A"=>"Ъ",
      "%u044A"=>"ъ", "%u042B"=>"Ы", "%u044B"=>"ы", "%u042C"=>"Ь", "%u044C"=>"ь",
      "%u042D"=>"Э", "%u044D"=>"э", "%u042E"=>"Ю", "%u044E"=>"ю", "%u042F"=>"Я",
      "%u044F"=>"я", "%u2116"=>"№"));
  return $s;
}
echo unicode2win('%u0428%u0438%u0440%u0438%u043D%u0430');
echo unicode2win('%u0421%u0432%u0435%u0440%u043B%u043E%u0432%u043A%u0430');
echo unicode2win('%u0411%u0440%u0435%u043D%u0434');
echo unicode2win('%u0412%u044B%u043B%u0435%u0442');
echo unicode2win('%u0421%u0442%u0443%u043F%u0438%u0446%u0430');

?>