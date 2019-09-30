<?if($_SERVER["REQUEST_METHOD"]=="POST"){
	session_start(); 
	//////Подключение к базе
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
	/////Подключение библиотеки
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
	// Фильтруем полученные данные
	
	$page = clearData($_POST['page']);

	$sNews = selectBlog("1", $page);

	$res = '';
	foreach($sNews as $iNews){
        if($iNews["img"]){
            $img = '<img src="/scripts/phpThumb/phpThumb.php?src=/images/news/'.$iNews["img"].'&w=304&h=201&far=1&bg=ffffff&f=jpg" alt="image">';
        }else{
            $img = '<img src="//placehold.jp/304x201.png?text=no image" alt="image">';
        }
										$res.= '<div class="blog-item">
											<div class="row">
												<div class="col-sm-5 col-md-5">
													<a href="/news/'.$iNews["code"].'-'.$iNews["id"].'>.html" class="hover-img">'.$img.'</a>
												</div>
												<div class="col-sm-7 col-md-7">
													<div class="blog-caption">
														<ul class="blog-date blog-date-left p-t-lg-0">
															<li><a><i class="fa fa-calendar"></i> '.dateformat($iNews["date"]).'</a></li>
														</ul>
														<h2 class="blog-heading"><a href="/news/'.$iNews["code"].'-'.$iNews["id"].'.html">'.$iNews["name"].'</a></h2>
														<p>'.cut_paragraph($iNews["description"], 125).'</p>
														<a href="/news/'.$iNews["code"].'-'.$iNews["id"].'.html" class="ht-btn ht-btn-default ">Читать больше</a>
													</div>
												</div>
											</div>
										</div>';
	}
	$res.= '<div id="resPagination">
						<nav aria-label="Page navigation">
							<ul class="pagination ht-pagination">
								'.$pervpage.$page5left.$page4left.$page3left.$page2left.$page1left.'
								<li class="active"><a>'.$page.'</a></li>
								'.$page1right.$page2right.$page3right.$page4right.$page5righ.$nextpage.'	
							</ul>
						</nav>
					</div>';
	echo $res;
}?>