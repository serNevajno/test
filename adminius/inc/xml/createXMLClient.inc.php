<?include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
//include ($_SERVER['DOCUMENT_ROOT'].'/inc/apiFunc.inc.php');
function selectNameCat($id){
    $temp = db2array("SELECT name FROM categories WHERE id='$id'");
    return $temp["name"];
}
function recusiveCategoriesXML($section){
    $temp = db2array("SELECT id, name, code, section FROM categories WHERE section='$section' AND active='1'", 2);
    $res ="";
    if($temp){
        foreach($temp as $item){
            if($item["section"]>0){
                $res.='<category id="'.$item["id"].'" parentId="'.$item["section"].'">'.$item["name"].'</category>';
            }else{
                $res.='<category id="'.$item["id"].'">'.$item["name"].'</category>';
            }
            $res.=recusiveCategoriesXML($item["id"]);
        }
    }
    return $res;
}
function recusiveCategoriesXML2($id, $res){
    $temp = db2array("SELECT id, name, code, section FROM categories WHERE id='$id'");
    $arr = array();
    if($temp){
        if($temp["section"]>0){
            $arr[$temp["section"]] = $res;
            $arr=recusiveCategoriesXML2($temp["section"], $arr);
        }else{
            $arr=$res;
        }
    }else{
        $arr=$res;
    }
    return $arr;
}

function createArr($id){
    $temp = db2array("SELECT id, name, code, section FROM categories WHERE id='$id'");
    $res = array();
    $arr = array();
    if($temp){
        $res[$temp["section"]]=$temp["id"];
        $arr=recusiveCategoriesXML2($temp["section"], $res);
    }
    return $arr;
}

function recVal($value){
    $result = array();
    foreach($value as $key => $value2){
        $result = $value2;
    }
    return $result;
}

function recKey($value){
    $result = array();
    foreach($value as $key => $value2){
        $result = $key;
    }
    return $result;
}



$ar = array();
$cat = explode(",", $_POST["categories"]);

foreach($cat as $item){
    $ar[]= createArr($item);
}

$result = array();
foreach($ar as $value){
    foreach($value as $key => $value2){
        if(is_array($value2)){
            $vs = recVal($value2);
            $ks =  recKey($value2);
            $result[$key][$ks][] = $vs;
        }else{
            $result[$key][] = $value2;
        }
    }
}

$fp = fopen($_SERVER['DOCUMENT_ROOT']."/price/priceClient.xml", "w");
$xml ='<?xml version="1.0" encoding="WINDOWS-1251"?>

	<yml_catalog date="'.date("Y-m-d H:i").'">
		
		<shop>
			<name>Интернет магазин Добрая Шина</name>
			<company>ИП Таганов Максим Алексеевич</company>
			<url>http://dobrayashina.ru</url>
			
			<currencies>
				<currency rate="1" id="RUR"/>
			</currencies>
			
			<categories>';


//$xml.= recusiveCategoriesXML(0);
foreach($result as $key_s => $item_s){
    if($key_s == 0){
        foreach($item_s as $i){
            $xml.='<category id="'.$i.'">'.selectNameCat($i).'</category>';
        }
    }else{
        $xml.='<category id="'.$key_s.'">'.selectNameCat($key_s).'</category>';
        foreach($item_s as $k => $i){
            $xml.='<category id="'.$k.'" parentId="'.$key_s.'">'.selectNameCat($k).'</category>';
            if(is_array($i)){
                foreach($i as $l){
                    $xml.='<category id="'.$l.'" parentId="'.$k.'">'.selectNameCat($l).'</category>';
                }
            }
        }
    }
}
$xml.='</categories>
			<delivery-options>
                <option cost="0" days="7"/>
              </delivery-options>
			<cpa>1</cpa>
			
			<offers>';
// записываем в файл текст
fwrite($fp, iconv("UTF-8", "WINDOWS-1251", $xml));
// закрываем
fclose($fp);

/*$client = new SoapClient(SOAP_CLIENT);
try {
                        $params =  array
                        (
                                'login' => SOAP_LOGIN,
                                'password' => SOAP_PASS,
                                'filter' => array(
                                        'type_list' => array(0 => "car", 1 => "cartruck", 2 => "vned"),
                                ),
                                'page' => 0,
                        );

                $answer = $client->GetFindTyre($params);
} catch (Exception $exc) {
                $error = 'Ошибка. Товар либо сервис недоступны.';
}
echo $answer->GetFindTyreResult->totalPages;*/
$temp = db2array("SELECT COUNT(*) FROM categories as t1 LEFT JOIN categories as t2 on(t1.id=t2.section) LEFT JOIN categories as t3 on(t2.id=t3.section) LEFT JOIN product as t4 on(t3.id=t4.categories) WHERE t1.id='1' AND t4.active='1' AND t4.availability>0");

$total = (($temp["COUNT(*)"] - 1) / 100) + 1;
$total =  intval($total);

echo $total;
?>