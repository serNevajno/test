<?php
///Вывод с базы и переобразование в массив
function db2array($sql, $m = 1)
{
    $result = mysql_query($sql);
    switch ($m) {
        case 1:
            $arr = mysql_fetch_assoc($result);
            return $arr;
        case 2:
            $arr = array();
            while ($row = @mysql_fetch_assoc($result)) {
                $arr[] = $row;
            }
            return $arr;
    }
}

function settingsSite()
{
    return db2array("SELECT * FROM settings");
}

function selectSessionAdmin()
{
    $temp = db2array("SELECT COUNT(*) FROM admin_user WHERE sid='" . session_id() . "'");
    return ($temp["COUNT(*)"] > 0) ? TRUE : FALSE;
}

////Проверяем если такая сессия
function selectSession() {
    $temp = db2array("SELECT COUNT(*) FROM user_session WHERE sid='".session_id()."'");
    if($temp["COUNT(*)"]>0) {
        $date = date("Y-m-d H:i:s");
        mysql_query("UPDATE users SET last_date='$date' WHERE id=(SELECT id_user FROM user_session WHERE sid='".session_id()."')");
    }
    return ($temp["COUNT(*)"]>0) ? TRUE : FALSE;
}

/////Вывод юзера
function selectUser($email) {
    return db2array("SELECT id, password, name, active FROM users WHERE email='$email'");
}

function selectUserID() {
    return db2array("SELECT id, name, email, id_country, phone, sex, date_birth, address, city, `date`, info FROM users WHERE id=(SELECT id_user FROM user_session WHERE sid='".session_id()."')");

}

////Фильтрация даных
function clearData($data, $type = "s")
{
    switch ($type) {
        case "s":
            return mysql_real_escape_string(htmlspecialchars(trim(strip_tags($data))));
        case "i":
            return (int)$data;
    }
}

////Вывод слайдера на главной
function slideMain()
{
    return db2array("SELECT * FROM slider WHERE active='1' AND type='1' ORDER BY priority DESC LIMIT 4", 2);
}

