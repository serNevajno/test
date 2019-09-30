<?if($_SERVER["REQUEST_METHOD"]=="POST"){
	session_start(); 
	//////Подключение к базе
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
	/////Подключение библиотеки
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
	// Фильтруем полученные данные
	
	$page = clearData($_POST['page']);

	$sOrders = selectOrders($page);
	
	$res = '<table class="table table-striped table-bordered table-advance table-hover">
										<thead>
											<tr style="background:#d0e9c6";>
												<th> № Заказа </th>
												<th class="hidden-xs"> <i class="fa fa-calendar"></i> Дата заказа </th>
												<th> <i class="fa fa-money"></i> Сумма заказа </th>
												<th> <i class="fa  fa-check"></i> Статус </th>
												<th> </th>
											</tr>
										</thead>
										<tbody>';
	foreach($sOrders as $iOrders){
										$res.= '<tr style="background:#fff;">
												<td> <a href="/'.$_GET['code'].'-'.$iOrders['id'].'.html">'.$iOrders['id'].'</a> </td>
												<td class="hidden-xs"> '.$iOrders['date'].' </td>
												<td> '.selectSummOrderById($iOrders['id']).'.00 руб </td>
												<td> <span class="label label-sm label-'.$iOrders['code'].' label-mini">'.$iOrders['name'].'</span> </td>
												<td> <a href="/'.$_GET['code'].'-'.$iOrders['id'].'.html" style="border-left: 3px solid #cb1010;background: #f3eded;padding: 5px;font-size: 12px;">Просмотреть</a> </td>
											</tr>';
	}
	$res.= '</tbody>
					</table>				
					<div id="resPagination">
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