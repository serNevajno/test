<?
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/apiFunc.inc.php');
	
	$client = new SoapClient(SOAP_CLIENT);

		try {
								$params =  array
								(
										'login' => SOAP_LOGIN,
										'password' => SOAP_PASS,
										'filter' => array(
										),
										'page' => 0,
								);
			
						$answer = $client->GetFindDisk($params);
		} catch (Exception $exc) { 
							$error = 'Ошибка. Товар либо сервис недоступны.';
		}
		echo $answer->GetFindDiskResult->totalPages;
?>