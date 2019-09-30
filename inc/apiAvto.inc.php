<?

include ($_SERVER['DOCUMENT_ROOT'].'/inc/apiFunc.inc.php');
$client = new SoapClient(SOAP_CLIENT);
try {
	$params = array(
		'login' => SOAP_LOGIN,
		'password' => SOAP_PASS,
	);
}catch (Exception $exc) { 
	$error = 'Ошибка. Товар либо сервис недоступны.';
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
	if(!empty($_POST["marka"]) AND empty($_POST["model"]) AND empty($_POST["year"])){
		$params = array(
			'login' => SOAP_LOGIN,
			'password' => SOAP_PASS,
			'marka' => $_POST["marka"]
		);
		$modelList = $client->GetModelAvto($params);
		if ($modelList) {
			$res = '';
			foreach ($modelList->GetModelAvtoResult->model_list->string as $iModel) {
				$res .= ' <li value="' . $iModel . '">' . $iModel . '</li>';
			}
		}
	}elseif(!empty($_POST["marka"]) AND !empty($_POST["model"]) AND empty($_POST["year"])){
		$params = array(
			'login' => SOAP_LOGIN,
			'password' => SOAP_PASS,
			'marka' => $_POST["marka"],
			'model' => $_POST["model"]
		);
		$yearAvto = $client->GetYearAvto($params);
		if ($yearAvto) {
			$auto = $yearAvto->GetYearAvtoResult->yearAvto_list->yearAvto;
			$res = '';
			if (is_array($auto)) {
				foreach ($auto as $item) {
					if ($item->year_end > '0') {
						$yearEnd = ' - ' . $item->year_end;
					} else {
						$yearEnd = '';
					}
					$res .= ' <li value="' . $item->year_begin . '-' . $item->year_end . '">' . $item->year_begin . $yearEnd . '</li>';
				}
			} else {
				if ($auto->year_end > '0') {
					$yearEnd = ' - ' . $auto->year_end;
				}
				$res .= ' <li value="' . $auto->year_begin . '-' . $auto->year_end . '">' . $auto->year_begin . $yearEnd . '</li>';
			}
		}
	}elseif(!empty($_POST["marka"]) AND !empty($_POST["model"]) AND !empty($_POST["year"])){
		$year = explode("-", $_POST["year"]);
		if(count($year)>1){
			$year_beg = $year[0];
			$year_end = $year[1];
		}else{
			$year_beg = "0";
			$year_end = $year[0];
		}
		$params = array(
			'login' => SOAP_LOGIN,
			'password' => SOAP_PASS,
			'marka' => $_POST["marka"],
			'model' => $_POST["model"],
			'year_beg' => $year_beg,
      'year_end' => $year_end
		);
		$yearResult = $client->GetModificationAvto($params); 
		//echo "<pre>";
		//print_r($yearResult);
		//echo "</pre>";
		if(count($yearResult->GetModificationAvtoResult->modification_list->string) > 1){
			if ($yearResult) {
				$res = '';
				foreach ($yearResult->GetModificationAvtoResult->modification_list->string as $iModif) {
					$res .= ' <li value="' . $iModif . '">' . $iModif . '</li>';
				}
			}
		}else{
			$res.= '<li value="'.$yearResult->GetModificationAvtoResult->modification_list->string . '">'.$yearResult->GetModificationAvtoResult->modification_list->string.'</li>';
		}
	}
	echo $res;
}
?>