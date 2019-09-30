<?
	$xml='</offers>
			</shop>
			</yml_catalog>';
		$fp=fopen($_SERVER['DOCUMENT_ROOT']."/price.xml","a");    
		fwrite($fp, iconv("UTF-8", "WINDOWS-1251", $xml));
		fclose($fp);
		echo "ok";
?>