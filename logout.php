<?php
unset($_COOKIE[PHPSESSID]);
$expire = time() + 7 * 24 * 3600;
$domain = "dobrayashina.ru"; // default domain
$secure = false;
$path = "/";
setcookie("sid", "", $expire, $path, $domain, $secure, true);
session_start();
session_write_close();
session_unset();
//session_destroy();
header("location:/");
exit;
?>