///Вывод из базы мета тегов разделов
function selectMeta($code){
    return db2array("SELECT t1.id, t1.meta_k, t1.meta_d, t1.title, t1.h1, t1.img, t1.code, t1.name, t1.descriptions, t1.date, t1.section, t1.img FROM section as t1
		WHERE code='$code'");
}

function selectSectionByCode($code){
    return db2array("SELECT t1.id, t1.code, t1.name, t1.date, t2.name as name_section FROM section as t1 LEFT JOIN section as t2 on(t1.section=t2.id) WHERE t2.code='$code'", 2);
}

function selectNewsOnMenu(){
    $date = date("Y-m-d H:i:s");
    return db2array("SELECT id, name, date, code, img, description FROM blog WHERE active='1' AND date_active<='$date' ORDER BY date DESC LIMIT 6", 2);
}

function selectNewsOnMain(){
    $date = date("Y-m-d H:i:s");
    return db2array("SELECT id, name, date, code, img, description FROM blog WHERE active='1' AND date_active<='$date' ORDER BY date DESC LIMIT 3", 2);
}

function selectNewsRightCol(){
    $date = date("Y-m-d H:i:s");
    return db2array("SELECT id, name, date, code, img, description FROM blog WHERE active='1' AND date_active<='$date' AND cat='1' ORDER BY view DESC LIMIT 3", 2);
}

function selectNewsRand($id_news){
    $date = date("Y-m-d H:i:s");
    return db2array("SELECT id, name, date, code, img, description FROM blog WHERE active='1' AND date_active<='$date' AND cat='1' AND id!='$id_news' ORDER BY RAND() DESC LIMIT 3", 2);
}

function selectNewsById($id)
{
    $date = date("Y-m-d H:i:s");
    return db2array("SELECT id, name, code, title, meta_d, meta_k, description, text, date, img, view FROM blog WHERE active='1' AND date_active<='$date' AND id='$id' AND cat='1'");
}

function selectStockRightCol(){
    $date = date("Y-m-d H:i:s");
    return db2array("SELECT id, name, date, code, img, description FROM blog WHERE active='1' AND date_active<='$date' AND cat='2' ORDER BY date DESC LIMIT 3", 2);
}

function selectSectionOnMenu(){
    return db2array("SELECT id, name, code, section, meta_d FROM section WHERE menu='1' ORDER BY priority DESC", 2);
}

function strPage($page){
    if($_GET["categories_code"] OR $_POST["code"]){
        $url = "javascript:selectProduct(".$page.");";
    }elseif($_GET["code"] == "news" or $_POST["section_code"] == "news"){
        $url = "javascript:selectNews(".$page.");";
    }elseif($_POST["cat"] == "tyres"){
        $url = "javascript:searchTyres(".$page.");";
    }elseif($_POST["cat"] == "disk"){
        $url = "javascript:searchTyres(".$page.");";
    }else{
        $url = "javascript:selectOrders(".$page.");";
    }
    return $url;
}

///Количество елементов
function selectCount($from){
    $temp = db2array("SELECT COUNT(*) FROM $from");
    return $temp["COUNT(*)"];
}

///Постраничная навигация
function strNav($page, $num, $posts){
    global $total;
    global $page;

    // Находим общее число страниц
    $total = (($posts - 1) / $num) + 1;
    $total = intval($total);
    // Определяем начало сообщений для текущей страницы
    $page = intval($page);
    // Если значение $page меньше единицы или отрицательно
    // переходим на первую страницу
    // А если слишком большое, то переходим на последнюю
    if (empty($page) or $page < 0) $page = 1;
    if ($page > $total) $page = $total;
    // Вычисляем начиная с какого номера
    // следует выводить сообщения
    $start = $page * $num - $num;
    // Выбираем $num сообщений начиная с номера $start

    // Проверяем нужны ли стрелки назад
    if ($page != 1) $GLOBALS['pervpage'] = '<li><a href="'.strPage(1).'" aria-label="Previous"><span aria-hidden="true"><i class="fa fa-chevron-left"></i></span></a></li>';
    // Проверяем нужны ли стрелки вперед
    if ($page != $total) $GLOBALS['nextpage'] = '<li><a href="'.strPage($page + 1).'" aria-label="Next"><span aria-hidden="true"><i class="fa fa-chevron-right"></i></span></a></li>';

    // Находим две ближайшие станицы с обоих краев, если они есть
    if ($page - 5 > 0) $GLOBALS['page5left'] = ' <li><a href="' . strPage($page - 5) . '">' . ($page - 5) . '</a></li>';
    if ($page - 4 > 0) $GLOBALS['page4left'] = ' <li><a href="' . strPage($page - 4) . '">' . ($page - 4) . '</a></li>';
    if ($page - 3 > 0) $GLOBALS['page3left'] = ' <li><a href="' . strPage($page - 3) . '">' . ($page - 3) . '</a></li>';
    if ($page - 2 > 0) $GLOBALS['page2left'] = ' <li><a href="' . strPage($page - 2) . '">' . ($page - 2) . '</a></li>';
    if ($page - 1 > 0) $GLOBALS['page1left'] = ' <li><a href="' . strPage($page - 1) . '">' . ($page - 1) . '</a></li>';

    if ($page + 5 <= $total) $GLOBALS['page5right'] = '<li><a href="' . strPage($page + 5) . '">' . ($page + 5) . '</a></li>';
    if ($page + 4 <= $total) $GLOBALS['page4right'] = '<li><a href="' . strPage($page + 4) . '">' . ($page + 4) . '</a></li>';
    if ($page + 3 <= $total) $GLOBALS['page3right'] = '<li><a href="' . strPage($page + 3) . '">' . ($page + 3) . '</a></li>';
    if ($page + 2 <= $total) $GLOBALS['page2right'] = '<li><a href="' . strPage($page + 2) . '">' . ($page + 2) . '</a></li>';
    if ($page + 1 <= $total) $GLOBALS['page1right'] = '<li><a href="' . strPage($page + 1) . '">' . ($page + 1) . '</a></li>';
    return $start;
}

function selectBlog($cat, $page){
    global $posts;
    global $start;
    $num = 5;
    $date = date("Y-m-d H:i:s");

    $posts = selectCount("blog WHERE active='1' AND date_active<='$date' AND cat='$cat'");
    $start = strNav($page, $num, $posts);

    return db2array("SELECT id, name, code, description, date, img, view FROM blog WHERE active='1' AND date_active<='$date' AND cat='$cat' ORDER BY date DESC LIMIT $start, $num", 2);
}

function breadcrumb($code, $id){
    if ($code == "news") {
        if ($id > 0) {
            $vuv = '<li><a href="/news.html">Новини</a></li>';
            $temp = db2array("SELECT  name FROM blog WHERE id='$id'");
            $vuv .= '<li class="active">' . $temp["name"] . '</li>';
        } else {
            $vuv = '<li class="active">Новини</li>';
        }
    } else {
        $temp = db2array("SELECT id, name, section, code FROM section WHERE code='$code'");
        if ($temp["section"] > 0) {
            $temp_s = db2array("SELECT id, name, section, code FROM section WHERE id='$temp[section]'");
            $vuv = '<li><a href="/' . $temp_s["code"] . '.html">' . $temp_s["name"] . '</a></li>';
            $vuv .= '<li class="active">' . $temp["name"] . '</li>';

        } else {
            $vuv = '<li class="active">' . $temp["name"] . '</li>';
        }
    }
    echo $vuv;
}

function greateNameImg($str)
{
    $str = mb_convert_case($str, MB_CASE_LOWER, "UTF-8");
    $str = trim($str);
    $tr = array(
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'ts', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch', 'ъ' => 'y', 'ы' => 'y', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
        'ї' => 'i', 'є' => 'e', ' ' => '-', '+' => '-plus-', 'è' => 'e', 'ù' => 'u'
    );
    $str = strtr($str, $tr);
    $str = preg_replace("/-+/", '-', $str);
    $str = preg_replace("/[^a-z-.]/", "", $str);
    return substr($str, 0, 70);
}



function selectSectioName($id){
    $temp = db2array("SELECT name FROM section WHERE id='$id'");
    return $temp["name"];
}

function selectLastNews(){
    $date = date("Y-m-d H:i:s");
    return db2array("SELECT id, name, code, date FROM blog WHERE active='1' AND date_active<='$date' ORDER BY date DESC LIMIT 5", 2);
}

/// Количество поделившихся в соц сети
function facebook_like_share_count($url)
{
    $api = file_get_contents('http://graph.facebook.com/?id=' . $url);
    $count = json_decode($api);
    return $count->shares;
}

function google_like_share_count($url)
{
    $google_request = file_get_contents('https://plusone.google.com/u/0/_/+1/fastbutton?count=true&url=' . $url);
    $plusone_count = preg_replace('/(.*)<div id="aggregateCount" class="Oy">(([0-9])*)<\/div>(.*)/is', '$2', $google_request);
    return $plusone_count;
}

/// вывод определенного кол-ва символов не обрезая слова
function cut_paragraph($string, $ctn)
{
    $string = substr($string, 0, $ctn + 1);
    if (strlen($string) > $ctn) {
        $string = wordwrap($string, $ctn);
        $i = strpos($string, "\n");
        if ($i) {
            $string = substr($string, 0, $i);
        }
    }
    return $string;
}

function selectSocial(){
    return db2array("SELECT name_social, url_social FROM social_network", 2);
}

function selectImgGalleryID($id)
{
    $temp = db2array("SELECT img FROM photo WHERE id_photogallary='$id' ORDER BY id ASC LIMIT 1");
    return $temp["img"];
}

function selectPhoto($page)
{
    global $posts;
    global $start;
    $num = 40;
    $date = date("Y-m-d H:i:s");

    $posts = selectCount("photo");
    $start = strNav($page, $num, $posts);

    return db2array("SELECT id, text, img FROM photo ORDER BY priority DESC LIMIT $start, $num", 2);
}

function selectMainPhoto($ctn)
{
    return db2array("SELECT id, text, img FROM photo ORDER BY priority DESC LIMIT $ctn", 2);
}

function selectFeedback()
{
    return db2array("SELECT id, text, name, img, company FROM feedback ORDER BY priority DESC, date DESC LIMIT 5", 2);
}

function dateformat($date)
{
    switch (date("m", strtotime($date))) {
        case 1:
            $month = "Январь";
            break;
        case 2:
            $month = "Февраль";
            break;
        case 3:
            $month = "Март";
            break;
        case 4:
            $month = "Апрель";
            break;
        case 5:
            $month = "Май";
            break;
        case 6:
            $month = "Июнь";
            break;
        case 7:
            $month = "Июль";
            break;
        case 8:
            $month = "Август";
            break;
        case 9:
            $month = "Сентябрь";
            break;
        case 10:
            $month = "Октябрь";
            break;
        case 11:
            $month = "Ноябрь";
            break;
        case 12:
            $month = "Декабрь";
            break;

    }
    return date("d", strtotime($date)) . " " . $month . ", " . date("Y", strtotime($date));
}

function newViewBlog($view, $id)
{
    $new_view = $view + 1;
    mysql_query("UPDATE blog SET view='$new_view' WHERE id='$id'");
}

function newViewProduct($view, $id)
{
    $new_view = $view + 1;
    mysql_query("UPDATE product SET view='$new_view' WHERE id='$id'");
}
function selectSearch($query, $page)
{
    global $posts;
    global $start;
    $num = 9;
    $date = date("Y-m-d H:i:s");

    $query = clearData($query);

    $posts = selectCount("blog WHERE active='1' AND date_active<='$date' AND (name LIKE '%$query%' or description LIKE '%$query%')");
    $start = strNav($page, $num, $posts);

    $temp = db2array("SELECT id, name, code, description, cat, date FROM blog WHERE active='1' AND date_active<='$date' AND (name LIKE '%$query%' or description LIKE '%$query%') ORDER BY date DESC LIMIT $start, $num", 2);

    $arr = array();

    foreach ($temp as $item) {
        if ($item["cat"] == "1") {
            $code = "news";
        } elseif ($item["cat"] == "2") {
            $code = "stock";
        }
        $arr[] = array(
            "name" => $item["name"],
            "description" => $item["description"],
            "date" => $item["date"],
            "url" => $code . "/" . $item["code"] . "-" . $item["id"] . ".html"
        );
    }

    $posts_s = selectCount("section WHERE section='50' AND (name LIKE '%$query%' or descriptions LIKE '%$query%')");
    $start_s = strNav($page, $num, $posts_s);

    $temp_s = db2array("SELECT id, name, code, section, descriptions FROM section WHERE section='50' AND (name LIKE '%$query%' or descriptions LIKE '%$query%') ORDER BY date DESC LIMIT $start_s, $num", 2);

    foreach ($temp_s as $item) {
        $arr[] = array(
            "name" => $item["name"],
            "description" => $item["descriptions"],
            "date" => $item["date"],
            "url" => $item["code"] . "/"
        );
    }
    return $arr;
}

function cutText($string, $ctn)
{
    $string = strip_tags($string);
    $string = substr($string, 0, $ctn);
    $string = rtrim($string, "!,.-");
    $string = substr($string, 0, strrpos($string, ' '));
    echo $string . " …";
}
function selectCategoriesOnMenu($section=0){
    return db2array("SELECT id, name, code FROM categories WHERE section='$section' AND active='1' ORDER BY priority DESC", 2);
}
function selectMetaCategories($code){
    return db2array("SELECT id, meta_k, meta_d, title, h1, code, name, descriptions, section FROM categories WHERE code='$code' AND active='1'");
}
function sort_nested_arrays($array, $args){
    usort( $array, function( $a, $b ) use ( $args ){
        $res = 0;

        $a = (object) $a;
        $b = (object) $b;

        foreach( $args as $k => $v ){
            if( $a->$k == $b->$k ) continue;

            $res = ( $a->$k < $b->$k ) ? -1 : 1;
            if( $v=='desc' ) $res= -$res;
            break;
        }

        return $res;
    } );

    return $array;
}
function selectValueFilter($id_filter){
    $arr = db2array("SELECT id, value FROM `element_filter` WHERE id_filter='$id_filter' ORDER BY value ASC", 2);
    return sort_nested_arrays($arr, array('value' => 'ASC'));
}
function selectFilterValue($id_filter){
  $arr = db2array("SELECT element_value FROM `filter_value` WHERE `id_filter` = '$id_filter' GROUP BY `element_value` ORDER BY `element_value` ASC", 2);
  //return sort_nested_arrays($arr, array('value' => 'ASC'));
  return $arr;
}
function selectTyresWidth(){
    return db2array("SELECT id, name FROM tyres_width", 2);
}
function selectTyresHeight(){
    return db2array("SELECT id, name FROM tyres_height", 2);
}
function selectTyresDiameter(){
    return db2array("SELECT id, name FROM tyres_diameter", 2);
}

function selectDiskDiameter(){
    return db2array("SELECT id, name FROM disk_diameter", 2);
}

function selectTyresBrand(){
    //return db2array("SELECT id, name FROM tyres_brand", 2);
    return db2array("SELECT id, name, code FROM categories WHERE section='1' AND active='1' ORDER BY name ASC", 2);
}
function selectDiskWidth(){
    return db2array("SELECT id, name FROM disk_width", 2);
}
function selectPcd(){
    return db2array("SELECT id, name FROM disk_pcd", 2);
}
function selectDiskBrand(){
    //return db2array("SELECT id, name FROM disk_brand", 2);
    return db2array("SELECT id, name, code FROM categories WHERE section='2' AND active='1' ORDER BY name ASC", 2);
}
function priceApi($price){
    return ceil($price/10) * 10;
}

function selectBasket(){
    $temp = db2array("SELECT t1.id, t1.name, t1.quantity, t1.product_id, t1.categories, t1.code, t2.name as name_product, t2.price as price_product, t1.price, t1.img, t2.img as img_product, t2.code as product_code, t3.code as categories_code, t1.day, t2.sale, t1.price_clear, t2.provider FROM basket as t1 LEFT JOIN product as t2 on(t1.product_id=t2.id) LEFT JOIN categories as t3 on(t2.categories=t3.id) WHERE t1.customer='".session_id()."'", 2);
    $arr = array();
    foreach($temp as $i){
        if($i["product_id"] >0) {
            $name = $i["name_product"];
            $price = $i["price_product"] - (($i["price_product"] / 100) * $i["sale"]);
            if ($i["categories"] == "tyres" OR $i["categories"] == "disk") {
                $img = $i["img"];
                $url = "/" . $i["categories"] . "/" . $i["product_code"] . "-" . $i["product_id"] . ".html";
            }else{
                $img = "/images/product_cover/" . $i["img_product"];
                $url = "/" . $i["categories_code"] . "/" . $i["product_code"] . "-" . $i["product_id"] . ".html";
            }
        }else{
            $name = $i["name"];
            $price = $i["price"];
            $img = $i["img"];
            $url = "/".$i["categories"]."/".$i["code"].".html";
        }

        $arr[] = array(
            "id" => $i["id"],
            "quantity" => $i["quantity"],
            "name" => $name,
            "price" => $price,
            "img" => $img,
            "url" => $url,
            "code" => $i["code"],
            "product_id" => $i["product_id"],
            "categories" => $i["categories"],
            "day" => $i["day"],
            "sale" => $i["sale"],
            "price_clear" => $i["price_clear"],
            "provider" => $i["provider"]
        );
    }
    return $arr;
}
function sumBasket(){
    $temp = db2array("SELECT t1.price, t1.quantity, t2.price as price_prod, t2.sale FROM basket as t1 LEFT JOIN product as t2 on(t1.product_id=t2.id)WHERE t1.customer='".session_id()."'", 2);
    $sum = 0;
    foreach ($temp as $item) {
        if(empty($item["price_prod"])){
            $price = $item["price"];
        }else{
            $price = $item["price_prod"] - (($item["price_prod"] / 100)*$item["sale"]);
        }
        $sum += $price*$item["quantity"];
    }
    return $sum;
}

function checkEmail($email){
    $temp = db2array("SELECT COUNT(*) FROM users WHERE email='$email'");
    return $temp["COUNT(*)"];
}

function selectDataUser(){
    return db2array("SELECT t2.name, t2.phone, t2.address, t2.city FROM user_session as t1 LEFT JOIN users as t2 on(t1.id_user=t2.id) WHERE t1.sid='".session_id()."'");
}

function selectIdUser(){
    $temp = db2array("SELECT id_user FROM user_session WHERE sid='".session_id()."'");
    return $temp["id_user"];
}

function selectCountry(){
    return db2array("SELECT id, country FROM country", 2);
}

function selectProductList($code, $page=1){
    global $posts;
    global $start;
    $num = 10;

    $posts = selectCount("product as t1 LEFT JOIN categories as t2 on(t1.categories=t2.id) WHERE t1.active='1' AND t2.code='$code'");
    $start = strNav($page, $num, $posts);
    return db2array("SELECT t1.name, t1.img, t1.price, t1.code, t1.availability, t1.categories, t1.article, t2.code as cat_code, t1.id, t1.avg, t1.sale, t1.attention, t1.logistic, t2.img as cat_img, t2.id as id_cat, t1.provider FROM product as t1 LEFT JOIN categories as t2 on(t1.categories=t2.id) WHERE t1.active='1' AND t2.code='$code' ORDER BY date DESC LIMIT $start, $num", 2);/////////////AND t1.availability>0
}

function selectOrders($page){
    global $posts;
    global $start;
    $num = 10;

    $posts = selectCount("orders WHERE id_user=(SELECT id_user FROM user_session WHERE sid='".session_id()."')");
    $start = strNav($page, $num, $posts);

    return db2array("SELECT t1.id, t1.date, t3.name, t3.code, t2.price FROM orders as t1 LEFT JOIN order_product as t2 on(t1.id = t2.id_order) LEFT JOIN status as t3 on (t1.id_status = t3.id) WHERE t1.id_user=(SELECT id_user FROM user_session WHERE sid='".session_id()."') GROUP BY t1.id ORDER BY date DESC LIMIT $start, $num",2);
}

function selectOrderById($id){
    return db2array("SELECT t1.date, t1.id_user, t2.name as status_name, t2.code FROM orders as t1  LEFT JOIN status as t2 on (t1.id_status = t2.id) WHERE t1.id='$id'");
}

function selectOrderProductById($id){
    $temp = db2array("SELECT t1.price, t1.name, t1.quantity, t1.categories, t1.code, t2.code as product_code, t3.code as categories_code, t1.product_id, t1.sale FROM order_product as t1 LEFT JOIN product as t2 on(t1.product_id=t2.id) LEFT JOIN categories as t3 on(t2.categories=t3.id) WHERE id_order='$id'", 2);

    $arr = array();
    foreach($temp as $i){
        if($i["product_id"] >0){
            $url = "/".$i["categories_code"]."/".$i["product_code"]."-".$i["product_id"].".html";
        }else{
            $url = "/".$i["categories"]."/".$i["code"].".html";
        }

        $arr[] = array(
            "id" => $i["id"],
            "quantity" => $i["quantity"],
            "name" => $i["name"],
            "price" => $i["price"],
            "url" => $url,
            "code" => $i["code"],
            "product_id" => $i["product_id"],
            "categories" => $i["categories"],
            "sale" => $i["sale"],
        );
    }
    return $arr;
}

function selectSummOrderById($id){
    $temp = db2array("SELECT price, quantity FROM order_product WHERE id_order='$id'", 2);

    $sum = 0;

    foreach($temp as $item) {
        $sum+=$item["price"]*$item["quantity"];
    }
    return $sum;
}

function checkSection($id) {
    $temp = db2array("SELECT COUNT(*) FROM categories WHERE section=$id");
    return $temp["COUNT(*)"];
}

function selectFilter($code) {
    $temp = db2array("SELECT t1.id, t1.name, t1.type, t1.categories FROM filter as t1 LEFT JOIN categories as t2 on (t1.categories=t2.id) WHERE t2.code='$code' ORDER BY t1.priority DESC", 2);
    if($temp){
        return $temp;
    }else{
        return db2array("SELECT t1.id, t1.name, t1.type, t1.categories FROM filter as t1 LEFT JOIN categories as t2 on (t1.categories=t2.section) WHERE t2.code='$code' ORDER BY t1.priority DESC", 2);
    }
}

function selectElementFilter($id_filter, $cat){
    return db2array("SELECT id, value,(SELECT COUNT(DISTINCT t1.id_product) FROM filter_value as t1 LEFT JOIN filter as t2 on(t1.id_filter =t2.id) WHERE element_value =t3.id and t2.categories=$cat and t1.id_filter='$id_filter') as count_el FROM element_filter as t3 WHERE id_filter='$id_filter'", 2);
}

function maxPrice($code){
    $temp = db2array("SELECT MAX(t1.price) as max_price FROM product as t1 LEFT JOIN categories as t2 on(t1.categories=t2.id) WHERE t2.code='$code'");
    return $temp["max_price"];
}

function selectCategoriesByCode($code){
    return db2array("SELECT t1.id, t1.code, t1.name, t2.name as name_section, t1.img FROM categories as t1 LEFT JOIN categories as t2 on(t1.section=t2.id) WHERE t2.code='$code' AND t1.active = '1'", 2);
}

function selectCategoriesByCode2($code, $wi="", $hei="", $dia=""){
  $filter = '';
  $join = '';

  if(!empty($wi)){
    $join .= "LEFT JOIN filter_value as t6 on(t3.id = t6.id_product)";
    $filter .= "AND t6.element_value = '$wi'";
  }
  if(!empty($hei)){
    $join .= "LEFT JOIN filter_value as t7 on(t3.id = t7.id_product)";
    $filter .= "AND t7.element_value = '$hei'";
  }
  if(!empty($dia)){
    $join .= "LEFT JOIN filter_value as t8 on(t3.id = t8.id_product)";
    $filter .= "AND t8.element_value = '$dia'";
  }

  return db2array("SELECT t1.id, t1.code, t1.name, t2.name as name_section, t1.img, t3.id as prod_id, t5.id as id_seeson, t5.value as seeson_name, t3.name as prod_name FROM categories as t1 
    LEFT JOIN categories as t2 on(t1.section=t2.id) 
    LEFT JOIN product as t3 on(t1.id = t3.categories) 
    LEFT JOIN filter_value as t4 on(t3.id = t4.id_product) 
    LEFT JOIN element_filter as t5 on(t5.id = t4.element_value) 
    $join
  WHERE t2.code='$code' AND t4.id_filter = '23' AND t3.availability>0 AND t1.active = '1' $filter GROUP BY t1.id", 2);
}

function selectnNameCategoriesByCode($id){
    $temp = db2array("SELECT name FROM categories WHERE id='$id'");
    return $temp["name"];
}
function selectProductById($id){
    return db2array("SELECT t1.id, t1.article, t1.meta_d, t1.meta_k, t1.title, t1.code, t1.name, t1.img, t1.categories, t1.price, t1.price_clear, t1.img, t3.descriptions, t1.attention, t1.sale, t1.youtube_url, t2.element_value, t1.rating, t1.avg, t3.section, t1.logistic, t1.related, t1.view, t3.img as cat_images, t1.availability, t1.provider, t1.description FROM product as t1 LEFT JOIN filter_value as t2 on (t1.id = t2.id_product) LEFT JOIN categories as t3 on(t1.categories=t3.id) WHERE t1.active='1' AND t1.id='$id'");
}

function selectGalleryImgById($id){
    return db2array("SELECT img FROM gallery WHERE id_product='$id'", 2);
}

function selectFilterValById($id){
    return db2array("SELECT t2.name, t3.value FROM filter_value as t1 
			LEFT JOIN filter as t2 on (t1.id_filter=t2.id) 
			LEFT JOIN element_filter as t3 on (t1.element_value=t3.id) 
		WHERE id_product='$id' ORDER BY t2.priority DESC", 2);
}

function ratingEcho($rating){
    $star ='';
    for ($x=0; $x<5; $x++){
        if($x<$rating){
            $star.='<li class="active"><i class="fa fa-star"></i></li>';
        }else{
            $star.='<li><i class="fa fa-star"></i></li>';
        }
    }
    return $star;
}

function ratingEchoFullProduct($rating, $id){
    $star ='';
    for ($x=0; $x<5; $x++){
        $addR = "addRating('".($x+1)."',".$id.")";
        if($x<$rating){
            $star.='<li class="active" onClick="'.$addR.'"><i class="fa fa-star"></i></li>';
        }else{
            $star.='<li onClick="'.$addR.'"><i class="fa fa-star"></i></li>';
        }
    }
    return $star;
}

function recusiveBreadcrumbs($section){
    if($section>0){
        $res = "";
        $temp = db2array("SELECT id, name, code, section FROM categories WHERE id='$section'");
        if($temp){
            recusiveBreadcrumbs($temp["section"]);
            echo  '<li class="home-act"><a href="/'.$temp["code"].'/">'.$temp["name"].'</a></li>';
        }
    }
}
function parentCategories($section){
    $temp = db2array("SELECT id, section FROM categories WHERE id='$section'");
    if($temp["section"]>0){
        $id  = parentCategories($temp["section"]);
    }else{
        $id = $temp["id"];
    }
    return $id;
}
function selectVoteAndAvgById($id){
    return db2array("SELECT vote, avg, rating FROM product WHERE id='$id'");
}

function selectBanner(){
    return db2array("SELECT title, descriptions, img, url, color FROM slider WHERE active='1' AND type='2' ORDER BY RAND()");
}

function selectProductMain(){
    return db2array("SELECT t1.img, t1.name, t1.price, t1.sale, t1.attention, t1.id, t1.code, t3.code as cat_code FROM product as t1 LEFT JOIN categories as t3 on(t1.categories=t3.id) WHERE t1.active='1' and t1.main='1'",2);
}

function selectRecommendProd($related){
    return db2array("SELECT t1.img, t1.name, t1.price, t1.sale, t1.attention, t1.id, t1.code, t1.avg, t3.code as cat_code FROM product as t1 LEFT JOIN categories as t3 on(t1.categories=t3.id) WHERE t1.active='1' AND t1.price>0 AND t1.availability>0 AND t1.id IN($related)",2);
}

function selectProductPopular(){
    return db2array("SELECT t1.img, t1.name, t1.price, t1.sale, t1.attention, t1.id, t1.code, t1.avg, t3.code as cat_code, t1.categories, t3.img as img_cat FROM product as t1 LEFT JOIN categories as t3 on(t1.categories=t3.id) WHERE t1.active='1' AND t1.price>0 AND t1.availability>0 ORDER BY t1.view DESC LIMIT 3",2);
}
function selectListMarkaAuto(){
    return db2array("SELECT vendor FROM tx_carmodels GROUP BY (vendor)",2);
}
function selectListMarkaAutoV2(){
  return db2array("SELECT vendor FROM search_by_vehicle GROUP BY (vendor)",2);
}
function selectListModelAuto($marka){
    return db2array("SELECT `model` FROM  `tx_carmodels` WHERE  `vendor` = '$marka' GROUP BY (model)",2);
}
function selectListModelAutoV2($marka){
  return db2array("SELECT car FROM  search_by_vehicle WHERE  `vendor` = '$marka' GROUP BY (car)",2);
}
function selectListYearAuto($marka, $model){
    return db2array("SELECT  `year` FROM  `tx_carmodels` WHERE  `vendor` = '$marka' and `model` = '$model' GROUP BY (year)",2);
}
function selectListYearAutoV2($marka, $model){
  return db2array("SELECT  `year` FROM  search_by_vehicle WHERE  `vendor` = '$marka' and car = '$model' GROUP BY (year)",2);
}
function selectListModificationAuto($marka, $model, $year){
    return db2array("SELECT  `modification` FROM  `tx_carmodels` WHERE  `vendor` = '$marka' and `model` = '$model' and  `year`='$year'",2);
}
function selectListModificationAutoV2($marka, $model, $year){
  return db2array("SELECT  `modification` FROM  search_by_vehicle WHERE  `vendor` = '$marka' and car = '$model' and  `year`='$year'",2);
}
function selectCatBrendTyres($s){
    return db2array("SELECT img, code, `name` FROM categories WHERE `section`='$s' AND `active`='1' ORDER BY name ASC", 2);
}

function selectProduct($id, $code, $sort, $price, $page){
    if ($sort == "по рейтингу") {
        $wr_sort = "pr.avg DESC";
    } elseif ($sort == "от дешевых к дорогим") {
        $wr_sort = "pr.price ASC";
    } elseif ($sort == "от дорогих к дешевым") {
        $wr_sort = "pr.price DESC";
    } elseif ($sort == "популярные") {
        $wr_sort = "pr.view DESC";
    } else {
        $wr_sort = "pr.date DESC";
    }

    if ($price) {
        $pr_ex = explode(" - ", $price);
        $price_min = (int)$pr_ex[0];
        $price_max = (int)$pr_ex[1];
        $wr_price = " AND pr.price<=$price_max";
        if($price_min > 0){
          $wr_price.= " AND pr.price>$price_min";
        }
    }
    $arr = array();

    $temp = db2array("SELECT id_filter, element_value FROM filter_value WHERE element_value IN ($id)", 2);
    if(($id AND $temp) OR (!$id AND !$temp)) {
      foreach ($temp as $item) {
        if (!in_array($item["element_value"], $arr[$item["id_filter"]])) {
          $arr[$item["id_filter"]][] .= $item["element_value"];
        }
      }

      $i = 1;
      foreach ($arr as $iArr) {
        if ($i == 1) {
          $table = " LEFT JOIN filter_value AS t1 ON (t1.id_product=pr.id)";
        } else {
          $table .= " LEFT JOIN filter_value AS t" . $i . " ON (t" . ($i - 1) . ".id_product = t" . $i . ".id_product)";
        }
        $wr .= " AND t" . $i . ".element_value IN (";
        $ii = 1;
        foreach ($iArr as $iArrP) {
          if ($ii > 1) {
            $wr .= ", ";
          }
          $wr .= $iArrP;
          $ii++;
        }
        $wr .= ")";
        $i++;
      }
      $num = 10;

      $posts_temp = db2array("SELECT COUNT(DISTINCT pr.id) FROM product as pr LEFT JOIN categories as cat ON(pr.categories=cat.id)$table WHERE pr.active='1' AND cat.code='$code'$wr_price$wr");
      $posts = $posts_temp["COUNT(DISTINCT pr.id)"];

      $start = strNav($page, $num, $posts);

      return db2array("SELECT pr.name, pr.img, pr.id, pr.code, pr.price, cat.id as cat_id, cat.img as cat_img, cat.code as cat_code, pr.rating, pr.sale, pr.attention, pr.logistic, pr.availability, pr.article, pr.provider 
                       FROM product as pr 
                       LEFT JOIN categories as cat ON(pr.categories=cat.id)$table 
                       WHERE pr.active='1' AND cat.code='$code'$wr_price$wr GROUP BY pr.id ORDER BY $wr_sort LIMIT $start, $num", 2);///AND pr.availability>0
    }
}

function selectCategorieCodeById($id){
    $temp = db2array("SELECT code FROM categories WHERE id='$id'");
    return $temp['code'];
}
function templatesTyresSite($code, $count, $img, $name, $season_icon, $thorn, $rest, $kol, $price, $n, $day, $id, $article, $provider){
    $func = "addBasket('".$id."', 'tyres', '".$n."')";
    $date = date('d.m.Y', strtotime('+'.countingDay($day).' days'));


    if($img AND file_exists($_SERVER['DOCUMENT_ROOT'].'/images/categories_cover/'.$img)){
      $img = '<a href="/tyres/'.$code.'-'.$id.'.html" class="product-img">
                <img src="/images/categories_cover/'.$img.'" alt="image" style="max-width:120px">
              </a>';
    }else{
      $img = '<img src="/images/noimg150.png" alt="'.$name.'" style="max-width:120px">';
    }

    return '<div class="product-item hover-img" style="text-align:left;">
            <div class="row">
                <div class="col-sm-12 col-md-2 col-lg-1" style="text-align:center;">
                    '.$img.'
                </div>
                <div class="col-sm-12 col-md-5 col-lg-5">
                    <div class="product-caption">
                        <h4 class="product-name" style="padding-top:0px;margin-top:0px;">
                            <a href="/tyres/'.$code.'-'.$id.'.html" class="f-16">'.$name.'</a>
                        </h4>
                    </div>
                    <ul class="static-caption m-t-lg-0">
                        '.$season_icon.$thorn.' 
                        <li class="f-13" title="Код: S'.$provider.'-'.$article.'">
                          <i class="fa fa-barcode"></i> S'.$provider.'-'.$article.'
                        </li>
                    </ul>
                </div>
                
                <div class="col-sm-12 col-md-5 col-lg-6" style="padding:0px;">
                <div class="col-sm-12 col-md-4 col-lg-4" style="text-align: center;">
                    <div class="form-group dop">
                        <div>
                            <b class="product-price">В наличии: '.$rest.'</b>
                        </div>
                        <i class="fa fa-plus mPlus" onClick="valPlus('.$n.', '.$kol.')"></i>
                        <input id="valInput'.$n.'" type="text" value="'.$count.'" class="form-control form-item fInput" readonly style="height: 35px; ">
                        <i class="fa fa-minus mMinus" onClick="valMinus('.$n.', '.$kol.')"></i>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3" style="padding: 0.6em 7px;text-align: center;">
                    <div style="font-weight: 500;">Цена 1шт: </div>
                    <b class="product-price" style="font-size:18px;">'.$price.' руб</b>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-5" style="text-align: center; padding: 0.6em 15px;">
                    <div style="color:#cb1010;float: left;">цена за 4 шт.:<br> 
                    <b class="product-price color-red">'.($price*4).' руб</b>
                    </div>
                    
                    <a onClick="'.$func.'" class="ht-btn ht-btn-default" style="margin:0px; cursor:pointer;" data-toggle="modal" data-target="#addBasket">Купить</a>
                </div>
                <div class="col-md-12" style="font-size:16px;margin-top:10px;color:##928f8f;font-weight: 400;text-align:center;"><i class="fa fa-truck"></i> Получение: самовывоз или доставка ('.$date.')</div>
                </div>
                
            </div>
        </div>';
}
function selectProductTyres($id, $code, $page){
    $arr = array();

    $temp = db2array("SELECT id_filter, element_value FROM filter_value WHERE element_value IN ($id)", 2);

    foreach($temp as $item){
        if(isset($arr[$item["id_filter"]])){
            if (!in_array($item["element_value"], $arr[$item["id_filter"]])){
                $arr[$item["id_filter"]][].=$item["element_value"];
            }
        }else{
            $arr[$item["id_filter"]][].=$item["element_value"];
        }
    }

    $i = 1;
    foreach($arr as $iArr){
        if($i == 1){
            $table=" LEFT JOIN filter_value AS t1 ON (t1.id_product=pr.id)";
        }else{
            $table.=" LEFT JOIN filter_value AS t".$i." ON (t".($i-1).".id_product = t".$i.".id_product)";
        }
        $wr.=" AND t".$i.".element_value IN (";
        $ii = 1;
        foreach($iArr as $iArrP){
            if($ii>1){
                $wr.=", ";
            }
            $wr.= $iArrP;
            $ii++;
        }
        $wr.=")";
        $i++;
    }
    $num = 20;
    if($code == "tyres"){
        $table_cat=" LEFT JOIN categories as cat2 on(cat.id=cat2.section) LEFT JOIN categories as cat3 on(cat2.id=cat3.section)";
        $ind = "3";
    }else{
        $table_cat=" LEFT JOIN categories as cat2 on(cat.id=cat2.section)";
        $ind = "2";
    }
    $posts_temp = db2array("SELECT COUNT(DISTINCT pr.id) FROM categories as cat$table_cat LEFT JOIN product as pr ON(pr.categories=cat$ind.id)$table WHERE pr.active='1' AND pr.availability>0 AND cat.code='$code'$wr_price$wr");
    $posts = $posts_temp["COUNT(DISTINCT pr.id)"];
    $start = strNav($page, $num, $posts);


    return db2array("SELECT pr.name, pr.id, pr.code, pr.price, pr.article, cat$ind.code as cat_code, cat$ind.img as cat_img, pr.rating, pr.sale, pr.attention, pr.id, pr.availability, pr.logistic, pr.provider   
                       FROM categories as cat$table_cat
                       LEFT JOIN product as pr ON(pr.categories=cat$ind.id)$table 
                       WHERE pr.active='1' AND pr.availability>0 AND cat.code='$code'$wr_price$wr GROUP BY pr.id ORDER BY pr.price ASC LIMIT $start, $num", 2);
}
function selectElementValueFilter($id_product, $id_filter){
    $temp = db2array("SELECT element_value FROM `filter_value` WHERE `id_filter`='$id_filter' AND `id_product`='$id_product'");
    return $temp["element_value"];
}
function selectProductDisk($id, $code, $et='', $dia='', $page){
    $arr = "";
    //$et = explode(" - ", $et);
    //$dia = explode(" - ", $dia);
    if($et == 'Все'){$et = '';}
    if($dia == 'Все'){$dia = '';}
    if($id){
        $temp = db2array("SELECT id_filter, element_value FROM filter_value WHERE element_value IN ($id)", 2);

        foreach($temp as $item){
            if(isset($arr[$item["id_filter"]])){
                if (!in_array($item["element_value"], $arr[$item["id_filter"]])){
                    $arr[$item["id_filter"]][].=$item["element_value"];
                }
            }else{
                $arr[$item["id_filter"]][].=$item["element_value"];
            }
        }

        $i = 1;
        foreach($arr as $iArr){
            if($i == 1){
                $table=" LEFT JOIN filter_value AS t1 ON (t1.id_product=pr.id)";
            }else{
                $table.=" LEFT JOIN filter_value AS t".$i." ON (t".($i-1).".id_product = t".$i.".id_product)";
            }
            $wr.=" AND t".$i.".element_value IN (";
            $ii = 1;
            foreach($iArr as $iArrP){
                if($ii>1){
                    $wr.=", ";
                }
                $wr.= $iArrP;
                $ii++;
            }
            $wr.=")";
            $i++;
        }
        $table.=" LEFT JOIN filter_value AS t".$i." ON (t".($i-1).".id_product = t".$i.".id_product)";
        //$wr.= " AND (t".$i.".id_filter='28' AND t".$i.".element_value>='".$et[0]."' AND t".$i.".element_value<='".$et[1]."')";
      if(!empty($et)) {
        $wr .= " AND (t" . $i . ".id_filter='28' AND t" . $i . ".element_value = '" . $et . "')";
      }

        $table.=" LEFT JOIN filter_value AS t".($i+1)." ON (t".$i.".id_product = t".($i+1).".id_product)";
        //$wr.= " AND (t".($i+1).".id_filter='29' AND t".($i+1).".element_value>='".$dia[0]."' AND t".($i+1).".element_value<='".$dia[1]."')";
      if(!empty($dia)) {
        $wr .= " AND (t" . ($i + 1) . ".id_filter='29' AND t" . ($i + 1) . ".element_value = '" . $dia . "')";
      }
    }else {
        $table .= " LEFT JOIN filter_value AS t1 ON (pr.id = t1.id_product)";
        //$wr .= " AND (t1.id_filter='28' AND t1.element_value>='" . $et[0] . "' AND t1.element_value<='" . $et[1] . "')";
      if(!empty($et)) {
        $wr .= " AND (t1.id_filter='28' AND t1.element_value = '" . $et . "')";
      }

        $table .= " LEFT JOIN filter_value AS t2 ON (t1.id_product = t2.id_product)";
        //$wr .= " AND (t2.id_filter='29' AND t2.element_value>='" . $dia[0] . "' AND t2.element_value<='" . $dia[1] . "')";
      if(!empty($dia)) {
        $wr .= " AND (t2.id_filter='29' AND t2.element_value = '" . $dia . "')";
      }
    }
    $num = 20;
    if($code == "disk"){
        $table_cat=" LEFT JOIN categories as cat2 on(cat.id=cat2.section) LEFT JOIN categories as cat3 on(cat2.id=cat3.section)";
        $ind = "3";
    }else{
        $table_cat=" LEFT JOIN categories as cat2 on(cat.id=cat2.section)";
        $ind = "2";
    }
    $posts_temp = db2array("SELECT COUNT(DISTINCT pr.id) FROM categories as cat$table_cat LEFT JOIN product as pr ON(pr.categories=cat$ind.id)$table WHERE pr.active='1' AND pr.availability>0 AND cat.code='$code'$wr_price$wr");
    $posts = $posts_temp["COUNT(DISTINCT pr.id)"];
    $start = strNav($page, $num, $posts);

    return db2array("SELECT pr.name, pr.id, pr.code, pr.price, pr.article, cat$ind.code as cat_code, cat$ind.img as cat_img, pr.rating, pr.sale, pr.attention, pr.id, pr.availability, pr.logistic, pr.provider 
                           FROM categories as cat$table_cat
                           LEFT JOIN product as pr ON(pr.categories=cat$ind.id)$table 
                           WHERE pr.active='1' AND pr.availability>0 AND cat.code='$code'$wr GROUP BY pr.id ORDER BY pr.price ASC LIMIT $start, $num", 2);
}
function templatesDiskSite($code, $count, $img, $name, $rest, $kol, $price, $n, $day, $id, $article, $provider){
    $func = "addBasket('".$id."', 'disk', '".$n."')";
    $date = date('d.m.Y', strtotime('+'.countingDay($day).' days'));

    $img_sing = selectImgDisk($id);
    if($img_sing AND file_exists($_SERVER['DOCUMENT_ROOT'].'/images/product_cover/'.$img_sing)){
        $img = '<a href="/disk/'.$code.'-'.$id.'.html" class="product-img">
                <img src="/images/product_cover/'.$img_sing.'" alt="image" style="max-width:120px">
              </a>';
    }else{
/*        if($img){
            $img = '<a href="/disk/'.$code.'-'.$id.'.html" class="product-img">
                <img src="/images/categories_cover/'.$img.'" alt="image" style="max-width:120px">
              </a>';
        }else{
            $img = '<img src="http://placehold.it/120x120?text=no image" alt="'.$name.'">';
        }*/
        $img = '<img src="/images/noimg150.png" alt="'.$name.'" style="max-width:120px">';
    }

    if($kol>=4){
        return $res.= '<div class="col-sm-6 col-md-4 col-lg-4 sizeDivDisk">
                <!-- Product item -->
                <div class="product-item hover-img">
                '.$img.'
                <div class="product-caption">
                <h4 class="product-name" style="height:64px;"><a href="/disk/'.$code.'-'.$id.'.html">'.$name.'</a></h4>
                <div class="col-sm-6" style="padding-right: 10px;padding-left: 10px;">
                <div style="padding-top:25px;">В наличии: '.$rest.'</div>
                <i class="fa fa-plus" onClick="valPlus('.$n.', '.$kol.')" style="cursor: pointer;"></i>
                <input id="valInput'.$n.'" class="form-item form-qtl" style="margin-top: 5px;" value="'.$count.'" type="text" readonly>
                <i class="fa fa-minus" onClick="valMinus('.$n.', '.$kol.')" style="cursor: pointer;"></i>
                <div style="font-size: 12px;"><b>Код: </b>S'.$provider.'-'.$article.'</div>
                </div>
                <div class="col-sm-6">
                <div class="product-price-group">
                <span class="product-price">'.$price.'.00 руб.</span>
                </div>
                <a onClick="'.$func.'" class="ht-btn ht-btn-default" style="cursor:pointer;" data-toggle="modal" data-target="#addBasket">Купить</a>
                <div class="row" style="font-size:12px;margin-top:10px;"><i class="fa fa-truck"></i> Получение: самовывоз или доставка ('.$date.')</div>
                </div>
                </div>
                </div>
                </div>';
    }
}
function selectProcentXml($id){
    $temp = db2array("SELECT procent FROM xml_provider WHERE id = '$id'");
    return $temp["procent"];
}
function selectFilterElementByValue($value, $id_filter){
    $temp = db2array("SELECT id FROM element_filter WHERE value='$value' AND id_filter='$id_filter'");
    return $temp["id"];
}

function selectFilterCat($id_cat){
    $temp = db2array("SELECT section FROM categories WHERE id = '$id_cat'");
    if($temp['section'] > 0){
        $id = selectFilterCat($temp['section']);
    }else{
        $id = $id_cat;
    }
    return $id;
}
function selectOffice(){
    return db2array("SELECT address, phone, email, maps, time_work, region, img FROM office_contact", 2);
}
function selectRegion(){
    return db2array("SELECT id, region FROM region", 2);
}
function selectOfficeByid($id){
    return db2array("SELECT id, address, phone, email, maps, time_work, id_city_kladr FROM office_contact WHERE id='$id'");
}
function sOfficeByidCityKladr($id){
  return db2array("SELECT id, address, phone, email, maps, time_work, id_city_kladr FROM office_contact WHERE id_city_kladr='$id'");
}

function sCityKladr($id){
  return db2array("SELECT city FROM cityKladr WHERE id_city='$id'");
}

function selectUserById($id) {
    return db2array("SELECT t1.name, t1.email, t1.phone, t1.active, t1.date, t1.city, t1.sex, t1.date_birth, t1.address, t1.note, t2.country FROM users as t1 LEFT JOIN country as t2 on(t1.id_country=t2.id) WHERE t1.id='$id'");
}
function sIdCityKladrOffice($id){
  return db2array("SELECT id_city_kladr, address FROM office_contact WHERE id='$id'");
}
function sumOrderReal($id){
    $temp = db2array("SELECT summ FROM orders WHERE id='$id'");
    if($temp["summ"]> 0){
        return $temp["summ"];
    }else{
        return selectSummOrderById($id);
    }
}
function sendSMS($phone, $text, $id_order){
    $phone = str_replace("+","", $phone);
    $phone = str_replace("(","", $phone);
    $phone = str_replace(")","", $phone);
    $phone = str_replace("-","", $phone);
    $phone = str_replace(" ","", $phone);
    $date = date("Y-m-d H:i:s");
    mysql_query("INSERT INTO sms (phone, text, id_order, date) VALUES ('$phone', '$text', '$id_order', '$date')") or die(mysql_error());
    $id = mysql_insert_id();
    $src = '<?xml version="1.0" encoding="UTF-8"?>
        <SMS>
            <operations>
                <operation>SEND</operation>
            </operations>
            <authentification>
                <username>dobroshina@yandex.ru</username>
                <password>11839586</password>
            </authentification>
            <message>
                <sender>Dobr.Shina</sender>
                <text>'.$text.'</text>
            </message>
            <numbers>
                <number messageID="'.$id.'">'.$phone.'</number>
            </numbers>
        </SMS>';

    $Curl = curl_init();
    $CurlOptions = array(
        CURLOPT_URL=>'http://api.atompark.com/members/sms/xml.php',
        CURLOPT_FOLLOWLOCATION=>false,
        CURLOPT_POST=>true,
        CURLOPT_HEADER=>false,
        CURLOPT_RETURNTRANSFER=>true,
        CURLOPT_CONNECTTIMEOUT=>15,
        CURLOPT_TIMEOUT=>100,
        CURLOPT_POSTFIELDS=>array('XML'=>$src),
    );
    curl_setopt_array($Curl, $CurlOptions);
    if(false === ($Result = curl_exec($Curl))) {
        throw new Exception('Http request failed');
    }

    curl_close($Curl);
}
function countingDay($day){
    $v = 1;
    for ($d = 1; $v <= $day; $d++) {
        $date = date('w', strtotime('+' . $d . ' days'));
        if($date != 0 AND $date != 6) {
            $v++;
        }
    }
    return $d-1;
}
function selectImgDisk($id){
    $temp = db2array("SELECT img FROM product WHERE id='$id'");
    return $temp["img"];
}

function greateLink($str) {
  $str = mb_convert_case($str, MB_CASE_LOWER, "UTF-8");
  $str = trim($str);
  $tr = array(
    'а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ж'=>'zh','з'=>'z','и'=>'i','й'=>'j','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r', 'с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h', 'ц'=>'ts','ч'=>'ch','ш'=>'sh','щ'=>'sch','ъ'=>'y', 'ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya',
    'ї'=>'i', 'і'=>'i','є'=>'e',' '=>'-','+'=>'-plus-','è'=>'e','ù'=>'u'
  );
  $str = strtr($str,$tr);
  $str = preg_replace("/-+/", '-', $str);
  $str = preg_replace ("/[^a-z0-9-]/","",$str);
  return substr($str, 0, 70);
}
function selectWeightTyres($width, $heigth, $diametr){
    if($width<40){
        $size = $width."x".$heigth."R".$diametr;
    }else{
        $size = $width."/".$heigth."R".$diametr;
    }
    return db2array("SELECT `scope_1`, `weight_1`, `scope_4`, `weight_4` FROM `weight_tyres` WHERE size='$size'");
}
function selectWeightDisk($diametr){
    return db2array("SELECT `scope_1`, `weight_1`, `scope_4`, `weight_4` FROM `weight_disk` WHERE size='$diametr'");
}

function selectWeigth($id){
    $tepm =  db2array("SELECT t1.id_filter, t3.value FROM filter_value as t1 
			LEFT JOIN filter as t2 on (t1.id_filter=t2.id) 
			LEFT JOIN element_filter as t3 on (t1.element_value=t3.id) 
		WHERE id_product='$id' ORDER BY t2.priority DESC", 2);

    foreach ($tepm as $item){
        if($item["id_filter"] == '19') $tWidth = $item["value"];
        if($item["id_filter"] == '20') $tDia = $item["value"];
        if($item["id_filter"] == '21') $tHeigth = $item["value"];
        if($item["id_filter"] == '25') $dDia = $item["value"];
    }
    if($tWidth AND $tDia AND $tHeigth) {
        return selectWeightTyres($tWidth, $tHeigth, $tDia);
    }elseif ($dDia>0){
        return selectWeightDisk($dDia);
    }

}

function selectCatCode($id){
  $id_parent = parentCategories($id);
  if ($id_parent != '1' AND $id_parent !='2'){
    $id_parent = $id;
  }
  $temp = db2array("SELECT code FROM categories WHERE id='$id_parent'");
  return $temp["code"];
}
function sNameCityKladr(){
    $id = $_COOKIE["id_city_kladr"];
    if ($id>0) {
        $temp = db2array("SELECT city FROM cityKladr WHERE id_city='$id'");
        return $temp['city'];
    }
}
function sRnCityKladr(){
    $id = $_COOKIE["id_city_kladr"];
    if ($id>0) {
        $temp = db2array("SELECT rn FROM cityKladr WHERE id_city='$id'");
        return $temp['rn'];
    }
}

function selectPEKID(){
    $name = sNameCityKladr();
    $rn = sRnCityKladr();
    $arr = explode("(", $name);
    $arr2 = explode(".", trim($arr[0]));
    $city = trim($arr2[1]);
    $id = "auto";
    $towns = file_get_contents('https://pecom.ru/ru/calc/towns.php');
    foreach (json_decode($towns) as $val){
        foreach ($val as $key => $item){
            if (($item != $city AND $item == $city . " (" . $rn . " р-н)") OR ($item == $city AND $item != $city . " (" . $rn . " р-н)")){
                $id = $key;
            }
        }
    }
    return $id;
}

function selectRegionKladr(){
    return db2array("SELECT id_kladr, name, type FROM region_kladr ORDER BY name ASC", 2);
}

function selectCategoriesByCodeV2($code){
    return db2array("SELECT t1.id, t1.code, t1.name, t2.name as name_section, t1.img, t1.descriptions FROM categories as t1 LEFT JOIN categories as t2 on(t1.section=t2.id) WHERE t1.code='$code'");
}
?>