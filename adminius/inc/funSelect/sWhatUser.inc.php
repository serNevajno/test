<?
	////Узнаем какой пользователь
	function selectWhatUser() {
		$temp = db2array("SELECT id FROM admin_user WHERE sid='".session_id()."'");
		return $temp["id"];
	}
	
	function selectWhatUserLogin() {
		return db2array("SELECT id, login FROM admin_user WHERE sid='".session_id()."'");
	}