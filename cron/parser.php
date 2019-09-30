<?php
//////Подключение к базе
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
/////Подключение библиотеки
include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');

function sNewsByTitle($title){
  $temp = db2array("SELECT title FROM blog WHERE title='$title'");
  return $temp['title'];
}

$cont = simplexml_load_file("http://shina.guide/press/feed/");
include "simple_html_dom.php";

$url = array();
foreach ($cont->channel->item as $item) {
  $url[] = $item->link;
}

$result = array();
foreach ($url as $val){
  $page = file_get_html($val);

  $images = '';
  $name_img = '';
  $path = '';
  foreach ($page->find('div .entry-content p a img') as $img){
    $images = $img->src;

    $ar = explode('/', $images);
    $name_img = end($ar);
  }
  foreach ($page->find('div .entry-content figure img') as $img){
    $images = $img->src;

    $ar = explode('/', $images);
    $name_img = end($ar);
  }

  $h1 = '';
  foreach ($page->find('h1') as $h){
    $h1 = $h->plaintext;
  }

  $txt = '';
  $des = '';
  $n = 0;
  foreach ($page->find('div .entry-content p') as $t){
    if($n == 1) {
      $des .= $t;
    }
    if($n != 1) {
      $txt .= $t;
    }
    $n++;}

  $txt = addslashes(strip_tags($txt, '<p>'));
  $txt .= '<p style="text-align: right;"><a href="https://shina.guide/" target="_blank">Источник shina.guide</a></p>';

  $des = addslashes(trim(strip_tags($des)));

  $result[] = array('title' => addslashes(trim($h1)), 'url_img'=>$images, 'img'=>$name_img, 'des'=>$des, 'text'=> $txt);
  $page->clear();
}

//echo "<pre>".print_r($result, true)."</pre>";

$date = date("Y-m-d H:i:s");
foreach (array_reverse($result) as $val){
  if(!sNewsByTitle($val['title'])){
    $file = file_get_contents($val['url_img']);
    file_put_contents($_SERVER['DOCUMENT_ROOT'].'/images/news/'.$val['img'], $file);

    $code = greateLink($val['title']);

    if(!empty($val[title])) {
      mysql_query("INSERT INTO `blog`(`title`, `meta_d`, `h1`, `name`, `description`, `text`, `date`, `img`, `active`, `code`, `date_active`, `cat`) VALUES ('$val[title]','$val[des]','$val[title]','$val[title]','$val[des]','$val[text]','$date','$val[img]',1,'$code','$date',1)") or die(mysql_error());
    }
  }
}

echo "ok";