<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if (!isset($_POST["id"])) {
        $type = clearData($_POST['type'], "i");
        $provider = clearData($_POST['provider']);
        $gift = clearData($_POST['gift']);

        mysql_query("INSERT INTO gift_provider (type, provider, gift) VALUES ('$type', '$provider', '$gift')") or die(mysql_error());
        $id_element = mysql_insert_id();
        foreach ($_POST['brand'] as $iBrand){
            mysql_query("INSERT INTO `gift_provider_brand`(`id_brand`, `id_gift`) VALUES ('$iBrand','$id_element')");
        }

        foreach ($_POST['diameter'] as $iDiameter){
            if($iDiameter == '0'){
                mysql_query("DELETE FROM `gift_provider_diameter` WHERE id_gift='$id_element'");
                foreach (selectValueFilter('20') as $iDiameterAll) {
                    mysql_query("INSERT INTO `gift_provider_diameter`(`id_diameter`, `id_gift`) VALUES ('$iDiameterAll','$id_element')");
                }
                $dEnd =1;
            }
            if($dEnd!='1') {
                mysql_query("INSERT INTO `gift_provider_diameter`(`id_diameter`, `id_gift`) VALUES ('$iDiameter','$id_element')");
            }
        }


        foreach ($_POST['season'] as $iSeason){
            if($iSeason == '0'){
                mysql_query("DELETE FROM `gift_provider_season` WHERE id_gift='$id_element'");
                mysql_query("INSERT INTO `gift_provider_season`(`id_season`, `id_gift`) VALUES ('155','$id_element')");
                mysql_query("INSERT INTO `gift_provider_season`(`id_season`, `id_gift`) VALUES ('156','$id_element')");
                mysql_query("INSERT INTO `gift_provider_season`(`id_season`, `id_gift`) VALUES ('157','$id_element')");
                $sEnd =1;
            }
            if($sEnd!='1') {
                mysql_query("INSERT INTO `gift_provider_season`(`id_season`, `id_gift`) VALUES ('$iSeason','$id_element')");
            }
        }

        if($type == "1"){
                header('Location: index.php?code=gift_provider');
        }else{
                header('Location: index.php?code=gift_provider');
        }
        exit;
    }elseif(isset($_POST["id"]) and isset($_POST['brand']) and isset($_POST['diameter']) and isset($_POST['provider'])){
        $id = clearData($_POST['id']);
        $type = clearData($_POST['type'], "i");
        $provider = clearData($_POST['provider']);
        $gift = clearData($_POST['gift']);

        mysql_query("DELETE FROM `gift_provider_brand` WHERE id_gift='$id'");
        foreach ($_POST['brand'] as $iBrand){
            mysql_query("INSERT INTO `gift_provider_brand`(`id_brand`, `id_gift`) VALUES ('$iBrand','$id')");
        }

        mysql_query("DELETE FROM `gift_provider_diameter` WHERE id_gift='$id'");
        foreach ($_POST['diameter'] as $iDiameter){
            if($iDiameter == '0'){
                mysql_query("DELETE FROM `gift_provider_diameter` WHERE id_gift='$id'");
                foreach (selectValueFilter('20') as $iDiameterAll) {
                    mysql_query("INSERT INTO `gift_provider_diameter`(`id_diameter`, `id_gift`) VALUES ('$iDiameterAll[id]','$id')");
                }
                $dEnd =1;
            }
            if($dEnd!='1') {
                mysql_query("INSERT INTO `gift_provider_diameter`(`id_diameter`, `id_gift`) VALUES ('$iDiameter','$id')");
            }
        }

        mysql_query("DELETE FROM `gift_provider_season` WHERE id_gift='$id'");
        foreach ($_POST['season'] as $iSeason){
            if($iSeason == '0'){
                mysql_query("DELETE FROM `gift_provider_season` WHERE id_gift='$id'");
                mysql_query("INSERT INTO `gift_provider_season`(`id_season`, `id_gift`) VALUES ('155','$id')");
                mysql_query("INSERT INTO `gift_provider_season`(`id_season`, `id_gift`) VALUES ('156','$id')");
                mysql_query("INSERT INTO `gift_provider_season`(`id_season`, `id_gift`) VALUES ('157','$id')");
                $sEnd =1;
            }
            if($sEnd!='1') {
                mysql_query("INSERT INTO `gift_provider_season`(`id_season`, `id_gift`) VALUES ('$iSeason','$id')");
            }
        }

        mysql_query("UPDATE gift_provider SET provider='$provider', gift='$gift' WHERE id='$id'") or die(mysql_error());

        if($type == "1"){
            header('Location: index.php?code=gift_provider');
        }else{
            header('Location: index.php?code=gift_provider');
        }
        exit;
    }elseif(!isset($_POST['brand']) and !isset($_POST['diameter']) and !isset($_POST['provider']) AND isset($_POST['id'])){
        $id = (int)$_POST['id'];
        $type = clearData($_POST['type'], "i");

        mysql_query("DELETE FROM gift_provider WHERE id='$id'") or die(mysql_error());
        mysql_query("DELETE FROM `gift_provider_brand` WHERE id_gift='$id'");
        mysql_query("DELETE FROM `gift_provider_diameter` WHERE id_gift='$id'");
        mysql_query("DELETE FROM `gift_provider_season` WHERE id_gift='$id'");
        if($type == "1"){
            header('Location: index.php?code=gift_provider');
        }else{
            header('Location: index.php?code=gift_provider');
        }
        exit;

    }

}
?>