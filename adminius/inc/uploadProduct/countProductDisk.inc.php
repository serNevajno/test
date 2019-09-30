<?if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php');
    /////Подключение библиотеки
    include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/function.inc.php');

    $arr = array();
    $arrCat = recusiveCatSection('2');
    $query_search.="categories IN (";
    $n = 1;
    $zp="";
    $id="";

    foreach ($arrCat as $iCat){
        if($n>1) $zp=", ";
        $query_search.= $zp.$iCat;
        $id.= $zp.$iCat;
        $n++;
    }

    $query_search.= ")";

    $posts = selectCount("product WHERE $query_search");

    $total = (($posts - 1) / 100) + 1;
    $arr["total_posts"] = $posts;
    $arr["total_page"] = intval($total);
    $arr["id_cat"] = $id;
    echo json_encode($arr);
}
?>