<?php
//////Подключение к базе
ini_set('date.timezone', 'Asia/Yekaterinburg');
define("DB_HOST", "localhost");
define("DB_LOGIN", "a0224336_shin");
define("DB_PASSWORD", "vwKPVpOv");
define("DB_NAME", "a0224336_shin");

$db = @mysql_connect(DB_HOST, DB_LOGIN, DB_PASSWORD) or die("Ошибка соединения с сервером баз данных");
mysql_query('SET NAMES utf8');
mysql_select_db(DB_NAME) or die(mysql_error());

/////Подключение библиотеки
include($_SERVER['DOCUMENT_ROOT'] . '/inc/function.inc.php');


function saveFileSitemap($fileName, $data, $cat=''){
  $file_name = $_SERVER['DOCUMENT_ROOT'].$cat.'/'.$fileName;
  $one_file = fopen($file_name,"w");
  fwrite($one_file,$data);
  fclose($one_file);
}

function sProdCat($id){
  $temp = db2array("SELECT COUNT(*) as ctn FROM categories as t1 LEFT JOIN product as t2 on (t1.id = t2.categories) WHERE t1.id = '$id' AND t2.active = '1'");
  return $temp['ctn'];
}

$current_date = date("Y-m-d H:i:s");
$current_date2 = date("Y-m-d");
$site = 'https://'.$_SERVER['SERVER_NAME'].'/';



// указываем заголовок XML документа, говоря ему о том, что это SITEMAP.XML
$s_map = '<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\r\n";

// указываем главную страницу сайта
// тут нужно получить ссылку на страницу
$sMenu = db2array("SELECT code FROM section WHERE server = '0' AND id NOT IN (1)", 2);
if($sMenu){
  $fileName = 'index.xml';
  $s_map .= '
	<sitemap>
    <loc>'.$site.'sitemap/'.$fileName.'</loc>
    <lastmod>'.$current_date2.'</lastmod>
	</sitemap>'."\r\n";

  $data = '<?xml version="1.0" encoding="UTF-8"?>
	<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">'."\r\n";
  $data .= '<url>
    <loc>'.$site.'</loc>
    <lastmod>'.$current_date.'</lastmod>
	</url>'."\r\n";
    foreach ($sMenu as $menu){
      $data .= '<url>'."\r\n";
      $data .= '<loc>'.$site.$menu["code"].'.html</loc>'."\r\n";
      //$data .= '<lastmod>'.$current_date.'</lastmod>'."\r\n";
      $data .= '</url>'."\r\n";
    }
  $data .= '</urlset>';

  saveFileSitemap($fileName, $data, $cat='/sitemap');
  //echo $data;
}

$sCat = db2array("SELECT id, code FROM categories WHERE active = '1'", 2);
if($sCat){
  $fileName = 'categories.xml';
  $s_map .= '
	<sitemap>
    <loc>'.$site.'sitemap/'.$fileName.'</loc>
    <lastmod>'.$current_date2.'</lastmod>
	</sitemap>'."\r\n";

  foreach ($sCat as $item) {
    if (sProdCat($item['id']) > 0){
      $fileName = $item["code"] . '.xml';
      $s_map .= '
      <sitemap>
        <loc>' . $site . 'sitemap/' . $fileName . '</loc>
        <lastmod>' . $current_date2 . '</lastmod>
      </sitemap>' . "\r\n";


      $sProd = db2array("SELECT t2.code, t2.id, t2.categories, t2.date, t1.code as code_cat FROM categories as t1 LEFT JOIN product as t2 on (t1.id = t2.categories) WHERE t1.id = '$item[id]' AND t2.active = '1' ORDER BY t2.id DESC", 2);

      $data = '<?xml version="1.0" encoding="UTF-8"?>
    <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . "\r\n";
      foreach ($sProd as $items) {
        $par_cat = parentCategories($items["categories"]);
        if($par_cat == 1){
          $cat_code = 'tyres';
        }elseif($par_cat == 2){
          $cat_code = 'disk';
        }else{
          $cat_code = $items['code_cat'];
        }
        //$cat_code = selectCatCode($items["categories"]);
        $data .= '<url>' . "\r\n";
        $data .= '<loc>' . $site . $cat_code . '/' . $items["code"] . '-' . $items["id"] . '.html</loc>' . "\r\n";
        $data .= '<lastmod>' . date("Y-m-d", strtotime($items["date"])) . '</lastmod>' . "\r\n";
        $data .= '</url>' . "\r\n";
      }
      $data .= '</urlset>';
      saveFileSitemap($fileName, $data, $cat = '/sitemap');
    }
  }

  $data = '<?xml version="1.0" encoding="UTF-8"?>
	<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">'."\r\n";
  foreach ($sCat as $cat){
    if(sProdCat($cat['id']) > 0) {
      $data .= '<url>' . "\r\n";
      $data .= '<loc>' . $site . $cat["code"] . '/</loc>' . "\r\n";
      //$data .= '<lastmod>'.$current_date2.'</lastmod>'."\r\n";
      $data .= '</url>' . "\r\n";
    }
  }
  $data .= '</urlset>';

  saveFileSitemap('categories.xml', $data, $cat='/sitemap');
}


$sBlog = db2array("SELECT id, code, `date` FROM blog WHERE date_active < '$current_date' ORDER BY `date_active` DESC", 2);
if($sBlog){
  $fileName = 'news.xml';
  $s_map .= '
	<sitemap>
    <loc>'.$site.'sitemap/'.$fileName.'</loc>
    <lastmod>'.$current_date2.'</lastmod>
	</sitemap>'."\r\n";

  $data = '<?xml version="1.0" encoding="UTF-8"?>
	<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">'."\r\n";
  foreach ($sBlog as $blog){
    $data .= '<url>'."\r\n";
    $data .= '<loc>'.$site.'news/'.$blog["code"].'-'.$blog["id"].'.html</loc>'."\r\n";
    $data .= '<lastmod>'.date("Y-m-d", strtotime($blog["date"])).'</lastmod>'."\r\n";
    $data .= '</url>'."\r\n";
  }
  $data .= '</urlset>';

  saveFileSitemap($fileName, $data, $cat='/sitemap');
}


/*echo"<pre>".print_r()."</pre>";*/
$s_map .= '</sitemapindex>';

saveFileSitemap('sitemap.xml', $s_map);
echo "<pre>".$s_map."</pre>";