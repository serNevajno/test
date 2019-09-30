<?php
///Вывод с базы и переобразование в массив
function db2array($sql, $m=1) {
    $result = mysql_query($sql);
    switch($m){
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
////Фильтрация даных
function clearData($data, $type="s") {
    switch ($type) {
        case "s":
            return mysql_real_escape_string(htmlspecialchars(trim(strip_tags($data))));
        case "h":
            return mysql_real_escape_string(htmlspecialchars(trim($data)));
        case "i":
            return (int)$data;
    }
}

////Вывод слайдер
include($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/funSelect/sSlider.inc.php');

////Вывод оффисов
include($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/funSelect/sOffice.inc.php');

////Вывод управления группами и админами
include($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/funSelect/sAdminGroup.inc.php');

////Узнаем какой пользователь
include($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/funSelect/sWhatUser.inc.php');

////Вывод категорий
include($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/funSelect/sSection.inc.php');

////Вывод блога
include($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/funSelect/sBlog.inc.php');


function selectTemplates(){
    return db2array("SELECT * FROM templates", 2);
}

////Проверяем если такая сессия
function selectSession() {
    $temp = db2array("SELECT COUNT(*) FROM admin_user WHERE sid='".session_id()."'");
    return ($temp["COUNT(*)"]>0) ? TRUE : FALSE;
}

////Записываем сессию в базу
function insertSessionAdmin($id_user, $remember) {
    if($remember == 1){
        $sid = session_id();
        $expire = time() + 7 * 24 * 3600;
        $domain = "dobrayashina.ru"; // default domain
        $secure = false;
        $path = "/";

        setcookie("sid", $sid, $expire, $path, $domain, $secure, true);
    }
    mysql_query("UPDATE admin_user SET sid='".session_id()."' WHERE id='$id_user'");
}
////Записываем сессию в базу
function insertSession($id_user) {
    $date = date("Y-m-d H:i:s");
    mysql_query("INSERT INTO user_session (id_user, sid, date) VALUES ('$id_user', '".session_id()."', '$date')");
}
///Запись логов
function addLogs($id_user, $actions, $element_id=0, $database=0) {
    $date = date("Y-m-d H:i:s");
    $ip = $_SERVER['REMOTE_ADDR'];
    mysql_query("INSERT INTO user_logs (id_user, ip, date, actions, element_id, db) VALUES ('$id_user', '$ip', '$date', '$actions', '$element_id', '$database')");
}

function selectLogs($page, $num, $search) {
    global $posts;
    global $start;

    $posts = selectCount("user_logs");
    $start = strNav($page, $num, $posts);

    return db2array("SELECT t1.actions, t1.element_id, t1.db, t1.date, t3.login, t1.ip, t2.descriptions as actions_log FROM user_logs as t1 LEFT JOIN actions_log as t2 on (t1.actions=t2.id) LEFT JOIN admin_user as t3 on (t1.id_user=t3.id) ORDER BY date DESC LIMIT $start, $num", 2);
}

function selectLogName($element_id, $db){
    $temp = db2array("SELECT name FROM $db WHERE id='$element_id'");
    return $temp["name"];
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

function selectSettings() {
    return db2array("SELECT * FROM settings");
}

function selectSocialNet() {
    return db2array("SELECT * FROM social_network", 2);
}

function getUrlLimit() {
    $url = "";
    if (isset($_GET["cat"])){
        $url.= "&cat=".$_GET["cat"];
    }
    if (isset($_GET["active"])){
        $url.= "&active=".$_GET["active"];
    }
    if (isset($_GET["sort"])){
        $url.= "&sort=".$_GET["sort"];
    }
    return $url;
}
function getUrlSort() {
    $url = "";
    if (isset($_GET["cat"])){
        $url.= "&cat=".$_GET["cat"];
    }
    if (isset($_GET["limit"])){
        $url.= "&limit=".$_GET["limit"];
    }
    return $url;
}

function strPage($page, $js) {
    if(!empty($js)){
        $url = 'javascript:'.$js.'('.$page.');';
    }else{
        if (!isset($_GET["page"])) {
            $_GET["page"] = 1;
        }
        $i = 0;
        foreach ($_GET as $key => $value){
            if ($i == 0) {
                $sim = "?";
            }else{
                $sim = "&";
            }
            if ($key == "page"){
                $value = $page;
            }
            $url .= $sim.$key."=".$value;
            $i++;
        }
    }
    return $url;
}
function strLimit() {
    $i = 0;
    foreach ($_GET as $key => $value){
        if ($key != "limit"){
            if ($i == 0) {
                $sim = "?";
            }else{
                $sim = "&";
            }
            $url .= $sim.$key."=".$value;
            $i++;
        }
    }
    return $url;
}
///Количество елементов
function selectCount($from) {
    $temp = db2array("SELECT COUNT(*) FROM $from");
    return $temp["COUNT(*)"];
}
///Постраничная навигация
function strNav($page, $num, $posts, $js=0) {
    global $total;
    if($js == '0'){
        global $page;
    }

    // Находим общее число страниц
    $total = (($posts - 1) / $num) + 1;
    $total =  intval($total);
    // Определяем начало сообщений для текущей страницы
    $page = intval($page);
    // Если значение $page меньше единицы или отрицательно
    // переходим на первую страницу
    // А если слишком большое, то переходим на последнюю
    if(empty($page) or $page < 0) $page = 1;
    if($page > $total) $page = $total;
    // Вычисляем начиная с какого номера
    // следует выводить сообщения
    $start = $page * $num - $num;
    // Выбираем $num сообщений начиная с номера $start

    // Проверяем нужны ли стрелки назад
    if ($page != 1) $GLOBALS['pervpage'] = '<li class="prev disabled"><a href='.strPage(1, $js).' title="First"><i class="fa fa-angle-double-left"></i></a></li><li class="prev disabled"><a href='.strPage($page - 1, $js).' title="Prev"><i class="fa fa-angle-left"></i></a></li>';
    // Проверяем нужны ли стрелки вперед
    if ($page != $total) $GLOBALS['nextpage'] = '<li class="next"><a href='.strPage($page + 1, $js).' title="Next"><i class="fa fa-angle-right"></i></a></li><li class="next"><a href='.strPage($total, $js).' title="Last"><i class="fa fa-angle-double-right"></i></a></li>';

    // Находим две ближайшие станицы с обоих краев, если они есть
    if($page - 5 > 0) $GLOBALS['page5left'] = ' <li><a href='.strPage($page - 5, $js).'>'. ($page - 5) .'</a></li>';
    if($page - 4 > 0) $GLOBALS['page4left'] = ' <li><a href='.strPage($page - 4, $js).'>'. ($page - 4) .'</a></li>';
    if($page - 3 > 0) $GLOBALS['page3left'] = ' <li><a href='.strPage($page - 3, $js).'>'. ($page - 3) .'</a></li>';
    if($page - 2 > 0) $GLOBALS['page2left'] = ' <li><a href='.strPage($page - 2, $js).'>'. ($page - 2) .'</a></li>';
    if($page - 1 > 0) $GLOBALS['page1left'] = ' <li><a href='.strPage($page - 1, $js).'>'. ($page - 1) .'</a></li>';

    if($page + 5 <= $total) $GLOBALS['page5right'] = '<li><a href='.strPage($page + 5, $js).'>'. ($page + 5) .'</a></li>';
    if($page + 4 <= $total) $GLOBALS['page4right'] = '<li><a href='.strPage($page + 4, $js).'>'. ($page + 4) .'</a></li>';
    if($page + 3 <= $total) $GLOBALS['page3right'] = '<li><a href='.strPage($page + 3, $js).'>'. ($page + 3) .'</a></li>';
    if($page + 2 <= $total) $GLOBALS['page2right'] = '<li><a href='.strPage($page + 2, $js).'>'. ($page + 2) .'</a></li>';
    if($page + 1 <= $total) $GLOBALS['page1right'] = '<li><a href='.strPage($page + 1, $js).'>'. ($page + 1) .'</a></li>';
    return $start;
}
///Вывод пользователей
function selectUser($page, $num){
    global $posts;
    global $start;

    $posts = selectCount("users");
    $start = strNav($page, $num, $posts);

    return db2array("SELECT t1.id, t1.name, t1.email, t1.date, t1.active, t1.phone FROM users as t1 ORDER BY t1.date DESC LIMIT $start, $num", 2);
}

/////Вывод юзера по id
function selectUserById($id) {
    return db2array("SELECT t1.name, t1.email, t1.phone, t1.active, t1.date, t1.city, t1.sex, t1.date_birth, t1.address, t1.note, t2.country FROM users as t1 LEFT JOIN country as t2 on(t1.id_country=t2.id) WHERE t1.id='$id'");
}

function selectIdUserAdminSession() {
    $temp = db2array("SELECT id FROM admin_user WHERE sid='".session_id()."'");
    return $temp["id"];
}

function selectUserByLogin($login) {
    return db2array("SELECT id, password, active FROM users WHERE login='$login'");
}

function selectMessageAdmin($page, $num, $to, $from){
    global $posts;
    global $start;

    if(!empty($from) OR !empty($to)) {
        $where = "";
    }
    if(!empty($from)) {
        $where.= " AND date >= '$from'";
    }
    if(!empty($to)) {
        $where.=" AND date <= '$to'";
    }

    $posts = selectCount("message_admin WHERE $where");
    $start = strNav($page, $num, $posts);

    return db2array("SELECT * FROM messages WHERE $where ORDER BY id DESC LIMIT $start, $num", 2);
}

function selectFeedback($page, $num){
    global $posts;
    global $start;

    $posts = selectCount("feedback");
    if($posts > 0){
        $start = strNav($page, $num, $posts);

        return db2array("SELECT id, img, name, company, priority, date FROM feedback ORDER BY priority DESC LIMIT $start, $num", 2);
    }
}

function selectFeedbackById($id){
    return db2array("SELECT id, text, img, company, name, priority FROM feedback WHERE id ='$id'");
}

function selectComplaintById($id, $page, $num){
    global $posts;
    global $start;

    $posts = selectCount("complaint WHERE id_element = '$id'");
    $start = strNav($page, $num, $posts);

    return db2array("SELECT id, id_user, message, id_element, type, date, status FROM complaint WHERE id_element ='$id' ORDER BY id DESC LIMIT $start, $num", 2);
}

function uploadPhoto($name, $size, $error, $tmp_name, $dir) {
    //================Настройки============= //
    $foto_light_name = time()."_".basename($name); // Имя файла исключая путь

    // Текст ошибок
    $error_by_mysql = "<span style=\"font: bold 15px tahoma; color: red;\">Ошибка при добавлении данных в базу</span>";
    $error_by_file = "<span style=\"font: bold 15px tahoma; color: red;\">Невозможно загрузить файл в директорию. Возможно её не существует</span>";

    // Начало
    if(!empty($name)) {
        $myfile_size = $size;
        $error_flag = $error;
        // Если ошибок не было
        if($error_flag == 0) {
            $DOCUMENT_ROOT = $_SERVER['DOCMENT_ROOT'];
            $upfile = "../images/".$dir."//" . time()."_".basename($name);
            if ($tmp_name) {
                //Если не удалось загрузить файл
                if (!move_uploaded_file($tmp_name, $upfile)) {
                    echo "$error_by_file";
                    exit;
                }
            } else {
                echo 'Проблема: возможна атака через загрузку файла. ';
                echo $name;
                exit;
            }
        } elseif ($myfile_size == 0) {
            echo "Пустая форма!";
        }
        // Если ошибок не было
    }
    return $foto_light_name;
}

///Вывод из базы специализации

function access(){
    $id_user = selectWhatUser();
    return db2array("SELECT t2.* FROM admin_user as t1 LEFT JOIN admin_group as t2 on (t1.id_group=t2.id) WHERE t1.id='$id_user'");
}

function selectMessageAdminByUser($page, $num, $id){
    global $posts;
    global $start;

    $posts = selectCount("users as t1 LEFT JOIN messages as t2 on (id_user_from=t1.id) WHERE id_user_from IN ('1', $id) AND id_user_to IN ('1', $id)");
    $start = strNav($page, $num, $posts);

    return db2array("SELECT t1.id, message, t1.name, t1.photo, t2.date, t2.`read` FROM users as t1 LEFT JOIN messages as t2 on (id_user_from=t1.id) WHERE id_user_from IN ('1', $id) AND id_user_to IN ('1', $id) ORDER BY  t2.id DESC LIMIT $start, $num", 2);
}
function selectReadMessageByUser($id){
    $temp = db2array("SELECT COUNT(*) FROM messages WHERE `read`='0' AND id_user_to='1' AND id_user_from='$id'");
    return $temp["COUNT(*)"];
}

function selectReadMessage(){
    $temp = db2array("SELECT COUNT(*) FROM messages WHERE `read`='0' AND id_user_to='1'");
    $temps = db2array("SELECT COUNT(*) FROM message_admin WHERE viewed='0' AND id_user='0'");
    return $temp["COUNT(*)"]+$temps["COUNT(*)"];
}
function upReadMessageByUser($id){
    mysql_query("UPDATE `messages` SET `read`='1' WHERE id_user_to='1' AND id_user_from='$id'");
}
function upViewedMessage(){
    mysql_query("UPDATE `message_admin` SET viewed='1' WHERE viewed='0'");
}
function selectMessageAdminById($id_message){
    return db2array("SELECT email, phone, message FROM message_admin WHERE id='$id_message'");
}

function selectUserSearch($num, $page, $num_user, $type, $name, $directory, $region, $city, $phone, $email) {
    global $posts;
    global $start;

    if($type == "all") $type = "";

    if(!empty($num_user) or !empty($name) or !empty($directory) or !empty($region) or !empty($city) or !empty($phone) or !empty($email) or $type != ""){
        $where = " WHERE ";
    }
    $and = " ";

    if($type != "")  {
        $where.= "t1.type ='$type'";
        $and = " AND ";
    }
    if(!empty($num_user))  {
        $where.= $and."t1.id ='$num_user'";
        $and = " AND ";
    }
    if(!empty($name)) {
        $where.= $and.'(t1.name LIKE "%'.$name.'%" OR t1.last_name LIKE "%'.$name.'%")';
        $and = " AND ";
    }
    if(!empty($directory)) {
        $where.= $and."t3.id_directory = '$directory'";
        $join = " LEFT JOIN user_specialization as t3 on(t3.id_user=t1.id) ";
        $and = " AND ";
    }
    if(!empty($region)) {
        $where.= $and."t1.region ='$region'";
        $and = " AND ";
    }
    if(!empty($city)) {
        $where.= $and."t1.city ='$city'";
        $and = " AND ";
    }
    if(!empty($phone)) {
        $where.= $and."t1.phone ='$phone'";
        $and = " AND ";
    }
    if(!empty($email)) {
        $where.= $and."t1.email ='$email'";
        $and = " AND ";
    }

    $posts = selectCount("users as t1 LEFT JOIN user_type as t2 on (t1.type=t2.id)$join$where");
    $start = strNav($page, $num, $posts);

    return db2array("SELECT t1.id, t1.name, t1.email, t1.date, t1.active, t2.name as type_name FROM users as t1 LEFT JOIN user_type as t2 on (t1.type=t2.id)$join$where ORDER BY t1.date DESC LIMIT $start, $num", 2);
}


function selectMessageAdminUser($page, $num, $to, $from){
    $temp = db2array("SELECT id_user_from, id_user_to FROM messages WHERE id_user_to='1' OR id_user_from='1' GROUP BY id_user_from, id_user_to ORDER BY id DESC", 2);

    $arr = array();
    $arr_new = array();
    foreach ($temp as $item) {
        $arr[] = $item["id_user_from"];
        $arr[] = $item["id_user_to"];
    }

    $arr = array_unique($arr);
    $n = array_search('1', $arr);
    if($n === 0 or $n >0) {
        unset($arr[$n]);
    }

    return $arr;
}
function selectMessageFromUserLast($id){
    return db2array("SELECT t1.id, t2.message, t1.name, t1.photo, t2.date FROM users as t1 LEFT JOIN messages as t2 on (t1.id=t2.id_user_to or t1.id=t2.id_user_from) WHERE t1.id = '$id' AND (t2.id_user_from = '1' OR t2.id_user_to = '1') ORDER BY t2.id DESC LIMIT 1");
}

function selectMessageAdminByEmail($email){
    return db2array("SELECT message, phone, email, date FROM messages WHERE email='$email' ORDER BY id DESC", 2);
}

function greateNameImg($str) {
    $str = mb_convert_case($str, MB_CASE_LOWER, "UTF-8");
    $str = trim($str);
    $tr = array(
        'а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ж'=>'zh','з'=>'z','и'=>'i','й'=>'j','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r', 'с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h', 'ц'=>'ts','ч'=>'ch','ш'=>'sh','щ'=>'sch','ъ'=>'y', 'ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya',
        'ї'=>'i','є'=>'e',' '=>'-','+'=>'-plus-','è'=>'e','ù'=>'u'
    );
    $str = strtr($str,$tr);
    $str = preg_replace("/-+/", '-', $str);
    $str = preg_replace ("/[^a-z-.]/","",$str);
    return substr($str, 0, 70);
}

function linkUrl($str) {
    //$str  = mb_strtolower($str);
    //$str  = strtolower($str);
    $str = mb_convert_case($str, MB_CASE_LOWER, "UTF-8");
    $str = trim($str);
    //$str = preg_replace("~ +~", " ", $str);
    $tr = array(
        'а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ж'=>'zh','з'=>'z','и'=>'i','й'=>'j','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r', 'с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h', 'ц'=>'ts','ч'=>'ch','ш'=>'sh','щ'=>'sch','ъ'=>'y', 'ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya',
        'ї'=>'i','є'=>'e',' '=>'-','+'=>'-plus-','è'=>'e','ù'=>'u'
    );
    $str = strtr($str,$tr);
    $str = preg_replace("/-+/", '-', $str);
    $str = preg_replace ("/[^a-z-]/","",$str);
    return substr($str, 0, 70);
}



function selectPhoto($id){
    return db2array("SELECT id, img, text, priority FROM photo WHERE id_photogallary = $id ORDER BY priority ASC", 2);
}

function updateTextPhoto($id_photo, $text_photo, $priority_photo){
    $sql = "UPDATE photo SET text='$text_photo', priority='$priority_photo' WHERE id = '$id_photo'";
    $result = mysql_query($sql) or die(mysql_error());
}

function deletePhoto($id_photo){
    $sql = "DELETE FROM photo WHERE id ='$id_photo'";
    $result = mysql_query($sql) or die(mysql_error());
}


function selectImgGalleryID($id) {
    $temp = db2array("SELECT img FROM photo WHERE id_photogallary = $id ORDER BY id ASC LIMIT 1");
    return $temp["img"];
}

function selectMessage($page, $num, $to, $from){
    global $posts;
    global $start;

    if(!empty($from) OR !empty($to)) {
        $where = " WHERE ";
    }
    if(!empty($from)) {
        $where.= $and."date >= '$from'";
        $and = " AND ";
    }
    if(!empty($to)) {
        $where.= $and."date <= '$to'";
    }

    $posts = selectCount("messages $where");
    $start = strNav($page, $num, $posts);
    return db2array("SELECT id, name, email, phone, message, subject, date, marka, model, year, modifay, vin FROM messages $where ORDER BY id DESC LIMIT $start, $num", 2);
}

function selectCategoriesBySection($id=0) {
    return db2array("SELECT id, name, title, meta_d, meta_k, code, descriptions, priority, section, active FROM categories WHERE section='$id' ORDER BY name ASC", 2);
}
function selectCategoriesBySectionAct($id=0) {
    return db2array("SELECT id, name, title, meta_d, meta_k, code, descriptions, priority, section, active FROM categories WHERE section='$id' AND active='1' ORDER BY priority DESC", 2);
}
function selectCategoriesByXML($id=0) {
    return db2array("SELECT id, name, title, meta_d, meta_k, code, descriptions, priority, section, active FROM categories WHERE section='$id' ORDER BY priority DESC", 2);
}
function selectCategoriesById($id) {
    return db2array("SELECT id, name, title, meta_d, meta_k, code, descriptions, priority, section, img, active, in_xml FROM categories WHERE id='$id'");
}

function selectFilterByCategories($cat) {
    return db2array("SELECT id, name, type, model, priority FROM filter WHERE categories='$cat' ORDER BY priority DESC", 2);
}
////Проверка есть ли в категории дочерние разделі
function checkSection($id) {
    $temp = db2array("SELECT COUNT(*) FROM categories WHERE section=$id");
    return $temp["COUNT(*)"];
}
function checkSectionCat($id) {
    $temp = db2array("SELECT COUNT(*) FROM categories WHERE section=$id");
    $temp_pr = db2array("SELECT COUNT(*) FROM product WHERE categories=$id");
    return $temp["COUNT(*)"]+$temp_pr["COUNT(*)"];
}
function selectExtraChargeTyres($page, $num, $brand, $diameter){
    global $posts;
    global $start;

    if(!empty($brand)){
        $wr_br = " AND t1.brand=".$brand;
    }
    if(!empty($diameter)){
        $wr_dim = " AND t1.diameter=".$diameter;
    }

    $posts = selectCount("extra_charge as t1 WHERE t1.type='1'$wr_br$wr_dim");
    $start = strNav($page, $num, $posts);

    return db2array("SELECT t1.id, t2.name as brand, t1.season, t3.value as diameter, t1.percent FROM extra_charge as t1 LEFT JOIN categories as t2 on(t1.brand=t2.id) LEFT JOIN element_filter as t3 on (t1.diameter=t3.id) WHERE t1.type='1'$wr_br$wr_dim ORDER BY t1.id DESC LIMIT $start, $num", 2);
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
function selectTyresBrand(){
    //return db2array("SELECT id, name FROM tyres_brand", 2);
    return db2array("SELECT id, name, code FROM categories WHERE section='1' ORDER BY name ASC", 2);
}
function selectDiskWidth(){
    return db2array("SELECT id, name FROM disk_width", 2);
}
function selectPcd(){
    return db2array("SELECT id, name FROM disk_pcd", 2);
}
function selectDiskBrand(){
    //return db2array("SELECT id, name FROM disk_brand", 2);
    return db2array("SELECT id, name, code FROM categories WHERE section='2' ORDER BY name ASC", 2);
}
function selectDiskDiameter(){
    return db2array("SELECT id, name FROM disk_diameter", 2);
}
function selectExtraChargeById($id){
    return db2array("SELECT brand, diameter, season, percent FROM extra_charge WHERE id='$id'");
}
function selectValueFilter($id_filter){
    return db2array("SELECT id, value FROM `element_filter` WHERE id_filter='$id_filter' ORDER BY value ASC", 2);
}
function selectExtraChargeDisk($page, $num, $brand, $diameter){
    global $posts;
    global $start;

    if(!empty($brand)){
        $wr_br = " AND t1.brand=".$brand;
    }
    if(!empty($diameter)){
        $wr_dim = " AND t1.diameter=".$diameter;
    }
    $posts = selectCount("extra_charge as t1 WHERE t1.type='2'$wr_br$wr_dim");
    $start = strNav($page, $num, $posts);

    return db2array("SELECT t1.id, t2.name as brand, t1.season, t3.value as diameter, t1.percent FROM extra_charge as t1 LEFT JOIN categories as t2 on(t1.brand=t2.id) LEFT JOIN element_filter as t3 on (t1.diameter=t3.id) WHERE t1.type='2'$wr_br$wr_dim ORDER BY t1.id DESC LIMIT $start, $num", 2);
}
function selectProduct($page, $num, $cat, $sort){
    global $posts;
    global $start;

    if($sort == "1"){
        $wr_sort = "date DESC";
    }elseif($sort == "2"){
        $wr_sort = "name ASC";
    }elseif($sort == "3"){
        $wr_sort = "price ASC";
    }elseif($sort == "4"){
        $wr_sort = "price DESC";
    }else{
        $wr_sort = "name ASC";
    }
    $posts = selectCount("product WHERE categories='$cat'");
    $start = strNav($page, $num, $posts);

    return db2array("SELECT product.id, product.title, product.name, product.sale, product.categories, product.active, product.priority FROM product WHERE categories='$cat' ORDER BY priority DESC, $wr_sort LIMIT $start, $num", 2);
}

function selectProductById($id) {
    return db2array("SELECT active, main, title, meta_k, meta_d, name, related, description, sale, price, price_clear, categories, priority, img, user_id, provider, warranty, attention, gift, availability, code, youtube_url, logistic, article FROM product WHERE id='$id'");
}

function selectAvailability() {
    return db2array("SELECT id, value FROM availability", 2);
}

function resize($file_input, $file_output, $max, $percent = false) {
    list($w_i, $h_i, $type) = getimagesize($file_input);

    $h_o = $w_o = 0;
    if ($w_i < $h_i) { // сравниваем размеры
        $h_o = $max;
    } else {
        $w_o = $max;
    }

    if (!$w_i || !$h_i) {
        echo 'Невозможно получить длину и ширину изображения';
        return;
    }
    $types = array('','gif','jpeg','png');
    $ext = $types[$type];
    if ($ext) {
        $func = 'imagecreatefrom'.$ext;
        $img = $func($file_input);
    } else {
        echo 'Некорректный формат файла';
        return;
    }
    if ($percent) {
        $w_o *= $w_i / 100;
        $h_o *= $h_i / 100;
    }
    if (!$h_o) $h_o = $w_o/($w_i/$h_i);
    if (!$w_o) $w_o = $h_o/($h_i/$w_i);

    $img_o = imagecreatetruecolor($w_o, $h_o);
    imagecopyresampled($img_o, $img, 0, 0, 0, 0, $w_o, $h_o, $w_i, $h_i);
    if ($type == 2) {
        return imagejpeg($img_o,$file_output,100);
    } else {
        $func = 'image'.$ext;
        return $func($img_o,$file_output);
    }
}

function uploadGallery($name, $size, $error, $tmp_name, $id) {
    $foto_light_name = uploadPhoto($name, $size, $error, $tmp_name, "product_gallery");

    resize('../images/product_gallery/'.$foto_light_name, '../images/product_gallery/'.$foto_light_name, 1000);

    mysql_query("INSERT INTO gallery (img, id_product) VALUES ('$foto_light_name', '$id')") or die(mysql_error());
}

function selectWhatUserAdmin() {
    $temp = db2array("SELECT id FROM admin_user WHERE sid='".session_id()."'");
    return $temp["id"];
}

function selectWhatUserNameAdmin() {
  $temp = db2array("SELECT name FROM admin_user WHERE sid='".session_id()."'");
  return $temp["name"];
}

function deleteGallery($id) {
    mysql_query("DELETE FROM gallery WHERE id='$id'") or die(mysql_error());
}

function selectCountValueFilter($id_filter, $id, $id_model=0){
    $temp = db2array("SELECT COUNT(*) FROM filter_value WHERE id_filter='$id_filter' and id_product='$id' and id_model='$id_model'");
    return $temp["COUNT(*)"];
}

function updateFilterValue($id_filter, $id_filter_element, $id_product, $id_model=0) {
    mysql_query("UPDATE filter_value SET element_value='$id_filter_element' WHERE id_filter='$id_filter' and id_product='$id_product' and id_model ='$id_model'") or die(mysql_error());
}

function insertFilterValue($id_filter, $id_filter_element, $id_product, $id_model=0) {
    mysql_query("INSERT INTO filter_value (id_filter, element_value, id_product, id_model) VALUES ('$id_filter', '$id_filter_element', '$id_product', '$id_model')") or die(mysql_error());
}
function selcetFilterCat($cat){
    $temp = db2array("SELECT COUNT(*) FROM filter WHERE categories='$cat'");

    if($temp['COUNT(*)'] == 0){
        $section = db2array("SELECT section FROM categories WHERE id='$cat'");

        if($section['section']>0) {
            return selcetFilterCat($section['section']);
        }
    }else{
        return $cat;
    }
}
function selectFilter($cat, $model=0) {
    $cat = selcetFilterCat($cat);
    return db2array("SELECT id, name, type FROM filter WHERE categories='$cat' and model='$model'", 2);
}

function selectFilterElement($id) {
    return db2array("SELECT id, value FROM element_filter WHERE id_filter='$id'", 2);
}

function selectElementValue($id_product, $id_filter){
    $temp = db2array("SELECT element_value FROM filter_value WHERE id_product='$id_product' and id_filter='$id_filter'");
    return $temp["element_value"];
}

function selectGallery($id) {
    return db2array("SELECT id, img FROM gallery WHERE id_product=$id", 2);
}

function selectElementByFilter($id) {
    return db2array("SELECT id, value FROM element_filter WHERE id_filter='$id'", 2);
}

function selectFilterById($id) {
    return db2array("SELECT name, type, categories, model, priority FROM filter WHERE id='$id'");
}
function recusiveCatSection($id){
    $arrResult = array();
    $arrCat = selectCategoriesBySection($id);

    if($arrCat){
        foreach($arrCat as $iCat){
            $rec = recusiveCatSection($iCat["id"]);
            if($rec){
                $arrResult = array_merge($arrResult, $rec);
            }else{
                $arrResult[] = $iCat["id"];
            }
        }
    }
    return $arrResult;
}
function selectSearchProduct($page, $num, $active, $name, $article, $provider, $brand, $attention, $categories){
    global $posts;
    global $start;

    $query_search = "";
    if(!empty($active) AND $active!=0) {
        if(!empty($query_search)) $query_search.= "AND";
        if($active == 2) $active = 0;
        $query_search.=" active='$active' ";
    }
    if(!empty($name)) {
        if(!empty($query_search)) $query_search.= "AND";
        $query_search.=" (name LIKE '%".$name."%') ";
    }
    if(!empty($provider)) {
        if(!empty($query_search)) $query_search.= "AND";
        $query_search.=" provider='$provider' ";
    }
    if(!empty($brand)) {
        if(!empty($query_search)) $query_search.= "AND";
        $query_search.=" brand='$brand' ";
    }
    if(!empty($attention)) {
        if(!empty($query_search)) $query_search.= "AND";
        $query_search.=" attention='$attention' ";
    }
    if(!empty($categories))  {
        if(!empty($query_search)) $query_search.= "AND";
        $arrCat = recusiveCatSection($categories);
        $query_search.=" categories IN (";
        $n = 1;
        if($arrCat) {
            foreach ($arrCat as $iCat) {
                if ($n > 1) $query_search .= ", ";
                $query_search .= $iCat;
                $n++;
            }
        }else{
            $query_search .= $categories;
        }
        $query_search.= ")";
    }
    if(!empty($article))  {
        if(!empty($query_search)) $query_search.= "AND";
        $query_search.=" article='$article' ";
    }
    if(!empty($query_search)){
        $query_search = " WHERE".$query_search;
    }
    $posts = selectCount("product$query_search");
    $start = strNav($page, $num, $posts);

    return db2array("SELECT id, name, active FROM product$query_search ORDER BY priority DESC, date DESC LIMIT $start, $num", 2);
}

function recusiveCategories($section, $lev=0, $id=""){
    $select_cat = selectCategoriesBySection($section);
    if ($select_cat) {
        foreach ($select_cat as $item) {
            if ($item["id"] == $id) {
                $select = " selected";
            } else {
                $select = "";
            }
            $pol = "";
            for ($i = 1; $i <= $lev; $i++) {
                $pol .= "-";
            }
            echo '<option value="' . $item["id"] . '"' . $select . '>' . $pol . $item["name"] . '</option>';
            $lev++;
            if ($lev < 2) {
                recusiveCategories($item["id"], $lev, $id);
            }
            $lev--;
        }
    }
}

function recusiveCategoriesCheckbox($section, $lev=0, $id=""){
    $select_cat = selectCategoriesByXML($section);
    //echo'<pre>'.print_r($select_cat).'</pre>';
    if($select_cat){
        foreach ($select_cat as $item){
            $pol="";
            for ($i = 1; $i <= $lev; $i++) {
                $pol .= "-";
            }
            if($item["id"] == 4){
                $divStart = "<div class='row' style='margin: 25px 0 25px 0;'><div class='col-md-12'>";
                //$divEnd = "</div>";
            }else{
                $divStart = "<div class='col-md-3'>";
            }
            echo $divStart.'<input type="checkbox" name="categories[]" class="checkbox" value="'.$item["id"].'"/>'.$pol.$item["name"].'</div>'.$divEnd;
            $lev++;
            recusiveCategoriesCheckbox($item["id"], $lev, $id);
            $lev--;
        }
    }
}
function recusiveCategoriesBreadcrumbs($section){
    $temp = db2array("SELECT id, name, code, section FROM categories WHERE id='$section'");
    if($temp){
        recusiveCategoriesBreadcrumbs($temp["section"]);
        echo '<li><i class="fa fa-angle-right"></i><a href="index.php?code=categories&section='.$temp["id"].'">'.$temp["name"].'</a></li>';
    }
}
function selectElementFilterById($id) {
    return db2array("SELECT value, id_filter FROM element_filter WHERE id='$id'");
}

////Заказы
function selectOrder($page, $num, $num_order, $from, $to, $status, $phone, $typePay, $kassa, $manager, $region, $provider, $prepayment){
  global $posts;
  global $start;

  $typePay = clearData($typePay, "i");
  $query_search="";

  if($kassa){
    $sort = "t1.date_end DESC";
    if (!empty($query_search)) $query_search .= "AND";
    $query_search .= " (t1.id_status='1' OR t1.id_status='4') ";

    if ($from and $to) {
      if (!empty($query_search)) $query_search .= "AND";
      $query_search .= " t1.date_end>='$from 00:00:00' AND t1.date_end<='$to 23:59:59' ";
    }
  }else {
    $sort = "t1.date DESC";
    if ($from and $to) {
      if (!empty($query_search)) $query_search .= "AND";
      $query_search .= " t1.date>='$from 00:00:00' AND t1.date<='$to 23:59:59' ";
    }
    if (!empty($status)) {
      if ($status != "all"){
        if (!empty($query_search)) $query_search .= "AND";
        $query_search .= " t1.id_status='" . $status . "' ";
      }
    } else {
      if (!empty($query_search)) $query_search .= "AND";
      $query_search .= " t1.id_status NOT IN (1,3) ";
    }
  }
  if (!empty($phone)) {
    if (!empty($query_search)) $query_search .= "AND";
    $phon = preg_replace('~[^0-9]+~', '', $phone);
    $phon = substr($phon, 1);
    $query_search .= ' t1.phone LIKE "%' . $phone . '%" OR t1.phone LIKE "%' . $phon . '%" ';
  }
  if (!empty($typePay)) {
    if (!empty($query_search)) $query_search .= "AND";
    $query_search .= " t1.beznal='" . $typePay . "' ";
  }
  if (!empty($num_order)) {
    if (!empty($query_search)) $query_search .= "AND";
    $query_search .= " (t1.id LIKE '%" . $num_order . "%') ";
  }
  if (!empty($manager)) {
    if (!empty($query_search)) $query_search .= "AND";
    $query_search .= " t1.id_admin='".$manager."' ";
  }
  if (!empty($region)) {
    if (!empty($query_search)) $query_search .= "AND";
    $query_search .= " t1.region='".$region."' ";
  }
  if (!empty($provider)) {
    if (!empty($query_search)) $query_search .= "AND";
    $query_search .= " t5.provider='".$provider."' ";
  }
  if (!empty($prepayment)) {
    if (!empty($query_search)) $query_search .= "AND";
    switch ($prepayment){
      case 2: $query_search .= " t1.prepayment > '0' "; break;
      case 1: $query_search .= " t1.prepayment = '' "; break;
    }
  }
  if(!empty($query_search)){
    $query_search = " WHERE".$query_search;
  }

    $temp = db2array("SELECT COUNT(DISTINCT t1.id) as kol FROM orders as t1 LEFT JOIN status as t2 on(t1.id_status = t2.id) LEFT JOIN order_product as t5 on (t1.id = t5.id_order) $query_search ");
    $posts = $temp["kol"];
    $start = strNav($page, $num, $posts);

    return db2array("SELECT t1.id, t1.date, t1.date_end, t1.id_user, t1.summ, t2.code, t2.name as name_status, t3.name as name_user, t1.order_phone, t1.name as name_order, t1.comments, t4.region as name_region FROM orders as t1 
			LEFT JOIN status as t2 on(t1.id_status = t2.id) 
			LEFT JOIN users as t3 on(t1.id_user = t3.id)
			LEFT JOIN region as t4 on(t1.region=t4.id) 
			LEFT JOIN order_product as t5 on (t1.id = t5.id_order)
		$query_search GROUP BY t1.id ORDER BY $sort LIMIT $start, $num", 2);
}

function sumQuantityOrder($id) {
    $temp = db2array("SELECT SUM(quantity) FROM order_product WHERE id_order='$id'");
    return $temp["SUM(quantity)"];
}

function selectSummOrderById($id){
    $temp = db2array("SELECT price, quantity FROM order_product WHERE id_order='$id'", 2);
    $sum = 0;
    foreach($temp as $item) {
        $sum+=$item["price"]*$item["quantity"];
    }
    return $sum;
}
function selectClearSummOrderById($id){
    $temp = db2array("SELECT price_clear, quantity FROM order_product WHERE id_order='$id'", 2);
    $sum = 0;
    foreach($temp as $item) {
        $sum+=$item["price_clear"]*$item["quantity"];
    }
    echo $sum;
}

function selectOrderById($id) {
    return db2array("SELECT t1.date, t1.name, t1.phone, t1.summ, t1.cause, t1.beznal, t1.upd, t1.prepayment, t1.address, t1.delivery, t1.comment, t1.id_status, t1.comments, t1.date_comm, t3.name as name_user, t3.phone as phone_user, t3.email, t3.address as address_user, t3.sex, t3.city, t2.name as status, t2.code as code_status, t1.order_phone, t1.prepayment_date, t1.id_user, t1.in_card, t4.name as name_admin_comm, t1.pdzz, t5.region as name_region, t5.id as region_id, t1.expectation_hours, t1.typeUser, t1.name_сontact, t1.INN, t1.KPP, t1.jur_address, t1.commPhone, t6.name as pay_name, t1.trans_company, t1.email as email_order FROM orders as t1
			LEFT JOIN status as t2 on(t1.id_status = t2.id) 
			LEFT JOIN users as t3 on(t1.id_user = t3.id) 
			LEFT JOIN admin_user as t4 on(t1.id_admin_comm=t4.id)
			LEFT JOIN region as t5 on (t1.region=t5.id) 
			LEFT JOIN pay_type as t6 on (t1.pay=t6.id) 
		WHERE t1.id='$id'");
}

function sPhoneByOrderId($id){
  return db2array("SELECT phone FROM phones WHERE id_order='$id'", 2);
}

function selectOrders($id, $page, $num){
    global $posts;
    global $start;

    $posts = selectCount("orders WHERE id_user='$id'");
    $start = strNav($page, $num, $posts);

    return db2array("SELECT t1.id, t1.date, t3.name as status, t3.code as code_status, t2.price FROM orders as t1 
                  LEFT JOIN order_product as t2 on(t1.id = t2.id_order) 
                  LEFT JOIN status as t3 on (t1.id_status = t3.id) 
                  WHERE t1.id_user='$id' GROUP BY t1.id ORDER BY date DESC LIMIT $start, $num",2);
}

function selectOrderProductById($id){
    return db2array("SELECT t1.id, t1.product_id, t1.code, t4.summ, t1.name, t1.quantity, t1.price, t1.categories, t2.id as id_categories, t1.sale, t1.day, t2.code as code_cat, t3.code as code_simv, t3.article, t4.prepayment, t5.name as provider, t1.nzsp, t1.in_storage, t1.provider as id_provider, t6.region as region_storage FROM order_product as t1 
			LEFT JOIN categories as t2 on (t1.categories = t2.code) 
			LEFT JOIN product as t3 on (t1.product_id = t3.id) 
			LEFT JOIN orders as t4 on ('$id' = t4.id) 
			LEFT JOIN provider as t5 on(t1.provider=t5.id)
			LEFT JOIN region as t6 on(t1.in_storage=t6.id)
		    WHERE t1.id_order='$id' GROUP BY t1.id", 2);
}

function sOrderProductById($id){
  return db2array("SELECT t1.id, t1.product_id, t1.code, t4.summ, t1.name, t1.quantity, t1.price, t1.categories, t2.id as id_categories, t1.sale, t1.day, t2.code as code_cat, t3.code as code_simv, t3.article, t4.prepayment, t5.name as provider, t1.nzsp, t1.in_storage, t1.provider as id_provider FROM order_product as t1 
			LEFT JOIN categories as t2 on (t1.categories = t2.code) 
			LEFT JOIN product as t3 on (t1.product_id = t3.id) 
			LEFT JOIN orders as t4 on ('$id' = t4.id) 
			LEFT JOIN provider as t5 on(t1.provider=t5.id)
		    WHERE t1.id_order='$id' AND t1.price > 0 GROUP BY t1.id", 2);
}

function selectStatus(){
    return db2array("SELECT id, name, code, sms_text, email_text FROM status",2);
}

function selectStatusById($id){
    return db2array("SELECT name, code, sms_text, email_text FROM status WHERE id='$id'");
}


function selectSearchUsers($page, $num, $active, $id_user, $email, $phone){
    global $posts;
    global $start;

    $query_search = "";
    if(!empty($active)) {
        if(!empty($query_search)) $query_search.= "AND";
        if($active == 2) $active = 0;
        $query_search.=" active='$active' ";
    }
    if(!empty($email)) {
        if(!empty($query_search)) $query_search.= "AND";
        $query_search.=" email ='".$email."' ";
    }
    if(!empty($phone)) {
        if(!empty($query_search)) $query_search.= "AND";
        $query_search.=" phone='$phone' ";
    }
    if(!empty($id_user))  {
        if(!empty($query_search)) $query_search.= "AND";
        $query_search.=" id='$id_user' ";
    }

    $posts = selectCount("users WHERE$query_search");
    $start = strNav($page, $num, $posts);
    return db2array("SELECT id, name, active FROM users WHERE$query_search ORDER BY date DESC LIMIT $start, $num", 2);
}

function selectCategoiesByFilter($id) {
    $temp = db2array("SELECT categories FROM filter WHERE id='$id'");
    return $temp["categories"];
}

function selectMessages(){
    $temp = db2array("SELECT COUNT(*) FROM messages WHERE admin='0'");
    return $temp["COUNT(*)"];
}

function selectMessagesMain(){
    $temp = db2array("SELECT COUNT(*) FROM messages");
    return $temp["COUNT(*)"];
}

function upMessages(){
    mysql_query("UPDATE `messages` SET `admin`=1 WHERE admin='0'");
}

function selectCountOreders(){
    $temp = db2array("SELECT COUNT(*) FROM orders WHERE id_status='5'");
    return $temp["COUNT(*)"];
}

function selectCountOredersMain(){
    $temp = db2array("SELECT COUNT(*) FROM orders");
    return $temp["COUNT(*)"];
}

function selectCountUserMain(){
    $temp = db2array("SELECT COUNT(*) FROM users");
    return $temp["COUNT(*)"];
}

function selectProductByOrder($id){
    return db2array("SELECT t1.id, t1.name, t1.quantity, t1.product_id, t1.code, t1.id_order, t1.nzsp, t1.provider,  t2.article, t3.region, t1.price_clear, t1.day, t1.price FROM order_product as t1 LEFT JOIN product as t2 on (t1.product_id = t2.id) LEFT JOIN orders as t3 on (t1.id_order = t3.id) WHERE t1.id ='$id'");
}

function selectSummOrderMain(){
    $temp = db2array("SELECT t1.price, t1.quantity FROM order_product as t1 LEFT JOIN orders as t2 on(t1.id_order=t2.id)WHERE t2.id_status='1'", 2);
    $sum = 0;
    foreach($temp as $item) {
        $sum+=$item["price"]*$item["quantity"];
    }
    echo $sum;
}

function sSummOrderByDate($from, $to, $manager, $region){
    if(!empty($manager)){
        $man_query = " AND t2.id_admin='$manager'";
    }
    if(!empty($region)){
        $red_query = " AND t2.region='$region'";
    }
    $temp = db2array("SELECT t2.id, t2.summ FROM orders as t2 WHERE t2.id_status='1' AND t2.date_end>='$from 00:00:00' AND t2.date_end<='$to 23:59:59'$man_query$red_query", 2);
    $sum = 0;
    foreach($temp as $item) {
        if ($item['summ'] > 0) {
            $sum+=$item['summ'];
        } else {
            $sum+=selectSummOrderById($item['id']);
        }
    }
    return $sum;
}

function sSummOrderByDateReturn($from, $to, $manager, $region){
  if(!empty($manager)){
    $man_query = " AND t2.id_admin='$manager'";
  }
  if(!empty($region)){
    $red_query = " AND t2.region='$region'";
  }
  $temp = db2array("SELECT t1.price, t1.quantity FROM order_product as t1 LEFT JOIN orders as t2 on(t1.id_order=t2.id)WHERE t2.id_status='4' AND t2.date_end>='$from 00:00:00' AND t2.date_end<='$to 23:59:59'$man_query$red_query", 2);
  $sum = 0;
  foreach($temp as $item) {
    $sum+=$item["price"]*$item["quantity"];
  }
  return $sum;
}

function sSummSaleOrderByDate($from, $to, $manager, $region){
    if(!empty($manager)){
        $man_query = " AND id_admin='$manager'";
    }
    if(!empty($region)){
        $reg_query = " AND region='$region'";
    }
    $temp = db2array("SELECT id, summ FROM orders WHERE id_status='1' AND date_end>='$from 00:00:00' AND date_end<='$to 23:59:59' AND summ > 0$man_query$reg_query", 2);
    $sum = 0;
    foreach($temp as $item) {
        $sum+=selectSummOrderById($item['id']) - $item['summ'];
    }
    return $sum;
}

function sSummSaleOrderByDateReturn($from, $to, $manager, $region){
  if(!empty($manager)){
    $man_query = " AND id_admin='$manager'";
  }
  if(!empty($region)){
    $reg_query = " AND region='$region'";
  }
  $temp = db2array("SELECT id, summ FROM orders WHERE id_status='4' AND date_end>='$from 00:00:00' AND date_end<='$to 23:59:59' AND summ > 0$man_query$reg_query", 2);
  $sum = 0;
  foreach($temp as $item) {
    $sum+=selectSummOrderById($item['id']) - $item['summ'];
  }
  return $sum;
}

function selectBasePercent($type){
    $temp = db2array("SELECT percent FROM base_extra_charge WHERE id='$type'");
    return $temp["percent"];
}
function selectCountTotalPage(){
    $posts = selectCount("product as t1 LEFT JOIN categories as t2 on(t1.categories=t2.id) WHERE t1.active='1' AND t2.section='4' AND t2.in_xml='1'");
    $num = 100;
    if($posts>0){
        $total = (($posts - 1) / $num) + 1;
        $total =  intval($total);
        return $total;
    }else{
        return 0;
    }
}

function selectCatByProdeuct(){
    return db2array("SELECT t2.id, t2.name FROM product as t1 LEFT JOIN categories as t2 on (t1.categories =t2.id) WHERE t2.active = '1' and t1.active='1' GROUP BY t2.id", 2);
}

function selectProductByArtiсle($article){
    return db2array("SELECT t1.id, t1.title, t1.code, t1.name, t1.categories, t1.price, t1.sale, t3.code as code_cat, t1.logistic, t1.provider, t1.price_clear, t1.img FROM product as t1 LEFT JOIN filter_value as t2 on (t1.id = t2.id_product) LEFT JOIN categories as t3 on(t1.categories=t3.id) WHERE t1.active='1' AND t1.article='$article'");
}
function chekcArticleProduct($code, $type='0'){
    $wr = '';
    if($type != '0'){
        $wr = " AND (t3.section='$type' OR t2.section='$type')";
    }
    $temp = db2array("SELECT t1.id FROM product as t1 LEFT JOIN categories as t2 on(t1.categories=t2.id) LEFT JOIN categories as t3 on(t2.section=t3.id) WHERE t1.article='$code' AND t1.active='1'$wr");
    if(!$temp){
        $temp = db2array("SELECT t1.id_product as id FROM product_articles as t1 WHERE t1.article='$code'");
    }
    return $temp["id"];
}
function chekcArticleProductDisk($code, $provider, $type='0'){
  $wr = '';
  if($type != '0'){
    $wr = " AND (t3.section='$type' OR t2.section='$type')";
  }
  $temp = db2array("SELECT t1.id FROM product as t1 LEFT JOIN categories as t2 on(t1.categories=t2.id) LEFT JOIN categories as t3 on(t2.section=t3.id) WHERE t1.article='$code' AND t1.active='1' AND t1.provider_upload='$provider'$wr");
  if(!$temp){
    $temp = db2array("SELECT t1.id_product as id FROM product_articles as t1 WHERE t1.article='$code' AND t1.provider='$provider'");
  }
  return $temp["id"];
}
function checkCategoriesProduct($marka, $model){
    $temp = db2array('SELECT t2.id FROM categories as t1 LEFT JOIN categories as t2 on(t1.id=t2.section) WHERE t1.name="'.$marka.'" AND t2.name="'.$model.'"');
    if($temp){
        return $temp["id"];
    }else{
        return 0;
    }
}

function checkBrand($marka){
    $temp = db2array("SELECT COUNT(*) FROM categories WHERE name='$marka'");
    return $temp["COUNT(*)"];
}
function selectCategoriesIdByName($name){
    $temp = db2array("SELECT id FROM categories WHERE name='$name'");
    return $temp["id"];
}
function selectFilterElementByValue($value, $id_filter){
    $temp = db2array("SELECT id FROM element_filter WHERE value='$value' AND id_filter='$id_filter'");
    return $temp["id"];
}
function selectElementValueName($id_product, $id_filter){
    $temp = db2array("SELECT t2.value FROM filter_value as t1 LEFT JOIN element_filter as t2 on(t1.element_value=t2.id)WHERE t1.id_product='$id_product' and t1.id_filter='$id_filter'");
    return $temp["value"];
}
function selectElementValueFilter($id_product, $id_filter){
    $temp = db2array("SELECT element_value FROM `filter_value` WHERE `id_filter`='$id_filter' AND `id_product`='$id_product'");
    return $temp["element_value"];
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

function selectBasket(){
    $temp = db2array("SELECT t1.id, t1.name, t1.quantity, t1.product_id, t1.categories, t1.code, t2.name as name_product, t2.price as price_product, t1.price, t1.img, t2.img as img_product, t2.code as product_code, t3.code as categories_code, t1.day, t2.sale, t1.price_clear, t2.provider, t2.article
            FROM basket as t1 
            LEFT JOIN product as t2 on(t1.product_id=t2.id) 
            LEFT JOIN categories as t3 on(t2.categories=t3.id) 
            LEFT JOIN provider as t4 on (t2.provider=t4.id)
            WHERE t1.customer='".session_id()."' ORDER BY t1.id DESC", 2);
    $arr = array();
    foreach($temp as $i){
        if($i["product_id"] >0) {
            $name = $i["name_product"];
            $price = $i["price"] - (($i["price"] / 100) * $i["sale"]);
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
            "provider" => $i["provider"],
            "article" => $i["article"]
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
            $price = $item["price"] - (($item["price"] / 100)*$item["sale"]);
        }
        $sum += $price*$item["quantity"];
    }
    return $sum;
}

function selectPriceProvider($id){
    return db2array("SELECT t1.id_provider, t1.price, t1.price_clear, t1.logistic, t1.availability, t2.name, t1.date FROM price_provider as t1 
        LEFT JOIN provider as t2 on(t1.id_provider=t2.id) 
      WHERE t1.id_product = '$id'", 2);
}

function selectPriceByProvider($id_provider, $id_prod){
    return db2array("SELECT price, price_clear, logistic, availability, date FROM price_provider WHERE id_product = '$id_prod' AND id_provider='$id_provider'");
}

function selectPriceProviderAll($id){
    $temp = db2array("SELECT id, name FROM provider ORDER BY priority ASC", 2);

    $res = array();
    foreach($temp as $item){
        $sPrice = selectPriceByProvider($item["id"], $id);
        $res[]= array(
           "id_provider" => $item["id"],
           "name" => $item["name"],
           "price" => (int)$sPrice["price"],
           "price_clear" => (int)$sPrice["price_clear"],
           "logistic" => (int)$sPrice["logistic"],
           "availability" => (int)$sPrice["availability"],
           "date" => $sPrice["date"]
        );
    }
    return $res;
}

function sPriceProvider12($id){
  return db2array("SELECT t1.provider, t1.price_clear, t1.day FROM order_product as t1  
      WHERE t1.id = '$id' AND t1.provider = '12'");
}

function selectLatDatePrice($id, $id_provider){
    $temp = db2array("SELECT t2.date FROM product as t1 LEFT JOIN upload_product_log as t2 on(t1.article=t2.article) WHERE t1.id = '$id' AND t2.id_provider='$id_provider' ORDER BY t2.date DESC LIMIT 1");
    return $temp["date"];
}
function selectProvider(){
    return db2array("SELECT id, name, extra_charge FROM provider", 2);
}
function selectProviderExtraCharge($provider){
    $temp = db2array("SELECT extra_charge FROM provider WHERE id='$provider'");
    return $temp["extra_charge"];
}
function selectFilterCat($id){
    $res  = db2array("SELECT id FROM filter WHERE categories = '$id'", 2);
    if(!$res){
        $temp = db2array("SELECT section FROM categories WHERE id = '$id'");
        if($temp['section'] > 0){
            $id = selectFilterCat($temp['section']);
        }
    }
    return $id;
}
function selectProviderNameById($id){
    $temp = db2array("SELECT name FROM provider WHERE id='$id'");
    return $temp["name"];
}

function selectCountErroPrice(){
    $temp = db2array("SELECT COUNT(*) FROM `product` as t1 WHERE (SELECT COUNT(*) FROM price_provider WHERE id_product=t1.id AND id_provider=t1.provider)=0 AND t1.provider>0");
    return $temp["COUNT(*)"];
}

function selectXmlClient(){
    $temp = db2array("SELECT id, procent FROM xml_provider", 2);
    $arr = array();
    foreach($temp as $item){
        if($item["id"] == '1'){
            $arr["tyres"] = $item["procent"];
        }elseif ($item["id"] == '2'){
            $arr["disk"] = $item["procent"];
        }
    }
    return $arr;
}
function selectEncashment($page, $num, $from, $to, $region){
    global $posts;
    global $start;
    $query_search="";

    if ($from and $to) {
        $query_search = " WHERE t1.date>='$from 00:00:00' AND t1.date<='$to 23:59:59' ";
        if($region>0){
            $query_search = "AND t1.region='$region' ";
        }
    }
    $posts = selectCount("encashment as t1$query_search");
    $start = strNav($page, $num, $posts);

    return db2array("SELECT t1.id, t1.sum, t1.date, t1.balance, t1.comment, t2.region FROM encashment as t1 LEFT JOIN region as t2 on(t1.region=t2.id)$query_search ORDER BY t1.date DESC LIMIT $start, $num", 2);
}
function cashboxReturn($region){
    $temp = db2array("SELECT date, balance FROM `encashment` WHERE region='$region' ORDER BY date DESC LIMIT 1");
    $sumT = db2array("SELECT t2.id, t2.in_card, t2.prepayment FROM orders as t2 WHERE t2.id_status='4' AND t2.date_end>='$temp[date]' AND t2.summ='0' AND t2.region='$region'", 2);

    $sale = db2array("SELECT SUM(t2.summ) FROM orders as t2 WHERE t2.id_status='4' AND t2.date_end>='$temp[date]' AND t2.summ>'0' AND t2.region='$region'");

    $sum = 0;
    foreach($sumT as $item) {
        $sumTO = db2array("SELECT t1.price, t1.quantity FROM order_product as t1 WHERE t1.id_order='$item[id]'", 2);
        $sumOR = 0;
        foreach ($sumTO as $it) {
            $sumOR += $it["price"] * $it["quantity"];
            //echo "<br>";
        }
        if($item['in_card'] == '1'){
            $sumOR = $sumOR - $item['prepayment'];
        }
        $sum += $sumOR;
    }

    return $sum+$sale["SUM(t2.summ)"];
}
function cashbox($region){
    $temp = db2array("SELECT date, balance FROM `encashment` WHERE region='$region' ORDER BY date DESC LIMIT 1");
    $sumT = db2array("SELECT t2.id, t2.in_card, t2.prepayment, t2.summ, t2.beznal FROM orders as t2 WHERE t2.id_status='1' AND t2.date_end>='$temp[date]' AND t2.region='$region'", 2);

    $sum = 0;
    foreach($sumT as $item) {
        if($item["beznal"] == 0) {
            if ($item["summ"] > 0) {
                $sum += $item["summ"];
            } else {
                $sumTO = db2array("SELECT t1.price, t1.quantity FROM order_product as t1 WHERE t1.id_order='$item[id]'", 2);
                foreach ($sumTO as $it) {
                    $sum += $it["price"] * $it["quantity"];
                }
            }
            if ($item['in_card'] == '1') {
                $sum -= $item['prepayment'];
            }
        }
    }

    return $temp["balance"]+$sum;
}
function sSumBezNal($from, $to, $manager, $region){
    if(!empty($manager)){
        $man_query = " AND t2.id_admin='$manager'";
    }
    if(!empty($region)){
        $reg_query = " AND t2.region='$region'";
    }
    $temp = db2array("SELECT t1.price, t1.quantity FROM order_product as t1 LEFT JOIN orders as t2 on(t1.id_order=t2.id)WHERE t2.id_status='1' AND t2.date_end>='$from 00:00:00' AND t2.date_end<='$to 23:59:59' AND t2.summ='0' AND beznal='1'$man_query$reg_query", 2);
    $sale = db2array("SELECT t2.summ FROM order_product as t1 LEFT JOIN orders as t2 on(t1.id_order=t2.id)WHERE t2.id_status='1' AND t2.date_end>='$from 00:00:00' AND t2.date_end<='$to 23:59:59' AND t2.summ>'0' AND beznal='1'$man_query$reg_query GROUP BY t2.id", 2);
    $sum = 0;
    foreach($temp as $item) {
        $sum+=$item["price"]*$item["quantity"];
    }
    foreach($sale as $itemS) {
        $sum+=$itemS["summ"];
    }
    return $sum;
}

function sSumBezNalReturn($from, $to, $manager, $region){
  if(!empty($manager)){
    $man_query = " AND t2.id_admin='$manager'";
  }
  if(!empty($region)){
    $reg_query = " AND t2.region='$region'";
  }
  $temp = db2array("SELECT t1.price, t1.quantity FROM order_product as t1 LEFT JOIN orders as t2 on(t1.id_order=t2.id)WHERE t2.id_status='4' AND t2.date_end>='$from 00:00:00' AND t2.date_end<='$to 23:59:59' AND t2.summ='0' AND beznal='1'$man_query$reg_query", 2);
  $sale = db2array("SELECT t2.summ FROM order_product as t1 LEFT JOIN orders as t2 on(t1.id_order=t2.id)WHERE t2.id_status='4' AND t2.date_end>='$from 00:00:00' AND t2.date_end<='$to 23:59:59' AND t2.summ>'0' AND beznal='1'$man_query$reg_query GROUP BY t2.id", 2);
  $sum = 0;
  foreach($temp as $item) {
    $sum+=$item["price"]*$item["quantity"];
  }
  foreach($sale as $itemS) {
    $sum+=$itemS["summ"];
  }
  return $sum;
}

function sSumNal($from, $to, $manager, $region){
    if(!empty($manager)){
        $man_query = " AND t2.id_admin='$manager'";
    }
    if(!empty($region)){
        $reg_query = " AND t2.region='$region'";
    }

    $temp = db2array("SELECT t1.price, t1.quantity FROM order_product as t1 LEFT JOIN orders as t2 on(t1.id_order=t2.id)WHERE t2.id_status='1' AND t2.date_end>='$from 00:00:00' AND t2.date_end<='$to 23:59:59' AND t2.summ='0' AND beznal='0'$man_query$reg_query", 2);
    $sale = db2array("SELECT t2.summ FROM order_product as t1 LEFT JOIN orders as t2 on(t1.id_order=t2.id)WHERE t2.id_status='1' AND t2.date_end>='$from 00:00:00' AND t2.date_end<='$to 23:59:59' AND t2.summ>'0' AND beznal='0'$man_query$reg_query GROUP BY t2.id", 2);
    $sum = 0;

    foreach($temp as $item) {
        $sum+=$item["price"]*$item["quantity"];
    }
    foreach($sale as $itemS) {
        $sum+=$itemS["summ"];
    }
    return $sum;
}

function sSumNalReturn($from, $to, $manager, $region){
  if(!empty($manager)){
    $man_query = " AND t2.id_admin='$manager'";
  }
  if(!empty($region)){
    $reg_query = " AND t2.region='$region'";
  }

  $temp = db2array("SELECT t1.price, t1.quantity FROM order_product as t1 LEFT JOIN orders as t2 on(t1.id_order=t2.id)WHERE t2.id_status='4' AND t2.date_end>='$from 00:00:00' AND t2.date_end<='$to 23:59:59' AND t2.summ='0' AND beznal='0'$man_query$reg_query", 2);
  $sale = db2array("SELECT t2.summ FROM order_product as t1 LEFT JOIN orders as t2 on(t1.id_order=t2.id)WHERE t2.id_status='4' AND t2.date_end>='$from 00:00:00' AND t2.date_end<='$to 23:59:59' AND t2.summ>'0' AND beznal='0'$man_query$reg_query GROUP BY t2.id", 2);
  $sum = 0;

  foreach($temp as $item) {
    $sum+=$item["price"]*$item["quantity"];
  }
  foreach($sale as $itemS) {
    $sum+=$itemS["summ"];
  }
  return $sum;
}

function sSumInCard($from, $to, $manager, $region){
    if(!empty($manager)) {
        $man_query = " AND t2.id_admin='$manager'";
    }
    if(!empty($region)){
        $reg_query = " AND t2.region='$region'";
    }
    $temp = db2array("SELECT SUM(t2.prepayment) FROM orders as t2 WHERE t2.date_end>='$from 00:00:00' AND t2.date_end<='$to 23:59:59' AND t2.in_card='1'$man_query$reg_query");
    return $temp["SUM(t2.prepayment)"];
}
function sSumInCardReturn($from, $to, $manager, $region){
  if(!empty($manager)) {
    $man_query = " AND t2.id_admin='$manager'";
  }
  if(!empty($region)){
    $reg_query = " AND t2.region='$region'";
  }
  $temp = db2array("SELECT SUM(t2.prepayment) FROM orders as t2 WHERE t2.id_status='4' AND t2.date_end>='$from 00:00:00' AND t2.date_end<='$to 23:59:59' AND t2.in_card='1'$man_query$reg_query");
  return $temp["SUM(t2.prepayment)"];
}

function selectManager(){
    return db2array("SELECT id, login, name FROM `admin_user`", 2);
}
function sumQuantityOrderByManager($from, $to, $manager) {
    if(!empty($manager)){
        $man_query = " AND t2.id_admin='$manager'";
    }

    $temp = db2array("SELECT SUM(t1.quantity) FROM orders as t2 LEFT JOIN order_product as t1 on(t1.id_order=t2.id) WHERE t2.date_end>='$from 00:00:00' AND t2.date_end<='$to 23:59:59' AND t2.id_status='1'$man_query");
    return $temp["SUM(t1.quantity)"];
}
function selectMarginalityOrder($from, $to, $manager){
    if(!empty($manager)){
        $man_query = " AND t2.id_admin='$manager'";
    }
    $temp = db2array("SELECT t1.price_clear, t1.quantity FROM order_product as t1 LEFT JOIN orders as t2 on(t1.id_order=t2.id)WHERE t2.id_status='1' AND t2.date_end>='$from 00:00:00' AND t2.date_end<='$to 23:59:59'$man_query", 2);
    $sum = 0;
    foreach($temp as $item) {
        $sum+=$item["price_clear"]*$item["quantity"];
    }
    $sSummSale = sSummSaleOrderByDate($from, $to, $manager, $region);
    $sSummOrder = sSummOrderByDate($from, $to, $manager, $region);
    if($sSummSale > 0){
        $summOrder = $sSummOrder - $sSummSale;
    }else{
        $summOrder = $sSummOrder;
    }

    $sFinal =  $summOrder - $sum;
    return $sFinal;
}
function selectRegion(){
    return db2array("SELECT id, region FROM `region`", 2);
}
function sRegionById($id){
  return db2array("SELECT id, region FROM `region` WHERE id='$id'");
}

function selectProductStorage($page, $num, $name, $article, $categories, $region){
    global $posts;
    global $start;

    $query_search = "";
    if(!empty($name)) {
        $query_search.=" AND (t2.name LIKE '%".$name."%')";
    }

    if(!empty($categories))  {
        $arrCat = recusiveCatSection($categories);
        $query_search.=" AND t2.categories IN (";
        $n = 1;
        foreach ($arrCat as $iCat){
            if($n>1) $query_search.=", ";
            $query_search.= $iCat;
            $n++;
        }
        $query_search.= ")";
    }
    if(!empty($article))  {
        $query_search.=" AND t2.article='$article'";
    }

    if($region == '1'){
        $id_provider = "7";
    }elseif($region == '2'){
        $id_provider = "8";
    }elseif($region == '3'){
        $id_provider = "11";
    }

    $posts = selectCount("price_provider as t1 LEFT JOIN product as t2 on(t1.id_product=t2.id) WHERE t1.id_provider='$id_provider'$query_search");
    $start = strNav($page, $num, $posts);

    return db2array("SELECT t2.id, t2.name, t1.price, t1.price_clear, t1.availability, t2.article  FROM price_provider as t1 LEFT JOIN product as t2 on(t1.id_product=t2.id) WHERE t1.id_provider='$id_provider'$query_search ORDER BY t1.date DESC LIMIT $start, $num", 2);
}
function selectProductStorageInWork($page, $num, $name, $article, $categories, $region){
    global $posts;
    global $start;

    $query_search = "";
    if(!empty($name)) {
        $query_search.=" AND (t2.name LIKE '%".$name."%')";
    }

    if(!empty($categories))  {
        $arrCat = recusiveCatSection($categories);
        $query_search.=" AND t2.categories IN (";
        $n = 1;
        foreach ($arrCat as $iCat){
            if($n>1) $query_search.=", ";
            $query_search.= $iCat;
            $n++;
        }
        $query_search.= ")";
    }
    if(!empty($article))  {
        $query_search.=" AND t2.article='$article'";
    }

    $posts = db2array("SELECT COUNT(DISTINCT t2.article) as kol FROM order_product as t1 LEFT JOIN product as t2 on(t1.product_id=t2.id) LEFT JOIN orders as t3 on(t1.id_order=t3.id) WHERE t1.in_storage='$region' AND t3.id_status!='1' AND t3.id_status!='3'$query_search");
    $posts = $posts["kol"];
    $start = strNav($page, $num, $posts);

    return db2array("SELECT t2.id, t1.name, t1.price, t1.code, t1.price_clear, (SELECT SUM(t5.quantity) FROM order_product as t5 LEFT JOIN product as t7 on(t5.product_id=t7.id) LEFT JOIN orders as t8 on(t5.id_order=t8.id) WHERE t8.region='$region' AND t5.in_storage='$region' AND t8.id_status!='1' AND t8.id_status!='3' AND t7.article=t2.article$query_search) as quantity, t2.article, t3.order_phone, t1.id_order FROM order_product as t1 LEFT JOIN product as t2 on(t1.product_id=t2.id) LEFT JOIN orders as t3 on(t1.id_order=t3.id) WHERE t1.in_storage='$region' AND t3.id_status!='1' AND t3.id_status!='3'$query_search GROUP BY t2.article ORDER BY t3.date DESC LIMIT $start, $num", 2);
}
function sumStorageFree($region){
    if($region == '1'){
        $id_provider = "7";
    }elseif($region == '2'){
        $id_provider = "8";
    }
    $temp = db2array("SELECT SUM(availability) as kol FROM price_provider  WHERE id_provider='$id_provider'");
    return $temp["kol"];
}
function sumStorageInWork($region){
    $temp = db2array("SELECT SUM(t1.quantity) as kol FROM order_product as t1 LEFT JOIN orders as t3 on(t1.id_order=t3.id) WHERE t1.in_storage='$region' AND t3.id_status!='1' AND t3.id_status!='3'");
    return $temp["kol"];
}
function sumOrderReal($id){
    $temp = db2array("SELECT summ FROM orders WHERE id='$id'");
    if($temp["summ"]> 0){
        return $temp["summ"];
    }else{
        return selectSummOrderById($id);
    }
}
function checkStorage($id){
    $temp = db2array("SELECT in_storage FROM order_product WHERE id_order='$id'", 2);
    $result = 0;
    foreach($temp as $item){
        if($item["in_storage"] == 0){
            $result = 1;
        }
    }
    return $result;
}
function selectCountPriceBufer(){
    $temp = db2array("SELECT COUNT(*) FROM price_provider_bufer");
    return $temp["COUNT(*)"];
}
function sendSMS($phone, $text, $id_order){
    $phone = str_replace("+","", $phone);
    $phone = str_replace("(","", $phone);
    $phone = str_replace(")","", $phone);
    $phone = str_replace("-","", $phone);
    $phone = str_replace(" ","", $phone);
    $ph = explode(",", $phone);
    $phone = $ph[0];
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
function selectSmsByOrder($id){
    return db2array("SELECT text, date  FROM sms WHERE id_order='$id' ORDER BY date DESC", 2);
}
function selectProductByArtiсleForCSV($article, $i){
    $temp = db2array("SELECT t1.id, t4.name as name_cat FROM product as t1 LEFT JOIN categories as t3 on(t1.categories=t3.id) LEFT JOIN categories as t4 on(t3.section=t4.id) WHERE t1.active='1' AND t1.article='$article'");
    if($i == "1"){
        $fil = "20";
    }elseif($i == "2"){
        $fil = "25";
    }
    $dim = db2array("SELECT t3.value FROM filter_value as t1 LEFT JOIN filter as t2 on (t1.id_filter=t2.id) LEFT JOIN element_filter as t3 on (t1.element_value=t3.id) WHERE id_product='$temp[id]' AND t1.id_filter='$fil'");
    if($i == "1"){
        $sen = db2array("SELECT t3.id FROM filter_value as t1 LEFT JOIN filter as t2 on (t1.id_filter=t2.id) LEFT JOIN element_filter as t3 on (t1.element_value=t3.id) WHERE id_product='$temp[id]' AND t1.id_filter='23'");

        if ($sen["id"] == "156") {
            $season = "w";
        } elseif ($sen["id"] == "155") {
            $season = "s";
        } elseif ($sen["id"] == "157") {
            $season = "u";
        }
    }
    return $res = array(
        "brand" => $temp["name_cat"],
        "diameter" => $dim["value"],
        "season" => $season
    );
}
function sumByStatus($status, $region){
    $wr_reg = "";
    if($region){
        $wr_reg = " AND t1.region='$region'";
    }
    if($_GET[from] AND $_GET[to]){
        $wr_d = " AND t1.date>='$_GET[from] 00:00:00' AND t1.date<='$_GET[to] 23:59:59'";
    }

    $temp = db2array("SELECT t1.id, t1.summ FROM orders as t1 WHERE t1.id_status='$status'$wr_reg$wr_d", 2);
    $summ = 0;
    foreach($temp as $item){
        if ($item['summ'] > 0) {
            $summ+=$item['summ'];
        } else {
            $summ+=selectSummOrderById($item["id"]);
        }
    }
    return $summ;
}

function sUserWorkTime($page, $num, $from, $to, $manager){
  global $posts;
  global $start;
  $query_search="";

  if ($from and $to) {
    if (!empty($query_search)) $query_search .= "AND";
    $query_search .= " t1.date_start>='$from 00:00:00' AND t1.date_end<='$to 23:59:59' ";
  }

  if (!empty($manager)) {
    if (!empty($query_search)) $query_search .= "AND";
    $query_search .= " t1.id_user='".$manager."' ";
  }

  if(!empty($query_search)){
    $query_search = 'WHERE '.$query_search;
  }

  $posts = selectCount("user_work_time as t1 
      LEFT JOIN admin_user as t2 on (t1.id_user = t2.id) 
      LEFT JOIN admin_group as t3 on (t2.id_group = t3.id)
     $query_search");
  $start = strNav($page, $num, $posts);

  return db2array("SELECT t2.name, t1.date_start, t1.date_end, t3.name as name_group, t1.robot FROM user_work_time as t1 
    LEFT JOIN admin_user as t2 on (t1.id_user = t2.id) 
    LEFT JOIN admin_group as t3 on (t2.id_group = t3.id)
  $query_search ORDER BY t1.id DESC LIMIT $start, $num", 2);
}

function sLastUserAdmin($id_admin){
  $temp = db2array("SELECT COUNT(*) FROM user_work_time WHERE id_user='$id_admin' AND date_end='0000-00-00 00:00:00'");
  return $temp['COUNT(*)'];
}

function sTimeUserAdmin($id_admin){
  $temp = db2array("SELECT date_start FROM user_work_time WHERE id_user='$id_admin' AND date_end='0000-00-00 00:00:00'");
  return $temp['date_start'];
}

function sLast2OrderByPhoneOrName($phone, $name, $id){
  return db2array("SELECT t1.id, t2.name as name_status, t2.code, t1.comments FROM `orders` as t1 LEFT JOIN status as t2 on (t1.id_status = t2.id) WHERE t1.id != '$id' AND t1.phone = '$phone' ORDER BY t1.id DESC LIMIT 3", 2);
}

function sLastCommetnsAdminByOrderId($id){
  return db2array("SELECT comments FROM orders WHERE id='$id'");
}

function lastCommentsOrder($comm){
  $arrComm = explode('^', $comm);
  $arrComm = array_filter($arrComm);
  foreach ($arrComm as $lastComm){
    if ($lastComm == end($arrComm)) {
      $comment = explode(';', $lastComm);
      echo $comment[2];
    }
  }
}

function lastCommentsDateOrder($comm){
    $arrComm = explode('^', $comm);
    $arrComm = array_filter($arrComm);
    foreach ($arrComm as $lastComm){
        if ($lastComm == end($arrComm)) {
            $comment = explode(';', $lastComm);
            echo date("Y-m-d", strtotime($comment[1]));
        }
    }
}

function selectTemplatesSMS(){
    return db2array("SELECT id, text FROM templatesSMS", 2);
}
function selectTemplatesSMSById($id){
    return db2array("SELECT text FROM templatesSMS WHERE id='$id'");
}

function selectXMLGift($page, $num, $type){
    global $posts;
    global $start;

    $posts = selectCount("xml_gift as t1 WHERE t1.type='$type'");
    $start = strNav($page, $num, $posts);

    return db2array("SELECT t1.id, t1.name, t1.active FROM xml_gift as t1 WHERE t1.type='$type' ORDER BY t1.id DESC LIMIT $start, $num", 2);
}

function selectXMLGiftById($id){
    return db2array("SELECT `name`, `type`, `brand`, `diameter`, `season`, `product`, `active` FROM xml_gift WHERE id='$id'");
}

function selectActiveGift(){
    return db2array("SELECT `id`, `name`, `type`, `brand`, `diameter`, `season`, `product` FROM xml_gift WHERE active='1'", 2);
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
function selectGiftProvider($page, $num, $brand, $diameter){
    global $posts;
    global $start;

    $posts = selectCount("gift_provider as t1 WHERE t1.type='1'$wr_br$wr_dim");
    $start = strNav($page, $num, $posts);

    return db2array("SELECT t1.id, t1.gift, t4.name as provider 
                FROM gift_provider as t1
                LEFT JOIN provider as t4 on (t1.provider=t4.id) 
                WHERE t1.type='1'$wr_br$wr_dim ORDER BY t1.id DESC LIMIT $start, $num", 2);
}

function selectGiftProviderById($id){
    return db2array("SELECT t1.gift, t1.provider FROM gift_provider as t1 WHERE t1.id='$id'");
}

function selectGiftProviderByOrder($id){
    $temp = db2array("SELECT t1.product_id FROM order_product as t1 WHERE t1.id_order='$id'", 2);
    $gift_res = '';
    foreach($temp as $item){
        $product = db2array("SELECT t2.section, t3.element_value as diameter, t4.element_value as season
                              FROM product as t1 
                              LEFT JOIN categories as t2 on(t1.categories=t2.id)
                              LEFT JOIN filter_value as t3 on(t1.id=t3.id_product)
                              LEFT JOIN filter_value as t4 on(t1.id=t4.id_product)
                              WHERE t1.id='$item[product_id]' AND t3.id_filter='20' AND t4.id_filter='23'");

        $gift = db2array("SELECT t2.name, t1.gift 
		FROM gift_provider as t1 
		LEFT JOIN provider as t2 on(t1.provider=t2.id) 
		LEFT JOIN gift_provider_brand as t3 on(t1.id=t3.id_gift)
		 LEFT JOIN gift_provider_diameter as t4 on(t1.id=t4.id_gift)
		 LEFT JOIN gift_provider_season as t5 on(t1.id=t5.id_gift)
		WHERE t3.id_brand='$product[section]' AND t4.id_diameter='$product[diameter]' AND t1.type='1' AND t5.id_season='$product[season]'");
        if($gift["gift"]){
            $gift_res.= $gift["gift"]." - ".$gift["name"]."<br>";
        }
    }
    return $gift_res;
}

function selectGiftProviderBrandById($id){
    $temp =  db2array("SELECT id_brand FROM gift_provider_brand WHERE id_gift='$id'", 2);
    $res = array();
    foreach ($temp as $item){
        $res[] = $item["id_brand"];
    }
    return $res;
}

function selectGiftProviderDiameterById($id){
    $temp =  db2array("SELECT id_diameter FROM gift_provider_diameter WHERE id_gift='$id'", 2);
    $res = array();
    foreach ($temp as $item){
        $res[] = $item["id_diameter"];
    }
    return $res;
}

function selectGiftProviderSeasonById($id){
    $temp =  db2array("SELECT id_season FROM gift_provider_season WHERE id_gift='$id'", 2);
    $res = array();
    foreach ($temp as $item){
        $res[] = $item["id_season"];
    }
    return $res;
}

function sGoodsMovement($page, $num, $region, $provider, $vc){
  global $posts;
  global $start;

  $query_search="";

  if (!empty($region)) {
    if (!empty($query_search)) $query_search .= "AND";
    $query_search .= " t1.region='".$region."' ";
  }
  if (!empty($provider)) {
    if (!empty($query_search)) $query_search .= "AND";
    $query_search .= " t5.provider='".$provider."' ";
  }
  if($vc == 1){
      $status = "t1.id_status = '11'";
  }else{
      $status = "(t1.id_status = '2' OR t1.id_status = '15')";
  }

  if(!empty($query_search)){
    $query_search = " WHERE ".$status." AND t5.price > 0 AND ".$query_search;
  }else{
    $query_search = " WHERE ".$status." AND t5.price > 0";
  }

  $temp = db2array("SELECT COUNT(DISTINCT t1.id) as kol FROM orders as t1 LEFT JOIN status as t2 on(t1.id_status = t2.id) LEFT JOIN order_product as t5 on (t1.id = t5.id_order) $query_search ");
  $posts = $temp["kol"];
  $start = strNav($page, $num, $posts);

  return db2array("SELECT t1.id, t1.delivery, t1.date, t1.phone, t1.date_end, t1.id_user, t1.summ, t2.code, t2.name as name_status, t3.name as name_user, t1.order_phone, t1.name as name_order, t1.comments, t4.region as name_region, t5.name as name_prod, t5.quantity, t5.price, t5.price_clear, t5.id as id_order_prod, t5.in_storage, t1.region FROM orders as t1 
			LEFT JOIN status as t2 on(t1.id_status = t2.id) 
			LEFT JOIN users as t3 on(t1.id_user = t3.id)
			LEFT JOIN region as t4 on(t1.region=t4.id) 
			LEFT JOIN order_product as t5 on (t1.id = t5.id_order)
		$query_search ORDER BY t5.product_id DESC, t1.id ASC LIMIT $start, $num", 2);
}

function selectNameRegion($id){
    $temp = db2array("SELECT region FROM region WHERE id='$id'");
    return $temp["region"];
}

function selectNameSender($id){
    $temp = db2array("SELECT name FROM sender WHERE id='$id'");
    return $temp["name"];
}
function selectLogShipments($page, $num, $from, $to){
    global $posts;
    global $start;
    $query_search="";

    if ($from and $to) {
        $query_search = " WHERE t1.date_ship>='$from 00:00:00' AND t1.date_ship<='$to 23:59:59' ";
    }
    $posts = selectCount("log_shipments as t1$query_search");
    $start = strNav($page, $num, $posts);

    $temp = db2array("SELECT t1.id, t1.date_ship, t1.trans_company, t1.summ, t1.recipient, t1.number, t3.login as manager, t1.internal, t1.id_order, t1.delivery, t1.sender 
                FROM log_shipments as t1 
                LEFT JOIN admin_user as t3 on(t1.manager=t3.id)
                $query_search ORDER BY t1.date_ship DESC LIMIT $start, $num", 2);

    $res = array();
    foreach ($temp as $item) {
        if($item["internal"] == '1'){
            $sender = selectNameRegion($item["sender"]);
            $recipient = selectNameRegion($item["recipient"]);
        }else{
            $sender = selectNameSender($item["sender"]);
            $recipient = $item["recipient"];
        }

        $res[] = array(
            "id" => $item["id"],
            "date_ship" => $item["date_ship"],
            "trans_company" => $item["trans_company"],
            "summ" => $item["summ"],
            "recipient" => $recipient,
            "number" => $item["number"],
            "manager" => $item["manager"],
            "internal" => $item["internal"],
            "id_order" => $item["id_order"],
            "delivery" => $item["delivery"],
            "sender" => $sender
        );
    }
    return $res;
}

function selectSender(){
    return db2array("SELECT id, name FROM sender", 2);
}

function selectLogShipmentsById($id){
    return db2array("SELECT t1.id, t1.date_ship, t1.trans_company, t1.summ, t1.recipient, t1.number, t1.manager, t1.internal, t1.id_order, t1.delivery, t1.sender FROM log_shipments as t1 WHERE t1.id='$id'");
}

function selectLogShipmentsMarking($id, $internal){
    return db2array("SELECT t1.id, t1.date_ship, t1.trans_company, t1.summ, t1.recipient, t1.number, t1.manager, t1.internal, t1.id_order, t1.delivery, t1.sender, t2.name, t2.address, t2.INN, t2.phone 
                    FROM log_shipments as t1
                    LEFT JOIN orders as t2 on(t1.id_order=t2.id) 
                    WHERE t1.id_order='$id' AND t1.internal='$internal'");
}

function selectPhoneOffice($id){
    if($id == "1"){
        $table = 'settings';
    }else{
        $table = 'office_contact';
    }
    $temp = db2array("SELECT phone FROM $table WHERE id='$id'");
    return $temp["phone"];
}
function checkLogShipment($id, $internal){
    $temp = db2array("SELECT COUNT(*) 
                    FROM log_shipments as t1
                    LEFT JOIN orders as t2 on(t1.id_order=t2.id) 
                    WHERE t1.id_order='$id' AND t1.internal='$internal'");
    return $temp["COUNT(*)"];
}

function selectRegionUser(){
    $id = selectWhatUser();
    return db2array("SELECT t2.id, t2.region FROM admin_region as t1 LEFT JOIN region as t2 on(t1.id_region=t2.id) WHERE t1.id_admin='$id'", 2);
}

function selectIdRegionUser($id){
   $res = array();
   $temp = db2array("SELECT t2.id FROM admin_region as t1 LEFT JOIN region as t2 on(t1.id_region=t2.id) WHERE t1.id_admin='$id'", 2);

   foreach($temp as $item){
       $res[] = $item["id"];
   }
   return $res;
}

function selectProdLogShipment($id){
    $temp = db2array("SELECT t2.name FROM log_shipments_product as t1 LEFT JOIN order_product as t2 on(t1.id_product=t2.id) WHERE t1.id_log='$id'", 2);
    $res ='';
    $i = 1;
    foreach ($temp as $item){
        if($i>1)  $res.="<br>";
        $res.= $item["name"];
        $i++;
    }
    return $res;
}

function selectPrepayment($page, $num, $from, $to, $status){
    global $posts;
    global $start;
    $query_search="";

    if($status == "1"){
        $query_search.= " t1.status IN (0,1) ";
    }else{
        $query_search.= " t1.status='0'";
    }
    if ($from and $to) {
        $query_search.= " AND t1.date>='$from 00:00:00' AND t1.date<='$to 23:59:59' ";
    }
    $posts = selectCount("prepayment as t1 WHERE $query_search");
    $start = strNav($page, $num, $posts);

    return db2array("SELECT t1.id, t1.order_id, t1.summ, t1.date, t1.status, t3.region
                FROM prepayment as t1 
                LEFT JOIN orders as t2 on(t1.order_id=t2.id)
                LEFT JOIN region as t3 on(t2.region=t3.id)
                WHERE $query_search ORDER BY t1.date DESC LIMIT $start, $num", 2);
}

function selectCashless($page, $num, $from, $to, $status){
    global $posts;
    global $start;
    $query_search="";

    if($status == "1"){
        $query_search.= "";
    }else{
        $query_search.= " AND t1.id_status='11'";
    }
    if ($from and $to) {
        $query_search.= " AND t1.date>='$from 00:00:00' AND t1.date<='$to 23:59:59' ";
    }

    $posts = selectCount("orders as t1 WHERE t1.beznal='1'$query_search");
    $start = strNav($page, $num, $posts);

    return db2array("SELECT t1.id, t1.summ, t1.date, t1.name, t1.id_user, t2.nomer, t2.date as date_cashless FROM orders as t1 LEFT JOIN cashless as t2 on(t2.id_order=t1.id) WHERE t1.beznal='1'$query_search ORDER BY t1.date ASC LIMIT $start, $num", 2);
}

function selectAllProductBasket($page, $num, $search){
  global $posts;
  global $start;

  $search = clearData($search);
  if ($search != "") {
    $query_search .= 'WHERE t4.name = "'.$search.'"';
  }

  $posts = selectCount("basket as t1 
    LEFT JOIN product as t2 on (t1.product_id = t2.id)
    LEFT JOIN user_session as t3 on (t1.customer = t3.sid) 
    LEFT JOIN users as t4 on (t3.id_user = t4.id)
  $query_search");
  $start = strNav($page, $num, $posts);

  return db2array("SELECT t1.quantity, t1.date, t2.name as name_prod, t4.name as name_user, t1.product_id, t4.id as user_id FROM basket as t1 
    LEFT JOIN product as t2 on (t1.product_id = t2.id) 
    LEFT JOIN user_session as t3 on (t1.customer = t3.sid)
    LEFT JOIN users as t4 on (t3.id_user = t4.id)
  $query_search ORDER BY t1.id DESC LIMIT $start, $num", 2);
}

function selectBasketByUserId($id_user, $start, $num){
  return db2array("SELECT t1.quantity, t1.date, t2.name as name_book, t4.name as name_user, t1.product_id, t4.id as user_id FROM basket as t1 
    LEFT JOIN product as t2 on (t1.product_id = t2.id) 
    LEFT JOIN user_session as t3 on (t1.customer = t3.sid)
    LEFT JOIN users as t4 on (t3.id_user = t4.id)
  WHERE t4.id ='$id_user' ORDER BY t1.id DESC LIMIT $start, $num", 2);
}

function selectInvoice($page, $num, $from, $to){
    global $posts;
    global $start;
    $query_search="";

    if ($from and $to) {
        $query_search.= " WHERE t1.date_invoice>='$from 00:00:00' AND t1.date_invoice<='$to 23:59:59' ";
    }

    $posts = selectCount("invoices as t1$query_search");
    $start = strNav($page, $num, $posts);

    return db2array("SELECT t1.id, t1.num_invoice, t1.date_invoice FROM invoices as t1$query_search ORDER BY t1.date_invoice ASC LIMIT $start, $num", 2);
}
function selectInvoiceProduct($id){
    return db2array("SELECT t1.id, t1.id_order, t2.name, t2.price, t2.price_clear, t2.quantity, t3.name as provider FROM invoice_prod as t1 LEFT JOIN order_product as t2 on(t1.id_order_prod=t2.id) LEFT JOIN provider as t3 on(t2.provider=t3.id) WHERE t1.id_invoice='$id'", 2);
}

function selectCashlessById($id){
    $temp = db2array("SELECT nomer, date FROM cashless WHERE id_order='$id'");
    if($temp){
        return "Оплачено: ".$temp["nomer"]." | ".$temp["date"];
    }
}

function selectDopArticles($id){
    $temp = db2array("SELECT article FROM product_articles WHERE id_product='$id'", 2);
    if($temp){
        $i=0;
        $res = "";
        foreach ($temp as $item){
            if($i>0) $res.=",";
            $res.=$item["article"];
            $i++;
        }
        return $res;
    }
}

function selectCountDublFil(){
  //$temp = db2array("SELECT COUNT(DISTINCT t1.id_product) as kol FROM `filter_value` as t1 WHERE (SELECT COUNT(*) FROM filter_value WHERE id_product=t1.id_product)>5");
  return $temp["kol"];
}