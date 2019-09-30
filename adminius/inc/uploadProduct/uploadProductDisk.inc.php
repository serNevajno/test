<?if ($_SERVER["REQUEST_METHOD"] == "POST") {
	error_reporting(0);
    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php');
    /////Подключение библиотеки
    include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/function.inc.php');
    include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/uploadProduct/upFunc.inc.php');
    include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/uploadProduct/apiKolesaDarom.php');
    /////Замок
    include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/lock.inc.php');

    $page = clearData($_POST["page"], "i");
    $total_posts = clearData($_POST["total_posts"], "i");
    $num = 100;

    $start = strNav($page, $num, $total_posts);

    $query_search.="t1.categories IN (".$_POST["id_cat"].")";

    $arrProduct = db2array("SELECT t1.id, t1.article, t3.name as brand FROM product as t1 LEFT JOIN categories as t2 on(t1.categories=t2.id) LEFT JOIN categories as t3 on(t2.section=t3.id) WHERE $query_search ORDER BY t1.id DESC LIMIT $start, $num",2);

    $article = array();
    $arrNewProd = array();
    foreach($arrProduct as $iProd){
        if(!empty($iProd["article"])){
            $article[] = $iProd["article"];

            $arrNewProd[$iProd["article"]] = array(
                "id" => $iProd["id"],
                "brand" => $iProd["brand"]
            );
        }
    }

    $result = kd::search("qqQSLo8byljcAPH6mJ7lc0KgFtL9NoFP", array("kod_proizvoditelya" => $article));
    $result = json_decode($result, true);

    if($result["status"] != '403') {
        foreach ($result as $item) {
          if($item[group] == 'Автодиски ') {
            $id = $arrNewProd[$item[kod_proizvoditelya]]["id"];
            $brand = $arrNewProd[$item[kod_proizvoditelya]]["brand"];

            $diameter = selectElementValueName($id, '25');

            $price = getPriceProvide("2", $brand, $diameter, "", $item["price"], "2");
            addProduct("2", "2", $item["kod_proizvoditelya"], $price, $item["price"], "3", $item["quantity"], "", "", "", "", "");
          }
        }
    }
    echo $page+1;
}
?>