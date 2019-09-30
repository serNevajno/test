<?
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/function.inc.php');
$xml = '</offers>';
$gift = selectActiveGift();
if($gift) {
    $idProd = array();
    $xml .= '<gifts>';
    foreach ($gift as $iGift) {
        $prod = explode(",", $iGift["product"]);
        foreach ($prod as $iProd) {
            $sProdArt = selectProductByArtiсle(trim($iProd));
            if ($sProdArt AND !in_array($sProdArt["id"], $idProd)) {
                $idProd[] = $sProdArt["id"];
                $xml .= '<gift id="' . $sProdArt["id"] . '">
            <name>' . $sProdArt["name"] . '</name>
            <picture>http://dobrayashina.ru/images/product_cover/' . $sProdArt["img"] . '</picture>
          </gift>';
            }
        }
    }
    $xml .= '</gifts><promos>';
    foreach ($gift as $iGift) {
        $xml .= '<promo id="PromoGift' . $iGift["id"] . '" type="gift with purchase">
            <description>' . $iGift["name"] . '</description>
            <!--Товары, участвующие в акции-->
            <purchase>';
        if ($iGift["type"] == "1") {
            $wr = "t2.section IN ($iGift[brand])";
            if (!empty($iGift['diameter'])) {
                $wr .= ' AND t3.element_value IN (' . $iGift[diameter] . ')';
            }
            if (!empty($iGift['season'])) {
                $wr .= ' AND t4.element_value IN (' . $iGift[season] . ')';
            }
        } elseif ($iGift["type"] == "2") {
            $wr = "t2.section IN ($iGift[brand])";
            if (!empty($iGift['diameter'])) {
                $wr .= ' AND t3.element_value IN (' . $iGift[diameter] . ')';
            }
        }
        $result = db2array("SELECT t1.id, t1.availability
                    FROM product as t1 
                    LEFT JOIN categories as t2 on(t1.categories=t2.id) 
                    LEFT JOIN filter_value as t3 on(t3.id_product=t1.id)
                    LEFT JOIN filter_value as t4 on(t4.id_product=t1.id)
                    WHERE $wr AND t1.provider>0 AND t1.active='1' AND t1.availability>0 AND t1.price>0 GROUP BY t1.id", 2);
        foreach ($result as $item) {
            if ($item["availability"] >= 4) {
                $xml .= '<product offer-id="' . $item["id"] . '"/>
    ';
            }
        }

        $xml .= '</purchase>
            <!--Подарки на выбор-->
            <promo-gifts>';
        $prod = explode(",", $iGift["product"]);
        foreach ($prod as $iProd) {
            $sProdArt = selectProductByArtiсle(trim($iProd));
            if ($sProdArt) {
                $xml .= '<promo-gift gift-id="' . $sProdArt["id"] . '"/>';
            }
        }
        $xml .= '</promo-gifts>
            </promo>';
    }
    $xml .= '</promos>';
}

$xml.='</shop>
			</yml_catalog>';
$fp=fopen($_SERVER['DOCUMENT_ROOT']."/price/price.xml","a");
fwrite($fp, iconv("UTF-8", "WINDOWS-1251", $xml));
fclose($fp);
echo "ok";
?>