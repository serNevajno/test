<?
	session_start();
	header("Content-Type: text/html; charset=UTF-8");
	//////Подключение к базе
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
	/////Подключение библиотеки
	$page = $_GET["page"];
	$total = $_GET["total"];
	$num = $_GET["num"];
	$posts = $_GET["posts"];
	$func = $_GET["func"];
	
		$total = (($posts - 1) / $num) + 1;
		$total =  intval($total);
		// Определяем начало сообщений для текущей страницы
		$page = intval($page);
		// Если значение $page меньше единицы или отрицательно
		// переходим на первую страницу
		// А если слишком большое, то переходим на последнюю
		if(empty($page) or $page < 0) $page = 1;
		if($page > $total) $page = $total;
		// Вычисляем начиная с какого номера
		// следует выводить сообщения
		$start = $page * $num - $num;
	
	include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/function.inc.php');
	/////Замок
	include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/lock.inc.php');
	
	// Проверяем нужны ли стрелки назад
		if ($page != 1) $pervpage = '<li class="prev disabled" id="1"><a href="javascript:'.$func.'(1);" title="First"><i class="fa fa-angle-double-left"></i></a></li><li class="prev disabled"><a href="javascript:'.$func.'('.($page-1).');" title="Prev"><i class="fa fa-angle-left"></i></a></li>';
		// Проверяем нужны ли стрелки вперед
		if ($page != $total) $nextpage = '<li class="next"><a href="javascript:'.$func.'('.($page+1).');" title="Next"><i class="fa fa-angle-right"></i></a></li><li class="next" id="'.($total).'"><a href="javascript:'.$func.'('.$total.');" title="Last"><i class="fa fa-angle-double-right"></i></a></li>';

		// Находим две ближайшие станицы с обоих краев, если они есть
		if($page - 5 > 0) $page5left = ' <li><a href="javascript:'.$func.'('.($page-5).');">'. ($page - 5) .'</a></li>';
		if($page - 4 > 0) $page4left = ' <li><a href="javascript:'.$func.'('.($page-4).');">'. ($page - 4) .'</a></li>';
		if($page - 3 > 0) $page3left = ' <li><a href="javascript:'.$func.'('.($page-3).');">'. ($page - 3) .'</a></li>';
		if($page - 2 > 0) $page2left = ' <li><a href="javascript:'.$func.'('.($page-2).');">'. ($page - 2) .'</a></li>';
		if($page - 1 > 0) $page1left = ' <li><a href="javascript:'.$func.'('.($page-1).');">'. ($page - 1) .'</a></li>';

		if($page + 5 <= $total) $page5right = '<li><a href="javascript:'.$func.'('.($page + 5).');">'. ($page + 5) .'</a></li>';
		if($page + 4 <= $total) $page4right = '<li><a href="javascript:'.$func.'('.($page + 4).');">'. ($page + 4) .'</a></li>';
		if($page + 3 <= $total) $page3right = '<li><a href="javascript:'.$func.'('.($page + 3).');">'. ($page + 3) .'</a></li>';
		if($page + 2 <= $total) $page2right = '<li><a href="javascript:'.$func.'('.($page + 2).');">'. ($page + 2) .'</a></li>';
		if($page + 1 <= $total) $page1right = '<li><a href="javascript:'.$func.'('.($page + 1).');">'. ($page + 1) .'</a></li>';
	
	$result='<div class="col-md-5 col-sm-12"><div class="dataTables_info" id="sample_1_info">Показано с '.(1+$start).' по ';
	if ($num*$page > $posts) {
		$result.=$posts;
	}else{
		$result.=$num*$page;
	}
	$result.=' из '.$posts.' записи</div></div><div class="col-md-7 col-sm-12"><div class="dataTables_paginate paging_bootstrap_full_number"><ul class="pagination" style="visibility: visible;">';
	
	$result.=$pervpage.$page5left.$page4left.$page3left.$page2left.$page1left.'<li class="active"><a href="#">&nbsp;'.$page.'&nbsp;</a></li>'.$page1right.'&nbsp;'.$page2right.'&nbsp;'.$page3right.'&nbsp;'.$page4right.'&nbsp;'.$page5right.'&nbsp;'.$nextpage;
	
	$result.='</ul></div></div>';
	
	echo $result;
?>