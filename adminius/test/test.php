<?
error_reporting(0);
session_start();
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/function.inc.php');
//include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/uploadProduct/upFunc.inc.php');
//include ($_SERVER['DOCUMENT_ROOT'].'/inc/apiFunc.inc.php');


/*echo chekcArticleProduct('F8207-P', '1');//F8207-P
echo "lsl";*/

/*$num = 20;
$page = rand(1, 500);
global $posts;
global $start;

$posts = selectCount("`categories` as t1 LEFT JOIN categories as t2 on(t1.id=t2.section) LEFT JOIN product as t3 on(t3.categories=t2.id) WHERE t1.section='2' AND t3.img='' AND t3.test_img='0'");
$start = strNav($page, $num, $posts);

$temp = db2array("SELECT t3.article FROM `categories` as t1 LEFT JOIN categories as t2 on(t1.id=t2.section) LEFT JOIN product as t3 on(t3.categories=t2.id) WHERE t1.section='2' AND t3.img='' AND t3.test_img='0' ORDER BY t3.id DESC LIMIT $start, $num", 2);
$article = array();
$r=0;
foreach ($temp as $item) {
    $article[] = $item["article"];
    mysql_query("UPDATE `product` SET test_img='1' WHERE article='$item[article]'");
}
    $client = new SoapClient(SOAP_CLIENT);
    $params = array
    (
        'login' => SOAP_LOGIN,
        'password' => SOAP_PASS,
        'code_list' => $article
    );

    $answer = $client->GetGoodsInfo($params);
    echo "<pre>";
    print_r($answer);
    echo "</pre>";
    foreach ($answer->GetGoodsInfoResult->rimList->RimContainer as $item){
        $img_api = $item->img_big_pish;
        $img_name = $item->name;
        if ($img_api) {
           $link = "http://" . $_SERVER['HTTP_HOST'] . "/scripts/phpThumb/phpThumb.php?src=" . $img_api . "&fltr[]=wmi|/images/watermark.png|85x200|100|170|120|0";
           $file = file_get_contents($link);
           $img_name = greateLink($img_name);
           $img = $img_name . ".png";
           file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/images/product_cover/" . $img, $file);
           mysql_query("UPDATE `product` SET img='$img' WHERE article='$item->code'");
           $r++;
        }
    }

echo $total;*/
/*$r=0;
$temp = db2array("SELECT t2.id FROM `categories` as t1 LEFT JOIN categories as t2 on(t1.id=t2.section) WHERE t1.section='2' AND t2.img='' ORDER BY t2.id DESC", 2);
///$temp = db2array("SELECT t3.img, t3.id FROM `categories` as t3 WHERE t3.img!='' ORDER BY t3.id DESC", 2);

foreach ($temp as $item){
    $img = db2array("SELECT img FROM `product` WHERE img!='' AND categories='$item[id]' LIMIT 1");
    if($img){
        if (copy($_SERVER['DOCUMENT_ROOT'] ."/images/product_cover/".$img["img"],$_SERVER['DOCUMENT_ROOT'] ."/images/categories_cover/".$img["img"])) {
            mysql_query("UPDATE `categories` SET `img`='$img[img]' WHERE id='$item[id]'");
        }else{
            $r++;
        }
    }
    if(file_exists($_SERVER['DOCUMENT_ROOT'] ."/images/categories_cover/".$item["img"])){

    }else{
        $r++;
        mysql_query("UPDATE `categories` SET `img`='' WHERE id='$item[id]'");
    }
}
echo $r;*/
$arr = array();
$arrCat = recusiveCatSection('1');
$query_search.="t1.categories IN (";
$n = 1;
$zp="";
$id="";

foreach ($arrCat as $iCat){
  if($n>1) $zp=", ";
  $query_search.= $zp.$iCat;
  $id.= $zp.$iCat;
  $n++;
}
$arrCat = recusiveCatSection('2');
$n = 1;
$zp="";
$id="";

foreach ($arrCat as $iCat){
  $zp=", ";
  $query_search.= $zp.$iCat;
  $id.= $zp.$iCat;
  $n++;
}
$query_search.= ")";

$posts = db2array("SELECT t1.* FROM product as t1 WHERE $query_search AND (SELECT COUNT(*) FROM price_provider WHERE id_product=t1.id AND id_provider=t1.provider)=0 AND t1.price>0", 2);

foreach($posts as $item){
  ///mysql_query("UPDATE `product` SET price='0', price_clear='0', logistic='0', provider='0', availability='0' WHERE id='$item[id]'");
  //echo "UPDATE `product` SET price='0', price_clear='0', logistic='0', provider='0', availability='0' WHERE id='$item[id]'"."<br>";
}
/*echo "<pre>";
print_r($posts);
echo "</pre>";*/
?>

