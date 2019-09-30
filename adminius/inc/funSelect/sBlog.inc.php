<?
	function selectBlogById($id){
		return db2array("SELECT * FROM blog WHERE id='$id'");
	}
	
	function selectAllBlog($page, $num, $cat, $search){
		global $posts;
		global $start;
		$search = clearData($search);
		if ($search != "") {
			$query_search .= ' AND `name` LIKE "%'.$search.'%"';
		}
		$posts = selectCount("blog WHERE cat='$cat'$query_search");				
		$start = strNav($page, $num, $posts);
		
		return db2array("SELECT id, name, active, img, date FROM blog WHERE cat='$cat'$query_search ORDER BY id DESC LIMIT $start, $num", 2);
	}