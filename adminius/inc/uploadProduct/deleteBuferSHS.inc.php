<?session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php');
/////Подключение библиотеки
include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/function.inc.php');

/////Замок
include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/lock.inc.php');


mysql_query("TRUNCATE TABLE `bufer_shs` ");
?>