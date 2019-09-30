<?if($_SERVER["REQUEST_METHOD"]=="POST"){
	if(isset($_POST["email"]) and !isset($_POST["id"])){
	$mes = "";
	$email = explode("\r\n", $_POST["email"]);
	$date = date("Y-m-d H:i:s");
	$id_user = selectWhatUser();
	
	if($_POST["type"] == 1 or $_POST["type"] == 2) {
	
		if($_POST["type"] == 1){
			$text = textInvitations("text");
			$title = 'Сотни мастеров и работников выполнят Ваш заказ';
		}elseif($_POST["type"] == 2){
			$text = textInvitations("text_two");
			$title = 'Тендеры на строительство';
		}
		foreach($email as $item){
			$emailTRim = trim($item);
			$temp = db2array("SELECT COUNT(*) FROM invitations WHERE email='$emailTRim'");
			$temp_user = db2array("SELECT COUNT(*) FROM users WHERE email='$emailTRim'");
			if($temp["COUNT(*)"]>0 or $temp_user["COUNT(*)"]>0){
				if($temp["COUNT(*)"]>0){
					$mes.= "<span style='color:red;'>Email: ".$emailTRim.", уже есть в базе.</span><br>"; 
				}else{
					$mes.= "<span style='color:red;'>Email: ".$emailTRim.", уже зарегистрирован.</span><br>"; 
				}
			}else{
				$sPromo = selectPromoCode();
				if(!empty($sPromo) and $_POST["type"] == 2){
					$promo = "?promo_code=".$sPromo;
					$text_promo = 'Для активации статуса ПРО введите промокод "'.$sPromo.'" в поле при регистрации';
				}else{
					$promo="";
					$text_promo="";
				}
				$serverName = "stroiteli.net.ua";
				$send_mail = '
				<html xmlns="http://www.w3.org/1999/xhtml"><head>
				<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
				<meta content="telephone=no" name="format-detection">
				<meta content="width=mobile-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no" name="viewport">
				<meta content="IE=9; IE=8; IE=7; IE=EDGE" http-equiv="X-UA-Compatible">
				<title>Новый тендер по Вашей тематике</title>
				<!-- Google Fonts -->
				<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic,700,300,700italic,800" rel="stylesheet" type="text/css">	 

				<style type="text/css">
				/* This is to overwrite Outlook.com’s Embedded CSS */
					 table {border-collapse:separate;}
					 a, a:link, a:visited {text-decoration: none; color: #00788a;}
					 h2,h2 a,h2 a:visited,h3,h3 a,h3 a:visited,h4,h5,h6,.t_cht {color:#000 !important;}
					 p {margin-bottom: 0}
					 .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td {line-height: 100%;}							
					 .ExternalClass {width: 100%;}/**This is to center your email in Outlook.com************/
					 /* General Resets */
					 #outlook a {padding:0;}
					 body, #body-table {height:100% !important; width:100% !important; text-align:center; margin:0 auto; padding:0; line-height:100% !important; font-family: Open Sans, sans-serif;}
					 img, a img {border:0; outline:none; text-decoration:none;}
					 .http://abileweb.com/email/metal-drag/image-fix {display:block;}
					 table, td {border-collapse:collapse;}
					 /* Client Specific Resets */
					 .ReadMsgBody {width:100%;} .ExternalClass{width:100%;}
					 .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height:100% !important;}
					 .ExternalClass * {line-height: 100% !important;}
					 table, td {mso-table-lspace:0pt; mso-table-rspace:0pt;}
					 img {outline: none; border: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
					 body, table, td, p, a, li, blockquote {-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%;}
					 body.outlook img {width: auto !important;max-width: none !important;}
					 /* Start Template Styles */
					 /* Main */
					 body{ -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;}
					 body, #body-table {background-color: #cccccc; margin:0 auto !important;; text-align:center !important;}
					 p {padding:0; margin: 0; line-height: 24px; font-family: Open Sans, sans-serif;}
					 a, a:link {color: #1c344d;text-decoration: none !important;}
					 .footer-link a, .nav-link a {color: #fff6e5;}
					 /* Yahoo Mail */
					 .thread-item.expanded .thread-body{background-color: #000000 !important;}
					 .thread-item.expanded .thread-body .body, .msg-body{display:block !important;}
					 #body-table .undoreset table {display: table !important;table-layout: fixed !important;}
					 /* Online Editor */
					 #inspired-edit{list-style: none !important; margin: 0;padding: 0;}
					 #inspired-edit li{position: relative;cursor: n-resize; list-style-type:none !important;}               
					 #inspired-edit .test{width: 100%;position: relative;}
					 #inspired-edit .test .icon{position: absolute;top: 2px;right: 2px;}
					 #inspired-edit .test .icon img{width: 35px !important; height: 27px !important;}
					 #inspired-edit .ui-sortable-helper{left:0px !important;}
					 #inspired-edit li:hover{border-top:1px dashed #2385f3 !important;;border-bottom:1px dashed #2385f3 !important;}
					 .action-btn{width: 30px; position: absolute; left: 10px; top: 35%; z-index: 2000;}
					 /* Start Media Queries Layout 4 */
					 @media only screen and (max-width: 639px) {
					 *[class].content-width-bg { width:100% !important; }	 
					 *[class].center-bg {text-align:center !important; margin:0 auto  !important; width:100% !important; }
					 *[class].center-bg-http://abileweb.com/email/metal-drag/image {text-align:center !important;margin:0 auto  !important; width:100% !important;}
					 *[class].mobile-width {width: 480px!important; padding: 0 4px;}
				/* Full Width http://abileweb.com/email/metal-drag/image Section */
				*[class].mobile-full-width {width: 360px !important; padding: 0 4px;}
					 *[class].content-width {width: 360px!important;}
					 *[class].content-width-menu{width: 350px!important;}
					 *[class].no-padding {padding:0px !important;}
					 *[class].icon-columns{ width:360px !important; border:none !important; }
					 *[class].center {text-align:center !important; height:auto !important;margin:0 auto  !important;  width:100%;}
					 *[class].center-btn {text-align:center !important; height:auto !important; margin:0 auto; display:block;}
					 #inspired-edit .ui-sortable-helper{left:60px !important;  border-top:1px solid #2385f3 !important;;border-bottom:1px solid #2385f3 !important;}
					 *[class].hidden-space1{ display:none;}
					 *[class].center-bg {text-align:center !important; margin:0 auto  !important; width:100% !important; }
					 *[class].center-bg-http://abileweb.com/email/metal-drag/image {text-align:center !important;margin:0 auto  !important; width:100% !important;}
					 *[class].hidden-space-left{ display:inherit;}
					 }
					 @media only screen and (max-width: 480px) {
					 *[class].full-width {width: 100%!important;}
					 *[class].mobile-width {width: 360px!important; padding: 0 4px;}
				/* Full Width http://abileweb.com/email/metal-drag/image Section */
				*[class].mobile-full-width {width: 290px !important;}
					 *[class].content-width-menu{width: 350px!important;}
					 *[class].content-width {width: 300px!important;}
					 *[class].icon-columns{ width:300px !important; border:none !important; }
					 *[class].center {text-align:center !important; height:auto !important; margin:0 auto  !important; width:100%;}
					 *[class].center-btn {text-align:center !important; height:auto !important; margin:0 auto; display:block;}
					 *[class].center-stack {padding-bottom:30px !important; text-align:center !important; height:auto !important;}
					 *[class].stack {padding-bottom:30px !important; height: auto !important;}
					 *[class].gallery {padding-bottom: 20px!important;}
					 *[class].midaling { width:100% !important; border:none !important; }
					 *[class].center-bg {text-align:center !important; margin:0 auto  !important; width:100% !important; }
					 *[class].center-bg-http://abileweb.com/email/metal-drag/image {text-align:center !important;margin:0 auto  !important; width:100% !important;}
					 }
					 @media only screen and (max-width: 360px) {
					 *[class].full-width {width: 100%!important;}
					 *[class].mobile-width {width: 100%!important; padding: 0 4px;}
					 *[class].content-width {width: 270px!important;}
					 *[class].content-width-menu{width: 270px!important;}
					 *[class].content-width-http://abileweb.com/email/metal-drag/image{width: 270px!important;}
					 *[class].icon-columns{ width:290px !important; border:none !important; }
					 *[class].center {text-align:center !important; height:auto !important;margin:0 auto  !important;  width:100%;}
					 *[class].center-btn {text-align:center !important; height:auto !important; margin:0 auto; display:block;}
					 *[class].center-stack {padding-bottom:30px !important; text-align:center !important; height:auto !important;}
					 *[class].stack {padding-bottom:30px !important; height: auto !important;}
					 *[class].gallery {padding-bottom: 20px!important;}
					 *[class].fluid-img {height:auto !important; max-width:600px !important; width: 100% !important; min-width:320px !important;}
					 *[class].midaling { width:100% !important; border:none !important;}
					 #inspired-edit .ui-sortable-helper{left:0px !important;  border-top:1px solid #2385f3 !important;border-bottom:1px solid #2385f3 !important;}
					 *[class].center-bg {text-align:center !important; margin:0 auto  !important; width:100% !important; }
					 *[class].center-bg-http://abileweb.com/email/metal-drag/image {text-align:center !important;margin:0 auto  !important; width:100% !important;}
					 }
				</style>
				</head><body marginwidth="0" marginheight="0" style="margin-top: 0; margin-bottom: 0; padding-top: 0; padding-bottom: 0; width: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;" offset="0" topmargin="0" leftmargin="0">

				<div id="get_mail" class="">
				<!-- Top Bar Section Begins -->

				<!-- Top Bar Section Ends -->		

				<!-- Menu Section Begins -->
				<div class="parentOfBg"></div>
				<!-- Menu Section Ends -->					 

				<!-- Header Section 6 Begins -->
				<div class="parentOfBg"></div><table data-module="menu1 menus_section" align="center" border="0" cellpadding="0" cellspacing="0" width="100%" class="">
				<tbody><tr>
				<td align="center">
				<table data-bgcolor="Menu BG" cellpadding="0" cellspacing="0" border="0" width="640" align="center" bgcolor="f7f7f7" class="mobile-width" style="border-bottom:1px solid #f5f5f5;">
				 <tbody><tr>
					<td align="center">
					 <!-- Layout Table -->
					 <table border="0" align="center" width="600" cellpadding="0" cellspacing="0" class="content-width" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
							 <tbody><tr>
								<td align="center">
								 <!-- Container Width -->
								 <table cellpadding="0" cellspacing="0" border="0" align="center" width="600" class="content-width">
										 <tbody><tr>
											<td>
											 <!-- Start Logo -->
											 <table cellpadding="0" width="120" cellspacing="0" border="0" align="left" class="center" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
													 <tbody><tr>
														<td height="7" style="font-size: 7px; line-height:7px;">&nbsp;</td>
													 </tr>
													 <tr>
														<td align="center" valign="middle"><a href="#" style="display:block; max-height:100%;" class="editable_img"><img src="http://'.$serverName.'/images/logo.png" alt="" width="80" editable="true" mc:edit="logo-img" class="mCS_img_loaded"></a></td>
													 </tr>
													 <tr>
														<td height="7" style="font-size: 7px; line-height:7px;">&nbsp;</td>
													 </tr>
											 </tbody></table>
											 <!-- End Logo --> 
											 <!-- Start Space -->
											 <table align="left" cellspacing="0" width="20" height="3" cellpadding="0" border="0" class="full-width">
													 <tbody><tr>
														<td height="3" style="font-size: 0;line-height: 0;border-collapse: collapse;">
														 <p style="padding-left: 40px;"> </p>
														</td>
													 </tr>
											 </tbody></table>
											 <!-- End Space --> 
											 <!-- Start Nav -->
											 <table cellspacing="0" cellpadding="0" border="0" align="right" class="center" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
													 <tbody><tr>
														<td height="22" style="font-size: 22px; line-height: 22px;">&nbsp;</td>
													 </tr>
													 <tr>
														<td>
														 <table cellspacing="0" cellpadding="0" border="0" align="center" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="">
																 <tbody><tr>
																	<td align="center" style="color: #333333; font-size: 11px;font-family: Open Sans, sans-serif;font-weight:700; line-height: 20px;" mc:edit="navigation">
																	 <multiline>
																		<a data-size="Menu Title" data-color="Menu Title" style="color: #333333; text-transform:uppercase; margin:0px 10px; text-decoration: none;" href="http://'.$serverName.'/catalog/">Каталог строителей</a>
																		<a data-size="Menu Title" data-color="Menu Title" style="color: #333333;margin:0px 10px; text-decoration: none;text-transform:uppercase;" href="http://'.$serverName.'/tenders/">Тендеры</a>
																		<a data-size="Menu Title" data-color="Menu Title" style="color: #333333; margin:0px 10px; text-decoration: none;text-transform:uppercase;" href="http://'.$serverName.'/price/">Стоимость работ</a>
																		<a data-size="Menu Title" data-color="Menu Title" style="color: #333333; margin:0px 10px; text-decoration: none;text-transform:uppercase;" href="http://'.$serverName.'/calculator/">Калькулятор</a>
																	 </multiline>
																	</td>
																 </tr>
															
														 </tbody></table>
														</td>
													 </tr>
													 <tr>
														<td height="23" style="font-size: 23px; line-height: 23px;">&nbsp;</td>
													 </tr>
											 </tbody></table>
											</td>
										 </tr>
								 </tbody></table>
								 <!-- Container Width Ends -->
								</td>
							 </tr>
					 </tbody></table>
					 <!-- Layout Width Ends -->
					</td>
				 </tr>
				</tbody></table>
				</td>
				</tr>
				</tbody></table>
				<!-- Header Section 6 Ends -->

				<!-- Team Section 3 Begins -->
				<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" class=""> 
				<tbody><tr>
				<td align="center">
				<table data-bgcolor="Fullwidth" cellpadding="0" cellspacing="0" bgcolor="#fff" border="0" width="640" align="center" class="mobile-width" style="border-bottom:1px solid #cccccc;">								
				 <tbody><tr>
					<td align="center">
					 <table cellspacing="0" cellpadding="0" border="0" width="310" align="left" class="mobile-width center">
							 <tbody><tr>
								<td align="center"><a href="#" style="border-style: none !important; border: 0 !important;" class="editable_img"><img src="http://'.$serverName.'/images/mail/imageleftsection1.jpg" width="310" alt="" editable="true" class="mobile-full-width mCS_img_loaded"></a></td>
							 </tr>
					 </tbody></table>
					 <!-- Start Space -->
					 <table align="left" cellspacing="0" width="10" height="5" cellpadding="0" border="0" class="content-width center">
							 <tbody><tr>
								<td height="5" style="font-size: 0;line-height: 0;border-collapse: collapse;">
								 <p style="padding-left: 30px;"> </p>
								</td>
							 </tr>
					 </tbody></table>
					<!--  End Space -->                                                                      
					 <table cellspacing="0" cellpadding="0" border="0" width="300" align="left" class="mobile-width center">
						
							
							 <tr>
								<td>
								 <table width="270" align="left" cellspacing="0" cellpadding="0" border="0" class="center mobile-full-width">
									
										 <!-- Title -->
										 <tbody>
										 
										 <tr>
											<td data-size="Fullwidth Text" data-color="Fullwidth Text" align="left" style="font-family: Open Sans, sans-serif; font-size: 13px; mso-line-height-rule:exactly; font-weight:400; line-height:24px;color:#333333;" mc:edit="Fullwidthleft-text1">
											 <multiline label="Fullwidthleft-text1">
												'.$text.$text_promo.'
											 </multiline>
											</td>
										 </tr>											   
										 <!-- Start Space -->
										 <!-- Start Space -->
										 <tr>
											<td height="15" style="font-size:15px; line-height:15px;">&nbsp;</td>
										 </tr>
										 <!-- End Space -->  	
										 <!-- Button -->
										 <tr>
											<td align="center">
											 <table cellspacing="0" cellpadding="0" border="0" align="left" class="">
													 <tbody><tr>
														<td align="center">
														 <table data-color="Button" cellspacing="0" cellpadding="0" border="0" bgcolor="ffc400" align="center" width="190" class="btn_bg" style="border-radius:2px;">
																 <!-- Start Space -->
																 <tbody><tr>
																	<td height="6" style="font-size: 6px; line-height: 6px;"> </td>
																 </tr>
																 <!-- End Space -->
																 <tr>
																	<td data-size="Button" align="center" mc:edit="Fullwidthleft-btn" style="color: #ffffff; font-size: 13px; font-family: Open Sans, sans-serif; line-height:20px;">
																	 <a data-color="Button Link" style="color: #333333; text-decoration: none;" href="http://'.$serverName.'/registration/'.$promo.'">
																		<singleline label="Fullwidthleft-btn">Зарегистрироватся</singleline>
																	 </a>
																	</td>
																 </tr>
																 <!-- Start Space -->
																 <tr>
																	<td height="8" style="font-size: 8px; line-height:8px;"> </td>
																 </tr>
																 <!-- End Space -->
															
														 </tbody></table>
														</td>
													 </tr>
											 </tbody></table>
											</td>
										 </tr>
										 <!-- Button Ends -->     
									
								 </tbody></table>
								</td>
							 </tr>											   
							 <tr>
								<td height="30" style="font-size: 30px; line-height: 30px;">&nbsp;</td>
							 </tr>
							 <!-- End Space -->
					 </tbody></table>
					</td>
				 </tr>								    
				</tbody></table>
				</td>
				</tr>					   
				</tbody></table>
				<!-- Footer Section 1 Begins -->
				<table data-module="footersection1 footers_section" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody><tr>
				<td align="center">
				<table data-bgcolor="Footer BG" data-bg="Footer BG" cellpadding="0" cellspacing="0" bgcolor="1c1d1f" border="0" width="640" align="center" background="http://'.$serverName.'/images/mail/bg.jpg" style="background:http://'.$serverName.'/images/mail/bg.jpg;" class="mobile-width main-bg1">
				 <tbody><tr>
					<td align="center">
					 <!-- Container Table -->
					 <table cellspacing="0" cellpadding="0" border="0" width="600" class="content-width">
							 <!-- Quote Bg Content -->					   
							 <tbody><tr>
								<td>
								<table cellspacing="0" cellpadding="0" border="0" width="100%" align="left" class="content-width">
										 <!-- Start Space -->
										 <tbody><tr>
											<td height="30" style="font-size: 30px; line-height: 30px;">&nbsp;</td>
										 </tr>
										 <!-- End Space -->                                                      
										 <tr>
											<td data-size="Footer Text" data-color="Footer Text" align="center" style="font-family: Open Sans, sans-serif; font-size: 13px; mso-line-height-rule:exactly; font-weight:normal;line-height:20px;color:#b0b0b0;" mc:edit="footer-text3">
											 <multiline label="footer-text3">
												Вы получили это письмо, потому что не зарегистрированы на сайте
												<a href="http://'.$serverName.'/" style="color:#fff;">'.$serverName.'</a><br>
												Данное письмо сформировано автоматически, отвечать на него не нужно.<br>
												Вы всегда сможете отключить уведомления перейдя <a href="#" style="color:#fff;">по ссылке</a>.
											 </multiline>
											</td>
										 </tr>
										<!-- Start Space -->
										 <tr>
											<td height="30" style="font-size: 30px; line-height: 30px;">&nbsp;</td>
										 </tr>
										 <!-- End Space -->  
								 </tbody></table>
								</td>
							 </tr>
					 </tbody></table>
					 <!-- Container Table Ends -->													
					</td>
				 </tr>
				</tbody></table>
				</td>
				</tr>
				</tbody></table>
				<!-- Footer Section Ends -->
				</div>
				</body></html>
				';
					
					
					$subject = '=?utf-8?B?'.base64_encode($title).'?='; // теме письма
					$message = $send_mail; // Само сообщение
					$headers  = 'MIME-Version: 1.0' . "\r\n"; // Что бы отправлять HTML, устанавливаем Content-type заголовки
					$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";  // тут установить ту кодировку с которой вы работатете
					$headers .= 'From: =?UTF-8?B?' . base64_encode('STROITELI.NET.UA') . '?= <info@stroiteli.net.ua>\r\n';
					// Отправляем
					mail($emailTRim, $subject, $message, $headers);
				mysql_query("INSERT INTO invitations (email, date, id_admin, type, text) VALUES ('$emailTRim', '$date', '$id_user', '$_POST[type]', '$text')");
				$mes.= "<span style='color:green;'>Приглашение на Email: ".$emailTRim.", успешно отправлено.</span><br>"; 
			}
		}
	}else{
			$mes.= "<span style='color:red;'>Вы не выбрали тип.</span><br>"; 
	}
	}elseif(!isset($_POST["email"]) and isset($_POST["id"])){
		// Фильтруем полученные данные
		$id = (int)$_POST['id'];
		
		// Заносим в базу
		
		mysql_query("DELETE FROM invitations WHERE id='$id'") or die(mysql_error());

		header('Location: index.php?code=invitations&action=search');
		exit;
	
	}
}?>