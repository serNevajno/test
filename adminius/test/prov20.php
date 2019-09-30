<?
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php');
/////Подключение библиотеки
include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/function.inc.php');

/////Замок
include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/lock.inc.php');

//file_put_contents('prov20.xml', file_get_contents("http://cabinet.tochka-market.ru/catalog.xml"));
$arr = simplexml_load_file("prov20.xml");
//echo "<pre>".print_r($arr, true)."</pre>";
$yes =0;
$no = 0;
$n =0;
foreach ($arr->product as $item){
    if($item->type == "tire") {
        $temp = db2array("SELECT id FROM product WHERE article='$item->articleexternal'");
        //echo "SELECT id FROM product WHERE article='$item->article'";
        if($item->articleexternal == ""){
            $n++;
        }
        if($temp["id"]>0){
            $yes++;
        }else{
            $secID = checkCategoriesProduct($item->brand, $item->model);
            if($secID){
                $idFil = db2array("SELECT t2.element_value FROM `product` as t1 LEFT JOIN `filter_value` as t2 on(t1.id=t2.id_product) WHERE t1.categories='$secID' AND t2.id_filter='24' LIMIT 1");
            }

            $no++;
        }
    }
}
echo $yes." ".$no." ".$n;
?>