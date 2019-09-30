<?
///////////////////////////////////якюидеп /////////////////////////////////////////
	function selectAllSlider($page, $num, $search){
		global $posts;
		global $start;
		$search = clearData($search);
		if ($search != "") {
			$query_search .= ' WHERE `title` LIKE "%'.$search.'%"';
		}
		$posts = selectCount("slider $query_search");				
		$start = strNav($page, $num, $posts);
		
		return db2array("SELECT id, title, descriptions, active, priority, img, type FROM slider $query_search ORDER BY priority DESC LIMIT $start, $num", 2);
	}
	
	function selectSlider($id) {
		return db2array("SELECT title, descriptions, img, url, active, priority, color, type FROM slider WHERE id='$id'");
	}
///////////////////////////////////йнмеж акнйю якюидепю /////////////////////////////////////////
