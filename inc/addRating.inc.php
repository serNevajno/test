<?if($_SERVER["REQUEST_METHOD"]=="POST"){
	session_start(); 
	//////Подключение к базе
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
	/////Подключение библиотеки
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
	
	$id = clearData($_POST["id"], "i");

	if($_COOKIE[$id] != "1"){
		$x = clearData($_POST["x"], "i");
		setcookie($id, "1");
		
		$vote = selectVoteAndAvgById($id)['vote'] + 1;
		$rating = selectVoteAndAvgById($id)['rating'] + $x;
		$avg = $rating / $vote;
		
		
		mysql_query("UPDATE `product` SET `vote`='$vote',`avg`='$avg', `rating`='$rating' WHERE id='$id'") or die(mysql_error());
		
		echo ratingEchoFullProduct($avg, $id);
	}
}?>