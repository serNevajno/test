<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php');
/////Подключение библиотеки
include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/function.inc.php');
include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/lock.inc.php');
    $callback = $_GET['CKEditorFuncNum'];
    $file_name = $_FILES['upload']['name'];
	$new_file_name = time()."_".$file_name;
    $file_name_tmp = $_FILES['upload']['tmp_name'];
    $file_new_name = $_SERVER['DOCUMENT_ROOT'].'/images/';
    $full_path = $file_new_name.$new_file_name;
    $http_path = '/images/'.$new_file_name;
    $error = '';
    if( move_uploaded_file($file_name_tmp, $full_path) ) {
    } else {
     $error = 'Some error occured please try again later';
     $http_path = '';
    }
    echo "<script type=\"text/javascript\">window.parent.CKEDITOR.tools.callFunction(".$callback.",  \"".$http_path."\", \"".$error."\" );</script>";
?>