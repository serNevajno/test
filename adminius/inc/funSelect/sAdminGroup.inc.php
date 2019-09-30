<?
	function selectAdminGroup(){
		return db2array("SELECT id, name FROM admin_group", 2);
	}
	function selectAdminById($id){
		return db2array("SELECT id, login, name, id_group FROM admin_user WHERE id='$id'");
	}
	function selectGroupAdmin(){
		return db2array("SELECT id, name FROM admin_group", 2);
	}
	function selectAdminGroupById($id){
		return db2array("SELECT * FROM admin_group WHERE id='$id'");
	}
	function selectAllAdministrator($page, $num, $search){
		global $posts;
		global $start;
		$search = clearData($search);
		if ($search != "") {
			$query_search .= ' WHERE `login` LIKE "%'.$search.'%"';
		}
		$posts = selectCount("admin_user $query_search");				
		$start = strNav($page, $num, $posts);
		
		return db2array("SELECT id, login, name FROM admin_user $query_search ORDER BY id DESC LIMIT $start, $num", 2);
	}
	
	/////Вывод юзера по логину
	function selectAdminByLogin($login) {
		return db2array("SELECT id, password FROM admin_user WHERE login='$login'");
	}