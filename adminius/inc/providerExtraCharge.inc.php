<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){

  $ctn = count($_POST['id']);
  for($j=0; $j<$ctn; $j++){
    $extra_charge = $_POST['extra_charge'][$j];
    $id = $_POST['id'][$j];
    $sql3 = "UPDATE `provider` SET `extra_charge`='$extra_charge' WHERE id = '$id'";
    mysql_query($sql3) or die(mysql_error());
    if($sql3){
      $result = "#true";
    }else{
      $result = "#false";
    }
  }
  header('Location: /adminius/index.php?code=provider_extra_charge'.$result);
  exit;
}