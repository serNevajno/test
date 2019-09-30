<?php
if (isset($_POST['id'])) {
  
  $id = clearData($_POST['id']);
  $comments = clearData($_POST['comments']);
  $date = date('Y-m-d H:i:s');
  $id_admin = selectWhatUser();
  $nameAdmin = selectWhatUserNameAdmin();
  $lastComm = sLastCommetnsAdminByOrderId($id)['comments'];

  if($lastComm){
    $lastComm = $lastComm."\r\n";
  }

  $comm = $lastComm.$nameAdmin.";".$date.";".$comments."^";


  mysql_query("UPDATE `orders` SET `comments`='$comm' WHERE id='$id'");


  header('Location: /adminius/index.php?code=orders&action=edit&id='.$id);
  exit;

}
?>