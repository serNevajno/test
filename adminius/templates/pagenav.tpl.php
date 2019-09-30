<div class="row" id="pagenav<?if(!empty($pagenav_set)) echo $pagenav_set;?>">
	<div class="col-md-5 col-sm-12">
		<div class="dataTables_info" id="sample_1_info">Показано с <?=1+$start?> по <?if ($num*$page > $posts) {echo $posts;}else{echo $num*$page;}?> из <?=$posts?> записи</div>
	</div>
	<?if ($total > 1):?>
		<div class="col-md-7 col-sm-12">
			<div class="dataTables_paginate paging_bootstrap_full_number">
				<ul class="pagination" style="visibility: visible;">
					<?=$pervpage.$page5left.$page4left.$page3left.$page2left.$page1left?><li class="active"><a href="#">&nbsp;<?=$page?>&nbsp;</a></li><?=$page1right?>&nbsp;<?=$page2right?>&nbsp;<?=$page3right?>&nbsp;<?=$page4right?>&nbsp;<?=$page5right?>&nbsp;<?=$nextpage?>
				</ul>
			</div>
		</div>
	<?endif;?>
</div>
<br>