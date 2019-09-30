<div id="resPagination">
	<?if($total>1){?>
		<nav aria-label="Page navigation">
			<ul class="pagination ht-pagination">
				<?=$pervpage.$page5left.$page4left.$page3left.$page2left.$page1left?>
				<li class="active"><a><?=$page?></a></li>
				<?=$page1right.$page2right.$page3right.$page4right.$page5righ.$nextpage?>	
			</ul>
		</nav>
	<?}?>
</div>