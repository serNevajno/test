<?
	function selectSectionById($id) {
		return db2array("SELECT * FROM section WHERE id='$id' and server=0");
	}
	function selectSection($id) {
		return db2array("SELECT id, name, code, priority FROM section WHERE server=0 AND section='$id'", 2);
	}