<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if (!isset($_POST["id"])) {
        $active = clearData($_POST['active'], "i");
        $type = clearData($_POST['type'], "i");
        $name = clearData($_POST['name']);

        $ib = 1;
        foreach ($_POST['brand'] as $iBrand){
            if($ib>1) $brand.=",";
            $brand.=$iBrand;
            $ib++;
        }

        $id = 1;
        foreach ($_POST['diameter'] as $iDiameter){
            if($iDiameter == '0'){
                $diameter = '';
                $dEnd =1;
            }
            if($dEnd!='1') {
                if ($id > 1) $diameter .= ",";
                $diameter .= $iDiameter;
                $id++;
            }
        }


        $is = 1;
        foreach ($_POST['season'] as $iSeason){
            if($iSeason == '0'){
                $season = '';
                $sEnd =1;
            }
            if($sEnd!='1') {
                if ($is > 1) $season .= ",";
                $season .= $iSeason;
                $is++;
            }
        }

        $product = clearData($_POST['product']);

        /*echo "INSERT INTO xml_gift (active, `type`, `name`, brand, diameter, season, product) VALUES ('$active', '$type', '$name', '$brand', '$diameter', '$season', '$product')";
        exit();*/
        mysql_query("INSERT INTO xml_gift (active, `type`, `name`, brand, diameter, season, product) VALUES ('$active', '$type', '$name', '$brand', '$diameter', '$season', '$product')") or die(mysql_error());;

         if($type == "1"){
                header('Location: index.php?code=xml_gift_tyres');
         }else{
                header('Location: index.php?code=xml_gift_disk');
         }

        exit;
    }elseif(isset($_POST["id"]) and isset($_POST['brand']) and isset($_POST['diameter']) and isset($_POST['product'])){
        $id = clearData($_POST['id'], "i");
        $active = clearData($_POST['active'], "i");
        $type = clearData($_POST['type'], "i");
        $name = clearData($_POST['name']);
        $ib = 1;
        foreach ($_POST['brand'] as $iBrand){
            if($ib>1) $brand.=",";
            $brand.=$iBrand;
            $ib++;
        }

        $idia = 1;
        foreach ($_POST['diameter'] as $iDiameter){
            if($iDiameter == '0'){
                $diameter = '';
                $dEnd =1;
            }
            if($dEnd!='1') {
                if ($idia > 1) $diameter .= ",";
                $diameter .= $iDiameter;
                $idia++;
            }
        }


        $is = 1;
        foreach ($_POST['season'] as $iSeason){
            if($iSeason == '0'){
                $season = '';
                $sEnd =1;
            }
            if($sEnd!='1') {
                if ($is > 1) $season .= ",";
                $season .= $iSeason;
                $is++;
            }
        }

        $product = clearData($_POST['product']);

        mysql_query("UPDATE xml_gift SET active='$active', name='$name', brand='$brand', diameter='$diameter', season='$season', product='$product' WHERE id='$id'") or die(mysql_error());

        if($type == "1"){
            header('Location: index.php?code=xml_gift_tyres');
        }else{
            header('Location: index.php?code=xml_gift_disk');
        }
        exit;
    }elseif(!isset($_POST['brand']) and !isset($_POST['diameter'])  and !isset($_POST['product']) AND isset($_POST['id'])){

        $id = (int)$_POST['id'];
        $type = clearData($_POST['type'], "i");

        mysql_query("DELETE FROM xml_gift WHERE id='$id'") or die(mysql_error());

        if($type == "1"){
            header('Location: index.php?code=xml_gift_tyres');
        }else{
            header('Location: index.php?code=xml_gift_disk');
        }
        exit;

    }
}
?>