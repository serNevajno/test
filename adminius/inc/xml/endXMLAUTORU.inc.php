<?
	$xml='</parts>';
		$fp=fopen($_SERVER['DOCUMENT_ROOT']."/price/priceAUTORU.xml","a");
		fwrite($fp, $xml);
		fclose($fp);
		echo "ok";
?>