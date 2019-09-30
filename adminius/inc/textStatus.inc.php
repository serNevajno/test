<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST["id"])){
        $email_text = clearData($_POST['email_text']);
        $sms_text = clearData($_POST['sms_text']);

        $id = clearData($_POST['id'], "i");

        mysql_query("UPDATE status SET email_text='$email_text', sms_text='$sms_text' WHERE id='$id'") or die(mysql_error());

         header( "Location: index.php?code=textStatus" );
         exit;
    }

}
?>