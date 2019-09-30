<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<?include($_SERVER['DOCUMENT_ROOT'].'/adminius/templates/menu.tpl.php');?>
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<?include($_SERVER['DOCUMENT_ROOT'].'/adminius/templates/breadcrumbs.tpl.php');?>
			<?if ($_GET[code]):?>
				<?include($_SERVER['DOCUMENT_ROOT'].'/adminius/templates/tpl.php');?>
			<?else:?>
				<?include($_SERVER['DOCUMENT_ROOT'].'/adminius/templates/main.tpl.php');?>
			<?endif;?>
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->