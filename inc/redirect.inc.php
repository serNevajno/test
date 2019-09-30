<?php
if($_SERVER['HTTP_HOST'] != 'dobrayashina.ru'){
    $redirect = 'http://dobrayashina.ru'. $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $redirect);
    exit();
}