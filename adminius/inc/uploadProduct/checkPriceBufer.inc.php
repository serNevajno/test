<?if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    include($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');

    /////Подключение библиотеки
    include($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/function.inc.php');
    include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/uploadProduct/upFunc.inc.php');

    /////Замок
    include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/lock.inc.php');

    $provider = db2array("SELECT id_provider FROM `price_provider_bufer` GROUP BY id_provider", 2);

    foreach ($provider as $iProv){
        mysql_query("DELETE FROM `price_provider` WHERE id_provider='$iProv[id_provider]'");
    }
    echo "ok";
}
?>